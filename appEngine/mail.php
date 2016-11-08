<?php
// include_once("http.php");
$tmp = file_get_contents("php://input");
// syslog(LOG_INFO,json_encode($tmp,JSON_PRETTY_PRINT));

$url = 'https://altmail.herokuapp.com/api/mail';
$data = ['mail' => $tmp];
$headers = "accept: */*\r\n" .
    "Content-Type: application/x-www-form-urlencoded\r\n" .
    "Custom-Header: custom-value\r\n" ;


$context = [
    'http' => [
        'method' => 'POST',
        'header' => $headers,
        'content' => http_build_query($data),
    ]
];

try{
  $context = stream_context_create($context);
  $result = file_get_contents($url, false, $context);
  syslog(LOG_INFO,$result);
}catch(Exception $ex){
  syslog(LOG_INFO, $ex);
}


//
//
// $r = new HttpRequest('https://altmail.herokuapp.com/mail', HttpRequest::METH_POST);
// $r->setOptions(array('cookies' => array('lang' => 'en')));
// $r->addPostFields(array('user' => 'mike', 'pass' => 's3c|r3t','mail'=>$tmp));
// // $r->addPostFile('image', 'profile.jpg', 'image/jpeg');
// try {
//     syslog(LOG_INFO,$r->send()->getBody());
// } catch (HttpException $ex) {
//     syslog(LOG_INFO, $ex);
// }


// $ch = curl_init();
//
// //set the url, number of POST vars, POST data
// curl_setopt($ch,CURLOPT_URL,"https://altmail.herokuapp.com/mail");
// curl_setopt($ch,CURLOPT_POST,1);
// curl_setopt($ch,CURLOPT_POSTFIELDS,"x=".$tmp);
//
// //execute post
// $result = curl_exec($ch);
// syslog(LOG_INFO,$result);
//

?>
