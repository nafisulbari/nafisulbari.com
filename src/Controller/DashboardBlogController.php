<?php
namespace App\Controller;


use App\Entity\Blogpost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    public function editBlog($id){
        $blogpost = $this->getDoctrine()
            ->getRepository(Blogpost::class)
            ->find($id);

        if (!$blogpost) {
            throw $this->createNotFoundException(
                'No blogs found for id ' . $id
            );
        }

        return $this->render('/dashboard/editblog.html.twig', ['blogpost' => $blogpost]);
    }

    public function saveButton($id, Request $request){

        $article = $request->query->get('article');


        $blogpost= $this->getDoctrine()
            ->getRepository(Blogpost::class)
            ->find($id);

        $blogpost->setArticle($article);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($blogpost);

        $entityManager->flush();


        return $this->render('/dashboard/editblog.html.twig', ['blogpost' => $blogpost]);

    }
}
