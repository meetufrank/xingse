<?php
namespace Home\Controller;
use Think\Controller;
use Com\Wechat;
use Com\WechatAuth;
class IndexController extends Controller {
    public function index(){
		
		    $token = 'wangjiangphp'; //微信后台填写的TOKEN
          
	}
	
	//扫描二维码回复消息
	public function eventkey($wechat,$data){
		
		if($data['EventKey'] =='1'){
			
			$text = "感谢您使用1服务";
			$wechat->replyText($text);
			
		}
		
		
	}
	
	   //回复文本消息
       private function Text($wechat,$data){
		   
		   if(strstr($data['Content'],"hi")){
			   $text="我正在使用Thinkphp开发微信,你好";
			   //调用日志
			   $this->logger("发送消息：\n".$text);
			   $wechat->replyText($text);
		   }else if(strstr($data['Content'],"myself")){
			   
			   $this->users($wechat,$data);
			  
		   }
		   
	   }
	   
	   
	  /*  //获取用户信息
	   private function users($wechat,$data){
		   
		      $openid=$data['FromUserName'];
			  $appid="wxb5aec13c030a530b";
			  $appSecret="2232d4acc3612e530f0ccc311c72d68c";
			  $token=session('token') ;

			  if($token){

			  $WechatAuth=new WechatAuth($appid,$appSecret,$token);

			  }else{
				$WechatAuth=new WechatAuth($appid,$appSecret);

				$accsseToken=$WechatAuth->getAccessToken();
				$token=$accsseToken['access_token'];
				session('token',$token);
			  }
			  $user=$WechatAuth->userInfo($openid);
			  $text="你的openid是：".$user['openid']."\n你的昵称是：".$user['nickname']."\n
			  你的性别是:".$user['sex']."\n你的城市是：".$user['city']."\n你所在国家是".$user['country']."\n
			  你在的省份是：".$user['province'];

			  $this->logger("发送用户的信息".$text);
			  $wechat->replyText($text);
		   
	   } */
	   
	    //网页授权获取用户基本信息
    public function webUsers(){
     
      $appid="wxb5aec13c030a530b";
      $appSecret="2232d4acc3612e530f0ccc311c72d68c";
      $WechatAuth=new WechatAuth($appid,$appSecret);
      if($_GET['iscode']){
         $url="http://jihua.1671.net/tp/Home/Index/webUsers/";
         $result=$WechatAuth->getRequestCodeURL($url);
		
         $result;
         header("Location:{$result}"); 

      } else if($_GET['code']){
         
          header('Content-type:text/html;charset=utf-8');
          $user=$WechatAuth->getAccessToken('code',$_GET['code']);
          $openid=$user['openid'];
          $users=$WechatAuth->getUserInfo($openid);
		  var_dump($users);
         /*  $m=M('users');
          $data['openid']=$users['openid'];
          $data['nickname']=$users['nickname'];
          $result=$m->add($data);
          if($result){
            $text="你的openid是：".$users['openid']."\n你的昵称是：".$users['nickname']."\n
      你的性别是:".$users['sex']."\n你的城市是：".$users['city']."\n你所在国家是".$users['country']."\n
      你在的省份是：".$users['province'];
            echo $text;
          } */
         
		
          
          } 
         
      }
	  
	  public function createCode(){
   			$WechatAuth=$this->WechatAuth;
   			$ticket=$WechatAuth->qrcodeCreate("10086");
            echo $ticket;
   			//$src=$WechatAuth->showqrcode($ticket['ticket']);
			//var_dump($src);
   			//echo "<img width='70%' src='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQF18DoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL0l6aEhrQnJsYWFFUVg0V2FFUlJ6AAIE0h/UVgMEAAAAAA=='>";
   			 
   }
	   
	   //日志
	     private function logger($content){
    	$logSize=100000;

    	$log="log.txt";
     
    	if(file_exists($log) && filesize($log)  > $logSize){
    		unlink($log);
    	}

    	file_put_contents($log,date('H:i:s')." ".$content."\n",FILE_APPEND);

    }
	   
}