<?php

namespace Clemenger\CommentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ClemengerCommentBundle:Default:index.html.twig', array('name' => $name));
    }
}
