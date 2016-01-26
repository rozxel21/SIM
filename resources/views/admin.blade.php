<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SIM | Admin</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="_token" content="{!! csrf_token() !!}" />
        <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="{{ URL::asset('assets/css/iCheck/all.css') }}" rel="stylesheet" type="text/css" />
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <!-- Theme style -->
        <link href="{{ URL::asset('assets/css/admin.css') }}" rel="stylesheet" type="text/css" />
    </head>
    
    <body class="skin-black">   
        <header class="header">
            <a href="/admin" class="logo">SIM</a>

            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span>Axel Roz <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                <li class="dropdown-header text-center">Account</li>
                                <li>
                                    <a href="#">
                                    <i class="fa fa-user fa-fw pull-right"></i>
                                        Profile
                                    </a>
                                    <a data-toggle="modal" href="#modal-user-settings">
                                    <i class="fa fa-cog fa-fw pull-right"></i>
                                        Settings
                                    </a>
                                </li>

                                <li class="divider"></li>

                                <li>
                                    <a href="/logout"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="wrapper row-offcanvas row-offcanvas-left">
                       
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/26115.jpg" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Axel</p>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                   
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="/admin">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/user">
                                <i class="fa fa-user"></i> <span>Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/student">
                                <i class="fa fa-users"></i> <span>Students</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/college">
                                <i class="fa fa-archive"></i> <span>Colleges</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/course">
                                <i class="fa fa-glass"></i> <span>Courses</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/subject">
                                <i class="fa fa-book"></i> <span>Subjects</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#curriculum" class="collapsed" aria-expanded="false"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="curriculum" class="collapse" aria-expanded="false" style="height: 0px;">
                                <li>
                                    <a href="#">Dropdown Item</a>
                                </li>
                                <li>
                                    <a href="#">Dropdown Item</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="/admin/curriculum">
                                <i class="fa fa-book"></i> <span>Curriculum</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <aside class="right-side">
                <section class="content">
                    @yield('content')
                </section><!-- /.content -->
                    <div class="footer-main">
                        Copyright &copy SIM 2015
                    </div>
            </aside>

        </div>

        <!-- jQuery 2.0.2 -->
        <script src="../ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="{{ URL::asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>

        <!-- jQuery UI 1.10.3 -->
        <script src="{{ URL::asset('assets/js/jquery-ui-1.10.3.min.js') }}" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

        <!-- iCheck -->
        <script src="{{ URL::asset('assets/js/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>

        <!-- Director App -->
        <script src="{{ URL::asset('assets/js/Director/app.js') }}" type="text/javascript"></script>
       
        <script src="{{ URL::asset('js/config.js') }}" type="text/javascript"></script>
        
        @yield('script')
    </body>
</html>