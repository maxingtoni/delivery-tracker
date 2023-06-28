<?php

class Location
{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getUserLocations($userId)
    {
        // Prepare the SQL query
        $userQuery = "
            SELECT `location`.*
            FROM `location`
            WHERE `location`.user_id = :userId;
        ";

        try {
            // Execute statement
            $sto = $this->pdo->prepare($userQuery);
            $sto->execute([
                ':userId' => $userId
            ]);
        } catch (PDOException $e) {
            Session::pdoDebug($e);
        }

        $fetch = $sto->fetchAll(PDO::FETCH_ASSOC);
        return $fetch;
    }

    public function create($userId, $region, $coordinates)
    {
        // Prepare the SQL query
        $userQuery = "
            INSERT INTO `location` (user_id, region, coordinates)
            VALUES (:user_id, :region, :coordinates);
        ";

        try {
            // Execute statement
            $sto = $this->pdo->prepare($userQuery);
            $sto->execute([
                ':user_id' => $userId,
                ':region' => $region,
                ':coordinates' => $coordinates
            ]);
        } catch (PDOException $e) {
            Session::pdoDebug($e);
        }

        $fetch = $sto->fetchAll(PDO::FETCH_ASSOC);
        return $fetch;
    }
}