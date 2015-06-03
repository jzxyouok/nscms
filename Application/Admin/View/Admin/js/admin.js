$(document).ready(function(){

	//id checkbox 全选/全不选
	$("#checkAllIds").click(function(){
		if($(this).is(":checked"))
			$(".catid").prop("checked",true);
		else
			$(".catid").prop("checked",false);
	});

	//删除按钮事件，获取所有选中状态checkbox的值，
	$("#deleteButton").click(function(){
		var ids = [];
		$(".catid:checked").each(function(i){
			ids[i] = $(this).val();
		});
		alert(ids);
		return false;
	});

	$("#test").click(function(){
		var arr = [];
		$(".catid:checked").each(function(i){
			arr[i] = $(this).val();
			// alert(i);
		});
		alert(arr);
	});
	
});