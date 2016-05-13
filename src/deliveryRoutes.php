<?php
// Delivery Routes

$app->get('/Deliveries[/]', function ($request, $response, $args) {
    $sql = "SELECT * from Deliveries";
    
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll();
    
    return $response->withJson($data)->withHeader('Content-Type', 'application/json');
});

$app->get('/Deliveries/{id}[/]', function ($request, $response, $args) {
    $sql = "SELECT * from Deliveries where id = :id";
    
    $id = (int)$args['id'];
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    $data = $stmt->fetchAll();

    return $response->withJson($data)->withHeader('Content-Type', 'application/json');
});

$app->post('/Deliveries[/]', function ($request, $response, $args) {
    $sql = "INSERT INTO Deliveries (id, sender, recipient, message) VALUES (null, :name, :sender, :recipient, :message)";

    $json = $app->request->getBody();
    $data = json_decode($json, true);
    $sender = $data['sender'];
    $recipient = $data['recipient'];
    $message = $data['message'];
    $stmt = $this->db->prepare($sql);
    $result = array('result' => $stmt->execute(['sender' => $sender, 'recipient' => $recipient, 'message' => $message]));

    return $response->withJson($result)->withHeader('Content-Type', 'application/json');
});

$app->put('/Deliveries/{id}', function ($request, $response, $args) {
    $sql = "UPDATE Deliveries SET sender=:sender, message=:message, recipient=:recipient WHERE id=:id";

    $id = $args['id'];
    $json = $app->request->getBody();
    $data = json_decode($json, true);

    $stmt = $this->db->prepare($sql);
    $result = array('result' => $stmt->execute(['sender' => $sender, 'recipient' => $recipient, 'message' => $message]));

    return $response->withJson($result)->withHeader('Content-Type', 'application/json');
});

$app->delete('/Deliveries/{id}', function ($request, $response, $args) {
    $sql = "DELETE FROM Deliveries WHERE id=:id";

    $id = $args['id'];

    $stmt = $this->db->prepare($sql);
    $result = array('result' => $stmt->execute(['id' => $id]));

    return $response->withJson($result)->withHeader('Content-Type', 'application/json');
});