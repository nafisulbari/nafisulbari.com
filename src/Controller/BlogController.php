<?php


namespace App\Controller;


use App\Entity\Blogpost;
use App\Repository\BlogpostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\Query\ResultSetMapping;

class BlogController extends AbstractController {




    public function featuredBlogs() {

        $repository = $this->getDoctrine()->getRepository(Blogpost::class);
        $blogs = $repository->findAll();

        return $this->render('blog.html.twig', ['blogs' => $blogs]);
    }


}