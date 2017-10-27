<?php
//获取演出类别
//1 连接数据库服务器
$conn = mysql_connect("localhost", "root", "root") or die("connect failed!" . mysql_error());
//var_dump($conn);
mysql_query("SET NAMES UTF8");

//2 连接数据库
mysql_select_db("ShowDB", $conn) or die("select db failed" . mysql_error());
//3 执行SQL 语句
$tel = $_POST["telephone"];
$pwd = $_POST["password"];

$sql = "select * from t_user where user_phone='$tel' and user_password='$pwd'";
$result = mysql_query($sql);

if (mysql_num_rows($result) == 1) {
//登录成功
    $array = array();
    while ($row = mysql_fetch_array($result)) {
        $array["user_id"] = $row["user_id"];
        $array["user_phone"] = $row["user_phone"];
        $array["user_password"] = $row["user_password"];
        $array["user_sex"] = $row["user_sex"];
        $array["user_header"] = $row["user_header"];
    }
    $json = json_encode(array(
        "resultCode" => 200,
        "message" => "login successed!",
        "data" => $array
    ));
    echo($json);
} else {
    $json = json_encode(array(
        "resultCode" => 500,
        "message" => "login failed!phone or password is wrong",
        "data" => $array
    ));
    echo($json);
}


//5 关闭数据库
mysql_close($conn);


?>