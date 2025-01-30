<?php
class Database {
    private $host = "localhost";  
    private $dbname = "socialapp"; 
    private $username = "root";  
    private $password = "";  
    public $conn;

    // Constructor to establish a connection to the database
    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Set error mode
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // Method to get the database connection
    public function getConnection() {
        return $this->conn;
    }
}
?>
