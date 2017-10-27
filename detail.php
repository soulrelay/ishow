<?php
//获取演出详情信息
//1 连接数据库服务器
$conn = mysql_connect("localhost", "root", "root") or die("connect failed!" . mysql_error());

mysql_query("SET NAMES UTF8");

//2 连接数据库
mysql_select_db("ShowDB", $conn) or die("select db failed" . mysql_error());

//获取get参数
$showid = $_GET["showid"];
//3 执行SQL 语句
$sql = "select t_show.show_id,t_show.show_title,t_show.show_image,t_show.show_time,t_show.show_price,t_show.show_city,t_place.place_name from t_show,t_place where t_show.place_id=t_place.place_id and t_show.show_id=$showid";
$result = mysql_query($sql);

//4 获取执行结果
$array = array();
while ($row = mysql_fetch_array($result)) {
    // var_dump($row);
    // echo "<br/>";
    $array["show_id"] = $row["show_id"];
    $array["show_title"] = $row["show_title"];
    $array["show_image"] = $row["show_image"];
    $array["show_time"] = $row["show_time"];
    $array["show_price"] = $row["show_price"];
    $array["place_name"] = $row["place_name"];
}
//var_dump($array);
//其它的关联表的数据，获取当前演出对应的评论数据
$sql = "select * from t_comment where show_id=$showid";
$result = mysql_query($sql);

//动态组装查询数组
$comments = array();
$i = 0;
while ($row = mysql_fetch_array($result)) {
    $comments[$i]["comment_id"] = $row["comment_id"];
    $comments[$i]["comment_stage"] = $row["comment_stage"];
    $comments[$i]["comment_content"] = $row["comment_content"];
    $i++;
}

$array["comment"] = $comments;


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