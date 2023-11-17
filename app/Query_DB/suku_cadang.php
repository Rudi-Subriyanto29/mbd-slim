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
    //suku cadang
    $app->get('/suku_cadang', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL Read_Suku_Cadang()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });


    // get by id
    //suku cadang
    $app->get('/suku_cadang/{ID_Suku_Cadang}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Suku_Cadang_ByID(:ID_Suku_Cadang)');
        $query->execute(['ID_Suku_Cadang' => $args['ID_Suku_Cadang']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });


    // post data
    //suku cadang
    $app->post('/suku_cadang', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();

        $ID_Suku_Cadang = $parsedBody["ID_Suku_Cadang"]; // menambah dengan kolom baru
        $ID_Bahan = $parsedBody["ID_Bahan"];
        $Nama_Suku_Cadang = $parsedBody["Nama_Suku_Cadang"];
        $Deskripsi_Suku_Cadang = $parsedBody["Deskripsi_Suku_Cadang"];
        $Harga_Suku_Cadang = $parsedBody["Harga_Suku_Cadang"];

        $db = $this->get(PDO::class);

        // Membuat panggilan ke stored procedure tambahPengguna
        $query = $db->prepare('CALL Insert_Suku_Cadang(:ID_Suku_Cadang, :ID_Bahan, :Nama_Suku_Cadang, :Deskripsi_Suku_Cadang, :Harga_Suku_Cadang)');
        $query->bindParam(':ID_Suku_Cadang', $ID_Suku_Cadang, PDO::PARAM_INT);
        $query->bindParam(':ID_Bahan', $ID_Bahan, PDO::PARAM_INT);
        $query->bindParam(':Nama_Suku_Cadang', $Nama_Suku_Cadang, PDO::PARAM_STR);
        $query->bindParam(':Deskripsi_Suku_Cadang', $Deskripsi_Suku_Cadang, PDO::PARAM_STR);
        $query->bindParam(':Harga_Suku_Cadang', $Harga_Suku_Cadang, PDO::PARAM_INT);
        $query->execute();

        $response->getBody()->write(json_encode(
            [
                'message' => 'Data di tambahkan'
            ]
        ));

        return $response->withHeader("Content-Type", "application/json");
    }); 


    // put data
    //suku cadang
    $app->put('/suku_cadang/{ID_Suku_Cadang}', function (Request $request, Response $response, $args) {
        $parsedBody = $request->getParsedBody();
    
        $ID_Suku_Cadang = $args['ID_Suku_Cadang'];
        $ID_Bahan = $parsedBody["ID_Bahan"];
        $Nama_Suku_Cadang = $parsedBody["Nama_Suku_Cadang"];
        $Deskripsi_Suku_Cadang = $parsedBody["Deskripsi_Suku_Cadang"];
        $Harga_Suku_Cadang = $parsedBody["Harga_Suku_Cadang"];

        $db = $this->get(PDO::class);
    
        try {
            // Membuat panggilan ke stored procedure yang sesuai
            $query = $db->prepare('CALL Update_Suku_Cadang_ByID(:ID_Suku_Cadang, :ID_Bahan, :Nama_Suku_Cadang, :Deskripsi_Suku_Cadang, :Harga_Suku_Cadang)');
            $query->bindParam(':ID_Suku_Cadang', $ID_Suku_Cadang, PDO::PARAM_INT);
            $query->bindParam(':ID_Bahan', $ID_Bahan, PDO::PARAM_INT);
            $query->bindParam(':Nama_Suku_Cadang', $Nama_Suku_Cadang, PDO::PARAM_STR);
            $query->bindParam(':Deskripsi_Suku_Cadang', $Deskripsi_Suku_Cadang, PDO::PARAM_STR); // Pastikan ini sesuai dengan tipe data di database
            $query->bindParam(':Harga_Suku_Cadang', $Harga_Suku_Cadang, PDO::PARAM_INT);

            $query->execute();
    
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Data Suku Cadang dengan ID ' . $ID_Suku_Cadang . ' telah diperbarui'
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
    //suku_cadang
    $app->delete('/suku_cadang/{ID_Suku_Cadang}', function (Request $request, Response $response, $args) {
        $currentId = $args['ID_Suku_Cadang'];
        $db = $this->get(PDO::class);

        try {
            // Membuat panggilan ke stored procedure hapusPengguna
            $query = $db->prepare('CALL Delete_Departemen_ByID(:ID_Suku_Cadang)');
            $query->bindParam(':ID_Suku_Cadang', $currentId, PDO::PARAM_INT);
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
                        'message' => 'Suku Cadang dengan ID ' . $currentId . ' telah dihapus dari database'
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

