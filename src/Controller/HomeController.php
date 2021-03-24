<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    /**
     * @Route("home", name="home")
     */
    public function home(ProductRepository $productRepository)
    {
        $products = $productRepository->findBy([], [], 3);

        return $this->render('Home/home.html.twig', [
            'products' => $products,
        ]);
    }
}
