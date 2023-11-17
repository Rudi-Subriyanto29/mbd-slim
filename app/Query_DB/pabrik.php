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
    //pabrik
    $app->get('/pabrik', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL Read_Pabrik()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

   
    // get by id
    //pabrik
    $app->get('/pabrik/{ID_Pabrik}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Pabrik_ByID(:ID_Pabrik)');
        $query->execute(['ID_Pabrik' => $args['ID_Pabrik']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    

    // post data
    //pabrik
    $app->post('/pabrik', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();

        $ID_Pabrik = $parsedBody["ID_Pabrik"]; // menambah dengan kolom baru
        $Nama_Pabrik = $parsedBody["Nama_Pabrik"];
        $Alamat_Pabrik = $parsedBody["Alamat_Pabrik"];
        $Tanggal_Pendirian = $parsedBody["Tanggal_Pendirian"];

        $db = $this->get(PDO::class);

        // Membuat panggilan ke stored procedure tambahPengguna
        $query = $db->prepare('CALL Insert_Pabrik(:ID_Pabrik, :Nama_Pabrik, :Alamat_Pabrik, :Tanggal_Pendirian)');
        $query->bindParam(':ID_Pabrik', $ID_Pabrik, PDO::PARAM_INT);
        $query->bindParam(':Nama_Pabrik', $Nama_Pabrik, PDO::PARAM_STR);
        $query->bindParam(':Alamat_Pabrik', $Alamat_Pabrik, PDO::PARAM_STR);
        $query->bindParam(':Tanggal_Pendirian', $Tanggal_Pendirian, PDO::PARAM_DATE);

        $query->execute();

        $response->getBody()->write(json_encode(
            [
                'message' => 'Data di tambahkan'
            ]
        ));

        return $response->withHeader("Content-Type", "application/json");
    }); 



    // put data
    //pabrik
    $app->put('/pabrik/{ID_Pabrik}', function (Request $request, Response $response, $args) {
        $parsedBody = $request->getParsedBody();
    
        $ID_Pabrik = $args['ID_Pabrik'];
        $Nama_Pabrik = $parsedBody["Nama_Pabrik"];
        $Alamat_Pabrik = $parsedBody["Alamat_Pabrik"];
        $Tanggal_Pendirian = $parsedBody["Tanggal_Pendirian"];

        $db = $this->get(PDO::class);
    
        try {
            // Membuat panggilan ke stored procedure yang sesuai
            $query = $db->prepare('CALL Update_Pabrik_ByID(:ID_Pabrik, :ID_Pabrik, :Nama_Pabrik, :Alamat_Pabrik, :Tanggal_Pendirian)');
            $query->bindParam(':ID_Pabrik', $ID_Pabrik, PDO::PARAM_INT);
            $query->bindParam(':Nama_Pabrik', $Nama_Pabrik, PDO::PARAM_STR);
            $query->bindParam(':Alamat_Pabrik', $Alamat_Pabrik, PDO::PARAM_STR);
            $query->bindParam(':Tanggal_Pendirian', $Tanggal_Pendirian, PDO::PARAM_DATE); // Pastikan ini sesuai dengan tipe data di database
         
            $query->execute();
    
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Data Pabrik dengan ID ' . $ID_Pabrik . ' telah diperbarui'
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
    //pabrik
    $app->delete('/pabrik/{ID_Pabrik}', function (Request $request, Response $response, $args) {
        $currentId = $args['ID_Pabrik'];
        $db = $this->get(PDO::class);

        try {
            // Membuat panggilan ke stored procedure hapusPengguna
            $query = $db->prepare('CALL Delete_Departemen_ByID(:ID_Pabrik)');
            $query->bindParam(':ID_Pabrik', $currentId, PDO::PARAM_INT);
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
                        'message' => 'Pabrik dengan ID ' . $currentId . ' telah dihapus dari database'
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

