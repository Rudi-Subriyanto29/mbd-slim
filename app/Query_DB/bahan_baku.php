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
    //bahan_baku
    $app->get('/bahan_baku', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL Read_Bahan_Baku()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    

    // get by id
    //bahan baku
    $app->get('/bahan_baku/{ID_Bahan}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Bahan_Baku_ByID(:ID_Bahan)');
        $query->execute(['ID_Bahan' => $args['ID_Bahan']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });



    // post data
    //bahan baku 
    $app->post('/bahan_baku', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();

        $ID_Bahan = $parsedBody["ID_Bahan"]; // menambah dengan kolom baru
        $ID_Pemasok = $parsedBody["ID_Pemasok"];
        $Nama_Bahan = $parsedBody["Nama_Bahan"];
        $Harga_Bahan = $parsedBody["Harga_Bahan"];
        $Jumlah_Stok = $parsedBody["Jumlah_Stok"];
        
        $db = $this->get(PDO::class);

        // Membuat panggilan ke stored procedure tambahPengguna
        $query = $db->prepare('CALL Insert_Bahan_Baku(:ID_Bahan, :ID_Pemasok, :Nama_Bahan, :Harga_Bahan, :Jumlah_Stok)');
        $query->bindParam(':ID_Bahan', $ID_Bahan, PDO::PARAM_INT);
        $query->bindParam(':ID_Pemasok', $ID_Pemasok, PDO::PARAM_INT);
        $query->bindParam(':Nama_Bahan', $Nama_Bahan, PDO::PARAM_STR);
        $query->bindParam(':Harga_Bahan', $Harga_Bahan, PDO::PARAM_INT);
        $query->bindParam(':Jumlah_Stok', $Jumlah_Stok, PDO::PARAM_INT);

        $query->execute();

        $response->getBody()->write(json_encode(
            [
                'message' => 'Data di tambahkan'
            ]
        ));

        return $response->withHeader("Content-Type", "application/json");
    }); 


    // put data
    //bahan baku
    $app->put('/bahan_baku/{ID_Bahan}', function (Request $request, Response $response, $args) {
        $parsedBody = $request->getParsedBody();
    
        $ID_Bahan = $args['ID_Bahan'];
        $ID_Pemasok = $parsedBody["ID_Pemasok"];
        $Nama_Bahan = $parsedBody["Nama_Bahan"];
        $Harga_Bahan = $parsedBody["Harga_Bahan"];
        $Jumlah_Stok = $parsedBody["Jumlah_Stok"];
    
        $db = $this->get(PDO::class);
    
        try {
            // Membuat panggilan ke stored procedure yang sesuai
            $query = $db->prepare('CALL Update_Bahan_Baku_ByID(:ID_Bahan, :ID_Pemasok, :Nama_Bahan, :Harga_Bahan, :Jumlah_Stok)');
            $query->bindParam(':ID_Bahan', $ID_Bahan, PDO::PARAM_INT);
            $query->bindParam(':ID_Pemasok', $ID_Pemasok, PDO::PARAM_INT);
            $query->bindParam(':Nama_Bahan', $Nama_Bahan, PDO::PARAM_STR);
            $query->bindParam(':Harga_Bahan', $Harga_Bahan, PDO::PARAM_INT);
            $query->bindParam(':Jumlah_Stok', $Jumlah_Stok, PDO::PARAM_INT); // Pastikan ini sesuai dengan tipe data di database
    
            $query->execute();
    
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Data bahan baku dengan ID ' . $ID_Bahan . ' telah diperbarui'
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
    //bahan baku
    $app->delete('/bahan_baku/{ID_Bahan}', function (Request $request, Response $response, $args) {
        $currentId = $args['ID_Bahan'];
        $db = $this->get(PDO::class);

        try {
            // Membuat panggilan ke stored procedure hapusPengguna
            $query = $db->prepare('CALL Delete_Bahan_Baku_ByID(:ID_Bahan)');
            $query->bindParam(':ID_Bahan', $currentId, PDO::PARAM_INT);
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
                        'message' => 'Bahan Baku dengan ID ' . $currentId . ' telah dihapus dari database'
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

//dhauidhjauiohdiouahjdauihauhdaiudhaiuhdiawuhdiauhdaiudh