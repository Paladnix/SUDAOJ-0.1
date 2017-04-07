<?php
session_start();
$uname = "";
if(isset($_SESSION['uname']))
    $uname = $_SESSION['uname'];
?>

<!DOCTYPE html>

<html>
<head>
 <meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
 <title> Soochow University</title>

<!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css" />
<!-- 可选的Bootstrap主题文件（一般不用引入） -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="/sudaOJ/css/theme.css" />

</head>


<body style="width:100%;">
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/sudaOJ/index.php">Online Judge</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="/sudaOJ/problemlist.php">Problem</a></li>
            <li><a href="/sudaOJ/ranklist.php">Ranklist</a></li>
            <li><a href="/sudaOJ/contestlist.php">Contest</a></li>
            <li><a href="/sudaOJ/blog.php">Blog</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="/sudaOJ/ps.php">Add Problem</a></li>
                <li><a href="/sudaOJ/contestadd.php">Add Contest</a></li>
                <li><a href="http://v3.bootcss.com/examples/theme/#"></a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="http://v3.bootcss.com/examples/theme/#">Separated link</a></li>
                <li><a href="http://v3.bootcss.com/examples/theme/#">One more separated link</a></li>
              </ul>
			</li>
		  </ul>
		  <ul class="nav navbar-nav navbar-right">
			<?php if($uname == "" )
    			 echo '<li><a href="/sudaOJ/userlogin.php">Login</a></li><li><a href="/sudaOJ/userregisterhtml.php">Register</a></li>';
			 else echo '<li><a href="/sudaOJ/user.php">'.$uname.'</a></li><li><a href="/sudaOJ/logout.php">Logout</a></li>';
			?>
	 	  </ul>
        </div>
      </div>
    </nav>
