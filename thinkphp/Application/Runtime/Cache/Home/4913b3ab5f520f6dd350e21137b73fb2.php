<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<!-- <?php if($data["sex"] == 0): ?>男
		<?php elseif($data["sex"] == 1): ?>
			女
			<?php else: ?>
			未知<?php endif; ?>

	<?php switch($data["sex"]): case "0": ?>男<?php break;?>
		<?php case "1": ?>女<?php break;?>
		<?php default: ?>未知<?php endswitch;?> -->
	<!-- 
	<select id="" name="" onchange="" ondblclick="" class="" ></select> -->
	<!-- <form action="/thinkphp/Home/Index/index" enctype="multipart/form-data" method="post" >
		<input type="file" name="photo" />
		<button>提交</button>
	</form> -->
	<form action="">
		<?php echo L('form_user');?>  //一种方法
		<?php echo (L("form_user")); ?><input type="text">  //第二种方法
		<br/>
		<?php echo (L("form_pwd")); ?><input type="password">
		<br/>
		<?php echo (L("form_email")); ?><input type="text">
		<br/>
		<button><?php echo (L("form_submit")); ?></button>
		<br/>
	</form>
</body>
</html>