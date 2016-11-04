<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加新客户|<?php echo ($configcache['Title']); ?></title>
<link rel="stylesheet" type="text/css" href="__CSS__/content.css"  />
<link rel="stylesheet" type="text/css" href="__CSS__/public.css"  />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/Public.js"></script>
<script type="text/javascript" src="__JS__/winpop.js"></script>
<script type="text/javascript" src="__JS__/check.js"></script>
<script type="text/javascript" src="__JS__/My97DatePicker/WdatePicker.js"></script>
<script>
$(document).ready(function() {
	var $client = $('#client');
	$('.submit').click(function() {
		var 
			CompanyName = $client.find('.ctext').eq(0).val(),
			Address = $client.find('.ctext').eq(1).val(),
			ZipCode = $client.find('.ctext').eq(2).val(),
			WebUrl = $client.find('.ctext').eq(3).val(),
			ContactName = $client.find('.ctext').eq(4).val(),
			Qq = $client.find('.ctext').eq(5).val(),
			Phone = $client.find('.ctext').eq(6).val(),
			Tel = $client.find('.ctext').eq(7).val(),
			Email = $client.find('.ctext').eq(8).val(),
			Fax = $client.find('.ctext').eq(9).val(),
			Skype = $client.find('.ctext').eq(10).val(),
			Alww = $client.find('.ctext').eq(11).val(),
			MainItems = $client.find('.textarea').eq(0).val(),
			Message = $client.find('.textarea').eq(1).val();
		
		if (!tcheck(CompanyName,'','请填写公司/客户名称')) { return false; }
		if (!tcheck(ContactName,'','请填写联系人')) { return false; }
		if (!tcheck(Phone,'','请填写手机号码')) { return false; }
		if (!tcheck(CompanyName,'1,60','公司名称请在60个字符以内','length')) { return false; }
		if (!tcheck(Address,'0,100','详细地址请在100个字符以内','length')) { return false; }
		if (!tcheck(ZipCode,'0,10','邮政编码请在10个字符以内','length')) { return false; }
		if (!tcheck(WebUrl,'0,60','网站地址请在60个字符以内','length')) { return false; }
		if (!tcheck(MainItems,'0,200','主营项目请在200个字符以内','length')) { return false; }
		if (!tcheck(Message,'0,1000','备注请在1000个字符以内','length')) { return false; }
		if (!tcheck(ContactName,'0,30','联系人名字请在30个字符以内','length')) { return false; }
		if (!tcheck(Qq,'0,30','QQ号码请在30个字符以内','length')) { return false; }
		if (!tcheck(Skype,'0,30','Skype号码请在30个字符以内','length')) { return false; }
		if (!tcheck(Alww,'0,30','旺旺号请在30个字符以内','length')) { return false; }
		if (!tcheck(Phone,'0,30','手机号码请在30个字符以内','length')) { return false; }
		if (!tcheck(Tel,'0,20','电话号码请在20个字符以内','length')) { return false; }
		if (!tcheck(Fax,'0,20','传真请在20个字符以内','length')) { return false; }
		if (!tcheck(Email,'0,40','Email请在40个字符以内','length')) { return false; }
		
		if (!tcheck(Qq,'number','QQ号码必须是数字')) { return false; }
		if (!tcheck(Phone,'number','手机号码必须是数字')) { return false; }
		wintq('正在处理，请稍后...',4,20000,0,'');
		$('form').submit();
	});
});
</script>
</head>
<body>
<div id="content" style="padding-bottom:20px;">
    <form action="__APP__/Client/clientadd_do" method="post">
    <table id="client" border="1" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0">
    	<tr class="tr">
        	<td class="left">客户/公司：</td>
        	<td colspan="3"><input name="CompanyName" type="text" class="ctext" size="50" /><font>* 填写公司名称或客户名称</font></td>
        </tr>
    	<tr class="tr">
        	<td class="left">详细地址：</td>
        	<td><input name="Address" type="text" class="ctext" size="40" /><font>* 客户详细地址</font></td>
            <td class="left">邮编：</td>
            <td><input name="ZipCode" type="text" class="ctext" size="20" /><font>* 只能是数字</font></td>
        </tr>
    	<tr class="tr">
        	<td class="left">网站地址：</td>
        	<td><input name="WebUrl" type="text" class="ctext" size="40" /><font>* 公司网址</font></td>
            <td class="left">从事行业：</td>
            <td>
            	<select name="Industry" class="select">
                	<?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["Sid"] == 26): ?><option value="<?php echo ($vo["ID"]); ?>"><?php echo ($vo["MenuName"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
        </tr>
    	<tr class="tr">
        	<td class="left">客户类型：</td>
        	<td>
            	<select name="ClientType" class="select">
                	<?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["Sid"] == 1): ?><option value="<?php echo ($vo["ID"]); ?>"><?php echo ($vo["MenuName"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
            <td class="left">客户级别：</td>
            <td>
            	<select name="ClientLevel" class="select">
                	<?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["Sid"] == 3): ?><option value="<?php echo ($vo["ID"]); ?>"><?php echo ($vo["MenuName"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
        </tr>
    	<tr class="tr">
        	<td class="left">客户来源：</td>
        	<td>
            	<select name="ClientSource" class="select">
                	<?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["Sid"] == 2): ?><option value="<?php echo ($vo["ID"]); ?>"><?php echo ($vo["MenuName"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
            <td class="left">跟进情况：</td>
            <td>
            	<select name="FollowUp" class="select">
                	<?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["Sid"] == 54): ?><option value="<?php echo ($vo["ID"]); ?>"><?php echo ($vo["MenuName"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
        </tr>
    	<tr class="tr">
        	<td class="left">跟单类型：</td>
        	<td>
            	<select name="Wast" class="select">
                	<?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["Sid"] == 5): ?><option value="<?php echo ($vo["ID"]); ?>"><?php echo ($vo["MenuName"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
            <td class="left">客户意向：</td>
            <td>
            	<select name="Intent" class="select">
                	<?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["Sid"] == 57): ?><option value="<?php echo ($vo["ID"]); ?>"><?php echo ($vo["MenuName"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
        </tr>
    	<tr class="tr">
        	<td class="left">主营项目：</td>
        	<td colspan="3"><textarea name="MainItems" class="textarea" style="width:600px; height:60px; margin:6px 0px;"></textarea></td>
        </tr>
    	<tr class="tr">
        	<td class="left">其它/备注：</td>
        	<td colspan="3"><textarea name="Message" class="textarea" style="width:600px; height:60px; margin:6px 0px;"></textarea></td>
        </tr>
    	<tr class="tr">
        	<td class="left">联系方式：</td>
        	<td></td>
            <td class="left">联系人：</td>
        	<td><input name="ContactName" type="text" class="ctext" size="30" /></td>
        </tr>
    	<tr class="tr">
        	<td class="left">性别：</td>
        	<td>
            	<select name="Sex" class="select">
                	<option value="男">男</option>
                    <option value="女">女</option>
                </select>
            </td>
            <td class="left">生日：</td>
            <td>
            	<input class="Wdate" name="Birthday" type="text" onfocus="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})">
            </td>
        </tr>
    	<tr class="tr">
        	<td class="left">职位：</td>
        	<td>
            	<select name="Post" class="select">
                	<?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["Sid"] == 4): ?><option value="<?php echo ($vo["ID"]); ?>"><?php echo ($vo["MenuName"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
            <td class="left">腾讯QQ：</td>
            <td><input name="Qq" type="text" class="ctext" size="30" /></td>
        </tr>
    	<tr class="tr">
        	<td class="left">手机：</td>
        	<td><input name="Phone" type="text" class="ctext" size="40" /></td>
            <td class="left">电话：</td>
            <td><input name="Tel" type="text" class="ctext" size="30" /></td>
        </tr>
    	<tr class="tr">
        	<td class="left">Email：</td>
        	<td><input name="Email" type="text" class="ctext" size="40" /></td>
            <td class="left">传真：</td>
            <td><input name="Fax" type="text" class="ctext" size="30" /></td>
        </tr>
    	<tr class="tr">
        	<td class="left">Msn/Skype：</td>
        	<td><input name="Skype" type="text" class="ctext" size="40" /></td>
            <td class="left">阿里旺旺：</td>
            <td><input name="Alww" type="text" class="ctext" size="30" /></td>
        </tr>
    </table>
    <input type="submit" class="submit" value="提交" style="margin:20px 0 0 30px;" />
    </form>
</div>
</body>
</html>