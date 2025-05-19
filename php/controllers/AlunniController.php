<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunniController{
  
   /**
   * funzione index che mostra tutti gli alunni
   * @url /alunni
   * */
  public function index(Request $request, Response $response, $args){
    $db = Db::getInstance('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $db->select("alunni");

    $response->getBody()->write(json_encode($result));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  /**
   * funzione show che mostra nel dettaglio l'alunno richiesto
   * @url /alunni/{id}
   * */ 
  public function show(Request $request, Response $response, $args){
    $db = Db::getInstance('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $db->selectId("alunni", $args["id"]);

    $response->getBody()->write(json_encode($result));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  /**
   * funzione create che crea un alunno
   * @url /alunni
   * */
  public function create(Request $request, Response $response, $args){
    $body = json_decode($request->getBody()->getContents(), true);
    $alunno =  array(
        "nome" => $body["nome"],
        "cognome" => $body["cognome"]
    );
    $db = Db::getInstance('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $db->create("alunni", $alunno);
    if ($result) {
      $response->getBody()->write("Alunno " . $body["nome"] . " " . $body["cognome"] . " creato");
      return $response->withHeader("Content-type", "application/json")->withStatus(200);
    } 

    $response->getBody()->write("Alunno non creato");
    return $response->withHeader("Content-type", "application/json")->withStatus(404);
  }
  
  /**
   * funzione update che aggiorna un alunno
   * @url /alunni/{id}
   * */
  public function update(Request $request, Response $response, $args){
    $body = json_decode($request->getBody()->getContents(), true);
    $db = Db::getInstance('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $db->update("alunni", $body, "id=" . $args["id"]);
    if ($result) {
      $response->getBody()->write("Alunno " . $args["id"] . " aggiornato");
      return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }

    $response->getBody()->write("Alunno non aggiornato");
    return $response->withHeader("Content-type", "application/json")->withStatus(404);
  }

  /**
   * funzione destroy che elimina un alunno
   * @url /alunni/{id}
   * */
  public function destroy(Request $request, Response $response, $args){
    $db = Db::getInstance('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $db->update("alunni", $args["id"]);
    if ($result) {
      $response->getBody()->write("Alunno " . $args["id"] . " eliminato");
      return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }

    $response->getBody()->write("Alunno " . $args["id"] . " non eliminato");
    return $response->withHeader("Content-type", "application/json")->withStatus(404);
  }
}
