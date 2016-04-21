<?php

namespace Vel\MpdfBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VelMpdfBundle:Default:index.html.twig');
    }
}
