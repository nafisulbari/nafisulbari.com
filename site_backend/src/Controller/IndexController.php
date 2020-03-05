<?php


namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController{

    public function motd(){

        $message="Hello MF";
        return $this->render('index.html.twig', ['message' =>$message]);
    }



    public function index() {

        return $this->render('index.html.twig');
    }


    public function about() {

        return $this->render('about.html.twig');
    }

}