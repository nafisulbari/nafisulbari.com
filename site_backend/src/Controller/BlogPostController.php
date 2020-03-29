<?php

namespace App\Controller;

use App\Entity\Blogpost;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Faker;


class BlogPostController extends AbstractController {

//    /**
//     * @Route("/blog/post", name="blog_post")
//     */
//    public function createPost(): Response {
//
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $blogpost = new Blogpost();
//
//        $faker = Faker\Factory::create();
//
//        $category = $this->getDoctrine()->getRepository(Category::class)->find($faker->numberBetween($min = 1, $max = 3));
//
//        $blogpost->setTitle($faker->sentence($nbWords = 6, $variableNbWords = true));
//        $blogpost->setDateCreated(6969);
//        $blogpost->setCategory($category);
//        $blogpost->setArticle($faker->paragraph($nbSentences = $faker->numberBetween($min = 10, $max = 150), $variableNbSentences = true));
//
//        $entityManager->persist($category);
//        $entityManager->persist($blogpost);
//
//        $entityManager->flush();
//
//        return new Response('Saved new product with id ' . $blogpost->getId());
//    }



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
