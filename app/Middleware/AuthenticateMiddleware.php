<?php

namespace App\Middleware;

use App\Utils\Traits\ResponseTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthenticateMiddleware
{
    use ResponseTrait;

    /**
     * @var array
     */
    private $settings;

    /**
     * Get application settings data.
     *
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    /**
     * AuthenticateService middleware invokable class
     *
     * @param ServerRequestInterface $request  PSR7 request
     * @param ResponseInterface $response PSR7 response
     * @param callable $next     Next middleware
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
    {
        if ($this->passes($request)) {
            return $next($request, $response);
        }

        $this->response_status  = false;
        $this->response_code    = 401;
        $this->response_message = "Unauthorized !!!";
        $this->response_data    = null;
        $this->response_details = null;
        return $response->withStatus($this->response_code)->withJson($this->responseData());
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return mixed
     */
    private function passes(ServerRequestInterface $request)
    {
        // Implement authentication machanism here.
        // Due to time shortness not implemented.
        return true;
    }
}
