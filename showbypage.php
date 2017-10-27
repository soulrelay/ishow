<?php
//获取演出列表（分页功能）
//1 连接数据库服务器
$conn = mysql_connect("localhost", "root", "root") or die("connect failed!" . mysql_error());
//var_dump($conn);
mysql_query("SET NAMES UTF8");

//2 连接数据库
mysql_select_db("ShowDB", $conn) or die("select db failed" . mysql_error());
//3 执行SQL 语句
//获取get参数
$cityname = $_GET["city"];
$type = $_GET["type"];
$page = $_GET["page"];

$sql = "select t_show.show_id,t_show.show_title,t_show.show_image,t_show.show_time,t_show.show_price,t_show.show_city,t_place.place_name from t_show,t_place where t_show.place_id=t_place.place_id";
if ($type) {
    $sql = $sql . " and type_id=$type";
}

if ($cityname) {
    $sql = $sql . " and t_show.show_city='$cityname'";
}


//添加分页功能
$pageCount = 2;//一页显示多少条
//注意 中英文的括号问题 带来的 语法问题
$offset = ($page - 1) * $pageCount;//当前的偏移量
$sql = $sql . " limit $offset,$pageCount";
$result = mysql_query($sql);

//4 获取执行结果
$array = array();
$i = 0;
while ($row = mysql_fetch_array($result)) {
    // var_dump($row);
    // echo "<br/>";
    $array[$i]["show_id"] = $row["show_id"];
    $array[$i]["show_title"] = $row["show_title"];
    $array[$i]["show_image"] = $row["show_image"];
    $array[$i]["show_time"] = $row["show_time"];
    $array[$i]["show_price"] = $row["show_price"];
    $array[$i]["place_name"] = $row["place_name"];
    $i++;
}
//var_dump($array);
//5 关闭数据库
mysql_close($conn);

//6 返回JSON
$json = json_encode(
    array(
        "resultCode" => 200,
        "message" => "success!",
        "data" => $array
    ));
echo($json);


?>