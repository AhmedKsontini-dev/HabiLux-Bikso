<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendConfirmationEmail(string $to, string $confirmationToken): void
    {
        $email = (new Email())
            ->from('Info@HabiLux.com') // L'email de l'expéditeur
            ->to($to)
            ->subject('Confirmez votre adresse email')
            ->html(
                '<html>
                    <head>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                background-color: #f4f4f4;
                                margin: 0;
                                padding: 0;
                            }
                            .email-container {
                                width: 100%;
                                max-width: 600px;
                                margin: 0 auto;
                                background-color: #ffffff;
                                border-radius: 8px;
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                padding: 30px;
                            }
                            .header {
                                text-align: center;
                                margin-bottom: 20px;
                            }
                            .header h1 {
                                color: #333333;
                                font-size: 28px;
                            }
                            .content {
                                font-size: 16px;
                                line-height: 1.6;
                                color: #555555;
                            }
                            .cta {
                                display: block;
                                width: 100%;
                                padding: 12px;
                                background-color: #007BFF;
                                color: #ffffff;
                                text-align: center;
                                font-size: 18px;
                                text-decoration: none;
                                border-radius: 5px;
                                margin-top: 20px;
                            }
                            .cta:hover {
                                background-color: #0056b3;
                            }
                            .footer {
                                text-align: center;
                                font-size: 14px;
                                margin-top: 30px;
                                color: #aaaaaa;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="email-container">
                            <div class="header">
                                <h1>Bienvenue chez HabiLux !</h1>
                            </div>
                            <div class="content">
                                <p>Bonjour,</p>
                                <p>Merci de vous être inscrit sur notre plateforme. Pour activer votre compte et commencer à utiliser nos services, veuillez confirmer votre adresse email en cliquant sur le bouton ci-dessous :</p>
                                <a href="http://localhost:8000/confirm/'.$confirmationToken.'" class="cta">Confirmer mon compte</a>
                            </div>
                            <div class="footer">
                                <p>Si vous n\'avez pas demandé cette inscription, vous pouvez ignorer cet email.</p>
                                <p>Merci de faire confiance à HabiLux !</p>
                            </div>
                        </div>
                    </body>
                </html>'
            );

        $this->mailer->send($email);
    }

}
