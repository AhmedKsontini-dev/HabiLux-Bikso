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
            ->from('Info@HabiLux.com')
            ->to($to)
            ->subject('Confirmez votre adresse email')
            ->html(
                '<html>
                    <head>
                        <style>
                            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap");
                            body {
                                font-family: "Poppins", Arial, sans-serif;
                                background-color: #f4f4f4;
                                margin: 0;
                                padding: 0;
                            }
                            .email-container {
                                width: 100%;
                                max-width: 600px;
                                margin: 20px auto;
                                background-color: #ffffff;
                                border-radius: 10px;
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                padding: 30px;
                                text-align: center;
                            }
                            .logo img {
                                width: 150px;
                                margin-bottom: 20px;
                            }
                            .header h1 {
                                color: #1C2D37;
                                font-size: 26px;
                            }
                            .content {
                                font-size: 16px;
                                line-height: 1.6;
                                color: #555555;
                                text-align: left;
                            }
                            .cta {
                                display: inline-block;
                                padding: 12px 20px;
                                background-color: #1C2D37;
                                color: #ffffff;
                                font-size: 18px;
                                text-decoration: none;
                                border-radius: 5px;
                                font-weight: 600;
                                margin-top: 20px;
                            }
                            .cta:hover {
                                background-color: #1C2D37;
                            }
                            .icon {
                                font-size: 22px;
                                color: #1C2D37;
                                margin-right: 10px;
                            }
                            .footer {
                                font-size: 14px;
                                margin-top: 30px;
                                color: #aaaaaa;
                            }
                            .footer p {
                                margin: 5px 0;
                            }
                        </style>
                        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
                    </head>
                    <body>
                        <div class="email-container">
                            <div class="header">
                                <h1>Bienvenue chez HabiLux !</h1>
                            </div>
                            <div class="content">
                                <p><i class="fas fa-user icon"></i> Bonjour,</p>
                                <p>Merci de vous être inscrit sur notre plateforme. Pour activer votre compte et accéder à toutes nos fonctionnalités, veuillez confirmer votre adresse email en cliquant sur le bouton ci-dessous :</p>
                                <a href="http://localhost:8000/confirm/' . $confirmationToken . '" class="cta">✅ Confirmer mon compte</a>
                            </div>
                            <div class="footer">
                                <p>📩 Si vous n\'avez pas demandé cette inscription, vous pouvez ignorer cet email.</p>
                                <p>Merci de faire confiance à <strong>HabiLux</strong> !</p>
                            </div>
                        </div>
                    </body>
                </html>'
            );

        $this->mailer->send($email);
    }


}
