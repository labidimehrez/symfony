<?php

namespace Test\FrontBundle\Services;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class Mailer
{
    private $mailer;
    private $templating;
    private $adminEmail;

    private $subject;
    private $body;

    /**
     * @param $mailer
     * @param EngineInterface $templating
     */
    public function __construct($mailer, EngineInterface $templating, $adminEmail)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->adminEmail = $adminEmail;
    }

    /**
     * @param $sheet
     */
    public function sheetConfirm($sheet)
    {
        $this->subject = sprintf('Un nouvelle fiche est disponible : %s', $sheet->getName());
        $this->doTemplate('TestFrontBundle:Mails:sheetConfirm.html.twig', array('sheet' => $sheet));

        $this->send();
    }

    /**
     * @param $template
     * @param array $options
     */
    private function doTemplate($template, array $options)
    {
        $this->body = $this->templating->render($template, $options);
    }

    /**
     *
     */
    public function send()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($this->subject)
            ->setFrom('no-reply@collectify.io')
            ->setCc($this->adminEmail)
            ->setTo('admin@collectify.io')
            ->setBody($this->body)
        ;

        $this->mailer->send($message);
    }
}