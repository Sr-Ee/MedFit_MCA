<?php
require_once 'config.php';
require_once 'api.php';
$arr['topic'] = 'Test by Sunny';
$arr['start_date'] = date('2023-03-12 00:15:00');
$arr['duration'] = 30;
$arr['password'] = 'sunny';
$arr['type'] = '2';
$result=createMeeting($arr);
if(isset($result->id)){
	echo "Join URL: <a href='".$result->join_url."'>".$result->join_url."</a><br/>";
	echo "Password: ".$result->password."<br/>";
	echo "Start Time: ".$result->start_time."<br/>";
	echo "Duration: ".$result->duration."<br/>";
}else{
	echo '<pre>';
	print_r($result);
}
?>