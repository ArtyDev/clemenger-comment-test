<?php
/**
 * Created by PhpStorm.
 * User: arthur
 * Date: 4/1/15
 * Time: 4:47 PM
 */

namespace Clemenger\CommentBundle\Twig;

class CommentExtension extends \Twig_Extension
{
    /**
     * @inheritDoc
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('parse_comments_references', array($this, 'parseCommentsReferences')),
        );
    }

    /**
     * Parse a single comment to replace comment references by links
     *
     * @param $comment
     * @return string
     */
    public function parseCommentsReferences($comment)
    {
        return preg_replace("/#(\d+)/", '<a href="/comment/$1">#$1</a>', $comment);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'comment_extension';
    }
}