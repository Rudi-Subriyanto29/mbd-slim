<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {

    // get
    //model mobil
    $app->get('/model_mobil', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL Read_Model_Mobil()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    // get by id
    //model mobil
    $app->get('/model_mobil/{ID_Model}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Model_Mobil_ByID(:ID_Model)');
        $query->execute(['ID_Model' => $args['ID_Model']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    // post data
    //model mobil
    $app->post('/model_mobil', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();

        $ID_Model = $parsedBody["ID_Model"]; // menambah dengan kolom baru
        $Nama_Model = $parsedBody["Nama_Model"];
        $Spesifikasi_Model = $parsedBody["Spesifikasi_Model"];
       

        $db = $this->get(PDO::class);

        // Membuat panggilan ke stored procedure tambahPengguna
        $query = $db->prepare('CALL Insert_Model_Mobil(:ID_Model, :Nama_Model, :Spesifikasi_Model)');
        $query->bindParam(':ID_Model', $ID_Model, PDO::PARAM_INT);
        $query->bindParam(':Nama_Model', $Nama_Model, PDO::PARAM_STR);
        $query->bindParam(':Spesifikasi_Model', $Spesifikasi_Model, PDO::PARAM_STR);
        

        $query->execute();

        $response->getBody()->write(json_encode(
            [
                'message' => 'Data di tambahkan'
            ]
        ));

        return $response->withHeader("Content-Type", "application/json");
    }); 


    // put data
    //model mobil
    $app->put('/model_mobil/{ID_Model}', function (Request $request, Response $response, $args) {
        $parsedBody = $request->getParsedBody();
    
        $ID_Model = $args['ID_Model'];
        $Nama_Model = $parsedBody["Nama_Model"];
        $Spesifikasi_Model = $parsedBody["Spesifikasi_Model"];
        

        $db = $this->get(PDO::class);
    
        try {
            // Membuat panggilan ke stored procedure yang sesuai
            $query = $db->prepare('CALL Update_Model_Mobil_ByID(:ID_Model, :Nama_Model, :Spesifikasi_Model)');
            $query->bindParam(':ID_Model', $ID_Model, PDO::PARAM_INT);
            $query->bindParam(':Nama_Model', $Nama_Model, PDO::PARAM_STR);
            $query->bindParam(':Spesifikasi_Model', $Spesifikasi_Model, PDO::PARAM_STR);
            

            $query->execute();
    
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Data Model Mobil dengan ID ' . $ID_Model . ' telah diperbarui'
                ]
            ));
        } catch (PDOException $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode([
                'message' => 'Terdapat error pada database ' . $e->getMessage()
            ]));
        }
    
        return $response->withHeader("Content-Type", "application/json");
    });


    
    //delete
    //model mobil
    $app->delete('/model_mobil/{ID_Model}', function (Request $request, Response $response, $args) {
        $currentId = $args['ID_Model'];
        $db = $this->get(PDO::class);

        try {
            // Membuat panggilan ke stored procedure hapusPengguna
            $query = $db->prepare('CALL Delete_Model_Mobil_ByID(:ID_Model)');
            $query->bindParam(':ID_Model', $currentId, PDO::PARAM_INT);
            $query->execute();

            if ($query->rowCount() === 0) {
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(
                    [
                        'message' => 'Data tidak ditemukan'
                    ]
                ));
            } else {
                $response->getBody()->write(json_encode(
                    [
                        'message' => 'Model Mobil dengan ID ' . $currentId . ' telah dihapus dari database'
                    ]
                ));
            }
        } catch (PDOException $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Database error ' . $e->getMessage()
                ]
            ));
        }

        return $response->withHeader("Content-Type", "application/json");
    });

};




//php -S localhost:8888 -t public

