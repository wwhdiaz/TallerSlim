<?php
// Gift Routes

$app->get('/Gifts[/]', function ($request, $response, $args) {
    $sql = "SELECT * from Gifts";
    
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll();
    
    return $response->withJson($data)->withHeader('Content-Type', 'application/json');
});

$app->get('/Gifts/{id}[/]', function ($request, $response, $args) {
    $sql = "SELECT * from Gifts where id = :id";
    
    $id = (int)$args['id'];
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    $data = $stmt->fetchAll();

    return $response->withJson($data)->withHeader('Content-Type', 'application/json');
});

$app->post('/Gifts[/]', function ($request, $response, $args) {
    $sql = "INSERT INTO Gifts (id, name, price) VALUES (null, :name, :price)";

    $json = $app->request->getBody();
    $data = json_decode($json, true);
    $name = $data['name'];
    $price = $data['price'];
    $stmt = $this->db->prepare($sql);
    $result = array('result' => $stmt->execute(['name' => $name, 'price' => $price]));

    return $response->withJson($result)->withHeader('Content-Type', 'application/json');
});

$app->put('/Gifts/{id}', function ($request, $response, $args) {
    $sql = "UPDATE Gifts SET name=:name, price=:price WHERE id=:id";

    $id = $args['id'];
    $json = $app->request->getBody();
    $data = json_decode($json, true);
    $name = $data['name'];
    $price = $data['price'];
    $stmt = $this->db->prepare($sql);
    $result = array('result' => $stmt->execute(['name' => $name, 'price' => $price, 'id' => $id]));

    return $response->withJson($result)->withHeader('Content-Type', 'application/json');
});

$app->delete('/Gifts/{id}', function ($request, $response, $args) {
    $sql = "DELETE FROM Gifts WHERE id=:id";

    $id = $args['id'];

    $stmt = $this->db->prepare($sql);
    $result = array('result' => $stmt->execute(['id' => $id]));

    return $response->withJson($result)->withHeader('Content-Type', 'application/json');
});
