@extends('admin.master')

@section('head')
	<style>
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

			$('.showList').click(function(){
				//alert($(this).attr('url'));
				var info = $(this).parent();
				//info.find("div").html("");
				$.get($(this).attr('url'), function(data){
	  				//alert(data[1].name);
	  				//$("#info").html(""+data[1].name);
	  				var str="";
	  				$.each(data,function(i,item){
	  					
	  					                    str+="<p> <span>" + item.id + "</span>" + 
	  					                    "<span>" + item.name    + "</span>" +
	  					                    "<span>" + item.group_id + "</span></p><hr/>";
	  				});

					info.find("div").html(str);
				});
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
		   		<span class="id">id:{{ $group->id }}</span>
		   		<mark style="display:inline-block;margin-left:4rem; width:10rem;">name:{{$group->name}}</mark>
		   		<span class="count">人数：{{$group -> counts}}</span>
		   		<button class="showList" value="{{$group -> counts}}" url="http://signsystem.cn:81/admin/selectGroupUsers/{{$group->id}}">查看人员（后边换ajax）</button>
		   		<button class="delect">删除该组</button>

		   		<div class="info"></div>
		   	</li>
		@endforeach
	</ul>		

@stop
