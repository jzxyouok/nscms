$(document).ready(function() {

	//id checkbox 全选/全不选
	$("#checkAllIds").click(function() {
		if ($(this).is(":checked"))// 判断全选按钮是否被选中
			$(".ids").prop("checked", true);// 全选
		else
			$(".ids").prop("checked", false);// 全不选
	});

	//删除按钮事件，获取所有选中状态checkbox的值，
	$("#deleteButton").click(function() {
		var ids = [];
		ids = get_checked_ids();//获取选中的checkbox值,返回ID数组
		if (ids == '') {// 判断是不是什么都没选
			alert(Lang.NOT_CHECKED_ERROR);
			return false;
		} else {
			if (!confirm(Lang.CONFIRM_DELETE))// 询问用户是否确认操作
				return false;
		}
		$.post($(this).attr("href"), {// ajax post提交ID数组到删除方法
			"ids": ids
		}, function(ajaxReturn) {
			// alert(ajaxReturn.info);
			// window.location.href = ajaxReturn.url;
			standard_post($("#showMsg").attr("href"), ajaxReturn);// 操作成功/失败提示
		});
		return false;
	});

	//编辑按钮
	$("#editButton").click(function() {
		var ids = [];
		ids = get_checked_ids();//获取选中的checkbox值,返回ID数组
		if (ids.length == 0) {// 判断是不是什么都没选
			alert(Lang.NOT_CHECKED_ERROR);
			return false;
		} else if (ids.length > 1) {// 判断选择数量是否超过1个
			alert(Lang.TOO_MANY_ERROR);
			return false;
		}
		window.location.href = $(this).attr("href") + "/id/" + ids[0];// 跳转到编辑操作并get传递ID
		return false;
	});

	//获取选中的checkbox值,返回ID数组
	function get_checked_ids() {
		var ids = [];
		if ($(".ids:checked").length > 0) {// 判断是不是什么都没选
			$(".ids:checked").each(function(i) {
				ids[i] = $(this).val();
			});
		}
		return ids;
	}

	//排序按钮事件
	$("#sortButton").click(function() {
		var sorts = [];
		var ids = [];
		$(".cms-input-order").each(function(i) {// 获取所有排序文本框中的值
			sorts[i] = $(this).val();
		});
		$(".ids").each(function(i) {// 获取所有列出项目的ID
			ids[i] = $(this).val();
		});
		$.post($(this).attr("href"), {// ajax post提交ID数组与排序值数组到排序方法
			"sorts": sorts,
			"ids": ids
		}, function(ajaxReturn) {
			// alert(ajaxReturn.info);
			// window.location.href = ajaxReturn.url;
			standard_post($("#showMsg").attr("href"), ajaxReturn);// 操作成功/失败提示
		})
		return false;
	});

	// 标准post提交（用js模拟表单提交，实现提交post并跳转）
	function standard_post(url, args) {
		var form = $("<form method='post'></form>");
		form.attr({
			"action": url
		});
		for (arg in args) {
			var input = $("<input type='hidden'>");
			input.attr({
				"name": arg
			});
			input.val(args[arg]);
			form.append(input);
		}
		form.submit();
	}

	//操作提示语
	var Lang = {
		"NOT_CHECKED_ERROR": "啥都没选呢！点我搞毛！",
		"CONFIRM_DELETE": "确定删除？",
		"TOO_MANY_ERROR": "选多了！只能选一个！"
	};

	//测试按钮
	$("#test").click(function() {
		var sorts = [];
		var ids = [];
		$(".cms-input-order").each(function(i) {
			sorts[i] = $(this).val();
		});
		$(".ids").each(function(i) {
			ids[i] = $(this).val();
		});
		var arr = new Array();
		for (var i = 0; i < ids.length; i++) {
			var id = ids[i];
			arr[id] = sorts[i];
		};
		standard_post($(this).attr("href"), arr);
		return false;
	});
});