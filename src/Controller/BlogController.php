<?php


namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController{

    public function categories(){

        $cat="Cat1";
        return $this->render('blog.html.twig', ['cat' =>$cat]);
    }
}