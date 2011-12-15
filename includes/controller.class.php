<?php

class controller {
    //Parent for controllers. It creates the smarty(view) class, and passes the parameters from the url.
    //It also loads the model if it exists.
    function __construct($params) {
        $this->view = new Smarty();
        $this->params = $params;
        $resource_dir = "http://".SITE_ADDR.DS."public".DS."views".DS."resources".DS;
        $this->view->assign("style_dir",$resource_dir);
        $this->view->assign("image_dir",$resource_dir.DS."images".DS);
    }

    function loadModel($model) {
        include "public" . DS . "models" . DS . "$model.php";
        $this->model = new $model();
    }


}

?>
