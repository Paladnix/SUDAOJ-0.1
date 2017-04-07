<?php
include('head.php');
?>

<div class="container" style="background-image:url(img/bg.png); height:720px">
<div class="col-sm-3"></div>
<div class="col-sm-6" style="padding-top:100px">
	<div class="panel panel-default">
		<div class="panel-heading">User Register</div>
		<div class="panel-body" style="padding-top:20px">
			<form class="form-horizontal" method="post" action="userregister.php">
				<div class="form-group">
					<label class="col-lg-2 control-label">UserName</label>
					<div class="col-lg-10">
						<input type="username" placeholder="Username" class="form-control" name=username>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Password</label>
					<div class="col-lg-10">
						<input type="password" placeholder="Password" class="form-control" name=password>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">RePassword</label>
					<div class="col-lg-10">
						<input type="password" placeholder="Repeat Password" class="form-control" name=passwordrepeat>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">TrueName</label>
					<div class="col-lg-10">
						<input type="name" placeholder="True Name" class="form-control" name=trueName>
					</div>
				</div>
				<div class="from-group col-lg-12">
					<label class="col-lg-1 control-label">Sex</label>
					<label class="col-lg-3 control-label">
						<input type="radio" name=sex value="M" checked="">
						<span class="fa fa-circle"></span>Male</label>
					<label class="col-lg-3 control-label">
						<input type="radio" name=sex value="F" checked="">
						<span class="fa fa-circle"></span>Famale</label>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Telephone</label>
					<div class="col-lg-10">
						<input type="telephone" placeholder="Telephone" class="form-control" name=telephone>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Email</label>
					<div class="col-lg-10">
						<input type="email" placeholder="Email" class="form-control" name=email>
					</div>
				</div>

				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<button type="submit" class="btn btn-sm btn-default">Register</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="col-sm-3"></div>
</div>

<?php
include('foot.php');
?>
