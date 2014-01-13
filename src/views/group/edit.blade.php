@extends("CoreCms::layouts.module")

@section("title")
<a href="{{URL::route("admin.groups.index")}}" class="btn btn-default btn-sm">Back</a>
&nbsp;&nbsp;&nbsp;Cập nhật nhóm
@stop

@section("content")

{{ Form::open(array("method"=>"PUT","action"=>array("H0akd\Corecms\Controllers\GroupController@update",$model->id))) }}

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
{{ BSTForm::text("title",$model->title,array("placeholder"=>"Nhập tên quyền","style"=>"width:500px","max"=>"255","required"=>"true"))}}
{{ BSTForm::endGroup()}}
{{ BSTForm::help("Tên quyền sẽ được hiển thị khi bạn phân quyền quản trị module")}}



{{ BSTForm::startGroup($errors->has('alias')?"error":"")}}
{{ BSTForm::label("Alias của nhóm")}}
<p class="text-danger">
    {{ $errors->has('alias')?$errors->first('alias'): '' }}
</p>
{{ BSTForm::text("alias",$model->name,array("placeholder"=>"Nhập alias nhóm","style"=>"width:500px","max"=>"255","required"=>"true","pattern"=>"([a-zA-Z]|\.|_|-)+"))}}
{{ BSTForm::endGroup()}}

<?php
$group = Sentry::findGroupById($model->id);
$groupPermissions = $group->getPermissions();
?>

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
            <?php $hasAccess = isset($groupPermissions[$module->alias . "." . $permistion->alias]) && ($groupPermissions[$module->alias . "." . $permistion->alias] == 1) ?>
            <td class="center">
                <div class="checkbox">
                    <label>
                        <i class="check-box-icon fa {{$hasAccess?"fa-check-square-o":"fa-square-o"}}"></i> 
                        <input type="hidden" name="{{"permissions[$module->alias.$permistion->alias]"}}" value="{{$hasAccess?1:0}}">
                    </label>
                </div>
            </td>
            @endforeach
        </tr>
        @endforeach

    </tbody>
</table>




{{ BSTForm::actionButtons('Save',"Reset") }}
{{ Form::close() }}
<script>
    $("#table-child-menus").on("click", '.check-box-icon', function() {
        if ($(this).hasClass("fa-check-square-o") === true) {
            $(this).removeClass("fa-check-square-o");
            $(this).addClass("fa-square-o");
            $(this).parent().find("input[type='hidden']").attr("value", 0);
        } else {
            $(this).addClass("fa-check-square-o");
            $(this).removeClass("fa-square-o");
            $(this).parent().find("input[type='hidden']").attr("value", 1);
        }
    });
</script>
@stop