<?php

namespace Test\FrontBundle\Services;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class MailerListener
{
    private $mailer;
    private $sheetManager;

    public function __construct(Mailer $mailer, SheetManager $sheetManager)
    {
        $this->mailer = $mailer;
        $this->sheetManager = $sheetManager;
    }

    public function process(GetResponseEvent $event)
    {
        $attributes = $event->getRequest()->attributes;
        if ('test_front_sheet_success' === $attributes->get('_route')) {
            $this->doMail($attributes->get('id'));
        }
    }

    public function doMail($id)
    {
        $this->mailer->sheetConfirm($this->sheetManager->getSheet($id));
    }
}