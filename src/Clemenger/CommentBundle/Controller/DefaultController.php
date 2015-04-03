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
    public function indexAction(Request $request, $parentId = null)
    {
        // Comment Repository
        $repo = $this->getDoctrine()
            ->getRepository('ClemengerCommentBundle:Comment');

        // Create comment form
        $comment = new Comment();

        $form = $this->createForm(new CommentType(), $comment);
        $form->add('save', 'submit', array('label' => 'Submit'));

        // handle the request
        $form->handleRequest($request);
        // Validation
        if ($form->isValid()) {
            // Add parent comment if is set
            if(!is_null($parentId)) {
                $parentComment = $repo->find($parentId);
                if($parentComment) { // Fetch parent comment
                    $comment->setParentComment($parentComment);
                }
            }

            // If validation passes, persist the comment
            $em = $this->getDoctrine()->getManager();

            $em->persist($comment);
            $em->flush();

            // If AJAX, return the newly created comment
            if($request->isXmlHttpRequest()) {
                return $this->render('ClemengerCommentBundle:Comment:single.html.twig', array(
                    'comment' => $comment
                ));
            }

            // add flashbag
            $this->addFlash('success', 'Your message has been submitted!');
        }

        // List the lasts comments
        return $this->render('ClemengerCommentBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
            'comments' => $repo->findBy(array('parentComment'=>null), array('id' => 'DESC'))
        ));
    }

    /**
     * Single comment view
     *
     * @param $commentId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showCommentAction($commentId)
    {
        $repo = $this->getDoctrine()
            ->getRepository('ClemengerCommentBundle:Comment');
        if (!$comment = $repo->find($commentId)){ // throw 404 if comment inexistant
            throw $this->createNotFoundException();
        }

        return $this->render('ClemengerCommentBundle:Comment:show.html.twig', array(
            'comment' => $comment
        ));
    }
}
