<?php

class SignupHandler extends Handler
{
    public static function processForm($postData): bool
    {
        if (
            !isset($postData['email'])
            || !isset($postData['password'])
        ) {
            return parent::handleError("REGISTER_ERROR", "An error occured, try again later.");
        }

        if (
            Dbh::registeredValue('user', ['email' => $postData['email']])
        ) {
            return parent::handleError("REGISTER_ERROR", "EMail already registered.");
        }

        if (
            $postData['password'] != $postData['password-conf']
        ) {
            return parent::handleError("REGISTER_ERROR", "Passwords do not match.");
        }

        Dbh::createPdo();
        $user = new User(Dbh::getPdo());
        if (
            $user->create([
                'email' => $postData['email'],
                'password' => $postData['password']
            ])
        ) {
            return parent::handleError("REGISTER_ERROR", "Account registered.", "../../index.php?page=login");
        }

        return parent::handleError("REGISTER_ERROR", "Account was not registered, try again later.", "../../index.php?page=signup");
    }
}