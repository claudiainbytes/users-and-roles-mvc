<?php
/**
* Basic information about PDO Statement
* http://php.net/manual/es/class.pdostatement.php
*/
class Database
{
    public static function StartUp()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=usersandroles;charset=utf8', 'root', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
