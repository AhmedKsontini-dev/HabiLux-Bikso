<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Doctrine\ORM\EntityManagerInterface;

class UserAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    private EntityManagerInterface $entityManager;

    public function __construct(private UrlGeneratorInterface $urlGenerator, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->getPayload()->getString('email');
        $password = $request->getPayload()->getString('password');

        $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $email);

        return new Passport(
            new UserBadge($email, function ($userIdentifier) {
                $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $userIdentifier]);

                if (!$user) {
                    throw new CustomUserMessageAuthenticationException('Email ou mot de passe incorrect.');
                }

                if (!$user->isVerifier()) { // Vérification si l'utilisateur est vérifié
                    throw new CustomUserMessageAuthenticationException('Votre compte n\'est pas encore vérifié.');
                }

                return $user;
            }),
            new PasswordCredentials($password),
            [
                new CsrfTokenBadge('authenticate', $request->getPayload()->getString('_csrf_token')),
                new RememberMeBadge(),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $user = $token->getUser();

        // Met à jour le statut de connexion à true
        $user->setStatus(true);
        $this->entityManager->flush();

        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            return new RedirectResponse($this->urlGenerator->generate('app_front_accueil_accueil'));
        }

        return new RedirectResponse($this->urlGenerator->generate('app_front_accueil_accueil'));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
