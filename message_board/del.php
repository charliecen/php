<?php

header("Content-type:text/html;charset=utf-8");
function p($data){
	echo '<pre>';	
	print_r($data);
}

//判断地址栏是否设置id，如果设置就转化过滤id后面的所有字符为数字，否则为空
$id = isset($_GET['id']) ? intval($_GET['id']) : '';


//判断id的值是否为空，如果为空，就提示并退出
if(empty($id)){
	echo '地址栏id没有值';
	die;
}


//提交数据要插入数据库，首先连接数据库
$link = @mysql_connect('localhost','root','') or die('数据库连接失败');

//选择数据库
mysql_query('use message');

//设置字符编码
mysql_query('set names utf8');

$sql = "delete from message where id=".$id;

$del = mysql_query($sql);
//p($del);

if($del){
	echo '<script>alert("删除成功")</script>';
	header("location: ./index.php");
}else{
	echo '<script>alert("删除失败")</script>';	
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
