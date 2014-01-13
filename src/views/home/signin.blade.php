<html lang="en"><head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href="/packages/h0akd/corecms/css/bootstrap.css" rel="stylesheet">
        <link href="/packages/h0akd/corecms/css/signin.css" rel="stylesheet">
    <body style="">
        <div class="container">
            {{Form::open(array(
                            'action' => "H0akd\Corecms\Controllers\HomeController@authen",
                            "id"=>"login-form",
                            "class"=>"form-signin",
                            "role"=>"form",
                            "method"=>"POST"
                        ))}}
            <h2 class="form-signin-heading">Đăng nhập</h2>
            @if(Session::has('error')||$errors->has('password')||$errors->has('email'))
            <div class="alert alert-danger fade in">  
                <button type="button" class="close">×</button>    
                {{ Session::has('error')?Session::get('error')."</BR>":""}} 
                {{ $errors->has('email') ?$errors->first('email')."</BR>": '' }}
                {{ $errors->has('password') ?$errors->first('password')."</BR>" : '' }}
            </div>
            @endif
            <input type="username" name="email" class="form-control" placeholder="Tên tài khoản" autofocus="" required value="{{ Request::old('email')}}">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <label class="checkbox">
                <input type="checkbox" value="rememberMe"> Nhớ tài khoản
            </label>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng nhập</button>
            {{ Form::close() }}
        </div> 
        <script src="/packages/h0akd/corecms/js/jquery.js"></script>
        <script>
$(function() {
    $("input.form-control").focus(function() {
        $("div.alert").remove();
    });

    $(document).on("click", "button.close", function() {
        $(this).parent().remove();
    });
});
        </script>
    </body>
</html>