<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 28.11.2018
 * Time: 18:25
 */
declare(strict_types=1);
namespace App\Controller;


use App\Entity\Post;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PostController
 * @package App\Controller
 */
class PostController extends AbstractController
{

    /**
     * "@Route "/post/{id}", name="post_show"
     * @param Post $post
     * @return Response
     */
    public function show(Post $post): Response
    {
        return $this->render('menu/MyProfile/show.html.twig',
            ['post' => $post]);
    }

    /**
     * @param User $postCreator
     * @return Response
     */
    public function userPost(User $postCreator)
    {
        $posts= $this->getDoctrine()->getRepository(Post::class)
            ->findBy(
                ['postCreator' => $postCreator]
            );

        return $this->render('menu/user-post.html.twig',
            [
                'posts' => $posts,
                'user' => $postCreator,
            ]);
    }

  /**  public function like(Post $post)
    {
        $currentUser = $this->getUser();

        if (!$currentUser instanceof User)
        {
            return new JsonResponse([], Response::HTTP_UNAUTHORIZED);
        }
        $post->like($currentUser);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse([
            'count' => $post->getLikedBy()->count()
        ]);
    }


    public function unlike(Post $post)
    {
        $currentUser = $this->getUser();

        if (!$currentUser instanceof User)
        {
            return new JsonResponse([], Response::HTTP_UNAUTHORIZED);
        }
        $post->getLikedBy()->removeElement($currentUser);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse([
            'count' => $post->getLikedBy()->count()
        ]);
    }*/
}