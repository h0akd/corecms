@extends("CoreCms::layouts.module")

@section("title")
Danh sách nhóm quản trị viên
@stop

@section("content")
<table class="table table-bordered table-striped">
    <thead>
        <tr class="success">
            <td >ID</td>
            <td>Tên quyền</td>
            <td>Alias
            <td style="width: 20px;text-align: center">Sửa</td>
            <td style="width: 20px;text-align: center">Xoá</td>    
        </tr>
    </thead>
    <tbody>
        @foreach($models as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->title}}</td>
            <td>{{$row->name}}</td>
            <td style="text-align: center">{{ BSTForm::button('<span class="glyphicon glyphicon-pencil"></span>','info',array("class"=>"btn-xs","data-url"=>URL::route("admin.groups.edit",$row->id) ,"data-action"=>"edit")) }}</td>
            <td style="text-align: center">{{ BSTForm::button('<span class="glyphicon glyphicon-trash"></span>','danger',array("class"=>"btn-xs","data-url"=>URL::route("admin.groups.destroy",$row->id),"data-action"=>"delete")) }}</td>
        </tr>
        @endforeach
        <?php $left = $models->getPerPage() - $models->count(); ?>
        @for($i=0;$i<$left;$i++)
        <tr style="height: 38px"><td></td><td></td><td></td><td></td><td></td></tr>
        @endfor
    </tbody>
</table>
<div class="row">
    <div class="col-md-6">
        <div class="datatables_info"><h5>Showing {{$models->getFrom()}} to {{$models->getTo()}} of {{$models->getTotal()}}  entries</h5></div>                    
    </div>
    <div class="col-md-6">
        <div class="datatables_paginate">
            {{$models->links()}}
        </div>
    </div>
</div>
@stop