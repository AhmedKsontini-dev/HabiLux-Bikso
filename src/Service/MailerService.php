<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail(string $from, string $to, string $subject, string $content)
    {
        $email = (new Email())
            ->from($from) // Expéditeur : Email saisi dans le formulaire
            ->to($to) // Destinataire : Info@HabiLux.com
            ->subject($subject)
            ->html($content);

        $this->mailer->send($email);
    }
}
