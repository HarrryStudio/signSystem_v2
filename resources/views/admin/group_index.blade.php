@extends('admin.master')

@section('head')
	<style>
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

		#list li span{
			margin-left:4rem;
		}
	</style>

	<script>
		$(function(){
			//alert($('#title').html());

			//显示人员信息
			$('.showList').click(function(){
				var info = $(this).parent();
				if(info.find("div").html()!=""){
					info.find("div").html("");
					return;
				}
					
				$.get($(this).attr('url'), function(data){
					//创建换组下拉列表
					var groupSelect = "<select>";
					//遍历 #list 中数据来获取组id,组名称
					$('#list>li').each(function(i,li){
						//alert($(this).html());
						groupSelect+="<option value ="+$(li).find("span[name=id]")+">"+$(li).find("input[name=name]").val()+"</option>";
					});

					groupSelect+="</select>";
	  				var str="";
	  				$.each(data,function(i,item){
	  					
	  					                    str+="<p><input name='ids[]' type='checkbox'> <span>" + item.id + "</span>" + 
	  					                    "<span>" + item.name    + "</span>" +
	  					                    "<span>" + item.group_id + "</span></p><hr/>";
	  				});
	  				var changGroup = "<p><input class='changGroupAll' type='checkbox'>"+groupSelect+"</p>";
					info.find("div").html(changGroup+str);
				});
			});
			
			//删除组别
			$('.delect').click(function(){
				//alert($(this).attr('url')+$(this).attr('value'));
				if($(this).attr('value')!='0'){
					alert("该组仍有成员，禁止删除！！");
					return;
				}

				var parent = $(this).parent()
				$.get($(this).attr('url'), function(data){
					alert(data.msg);
					parent.remove();
				});
			});

			var oldText = "";	//用于记录点击编辑时的文本
			//编辑昵称
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
				//alert($(this).parent().find('input').val());

				parent.find('input').removeAttr("disabled");
				parent.find('input').focus().select();
				$(this).text("提交");
				//alert(parent.find('mark').find('input').text());
			});
		});
	</script>
@stop

@section('sidebar')
    @parent 	{{--保留父级此块内容--}}
@stop

@section('content')
	<h1 id="title">所有组别：</h1>	
	<div id="info"></div>
	<ul id="list">
		@foreach ($groups as $group)
		   	<li>
		   		<span name="id" class="id">id:{{ $group->id }}</span>
		   		<span>name:</span>
		   		<input name="name" type="text" disabled="true" value="{{$group->name}}">
		   		<button class="resetName" url="http://signsystem.cn:81/admin/updateGroup/{{$group->id}}">编辑</button>
		   		<span class="count">人数：{{$group -> counts}}</span>
		   		<button class="showList" value="{{$group -> counts}}" url="http://signsystem.cn:81/admin/selectGroupUsers/{{$group->id}}">查看人员（后边换ajax）</button>
		   		<button class="delect" value="{{$group -> counts}}" url="http://signsystem.cn:81/admin/delGroup/{{$group->id}}">删除该组</button>
				
		   		<div class="info"></div>
		   	</li>
		@endforeach
	</ul>		

@stop
