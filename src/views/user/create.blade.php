@extends("CoreCms::layouts.module")

@section("title")
Thêm module mới
@stop

@section("content")
{{ Form::open(array("action"=>"H0akd\Corecms\Controllers\UserController@store")) }}

@if(Session::has('success'))
<div class="alert alert-success fade in">  
    <button type="button" class="close">×</button>    
    {{ Session::get('success')}} 
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger fade in">  
    <button type="button" class="close">×</button>    
    {{Session::get('error')}} 
</div>
@endif


<!--Email-->
{{ BSTForm::startGroup($errors->has('email')?"error":"")}}
{{ BSTForm::label("Email")}}
<p class="text-danger">
    {{ $errors->has('email')?$errors->first('email'): '' }}
</p>
{{ BSTForm::email("email","",array("placeholder"=>"Nhập địa chỉ email","style"=>"width:400px","max"=>"255","required"=>"true"))}}
{{ BSTForm::help("Địa chỉ email cũng là tên đăng nhập của quản trị viên")}}
{{ BSTForm::endGroup()}}



<!--First name-->
{{ BSTForm::startGroup(($errors->has('first_name')||$errors->has('last_name'))?"error":"")}}
{{ BSTForm::label("Họ và tên")}}
<p class="text-danger">
    {{ $errors->has('first_name')?$errors->first('first_name'): '' }}
    {{ $errors->has('last_name')?$errors->first('last_name'): '' }}

</p>
<div class="input-group">
    {{ BSTForm::text("first_name","",array("placeholder"=>"Nhập họ","style"=>"width:150px","max"=>"255","required"=>"true"))}}
    {{ BSTForm::text("last_name","",array("placeholder"=>"Nhập tên","style"=>"width:250px","max"=>"255","required"=>"true"))}}
</div>
{{ BSTForm::endGroup()}}



<!--Password-->
{{ BSTForm::startGroup()}}
{{ BSTForm::label("Mật khẩu")}}
<p class="text-danger">
    {{ $errors->has('password')?$errors->first('password'): '' }}
</p>
{{ BSTForm::password("password",array("style"=>"width:400px","required"=>"true"))}}
{{ BSTForm::endGroup()}}


<!--Password-->
{{ BSTForm::startGroup()}}
{{ BSTForm::label("Nhập lại")}}
<p class="text-danger">
    {{ $errors->has('repassword')?$errors->first('repassword'): '' }}
</p>
{{ BSTForm::password("repassword",array("style"=>"width:400px","required"=>"true"))}}
{{ BSTForm::endGroup()}}




{{ BSTForm::startGroup()}}
{{ BSTForm::label("User thuộc nhóm")}}
<table class="table table-striped table-bordered" style="width: 500px">
    <thead>
        <tr class="success">
            <td class="center">Tên nhóm</td>
            <td class="center">Quyền</td>
        </tr>
    </thead>
    <tbody>
        @foreach($groups as $group)
        <tr>
            <td class="center">{{$group->title}}</td>
            <td class="center">{{ BSTForm::checkbox2("","groups[]",$group->id,false)}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ BSTForm::endGroup()}}

{{ BSTForm::startGroup()}}
{{ BSTForm::checkbox2("Quản trị viên cấp cao","is_administrator",1,false)}}
{{ BSTForm::endGroup()}}

<!-- Actions button -->
{{ BSTForm::actionButtons('Save',"Reset") }}
<!-- Close Form -->
{{ Form::close() }}

@stop