<?php
define('BASE_PATH',realpath('.'));
define('BASE_URL', dirname($_SERVER["SCRIPT_NAME"]));
define('DS', DIRECTORY_SEPARATOR);
define('SITE_ADDR',$_SERVER["SERVER_NAME"]);

include 'includes' . DS . 'include.php';

//Define constants

if(isset($_GET['v1'])) {
    define("V1",$_GET['v1']);
}
else define("V1","home");
if(isset($_GET['v2'])) define("V2",$_GET['v2']);
if(isset($_GET['v3'])) define("V3",$_GET['v3']);
define('DB_PRE', $config['mysql']['prefix']);
if (defined("V3")) {
    $params = explode("/", V3);
}
else
    $params = array();

//Each url recieved is in the format /controller/action/param1/param2...
//The above code sets model to V1, action to V2 and params to V3. V3 is also passed to the assoc array $params.


//Check if the requested controller exists
if (file_exists('public' . DS . 'controllers' . DS . V1 . ".controller.php")) {
    //Include the requested controller.
    include 'public' . DS . 'controllers' . DS . V1 . ".controller.php";
    if (file_exists('public' . DS . 'models' . DS . V1 . ".model.php")) {
        //Include the requested model if it exists.
        include 'public' . DS . 'models' . DS . V1 . ".model.php";
    }
    $v1 = V1;
    global $params;

    //Make sure that our controller class exists, then instantiate it.
    $controllerclass = $v1."Controller";

    if (class_exists($controllerclass)) {
        $controller = new $controllerclass($params);
    }
    //If the controller class doesn't exist, draw a 404 page.
    else
        die(SendHttpError(404, 'public' . DS . 'controllers' . DS . V1 . ".controller.php"));
    //Check to see if we've action got an action to do.
    if (defined("V2")) {
        $action = V2;
        //See if the requested action is defined in the controller class.
        //if the action exists, do it.
        if (method_exists($controller, $action))
            $controller->$action();
        else
            SendHttpError(404, 'public' . DS . 'controllers' . DS . V1 . ".controller.php [$action]");
    }
    else
        $controller->index();
    //If there's no action in the url, it defaults to "index"
}

//If the controller class didn't exist, show a 404 error.
else
    SendHttpError(404, 'public' . DS . 'controllers' . DS . V1 . ".controller.php");




