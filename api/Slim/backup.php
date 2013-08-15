<?php
$app->get('/wines/:id', 'getWine');
$app->get('/wines/search/:query', 'findByName');
$app->put('/wines/:id', 'updateWine');
$app->delete('/wines/:id', 'deleteWine');

function updateWine($id) {
  $request = Slim::getInstance()->request();
  $body = $request->getBody();
  $wine = json_decode($body);
  $sql = "UPDATE wine SET name=:name, grapes=:grapes, country=:country, region=:region, year=:year, description=:description WHERE id=:id";
  try {
    $db = getConnection();
    $stmt = $db->prepare($sql);  
    $stmt->bindParam("name", $wine->name);
    $stmt->bindParam("grapes", $wine->grapes);
    $stmt->bindParam("country", $wine->country);
    $stmt->bindParam("region", $wine->region);
    $stmt->bindParam("year", $wine->year);
    $stmt->bindParam("description", $wine->description);
    $stmt->bindParam("id", $id);
    $stmt->execute();
    $db = null;
    echo json_encode($wine); 
  } catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
  }
}

function deleteWine($id) {
  $sql = "DELETE FROM wine WHERE id=:id";
  try {
    $db = getConnection();
    $stmt = $db->prepare($sql);  
    $stmt->bindParam("id", $id);
    $stmt->execute();
    $db = null;
  } catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
  }
}

function findByName($query) {
  $sql = "SELECT * FROM wine WHERE UPPER(name) LIKE :query ORDER BY name";
  try {
    $db = getConnection();
    $stmt = $db->prepare($sql);
    $query = "%".$query."%";  
    $stmt->bindParam("query", $query);
    $stmt->execute();
    $wines = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    echo '{"wine": ' . json_encode($wines) . '}';
  } catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
  }
}

function getWine($id) {
  $sql = "SELECT * FROM wine WHERE id=:id";
  try {
    $db = getConnection();
    $stmt = $db->prepare($sql);  
    $stmt->bindParam("id", $id);
    $stmt->execute();
    $wine = $stmt->fetchObject();  
    $db = null;
    echo json_encode($wine); 
  } catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
  }
}