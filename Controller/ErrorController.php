<?php
/**
 * Created by PhpStorm.
 * User: pancho
 * Date: 7/4/17
 * Time: 6:08 PM
 */

namespace Pizza\Controller;


class ErrorController extends MainController
{
    function index() {
//        $data['title'] = 'List products';
//        $data['test'] = $this->request->query->get('test');
        echo $this->template->render('error.twig');
    }

}