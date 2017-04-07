/***************************************************************************
**											
**                                松牛 出品    
**                          http://sonew.512j.com/                          
**                      All Rights Reserved  2007.6.1                        
**                                   V1.0                                 
** 声　明:                                                                  
**         以下代码仅提供给网友免费学习使用，非商业用途	                    
****************************************************************************/

#ifndef DAEMON_H
#define DAEMON_H

#include <QtCore>

extern bool isJudgeActivated;

class Daemon : public QThread
{
public:
	void run();
private:

};

class Starter : public QThread
{
public:
	void run();
};

class WatchDog : public QThread
{
public:
	void run();
};

#endif
		
