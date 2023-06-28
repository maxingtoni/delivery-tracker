<?php

class Dbh
{
    protected static $pdo;

    public static function createPdo(): bool
    {
        $dsn = "mysql:host=". DB_HOST .";port=". DB_PORT .";dbname=". DB_NAME;
        $user = DB_USER;
        $password = DB_PASS;
    
        try {
            self::$pdo = new PDO($dsn, $user, $password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            Session::pdoDebug($e);
            return false;
        }
    
        return true;
    }
    
    public static function getPdo()
    {
        return self::$pdo;
    }

    public static function clearPdo(): bool
    {
        self::$pdo = null;
        return self::$pdo === null;
    }

    public static function registeredValue($table, $conditions): bool
    {
        if (self::$pdo === null) {
            self::createPdo();
        }
        
        // conditions
        $where = self::buildWhereClause($conditions);

        $query = "
            SELECT * 
            FROM $table
            $where;
        ";

        try {
            $sto = self::$pdo->prepare($query);
            $sto->execute();
        } catch(PDOException $e) {
            Session::pdoDebug($e);
        }
        
        $results = $sto->rowCount();
        return ($results > 0);
    }
    
    public static function buildWhereClause($conditions): string
    {
        $where = '';
    
        if (!empty($conditions)) {
            $where = 'WHERE ';
            $placeholders = [];
    
            foreach ($conditions as $key => $value) {
                $placeholders[] = "$key = '$value'";
            }
    
            $where .= implode(' AND ', $placeholders);
        }
    
        return $where;
    }
}