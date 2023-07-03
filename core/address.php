<?php
class Address
{
  //DB stuff
  private $conn;
  private $table = 'posts';

  //post prperties
  public $id;
  public $gn;
  public $area;
  public $nb;
  public $town;

  //contructor with db connection
  public function __construct($db)
  {
    $this->conn = $db;
  }
  //get posts from our database
  public function read()
  {
    $query = "SELECT gn,
    area,
    nb,
    town FROM 
    " . $this->table;
    //prepare the statement
    $stmt = $this->conn->prepare($query);
    //binding param
    /*$stmt->bindParam(1,$this->gn);
    //excute the query*/
    $stmt->excute();
    return $stmt;
  }


  public function read_single()
  {
    $query = "SELECT 
    id,
    gn,
    area,
    nb,
    town 
    FROM " . $this->table . 'WHERE id=? LIMIT 1';

    //prepare statement
    $stmt = $this->conn->prepare($query);
    //binding param
    $stmt->bindParam(1, $this->id);
    //excute the query*/
    $stmt->excute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->id = $row['id'];
    $this->gn = $row['gn'];
    $this->area = $row['area'];
    $this->nb = $row['nb'];
    $this->town = $row['town'];
  }

  public function create()
  {
    // create query
    $query = 'INSERT INTO' . $this->table . 'SET gn= :gn, area=:area,nb=:nb,town=:town';
    //prepare statement
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->gn = htmlspecialchars(strip_tags($this->gn));
    $this->area = htmlspecialchars(strip_tags($this->area));
    $this->nb = htmlspecialchars(strip_tags($this->nb));
    $this->town = htmlspecialchars(strip_tags($this->town));
    // binding of parameters
    $stmt->bindParam(':gn', $this->gn);
    $stmt->bindParam(':area', $this->area);
    $stmt->bindParam(':nb', $this->nb);
    $stmt->bindParam(':town', $this->town);
    //excute the query
    if ($stmt->excute()) {
      return true;
    }
    //print error if something goes wrong
    printf("ERROR %s.\n", $stmt->error);
    return false;
  }
  //update address function
  public function update()
  {
    // create query
    $query = 'UPDATE' . $this->table . '
    SET gn= :gn, area=:area,nb=:nb,town=:town
    WHERE id=:id';
    //prepare statement
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->gn = htmlspecialchars(strip_tags($this->gn));
    $this->area = htmlspecialchars(strip_tags($this->area));
    $this->nb = htmlspecialchars(strip_tags($this->nb));
    $this->town = htmlspecialchars(strip_tags($this->town));
    $this->id = htmlspecialchars(strip_tags($this->id));
    //we need to put something
    //$this->gn = htmlspecialchars(strip_tags($this->gn));
    //this was the thing


    // binding of parameters
    $stmt->bindParam(':gn', $this->gn);
    $stmt->bindParam(':area', $this->area);
    $stmt->bindParam(':nb', $this->nb);
    $stmt->bindParam(':town', $this->town);
    $stmt->bindParam(':id', $this->id);

    //excute the query
    if ($stmt->excute()) {
      return true;
    }
    //print error if something goes wrong
    printf("ERROR %s.\n", $stmt->error);
    return false;
  }

  // delete function
  public function delete()
  {
    //create query
    $query = 'DELETE FROM' . $this->table . 'WHERE id=:id';
    //prepare statement
    $stmt = $this->conn->prepare($query);
    //clean the data
    $this->id = htmlspecialchars(strip_tags($this->id));
    // binding the id parameter
    $stmt->bindParam(':id', $this->id);
    //excute the query
    if ($stmt->excute()) {
      return true;
    }

    //print error if something goes wrong
    printf('Error%s.\n', $stmt->error);
    return false;
  }
}
