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
    //mobil
    $app->get('/mobil', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL Read_Mobil()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

   
    // get by id
    //mobil
    $app->get('/mobil/{ID_Mobil}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Mobil_ByID(:ID_Mobil)');
        $query->execute(['ID_Mobil' => $args['ID_Mobil']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });


    // post data
     //mobil
     $app->post('/mobil', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();

        $ID_Mobil = $parsedBody["ID_Mobil"]; // menambah dengan kolom baru
        $ID_Pabrik = $parsedBody["ID_Pabrik"];
        $ID_Bahan = $parsedBody["ID_Bahan"];
        $ID_Model = $parsedBody["ID_Model"];
        $Nama_Mobil = $parsedBody["Nama_Mobil"];
        $Tahun_Produksi = $parsedBody["Tahun_Produksi"];
        $Warna_Mobil = $parsedBody["Warna_Mobil"];

        $db = $this->get(PDO::class);

        // Membuat panggilan ke stored procedure tambahPengguna
        $query = $db->prepare('CALL Insert_Mobil(:ID_Mobil, :ID_Pabrik, :ID_Bahan, :ID_Model, :Nama_Mobil, :Tahun_Produksi, :Warna_Mobil)');
        $query->bindParam(':ID_Mobil', $ID_Mobil, PDO::PARAM_INT);
        $query->bindParam(':ID_Pabrik', $ID_Pabrik, PDO::PARAM_INT);
        $query->bindParam(':ID_Bahan', $ID_Bahan, PDO::PARAM_INT);
        $query->bindParam(':ID_Model', $ID_Model, PDO::PARAM_INT);
        $query->bindParam(':Nama_Mobil', $Nama_Mobil, PDO::PARAM_STR);
        $query->bindParam(':Tahun_Produksi', $Tahun_Produksi, PDO::PARAM_INT);
        $query->bindParam(':Warna_Mobil', $Warna_Mobil, PDO::PARAM_STR);

        $query->execute();

        $response->getBody()->write(json_encode(
            [
                'message' => 'Data di tambahkan'
            ]
        ));

        return $response->withHeader("Content-Type", "application/json");
    }); 


    // put data
    //mobil
    $app->put('/mobil/{ID_Mobil}', function (Request $request, Response $response, $args) {
        $parsedBody = $request->getParsedBody();
    
        $ID_Mobil = $args['ID_Mobil'];
        $ID_Pabrik = $parsedBody["ID_Pabrik"];
        $ID_Bahan = $parsedBody["ID_Bahan"];
        $ID_Model = $parsedBody["ID_Model"];
        $Nama_Mobil = $parsedBody["Nama_Mobil"];
        $Tahun_Produksi = $parsedBody["Tahun_Produksi"];
        $Warna_Mobil = $parsedBody["Warna_Mobil"];

        $db = $this->get(PDO::class);
    
        try {
            // Membuat panggilan ke stored procedure yang sesuai
            $query = $db->prepare('CALL Update_Mobil_ByID(:ID_Mobil, :ID_Pabrik, :ID_Bahan, :ID_Model, :Nama_Mobil, :Tahun_Produksi, :Warna_Mobil)');
            $query->bindParam(':ID_Mobil', $ID_Mobil, PDO::PARAM_INT);
            $query->bindParam(':ID_Pabrik', $ID_Pabrik, PDO::PARAM_INT);
            $query->bindParam(':ID_Bahan', $ID_Bahan, PDO::PARAM_INT);
            $query->bindParam(':ID_Model', $ID_Model, PDO::PARAM_INT);
            $query->bindParam(':Nama_Mobil', $Nama_Mobil, PDO::PARAM_STR); // Pastikan ini sesuai dengan tipe data di database
            $query->bindParam(':Tahun_Produksi', $Tahun_Produksi, PDO::PARAM_INT);
            $query->bindParam(':Warna_Mobil', $Warna_Mobil, PDO::PARAM_STR);

            $query->execute();
    
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Data Mobil dengan ID ' . $ID_Mobil . ' telah diperbarui'
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
    //mobil
    $app->delete('/mobil/{ID_Mobil}', function (Request $request, Response $response, $args) {
        $currentId = $args['ID_Mobil'];
        $db = $this->get(PDO::class);

        try {
            // Membuat panggilan ke stored procedure hapusPengguna
            $query = $db->prepare('CALL Delete_Mobil_ByID(:ID_Mobil)');
            $query->bindParam(':ID_Mobil', $currentId, PDO::PARAM_INT);
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
                        'message' => 'Mobil dengan ID ' . $currentId . ' telah dihapus dari database'
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

