<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {

    // get all data
    $app->get('/permodelan', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('SELECT * FROM View_Gabungan_Pabrik_Departemen_Mobil');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        // You may want to handle errors or edge cases here

        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });


    // Assuming $app is an instance of Slim\App



    // get data by ID
    $app->get('/permodelan/{id}', function (Request $request, Response $response, array $args) {
        $db = $this->get(PDO::class);
        $id = $args['id'];

        // Use a prepared statement to avoid SQL injection
        $query = $db->prepare('SELECT * FROM View_Gabungan_Pabrik_Departemen_Mobil WHERE ID_Mobil = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            // Handle the case where no data is found for the given ID
            return $response->withStatus(404)->withJson(['error' => 'Data not found']);
        }

        $response->getBody()->write(json_encode($result));

        return $response->withHeader("Content-Type", "application/json");
    });





    

};