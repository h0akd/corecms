@extends("CoreCms::layouts.module")

@section("title")
Thêm module mới
@stop

@section("content")

{{ Form::open(array("action"=>"H0akd\Corecms\Controllers\ModuleController@store")) }}

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
{{ BSTForm::label("Tên module")}}
<p class="text-danger">
    {{ $errors->has('name')?$errors->first('name'): '' }}
</p>
{{ BSTForm::text("name","",array("placeholder"=>"Nhập tên module","style"=>"width:500px","max"=>"255","required"=>"true"))}}
{{ BSTForm::endGroup()}}
{{ BSTForm::help("Tên module sẽ được hiển thị trên menu side bar")}}


{{ BSTForm::startGroup()}}
{{ BSTForm::label("Module Alias")}}
<p class="text-danger">
    {{ $errors->has('alias')?$errors->first('alias'): '' }}
</p>
{{ BSTForm::text("alias","",array("placeholder"=>"Nhập module alias","style"=>"width:300px","max"=>"40","required"=>"true","pattern"=>"([a-zA-Z]|\.|_|-)+"))}}
{{ BSTForm::endGroup()}}
{{ BSTForm::help("Module alias phải là một chuỗi gồm các kí tự a-z và A-Z và không có dấu cách") }}
{{ BSTForm::help("Module alias sẽ được dùng để check quyền") }}


<BR><BR>
<table class="table table-striped" id="table-child-menus">
    <thead>
        <tr class="success">
            <td style="width: 28%">Tiêu đề menu<BR><small>Tiêu đề hiển thị trên side menu</small></td>
            <td style="width: 28%">Tiêu đề tab<BR><small>Tiều đề hiển thị trên tab</small></td>
            <td style="width: 28%">URL<BR><small>Không cần điền root uri nếu có</small></td>
            <td style="width: 6%"></td>
            <td style="width: 10%"></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ BSTForm::text("child[0][menu-title]","",array("placeholder"=>"Nhập tên module","required"=>"true"))}}</td>
            <td>{{ BSTForm::text("child[0][tab-title]","",array("placeholder"=>"Nhập tên module","required"=>"true"))}}</td>
            <td>{{ BSTForm::text("child[0][url]","",array("placeholder"=>"Nhập tên module"))}}</td>
            <td>{{ BSTForm::button('<i class="fa fa-trash-o"></i>Bỏ','danger',array("style"=>"display:none","class"=>"del-item"))}}</td>
            <td>{{ BSTForm::button('<i class="fa fa-plus-circle"></i>Thêm nữa','info',array("class"=>"add-more"))}}</td>
        </tr>
    </tbody>
</table>


{{ BSTForm::actionButtons('Save',"Reset") }}
{{ Form::close() }}
<script>
    var count = 0;
    $("#table-child-menus>tbody").on("click", "tr>td>button.add-more", function() {
        count++;
        $(this).hide();
        var parent = $(this).parent().parent();
        $(parent).find("td > input").attr("required", 'true');
        $(parent).find("button.del-item").show();
        var html = '<tr>';
        html += '<td><input class="form-control" placeholder="Nhập tên module" name="child[' + count + '][menu-title]" type="text" value="">';
        html += '<td><input class="form-control" placeholder="Nhập tên module" name="child[' + count + '][tab-title]" type="text" value=""></td>';
        html += '<td><input class="form-control" placeholder="Nhập tên module" name="child[' + count + '][url]" type="text" value="">';
        html += '<td>{{BSTForm::button("<i class=\"fa fa-trash-o\"></i>Bỏ","danger",array("style"=>"display:none","class"=>"del-item"))}}</td>';
        html += '<td>{{BSTForm::button("<i class=\"fa fa-plus-circle\"></i>Thêm nữa","info",array("class"=>"add-more"))}}</td>';
        html += '</tr>';
        $(parent).parent().append(html);
    });

    $("#table-child-menus>tbody").on("click", "tr>td>button.del-item", function() {
        $(this).parent().parent().remove();
    });
</script>
@stop