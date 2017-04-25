# 测评核心

测评部分根据不同的语言使用不同的脚本进行测试。

测试时使用较低级别的用户运行程序Judge。Judge用户不具有其他文件的写权限。别的用户的文件不能开放文件写权限，之能开放文件读权限。

由PHP启动内核，内核做的事情就是运行程序，并监控程序程序的运行状态，超时超空间。

内核入口是个脚本，脚本使用Judge用户权限启动，脚本设置时间和空间，并启动程序。

编译工作由php做， 内核脚本接受参数：pid, rid, timelimit, memorylimit

通过进程名称监控进程的时间和空间, 程序用来启动进程后台运行。

要获得程序具体的运行时间必须使用time命令。




# 目录构成
problemIO/  ---- 题目的输入文件 proID
 \_ proID/
     \_ IN
     \_ OUT

    userCode目录在judge用户的home下：/home/judge/userCode/
userCode/  ----  用户提交的程序 runID
 \_ RunID/
     \_ *.cpp
     \_ *.java
     \_ *.py
     \_ runID -- 编译后文件
     \_ out  -- 输出文件
