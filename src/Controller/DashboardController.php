<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController {

    public function dashboard() {

        $number = random_int(0, 100);

        return $this->render('dashboard/dashboard.html.twig', ['number' => $number,]);
    }
}
