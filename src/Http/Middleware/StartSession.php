<?php
declare(strict_types=1);

/**
 * @author    mskorupa
 * @copyright Pixel federation
 * @license:  Internal use only
 */

namespace PixelFederation\RedisSession\Http\Middleware;

use Dflydev\FigCookies\FigResponseCookies;
use Flarum\Http\CookieFactory;
use Illuminate\Support\Str;
use PixelFederation\RedisSession\Session\SessionFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Zend\Stratigility\MiddlewareInterface;

/**
 *
 */
final class StartSession implements MiddlewareInterface
{
    /**
     * @var CookieFactory
     */
    private $cookie;

    /**
     * @var SessionFactoryInterface
     */
    private $sessionFactory;

    /**
     * @param CookieFactory $cookie
     * @param SessionFactoryInterface $sessionFactory
     */
    public function __construct(CookieFactory $cookie, SessionFactoryInterface $sessionFactory)
    {
        $this->cookie = $cookie;
        $this->sessionFactory = $sessionFactory;
    }

    /**
     * {@inheritdoc}
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function __invoke(Request $request, Response $response, callable $out = null)
    {
        $session = $this->startSession();

        $request = $request->withAttribute('session', $session);

        $response = $out ? $out($request, $response) : $response;

        $response = $this->withCsrfTokenHeader($response, $session);

        return $this->withSessionCookie($response, $session);
    }

    /**
     * @return SessionInterface
     * @throws \RuntimeException
     */
    private function startSession(): SessionInterface
    {
        $session = $this->sessionFactory->create();

        $session->setName('flarum_session');
        $session->start();

        if (! $session->has('csrf_token')) {
            $session->set('csrf_token', Str::random(40));
        }

        return $session;
    }

    /**
     * @param Response $response
     * @param SessionInterface $session
     *
     * @return Response
     * @throws \InvalidArgumentException
     */
    private function withCsrfTokenHeader(Response $response, SessionInterface $session): Response
    {
        if ($session->has('csrf_token')) {
            $response = $response->withHeader('X-CSRF-Token', $session->get('csrf_token'));
        }

        return $response;
    }

    /**
     * @param Response $response
     * @param SessionInterface $session
     *
     * @return Response
     */
    private function withSessionCookie(Response $response, SessionInterface $session): Response
    {
        return FigResponseCookies::set(
            $response,
            $this->cookie->make($session->getName(), $session->getId())
        );
    }
}
