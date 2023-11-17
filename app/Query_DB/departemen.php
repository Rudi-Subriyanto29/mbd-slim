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
    //dapertemen
    $app->get('/departemen', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL Read_Departemen()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    // get by id
    //dapertemen 
    $app->get('/departemen/{ID_Departemen}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Departemen_ByID(:ID_Departemen)');
        $query->execute(['ID_Departemen' => $args['ID_Departemen']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    // post data
    //departemen
    $app->post('/departemen', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();

        $ID_Departemen = $parsedBody["ID_Departemen"]; // menambah dengan kolom baru
        $ID_Pabrik = $parsedBody["ID_Pabrik"];
        $Nama_Departemen = $parsedBody["Nama_Departemen"];
     
        
        $db = $this->get(PDO::class);

        // Membuat panggilan ke stored procedure tambahPengguna
        $query = $db->prepare('CALL Insert_Departemen(:ID_Departemen, :ID_Pabrik, :Nama_Departemen)');
        $query->bindParam(':ID_Departemen', $ID_Departemen, PDO::PARAM_INT);
        $query->bindParam(':ID_Pabrik', $ID_Pabrik, PDO::PARAM_INT);
        $query->bindParam(':Nama_Departemen', $Nama_Departemen, PDO::PARAM_STR);

        $query->execute();

        $response->getBody()->write(json_encode(
            [
                'message' => 'Data di tambahkan'
            ]
        ));

        return $response->withHeader("Content-Type", "application/json");
    }); 

    // put data
    //departemen
    $app->put('/departemen/{ID_Departemen}', function (Request $request, Response $response, $args) {
        $parsedBody = $request->getParsedBody();
    
        $ID_Departemen = $args['ID_Departemen'];
        $ID_Pabrik = $parsedBody["ID_Pabrik"];
        $Nama_Departemen = $parsedBody["Nama_Departemen"];
    
        $db = $this->get(PDO::class);
    
        try {
            // Membuat panggilan ke stored procedure yang sesuai
            $query = $db->prepare('CALL Update_Departemen_ByID(:ID_Departemen, :ID_Pabrik, :Nama_Departemen)');
            $query->bindParam(':ID_Departemen', $ID_Departemen, PDO::PARAM_INT);
            $query->bindParam(':ID_Pabrik', $ID_Pabrik, PDO::PARAM_INT);
            $query->bindParam(':Nama_Departemen', $Nama_Departemen, PDO::PARAM_STR);
            
            $query->execute();
    
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Data departemen dengan ID ' . $ID_Departemen . ' telah diperbarui'
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
    //departemen
    $app->delete('/departemen/{ID_Departemen}', function (Request $request, Response $response, $args) {
        $currentId = $args['ID_Departemen'];
        $db = $this->get(PDO::class);

        try {
            // Membuat panggilan ke stored procedure hapusPengguna
            $query = $db->prepare('CALL Delete_Departemen_ByID(:ID_Departemen)');
            $query->bindParam(':ID_Departemen', $currentId, PDO::PARAM_INT);
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
                        'message' => 'Departemen dengan ID ' . $currentId . ' telah dihapus dari database'
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

