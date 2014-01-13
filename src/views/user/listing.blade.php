@extends("CoreCms::layouts.module")

@section("title")
Danh sách các quản trị viên
@stop

@section("content")
<table class="table table-bordered table-striped">
    <thead>
        <tr class="success">
            <td style="width: 40px;text-align: center">ID</td>
            <td>Họ</td>
            <td>Tên</td>
            <td>Email</td>
            <td style="width: 80px;text-align: center">Change Password</td>
            <td style="width: 40px;text-align: center">Active</td>
            <td style="width: 40px;text-align: center">Sửa</td>
        </tr>
    </thead>
    <tbody>
        @foreach($models as $row)
        <tr style="height: 38px">
            <td>{{$row->id}}</td>
            <td>{{$row->first_name}}</td>
            <td>{{$row->last_name}}</td>
            <td>{{$row->email}}</td>
            <td style="text-align: center">{{ BSTForm::button('<i class="fa fa-key"></i>','warning',array("class"=>"btn-xs","data-url"=>URL::route("admin.users.change",$row->id) ,"data-action"=>"edit")) }}</td>
            <td style="text-align: center">{{ BSTForm::button('<i class="fa '.($row->activated?"fa-check-square":"fa-square").'"></i>','warning',array("class"=>"btn-xs","data-url"=>URL::route("admin.users.handactive",$row->id) ,"data-action"=>"active")) }}</td>
            <td style="text-align: center">{{ BSTForm::button('<span class="glyphicon glyphicon-pencil"></span>','info',array("class"=>"btn-xs","data-url"=>URL::route("admin.users.edit",$row->id) ,"data-action"=>"edit")) }}</td>
        </tr>
        @endforeach
        <?php $left = $models->getPerPage() - $models->count(); ?>
        @for($i=0;$i<$left;$i++)
        <tr style="height: 38px"><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
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