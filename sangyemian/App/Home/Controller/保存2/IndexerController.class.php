<?php
/**
*
* 版权所有：恰维网络<qwadmin.qiawei.com>
* 作    者：寒川<hanchuan@qiawei.com>
* 日    期：2016-01-21
* 版    本：1.0.0
* 功能说明：前台控制器演示。
*
**/
namespace Home\Controller;
use Think\Controller;
use Vendor\Page;
class IndexerController extends ComController {
    public function index(){
		
    	   session_start();
	     
	      $_SESSION['imgs'] = $imgurl;
		  $_SESSION['gushi'] = I('gushi');
	      echo $_SESSION['imgs'];
		  echo $_SESSION['gushi'];
		$this -> display();
    }

    public function add(){
		
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     13145728 ;// 设置附件上传大小
    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath  =      'Public/Uploads/'; // 设置附件上传根目录
    $upload->savePath  =      ''; // 设置附件上传（子）目录
    // 上传文件 
    $info   =   $upload->upload();
    if(!$info) {// 上传错误提示错误信息
        $this->error($upload->getError());
    }else{// 上传成功 获取上传文件信息
        foreach($info as $file){
            $imgurl = $file['savepath'].$file['savename'];
        }
    }
         

	$User = M("from"); // 实例化User对象
    $data['names'] = I('name');
    $data['tels'] = I('phone');
	$data['imgs'] = $imgurl;
	$data['texts'] = I('gushi');
	$data['times'] = Date('Y-m-d H:i');

    $User->add($data);



    }
	
	

	
	
	    


}

?>