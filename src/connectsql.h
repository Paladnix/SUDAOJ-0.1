/***************************************************************************
**											
**                                松牛 出品    
**                          http://sonew.512j.com/                          
**                      All Rights Reserved  2007.6.1                        
**                                   V1.0                                 
** 声　明:                                                                  
**         以下代码仅提供给网友免费学习使用，非商业用途	                    
****************************************************************************/

#ifndef CONNECTSQL_H
#define CONNECTSQL_H

#include <QSqlDatabase>
#include <QSqlError>
#include <QObject>

static bool createConnection()
{
   	QSqlDatabase db = QSqlDatabase::addDatabase("QMYSQL");
	QSettings settings("../config.ini", QSettings::IniFormat, qApp);
	QString db_database = settings.value("dbName").toString();
	QString db_username = settings.value("dbUserName").toString();
	QString db_password = settings.value("dbPassWord").toString();

	db.setDatabaseName(db_database);
	db.setUserName(db_username);
	db.setPassword(db_password);

   	if (!db.open()) 
	{
    		if (!db.open()) {
        		QMessageBox::critical(0, qApp->tr("Cannot open database"),
            			qApp->tr("Unable to establish a database connection.\n"
                     		"This example needs SQLite support. Please read "
              	       	"the Qt SQL driver documentation for information how "
              	       	"to build it.\n\n"
             		        	"Click Cancel to exit."), QMessageBox::Cancel);
        		return false;
    		}
   	}

    return true;
}

#endif
