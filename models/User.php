<?php
// models/User.php

class User
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }


    public function getAllUsers()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($name, $age, $img)

    {
        $query = ("INSERT INTO users(name,age,img) VALUES (:name,:age,:img)");
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':age', $age, PDO::PARAM_STR);
        $stmt->bindParam(':img', $img, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateUser($id, $name, $age, $image)
    {
        $query = "UPDATE users SET name = :name, age = :age, img  = :img WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':age', $age, PDO::PARAM_STR);
        $stmt->bindParam(':img', $image, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function deleteUser($id)
    {
        $imageName = $this->getUserImageName($id);
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);


        $result = $stmt->execute();

        if ($result) {
           return $imageName;
        }else{
            return null;
        }

    }

    private function getUserImageName($id)
    {
        $query = "SELECT img FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user['img'] : null;
    }


    public function getUsersBySearch($searchQuery) {
        // Replace this with your actual database query to fetch users based on the search query
        // For example:
        $sql = "SELECT * FROM users WHERE name LIKE '%$searchQuery%'";
        $result = $this->db->query($sql);

        

        return $result;
    }

}