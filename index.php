<?php

use flowcode\ceibo\data\PDOMySqlDataSource;
use flowcode\ceibo\EntityManager;
use flowcode\enlace\Enlace;

require './vendor/autoload.php';

$app = new Enlace(Enlace::$MODE_DEVELOPMENT);

/** setup */
$app->set("dir", array(
    "src" => __DIR__ . "/src",
    "log" => __DIR__ . "/log"
));
$app->set("scanneableControllers", array(
    "aire" => "\\flowcode\\aire\\controller\\"
));
$app->set("defaultController", "\\flowcode\\aire\\controller\\PageController");
$app->set("defaultMethod", "manage");
$app->set("errorMethod", "errorMethod");

$app->set("loginController", "\\flowcode\\aire\\controller\\AdminLoginController");
$app->set("loginMethod", "index");
$app->set("restrictedMethod", "restricted");

/** views layouts */
$app->set("view", array(
    "path" => __DIR__ . "/src/flowcode/aire/view",
    "layout" => array(
        "frontend" => "frontend",
        "backend" => "backend",
    )
));

/** data access */
$dataSource = new PDOMySqlDataSource();
$dataSource->setDbDsn("mysql:host=localhost;dbname=wing-demo");
$dataSource->setDbUser("root");
$dataSource->setDbPass("root");

$em = EntityManager::getInstance();
$em->setDataSource($dataSource);
$em->setMappingFilePath(__DIR__ . "/config/db/ceibo-mapping.xml");

/** other config */
$app->set("messages", array(
    "hello" => "hi",
));
$app->set("sitename", "Wing Demo");

/** routes */
require_once './config/routes.php';

/** run app */
$app->handleRequest($_SERVER['REQUEST_URI']);
?>
