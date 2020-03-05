<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class DashboardImageUploadController extends AbstractController {


    public function uploadImage(Request $request, $id) {
        $file = $request->files->get('file');
        $dir = $request->server->get('DOCUMENT_ROOT') . '/assets/images';

        $fileName =md5($file->getClientOriginalName()) . '.' . $file->guessExtension();
        $file->move($dir, $fileName);

        $response = new JsonResponse();
        $response->setData(['location' => $request->getUriForPath('/assets/images/' . $fileName)]);

        return $response;
    }

}
