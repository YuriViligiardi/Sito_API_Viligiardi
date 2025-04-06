<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/AlunniController.php';
require __DIR__ . '/controllers/includes/Db.php';


$app = AppFactory::create();

//curl http://localhost:8080/alunni
$app->get('/alunni', "AlunniController:index");

//curl http://localhost:8080/alunni/2 
$app->get('/alunni/{id}', "AlunniController:show");

//curl -X POST http://localhost:8080/alunni -H "Content-Type: application/json" -d '{"nome": "Giacomo", "cognome": "Petrini"}'
$app->post('/alunni', "AlunniController:create");

//curl -X PUT http://localhost:8080/alunni/5 -H "Content-Type: application/json" -d '{"nome": "Yuri", "cognome": "Viligiardi"}'
$app->put('/alunni/{id}', "AlunniController:update");

//curl -X DELETE http://localhost:8080/alunni/2
$app->delete('/alunni/{id}', "AlunniController:destroy");

$app->run();
