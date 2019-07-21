<?php


namespace App\Controller;


use App\Entity\Blogpost;
use App\Entity\Category;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends AbstractController {


    public function blogPage() {

        $repository = $this->getDoctrine()->getRepository(Blogpost::class);
        $featuredBlogs = $repository->findBy(
            array(),
            array('id' => 'DESC'),
            5
        );

        $repository = $this->getDoctrine()->getRepository(Category::class);
        $cats = $repository->findAll();


        return $this->render('blog.html.twig', ['blogs' => $featuredBlogs, 'cats' => $cats]);
    }

    public function blogsWithCategory($id, Request $request, PaginatorInterface $paginator) {

        $em = $this->getDoctrine()->getManager();
        $blogsOfCatRepo = $em->getRepository(Blogpost::class);

        $allBlogsOfCatQuerry = $blogsOfCatRepo->createQueryBuilder('c')
            ->where('c.category = :id')
            ->setParameter('id', $id)
            ->getQuery();

        $blogs = $paginator->paginate(
            $allBlogsOfCatQuerry,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('blogs.html.twig', ['blogs' => $blogs]);
    }



    public function search(Request $request, PaginatorInterface $paginator) {

        $term=$request->query->get('searchTerm');

        $em = $this->getDoctrine()->getManager();
        $blogpostRepository = $em->getRepository(Blogpost::class);

        $searchedBlogs = $blogpostRepository->createQueryBuilder('b')
            ->andWhere('b.title LIKE :searchTerm OR b.article LIKE :searchTerm')
            ->setParameter('searchTerm', '%'.$term.'%')
            ->getQuery();

        $blogs = $paginator->paginate(
            $searchedBlogs,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('search.html.twig', ['blogs' => $blogs]);
    }


}