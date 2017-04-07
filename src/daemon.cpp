/***************************************************************************
**											
**                                松牛 出品    
**                          http://sonew.512j.com/                          
**                      All Rights Reserved  2007.6.1                        
**                                   V1.0                                 
** 声　明:                                                                  
**         以下代码仅提供给网友免费学习使用，非商业用途	                    
****************************************************************************/

/********************************************************************
**
** 通过使用两个线程并发地执行评判任务。类似于生产者--消费者模型，其中
** Daemon 是生产者，Starter 是消费者。可以是一个生产者，多个消费者，使得
** 可以开启多个评判程序并行的执行任务，或是基于网络的多服务器相对独立的并行
** 工作。必须采取相应的互斥访问机制以避免一个题目被重复的评判。
**
** 以下程序暂时实现一对一的生产，消费模型。
**
*********************************************************************/

#include <QtCore>
#include <QtSql>
#include "daemon.h"
#include "executer.h"
#include "compiler.h"

const int BufferSize = 50;
int buffer[BufferSize];  
bool isJudgeActivated = false;

QSemaphore freeBuffer(BufferSize); 
QSemaphore usedBuffer;

// 评判监控程序，通过声明类 Compiler 的实例进行编译，声明类 Executer 的
// 实例监控程序运行，测试。并相应的更新数据表信息，主要是表 status, 
// 表 rankList。 

void judge(int id)
{
	QSqlQuery query;
	QString tempString;

	// 获取使用的编程语言。
	query.prepare("select compiler from status  where runID = :id");
	query.bindValue(":id", id);
	query.exec();
	query.first();
	QString languageName = query.value(0).toString();
	QString compilerName;

	// 根据所选的编译器设置相应的编译选项
	QStringList opt;
	if(languageName == "C++")
	{
		compilerName = "g++";
		opt << "-w" << "-o" << "../judge/oexe/temp.exe";
		tempString = "../judge/src/";
		tempString.append(QString::number(id));
		tempString.append(".cpp");
		opt << tempString;
	}
	else if(languageName == "C")
	{
		compilerName = "gcc";
		opt << "-w" << "-o" << "../judge/oexe/temp.exe";
		tempString = "../judge/src/";
		tempString.append(QString::number(id));
		tempString.append(".c");
		opt << tempString;	
	}
	else if(languageName == "Java")
	{
	}
	else	// Pascal
	{
	}

	Compiler compiler(compilerName);
	// set compiler environment & options
	compiler.setCompilerOption(opt);

	compiler.execute();
	tempString = compiler.getStatus();
	if( tempString == "Compile Error" )
	{
		query.prepare("update status set judgeStatus = 'Compile Error', "
			"remarks = :rem where runID = :rid");
		query.bindValue(":rem", compiler.getErrorInfo());
		query.bindValue(":rid", id);
		query.exec();
		// return this function earlier
		return;
	}

	// compile OK, continue
	// first, select the problem ID.
	Executer executer;
	query.prepare("select problemID from status where runID = :rid");
	query.bindValue(":rid", id);
	query.exec();
	query.first();
	QString pidString = query.value(0).toString();	
	// 设置输入文件(stdin)
	tempString = "../judge/cases/in/";
	tempString.append(pidString);
	executer.setInputFile(tempString);
	// 设置输出文件(stdout)
	tempString = "../judge/cases/output/";
	tempString.append(QString::number(id));
	executer.setOutputFile(tempString);
	// 设置执行程序文件
	tempString = "../judge/oexe/";
	tempString.append("temp.exe");
	executer.setExePath(tempString);
	// 设置时间，内存限制参数
	executer.setTimeLimit();
	executer.setMemoryLimit();
	// 设置标准测试答案文件
	tempString = "../judge/cases/out/";
	tempString.append(pidString);
	executer.setTestCasePath(tempString);

	executer.execute();
	qDebug() << executer.getStatus();

	const QTime startTime(11, 30, 0);   //暂时在这里设置一下
	query.prepare("update status set judgeStatus = :js where runID = :rid");
	query.bindValue(":js", executer.getStatus());
	query.bindValue(":rid", id);
	query.exec();

	if( executer.getStatus() == "Accepted" )
	{
		qDebug() << "Accepted, updating the database.\n";
		query.prepare("update problemLib set accepted = accepted + 1, ratio = accepted / submited "
				"where pid = :pid");
		query.bindValue(":pid", pidString.toInt());
		query.exec();
		
		QString team;
		QTime submitTime;
		query.prepare("select author,submitTime from status where runID = :rid");
		query.bindValue(":rid", id);
		query.exec();
		while(query.next())
		{
			team = query.value(0).toString();
			submitTime = query.value(1).toTime();
		}
			
		QString passTime, submitTimes;
		passTime = "passTime_" + pidString;
		submitTimes = "submitTimes_" + pidString;
		
		QString queryString;
		queryString.append("select solvedNumber, contestTime, ");
		queryString.append(passTime);
		queryString.append(", ");
		queryString.append(submitTimes);
		queryString.append(" from rankList where team = '");
		queryString.append(team);
		queryString.append("'");
		qDebug() << queryString;
		query.exec(queryString);
		
		QTime pTime, cTime; //pass time, contest time
		int sNum(0);  //submit times
		int solved(0); //solved number
		int temp;
		while(query.next())
		{
			solved = query.value(0).toInt();
			cTime = query.value(1).toTime();
			pTime = query.value(2).toTime();
			sNum = query.value(3).toInt();
		}
		
		solved += 1;
		sNum = 1 + sNum;
		temp = startTime.secsTo(QTime(0, 0, 0));
		submitTime = submitTime.addSecs(temp);	
		temp = (-sNum) * 1200;
		pTime = submitTime.addSecs(temp);
		
		//update contestTime  !!注意,问题答对了不要重复提交,不然亏死你.
		temp = pTime.secsTo(QTime(0, 0, 0));
		cTime = cTime.addSecs(-temp);
		
		qDebug() << "cTime: " << cTime;
		qDebug() << "solved: " << solved;
		qDebug() << "sNum: " << sNum;
		
		QString updateString;
		updateString = QString("update rankList set solvedNumber = %1, contestTime = \'").arg(solved);
		updateString.append(cTime.toString("HH:mm:ss"));
		updateString.append("\', ");
		updateString.append(passTime);
		updateString.append(" = \'");
		updateString.append(pTime.toString("HH:mm:ss"));
		updateString.append("\', ");
		updateString.append(submitTimes);
		updateString.append(" = ");
		QString str;
		str.setNum(sNum);
		updateString.append(str);
		updateString.append(" where team = \'");
		updateString.append(team);
		updateString.append("\'");
		qDebug() << "updateString" << updateString;
		query.exec(updateString);
	}
}

void Daemon::run()
{
	int i = 0;
	while(isJudgeActivated)
	{		
		// 选取所有未被评判的题目，并将其放入环形缓冲区。
		QSqlQuery query("select runID from status  where judgeStatus = 'Waiting'");
		int index = 0;
		while(query.next())
		{
			index = query.value(0).toInt();
			freeBuffer.acquire();
			buffer[i % BufferSize] = index;
			QSqlQuery q;
			q.prepare("update status set judgeStatus = 'Judging' where runID = :rid");
			q.bindValue(":rid", index);
			q.exec();
			++i;
			usedBuffer.release();
		}
		msleep(500);
	}
}

void Starter::run()
{
	int i = 0;
	while(isJudgeActivated)
	{
		// 选取一个题目进行评判。
		int id;
		usedBuffer.acquire();
		id = buffer[i % BufferSize];
		++i;
		qDebug() << "runID" << id;
		freeBuffer.release();
		judge(id);
	}
}

void WatchDog::run()
{
	QProcess watchDogProcess;
	while(isJudgeActivated)
	{
		watchDogProcess.execute("taskkill /f /im dwwin.exe");
		msleep(1000);
	}
}

