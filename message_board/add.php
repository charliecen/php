<?php 

header("Content-type:text/html;charset=utf-8");
function p($data){
	echo '<pre>';	
	print_r($data);
}

//判断表单提交数据是否设置，如果设置就赋值，没有设置就为空
$nickname = isset($_POST['nickname']) ? $_POST['nickname'] : '';
$content = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : '';

//判断变量是否为空，如果是空就提示信息不全，并返回。
if(empty($nickname) || empty($content)){
	echo '用户信息不全','<a href="./add.html">返回</a>';
	die;	
}

//提交数据要插入数据库，首先连接数据库
$link = @mysql_connect('localhost','root','') or die('数据库连接失败');

//选择数据库
mysql_query('use message');

//设置字符编码
mysql_query('set names utf8');

//插入sql语句
$sql = "insert into message values(null,'".$nickname."','".time()."','".$content."')";

//执行sql并赋值给$into
$into = mysql_query($sql);

//判断是否成功，如果成功就跳转到首页，失败就返回
if($into){
	echo '数据插入成功',header("location: ./index.php");	
}else{
	echo '数据插入失败','<a href="./add.html">返回</a>';	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
</body>
</html>
