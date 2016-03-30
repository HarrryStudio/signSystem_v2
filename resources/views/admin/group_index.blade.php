@extends('admin.master')

@section('head')
	<style>
		html{
			font-size: 14px;
		}
		body{
			font-size: 1rem;
		}
		#mainbav ul li:nth-child(3){
			background-color: #86DB00;
		}
		#mainbav ul li:nth-child(1):hover{
			background-color: #7963DF;
		}
		.showList[value="0"]{
			background-color: #ccc;
			color: #eee; 
		}
		#list li{
			padding: 1rem 0;
			text-align: center;
		}
		#list li:nth-child(even){
			background-color: #D9EDF7;
		}
		#list li:nth-child(odd){
			background-color: #DFF0D8;
		}

		#list li span{
			margin-left:4rem;
		}

		input[name=name]{
			width: 8rem;
		}

		.info{
			margin-left: 30%;
			text-align: left;
		}
	</style>

	<script>
		$(function(){
			//初始化查看人员按钮：人员为0，不可用
			$('#list>li').each(function(i,li){
				//console.log($(li).find(".showList").attr('value'));
				if($(li).find(".showList").attr('value')==0){
					$(li).find(".showList").attr("disabled", true);
					$(li).find(".showList").attr("title", "该组无人员");

					$(li).find(".delect").removeAttr("disabled");
				}
			});

			//创建换组下拉列表
			var groupSelect = "<span>所选人员移动至移动：</span><select id='groupSelect'> <option value='0'></option>";
			//遍历 #list 中数据来获取组id,组名称
			$('#list>li').each(function(i,li){
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
				var info = $(this).parent();
				if(info.find("div").html()!=""){
					info.find("div").html("");
					return;
				}
					
				$.get($(this).attr('url'), function(data){

	  				var str="";
	  				$.each(data,function(i,item){
	  					
	  					                    str+="<p><input class='checkbox' name='ids[]' type='checkbox' value='"+item.id+"'> <span>" + item.id + "</span>" + 
	  					                    "<span>" + item.name    + "</span>" +
	  					                    "<span>" + item.group_id + "</span></p>";
	  				});
	  				var checkAll = "<p><input class='checkAll' type='checkbox'><span>全选</span></p>";
					info.find(".info").html(checkAll+str);
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
					var parent = $(this).parent()
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
				var parent = $(this).parent();
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
				var parent = $(this).parent();
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
					console.log($(this).parent().parent().html());
					$(this).parent().parent().find('input[class=checkbox]').each(function(){
						this.checked = true;
					});
				}
				else{					
					$(this).parent().parent().find('input[class=checkbox]').each(function(){
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
	</script>
@stop

@section('sidebar')
    @parent 	{{--保留父级此块内容--}}
@stop

@section('content')
	<h1 id="title" style="padding-left:20%;">所有组别：</h1>	
	<div id="toolbar" style="padding-left:30%;">
		<button id="createGroup">创建组</button>
	</div>
	<ul id="list">
		@foreach ($groups as $group)
		   	<li>
		   		<span>id:</span>
		   		<span name="id" class="id">{{ $group->id }}</span>
		   		<span>name:</span>
		   		<input name="name" type="text" disabled="true" value="{{$group->name}}" maxlength="8">
		   		<button class="resetName" url="{{url('/admin/updateGroup')}}/{{$group->id}}">编辑</button>
		   		<span class="count">人数：{{$group -> counts}}</span>
		   		<button class="showList" value="{{$group -> counts}}" url="{{url('/admin/selectGroupUsers')}}/{{$group->id}}">查看人员</button>
		   		<button class="delect" value="{{$group -> counts}}" disabled=true url="{{url('/admin/delGroup')}}/{{$group->id}}">删除该组</button>
				
		   		<div class="info"></div>
		   	</li>
		@endforeach
	</ul>		
	<script>

	</script>
@stop
