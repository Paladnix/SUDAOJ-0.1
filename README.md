苏州大学 在线程序评测系统。

- Main Author: Paladnix
- E-mail: Paladnix@outlook.com
- Team: Soochow University Microsoft Students Club(SUMSC)

 第一版，主要做部件功能探测，整体框架熟悉，为第二版本打基础。
 
 第二版本将使用PHP微框架Husky开发，并在开发过程中不断优化Husky框架。
 
 SUDAOJ-0.2 (Coding...):
 
 https://github.com/Paladnix/SUDAOJ-0.2.git
 
 https://github.com/SUMSC/SUDAOJ-0.2.git
 




敏感的安全信息做了隐藏，不在本项目中体现；如有关于安全的建议请联系作者，十分感谢。


# 主要功能：
- 自主命题，添加题目和数据
- 自主开设比赛，题目可以新建也可以从题库中选取
- 系统保留成功通过的代码可以回看
- 导出个人成功通过的代码

# 适用范围：
- ACM-ICPC形式的比赛、训练
- C/C++、python等的客观题作业评测
- 有关公司或实验室上机笔试、训练


# 技术组成：
- 前端使用bootstrap框架、JQuery，并往AngularJS迁移。
- 后台简单数据处理使用PHP7.0
- 数据库使用mysql
- 测评内核目前使用php，但是存在一些问题，正在迁移到C++做测评内核。
- 服务器目前在阿里云 Ubuntu14.04

# 前端组成：
- 首页
- 题目列表
- 比赛列表
- 题目页
- 提交记录
- 比赛实时
- 个人页
- 添加比赛
- 添加题目
- 注册、登录


# 未来规划：
- 多线程测评
- 分布式测评


# 服务器端文件存储：

localhost/
 \_ *.php
 \_ *.html
 \_ core/
     \_ judge.sh


/home/
 \_ judgeadmin/

     \_ problemIO/

         \_ proID/

             \_ IN
             \_ OUT

     \_ userCode/

         \_ runID/

             \_ runID.cpp
             \_ class.java
             \_ runID.py


/home/
\_ judge/

    \_ userOut/
       
        \_ runID.out
    
    \_ userExe/

        \_ runID
        \_ class


# 用户
    judgeadmin 做为网站主要用户
    judge 作为群组用户，权限较低。
