<?php

declare(strict_types=1);

namespace App\Repository;

use Illuminate\Support\Facades\Date;

use App\Models\User;
use Firebase\JWT\JWT;
use Exception;

/**
 * Class UserInfoRepo
 * @package App\Repository
 * This class will contain the repository methods for managing user information in the system.
 */
class UserInfoRepo
{
    // Class implementation goes here
    /**
     * This method will check the password and create a token for the user.
     * @param string $usernameOrEmail
     * @param string $password
     * @return bool
     * @throws \Exception
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Illuminate\Database\QueryException
     * @throws \Illuminate\Database\RecordsNotFoundException
     */
    public function checkPasswordAndCreateToken(string $usernameOrEmail, string $password): bool
    {
        try {
            // Assuming you have a User model with a method to find by username or email
            $user = User::where('username', $usernameOrEmail)
                        ->orWhere('email', $usernameOrEmail)
                        ->first();

            if ($user && password_verify($password, $user->password)) {
                // Generate JWT token
                $payload = [
                    'iss' => 'YourPass Saver encryptions', // Issuer of the token
                    'sub' => $user->id, // Subject of the token (user ID)
                    'iat' => time(), // Time when JWT was issued
                    'exp' => time() + 3600 // Expiration time (1 hour from now)
                ];

                $jwt = JWT::encode($payload, 'your-secret-key', 'HS256');
                // Delete old tokens for this user
                $user->tokens()->delete();
                // Save the token in the tokens table using Eloquent ORM
                $user->tokens()->create([
                    'token' => $jwt,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now()
                ]);

                return $jwt;
            }
        } catch (Exception $e) {
            // Log the exception
            error_log('Exception: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            return false;
        }

        return false;
    }

/**
 * This method will add a new user to the system.
 * @param string $username
 * @param string $email
 * @param string $password
 * @return User
 * @throws \Exception
 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
 * @throws \Illuminate\Database\QueryException
 * @throws \Illuminate\Database\RecordsNotFoundException
 */
public function addUser(string $username, string $email, string $password): User
{   
    try {
        // Hash the password using MD5 before saving it
        $hashedPassword = md5($password);

        // Create a new user using Eloquent ORM
        $user = User::create([
            'email' => $email,
            'username' => $username,
            'password' => $hashedPassword,
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);

        if ($user) {
            return $user;
        } else {
            throw new Exception('Failed to add user.');
        }
    } catch (Exception $e) {
        // Log the exception
        error_log('Exception: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
        throw $e;
    }
}

}