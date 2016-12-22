<?php

namespace PartFire\SlackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PartFireSlackBundle:Default:index.html.twig');
    }
}
