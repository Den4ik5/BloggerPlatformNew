<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 28.11.2018
 * Time: 18:25
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/posts/{id}", name="post_show")
     */
    public function show($id){
        // get a Post object - e.g. query for it
        $post = 3;
        //TODO: Add logic for creating posts.
        // check for "view" access: calls all voters
        $this->denyAccessUnlessGranted('view', $post);
    }
    /**
     * @Route("/posts/{id}/edit", name="post_edit")
     */
    public function edit($id)
    {
        // get a Post object - e.g. query for it
        $post = 3;
        //Todo: Add logic for editing a post.

        // check for "edit" access: calls all voters
        $this->denyAccessUnlessGranted('edit', $post);

        // ...
    }
}