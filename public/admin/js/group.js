$(function(){
			//初始化查看人员按钮：人员为0，不可用
			$('#list>tbody>tr').each(function(i,tr){
				console.log($(tr).find(".showList").attr('value'));
				if($(tr).find(".showList").attr('value')==0){
					$(tr).find(".showList").attr("disabled", true);
					$(tr).find(".showList").attr("title", "该组无人员");

					$(tr).find(".delect").removeAttr("disabled");
				}
			});

			//创建换组下拉列表
			var groupSelect = "<span>所选人员移动至移动：</span><select id='groupSelect'> <option value='0'></option>";
			//遍历 #list 中数据来获取组id,组名称
			$('#list>tbody>tr:nth-child(odd)').each(function(i,li){
				//alert($(this).html());
				groupSelect+="<option value ="+$(li).find("span[class=id]").html()+">"+$(li).find("input[name=name]").val()+"</option>";
			});

			groupSelect+="</select>";
			$('#toolbar').append(groupSelect);
			$('#groupSelect').change(function(){
				//当选中第一项（移动至）则直接退出
				if($('#groupSelect').val()==0)
					return;
				//当未选中任何人员时，提示，并退出
				if($('input[type=checkbox]:checked').serialize()==""){
					alert("未选中任何人员");
					return;
				}

				$.post('http://signsystem.cn:81/admin/changeGroup',$('input[class=checkbox]:checked').serialize()+"&group_id="+$('#groupSelect').val(),function(data){
					//console.log(data)
					//alert(data.msg);
					window.location.reload();
				});

			});


			/**
			*显示人员信息
			*/
			$('.showList').click(function(){
				var info = $(this).parent().parent().next();
/*				alert(info.find("div").html());
				return;*/
				if(info.find(".info").html()!=""){
					info.find(".info").html("");
					console.log(info.find(".info").html()+"清空操作");
					return;
				}

				console.log(info.find(".info").html()+"查询操作");					
				$.get($(this).attr('url'), function(data){
					var checkAll = "<input class='checkAll' type='checkbox'></p>";
	  				var str="<thead><th>"+checkAll+"</th><th>姓名</th><th>学号</th><th>班级</th><th>电话</th><th>E-mail</th><th>qq</th><th>地址</th></thead>";
	  				$.each(data,function(i,item){
	  					
	  					 str+="<tr><th><input class='checkbox' name='ids[]' type='checkbox' value='"+item.id+"'></th><th>" + item.name + "</th><th>" + item.stu_id    + "</th><th>" + item.class+ "</th><th>" +item.phone+ "</th><th>"+item.email+ "</th><th>"+item.qq+ "</th><th>"+item.address + "</th></tr>";
	  				});
					info.find(".info").html(str);
				});
			});

			/**
			*删除组别
			*/
			$('.delect').click(function(){
				//alert($(this).attr('url')+$(this).attr('value'));
				if($(this).attr('value')!='0'){
					alert("该组仍有成员，禁止删除！！");
					return;
				}

				if(confirm("是否继续")){
					var parent = $(this).parent().parent();
					$.get($(this).attr('url'), function(data){
						alert(data.msg);
						parent.remove();
					});
				}
			});

			var oldText = "";	//用于记录点击编辑时的文本
			/**
			*编辑昵称
			*/
			$('.resetName').click(function(){
				var parent = $(this).parent().parent();
				//确定则提交数据，并退出
				if($(this).text()=="提交"){
					//文本未改变时，不提交
					if(oldText==parent.find('input[type=text]').val()){
						alert("您未作出修改");
					}else{
						var url = $(this).attr('url');
						url += "/"+parent.find('input[type=text]').val();
						$.get(url,function(data){
							alert(data.msg);
						});
					}
				
					parent.find('input').attr("disabled",true);
					$(this).text("编辑");
					return;
				}
				//编辑状态时，则改变样式
				oldText = parent.find('input[type=text]').val();

				parent.find('input').removeAttr("disabled");
				parent.find('input').focus().select();
				$(this).text("提交");
			});

			/**
			*全选复选框事件
			*/
			$(document).on('change','.checkAll',function(){
				//console.log($(this)[0].checked);
				if($(this)[0].checked){
					console.log($(this).parent().parent().parent().parent().html());
					$(this).parent().parent().parent().parent().find('input[class=checkbox]').each(function(){
						this.checked = true;
					});
				}
				else{					
					$(this).parent().parent().parent().parent().find('input[class=checkbox]').each(function(){
						this.checked = false;
					});				}
			});

			/**
			*	创建组
			*/
			$("#createGroup").click(function(){
				var name = prompt("输入名称");
				if(name==null){
					return;
				}
				var url = "{{url('/admin/createGroup')}}"+"/"+name;
				$.get(url, function(data){
					alert(data.msg);
					window.location.reload();
				});
			});
		});