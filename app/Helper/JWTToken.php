<?php

    namespace App\Helper;

    use Exception;
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    use function Laravel\Prompts\alert;

    class JWTToken {

        public static function generateToken($email, $id): string {
            $key = env('JWT_KEY');
            $payload = [
                'iss' => 'laravel-token',
                'iat' => time(),
                'exp' => time() + 60 * 60,
                'userMail' => $email,
                'userId' => $id
            ];

            return JWT::encode($payload, $key, 'HS256');
        }

        public static function passwordToken($email): string {
            $key = env('JWT_KEY');
            $payload = [
                'iss' => 'laravel-token',
                'iat' => time(),
                'exp' => time() + 60 * 20,
                'userMail' => $email,
                'userId' => '0'
            ];

            return JWT::encode($payload, $key, 'HS256');
        }

        public static function verifyToken($token): string|object {
            try {
                if ($token == null) {
                    return 'Unauthorized';
                }
                $key = env('JWT_KEY');
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                return $decoded;
            } catch (Exception $e) {
                return 'Unauthorized';
            }


        }

    }
