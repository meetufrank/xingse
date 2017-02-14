<?php
/**
 * @Author: anchen
 * @Date:   2016-12-27 21:53:09
 * @Last Modified by:   anchen
 * @Last Modified time: 2016-12-30 17:48:57
 */

define('IN_ECTOUCH', true);

require(dirname(__FILE__) . '/include/init.php');
require(ROOT_PATH . 'include/indexsan.php');


    ?>



    <!DOCTYPE html>
    <html>
    <head>
        <title>获取共享地址</title>
        <meta charset="utf-8" />
        <meta id="viewport" name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1; user-scalable=no;" />
          <script src="/js/jquery-1.4.4.min.js"></script>
    </head>
    <script language="javascript">
        function getaddr(){
            WeixinJSBridge.invoke('editAddress',{
                "appId" : "<?php echo $appId;?>", //公众号名称，由商户传入
                "timeStamp" : "<?php echo $timestamp;?>", //时间戳 这里随意使用了一个值
                "nonceStr" : "<?php echo $nonceStr;?>", //随机串
                "signType" : "SHA1", //微信签名方式:sha1
                "addrSign" : "<?php echo $addrSign;?>", //微信签名
                "scope"    : "jsapi_address"
            },function(res){
                if(res.err_msg == 'edit_address:ok'){
                    document.getElementById("showAddress").innerHTML="收件人："+res.userName+"  联系电话："+res.telNumber+"  收货地址："+res.proviceFirstStageName+res.addressCitySecondStageName+res.addressCountiesThirdStageName+res.addressDetailInfo+"  邮编："+res.addressPostalCode;







                }
                else{
                    alert("获取地址失败，请重新点击");
                }
            });
        }
    </script>
    <body>


        <div class="showaddr" id="showAddress" ><a id="editAddress" href="javascript:getaddr();"><strong>点击设置收ss货地址</strong></a></div>

    </body>
    </html>