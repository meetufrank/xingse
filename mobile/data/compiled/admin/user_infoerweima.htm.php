<!-- $Id: user_info.htm 16854 2009-12-07 06:20:09Z sxc_shop $ -->
<?php echo $this->fetch('pageheaderxingtong.htm'); ?>
<div class="main-div">

<table width="100%" >

  <!-- 货号 -->
  <tr>
    <td class="label">请输入货号:</td>
    <td>
       <input style="display:none;" type="text" id="userid" value="<?php echo $this->_var['userid']; ?>">
       <input name="huohao" id="huohao" style="width:180px;" type="text" value="" size="10" />
    </td>
  </tr>
  <tr>
    <td class="label">生成的链接:</td>
    <td>
       <input style="display:none;width:580px;" id="link"  name="lianjie" type="text" value=""  />
    </td>
  </tr>

  <tr>
    <td colspan="2" align="center">
      <input id="btn" type="button" value="生成二维码链接" class="button" onClick="sub()"  /></td>
  </tr>
</table>

</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/jquery-1.9.1.min.js')); ?>


<script language="JavaScript">
   function sub(){
    var huohao = document.getElementById("huohao").value;
    var huohaoid=document.getElementById("link");
    var link=document.getElementById("link").value;

    var btnid=document.getElementById("btn");
    var userid=document.getElementById("userid").value;

    if(huohao=="")
    {
      alert("货号不能为空!");
      return ;
    }else{

                             $.ajax({
                                            type:"POST",
                                            url:"users.php?act=goodsid",
                                            async:true,
                                            data:{huohao:huohao,userid:userid},
                                            dataType:"JSON",
                                            success:function(data){
                                                    if(data.msg=='error'){
                                                       alert("请输入正确的货号!!!");
                                                    }else{
                                                     alert("货号输入成功");
document.getElementById("link").value =data.msg;

 huohaoid.style.display = "block";
                                                      btnid.style.display = "none";

                                                    }
                                                  }
                            });//ajax结束

    }

   }
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>
