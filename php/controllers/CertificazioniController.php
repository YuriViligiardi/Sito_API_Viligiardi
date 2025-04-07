<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunniController{ 

    /**
   * funzione index che mostra tutti i certificazione
   * @url /certificazioni
   * */
    public function index(Request $request, Response $response, $args){
        $db = Db::getInstance('my_mariadb', 'root', 'ciccio', 'scuola');
        $result = $db->select("certificazioni");
    
        $response->getBody()->write(json_encode($results));
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
      }
    
       /**
   * funzione show che mostra nel dettaglio il certificato richiesto
   * @url /certificazioni/{id}
   * */
      public function show(Request $request, Response $response, $args){
        $db = Db::getInstance();
        $result = $db->selectId("certificazioni", $args["id"]);
    
        $response->getBody()->write(json_encode($results));
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
      }
    
      /**
   * funzione create che crea un certificato
   * @url /certificazioni
   * */
      public function create(Request $request, Response $response, $args){
        $body = json_decode($request->getBody()->getContents(), true);
        $db = Db::getInstance();
        $result = $db->create("certificazioni", $body["alunno_id"], $body["titolo"], $body["votazione"], $body["ente"]);
    
        $response->getBody()->write(json_encode($results));
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
      }
    
      /**
   * funzione update che aggiorna un certificato
   * @url /certificazioni/{id}
   * */
      public function update(Request $request, Response $response, $args){
        $body = json_decode($request->getBody()->getContents(), true);
        $db = Db::getInstance();
        $result = $db->update("alunni", $body["nome"], $body["cognome"], $args["id"]);
    
        $response->getBody()->write(json_encode($results));
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
      }
    
      /**
   * funzione destroy che elimina un alunno
   * @url /certificazioni/{id}
   * */
      public function destroy(Request $request, Response $response, $args){
        // $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
        // $result = $mysqli_connection->query("DELETE FROM `alunni` WHERE `id` = " . $args["id"] . "");
        $db = Db::getInstance();
        $result = $db->update("alunni", $args["id"]);
    
        $response->getBody()->write(json_encode($results));
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
      }
}