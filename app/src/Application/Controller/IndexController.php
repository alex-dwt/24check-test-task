<?php

namespace App\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/")
 */
class IndexController extends AbstractController
{
    /**
     * @Route()
     * @Method("GET")
     */
    public function getAction()
    {
        return $this->render('layout.html.twig');
    }
}