<?php
namespace Home\Controller;
use Think\Controller;
use Com\Wechat;
use Com\WechatAuth;
class UrlController extends Controller {
	
		

	public function getWxAccessToken(){
		
			//微信开发中最重要的一个参数 access_token 如何获取 
		define("APPID", "wxb5aec13c030a530b");       //微信开发平台基本配置
		define("APPSECRET", "2232d4acc3612e530f0ccc311c72d68c ");   //微信开发平台基本配置


		//http请求方式: GET
		$token_access_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . APPID . "&secret=" . APPSECRET;  
		$res = file_get_contents($token_access_url); //获取文件内容或获取网络请求的内容
		//echo $res;
		$result = json_decode($res, true); //接受一个 JSON 格式的字符串并且把它转换为 PHP 变量
		$access_token = $result['access_token'];  //返回access_token


		$date='{"action":"long2short","long_url":"http://wap.koudaitong.com/v2/showcase/goods?alias=128wi9shh&spm=h56083&redirect_count=1"}';
		$shorturl = "https://api.weixin.qq.com/cgi-bin/shorturl?access_token=";
		return $access_token;
		//print_r($access_token);   //打印输出
	}
	

	
	public function http_curl(){
		//获取imooc
		//1.初始化curl
		$ch = curl_init();
		$url = 'http://www.baidu.com';
		//2.设置curl的参数
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//3.采集
		$output = curl_exec($ch);
		//4.关闭
		curl_close($ch);
		//var_dump($output);
	}
	  
	 public function getQrCode(){
		 //1.获取ticket票据
		 $access_token = $this->getWxAccessToken();
		 
		 $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token;
		//var_dump($url);
		 //{"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": 123}}}
		  $postArr = [
        'expire_seconds' => 604800, //7day
        'action_name' => 'QR_SCENE',
        'action_info' => [
            'scene' => [
                'scene_id' => 123
            ]
        ]
       ];
		 	
	    echo  json_encode($postArr);
	    //$res=$this->http_curl($url,'post','json',$postJson);
		 
	 }


 
}













