/* 
 * File:	tasks.c
 * Author:	Jonas Murilo Antunes (jonasmuriloantunes@gmail.com)
 * Comment: Tarefas genéricas
 * 
 */
#include <stdlib.h>
#include <stdint.h>
#include <unistd.h>
#include <string.h>
#include <stdio.h>
#include <errno.h>
#include <sys/types.h>
#include <sys/stat.h>

#include <signal.h>
#include <pthread.h>
#include <fcntl.h>

#include "tasks.h"
#include "debug.h"

/* threads */
static pthread_t task1_thread;

/* mutex e condition */
static pthread_mutex_t task1_mtx = PTHREAD_MUTEX_INITIALIZER;
static pthread_cond_t task1_cond = PTHREAD_COND_INITIALIZER;
static int task1_running;
static int task1_exit;

static int task1(void)
{       
    int i;
	sigset_t mask;

	/* block signals */
	sigemptyset(&mask);
	sigaddset(&mask, SIGINT);
	sigaddset(&mask, SIGTERM);
	sigaddset(&mask, SIGQUIT);
	sigaddset(&mask, SIGABRT);
	sigprocmask(SIG_BLOCK, &mask, NULL);

	DBG(DBG_TRACE, "PID: %d, PPID: %d", getpid(), getppid());

    task1_exit = 0;

	while (task1_exit == 0) {

		/*
		waiting...
		*/
		pthread_mutex_lock(&task1_mtx);

    	DBG(DBG_TRACE, "task1 stopped, waiting...");

		pthread_cond_wait(&task1_cond, &task1_mtx);
		pthread_mutex_unlock(&task1_mtx);

        if (task1_exit == 1)
            break;

		/*
		fazendo algo...
		*/
		task1_running = 1;
		
        printf("fazendo algo...");
		while (task1_running == 1) {
            for (i = 5; i; i--) {
                printf("%d ", i);
                fflush(stdout);
                sleep(1);
            }
        }            
        printf("voltando a dormir.");
        fflush(stdout);
	}	
	
	/*
	desalocar memória
	*/
    DBG(DBG_TRACE, "fim da task1");
	pthread_exit(NULL);
	return 0;
}

/*
Libera a execução da task1
*/
int task1_run(void)
{
    if (task1_running == 1)
        return 1;
        
	pthread_mutex_lock(&task1_mtx);
	pthread_cond_signal(&task1_cond);
	pthread_mutex_unlock(&task1_mtx);

	return 0;
}

/*
Pára a execução da task1
*/
int task1_stop(void)
{
    if (task1_running == 0)
        return 1;
    
	pthread_mutex_lock(&task1_mtx);
    task1_running = 0;
	pthread_cond_signal(&task1_cond);
	pthread_mutex_unlock(&task1_mtx);

	return 0;
}


int tasks_start(void) 
{
    int ret;
    
	DBG(DBG_TRACE, "pthread_create()...");

    ret = pthread_create(&task1_thread, NULL, 
						  (void * (*)(void *))task1, 
						  (void *)0);

	return ret;
}

int tasks_stop(void)
{
	//pthread_cancel(task1_thread);
	pthread_mutex_lock(&task1_mtx);
	task1_exit = 1;
	pthread_cond_signal(&task1_cond);
	pthread_mutex_unlock(&task1_mtx);
	
	pthread_join(task1_thread, NULL);
    
	DBG(DBG_TRACE, "bye-bye!");
	return 0;
}

