<?php


$appid = 'wxb5aec13c030a530b';

header('location:https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri=http://meetuuu.com/wx/5/getUserInfo.php&response_type=code&scope=snsapi_userinfo&state=123&connect_redirect=1#wechat_redirect');

?>