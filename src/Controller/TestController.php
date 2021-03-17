<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    public function index()
    {
        dump('ça fonctionne');
        die();
    }

    /**
     * @Route("/test/{age<\d+>?0}", name="test", methods={"GET"}, host="localhost")
     */
    public function test(Request $request, $age)
    {
        //$request = Request::createFromGlobals();

        //dump($request);

        //$age = $request->attributes->get('age');

        //dd("Vous avez $age ans");

        return new Response("Vous avez $age ans");
    }
}
