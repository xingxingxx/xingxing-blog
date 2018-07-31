<header class="main-header">
    <a href="{{ route('admin.index') }}" class="logo">
        <span class="logo-mini">CMS</span>
        <span class="logo-lg">Blog后台管理</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">导航</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">2</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">您有 2 条未读消息</li>
                        <li>
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="{{ asset('img/my_avatar.png') }}" class="img-circle"
                                                 alt="User Image">
                                        </div>
                                        <h4>
                                            Join
                                            <small>
                                                <i class="fa fa-clock-o"></i>
                                                3 天前
                                            </small>
                                        </h4>
                                        <p>您好！请立即处理相关任务...</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">查看所有消息</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('img/my_avatar.png') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{asset('img/my_avatar.png')}}" class="img-circle" alt="User Image">
                            <p>
                                {{ Auth::user()->name }}
                                <small>创建于:{{ Auth::user()->created_at }}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('index') }}" target="_blank" class="btn btn-default btn-flat">首页</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat">退出</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-toggle="control-sidebar">
                        <i class="fa fa-gears"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
