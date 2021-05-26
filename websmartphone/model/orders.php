<?php
    class orders extends db{
        private $conn;
        public $ID;
        public $Name;
        public $UserPhone;
        public $UserAddress;
        public $UserID;
        public $Amount;
        public $Note;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function read(){
            $query = "SELECT * FROM orders limit $this->ID,10";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();
            return $stmt;
        }

        public function show(){
            $query = "SELECT * FROM orders WHERE ID=? LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->ID);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->Name = $row['Name'];
            $this->UserPhone = $row['UserPhone'];
            $this->UserAddress = $row['UserAddress'];
            $this->UserID = $row['UserID'];
            $this->Amount = $row['Amount'];
            $this->Note = $row['Note'];

            return $stmt;
        }

        public function add(){
            $query = "INSERT INTO orders SET Name=:Name , UserPhone=:UserPhone , UserAddress=:UserAddress , UserID=:UserID , Amount=:Amount , Note=:Note";

            $stmt = $this->conn->prepare($query);

            $this->Name = htmlspecialchars(strip_tags($this->Name));
            $this->UserPhone = htmlspecialchars(strip_tags($this->UserPhone));
            $this->UserAddress = htmlspecialchars(strip_tags($this->UserAddress));
            $this->UserID = htmlspecialchars(strip_tags($this->UserID));
            $this->Amount = htmlspecialchars(strip_tags($this->Amount));
            $this->Note = htmlspecialchars(strip_tags($this->Note));

            $stmt->bindParam(':Name', $this->Name);
            $stmt->bindParam(':UserPhone', $this->UserPhone);
            $stmt->bindParam(':UserAddress', $this->UserAddress);
            $stmt->bindParam(':UserID', $this->UserID);
            $stmt->bindParam(':Amount', $this->Amount);
            $stmt->bindParam(':Note', $this->Note);

            if($stmt->execute()){
                return true;
            }
            printf("Error %s.\n" .$stmt->error);
            return false;
        }

        public function update(){
            $query = "UPDATE orders SET Name=:Name , UserPhone=:UserPhone , UserAddress=:UserAddress , UserID=:UserID , Amount=:Amount , Note=:Note WHERE ID=:ID";

            $stmt = $this->conn->prepare($query);

            $this->ID = htmlspecialchars(strip_tags($this->ID));
            $this->Name = htmlspecialchars(strip_tags($this->Name));
            $this->UserPhone = htmlspecialchars(strip_tags($this->UserPhone));
            $this->UserAddress = htmlspecialchars(strip_tags($this->UserAddress));
            $this->UserID = htmlspecialchars(strip_tags($this->UserID));
            $this->Amount = htmlspecialchars(strip_tags($this->Amount));
            $this->Note = htmlspecialchars(strip_tags($this->Note));

            $stmt->bindParam(':ID', $this->ID);
            $stmt->bindParam(':Name', $this->Name);
            $stmt->bindParam(':UserPhone', $this->UserPhone);
            $stmt->bindParam(':UserAddress', $this->UserAddress);
            $stmt->bindParam(':UserID', $this->UserID);
            $stmt->bindParam(':Amount', $this->Amount);
            $stmt->bindParam(':Note', $this->Note);

            if($stmt->execute()){
                return true;
            }
            printf("Error %s.\n" .$stmt->error);
            return false;
        }

        public function delete(){
            $query = "DELETE FROM orders WHERE ID=:ID";

            $stmt = $this->conn->prepare($query);

            $this->ID = htmlspecialchars(strip_tags($this->ID));
            
            $stmt->bindParam(':ID', $this->ID);

            if($stmt->execute()){
                return true;
            }
            printf("Error %s.\n" .$stmt->error);
            return false;
        }

    }
?>