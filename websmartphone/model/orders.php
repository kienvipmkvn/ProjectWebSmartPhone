<?php
    class orders extends db{
        private $conn;
        public $ID;
        public $Name;
        public $UserPhone;
        public $UserAddress;
        public $Guid;
        public $Amount;
        public $Note;
        public $Status;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function read($pageIndex, $pageSize){
            $query = "SELECT * FROM orders limit $pageIndex,$pageSize";

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
            $this->Amount = $row['Amount'];
            $this->Note = $row['Note'];
            $this->Status = $row['Status'];
            $this->Guid = $row['Guid'];

            return $stmt;
        }

        public function search($pageIndex, $pageSize){
            $query = "SELECT * FROM orders where Name like :Name and Status like :Status limit $pageIndex,$pageSize";

            $stmt = $this->conn->prepare($query);
            $this->Name = htmlspecialchars(strip_tags($this->Name));
            $this->Status = htmlspecialchars(strip_tags($this->Status));
            $data1 = '%'.$this->Name.'%';
            $data2 = '%'.$this->Status.'%';
            $stmt->bindParam(':Name', $data1);
            $stmt->bindParam(':Status', $data2);

            $stmt->execute();
            return $stmt;
        }

        function getGUID(){
            if (function_exists('com_create_guid')){
                return com_create_guid();
            }else{
                mt_srand((double)microtime()*10000);
                $charid = strtoupper(md5(uniqid(rand(), true)));
                $hyphen = chr(45);
                $uuid = substr($charid, 0, 8).$hyphen
                    .substr($charid, 8, 4).$hyphen
                    .substr($charid,12, 4).$hyphen
                    .substr($charid,16, 4).$hyphen
                    .substr($charid,20,12);
                return $uuid;
            }
        }

        public function add(){
            $query = "INSERT INTO orders SET Name=:Name , UserPhone=:UserPhone , UserAddress=:UserAddress , Amount=:Amount, Guid=:Guid , Note=:Note , Status=:Status";

            $stmt = $this->conn->prepare($query);

            $this->Name = htmlspecialchars(strip_tags($this->Name));
            $this->UserPhone = htmlspecialchars(strip_tags($this->UserPhone));
            $this->UserAddress = htmlspecialchars(strip_tags($this->UserAddress));
            $this->Amount = htmlspecialchars(strip_tags($this->Amount));
            $this->Note = htmlspecialchars(strip_tags($this->Note));
            $this->Status = htmlspecialchars(strip_tags($this->Status));
            $this->Guid = $this->getGUID();

            $stmt->bindParam(':Name', $this->Name);
            $stmt->bindParam(':UserPhone', $this->UserPhone);
            $stmt->bindParam(':UserAddress', $this->UserAddress);
            $stmt->bindParam(':Amount', $this->Amount);
            $stmt->bindParam(':Note', $this->Note);
            $stmt->bindParam(':Status', $this->Status);
            $stmt->bindParam(':Guid', $this->Guid);

            $result = $stmt->execute();
            if($result){
                return $this->Guid;
            }
            printf("Error %s.\n" .$stmt->error);
            return false;
        }

        public function update(){
            $query = "UPDATE orders SET Name=:Name , UserPhone=:UserPhone , UserAddress=:UserAddress, Amount=:Amount , Note=:Note , Status=:Status WHERE ID=:ID";

            $stmt = $this->conn->prepare($query);

            $this->ID = htmlspecialchars(strip_tags($this->ID));
            $this->Name = htmlspecialchars(strip_tags($this->Name));
            $this->UserPhone = htmlspecialchars(strip_tags($this->UserPhone));
            $this->UserAddress = htmlspecialchars(strip_tags($this->UserAddress));
            $this->Amount = htmlspecialchars(strip_tags($this->Amount));
            $this->Note = htmlspecialchars(strip_tags($this->Note));
            $this->Status = htmlspecialchars(strip_tags($this->Status));
            $this->Guid = htmlspecialchars(strip_tags($this->Guid));

            $stmt->bindParam(':ID', $this->ID);
            $stmt->bindParam(':Name', $this->Name);
            $stmt->bindParam(':UserPhone', $this->UserPhone);
            $stmt->bindParam(':UserAddress', $this->UserAddress);
            $stmt->bindParam(':Amount', $this->Amount);
            $stmt->bindParam(':Note', $this->Note);
            $stmt->bindParam(':Status', $this->Status);
            $stmt->bindParam(':Guid', $this->Guid);

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