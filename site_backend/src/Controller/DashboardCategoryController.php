<?php
namespace App\Controller;


use App\Entity\Blogpost;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardCategoryController extends AbstractController {

    public function category(){

        $repository = $this->getDoctrine()->getRepository(Category::class);
        $cats = $repository->findAll();

        return $this->render('dashboard/category.html.twig', ['cats' => $cats]);
    }


    public function createCategory(){


        return $this->render('dashboard/createcategory.html.twig');
    }

    public function categorySaveButton(Request $request){
        $categoryName = $request->get('categoryName');

        $entityManager = $this->getDoctrine()->getManager();
        $category = new Category();
        $category->setName($categoryName);

        $entityManager->persist($category);

        $entityManager->flush();

        $redirectPath = '/dashboard/category';

        return $this->redirect($redirectPath,201,sleep(3));
    }

    public function editCategory($id){

        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);


        return $this->render('dashboard/editcategory.html.twig',['cat'=>$category]);
    }




    public function editSaveButton(Request $request, $id){

        $categoryName = $request->get('categoryName');

        $category= $this->getDoctrine()
            ->getRepository(Category::class)
            ->find($id);

        $category->setName($categoryName);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($category);
        $entityManager->flush();

        $redirectPath = '/dashboard/category';

        return $this->redirect($redirectPath,201,sleep(3));
    }


    public function deleteCategoryButton($id){
        $entityManager = $this->getDoctrine()->getManager();
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        $entityManager->remove($category);
        $entityManager->flush();

        $redirectURL = '/dashboard/category';
        return $this->redirect($redirectURL,201,sleep(3));

    }

}