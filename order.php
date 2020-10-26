<?php 
if (isset($_COOKIE["NAHUI"])) {
	header('Location: http://google.com/');
	return;
	}
if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) { $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP']; }

$ip = $_SERVER['REMOTE_ADDR'];
$fbp = (isset($_GET['_fbp']) && !empty($_GET['_fbp'])) ? $_GET['_fbp'] : $_POST['fbp'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$sub1 = (isset($_GET['_clickid']) && !empty($_GET['_clickid'])) ? $_GET['_clickid'] : $_POST['clickid'];
$sub2 = $_POST['bay'];
$data = array(
'name' => $_POST['name'],
'phone' => $_POST['phone'],
'sub1' => (isset($_GET['_clickid']) && !empty($_GET['_clickid'])) ? $_GET['_clickid'] : $_POST['clickid'],
'sub2' => $_POST['bay'],
'flow_id' => 'cqcizf6rpl', //ID потока
'geo' => '106008', //ID гео - локации через вкладку помощь
'ip' => $_SERVER['REMOTE_ADDR'],

);


if ($curl = curl_init()) {

curl_setopt($curl, CURLOPT_URL, 'http://metacpa.ru/create');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$result = curl_exec($curl);
curl_close($curl);
}
setcookie("NAHUI", "123", time() + (3600 * 24));

date_default_timezone_set('Europe/Moscow');
$time = date('Y-m-d H:i:s');
$message = "$time;$fbp;$sub1;$sub2;$ip;$name;$phone;$return\n";
file_put_contents('log.txt', $message, FILE_APPEND | LOCK_EX); 

header("Location: success.html");

$urls = 'http://keitaro.cc/56b2efe/postback?status=lead&subid=' . urlencode($sub1) . '&sub_id_12=' . $name . '&sub_id_13=' . $phone;

file_get_contents($urls);

exit;



?>

