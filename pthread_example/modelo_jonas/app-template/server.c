/*
 * File:	server.c
 * Author:	Jonas Murilo Antunes (jonasmuriloantunes@gmail.com)
 * Comment: Servidor TCP/IP do protocolo de troca de mensagens.
 *
 *
*/
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stdarg.h>
#include <fcntl.h>
#include <ctype.h>

#include <sys/types.h>
#include <sys/stat.h>
#include <unistd.h>

#include <netinet/in.h>
#include <sys/socket.h>
#include <arpa/inet.h>
#include <netinet/tcp.h>
#include <netdb.h>
#include <stdint.h>

#include <signal.h>
#include <pthread.h>

#include "application.h"
#include "server.h"
#include "debug.h"

#include "tasks.h"

#define SERVER_RCV_LENMAX   512   // tamanho máximo da string recebida do client
#define SERVER_RCV_ARGMAX   32    // máximo de argumentos recebidos no comando


struct server_st server;

static pthread_t server_thread;

/*
Desconectar socket
*/
int server_disconnect(void)
{

	DBG(DBG_INFO, "Disconnecting ...");

	close(server.fd);
	
	server.fd = -1;

	return 0;
}


/*
Retorna um ponteiro para o inicio do nome do arquivo, desprezando o path.
*/
char * server_extract_fname(char * fname)
{
	char * p;

	if ((p = strrchr(fname, '/')) != NULL)  //procurar pela última ocorrência de '/'
		p++;
	else
		p = fname;  //não existe nenhum '/' (não têm path)

	return p;
}



/*
Retorna a quantidade de bytes escritos no socket (maior ou igual a zero).
Se não estiver conectado retorna SERVER_ERR_NO_CONNECTED (valor negativo).
*/
int server_send_package(char * name, char *fields)
{
	char s[512];
	int ret;

	if (server.fd < 0)
		return SERVER_ERR_NO_CONNECTED;

	DBG(DBG_INFO, "packname(%s) fields(%s)", name, fields);

    if (fields != NULL)
    	sprintf(s, "$%s,%s\n", name, fields);
    else    	
    	sprintf(s, "$%s\n", name);
	
	ret = write(server.fd, s, strlen(s));

    return ret;
}


/*
Strip whitespace from the start and end of STRING.  Return a pointer
into STRING.
*/
static char * server_stripwhite(char * string)
{
	register char *s, *t;

	for (s = string; isspace(*s); s++);

	if (*s == 0)
		return (s);

	t = s + strlen (s) - 1;
	while (t > s && isspace(*t))
		t--;
	*++t = '\0';

	return s;
}

int server_parse(char * s, char ** argv, int argmax)
{
	char * cp;
	int bracket;
	int quote;
	int n;
	int c;


	if (!s)
		return 0;

	if ((cp = server_stripwhite(s)) == '\0') {
		return 0;
	}

	if ((*cp == '\n') || (*cp == '\r'))
		return 0;

	bracket = 0;
	quote = 0;

	for (n = 0; (c = *cp) && (n < argmax); ) {
		c = *cp;
		/* Remove lead blanks */
		if (isspace(c)) {
			cp++;
			continue;
		}
		if (c == '(') {
			bracket++;
			cp++;
		}
		if (c == '"') {
			cp++;
			if (quote) {
				quote = 0;
				continue;
			}
			quote = 1;
		}
		if ((c == ')') && (bracket)) {
			bracket = 0;
			continue;
		}

		argv[n++] = cp;

		if (bracket) {
			for(; (c = *cp); cp++) {
				if (c == '(')
					bracket++;
				if (c == ')') {
					bracket--;
					if (!bracket)
						break;
				}
			} 
		} else {
			if (quote) {
				for (; (c = *cp) && (c != '"'); cp++);
			} else {
				for (; (c = *cp); cp++) {
					if (isspace(c)) {
						break;
					}
					if ((c == ',') || (c == '*')) {
						break;
					}
					if (c == '"') {
						quote = 1;
						break;
					}
					if (c == '(') {
						bracket = 1;
						break;
					}
				}
			}
		}
		if (c)
			*cp++ = '\0';
	}

	return n;
}

/*
Valida o package recebido.
Regra: o primeiro argumento é o nome do package precedido por '$'
Return:
  0 : OK, package válido
 -1 : argumentos insuficientes
 -2 : nome do package inválido
*/
int server_valid(int argc, char ** argv)
{

    #if 0
	int n;
    for (n = 0; n < argc; n++) {
        printf("argv[%d] = \"%s\"\n", n, argv[n]);
    }
    #endif

	/* é necessário no mínimo o nome do package */
	if (argc < 1)
		return -1;

	if (strlen(argv[0]) < 1)
		return -2;

	/* o nome do package deve sempre ser precedido pelo '$' */
	if (argv[0][0] != '$')
		return -2;

	return 0;
}


int server_send_plain_text(char *s)
{
	if (server.fd < 0)
		return SERVER_ERR_NO_CONNECTED;

    return write(server.fd, s, strlen(s));
}

/*
Envio do pacote VER: $VER,APP_VERSION_MAJOR,APP_VERSION_MINOR
*/
int server_send_ver(void)
{
    char fields[32];

	sprintf(fields, "%d,%d",
	    APP_VERSION_MAJOR,
	    APP_VERSION_MINOR);

	return server_send_package(SERVER_TX_VER, fields);
}

/*
Envio do pacote T1RUN: $T1RUN,RESULT
*/
int server_send_t1run(void)
{
    char fields[32];
    int ret;

    ret = task1_run();

	sprintf(fields, "%d", ret);

	return server_send_package(SERVER_TX_T1RUN, fields);
}

/*
Envio do pacote T1STOP: $T1STOP,RESULT
*/
int server_send_t1stop(void)
{
    char fields[32];
    int ret;

    ret = task1_stop();

	sprintf(fields, "%d", ret);

	return server_send_package(SERVER_TX_T1STOP, fields);
}


void server_on_connected(void)
{
	printf("\nConectado com o client %s : %d\n", server.client_addr, server.client_port);
	fflush(stdout);
}

void server_on_disconnected(void)
{
	printf("\nDesconectado do client\n");
	fflush(stdout);
}

/*
Handle de pacotes recebidos.
*/
void server_on_cmd_received(int argc, char **argv)
{
    char * cmd;

    /*
	Campo obrigatório: nome do package
	*/
	if (argc == 0) {
		DBG(DBG_ERROR, "quantidade de argumentos (%d) eh insuficiente", argc);
		return;
	}

	/* package name */
    cmd = argv[0];

    /*
    $VER
    */
    if (strcmp(cmd, SERVER_RX_VER) == 0) {

        server_send_ver();
        return;
    }

    /*
    $T1RUN
    */
    if (strcmp(cmd, SERVER_RX_T1RUN) == 0) {

        server_send_t1run();
        return;
    }

    /*
    $T1STOP
    */
    if (strcmp(cmd, SERVER_RX_T1STOP) == 0) {

        server_send_t1stop();
        return;
    }

    #if 0
    /*
    $HOOKST,CANAL
    */
    if (strcmp(cmd, SERVER_RX_HOOKST) == 0) {

		if (argc < 2)
			return;
			
        ch = atoi(argv[1]);

        server_send_hookst(ch);
        return;
    }
    #endif

    DBG(DBG_TRACE, "Command \"%s\" unknow", cmd);
}


/*
Thread of connection
*/
int server_task(void)
{
	int svc;
	struct sockaddr_in sa;
	socklen_t addrlen;
	int n;
	int ret;
	fd_set rfds;
	struct timeval tv;
	int retval;
	char buf[SERVER_RCV_LENMAX];
	char * argv[SERVER_RCV_ARGMAX];
	int argc;
	sigset_t mask;

	/* block signals */
	sigemptyset(&mask);
	sigaddset(&mask, SIGINT);
	sigaddset(&mask, SIGTERM);
	sigaddset(&mask, SIGQUIT);
	sigaddset(&mask, SIGABRT);
	sigaddset(&mask, SIGHUP);
	sigprocmask(SIG_BLOCK, &mask, NULL);
	DBG(DBG_TRACE, "PID: %d, PPID: %d", getpid(), getppid());

	if((svc = socket(PF_INET, SOCK_STREAM, 0)) < 0) {
		perror("socket");
		return 1;
	};

	sa.sin_family = AF_INET;
	sa.sin_addr.s_addr = INADDR_ANY;
	sa.sin_port = htons(server.port);

	if((bind(svc, (struct sockaddr *)&sa, sizeof(struct sockaddr_in))) < 0) {
		DBG(DBG_ERROR, "bind(): port %d", server.port);
		return 1;
	};

	if((listen(svc, 2)) < 0) {
		DBG(DBG_ERROR, "listen()");
		return 1;
	};

	DBG(DBG_INFO, "Socket %d, listening", svc);

	for(;;) {

		DBG(DBG_TRACE, "Waiting for connection on port %d", server.port);

		addrlen = sizeof(struct sockaddr_in);
		if((server.fd = accept(svc, (struct sockaddr *)&sa, &addrlen)) < 0) {
			DBG(DBG_ERROR, "accept()");
			break;
		};

		inet_ntop(AF_INET, (void *)&sa.sin_addr, server.client_addr, 16);
		server.client_port = ntohs(sa.sin_port);

		/* executar evento connected */
		server_on_connected();
		
		for(;;) {
			/* Watch fd to see when it has input. */
			FD_ZERO(&rfds);
			FD_SET(server.fd, &rfds);
			FD_SET(STDIN_FILENO, &rfds);
			/* Wait up to five seconds. */
			tv.tv_sec = 5;
			tv.tv_usec = 0;
	
			retval = select(server.fd + 1, &rfds, NULL, NULL, &tv);

			if (retval == -1)
			
				DBG(DBG_ERROR, "select()\n");
				
			else {
			
				if (retval) {
				
					if (FD_ISSET(server.fd, &rfds)) {
					
						if ((n = read(server.fd, buf, SERVER_RCV_LENMAX)) > 0) {

							buf[n] = '\0';
                            DBG(DBG_TRACE, "RX: \"%s\"", buf);

                            argc = server_parse(buf, argv, SERVER_RCV_ARGMAX);

                            DBG(DBG_TRACE, "argc(%d)", argc);
                            if (argc == 0)
                                continue;

							if ((ret = server_valid(argc, argv)) < 0) {
								DBG(DBG_ERROR, "erro(%d) package recebido eh invalido", ret);
								continue;
							}

							argv[0]++; // saltar preamble '$', começa no nome do package

							/* executar evento on_cmd_received */
                            server_on_cmd_received(argc, argv);
							
						} else {
						
							close(server.fd);
							server.fd = -1;
							/* executar evento disconnected */
							server_on_disconnected();
							break;
						}
					}
					
				} else {
					DBG(DBG_INFO, "<IDLE>");
				}
			}
		}
	}

	return 0;
}


int server_start(void)
{
	int ret;

	server.port = 9000;

	if ((ret = pthread_create(&server_thread, NULL, 
						  (void * (*)(void *))server_task, 
						  (void *)NULL)) < 0) {
		DBG(DBG_ERROR, "pthread_create()");
		return ret;
	}

	return 0;
}

int server_stop(void)
{
	server_disconnect();

	pthread_cancel(server_thread);
	pthread_join(server_thread, NULL);

	return 0;
}
