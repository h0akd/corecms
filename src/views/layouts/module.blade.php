<!doctype html>
<html>
    <head>
        <title></title>
        <meta name="viewport" content="width=device-width">
        <link href="/packages/h0akd/corecms/css/bootstrap.css" rel="stylesheet"> 
        <link href="/packages/h0akd/corecms/css/font-awesome.min.css" rel="stylesheet">
        <link href="/packages/h0akd/corecms/css/content.css" rel="stylesheet">
        <script src="/packages/h0akd/corecms/js/jquery.js"></script>
        <script src="/packages/h0akd/corecms/js/jquery.form.js"></script>    
        @section('top-include')
        @show
    </head>
    <body>
        <div class="modules-header"> 
            <span class="modules-title">@yield('title')</span>
        </div>
        <div class="modules-content">
            @yield('content')
        </div>
        @section('bottom-include')
        @show
        <script src="/packages/h0akd/corecms/js/bootstrap.js"></script>
        <script src="/packages/h0akd/corecms/js/scripts.js"></script> 
        <script src="/packages/h0akd/corecms/js/table.js"></script>

    </body>
</html>