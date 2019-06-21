<?php


namespace App\Controller;


use App\Entity\Blogpost;
use App\Repository\BlogpostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class BlogController extends AbstractController {


    public function blogPage() {


        $repository = $this->getDoctrine()->getRepository(Blogpost::class);
        $featuredBlogs = $repository->findAll();
        $cats = $repository->createQueryBuilder('p');
        $c = $cats->select('p.category')->distinct()->getQuery()->getResult();


        return $this->render('blog.html.twig', ['blogs' => $featuredBlogs, 'cats' => $c]);
    }


}