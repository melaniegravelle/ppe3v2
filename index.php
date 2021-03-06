<?php
session_start();

require 'autoload.php';
require_once 'vendor/autoload.php';

ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

$controllers = ['index', 'connexion' ,'utilisateurs', 'resultats', 'equipes'];

/*
 * On teste si le paramètre controller existe
 * et correspond à un contrôleur de la liste $controllers
 */
if (isset($_REQUEST['controller']) and in_array($_REQUEST['controller'], $controllers)) {
    $controllerName = ucfirst( $_REQUEST['controller'] );
} else {
    $controllerName = ucfirst( $controllers[0] );
}

$nameSpaceController = 'controller';
$className = $controllerName . 'Controller';
$classNamePath = $nameSpaceController . '\\' . $className;
$fileName = 'controller/' . $className . '.php';


if( file_exists( $fileName ) ) {
    if (class_exists($classNamePath)) {
        $controller = new $classNamePath();
    } else {
        exit( 'Error : class not exist !');
    }
} else {
    exit("Error 404: file not found!");
}



