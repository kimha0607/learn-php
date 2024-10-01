<?php

class Product
{
  private $table_name;
  private $conn;

  function __construct($db_conn)
  {
    $this->conn = $db_conn;
    $this->table_name = "Products";
  }

  public function getAllProducts() {
    $query = "SELECT * FROM " . $this->table_name;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  

  public function getProductById($id) {
    $query = "SELECT * FROM " . $this->table_name . " WHERE product_id = :id";
    $stmt = $this->conn->prepare($query);
    
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
