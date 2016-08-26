/* 
 * File:	ctrl.h
 * Author:	Robinson Mittmann (bobmittmann@gmail.com)
 * Comment:
 *
 */

#ifndef __CTRL_H__
#define __CTRL_H__

#ifdef __cplusplus
extern "C" {
#endif

int ctrl_start(char * path);
int ctrl_stop(void);

#ifdef  __cplusplus
}
#endif

#endif /* __CTRL_H__ */

