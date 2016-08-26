/* 
 * File:	tasks.h
 * Author:	Jonas Murilo Antunes (jonasmuriloantunes@gmail.com)
 * Comment:
 *
 */

#ifndef __TASKS_H__
#define __TASKS_H__

#ifdef __cplusplus
extern "C" {
#endif

enum {
    T2_RUN,
    T2_STOP,
    T2_TIMER
};    

int task1_run(void);

int task1_stop(void);

int task2_run(void);

int task2_stop(void);

int task2_timer(int t);

int tasks_start(void);

int tasks_stop(void);


#ifdef  __cplusplus
}
#endif

#endif /* __TASKS_H__ */

