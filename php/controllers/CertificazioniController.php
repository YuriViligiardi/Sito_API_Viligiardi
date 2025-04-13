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
        $certificazione = array{
          "id" => $body["alunno_id"];
          "titolo" => $body["titolo"];
          "voto" => $body["votazione"];
          "ente" => $body["ente"];
        }
        $db = Db::getInstance();
        $result = $db->create("certificazioni", $certificazione);
        if ($result) {
          $response->getBody()->write("Certificazione creata");
          return $response->withHeader("Content-type", "application/json")->withStatus(200);
        } 
    
        $response->getBody()->write("Certificazione non creata");
        return $response->withHeader("Content-type", "application/json")->withStatus(404);
      }
    
      /**
   * funzione update che aggiorna un certificato
   * @url /certificazioni/{id}
   * */
      public function update(Request $request, Response $response, $args){
        $body = json_decode($request->getBody()->getContents(), true);
        $db = Db::getInstance();
        $result = $db->update("certificazioni", $body, "id=" . $args["id"]);
        if ($result) {
          $response->getBody()->write("Certificazione " . $args["id"] . " aggiornata");
          return $response->withHeader("Content-type", "application/json")->withStatus(200);
        } 
    
        $response->getBody()->write("Certificazione " . $args["id"] . " non aggiornata");
        return $response->withHeader("Content-type", "application/json")->withStatus(404);
      }
    
      /**
   * funzione destroy che elimina un alunno
   * @url /certificazioni/{id}
   * */
      public function destroy(Request $request, Response $response, $args){
        $db = Db::getInstance();
        $result = $db->update("certificazioni", $args["id"]);
        if ($result) {
          $response->getBody()->write("Certificazione " . $args["id"] . " eliminata");
          return $response->withHeader("Content-type", "application/json")->withStatus(200);
        } 
    
        $response->getBody()->write("Certificazione " . $args["id"] . " non eliminata");
        return $response->withHeader("Content-type", "application/json")->withStatus(404);
      }
}