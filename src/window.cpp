/***************************************************************************
**											
**                                松牛 出品    
**                          http://sonew.512j.com/                          
**                      All Rights Reserved  2007.6.1                        
**                                   V1.0                                 
** 声　明:                                                                  
**         以下代码仅提供给网友免费学习使用，非商业用途	                    
****************************************************************************/

#include <QtGui>
#include "window.h"
#include "daemon.h"

Window::Window()
{
	trayIcon = new QSystemTrayIcon(QIcon("tray.svg"), this);
	trayIcon->setToolTip("Online Judge System");
	connect(trayIcon, SIGNAL(activated(QSystemTrayIcon::ActivationReason)),
			this, SLOT(iconActivated(QSystemTrayIcon::ActivationReason)));
	createActions();
	trayIcon->show();

	createLayouts();
	
    	QTimer *timer = new QTimer(this);
    	connect(timer, SIGNAL(timeout()), this, SLOT(showTime()));
    	timer->start(1000);

    	showTime();

	startJudge();

	setWindowTitle(tr("Online Judge System"));	
	resize(400, 300);
}

void Window::closeEvent(QCloseEvent *event)
{
	hide();
	event->ignore();
}

void Window::iconActivated(QSystemTrayIcon::ActivationReason reason)
{
	switch(reason){
	case QSystemTrayIcon::Trigger:
		resize(400, 300);
		show();
		break;
	default:
		;
	}
}

void Window::createActions()
{
	monitorAction = new QAction(tr("Monitor"), this);
	connect(monitorAction, SIGNAL(triggered()), this, SLOT(showNormal()));

	quitAction = new QAction(tr("&Quit"), this);
	connect(quitAction, SIGNAL(triggered()), this, SLOT(waitForQuit()));
	trayIconMenu = new QMenu(this);
	trayIconMenu->addAction(monitorAction);
	trayIconMenu->addAction(quitAction);
	trayIcon->setContextMenu(trayIconMenu);
}

void Window::waitForQuit()
{
	if(isJudgeActivated)
		stopJudge();
	qApp->quit();
}

void Window::startJudge()
{
	if(isJudgeActivated)
		return;

	isJudgeActivated = true;	// 全局变量
	daemon = new Daemon;
	starter = new Starter;
	daemon->start();	
	starter->start();
	//watchDog = new WatchDog;
	//watchDog->start();
	trayIcon->showMessage("Online Judge System", "The online judge system is runing.");	

	startButton->setEnabled(false);
	stopButton->setEnabled(true);
}

void Window::stopJudge()
{
	if(!isJudgeActivated)
		return;

	isJudgeActivated = false;
	daemon->quit();
	starter->quit();
	//watchDog->quit();
	daemon = 0;
	starter = 0;
	//watchDog = 0;
	trayIcon->showMessage("Online Judge System", "The online judge system has stopped.");
	startButton->setDisabled(false);
	stopButton->setDisabled(true);
}

void Window::createLayouts()
{
	QLabel *contestTimeLabel = new QLabel(tr("Contest Time: "));
	contestTime = QDateTime::currentDateTime();
	QDateTimeEdit *contestDateTime = new QDateTimeEdit(contestTime);
	connect(contestDateTime, SIGNAL(dateTimeChanged(const QDateTime &)), this, SLOT(getContestTime(const QDateTime &)));

    	QHBoxLayout *hcbox = new QHBoxLayout;
	hcbox->addStretch(1);
    	hcbox->addWidget(contestTimeLabel);
    	hcbox->addWidget(contestDateTime);
    	hcbox->addStretch(1);
	
	QLabel *lengthLabel = new QLabel(tr("Length: "));
	contestLength = QTime(5, 0);
	QTimeEdit *lengthTime = new QTimeEdit(contestLength);
	connect(lengthTime, SIGNAL(timeChanged(const QTime &)), this, SLOT(getContestLength(const QTime &)));

    	QHBoxLayout *hcbox1 = new QHBoxLayout;
	hcbox1->addStretch(1);
    	hcbox1->addWidget(lengthLabel);
    	hcbox1->addWidget(lengthTime);
    	hcbox1->addStretch(1);

	currentTimeLabel = new QLabel;
	timeRemainsLabel = new QLabel;

   	startButton = new QPushButton(tr("Start"));
	stopButton = new QPushButton(tr("Stop"));
	quitButton = new QPushButton(tr("Quit"), this);

	connect(startButton, SIGNAL(clicked()), this, SLOT(startJudge()));
	connect(stopButton, SIGNAL(clicked()), this, SLOT(stopJudge()));
	connect(quitButton, SIGNAL(clicked()), this, SLOT(waitForQuit()));

    	QHBoxLayout *hbox = new QHBoxLayout;
	hbox->addStretch(1);
    	hbox->addWidget(startButton);
    	hbox->addWidget(stopButton);
	hbox->addWidget(quitButton);
    	hbox->addStretch(1);

	QVBoxLayout *vbox = new QVBoxLayout;
	vbox->addStretch(1);
	vbox->addLayout(hcbox);
	vbox->addLayout(hcbox1);
	vbox->addWidget(currentTimeLabel);
	vbox->addWidget(timeRemainsLabel);
	vbox->addLayout(hbox);
	vbox->addStretch(1);

    	setLayout(vbox);
}

void Window::showTime()
{
	QTime time = QTime::currentTime();
	QString text = tr("Current Time: ");
	text.append(time.toString("hh:mm:ss"));
	currentTimeLabel->setAlignment(Qt::AlignCenter);
	currentTimeLabel->setText(text);
	remainTime();
}

void Window::remainTime()
{
	int rt = QDateTime::currentDateTime().secsTo(contestTime);
	int ct = -(contestLength.secsTo(QTime(0, 0)));
	QString tempString;
	timeRemainsLabel->setAlignment(Qt::AlignCenter);

	if(rt >= 0)
	{
		// 比赛未开始
		tempString = tr("Time remains to contest ");
		tempString.append(toDateTimeString(rt));
		timeRemainsLabel->setText(tempString);
	}
	else if(rt >= -ct)
	{
		// 比赛进行中
		tempString = tr("Time remains to contest finished ");
		tempString.append(toDateTimeString(ct + rt));
		timeRemainsLabel->setText(tempString);
	}
	else
	{
		// the contest has finished
		tempString = tr("the contest has finished");
		timeRemainsLabel->setText(tempString);
	}
}

QString Window::toDateTimeString(int secs)
{
	int temp = 0;
	QString dtString = tr(" second");
	temp = secs % 60;
	dtString.prepend(QString::number(temp));
	if(secs >= 60)
	{
		secs /= 60;
		dtString.prepend(tr(" minute "));
		temp = secs % 60;
		dtString.prepend(QString::number(temp));
		
		if(secs >= 60)
		{
			secs /= 60;
			dtString.prepend(tr(" hour "));
			temp = secs % 60;
			dtString.prepend(QString::number(temp));
			if(secs >= 24)
			{
				secs /= 24;
				dtString.prepend(tr(" day "));
				dtString.prepend(QString::number(secs));
			}
		}
	}
	
	return dtString;
}

bool Window::event(QEvent *event)       
{      
     if(event->type() == QEvent::WindowStateChange)      
     {               
         if (event->spontaneous() && isMinimized()) {
              hide();
              setWindowFlags(Qt::X11BypassWindowManagerHint);         
              return true;              
          }              
          else              
              QWidget::event(event);          
      }           
      else              
          QWidget::event(event);
      return false;
}


