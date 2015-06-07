$(document).ready(function(){

	//id checkbox 全选/全不选
	$("#checkAllIds").click(function(){
		if($(this).is(":checked"))
			$(".ids").prop("checked",true);
		else
			$(".ids").prop("checked",false);
	});

	//删除按钮事件，获取所有选中状态checkbox的值，
	$("#deleteButton").click(function(){
		var ids = [];
		ids = get_checked_ids();
		if(ids==''){
			alert(Lang.NOT_CHECKED_ERROR);
			return false;
		}else{
			if(!confirm(Lang.CONFIRM_DELETE))
				return false;
		}
		$.post($(this).attr("href"),{"ids":ids},function(backData){
			alert(backData.info);
			window.location.href=backData.url;
		});
		return false;
	});

	//编辑按钮
	$("#editButton").click(function(){
		var ids = [];
		ids = get_checked_ids();
		if (ids.length == 0){
			alert(Lang.NOT_CHECKED_ERROR);
			return false;
		}else if(ids.length > 1){
			alert(Lang.TOO_MANY_ERROR);
			return false;
		}
		window.location.href=$(this).attr("href")+"/id/"+ids[0];
		return false;
	});

	//获取选中的checkbox值
	function get_checked_ids(){
		var ids = [];
		if($(".ids:checked").length > 0){
			$(".ids:checked").each(function(i){
				ids[i] = $(this).val();
			});
		}		
		return ids;
	}

	//排序按钮事件
	$("#sortButton").click(function(){
		var sorts = [];
		var ids = [];
		$(".cms-input-order").each(function(i){
			sorts[i] = $(this).val();
		});
		$(".ids").each(function(i){
			ids[i] = $(this).val();
		});
		$.post($(this).attr("href"),{"sorts":sorts,"ids":ids},function(backData){
			alert(backData.info);
			window.location.href=backData.url;
		})
		return false;
	});
	
	//操作提示语
	var Lang = {
		"NOT_CHECKED_ERROR":"啥都没选呢！点我搞毛！",
		"CONFIRM_DELETE":"确定删除？",
		"TOO_MANY_ERROR":"选多了！只能选一个！"
	};

	//测试按钮
	$("#test").click(function(){
		alert(lang.test);
		return false;
	});
});