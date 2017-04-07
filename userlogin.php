<?php
include('head.php');
?>
<div class="container" style="background-image:url(img/bg.png); height:720px">
<div class="col-sm-3"></div>
<div class="col-sm-6" style="padding-top:100px">
	<div class="panel panel-default">
		<div class="panel-heading">User Login</div>
		<div class="panel-body" style="padding-top:20px">
			<form class="form-horizontal" method="post" action="ul.php">
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
					<div class="col-lg-offset-2 col-lg-10">
						<div class="checkbox c-checkbox">
							<label>
								<input type="checkbox" checked="">
								<span class="fa fa-check"></span>Remember me</label>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<button type="submit" class="btn btn-sm btn-default">Sign in</button>
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
