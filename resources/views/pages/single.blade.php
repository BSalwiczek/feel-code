@extends('main')

@section('title',$post->title)

@section('logo')
<div class="logo">
	<div class="parallax-window post-bg" data-parallax="scroll" data-image-src="{{ '../photos/shares/categories/'.$post->category->bgPostImg }}"></div>

		<script>
		 $(document).ready(function(){
		 	$('.parallax-window').parallax({imageSrc: '{{ '../photos/shares/categories/'.$post->category->bgPostImg }}'});
		 });
		</script>
</div>
@endsection

@section('stylesheet')
  {!! Html::style('css/parsley.css') !!}
@endsection

@section('scripts')
{{ Html::script('js/initial.min.js') }}
{{ Html::script('js/parsley.min.js') }}
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.0/jquery.scrollTo.min.js"></script>
@endsection

@section('content')


	<div class="post">
		<h1 class="post-title">{{ $post->title }}</h1>
		{!! $post->body !!}
		<hr>
		<div id="tags">
		</div>


		<style>
			h3>a{
				margin-left: 10px;
				font-size: 0.9em;
				color: #333;
				opacity: 0.1;
				text-decoration: none;
			}
			h3>a:hover{
				color: #333;
				opacity: 0.9;
				text-decoration: none;
			}
			h3>a:active, h3>a:visited, h3>a:link{
				text-decoration: none;
			}
		</style>
	</div>

	<div class="write-com">
		<div class="comments">
			<h1 class="text-center">Write comment</h1>
			{{ Form::open(['route'=>['comments.store',$post->id],'id'=>'comment']) }}
				<div class="row">
				<div style="margin-top: 30px">
					<div class="col-sm-5 col-sm-offset-1">
						{{ Form::text('name',Session::has('com_name')?Session::get('com_name'):null,['class'=>'form-control','placeholder'=>'Name','style'=>'margin-top: 10px','required'=>'', 'maxlength' => '255']) }}
					</div>
					<div class="col-sm-5">
						{{ Form::text('email',Session::has('com_email')?Session::get('com_email'):null,['class'=>'form-control','placeholder'=>'Email (not displayed)','style'=>'margin-top: 10px','required'=>'', 'maxlength' => '255', 'data-parsley-type'=>'email']) }}
					</div>
				</div>
					<div class="col-sm-10 col-sm-offset-1">
						{{ Form::textarea('comment',null,['class'=>'form-control','style'=>'margin-top: 10px','rows'=>'5','data-autoresize','required'=>'','data-parsley-minlength'=>'5', 'data-parsley-maxlength' => '2000']) }}
						<div class="col-sm-8 col-sm-offset-2">
						{{ Form::submit('Comment now!',['class'=>'btn btn-block btn-success sendCom', 'id'=>'sendCom']) }}
						{{-- <div class="btn btn-block btn-success" id="sendCom" style="margin-top: 20px">Send comment</div> --}}
						</div>
					</div>
				</div>
				{{ Form::close() }}
				<div id="error"></div>
		</div>
	</div>

{{-- @for($i=5;$i<8;$i++)
		<div class="comment" id="comment{{$i}}">
			<img data-name='+"item.name+"+' class="profile img-circle">
			<div class="name-date">
				<div class="com-name"><b>'+"item.name+"+'</b></div>
				<div class="com-date">'+date+'</div>
			</div>
			<div class="com-content">'+content+'
			</div>
			<div class="reply text-right"><span>Reply ↓</span></div>
			<div class="subcomments">
				<div class="your-subcom">


				{{ Form::open(['route'=>['comments.store',$post->id],'id'=>'repComment']) }}
				<div class="row">
				<div style="margin-top: 10px">
					<div class="col-sm-5 col-sm-offset-1">
						{{ Form::text('sub_name',Session::has('com_name')?Session::get('com_name'):null,['class'=>'form-control','placeholder'=>'Name','required'=>'', 'maxlength' => '255']) }}
					</div>
					<div class="col-sm-5">
						{{ Form::text('sub_email',Session::has('com_email')?Session::get('com_email'):null,['class'=>'form-control','placeholder'=>'Email (not displayed)','required'=>'', 'maxlength' => '255', 'data-parsley-type'=>'email']) }}
					</div>
				</div>
					<div class="col-sm-10 col-sm-offset-1">
						{{ Form::textarea('sub_comment',null,['class'=>'form-control','style'=>'margin-top: 10px','rows'=>'5','data-autoresize','required'=>'','data-parsley-minlength'=>'5', 'data-parsley-maxlength' => '2000']) }}
						<div class="col-sm-8 col-sm-offset-2">
						{{ Form::submit('Reply now!',['class'=>'btn btn-success sendCom btn-block', 'id'=>'replyCom']) }}
						</div>
					</div>
				</div>
				{{ Form::close() }}



				</div>
				<div class="another-subcom">Some subcomments...</div>
			</div>
		</div>
@endfor --}}

		<div class="allComments">
			
		</div>


		<script>
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		$('document').ready(getComments());
		//upload comment
		$('#sendCom').click(function(){
			alert($('[name="comment"]').val());
			$.ajax({
				method:'POST',
				url: '{{ route('comments.store',$post->id) }}',
				data: {
					'name': $('[name="name"]').val(),
					'email': $('[name="email"]').val(),
					'comment': $('[name="comment"]').val(),
				},
				success: function(data){
					alert(data);
					getComments();
					$('[name="comment"]').val('');
					$('form#comment').parsley().reset();
					$.scrollTo($('.allComments'),{
					  over: {top:-0.01},
					  duration: 800
					});
				},
			});
			
		});

		function makeReplyButtonWorks(){
			$('button.replyCom').each(function(){
				$(this).on("click",function(){
					var comTextID = $(this).parent().parent().parent().parent().parent().parent().parent().attr('id');
					var comID = parseInt(comTextID.substr(7));
					$.ajax({
						method:'POST',
						url: '{{ url('sub-comments') }}'+'/'+comID,
						data: {
							'name': $(this).parent().parent().parent().find(".name-email>.name>input").val(),
							'email': $(this).parent().parent().parent().find(".name-email>.email>input").val(),
							'comment': $(this).parent().parent().find('textarea').val()
						},
						success: function(data){
							$('#comment'+data).hide().fadeIn(1000);
							// $('[sub_name="comment"]').val('');
							// $('form.repComment').parsley().reset();
							// $.scrollTo($('.allComments'),{
							//   over: {top:-0.01},
							//   duration: 800
							// });
						},
						error: function(jqXHR, textStatus, errorThrown) {
					        $('#error').html(JSON.stringify(jqXHR));
					        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
				   		}


					});
				})
			})
		}

		function getComments(){
			$.ajax({
				method:'POST',
				url: '../postComments',
				data: { 'id' :{{ $post->id }} },
				dataType: 'JSON',
				success: function(data){
					$('.allComments').empty();
					$('.allComments').hide();
					data['comments'].forEach(function(item,index){

						var date = new Date(item.created_at);
						var yyy = date.getFullYear().toString();
						var mm = "";
						if(date.getMonth()+1 < 10)
							mm = "0"+(date.getMonth()+1).toString();
						else
							mm = (date.getMonth()+1).toString();
						var dd = "";
						if(date.getDate() < 10)
							dd = "0"+date.getDate().toString();
						else
							dd = date.getDate().toString();
						var hh = "";
						if(date.getHours() < 10)
							hh = "0"+date.getHours().toString();
						else
							hh = date.getHours().toString();
						var mi = "";
						if(date.getMinutes() < 10)
							mi = "0"+date.getMinutes().toString();
						else
							mi = date.getMinutes().toString();

	    				date = hh+":"+mi+" "+dd+"/"+mm+"/"+yyy;

	    				var content = item.comment.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '<br />');
						var comment = '<div class="comment" id="comment'+item.id+'"><img data-name='+item.name+' class="profile img-circle"><div class="name-date"><div class="com-name"><b>'+item.name+'</b></div><div class="com-date">'+date+'</div></div><div class="com-content">'+content+'</div><div class="reply text-right"><span>Reply ↓</span></div><div class="subcomments"><div class="your-subcom"></div><div class="another-subcom"></div></div></div>';
						$(".allComments").append(comment);
						$('.profile').initial({height: 40,width: 40, fontSize: 16});



						// var comment = "<div class=\"comment\" id=\"comment"+item.id+"\"><img data-name=\""+item.name+"\" class=\"profile img-circle\"><div class='name-date'><div class=\"com-name\"><b>"+item.name+"</b></div><div class=\"com-date\">"+date+"</div></div><div class=\"com-content\">"+content+"</div></div>";
					})

					$('.allComments').fadeIn('1000');
					initializeAllReply();
				},
				error: function(jqXHR, textStatus, errorThrown) {
			        // $('#error').html(JSON.stringify(jqXHR));
			        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
		   		},

			});
		}
		
		//autoresize textarea
		jQuery.each(jQuery('textarea[data-autoresize]'), function() {
		    var offset = this.offsetHeight - this.clientHeight;
		 
		    var resizeTextarea = function(el) {
		        jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
		    };
		    jQuery(this).on('keyup input', function() { resizeTextarea(this); }).removeAttr('data-autoresize');
		});

		//do not submit comment form
		$(function () {
		  $('form#comment').parsley().on('form:submit', function() {
		    return false;
		  });
		});

		//do not submit subcomment form
		$(function () {
		  $('form.repComment').each(function(){
			  	this.parsley().on('form:submit', function() {
			    return false;
			  });
			});
		});

		//add linkt to every h3 tag
		$('document').ready(function(){
				$('h3>a').addClass("glyphicon glyphicon-link");

				$('h3>a').each(function(){
					var idh3 = this.id;
					$(this).attr('href','#'+idh3);
				});
				
			})
		//display tags
		$('document').ready(function(){
			var tags = "{{ $post->tags }}";
			var res = tags.split(",");
			res.forEach(function(item,index){
				$("#tags").append("<span class='tag'>"+item+"</span>");
			});
				
		});

	//reply comments
	function initializeAllReply(){
		$(".reply").each(function(){
			$(this).on("click",function(){
				var comID = $(this).parent().attr('id');
				if($(this).text()=="Reply ↓")
				{
					$("#"+comID+">.subcomments>.your-subcom").empty().append('{{ Form::open(['route'=>['sub-comments.store','+comID+'],'class'=>'repComment','onsubmit'=>'false']) }}<div class=\"row\"><div style=\"margin-top: 10px\" class=\"name-email\"><div class=\"col-sm-5 name col-sm-offset-1\">{{ Form::text('sub_name',Session::has('com_name')?Session::get('com_name'):null,['class'=>'form-control','placeholder'=>'Name','required'=>'', 'maxlength' => '255']) }}</div><div class=\"col-sm-5 email\">{{ Form::text('sub_email',Session::has('com_email')?Session::get('com_email'):null,['class'=>'form-control','placeholder'=>'Email (not displayed)','required'=>'', 'maxlength' => '255', 'data-parsley-type'=>'email']) }}</div></div><div class=\"col-sm-10 col-sm-offset-1\">{{ Form::textarea('sub_comment',null,['class'=>'form-control','style'=>'margin-top: 10px','rows'=>'5','data-autoresize','required'=>'','data-parsley-minlength'=>'5', 'data-parsley-maxlength' => '2000']) }}<div class=\"col-sm-8 col-sm-offset-2\">{{ Form::button('Reply now!',['class'=>'btn btn-success sendCom btn-block replyCom']) }}</div></div></div>{{ Form::close() }}');
					$("#"+comID+">.subcomments>.your-subcom>form").hide().fadeIn(300);
					$(this).html("<span>Hide Reply</span>");
					$("#"+comID+">.subcomments").show();
					makeReplyButtonWorks();
				}else if($(this).text() == "Hide Reply")
				{
					$(this).html("<span>Reply ↓</span>");
					$("#"+comID+">.subcomments>.your-subcom>form").fadeOut(200);

					var content = $(this).parent().find(".subcomments").find(".another-subcom").html();
					content = (content.trim) ? content.trim() : content.replace(/^\s+/,'');
					if(content==="")
						$(this).parent().find(".subcomments").fadeOut(200);
				}
			});
		});
	}
		{{--
		$(".reply").click(function(){
					var comID = $(this).parent().parent().attr('id');
					alert(comID);
					$("#"+comID+">.subcomments>.your-subcom").empty().append('{{ Form::open(['route'=>['sub-comments.store','+comID+'],'class'=>'repComment','onsubmit'=>'false']) }}<div class=\"row\"><div style=\"margin-top: 10px\" class=\"name-email\"><div class=\"col-sm-5 name col-sm-offset-1\">{{ Form::text('sub_name',Session::has('com_name')?Session::get('com_name'):null,['class'=>'form-control','placeholder'=>'Name','required'=>'', 'maxlength' => '255']) }}</div><div class=\"col-sm-5 email\">{{ Form::text('sub_email',Session::has('com_email')?Session::get('com_email'):null,['class'=>'form-control','placeholder'=>'Email (not displayed)','required'=>'', 'maxlength' => '255', 'data-parsley-type'=>'email']) }}</div></div><div class=\"col-sm-10 col-sm-offset-1\">{{ Form::textarea('sub_comment',null,['class'=>'form-control','style'=>'margin-top: 10px','rows'=>'5','data-autoresize','required'=>'','data-parsley-minlength'=>'5', 'data-parsley-maxlength' => '2000']) }}<div class=\"col-sm-8 col-sm-offset-2\">{{ Form::button('Reply now!',['class'=>'btn btn-success sendCom btn-block replyCom']) }}</div></div></div>{{ Form::close() }}');
					$("#"+comID+">.subcomments>.your-subcom>form").hide().fadeIn(300);
					$("#"+comID+">.subcomments").show();
					makeReplyButtonWorks();
			});
			--}}

			//hide subcon if empty
				$("document").ready(function(){
					$('.another-subcom').each(function(){
						var content = this.innerHTML;
						content = (content.trim) ? content.trim() : content.replace(/^\s+/,'');
						if(content==="")
							$(this).parent().hide();
					});
				});

		</script>


@endsection