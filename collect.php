<?php
require "conn.php";

//接收参数
$userid = $_POST["userid"];
$showid = $_POST["showid"];

//判断用户当前操作为 收藏 还是 取消收藏

$sql = "select * from t_collect where user_id=$userid and show_id=$showid";

$result = mysql_query($sql);
// var_dump($result);
// var_dump(mysql_num_rows($result));

if (mysql_num_rows($result) == 1) {
    //用户已经收藏，目前执行取消收藏
    $sql = "delete from t_collect where user_id=$userid and show_id=$showid";
    mysql_query($sql);
    if (mysql_affected_rows() == 1) {
        $data = array(
            "resultCode" => 200,
            "action" => "cancle",
            "message" => "取消收藏成功！"
        );
        echo(json_encode($data));
    } else {
        $data = array(
            "resultCode" => 500,
            "action" => "cancle",
            "message" => "取消收藏失败！"
        );
        echo(json_encode($data));
    }
} else {
    //用户未收藏，目前执行收藏
    $sql = "insert into t_collect (user_id,show_id)values($userid,$showid)";
    mysql_query($sql);
    if (mysql_affected_rows() == 1) {
        $data = array(
            "resultCode" => 200,
            "action" => "add",
            "message" => "收藏成功！"
        );
        echo(json_encode($data));
    } else {
        $data = array(
            "resultCode" => 500,
            "action" => "add",
            "message" => "收藏失败！"
        );
        echo(json_encode($data));
    }
}
