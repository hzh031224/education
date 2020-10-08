<div class="left-side sticky-left-side">

    <!--logo and iconic logo start-->
    <div class="logo">
        <a href="index.html"><img src="/static/admin/images/logo.png" alt=""></a>
    </div>

    <div class="logo-icon text-center">
        <a href="index.html"><img src="/static/admin/images/logo_icon.png" alt=""></a>
    </div>
    <!--logo and iconic logo end-->

    <div class="left-side-inner">

        <!-- visible to small devices only -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">
            <div class="media logged-user">
                <img alt="" src="/static/admin/images/photos/user-avatar.png" class="media-object">
                <div class="media-body">
                    <h4><a href="#">John Doe</a></h4>
                    <span>"Hello There..."</span>
                </div>
            </div>

            <h5 class="left-nav-title">Account Information</h5>
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li><a href="#"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                <li><a href="#"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
            </ul>
        </div>

        <!--sidebar nav start-->
        {{--     nav-active        --}}
        <ul class="nav nav-pills nav-stacked custom-nav">
            <li><a href="{{url('index')}}"><i class="fa fa-sign-in"></i> <span>首页</span></a></li>

            <li class="menu-list"><a href="index.html"><i class="fa fa-home"></i> <span>商品</span></a>
                <ul class="sub-menu-list">
                    <li><a href="index_alt.html">商品详情</a></li>
                    <li class="active"><a href="index.html">商品列表</a></li>
                </ul>
            </li>
            <li><a href="login.html"><i class="fa fa-sign-in"></i> <span>退出</span></a></li>

        </ul>
        <!--sidebar nav end-->

    </div>
</div>
