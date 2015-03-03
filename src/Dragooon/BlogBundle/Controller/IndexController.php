<?php
/**
 * Default controller for our blog
 *
 * @author Shitiz Garg
 * @copyright 2015 Shitiz Garg <mail@dragooon.net>
 * @license The MIT License
 */

namespace Dragooon\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    /**
     * Default view, shows 10 latests posts in our blog
     *
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getRepository('\Dragooon\BlogBundle\Entity\Post')->findLatest(10);

        return $this->render('DragooonBlogBundle:Default:index.html.twig', array('posts' => $posts));
    }
}