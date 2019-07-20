<?php
namespace App\Controller;


use App\Entity\Blogpost;
use App\Entity\Category;
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

    public function editBlog($id, Request $request){
        $blogpost = $this->getDoctrine()
            ->getRepository(Blogpost::class)
            ->find($id);

        if (!$blogpost) {
            throw $this->createNotFoundException(
                'No blogs found for id ' . $id
            );
        }

        $repository = $this->getDoctrine()->getRepository(Category::class);
        $cats = $repository->findAll();




        return $this->render('/dashboard/editblog.html.twig', ['blogpost' => $blogpost, 'cats'=>$cats]);
    }

    public function editSaveButton($id, Request $request){

        $title = $request->query->get('title');
        $category_id = $request->query->get('category_id');
        $dateCreated = $request->query->get('dateCreated');
        $article = $request->query->get('article');

        $blogpost= $this->getDoctrine()
            ->getRepository(Blogpost::class)
            ->find($id);

        $blogpost->setTitle($title);

        $repository = $this->getDoctrine()->getRepository(Category::class);
        $catToSet = $repository->find($category_id);
        $blogpost->setCategory($catToSet);

        $blogpost->setDateCreated($dateCreated);
        $blogpost->setArticle($article);


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($blogpost);
        $entityManager->flush();

        $repository = $this->getDoctrine()->getRepository(Category::class);
        $cats = $repository->findAll();

        return $this->render('/dashboard/editblog.html.twig', ['blogpost' => $blogpost, 'cats'=>$cats]);

    }


    public function createBlogPost(){



        $repository = $this->getDoctrine()->getRepository(Category::class);
        $cats = $repository->findAll();


        return $this->render('/dashboard/createblogpost.html.twig', ['cats'=>$cats]);
    }

    public function createBlogPostSaveButton(Request $request) {

        $title = $request->query->get('title');
        $category_id = $request->query->get('category_id');
        $dateCreated = $request->query->get('dateCreated');
        $article = $request->query->get('article');

        $entityManager = $this->getDoctrine()->getManager();
        $blogpost = new Blogpost();

        $category = $this->getDoctrine()->getRepository(Category::class)->find($category_id);

        $blogpost->setTitle($title);
        $blogpost->setDateCreated($dateCreated);
        $blogpost->setCategory($category);
        $blogpost->setArticle($article);

        $entityManager->persist($category);
        $entityManager->persist($blogpost);

        $entityManager->flush();

        $redirectPath = '/dashboard/category/blog/post/edit/'.$blogpost->getId();

        return $this->redirect($redirectPath,201,sleep(3));



    }


    public function deleteBlogpost($id){

        $entityManager = $this->getDoctrine()->getManager();
        $blogpost = $this->getDoctrine()->getRepository(Blogpost::class)->find($id);

        $blogCat = $blogpost->getCategory();

        $entityManager->remove($blogpost);
        $entityManager->flush();

        $redirectURL = '/dashboard/category/blog/'.$blogCat->getId();
        return $this->redirect($redirectURL);

    }





}
