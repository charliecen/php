<?php
header("Content-type:text/html;charset=utf-8");
function p($data){
	echo '<pre>';	
	print_r($data);
}

//连接数据库
$link = mysql_connect('localhost','root','') or die('数据库连接失败');
//var_dump($link);

//选择数据库
mysql_query("use message");

//设置字符编码
mysql_query("set names utf8");

//总条目数
$rs2 = mysql_query("select count(*) from message;");
$total = mysql_fetch_row($rs2);
$total = $total[0];
//echo $total;

//每页条数
$pagesize = 5;

//总页数 = 总条目数 / 每页条数
$allpage = ceil($total / $pagesize);

//当前页从地址栏参数获取
$pageno = isset($_GET['pageno']) ? $_GET['pageno'] : 1;

//起始页 = (当前页 - 1) * 5
$startpage = ($pageno - 1) * $pagesize;

//查询的资源赋值给$rs
$rs = mysql_query('select * from message order by id desc limit '.$startpage.','.$pagesize.';');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
#message {
	width: 80%;
	border: #ccc 1px solid;
	margin: auto;	
}

</style>
</head>

<body>
<h1><a href="./add.html">留言</a></h1>
<hr />
<h1 align="center">留言板</h1>
<table border="1" cellspacing="0" cellpadding="8" id="message">
    <tr><th>编号</th><th>昵称</th><th>时间</th><th>内容</th><th>编辑</th></tr>
    
    
    <?php while($data_arr = mysql_fetch_assoc($rs)){
        echo '<tr>';
        echo '<td width="40">'.$data_arr['id'].'</td>';
        echo '<td width="40">'.$data_arr['nickname'].'</td>';
        echo '<td width="40">'.date('Y/m/d',$data_arr['addtime']).'</td>';
        echo '<td>'.$data_arr['content'].'</td>';
		echo '<td width="40">';
			echo '<a href="http://test.com/day4/info.php?id='.$data_arr['id'].'">查看</a>';
			echo '<a href="http://test.com/day4/del.php?id='.$data_arr['id'].'">删除</a>';
		echo '</td>';
        echo '</tr>';
    
    }
	
    ?>
    <tr>
    	<td colspan="4" align="right">第<?php echo $pageno,'/',$allpage ?>页 共<?php echo $total?>条数据
        	<a href="http://test.com/day4/index.php?pageno=1" >首页</a>
            <a href="http://test.com/day4/index.php?pageno=<?php echo $pageno<=1 ? 1 : $pageno-1;?>">上一页</a>
            <a href="http://test.com/day4/index.php?pageno=<?php echo $pageno>=$allpage ? $allpage : $pageno+1?>">下一页</a>
            <a href="http://test.com/day4/index.php?pageno=<?php echo $allpage ?>">末页</a>     
        </td>
    </tr>
</table>
</body>
</html>
