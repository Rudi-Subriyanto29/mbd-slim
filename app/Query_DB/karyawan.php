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
    //karyawan
    $app->get('/karyawan', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL Read_Karyawan()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    // get by id
    //karyawan
    $app->get('/karyawan/{ID_Karyawan}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Karyawan_ByID(:ID_Karyawan)');
        $query->execute(['ID_Karyawan' => $args['ID_Karyawan']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    // post data
    //karyawan
    $app->post('/karyawan', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();

        $ID_Karyawan = $parsedBody["ID_Karyawan"]; // menambah dengan kolom baru
        $ID_Departemen = $parsedBody["ID_Departemen"];
        $Nama_Karyawan = $parsedBody["Nama_Karyawan"];
        $Jabatan = $parsedBody["Jabatan"];
        $Tanggal_Masuk = $parsedBody["Tanggal_Masuk"];
        
        $db = $this->get(PDO::class);

        // Membuat panggilan ke stored procedure tambahPengguna
        $query = $db->prepare('CALL Insert_Karyawan(:ID_Karyawan, :ID_Departemen, :Nama_Karyawan, :Jabatan, :Tanggal_Masuk)');
        $query->bindParam(':ID_Karyawan', $ID_Karyawan, PDO::PARAM_INT);
        $query->bindParam(':ID_Departemen', $ID_Departemen, PDO::PARAM_INT);
        $query->bindParam(':Nama_Karyawan', $Nama_Karyawan, PDO::PARAM_STR);
        $query->bindParam(':Jabatan', $Jabatan, PDO::PARAM_STR);
        $query->bindParam(':Tanggal_Masuk', $Tanggal_Masuk, PDO::PARAM_DATE);

        $query->execute();

        $response->getBody()->write(json_encode(
            [
                'message' => 'Data di tambahkan'
            ]
        ));

        return $response->withHeader("Content-Type", "application/json");
    }); 

    // put data
    //karyawan
    $app->put('/karyawan/{ID_Karyawan}', function (Request $request, Response $response, $args) {
        $parsedBody = $request->getParsedBody();
    
        $ID_Karyawan = $args['ID_Karyawan'];
        $ID_Departemen = $parsedBody["ID_Departemen"];
        $Nama_Karyawan = $parsedBody["Nama_Karyawan"];
        $Jabatan = $parsedBody["Jabatan"];
        $Tanggal_Masuk = $parsedBody["Tanggal_Masuk"];
    
        $db = $this->get(PDO::class);
    
        try {
            // Membuat panggilan ke stored procedure yang sesuai
            $query = $db->prepare('CALL Update_Karyawan_ByID(:ID_Karyawan, :ID_Departemen, :Nama_Karyawan, :Jabatan, :Tanggal_Masuk)');
            $query->bindParam(':ID_Karyawan', $ID_Karyawan, PDO::PARAM_INT);
            $query->bindParam(':ID_Departemen', $ID_Departemen, PDO::PARAM_INT);
            $query->bindParam(':Nama_Karyawan', $Nama_Karyawan, PDO::PARAM_STR);
            $query->bindParam(':Jabatan', $Jabatan, PDO::PARAM_STR);
            $query->bindParam(':Tanggal_Masuk', $Tanggal_Masuk, PDO::PARAM_DATE); // Pastikan ini sesuai dengan tipe data di database
    
            $query->execute();
    
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Data Karyawan dengan ID ' . $ID_Karyawan . ' telah diperbarui'
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
    //karyawan
    $app->delete('/karyawan/{ID_Karyawan}', function (Request $request, Response $response, $args) {
        $currentId = $args['ID_Karyawan'];
        $db = $this->get(PDO::class);

        try {
            // Membuat panggilan ke stored procedure hapusPengguna
            $query = $db->prepare('CALL Delete_Karyawan_ByID(:ID_Karyawan)');
            $query->bindParam(':ID_Karyawan', $currentId, PDO::PARAM_INT);
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
                        'message' => 'Karyawan dengan ID ' . $currentId . ' telah dihapus dari database'
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

