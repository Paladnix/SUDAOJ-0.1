/***************************************************************************
**											
**                                松牛 出品    
**                          http://sonew.512j.com/                          
**                      All Rights Reserved  2007.6.1                        
**                                   V1.0                                 
** 声　明:                                                                  
**         以下代码仅提供给网友免费学习使用，非商业用途	                    
****************************************************************************/

#include "compiler.h"
#include <QtCore>

void Compiler::execute()
{
	QProcess  compilerProcess;
	compilerProcess.start(compiler, compilerOption);
	if(!compilerProcess.waitForStarted())
		qDebug("Failed to start the compiling process.");

	if(!compilerProcess.waitForFinished())
		qDebug("the compiling process maybe crashed.");

	QByteArray result = compilerProcess.readAllStandardError();
	if(result.isEmpty())
	{
		qDebug("compiling OK.");
		judgeStatus = "Compile OK";
	}
	else
	{
		qDebug("Compile Error");
		judgeStatus = "Compile Error";
		ErrorInfo = result;
	}
}
