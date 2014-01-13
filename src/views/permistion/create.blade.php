@extends("CoreCms::layouts.module")

@section("title")
Thêm quyền quản trị mới
@stop

@section("content")

{{ Form::open(array("action"=>"H0akd\Corecms\Controllers\PermistionController@store")) }}

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

{{ BSTForm::startGroup($errors->has('name')?"error":"")}}
{{ BSTForm::label("Tên quyền quản trị")}}
<p class="text-danger">
    {{ $errors->has('name')?$errors->first('name'): '' }}
</p>
{{ BSTForm::text("name","",array("placeholder"=>"Nhập tên quyền","style"=>"width:500px","max"=>"255","required"=>"true"))}}
{{ BSTForm::endGroup()}}
{{ BSTForm::help("Tên quyền sẽ được hiển thị khi bạn phân quyền quản trị module")}}


{{ BSTForm::startGroup()}}
{{ BSTForm::label("Alias")}}
<p class="text-danger">
    {{ $errors->has('alias')?$errors->first('alias'): '' }}
</p>
{{ BSTForm::text("alias","",array("placeholder"=>"Nhập alias của quyền","style"=>"width:300px","max"=>"40","required"=>"true","pattern"=>"([a-zA-Z]|\.|_|-)+"))}}
{{ BSTForm::endGroup()}}
{{ BSTForm::help("Alias phải là một chuỗi gồm các kí tự a-z và A-Z và không có dấu cách") }}
{{ BSTForm::help("Alias sẽ được dùng để check quyền trong module") }}
{{ BSTForm::actionButtons('Save',"Reset") }}
{{ Form::close() }}

@stop