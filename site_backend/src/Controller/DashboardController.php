<?php

namespace App\Controller;


use App\Entity\Blogpost;
use App\Entity\Category;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends AbstractController {

    public function dashboard(Request $request, PaginatorInterface $paginator) {

        $repository = $this->getDoctrine()->getRepository(Category::class);
        $cats = $repository->findAll();


        $repository = $this->getDoctrine()->getRepository(Blogpost::class);
        $myblogs = $repository->findBy(
            array(),
            array('id' => 'DESC')

        );
        $myblogs = $paginator->paginate(
            $myblogs,
            $request->query->getInt('page', 1),
            4
        );

        return $this->render('dashboard/dashboard.html.twig', ['cats' => $cats,'blogs' => $myblogs]);
    }



}
