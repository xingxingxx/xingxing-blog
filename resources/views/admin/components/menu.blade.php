<aside class="main-sidebar">
    <section class="sidebar">
        {{--用户信息--}}
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('img/my_avatar.png') }}" class="img-circle" alt="User Image"></div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i>在线</a>
            </div>
        </div>
        {{--搜索--}}
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="搜索...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        {{--菜单栏--}}
        <ul class="sidebar-menu">
            <li class="header">主导航</li>
            <li class="{{ url()->full()==route('admin.index')?'active':'' }}"><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i><span>我的视图</span></a></li>
            <li class="{{ url()->full()==route('admin.blog.index')?'active':'' }}"><a href="{{ route('admin.blog.index') }}"><i class="fa fa-sticky-note"></i><span>博客管理</span></a></li>
            <li class=""><a href="#"><i class="fa fa-sticky-note"></i><span>单页管理</span></a></li>
            <li class=""><a href="#"><i class="fa fa-pie-chart"></i><span>统计分析</span></a></li>
            <li class=""><a href="#"><i class="fa fa-user"></i><span>管理员</span></a></li>
            <li class=""><a href="#"><i class="fa fa-cog"></i><span>系统设置</span></a></li>
        </ul>
    </section>
</aside>
