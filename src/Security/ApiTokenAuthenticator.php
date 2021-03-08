<?php

namespace App\Security;

use App\Repository\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use function Symfony\Component\String\u;

class ApiTokenAuthenticator extends AbstractAuthenticator
{
    const HEADER_PREFIX = 'Bearer ';

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function supports(Request $request): bool
    {
        return u($request->getPathInfo())->startsWith('/api');
    }

    public function authenticate(Request $request): PassportInterface
    {
        $tokenValue = $this->getAuthorizationToken($request);
        $userBadge = new UserBadge(
            $tokenValue, function ($tokenValue) {
            $user = $this->userRepository->findOneByToken($tokenValue);

            if (!$user) {
                throw new UsernameNotFoundException();
            }

            return $user;
        }
        );

        return new SelfValidatingPassport($userBadge);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse(['error' => 'Authentication failed: invalid Bearer token!'], 401);
    }

    private function getAuthorizationToken(Request $request): string
    {
        return u($request->headers->get('Authorization', ''))
            ->after(self::HEADER_PREFIX)
            ->toString();
    }
}
