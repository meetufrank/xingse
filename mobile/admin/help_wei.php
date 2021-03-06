<?php
/**
 * ECTOUch 帮助手册
 * ============================================================================
 * * 版权所有 2005-2012 TGROUPON中国，并保留所有权利。
 * 网站地址: http://www.ecmoban.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: hnllyrp $
 * $Id: help_wei.php 16220 2014-05-14 21:08:59Z hnllyrp $
 */

define('IN_ECTOUCH', true);
require(dirname(__FILE__) . '/includes/init.php');

/*------------------------------------------------------ */
//-- ectouch帮助手册
/*------------------------------------------------------ */
if($_REQUEST['act'] == 'ectouch'){

    $smarty->assign('ur_here', "ectouch帮助手册");
    $smarty->assign('full_page',  1);

    $smarty->display('help_ectouch.htm');
}

/*------------------------------------------------------ */
//-- TGROUPON帮助手册
/*------------------------------------------------------ */
if($_REQUEST['act'] == 'weixintong'){

    $smarty->assign('ur_here', "TGROUPON帮助手册");
    $smarty->assign('full_page',  1);

    $smarty->display('help_weixintong.htm');
}

/*------------------------------------------------------ */
//-- 微信支付相关配置
/*------------------------------------------------------ */
if($_REQUEST['act'] == 'weixinpay'){

    $smarty->assign('ur_here', "微信支付相关配置");
    $smarty->assign('full_page',  1);

    $smarty->display('help_weixinpay.htm');
}

?>