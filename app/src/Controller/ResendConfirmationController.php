<?php

namespace App\Controller;

use App\Service\ConfirmationEmailSender;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResendConfirmationController extends AbstractController
{
    private ConfirmationEmailSender $confirmationEmailSender;

    public function __construct(ConfirmationEmailSender $confirmationEmailSender)
    {
        $this->confirmationEmailSender = $confirmationEmailSender;
    }

    /**
     * @Route("/resend-confirmation", methods={"POST"})
     */
    public function resend()
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->getUser();

        $this->confirmationEmailSender->send($user);

        return new Response(null, 204);
    }
}
