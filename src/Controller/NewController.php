<?php

namespace App\Controller;

use App\Taxes\Calculator;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewController
{

    protected $calculator;

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * @Route("hello/{prenom?Word}", name="hello")
     */
    public function index($prenom, Slugify $slugify)
    {


        $tva = $this->calculator->calcul(100);

        dump($slugify->slugify("hello Olivier"));
        dump($tva);

       return new Response("Hello $prenom");

    }
}