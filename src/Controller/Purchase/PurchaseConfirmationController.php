<?php

namespace App\Controller\Purchase;

use DateTime;
use App\Entity\Purchase;
use App\Cart\CartService;
use App\Entity\PurchaseItem;
use App\Form\CartConfirmationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PurchaseConfirmationController extends AbstractController
{

    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @Route("/purchase/confirm", name="purchase_confirm")
     * @IsGranted("ROLE_USER", message="Vous devez être connecté pour confirmer une commande")
     */
    public function confirm(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(CartConfirmationType::class);

        $form->handleRequest($request);

        if(!$form->isSubmitted()){
            $this->addFlash('warning', "Vous devez remplir le formulaire de confirmation");
            $this->redirectToRoute('cart_show');
        }

        $user = $this->getUser();

        $cartItem = $this->cartService->getDetailCartItems();

        if(count($cartItem) === 0){
            $this->addFlash('warning', 'Votre panier est vide! </br> Vous ne pouver confirmer une commande avec un panier vide');
            return $this->redirectToRoute('cart_show');
        }

        /**@var Purchase */
        $purchase = $form->getData();

        dump($user);
        dump($purchase);
        $purchase->setUser($user)
                ->setPurchasedAt(new DateTime())
                ->setTotal($this->cartService->getTotal());

        
        $em->persist($purchase);

        foreach($this->cartService->getDetailCartItems() as $cartItem){
            $purchaseItem = new PurchaseItem;
            $purchaseItem->setPurchase($purchase)
                    ->setProduct($cartItem->product)
                    ->setProductName($cartItem->product->getName())
                    ->setQuantity($cartItem->qty)
                    ->setTotal($cartItem->getTotal())
                    ->setProductPrice($cartItem->product->getPrice());


        $em->persist($purchaseItem);
        }


        $em->flush();

        $this->cartService->empty();

        $this->addFlash('success', "La commande a bien été enregistré");
        return $this->redirectToRoute('purchase_index');


    }
}