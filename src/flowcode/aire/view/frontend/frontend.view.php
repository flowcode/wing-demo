<!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo \flowcode\enlace\Enlace::get("sitename"); ?></title>
        <link rel="icon" type="image/png" href="/images/flowcode-fav.png" />

        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css"  media="screen" />
        <link rel="stylesheet" href="/css/frontend.css" type="text/css" media="screen" />

        <script type="text/javascript" src="//code.jquery.com/jquery.js"></script>
        <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <script src="/js/global.js" type="text/javascript" ></script>
    </head>

    <body>

        <!--          Aca va el contenido del header  -->
        <div id="header">
            <div class="container">
                <span class="title">Wing Demo</span>
                <ul id="main-menu" class="nav nav-pills pull-right">
                    <li class="active"><a href="/">Inicio</a></li>
                    <?php $menu = \flowcode\aire\controller\MenuController::getMenu("1"); ?>
                    <?php $items = $menu->getMainItems(); ?>
                    <?php foreach ($items as $item): ?>
                        <? if ($item->getSubItems()->count() > 0): ?>
                            <li class="dropdown" id="menu-<?php echo $item->getId(); ?>">
                                <?php if ($item->getLinkUrl() != ""): ?>
                                    <a class="dropdown-toggle" href="<?php echo $item->getLinkUrl(); ?>" ><?php echo $item->getName(); ?></a>
                                <?php else: ?>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#menu-<?php echo $item->getId(); ?>">
                                        <?php echo $item->getName(); ?>
                                        <b class="caret"></b>
                                    </a>
                                <?php endif; ?>
                                <ul class="dropdown-menu">
                                    <?php foreach ($item->getSubItems() as $subitem): ?>
                                        <li>
                                            <?php if ($subitem->getPage() != NULL): ?>
                                                <a href="/<?php echo $subitem->getUrl() ?>"><?php echo $subitem->getName() ?></a>
                                            <?php else: ?>
                                                <?php if ($subitem->getLinkUrl() != ""): ?>
                                                    <a href="<?php echo $subitem->getLinkUrl(); ?>" ><?php echo $subitem->getName(); ?></a>
                                                <?php else: ?>
                                                    <a><?php echo $subitem->getName(); ?></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <? else: ?>
                            <li><a href="<?php echo $item->getLinkUrl(); ?>" ><?php echo $item->getName(); ?></a></li>
                        <? endif; ?>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>

        <!-- Contenido  -->
        <div id="content" >
            <div class="container">
                <?php echo $content ?>
            </div>
        </div>

        <!--                  Aca va el contenido del footer  -->
        <div id="footer" class="footer">
            <div class="container">
                <p class="powered">Powered by <span class="logo-small">Wing</span></p>
            </div>
        </div>

    </body>
</html>