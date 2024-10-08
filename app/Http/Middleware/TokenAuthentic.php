<?php

    namespace App\Http\Middleware;

    use App\Helper\JWTToken;
    use Closure;
    use Illuminate\Http\Request;
    use Symfony\Component\HttpFoundation\Response;

    class TokenAuthentic {
        /**
         * Handle an incoming request.
         *
         * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
         */
        public function handle(Request $request, Closure $next): Response {
            $token = $request->cookie('token');
            $result = JWTToken::verifyToken($token);
            if ($result == 'Unauthorized') {
                return redirect('/login');
            } else {
                $request->headers->set('uId', $result->userId);
                $request->headers->set('email', $result->userMail);
                return $next($request);
            }
        }
    }
