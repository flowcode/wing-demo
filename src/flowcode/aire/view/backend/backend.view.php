<!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><? echo flowcode\enlace\Enlace::get("sitename") ?> - Admin Panel</title>
        <meta NAME="robots" CONTENT="noindex, nofollow" />
        <link rel="icon" type="image/png" href="/images/flowcode-fav.png" />


        <link rel="stylesheet" type="text/css" href="/css/boostrap.flatty.min.css"  media="screen" />
        <link rel="stylesheet" href="/css/overcast/jquery-ui-1.8.18.custom.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" >
        <link rel="stylesheet" href="/css/jquery.toastmessage.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="/css/admin.css" type="text/css" media="screen" />

        <script type="text/javascript" src="//code.jquery.com/jquery.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/jquery-ui-timepicker-addon.js"></script>
        <script type="text/javascript" src="/js/jquery.toastmessage.js"></script>
        <script type="text/javascript" src="/js/admin.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/admin"><? echo flowcode\enlace\Enlace::get("sitename") ?></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">

                <?php if (isset($_SESSION['user']['username'])): ?>
                    <ul class="nav navbar-nav">
                        <li><a href="/admin" ><i class="glyphicon glyphicon-home"></i></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Contenido <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/adminBlog/index">Posts</a></li>
                                <li><a href="/adminBlog/tags">Tags</a></li>
                                <li class="divider"></li>
                                <li><a href="/adminPage/pages">Paginas</a></li>
                                <li><a href="/adminMenu/index">Menus</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Shop <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/adminProduct/index">Productos</a></li>
                                <li><a href="/adminProductCategory/index">Categorias</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="/adminConfig/index">System</a></li>
                                <li class="divider"></li>
                                <li><a href="/adminUser/index">Users</a></li>
                                <li><a href="/adminPermission/index">User Permissions</a></li>
                                <li><a href="/adminRole/index">User Roles</a></li>
                            </ul>
                        </li>
                        <li><a href="/adminHelp" ><i class="glyphicon glyphicon-question-sign"></i></a></li>
                    </ul>

                    <div id="loading-spin"><img src="/images/ajax-loader-white.gif"></div>

                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <?php echo $_SESSION['user']['username'] ?> 
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/adminLogin/logout">Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php else: ?>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="/">Volver al portal</a></li>
                    </ul>
                <?php endif; ?>

            </div>
        </nav>

        <!-- Contenido  -->
        <div class="container">
            <?php echo $content ?>


            <div class="modal fade" id="dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Modal title</h4>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        </div>

        <div id="footer" style="height: 50px;">

        </div>



    </body>
</html>