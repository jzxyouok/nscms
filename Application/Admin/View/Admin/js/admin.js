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
			alert('啥都没选呢，删个JB！');
			return false;
		}else{
			if(!confirm("你确定要删除这"+ids.length+"条数据吗？"))
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
			alert("你妹，啥都没选呢，编辑个毛！");
			return false;
		}else if(ids.length > 1){
			alert("选多了！只能选一个！");
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
		// alert(ids+"\n"+sorts);
		$.post($(this).attr("href"),{"sorts":sorts,"ids":ids},function(backData){
			alert(backData.info);
			window.location.href=backData.url;
			// alert(backData);
		})
		return false;
	});

	//测试按钮
	$("#test").click(function(){
		var arr = [];
		$(".ids:checked").each(function(i){
			arr[i] = $(this).val();
			// alert(i);
		});
		alert(arr);
	});
	
});