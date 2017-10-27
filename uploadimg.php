<?php
require "conn.php";

//接收参数
$userid = $_POST["userid"];
//第一步：上传图片，保存图片到服务器文件夹中
if ($_FILES["image"]["error"]) {
    $data = array(
        "resultCode" => 500,
        "message" => "失败，上传图片出错"
    );
    echo json_encode($data);
} else {
    $filename = "images/header/" . time() . ".png";
    $result = move_uploaded_file($_FILES["image"]["tmp_name"], $filename);
    if ($result) {
        //图片上传成功，进行第二步：更新数据库对应图片的字段
        $sql = "update t_user set user_header='$filename' where user_id=$userid";
        mysql_query($sql);
        if (mysql_affected_rows() == 1) {
            //头像修改成功
            $data = array(
                "resultCode" => 200,
                "message" => "成功"
            );
            echo json_encode($data);
        } else {
            //头像修改失败
            $data = array(
                "resultCode" => 300,
                "message" => "失败，服务器错误"
            );
            echo json_encode($data);
        }
    } else {
        //图片上传失败
        $data = array(
            "resultCode" => 501,
            "message" => "失败，图片保存出错"
        );
        echo json_encode($data);
    }
}
