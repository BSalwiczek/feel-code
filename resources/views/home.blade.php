@extends('main')

@section('title','Feel Code')

@section('logo')
<style>

.parallax-window {
    min-height: 300px;
    background: transparent;
}
</style>
<div class="logo logo-main">
	<div class="parallax-window logo-bg" data-parallax="scroll" data-image-src="../img/logo.jpg">

		<div class="fadeOnLogo">
		    <div class="logo-text">
			    <span class="font2 feel">Feel</span>
			    <span class="code">Code</span>
		    </div>
		</div>
	</div>
</div>

<script>
 $(document).ready(function(){
 	$('.parallax-window').parallax({imageSrc: '../img/logo.jpg'});
 });
</script>

@endsection

@section('content')
{{-- <p>
        <p>This is the <code>Panel</code> constructor:</p>
        <pre class="line-numbers language-c++" data-start="500">
<code>
#include &lt;iostream&gt;
#include &lt;cstdlib&gt;

using namespace std;

int main(int argc, char* argv[])
{
  for (int i=1; i<=10; i++) {
    cout << i << "hello world" << endl ;
    if ( i == 7 ) {
      cout << "that was lucky!" << endl ;
    } else {
      cout << endl ;
    }
  }
}
</code>
</p> --}}

<!-- <div class="quotes">
<i>&bdquo;{{ $quote->content }}&rdquo;</i> ~ <strong>{{ $quote->author }}</strong>
</div> -->
<div class="row">
	{{-- <div class="col-xs-12 col-sm-12 blog-home-post">
		<div class="row">

			<div class="col-xs-11 blog-home-content">
				<h1>Php - create login system</h1>
				<p>
					Fam disrupt subway tile, everyday carry schlitz enamel pin jean shorts portland thundercats tumblr intelligentsia. Swag tbh etsy, tumeric fanny pack tacos narwhal 90's locavore sriracha. Snackwave fam man braid, you probably haven't heard of them pabst 8-bit cornhole before they sold out asymmetrical vinyl craft beer thundercats try-hard fashion axe. Deep v scenester health goth tofu, man bun VHS cred whatever readymade williamsburg banh mi. Waistcoat pinterest asymmetrical bitters gastropub photo booth tumblr, live-edge enamel pin iceland vinyl brunch prism sustainable hell of. XOXO deep v bespoke, food truck unicorn humblebrag biodiesel la croix meh. Shoreditch tote bag pinterest deep v, synth paleo neutra godard fanny pack.(...)
				</p>
			</div>
			<div class="col-xs-1 blog-home-img">
				<img src="img/php.png" class="img-responsive">
			</div>
		</div>
	</div> --}}
		<?php $i=0 ?>
		@foreach($posts as $post)
		<?php $i++ ?>
		{{-- @if($i==1)
		<div class="col-sm-3 col-xs-12">
			<div class="sidebar">
				Check popular categories:
				<br>
				<ul>
					<li>PHP</li>
					<li>MySQL</li>
					<li>Laravel</li>
					<li>NodeJS</li>
					<li>Projects</li>
				</ul>
				Follow me on:
			</div>
		</div>
		@endif --}}


		<div class="col-xs-12 col-sm-10 blog-home-post">
			<div class="row">
				<div class="col-xs-11 ">
					<div class="blog-home-content">
						<div class="glyphicon glyphicon-calendar cal-and-tag"></div>
						<p class="home-post-time-cat" style="margin-right: 10px">{{ date('d M, Y',strtotime($post->created_at)) }}</p>
						<div class="glyphicon glyphicon-tags cal-and-tag"></div>
						<p class="home-post-time-cat">{{ $post->category->name }}</p>

						<div style="clear:both"></div>
						<h1 style="margin-top: 0">{{$post->title}}</h1>

						<p>
						{!! $post->home_body !!} (...)
						<br>
						</p>
						<a href="{{ route('blog.single',$post->slug) }}">(Read more..)</a>
						<br>
						<br>
					</div>
				</div>
				<div class="col-xs-1 blog-home-img">
					<img src="{{ 'photos/shares/categories/'.$post->category->homePostImg }}" class="img-responsive">
				</div>

			</div>
		</div>

		@endforeach

		</div>
		<!-- <div class="text-center posts-pagination">
				{!! $posts->links() !!}
		</div> -->

</div>



@endsection
