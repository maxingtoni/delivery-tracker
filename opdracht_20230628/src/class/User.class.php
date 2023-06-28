<?php

class User
{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($data): bool 
    {
        // Hash password
        $hashed_password = password_hash(PASS_PEPPER . $data['password'] . PASS_SALT, PASS_ENC);

        // Prepare the SQL query
        $query = "
            INSERT INTO `user` (email, password)
            VALUES (:email, :password);
        ";

        try {
            // Execute statement
            $sto = $this->pdo->prepare($query);
            $sto->execute([
                ':email' => $data['email'],
                ':password' => $hashed_password
            ]);
            Session::pdoDebug("No errors.");
        } catch (PDOException $e) {
            Session::pdoDebug($e);
        }

        // Check insert success
        $insert = $sto->rowCount();
        return ($insert > 0);
    }

    public function getUser()
    {

    }
}