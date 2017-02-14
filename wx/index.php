<?php
//scope=snsapi_userinfo实例
$appid='wxb5aec13c030a530b';
$redirect_uri = urlencode ( 'http://meetuuu.com/wx/getUserInfo.php' );
$url ="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
header("Location:".$url);

?>