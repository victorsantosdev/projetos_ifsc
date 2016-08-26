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

int task1_run(void);

int task1_stop(void);

int tasks_start(void);

int tasks_stop(void);

#ifdef  __cplusplus
}
#endif

#endif /* __TASKS_H__ */

