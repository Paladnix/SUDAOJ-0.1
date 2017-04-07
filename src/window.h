/***************************************************************************
**											
**                                松牛 出品    
**                          http://sonew.512j.com/                          
**                      All Rights Reserved  2007.6.1                        
**                                   V1.0                                 
** 声　明:                                                                  
**         以下代码仅提供给网友免费学习使用，非商业用途	                    
****************************************************************************/

#ifndef WINDOW_H
#define WINDOW_H

#include <QtGui>
#include "daemon.h"

class Window : public QWidget
{
	Q_OBJECT
public:
	Window();

protected:
	void closeEvent(QCloseEvent *event);
	bool event(QEvent *event);   

private slots:
	void iconActivated(QSystemTrayIcon::ActivationReason reason);
	void waitForQuit();
	void startJudge();
	void stopJudge();
	void showTime();
	void getContestTime(const QDateTime &cdt) { contestTime = cdt; }
	void getContestLength(const QTime &cl) { contestLength = cl; }

private:
	void createActions();
	void createLayouts();
	void remainTime();
	QString toDateTimeString(int secs);

	QSystemTrayIcon *trayIcon;
	QAction *monitorAction;
	QAction *quitAction;
	QMenu *trayIconMenu;
	QPushButton *startButton;
	QPushButton *stopButton;
	QPushButton *quitButton;
	QLabel *currentTimeLabel;
	QLabel *timeRemainsLabel;
	QDateTime contestTime;
	QTime contestLength;

	Daemon *daemon;
	Starter *starter;
	//WatchDog *watchDog;
};

#endif
