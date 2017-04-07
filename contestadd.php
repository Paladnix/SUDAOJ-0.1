<?php
require('head.php');
?>
<div class="container" style="margin-top:100px;">
<div class="col-sm-2"></div>
<div class="col-sm-8" style="padding-top:0px">
	<div class="panel panel-default">
	<div class="panel-heading"><h4>添加比赛</h4></div>
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
				<!--
				<div class="form-group">
					<label class="col-lg-2 control-label">题目描述</label>
					<div class="col-lg-10">
				
					   <script type="text/javascript" charset="utf-8" src="editer/ueditor.config.js"></script>
					   <script type="text/javascript" charset="utf-8" src="editer/ueditor.all.min.js"> </script>
					   <script type="text/javascript" charset="utf-8" src="editer/lang/zh-cn/zh-cn.js"></script>
					<div>
						<script id="editor" type="text/plain" style="width:100px;height:200px;"></script>
					</div>
					
						<textarea type="text" class="form-control" style="height:150px" name=problem>
						</textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Input</label>
					<div class="col-lg-10">
						<textarea type="text"  class="form-control" style="height:100px" name=input>
						</textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Output</label>
					<div class="col-lg-10">
						<textarea type="text" class="form-control" style="height:100px" name=output>
						</textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Sample Input</label>
					<div class="col-lg-10">
						<textarea type="text"  class="form-control" style="height:100px" name=Sinput>
						</textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Sample Output</label>
					<div class="col-lg-10">
						<textarea type="text" class="form-control"style="height:100px" name=Soutput>
						</textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-2 control-label">读入文件</label>
					<div class="col-lg-10">
						<input type="file" class="" name="fileIN">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">输出文件</label>
					<div class="col-lg-10">
						<input type="file"  class="" name="fileOUT">
					</div>
					</div>-->
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
