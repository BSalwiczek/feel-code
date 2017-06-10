
<title> @yield('title') </title>
<meta charset = "utf-8">
<meta name ="description" content = "Feel code with us! You can lern about new technologies, programming languages nad much more !">
<meta name ="keywords" content = "programming,computer,technologies">
<meta http-equiv = "X-UA-Compatible" content = "IE=edge, chrome=1">
<meta name="author" content="Bartosz Salwiczek">

<link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

<meta name="csrf-token" content="{{ csrf_token() }}" >
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

{{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.7.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.7.0/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script> --}}

{{ Html::style('css/style.css') }}
{{ Html::style('css/prism.css') }}
{{ Html::script('js/prism.js') }}
{{ Html::script('js/parallax.min.js') }}

@yield('stylesheet')
@yield('scripts')

