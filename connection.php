<?php
class connect
{
    public function __construct()
    {
    }

    public static function connectToDb()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "general";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);


        return $conn;
    }

    public function podConnect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "general";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
