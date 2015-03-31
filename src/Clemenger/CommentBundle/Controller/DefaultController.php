<?php

namespace Clemenger\CommentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Clemenger\CommentBundle\Entity\Comment;
use Clemenger\CommentBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * Index action, display comments and handle form
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        // Create comment form
        $comment = new Comment();

        $form = $this->createForm(new CommentType(), $comment);
        $form->add('save', 'submit', array('label' => 'Submit'));

        // Let's handle the request!
        $form->handleRequest($request);
        // Validation
        if ($form->isValid()) {
            // If validation passes, persist the comment
            $em = $this->getDoctrine()->getManager();

            $em->persist($comment);
            $em->flush();

            // add flashbag
            $this->addFlash('success', 'Your message has been submitted!');
        }

        return $this->render('ClemengerCommentBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
