<?php

namespace App\EventDispatcher;

use Psr\Log\LoggerInterface;
use App\Event\ProductViewEvent;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ProductViewSubscriber implements EventSubscriberInterface
{
    protected $logger;
    protected $mailer;

    public function __construct(LoggerInterface $logger, MailerInterface $mailer)
    {
        $this->logger = $logger;
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
            'product.view' => 'sendLog'
        ];
    }

    // public function sendLog(ProductViewEvent $productViewEvent)
    // {
    //     $this->logger->info('Produit n°'. $productViewEvent->getProduct()->getId());
    // }

    // public function sendLog(ProductViewEvent $productViewEvent)
    // {
    //     $email = new TemplatedEmail();
    //     $email->from(new Address("contact@mail.com", "infos de la boutique"))
    //         ->to("admin@mail.com")
    //         ->text("un visiteur est en train de voir la page du produit n°" . $productViewEvent->getProduct()->getId())
    //         ->htmlTemplate("emails\product_view.html.twig")
    //         ->context([
    //             'product' => $productViewEvent->getProduct()
    //         ])
    //         ->subject("Visite du produit n°" . $productViewEvent->getProduct()->getId());


    //     $this->mailer->send($email);
    // }
}
