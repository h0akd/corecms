<div class="navbar-header" id="navbar-header">                    
    <a class="navbar-brand" id="navbar-brand" href="#">Project name</a>
    <a id="menu-toggle"><i class="fa fa-bars"></i></a>
</div>        
<ul class="nav navbar-nav navbar-right" id="navbar-right">
    <!--  Menu actions notify-->
<!--    <li class="dropdown icons single-ton">
        <a class="dropdown-toggle" data-toggle="dropdown-toggle">
            <i class="fa fa-globe"></i>
            <i class="fa fa-sort-desc icon-up"></i>
        </a>
        <ul class="dropdown-menu">
            <li>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object img-rounded" style="width: 50px;height: 50px;" src="http://office.vatgia.vn/files/personnel/DSC_0322.jpg" alt="...">
                    </a>
                    <div class="media-body">
                        <b>Nguyễn Thanh Nga</b> gửi đến bạn một thông báo <b>"DANH SÁCH NHÂN VIÊN MỚI BỔ SUNG HỒ SƠ  ĐÃ CÓ MÃ CODE"</b>
                        <div>
                            <span title="09:19:03 11/01/2014" class="font90 text-frog">5 giờ trước</span>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </li>-->

    <!--  Message actions notify-->
<!--    <li class="dropdown icons single-ton">
        <a class="dropdown-toggle" data-toggle="dropdown-toggle">
            <i class="fa fa-envelope"></i>
            <i class="fa fa-sort-desc icon-up"></i>
        </a>
        <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
        </ul>
    </li>-->

    <!--  Notifycation notify -->
<!--    <li class="dropdown icons single-ton">
        <a class="dropdown-toggle" data-toggle="dropdown-toggle">
            <i class="fa fa-bell"></i>
            <i class="fa fa-sort-desc icon-up"></i>
        </a>
        <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
        </ul>
    </li>      -->

    <!--  User area menu -->
    <li class="dropdown single-ton" id="user-area">
        <a class="dropdown-toggle" data-toggle="dropdown-toggle">
            <button type="button" class="btn btn-primary btn-sm">?</button>
            <span>{{H0akd\Corecms\Models\AdminUser::find(Sentry::getUser()->id)->last_name}}</span>
            <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="#" data-id="userinfo" 
                   data-title="Thông tin tài khoản" 
                   data-url="{{URL::route("admin.users.edit",Sentry::getUser()->id)}}" 
                   data-togle="create-tab">
                    <i class="fa fa-user"></i>
                    Thông tin tài khoản
                </a>
            </li>
            <li>
                <a href="#" data-id="passwordchange" 
                   data-title="Đổi mật khẩu" 
                   data-url="{{URL::route("admin.users.change",Sentry::getUser()->id)}}" 
                   data-togle="create-tab" >
                    <i class="fa fa-key"></i>Đổi mật khẩu
                </a>
            </li>     
<!--            <li>
                <a href="#" data-id="userinfo" 
                   data-title="Đổi mật khẩu" 
                   data-url="/user/me/chan" 
                   data-togle="create-tab">
                    <i class="fa fa-tasks"></i>Quản lí công việc
                </a>
            </li>-->
<!--            <li>
                <a href="#" data-id="userinfo" 
                   data-title="Đổi mật khẩu" 
                   data-url="/user/me/chan" 
                   data-togle="create-tab">
                    <i class="fa fa-cogs"></i>Cài đặt</a>
            </li>-->
            <li class="divider"></li>
            <li><a href="{{URL::route("admin.signout")}}"><i class="fa fa-sign-out"></i>Đăng xuất</a></li>
        </ul>
    </li>
</ul>


