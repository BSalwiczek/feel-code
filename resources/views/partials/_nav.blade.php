<nav class="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="/"><span class="font2">Feel</span> Code</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a style="{{ Request::is('/') ? "background-color: #3C93D5;":"" }}" href="/">Home</a></li>
        <li><a style="{{ Request::is('categories') ? "background-color: #3C93D5;":"" }}" href="{{ route('categories') }}">Categories</a></li>
        <li><a style="{{ Request::is('about') ? "background-color: #3C93D5;":"" }}" href="{{ route('about') }}">About</a></li>
      </ul>
      @if(Session('Login')==true)
        <ul class="nav navbar-nav navbar-right">
          <li><a href={{ route('posts.index') }}>Admin Manager</a></li>
          <li><a href="logout">Logout</a></li>
        </ul>
      @endif
    </div>
  </div>
</nav>