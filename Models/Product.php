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

  public function getAllProducts()
  {
    $query = "SELECT * FROM " . $this->table_name;
    $stmt = $this->conn->query($query);
    // $stmt->execute();
    return $stmt;
  }

  public function getProductById($id)
  {
    $query = "SELECT * FROM " . $this->table_name . " WHERE products_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
  }
}
