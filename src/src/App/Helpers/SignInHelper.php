<?php

namespace App\Helpers;
use App\Repository\UserInfoRepo;
/**
 * Class SignInHelper
 * @package App\Helpers
 * This class will contain the helper methods for signing in and managing user accounts
 * in the system.
 */
class SignInHelper
{
    /**
     * This method will sign in the user to the system by checking the password and creating a token.   
     * @param string $usernameOrEmail
     * @param string $password
     * @return bool
     * @throws \Exception
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Illuminate\Database\QueryException
     * @throws \Illuminate\Database\RecordsNotFoundException
     */
    public static function signInSystem (string $usernameOrEmail, string $password): bool
    {
        $userInfoRepo = new UserInfoRepo();
        return $userInfoRepo->checkPasswordAndCreateToken($usernameOrEmail, $password);
    }

    /**
     * This method will get the accounts information for the user and decrypt the account passwords.
     * @param string $usernameOrEmail
     * @param string $password
     * @return array
     * @throws \Exception
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Illuminate\Database\QueryException
     * @throws \Illuminate\Database\RecordsNotFoundException
     */
    public static function getAccountsInfoDecrypted(string $usernameOrEmail, string $password): array
    {
        $userInfoRepo = new UserInfoRepo();
        $userId = $userInfoRepo->checkPassword($usernameOrEmail, $password);
        if ($userId) {
            $accountsInfo = $userInfoRepo->getAccountsInfo($userId);
            // Decrypt the account passwords before returning them
            foreach ($accountsInfo as &$account) {
                $account['password'] = password_verify($account['password'], PASSWORD_BCRYPT);
            }
            return $accountsInfo;
        }
        return [];
    }

    /**
     * This method will add the user account information to the system and encrypt the account password.
     * @param string $usernameOrEmail
     * @param string $account
     * @param string $accountPassword
     * @return bool
     * @throws \Exception
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Illuminate\Database\QueryException
     * @throws \Illuminate\Database\RecordsNotFoundException
     */
    public static function addUserInfoEncrypted(string $usernameOrEmail, string $account, string $accountPassword): bool
    {
        $userInfoRepo = new UserInfoRepo();
        $userId = $userInfoRepo->getUserIdByUsernameOrEmail($usernameOrEmail);
        if ($userId) {
            // Encrypt the account password before saving it
            $encryptedPassword = password_hash($accountPassword, PASSWORD_BCRYPT);
            return $userInfoRepo->addAccountInfo($userId, $account, $encryptedPassword);
        }
        return false;
    }
    
    /**
     * This method will add the user account information to the system and encrypt the account password.
     * @param string $username
     * @param string $email
     * @param string $password
     * @return bool
     * @throws \Exception
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Illuminate\Database\QueryException
     * @throws \Illuminate\Database\RecordsNotFoundException
     */
    public static function addUser(string $username, string $email, string $password)
    {
        $userInfoRepo = new UserInfoRepo();
        $hashedPassword = md5($password);
        return $userInfoRepo->addUser($username, $email, $hashedPassword);
    }

}
