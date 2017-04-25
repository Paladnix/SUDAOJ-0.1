<?php
/*
 *  uname       - 用户名
 *  pid         - 题目编号
 *  compiler    - 编译器
 *  runID       - 判题编号
 *  codePath    - 存放用户源代码的文件夹路径
 *  codeFile    - 用户源代码存在本地的文件名
 *  time        - 题目的时间限制
 *  memory      - 题目的内存限制
 *  Code        - 源代码的完整路径
 *  IN          - 标准输入文件路径
 *  OUT         - 标准输出文件路径
 *  out         - 用户输出文件路径
 *  Compile_out - 编译后可执行文件路径
 */


    require('config.php');
    require('judge.php');

    session_start();

/*
 * [ 获取用户名 ]
 */ 

    if(!isset($_SESSION['uname']))

        header("Location:userlogin.php");

    else $uname = $_SESSION['uname'];


/*
 * [ 获取题目pid ]
 */

    $pid = $_GET['pid'];

/* 
 * [ 获取语言类型 ]
 */

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $compiler = $_POST['compiler'];
    }
    else 
    {   
        header("location:Error.php?error=There is something error. Please submit again.");
    }
    
/*
 *  [ 更新状态数据库 ]
 */

    $DB = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if($DB->connect_error)

        header("Location:Error.php?error=Can't link to the SQL; Please connect the Administrator.&code=1");

    $time = date("h:i:sa-Y-m-d");

    $sql = "insert into Status (problemID, submitTime, author, compiler) values ('$pid','$time','$uname','$compiler'); select @@IDENTITY as ID;";

    $result = $DB->query($sql);

    $row = $result->fetch_assoc();

    $runID = $row['ID'];

    $codePath = "/home/judgeadmin/userCode/".$runID."/";


    if( ! is_dir($fpath) )
    
        if( ! mkdir($codePath) )
            
            header("Location:Error.php?error=mkdir $codePath failed");

    chmod($codePath, 0744);

    if($compiler == "g++")

        $codeFile = $runID.".cpp";

    else if($compiler == "javac" )
    {
        $codeFile = $_FILES['code']['name'];
    }
    else if($compiler == 'python3')
    {
        $codeFile = $runID.".py";
    }
    else  $codeFile = 1;

    if(!move_uploaded_file($_FILES['code']['tmp_name'], $codePath.$codeFile))
    
        echo "Upload file failed.<br>";
    
    else echo "Upload file success.<br>";


/*
 * [ 修改题目提交数据 ]
 */

    $sql = "update ProblemLib set submited=submited+1 where pid = '$pid';";
    
    $result = $DB->query($sql);
    
    if( $result <= 0 )
    {    
        echo "Update Submit Error<br>";
       
        header("Location:problemlist.php");
    }

/* 
 * [ 提取题目限制 ]
 */
 
    $sql = "select timeLimit, memoryLimit from ProblemLib where pid = $pid;";

    $result = $DB->query($sql);

    $row = $result->fetch_assoc();

    $time = $row['timeLimit'];

    $memory = $row['memoryLimit'];
    
/*
 *  [ Judge ]
 */

    $Code = $codePath.$codeFile;

    $IN = "/home/judgeadmin/problemIO/".$pid."/IN";
    
    $OUT = "/home/judgeadmin/problemIO/".$pid."/OUT";

    $Compile_out = "home/judge/userExe/".$runID."/";

    if( ! is_dir($Compile_out) )

        if( ! mkdir($Compile_out) 

            header("Location:Error.php?error=mkdir $Compile_out failed");
            
    chmod($Compile_out, 0774);
    
    $user_out = "home/judge/userOut/";

    $Judge = new Judge($pid, $runID, $Code, $compiler, $IN, $OUT, $time, $memory, $Compile_out, $user_out);

/*
 *  [ Compile ]
 */
   
    $result = $Judge->Compile( $codeFile );

    if($result != 0)
    {
        header("Location:problem.php?pid=$pid&status=Compiler Error");
    }

/*
 *  [ Run & Judge ]
 */
    
    $result = $Judge->Run();
 
    if($result == "Time Limit Error")
    {
        header("Location:problem.php?pid=$pid&status=Time Limit Error");
    }
    else if($result == "Memory Limit Error")
    {
        header("Location:problem.php?pid=$pid&status=Memory Limit Error");
    }
    else if($result[0] == 'N')
    {
        header("Location:problem.php?pid=$pid&status=Run Time Error")
    }
    else if($result[0] == 'Y')
    {
        $time_use = substr($result, 1 , strpos($result, ",") - 2 );

        $memory_use = substr($result, strpos($result, ",") );
    }


    $result = $Judge->Check();

    if($result == "Accepted")
    {
        header("Location:problem.php?pid$pid&status=Accepted&time=$time_use&memory=$memory_use");
    }
    else if($result == "Wrong Answer")
    {
        header("Location:problem.php?pid=$pid&status=Wrong Answer");
    }

?>
