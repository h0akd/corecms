@extends("CoreCms::layouts.module")

@section("title")
Đổi mật khẩu
@stop

@section("content")
{{ Form::open(  
                array(
                    "method"=>"PUT",
                    "action"=>array("H0akd\Corecms\Controllers\UserController@submitchange",$user_id)
                )
          ) }}

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


<!--Password-->
{{ BSTForm::startGroup()}}
{{ BSTForm::label("Mật khẩu mới")}}
<p class="text-danger">
    {{ $errors->has('password')?$errors->first('password'): '' }}
</p>
{{ BSTForm::password("password",array("style"=>"width:400px","required"=>"true","placeholder"=>"Nhập mật khẩu mới"))}}
{{ BSTForm::endGroup()}}


<!--Password-->
{{ BSTForm::startGroup()}}
{{ BSTForm::label("Nhập lại mật khẩu")}}
<p class="text-danger">
    {{ $errors->has('repassword')?$errors->first('repassword'): '' }}
</p>
{{ BSTForm::password("repassword",array("style"=>"width:400px","required"=>"true","placeholder"=>"Nhập lại mật khẩu"))}}
{{ BSTForm::endGroup()}}




<!-- Actions button -->
{{ BSTForm::actionButtons('Save',"Reset") }}
<!-- Close Form -->
{{ Form::close() }}


@stop