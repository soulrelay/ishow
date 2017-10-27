<?php
//1 连接数据库服务器
$conn = mysql_connect("localhost", "root", "root") or die("connect failed!" . mysql_error());
mysql_query("SET NAMES UTF8");
//2 连接数据库
mysql_select_db("ShowDB", $conn) or die("select db failed" . mysql_error());