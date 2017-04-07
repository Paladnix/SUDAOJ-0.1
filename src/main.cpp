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
#include "connectsql.h"

int main(int argc, char *argv[])
{
	QApplication app(argc, argv);
    	if (!createConnection())  //connect to the database.
        	return 1;
	Window window;
	window.show();
	return app.exec();
}


