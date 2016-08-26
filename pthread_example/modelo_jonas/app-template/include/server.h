/* 
 * File:	server.h
 * Author:	Jonas Murilo Antunes (jonasmuriloantunes@gmail.com)
 * Comment: Servidor TCP/IP do protocolo de troca de mensagens.
 *
 */

#ifndef __SERVER_H__
#define __SERVER_H__

#include <stdint.h>

#ifdef __cplusplus
extern "C" {
#endif

/*
pacotes que podem ser recebidos
*/
#define SERVER_RX_VER         "VER"          // requisitar versão do aplicativo
#define SERVER_RX_T1RUN       "T1RUN"        // requisitar execução da task 1
#define SERVER_RX_T1STOP      "T1STOP"       // requisitar parada da task 1

/*
pacotes que podem ser enviados
*/
#define SERVER_TX_VER         "VER"          // resposta ao pacote VER
#define SERVER_TX_T1RUN       "T1RUN"        // resposta ao pacote T1RUN
#define SERVER_TX_T1STOP      "T1STOP"       // resposta ao pacote T1STOP

/*
codigos de erros
*/
//erros ocorridos ao enviar/receber comandos
#define	SERVER_ERR_OK                0  // ok
#define SERVER_ERR_NODEF            -1  // erro nao definido
#define	SERVER_ERR_TIMEOUT          -4  // timeout
#define SERVER_ERR_MANYARG          -8  // ultrapassou limite máximo de argumentos suportado
#define SERVER_ERR_NO_CONNECTED     -15 // não conectado ao client
//erros ocorridos ao tentar conectar com o client
#define SERVER_ERR_CON_SOCK         -20 // falha ao tentar abrir o file descriptor do socket
//erros enviados ao client
#define SERVER_ERR_CMD_INVALID      -30 // CMD: comando inválido
#define SERVER_ERR_CMD_INEXIST      -31 // CMD: comando inexistente
#define SERVER_ERR_CMD_ARG_INVALID  -32 // CMD: argumento inválido
#define SERVER_ERR_CMD_ARG_TOOMANY  -33 // CMD: excesso de argumentos
#define SERVER_ERR_CMD_ARG_TOOLONG  -34 // CMD: argumento muito extenso

/*
propriedades do servidor
*/
struct server_st {
	int fd;                            // file descriptor do socket
    int port;                          // porta do servidor
	char client_addr[16];              // IP do client obtido após a conexão
	int  client_port;                  // porta do client obtida após a conexão
	int  local_port;                   // porta local obtida após a conexão
	int tmo_cnt;                       // contador de time-out ocorrido
};


/*
public vars
*/
extern struct server_st server;


/*
external
*/
extern int server_start(void);

extern int server_stop(void);

extern int server_connect(void);

extern int server_disconnect(void);

extern int server_send_plain_text(char *s);

extern int server_send_package(char * name, char *fields);


#ifdef  __cplusplus
}
#endif

#endif /* __SERVER_H__ */

