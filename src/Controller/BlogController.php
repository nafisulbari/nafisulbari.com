<?php


namespace App\Controller;



use App\Entity\Blogpost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController{






    public function featuredBlogs(){

        $repository = $this->getDoctrine()->getRepository(Blogpost::class);
        $blogs = $repository->findAll();

        return $this->render('blog.html.twig', ['blogs' =>$blogs]);
    }




}