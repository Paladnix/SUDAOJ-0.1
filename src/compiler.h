/***************************************************************************
**											
**                                松牛 出品    
**                          http://sonew.512j.com/                          
**                      All Rights Reserved  2007.6.1                        
**                                   V1.0                                 
** 声　明:                                                                  
**         以下代码仅提供给网友免费学习使用，非商业用途	                    
****************************************************************************/

#ifndef COMPILER_H
#define COMPILER_H

#include <QtCore>

class Compiler{
public:
	Compiler(const QString &cr = "g++") { compiler = cr; }
	void setCompilerOption(const QStringList &cn) { compilerOption = cn; }
	QString getStatus() const { return judgeStatus; }
	QByteArray getErrorInfo() const { return ErrorInfo; }
	void execute();
private:
	QString compiler;
	QStringList compilerOption;
	QString judgeStatus;
	QByteArray ErrorInfo;
};

#endif
