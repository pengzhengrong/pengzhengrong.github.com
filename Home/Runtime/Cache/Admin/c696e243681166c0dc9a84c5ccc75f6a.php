<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" href="__PUBLIC__/Admin/Css/public.css" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<script type="text/javascript" src="__PUBLIC__/Admin/Js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="__PUBLIC__/Admin/Js/login.js"></script>
		<script type="text/javascript">
			var code_url = "<?php echo U('/Admin/Login/verify','','');?>";
		</script>
	</head>
	<body>
		<form action="<?php echo U('Admin/User/user_add','','');?>" method="post" >
			<table class="table"> 
				<tr>
					<td>USER_NAME</td>
					<td><input  name="name"  /></td>
				</tr>
				<tr>
					<td>PASSWORD</td>
					<td><input  name="remark"  /></td>
				</tr>
			</table>
			<input  type="submit" value="SUBMIT" />
		</form>
	</body>
</html>