<?php

/*
 * this controller is easy, just displays the home page.
 */

class homeController extends controller {

    function index() {

        $this->view->assign("title", 'MineCMS');
        $this->view->display('home/index.tpl');
    }

}

?>