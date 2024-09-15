<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;

class Register implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            // Create and return a response
            $data = $request->getParsedBody();
            $data = $request->getQueryParams();
            // return new JsonResponse($data);
            //you should get the user name and email from the request
            $username = $data['username'];
            $email = $data['email'];

            //you should get the password from the request
            $password = $data['password'];
            //should call the funciton to create the user, you should use the repository to create the user
            //you should return the user data
            $userInfoRepo = new \App\Repository\UserInfoRepo();
            $user = $userInfoRepo->addUser($username, $email, $password);
            $data = [

                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
            ];
            return new JsonResponse($data);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
