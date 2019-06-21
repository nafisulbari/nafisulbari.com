<?php

namespace App\Controller;

use App\Entity\Blogpost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BlogPostController extends AbstractController {
    /**
     * @Route("/blog/post", name="blog_post")
     */
    public function createPost(): Response {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $blogpost = new Blogpost();
        $blogpost->setTitle('ssd brah');
        $blogpost->setCategory('science');
        $blogpost->setDateCreated(6969);
        $blogpost->setArticle('79 Nigga byte stuff');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($blogpost);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id ' . $blogpost->getId());
    }



    public function show($id) {
        $blogpost = $this->getDoctrine()
            ->getRepository(Blogpost::class)
            ->find($id);

        if (!$blogpost) {
            throw $this->createNotFoundException(
                'No blogs found for id ' . $id
            );
        }


        return $this->render('blog_post/index.html.twig', ['blogpost' => $blogpost]);
        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
}
