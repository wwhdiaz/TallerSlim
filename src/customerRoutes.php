<?php
// Customer Routes

$app->get('/Customers[/]', function ($request, $response, $args) {
    $sql = "SELECT * from Customers";
    
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll();
    
    return $response->withJson($data)->withHeader('Content-Type', 'application/json');
});

$app->get('/Customers/{id}[/]', function ($request, $response, $args) {
    $sql = "SELECT * from Customers where id = :id";
    
    $id = (int)$args['id'];
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    $data = $stmt->fetchAll();

    return $response->withJson($data)->withHeader('Content-Type', 'application/json');
});

$app->post('/Customers[/]', function ($request, $response, $args) {
    $sql = "INSERT INTO Customers (id, name) VALUES (null, :name)";

    $json = $app->request->getBody();
    $data = json_decode($json, true);
    $name = $data['name'];
    $stmt = $this->db->prepare($sql);
    $result = array('result' => $stmt->execute(['name' => $name]));

    return $response->withJson($result)->withHeader('Content-Type', 'application/json');
});

$app->put('/Customers/{id}', function ($request, $response, $args) {
    $sql = "UPDATE Customers SET name=:name WHERE id=:id";

    $id = $args['id'];
    $json = $app->request->getBody();
    $data = json_decode($json, true);
    $name = $data['name'];
    $stmt = $this->db->prepare($sql);
    $result = array('result' => $stmt->execute(['name' => $data['name'], 'id' => $id]));

    return $response->withJson($result)->withHeader('Content-Type', 'application/json');
});

$app->delete('/Customers/{id}', function ($request, $response, $args) {
    $sql = "DELETE FROM Customers WHERE id=:id";

    $id = $args['id'];

    $stmt = $this->db->prepare($sql);
    $result = array('result' => $stmt->execute(['id' => $id]));

    return $response->withJson($result)->withHeader('Content-Type', 'application/json');
});
