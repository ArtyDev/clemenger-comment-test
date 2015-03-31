<?php

namespace Clemenger\CommentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Clemenger\CommentBundle\Entity\Comment;
use Clemenger\CommentBundle\Form\CommentType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $comment = new Comment();

        $form = $this->createForm(new CommentType(), $comment);
        $form->add('save', 'submit', array('label' => 'Submit'));

        return $this->render('ClemengerCommentBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
