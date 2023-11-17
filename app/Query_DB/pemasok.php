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
    //pemasok
    $app->get('/pemasok', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL Read_Pemasok()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });


    // get by id
    //pemasok
    $app->get('/pemasok/{ID_Pemasok}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Pemasok_ByID(:ID_Pemasok)');
        $query->execute(['ID_Pemasok' => $args['ID_Pemasok']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });


    // post data
    //Pemasok
    $app->post('/pemasok', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();

        $ID_Pemasok = $parsedBody["ID_Pemasok"]; // menambah dengan kolom baru
        $Nama_Pemasok = $parsedBody["Nama_Pemasok"];
        $Alamat_Pemasok = $parsedBody["Alamat_Pemasok"];
        $Kontak_Pemasok = $parsedBody["Kontak_Pemasok"];
        
        $db = $this->get(PDO::class);

        // Membuat panggilan ke stored procedure tambahPengguna
        $query = $db->prepare('CALL Insert_Pemasok(:ID_Pemasok, :Nama_Pemasok, :Alamat_Pemasok, :Kontak_Pemasok)');
        $query->bindParam(':ID_Pemasok', $ID_Pemasok, PDO::PARAM_INT);
        $query->bindParam(':Nama_Pemasok', $Nama_Pemasok, PDO::PARAM_STR);
        $query->bindParam(':Alamat_Pemasok', $Alamat_Pemasok, PDO::PARAM_STR);
        $query->bindParam(':Kontak_Pemasok', $Kontak_Pemasok, PDO::PARAM_STR);
       
        $query->execute();

        $response->getBody()->write(json_encode(
            [
                'message' => 'Data di tambahkan'
            ]
        ));

        return $response->withHeader("Content-Type", "application/json");
    }); 

    
    // put data
    //pemasok
    $app->put('/pemasok/{ID_Pemasok}', function (Request $request, Response $response, $args) {
        $parsedBody = $request->getParsedBody();
    
        $ID_Pemasok = $args['ID_Pemasok'];
        $Nama_Pemasok = $parsedBody["Nama_Pemasok"];
        $Alamat_Pemasok = $parsedBody["Alamat_Pemasok"];
        $Kontak_Pemasok = $parsedBody["Kontak_Pemasok"];

        $db = $this->get(PDO::class);
    
        try {
            // Membuat panggilan ke stored procedure yang sesuai
            $query = $db->prepare('CALL Update_Pemasok_ByID(:ID_Pemasok, :Nama_Pemasok, :Alamat_Pemasok, :Kontak_Pemasok)');
            $query->bindParam(':ID_Pemasok', $ID_Pemasok, PDO::PARAM_INT);
            $query->bindParam(':Nama_Pemasok', $Nama_Pemasok, PDO::PARAM_STR);
            $query->bindParam(':Alamat_Pemasok', $Alamat_Pemasok, PDO::PARAM_STR);
            $query->bindParam(':Kontak_Pemasok', $Kontak_Pemasok, PDO::PARAM_STR);
        

            $query->execute();
    
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Data Pemasok dengan ID ' . $ID_Pemasok . ' telah diperbarui'
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
    //pemasok
    $app->delete('/pemasok/{ID_Pemasok}', function (Request $request, Response $response, $args) {
        $currentId = $args['ID_Pemasok'];
        $db = $this->get(PDO::class);

        try {
            // Membuat panggilan ke stored procedure hapusPengguna
            $query = $db->prepare('CALL Delete_Departemen_ByID(:ID_Pemasok)');
            $query->bindParam(':ID_Pemasok', $currentId, PDO::PARAM_INT);
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
                        'message' => 'Pemasok dengan ID ' . $currentId . ' telah dihapus dari database'
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

