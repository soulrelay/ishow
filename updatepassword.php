<?php
require "conn.php";

//接收用户参数
$oldpwd = $_POST["oldpassword"];
$newpwd = $_POST["newpassword"];
$userid = $_POST["userid"];

//用户输入的原始密码是否正确
$sql = "select * from t_user where user_password='$oldpwd' and user_id=$userid";

$result = mysql_query($sql);

if (mysql_num_rows($result) == 1) {
    //原始密码正确，更新密码
    $sql = "update t_user set user_password='$newpwd' where user_id=$userid";
    mysql_query($sql);
    if (mysql_affected_rows() == 1) {
        $data = array(
            "resultCode" => 200,
            "message" => "更新成功"
        );
        echo(json_encode($data));
    } else {
        $data = array(
            "resultCode" => 301,
            "message" => "更新失败，服务器错误！"
        );
        echo(json_encode($data));
    }
} else {
    //原始密码错误，直接返回
    $data = array(
        "resultCode" => 300,
        "message" => "更新失败，原始密码错误！"
    );
    echo(json_encode($data));
}


?>