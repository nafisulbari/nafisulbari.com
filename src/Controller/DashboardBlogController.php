<?php
namespace App\Controller;


use App\Entity\Blogpost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardBlogController extends AbstractController {

    public function dashBlogsWithCategory($id) {


        $em = $this->getDoctrine()->getManager();
        $blogsOfCatRepo = $em->getRepository(Blogpost::class);


        $allBlogsOfCatQuerry = $blogsOfCatRepo->createQueryBuilder('c')
            ->where('c.category = :id')
            ->setParameter('id', $id)
            ->getQuery();

        $blogs = $allBlogsOfCatQuerry->getResult();


        return $this->render('dashboard/blog.html.twig', ['blogs' => $blogs]);
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


        return $this->render('/dashboard/blogpost.html.twig', ['blogpost' => $blogpost]);
    }
}
