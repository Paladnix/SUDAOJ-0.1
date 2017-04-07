drop database SDOJ;
create database SDOJ;
use SDOJ;

create table UserRegister(
	username varchar(32),
	password varchar(32),
	trueName varchar(32),
	email varchar(50),
	sex varchar(10),
	birthday date,
	telephoneNumber varchar(32),
    primary key(username)
);

create table ProblemLib(
	pid int auto_increment,
	problemName varchar(50),
	ratio float default '0.00',
	accepted int default '0',
	submited int default '0',
	context blob,
	input blob,
	output blob,
	inputCase blob,
	outputCase blob,
	filein varchar(100),
	fileout varchar(100),
	timeLimit float,
	memoryLimit int,
	author varchar(50),
	contest varchar(100),
	visable int default '0',
	primary key(pid)
);

create table Status(
	runID int unsigned auto_increment,
	problemID int, 
	judgeStatus varchar(50), 
	rtime float,
	rmemory int,
	author varchar(32),
	compiler varchar(10),
	submitTime time,
	codeLength int,
    contest int,
	primary key(runID)
);

create table Contest(
	cid int unsigned auto_increment,
	cname varchar(100),
	timeStart time,
	timeEnd time,
	pw varchar(20),
    problems varchar(1024),
	author varchar(50),
	primary key (cid)
);

create table Contest_member(
	contest int,
    member int,
	primary key(contest, member)
);
