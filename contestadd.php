<?php require('head.php'); ?>


<div class="container" style="margin-top:100px;">
<div class="col-sm-2"></div>
<div class="col-sm-8" style="padding-top:0px">
	<div class="panel">
    <div class="panel-head">
        <h2>添加比赛</h2></div>
		<div class="panel-body" style="padding-top:20px">

			<form class="form-horizontal" method="post" action="addcontest.php" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-lg-2 control-label">比赛名称</label>
					<div class="col-lg-10">
						<input type="name" placeholder="2016 新生赛-1" class="form-control" name=cname>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">开始时间</label>
					<div class="col-lg-10">
						<input type="datetime-local" placeholder="" class="form-control" name=timeStart>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">结束时间</label>
					<div class="col-lg-10">
						<input type="datetime-local" placeholder="" class="form-control" name=timeEnd>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">密码</label>
					<div class="col-lg-10">
						<input type="ID" placeholder="" class="form-control" name=pw>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<button type="submit" class="btn btn-sm btn-default">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="col-sm-3"></div>
</div>

<?php
require_once('foot.php');
?>
