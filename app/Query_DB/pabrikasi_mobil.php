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
    //pabrikasi mobil
    $app->get('/pabrikasi_mobil', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL Read_Pabrikasi_Mobil()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });


    // get by id
    //pabrikasi mobil
    $app->get('/pabrikasi_mobil/{ID_Pabrikasi}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Pabrikasi_Mobil_ByID(:ID_Pabrikasi)');
        $query->execute(['ID_Pabrikasi' => $args['ID_Pabrikasi']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });


    // post data
    //Pabrikasi mobil
    $app->post('/pabrikasi_mobil', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();

        $ID_Pabrikasi = $parsedBody["ID_Pabrikasi"]; // menambah dengan kolom baru
        $ID_Mobil = $parsedBody["ID_Mobil"];
        $ID_Karyawan = $parsedBody["ID_Karyawan"];
        $Tanggal_Produksi_Pabrikasi = $parsedBody["Tanggal_Produksi_Pabrikasi"];
        
        $db = $this->get(PDO::class);

        // Membuat panggilan ke stored procedure tambahPengguna
        $query = $db->prepare('CALL Insert_Pabrikasi_Mobil(:ID_Pabrikasi, :ID_Mobil, :ID_Karyawan, :Tanggal_Produksi_Pabrikasi)');
        $query->bindParam(':ID_Pabrikasi', $ID_Pabrikasi, PDO::PARAM_INT);
        $query->bindParam(':ID_Mobil', $ID_Mobil, PDO::PARAM_INT);
        $query->bindParam(':ID_Karyawan', $ID_Karyawan, PDO::PARAM_INT);
        $query->bindParam(':Tanggal_Produksi_Pabrikasi', $Tanggal_Produksi_Pabrikasi, PDO::PARAM_DATE);
       
        $query->execute();

        $response->getBody()->write(json_encode(
            [
                'message' => 'Data di tambahkan'
            ]
        ));

        return $response->withHeader("Content-Type", "application/json");
    }); 

   
    // put data
    //pabrikasi mobil
    $app->put('/pabrikasi_mobil/{ID_Pabrikasi}', function (Request $request, Response $response, $args) {
        $parsedBody = $request->getParsedBody();
    
        $ID_Pabrikasi = $args['ID_Pabrikasi'];
        $ID_Mobil = $parsedBody["ID_Mobil"];
        $ID_Karyawan = $parsedBody["ID_Karyawan"];
        $Tanggal_Produksi_Pabrikasi = $parsedBody["Tanggal_Produksi_Pabrikasi"];

        $db = $this->get(PDO::class);
    
        try {
            // Membuat panggilan ke stored procedure yang sesuai
            $query = $db->prepare('CALL Update_Pabrikasi_Mobil_ByID(:ID_Pabrikasi, :ID_Mobil, :ID_Karyawan, :Tanggal_Produksi_Pabrikasi)');
            $query->bindParam(':ID_Pabrikasi', $ID_Pabrikasi, PDO::PARAM_INT);
            $query->bindParam(':ID_Mobil', $ID_Mobil, PDO::PARAM_INT);
            $query->bindParam(':ID_Karyawan', $ID_Karyawan, PDO::PARAM_INT);
            $query->bindParam(':Tanggal_Produksi_Pabrikasi', $Tanggal_Produksi_Pabrikasi, PDO::PARAM_DATE);

            $query->execute();
    
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Data Pabrikasi Mobil dengan ID ' . $ID_Pabrikasi . ' telah diperbarui'
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
    //pabrikasi mobil
    $app->delete('/pabrikasi_mobil/{ID_Pabrikasi}', function (Request $request, Response $response, $args) {
        $currentId = $args['ID_Pabrikasi'];
        $db = $this->get(PDO::class);

        try {
            // Membuat panggilan ke stored procedure hapusPengguna
            $query = $db->prepare('CALL Delete_Departemen_ByID(:ID_Pabrikasi)');
            $query->bindParam(':ID_Pabrikasi', $currentId, PDO::PARAM_INT);
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
                        'message' => 'Pabrikasi Mobil dengan ID ' . $currentId . ' telah dihapus dari database'
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

