<?php
namespace Pizza\Controller;
use Symfony\Component\HttpFoundation\Request;
/**
 * Created by PhpStorm.
 * User: pancho
 * Date: 7/4/17
 * Time: 3:49 PM
 */
class MainController
{
    protected $template;
    protected $request;
    function __construct(Request $request, \Twig_Environment $template) {
        $this->template = $template;
        $this->request = $request;
    }
}