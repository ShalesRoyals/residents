<?php
    class crud{
        private $db;

        function __construct($conn){
            $this->db = $conn;
        }

        public function insertResidents($fname,$lname,$email,$gender,$members,$contact,$address,$avatar_path){
           
            try {
                $sql ="INSERT INTO resident (firstname,lastname,emailaddress,gender,members,contactnumber,
                address_id,avatar_path) VALUES(:fname,:lname,:email,:gender,:members,:contact,:address_id,
                :avatar_path)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':fname',$fname);
                $stmt->bindparam(':lname',$lname);
                $stmt->bindparam(':email',$email);
                $stmt->bindparam(':gender',$gender);
                $stmt->bindparam(':members',$members);
                $stmt->bindparam(':contact',$contact);
                $stmt->bindparam(':address_id',$address);
                $stmt->bindparam(':avatar_path',$avatar_path);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function editResidents($id, $fname,$lname,$email,$gender,$members,$contact,$address){
            try {
                $sql = "UPDATE `resident` SET `firstname`=:fname,`lastname`=:lname,`emailaddress`=:email,`gender`=:gender,`members`=:members,`contactnumber`=:contact,`address_id`=:address WHERE resident_id = :id ";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':id',$id);
                $stmt->bindparam(':fname',$fname);
                $stmt->bindparam(':lname',$lname);
                $stmt->bindparam(':email',$email);
                $stmt->bindparam(':gender',$gender);
                $stmt->bindparam(':members',$members);
                $stmt->bindparam(':contact',$contact);
                $stmt->bindparam(':address',$address);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }


        public function getResidents(){
            try{
                $sql = "SELECT * FROM `resident` r inner join address a on r.address_id = a.address_id";
                $result = $this->db->query($sql);
                return $result;
            }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
           }
           
        }
        public function getResidentDetails($id){
           try{
                $sql = "select * from resident r inner join address a on r.address_id = a.address_id 
                where resident_id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':id', $id);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
           }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function deleteResident($id){
            try {
                $sql ="DELETE FROM `resident` WHERE resident_id =:id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':id',$id);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getAddresses(){
            try{
                $sql = "SELECT * FROM `address`";
                $result = $this->db->query($sql);
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
       
        public function getAddressByID($id){
            try{
                $sql = "SELECT * FROM `address` WHERE address_id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':id',$id);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
       
    }
?>