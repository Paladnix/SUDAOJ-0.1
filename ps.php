<?php
require('head.php');
$cid = $_GET['cid'];
$visable = $_GET['visable'];
if($cid == "")
    $cid = 0;
if($visable == "")
    $visable = 1;
?>
<div class="container" style="margin-top:100px;">
<div class="col-sm-2"></div>
<div class="col-sm-8" style="padding-top:0px">
	<div class="panel panel-default">
	<div class="panel-heading"><h4>添加题目</h4></div>
		<div class="panel-body" style="padding-top:20px">

		<?php
			echo '<form class="form-horizontal" method="POST" action="psp.php?cid='.$cid.'&visable='.$visable.'" enctype="multipart/form-data">';
		?>
				<div class="form-group">
					<label class="col-lg-2 control-label">题目名称</label>
					<div class="col-lg-10">
						<input type="name" placeholder="eg: water problem" class="form-control" name=proname>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">时限(C++)</label>
					<div class="col-lg-10">
						<input type="number" placeholder="毫秒" class="form-control" name=timeLimit>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">内存限制</label>
					<div class="col-lg-10">
						<input type="memory" placeholder="MB" class="form-control" name=memoryLimit>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">出题人</label>
					<div class="col-lg-10">
						<input type="memory" placeholder="" class="form-control" name=author>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">题目描述</label>
					<div class="col-lg-10">
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
