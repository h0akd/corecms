@extends("CoreCms::layouts.module")

@section("title")
Thêm nhóm quản trị mới
@stop

@section("content")

{{ Form::open(array("action"=>"H0akd\Corecms\Controllers\GroupController@store")) }}

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


{{ BSTForm::startGroup($errors->has('title')?"error":"")}}
{{ BSTForm::label("Tên quyền quản trị")}}
<p class="text-danger">
    {{ $errors->has('title')?$errors->first('title'): '' }}
</p>
{{ BSTForm::text("title","",array("placeholder"=>"Nhập tên quyền quản trị viên","style"=>"width:500px","max"=>"255","required"=>"true"))}}
{{ BSTForm::endGroup()}}


{{ BSTForm::startGroup($errors->has('alias')?"error":"")}}
{{ BSTForm::label("Alias của nhóm")}}
<p class="text-danger">
    {{ $errors->has('alias')?$errors->first('alias'): '' }}
</p>
{{ BSTForm::text("alias","",array("placeholder"=>"Nhập alias nhóm","style"=>"width:500px","max"=>"255","required"=>"true","pattern"=>"([a-zA-Z]|\.|_|-)+"))}}
{{ BSTForm::endGroup()}}

<br><br><br>
<table  class="table table-striped" id="table-child-menus" style="width: auto">
    <thead>
        <tr class="success">
            <td class="bolder center" style="min-width: 200px;font-size: 12px">Modules</td>
            @foreach($permistions as $permistion)
            <td class="bolder center"  style="font-size: 12px">{{$permistion->name}}</td>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($modules as $module)
        <tr>
            <td>{{$module->name}}</td>
            @foreach($permistions as $permistion)
            <td class="center">{{ BSTForm::checkbox2("","permissions[".$module->alias.".".$permistion->alias."]","1",false)}}</td>
            @endforeach
        </tr>
        @endforeach

    </tbody>
</table>




{{ BSTForm::actionButtons('Save',"Reset") }}
{{ Form::close() }}

@stop