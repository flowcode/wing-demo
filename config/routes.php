<?php

$app->setRoute("homepage", array(
    "controller" => "Page",
    "actions" => array(
        "default" => "index"
    )
));
$app->setRoute("admin", array(
    "controller" => "AdminDashboard",
    "actions" => array(
        "default" => "index"
    )
));
$app->setRoute("design-marketing", array(
    "controller" => "Page",
    "actions" => array(
        "default" => "about"
    )
));
$app->setRoute("filosofia-aire", array(
    "controller" => "page",
    "actions" => array(
        "default" => "filosofia"
    )
));
$app->setRoute("como-trabajamos", array(
    "controller" => "page",
    "actions" => array(
        "default" => "trabajamos"
    )
));
$app->setRoute("consultoria", array(
    "controller" => "page",
    "actions" => array(
        "default" => "consultoria"
    )
));
$app->setRoute("identidad", array(
    "controller" => "page",
    "actions" => array(
        "default" => "identidad"
    )
));
$app->setRoute("procesos", array(
    "controller" => "page",
    "actions" => array(
        "default" => "procesos"
    )
));
$app->setRoute("espacios", array(
    "controller" => "page",
    "actions" => array(
        "default" => "espacios"
    )
));
$app->setRoute("capacitacion", array(
    "controller" => "page",
    "actions" => array(
        "default" => "capacitacion"
    )
));
$app->setRoute("blog", array(
    "controller" => "Blog",
    "actions" => array(
        "default" => "index",
        "tag" => "index"
    )
));
$app->setRoute("adminAyuda", array(
    "controller" => "AdminHelp",
    "actions" => array(
        "default" => "index"
    )
));

?>
