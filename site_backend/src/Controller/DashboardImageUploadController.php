<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class DashboardImageUploadController extends AbstractController {


    public function uploadImage(Request $request, $title) {

        //getting the date as string
        date_default_timezone_set('Asia/Dhaka');
        $date = getdate()['mday'] . getdate()['mon'] . getdate()['year'];

        $file = $request->files->get('file');
        $dir = $request->server->get('DOCUMENT_ROOT') . '/assets/images';

        $fileName = str_replace(' ','-',$title) .'-'. $date .'-'. substr(md5($file->getClientOriginalName()), 0, 5) . '.' . $file->guessExtension();
        $file->move($dir, $fileName);

        $response = new JsonResponse();
        $response->setData(['location' => $request->getUriForPath('/assets/images/' . $fileName)]);

        return $response;
    }

}
