<?php

namespace App\Controller;


use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class DashboardController extends AbstractController {

    public function dashboard() {

        $repository = $this->getDoctrine()->getRepository(Category::class);
        $cats = $repository->findAll();

        return $this->render('dashboard/dashboard.html.twig', ['cats' => $cats,]);
    }



}
