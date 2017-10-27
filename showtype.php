<?php
//获取演出类别
//1 连接数据库服务器
// $conn = mysql_connect("localhost","root","root");
// if ($conn) {
// 	# code...
// 	echo "connect successed! $conn<br/>";
// }
// else{
//     echo "connect failed!";
// }
// echo "youdianyiwai1111111111";
$conn = mysql_connect("localhost", "root", "root") or die("connect failed!" . mysql_error());
//var_dump($conn);
mysql_query("SET NAMES UTF8");
/**
 * undocumented constant
 **/
//2 连接数据库
mysql_select_db("ShowDB", $conn) or die("select db failed" . mysql_error());
//3 执行SQL 语句
$sql = "select * from t_type";
$result = mysql_query($sql);

//4 获取执行结果
$array = array();
$i = 0;
while ($row = mysql_fetch_array($result)) {
    // var_dump($row);
    // echo "<br/>";
    $array[$i]["type_id"] = $row["type_id"];
    $array[$i]["type_name"] = $row["type_name"];
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

//之前有个只需要在“License server address“里输入 “http://idea.lanyus.com/”就ok了，
//但现在全部授权服务器已遭JetBrains封杀，用不了了，而我们现在只需要把这网址打开，


?>