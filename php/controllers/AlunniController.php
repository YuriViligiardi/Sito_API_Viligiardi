<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunniController{

  //funzione index che mostra tutti gli alunni
  public function index(Request $request, Response $response, $args){
    $db = Db::getInstance();
    $result = $db->select("alunni");

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  //funzione show che mostra nel dettaglio l'alunno richiesto
  public function show(Request $request, Response $response, $args){
    $conn = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $conn->query("SELECT * FROM `alunni` WHERE `id`= " . $args["id"] . "");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  //funzione create che crea un alunno
  public function create(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $body = json_decode($request->getBody()->getContents(), true);
    $result = $mysqli_connection->query("INSERT INTO `alunni`(`nome`, `cognome`) VALUES ('" . $body["nome"] . "', '" . $body["cognome"] . "')");

    $response->getBody()->write("Alunno " . $body["nome"] . " " . $body["cognome"] . " creato");
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  //funzione update che aggiorna un alunno
  public function update(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $body = json_decode($request->getBody()->getContents(), true);
    $result = $mysqli_connection->query("UPDATE `alunni` SET `nome`='" . $body["nome"] . "',`cognome`='" . $body["cognome"] . "' WHERE `id` = " . $args["id"] . "");

    $response->getBody()->write("Alunno aggiornato");
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  //funzione destroy che elimina un alunno
  public function destroy(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("DELETE FROM `alunni` WHERE `id` = " . $args["id"] . "");

    $response->getBody()->write("Alunno " . $args["id"] . " eliminato");
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }
}
