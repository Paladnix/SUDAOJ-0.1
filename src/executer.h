/***************************************************************************
**											
**                                松牛 出品    
**                          http://sonew.512j.com/                          
**                      All Rights Reserved  2007.6.1                        
**                                   V1.0                                 
** 声　明:                                                                  
**         以下代码仅提供给网友免费学习使用，非商业用途	                    
****************************************************************************/

#ifndef EXECUTER_H
#define EXECUTER_H

#include <QtCore>
class Executer{
public:
	Executer() {};
	void setInputFile(const QString &file) { inputFile = file; }
	void setOutputFile(const QString &file) { outputFilePath = file; }
	void setExePath(const QString &path) { exePath = path; }
	void setTimeLimit(int limit = 1000) { timeLimit = limit; }
	void setMemoryLimit(int limit = 32) { memoryLimit = limit; }
	void setTestCasePath(const QString &path) { testCasePath = path; }
	void execute();	
	void checkRuningStatus();
	void test();
	bool checkPresentation();
	QString getStatus() const { return judgeStatus; }

private:
	int timeLimit;
	int memoryLimit;
	QString exePath;
	QString inputFile;
	QString outputFilePath;
	QString testCasePath;
	QProcess *execProcess;
	QString judgeStatus;
};

#endif
