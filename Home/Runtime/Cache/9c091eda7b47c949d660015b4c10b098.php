<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>客户管理|<?php echo ($configcache['Title']); ?></title>
<link rel="stylesheet" type="text/css" href="__CSS__/content.css"  />
<link rel="stylesheet" type="text/css" href="__CSS__/public.css"  />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/Public.js"></script>
<script type="text/javascript" src="__JS__/winpop.js"></script>
<script>
//新增跟单记录
function withAdd(url) {
	fpopload('新增跟单记录',580,380,url);
	addDiv($('#f_pop'));
}
//修改联系人
function withEdit(id) {
	if (id=='' || isNaN(id)) {
		wintq('ID参数不正确',3,1000,1,'');
		return false;
	}else {
		fpopload('修改跟单信息',580,410,'__APP__/With/withedit/id/'+id);
		addDiv($('#f_pop'));
	}	
}
//新增联系人
function wincontactAdd(url) {
	fpopload('新增联系人',860,400,url);
	addDiv($('#f_pop'));
}
//修改联系人
function wincontactEdit(id) {
	if (id=='' || isNaN(id)) {
		wintq('ID参数不正确',3,1000,1,'');
		return false;
	}else {
		fpopload('修改联系人信息',860,430,'__APP__/Client/contactedit/id/'+id);
		addDiv($('#f_pop'));
	}	
}
$(document).ready(function() {
    $('#content h2 .add').click(function() {
		popload('新增客户',860,500,'__APP__/Client/clientadd/');
		addDiv($('#iframe_pop'));
		popclose();
	});
	function Operating() {
		//打开或关闭共享
		$('#content #table .openshare').click(function() {
			var _this = $(this);
			var id = $(this).attr('alt');
			var opens = $(this).attr('data-title');
			$.get('__APP__/Client/opensharedo?id='+id+'&openshare='+opens,function(data) {
				data = eval('('+data+')');
				if (data.s=='ok') {
					if (opens==0) {
						_this.attr('data-title',1);
						_this.attr('src','__IMAGE__/yes.png')
						wintq('共享成功',1,1000,1,'');
					}else {
						_this.attr('data-title',0);
						_this.attr('src','__IMAGE__/no.png')
						wintq('关闭共享成功',1,1000,1,'');
					}
				}else {
					wintq(data.s,3,1000,1,'');
				}
			});
		});
		//修改客户信息
		$('#content #table .tr .edit').click(function(event) {
			event.preventDefault();
			var id=$(this).attr('href');
			if (id=='' || isNaN(id)) {
				wintq('ID参数不正确',3,1000,1,'');
				return false;
			}else {
				popload('修改客户信息',860,500,'__APP__/Client/clientedit/id/'+id);
				addDiv($('#iframe_pop'));
				popclose();
			}
		});
		//删除
		$('#content #table .tr .del').click(function(event) {
			event.preventDefault();
			if (!confirm('确定要删除该数据吗？')) {
				return false;
			}
			var id=$(this).attr('href');
			if (id=='' || isNaN(id)) {
				wintq('ID参数不正确',3,1000,1,'');
				return false;
			}else {
				wintq('正在删除，请稍后...',4,20000,0,'');
				$.ajax({
					url:'__APP__/Client/client_del/',
					dataType:'json',
					type:'POST',
					data:'post=ok&id='+id,
					success: function(data) {
						if (data.s=='ok') {
							wintq('删除成功',1,1500,0,'?');
						}else {
							wintq(data.s,3,1500,1,'');
						}
					}
				});
			}
		});
		//批量删除
		$('#dely').click(function(event) {
			event.preventDefault();
			if (!confirm('确定要删除选择项吗？')) {
				return false;
			}
			var delid='';
			for (i=0; i<$('#table .delid').size(); i++) {
				if (!$('#table .delid').eq(i).attr('checked')==false) {
					delid=delid+$('#table .delid').eq(i).val()+',';
				}
			}
			if (delid=='') {
				wintq('请选中后再操作',2,1500,1,'');
			}else {
				wintq('正在删除，请稍后...',4,20000,0,'');
				$.ajax({
					url:'__APP__/Client/client_indel/',
					dataType:'JSON',
					type:'POST',
					data:'delid='+delid,
					success: function(data) {
						if (data.s=='ok') {
							wintq('删除成功',1,1500,0,'?');
						}else {
							wintq(data.s,3,1500,1,'');
						}
					}
				});
			}
		});
		//分页
		$('#page .page a').click(function(event) {
			event.preventDefault();
			var url = $(this).attr('href');
			clientajax(url);
		});
		//新增联系人
		$('#table .tr .add').click(function() {
			popload('新增联系人',860,400,$(this).attr('alt'));
			addDiv($('#iframe_pop'));
			popclose();
		});
	}
	//拉取客户信息
	function clientajax(keyword) {
		$.get('__APP__/Client/indexajax?keyword='+keyword, function(data) {
			//回调函数
			data = eval('('+data+')');
			if (data.s=='ok') {
				//有数据的情况下
				$('#table .tr').remove();
				$('#page .page').remove();
				$('#table').append(data.html);
				$('#page').append(data.page);
			}else {
				//没有数据的情况下
				$('#table .tr').remove();
				$('#page .page').remove();
				$('#table').append(data.html);
			}
			Operating();
		});
	}
	clientajax('');
	var speed='';
	$('.search .text').keyup(function() {
		clearTimeout(speed);
		var value = $(this).val();
		speed = setTimeout(function() {
			clientajax(value);
		},300);
	});
});
</script>
</head>
<body>
<div id="content">
	<h1>首页 > 客户管理 > 全部客户</h1>
    <h2>
    	<div class="h2_left">
        	<a href="__ACTION__" class="whole">全部</a>
        	<a href="javascript:;" class="f5" onclick="f5();">刷新</a>
            <a href="javascript:;" class="add">新增</a>
            <a href="javascript:history.back();" class="Retreat">后退</a>
            <a href="javascript:history.go(1);" class="Advance">前进</a>
        </div>
        <div class="search">
            <input type="text" name="keyword" class="text" />
            <input type="submit" class="so" value="搜 索" />
            <font>小贴士：输入客户/公司名称可实时搜索</font>
        </div>
    </h2>
    <h3>
    	<a href="__APP__/Client/index" class="h3a">客户资料</a>
    	<a href="__APP__/Client/contact">联系人</a>
        <a href="__APP__/With/with">跟单记录</a>
        <a href="__APP__/Client/openshare">客户共享</a>
    </h3>
    <table id="table" border="1" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0">
    	<tr>
        	<th><input type="checkbox" class="indel" value="del" /></th>
        	<th>编号</th>
            <th>公司/客户名</th>
            <th>联系人</th>
            <th>类型</th>
            <th>级别</th>
            <th>来源</th>
            <th>跟进情况</th>
            <th>意向</th>
            <th>共享客户</th>
            <th>最后更新</th>
            <th>操作</th>
        </tr>
    </table>
    <div id="page"><a href="javascript:;" class="selbox">全选</a><a href="javascript:;" class="anti">反选</a><a href="javascript:;" class="unselbox">全不选</a>&nbsp;&nbsp;对选中项进行&nbsp;&nbsp;<a href="javascript:;" id="dely">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
</div>
</body>
</html>