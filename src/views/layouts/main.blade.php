<!doctype html>
<html>
    <head>
        <title>{{Config::get("CoreCMS:site.title")}}</title>
        <meta name="viewport" content="width=device-width">
        <link href="/css/bootstrap.css" rel="stylesheet"> 
        <link href="/packages/h0akd/corecms/css/font-awesome.min.css" rel="stylesheet">
        <link href="/packages/h0akd/corecms/css/style.css" rel="stylesheet">
    </head>
    <body>

        <div class="navbar navbar-fixed-top" 
             id="navbar" 
             role="navigation" 
             data-toggle="autoload" 
             data-url="{{URL::route('admin.home.navbar')}}" >                 
        </div>

        <ul class="nav navbar-nav side-nav" 
            id="nav-side" 
            data-toggle="autoload" 
            data-url="{{URL::route('admin.home.sidenav')}}">                
        </ul>

        <ul id="navtabs" class="nav nav-tabs">
            <li class="active">
                <a href="#home" data-toggle="tab">Trang chủ</a>
            </li>
        </ul>
        <div id="navtab-contents" class="tab-content">
            <div class="tab-pane fade active in" id="home">
                <iframe data-src="{{URL::route('admin.home.dashboard')}}" src="{{URL::route('admin.home.dashboard')}}"></iframe>
            </div>
        </div>
        <script src="/packages/h0akd/corecms/js/jquery.js"></script>
        <script src="/packages/h0akd/corecms/js/bootstrap.js"></script>
        <script src="/packages/h0akd/corecms/js/scripts.js"></script>
    </body>
</html>