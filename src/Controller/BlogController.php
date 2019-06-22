<?php


namespace App\Controller;


use App\Entity\Blogpost;
use App\Entity\Category;
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


        $repository = $this->getDoctrine()->getRepository(Category::class);
        $cats = $repository->findAll();


//        $cats = $repository->createQueryBuilder('c');
//        $c = $cats->select('c.category')->distinct()->getQuery()->getResult();

        return $this->render('blog.html.twig', ['blogs' => $featuredBlogs, 'cats' => $cats]);
    }

    public function blogsWithCategory($id) {

        $repository = $this->getDoctrine()->getRepository(Category::class);
        $blogs = $repository->find($id)->getBlogpost();

        return $this->render('blogs.html.twig', ['blogs' => $blogs]);
    }


}