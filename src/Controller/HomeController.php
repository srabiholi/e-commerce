<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    /**
     * @Route("home", name="home")
     */
    public function home(ProductRepository $productRepository)
    {

        

        $product = $productRepository->findAll();
        dump($product);

        return $this->render('Home/home.html.twig');
    }
}
