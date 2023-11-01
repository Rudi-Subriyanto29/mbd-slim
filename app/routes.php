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

    //get bahan baku
    // $app->get('/bahan_baku', function (Request $request, Response $response) {
    //     $db = $this->get(PDO::class);

    //     $query = $db->query('SELECT * FROM bahan_baku');
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $response->getBody()->write(json_encode($results));

    //     return $response->withHeader("Content-Type", "application/json");
    // });
    // // get departemen
    // $app->get('/departemen', function (Request $request, Response $response) {
    //     $db = $this->get(PDO::class);

    //     $query = $db->query('SELECT * FROM departemen');
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $response->getBody()->write(json_encode($results));

    //     return $response->withHeader("Content-Type", "application/json");
    // });

    // // get karyawan
    // $app->get('/karyawan', function (Request $request, Response $response) {
    //     $db = $this->get(PDO::class);

    //     $query = $db->query('SELECT * FROM karyawan');
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $response->getBody()->write(json_encode($results));

    //     return $response->withHeader("Content-Type", "application/json");
    // });

    // // get mobil
    // $app->get('/mobil', function (Request $request, Response $response) {
    //     $db = $this->get(PDO::class);

    //     $query = $db->query('SELECT * FROM mobil');
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $response->getBody()->write(json_encode($results));

    //     return $response->withHeader("Content-Type", "application/json");
    // });

    // // get model mobil
    // $app->get('/model_mobil', function (Request $request, Response $response) {
    //     $db = $this->get(PDO::class);

    //     $query = $db->query('SELECT * FROM model_mobil');
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $response->getBody()->write(json_encode($results));

    //     return $response->withHeader("Content-Type", "application/json");
    // });

    // // get pabrik
    // $app->get('/pabrik', function (Request $request, Response $response) {
    //     $db = $this->get(PDO::class);

    //     $query = $db->query('SELECT * FROM pabrik');
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $response->getBody()->write(json_encode($results));

    //     return $response->withHeader("Content-Type", "application/json");
    // });

    // // get pabrikasi mobil
    // $app->get('/pabrikasi_mobil', function (Request $request, Response $response) {
    //     $db = $this->get(PDO::class);

    //     $query = $db->query('SELECT * FROM pabrikasi_mobil');
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $response->getBody()->write(json_encode($results));

    //     return $response->withHeader("Content-Type", "application/json");
    // });

    // // get pemasok
    // $app->get('/pemasok', function (Request $request, Response $response) {
    //     $db = $this->get(PDO::class);

    //     $query = $db->query('SELECT * FROM pemasok');
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $response->getBody()->write(json_encode($results));

    //     return $response->withHeader("Content-Type", "application/json");
    // });

    // // get suku cadang
    // $app->get('/suku_cadang', function (Request $request, Response $response) {
    //     $db = $this->get(PDO::class);

    //     $query = $db->query('SELECT * FROM suku_cadang');
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $response->getBody()->write(json_encode($results));

    //     return $response->withHeader("Content-Type", "application/json");
    // });

    // // get by id
    // // bahan baku
    // $app->get('/bahan_baku/{ID_Bahan}', function (Request $request, Response $response, $args) {
    //     $db = $this->get(PDO::class);

    //     $query = $db->prepare('SELECT * FROM bahan_baku WHERE ID_Bahan=?');
    //     $query->execute([$args['ID_Bahan']]);
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $response->getBody()->write(json_encode($results[0]));

    //     return $response->withHeader("Content-Type", "application/json");
    // });

    // // dapertemen
    // $app->get('/departemen/{ID_Departemen}', function (Request $request, Response $response, $args) {
    //     $db = $this->get(PDO::class);

    //     $query = $db->prepare('SELECT * FROM departemen WHERE ID_Departemen=?');
    //     $query->execute([$args['ID_Departemen']]);
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $response->getBody()->write(json_encode($results[0]));

    //     return $response->withHeader("Content-Type", "application/json");
    // });

    // // karyawan 
    // $app->get('/karyawan/{ID_Karyawan}', function (Request $request, Response $response, $args) {
    //     $db = $this->get(PDO::class);

    //     $query = $db->prepare('SELECT * FROM karyawan WHERE ID_Karyawan=?');
    //     $query->execute([$args['ID_Karyawan']]);
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $response->getBody()->write(json_encode($results[0]));

    //     return $response->withHeader("Content-Type", "application/json");
    // });

    //  // mobil 
    //  $app->get('/mobil/{ID_Mobil}', function (Request $request, Response $response, $args) {
    //     $db = $this->get(PDO::class);

    //     $query = $db->prepare('SELECT * FROM mobil WHERE ID_Mobil=?');
    //     $query->execute([$args['ID_Mobil']]);
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $response->getBody()->write(json_encode($results[0]));

    //     return $response->withHeader("Content-Type", "application/json");
    // });

    //  // karyawan 
    //  $app->get('/model_mobil/{ID_Model}', function (Request $request, Response $response, $args) {
    //     $db = $this->get(PDO::class);

    //     $query = $db->prepare('SELECT * FROM model_mobil WHERE ID_Model=?');
    //     $query->execute([$args['ID_Model']]);
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $response->getBody()->write(json_encode($results[0]));

    //     return $response->withHeader("Content-Type", "application/json");
    // });

    //  // pabrik
    //  $app->get('/pabrik/{ID_Pabrik}', function (Request $request, Response $response, $args) {
    //     $db = $this->get(PDO::class);

    //     $query = $db->prepare('SELECT * FROM pabrik WHERE ID_Pabrik=?');
    //     $query->execute([$args['ID_Pabrik']]);
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $response->getBody()->write(json_encode($results[0]));

    //     return $response->withHeader("Content-Type", "application/json");
    // });
    
    //  // pabrikasi
    //  $app->get('/pabrikasi_mobil/{ID_Pabrikasi}', function (Request $request, Response $response, $args) {
    //     $db = $this->get(PDO::class);

    //     $query = $db->prepare('SELECT * FROM pabrikasi_mobil WHERE ID_Pabrikasi=?');
    //     $query->execute([$args['ID_Pabrikasi']]);
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $response->getBody()->write(json_encode($results[0]));

    //     return $response->withHeader("Content-Type", "application/json");
    // });

    //  // pemasok
    //  $app->get('/pemasok/{ID_Pemasok}', function (Request $request, Response $response, $args) {
    //     $db = $this->get(PDO::class);

    //     $query = $db->prepare('SELECT * FROM pemasok WHERE ID_Pemasok=?');
    //     $query->execute([$args['ID_Pemasok']]);
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $response->getBody()->write(json_encode($results[0]));

    //     return $response->withHeader("Content-Type", "application/json");
    // });

    //  // suku cadang
    //  $app->get('/suku_cadang/{ID_Suku_Cadang}', function (Request $request, Response $response, $args) {
    //     $db = $this->get(PDO::class);

    //     $query = $db->prepare('SELECT * FROM suku_cadang WHERE ID_Suku_Cadang=?');
    //     $query->execute([$args['ID_Suku_Cadang']]);
    //     $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $response->getBody()->write(json_encode($results[0]));

    //     return $response->withHeader("Content-Type", "application/json");
    // });
    
    











// get

//bahan_baku
$app->get('/bahan_baku', function (Request $request, Response $response) {
    $db = $this->get(PDO::class);

    $query = $db->query('CALL Read_Bahan_Baku()');
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $response->getBody()->write(json_encode($results));

    return $response->withHeader("Content-Type", "application/json");
});

//dapertemen
$app->get('/departemen', function (Request $request, Response $response) {
    $db = $this->get(PDO::class);

    $query = $db->query('CALL Read_Departemen()');
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $response->getBody()->write(json_encode($results));

    return $response->withHeader("Content-Type", "application/json");
});

//karyawan
$app->get('/karyawan', function (Request $request, Response $response) {
    $db = $this->get(PDO::class);

    $query = $db->query('CALL Read_Karyawan()');
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $response->getBody()->write(json_encode($results));

    return $response->withHeader("Content-Type", "application/json");
});

//mobil
$app->get('/mobil', function (Request $request, Response $response) {
    $db = $this->get(PDO::class);

    $query = $db->query('CALL Read_Mobil()');
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $response->getBody()->write(json_encode($results));

    return $response->withHeader("Content-Type", "application/json");
});

//model mobil
$app->get('/model_mobil', function (Request $request, Response $response) {
    $db = $this->get(PDO::class);

    $query = $db->query('CALL Read_Model_Mobil()');
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $response->getBody()->write(json_encode($results));

    return $response->withHeader("Content-Type", "application/json");
});

//pabrik
$app->get('/pabrik', function (Request $request, Response $response) {
    $db = $this->get(PDO::class);

    $query = $db->query('CALL Read_Pabrik()');
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $response->getBody()->write(json_encode($results));

    return $response->withHeader("Content-Type", "application/json");
});

//pabrikasi mobil
$app->get('/pabrikasi_mobil', function (Request $request, Response $response) {
    $db = $this->get(PDO::class);

    $query = $db->query('CALL Read_Pabrikasi_Mobil()');
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $response->getBody()->write(json_encode($results));

    return $response->withHeader("Content-Type", "application/json");
});

//pemasok
$app->get('/pemasok', function (Request $request, Response $response) {
    $db = $this->get(PDO::class);

    $query = $db->query('CALL Read_Pemasok()');
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $response->getBody()->write(json_encode($results));

    return $response->withHeader("Content-Type", "application/json");
});

//suku cadang
$app->get('/suku_cadang', function (Request $request, Response $response) {
    $db = $this->get(PDO::class);

    $query = $db->query('CALL Read_Suku_Cadang()');
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $response->getBody()->write(json_encode($results));

    return $response->withHeader("Content-Type", "application/json");
});




// get by id
$app->get('/bahan_baku/{ID_Bahan}', function (Request $request, Response $response, $args) {
    $db = $this->get(PDO::class);

    $query = $db->prepare('CALL Read_Bahan_Baku_ByID(:ID_Bahan)');
    $query->execute(['ID_Bahan' => $args['ID_Bahan']]);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $response->getBody()->write(json_encode($results[0]));

    return $response->withHeader("Content-Type", "application/json");
});













    // post data
    $app->post('/bahan_baku', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();

        $ID_Bahan = $parsedBody["ID_Bahan"]; // menambah dengan kolom baru
        $ID_Pemasok = $parsedBody["ID_Pemasok"];
        $Nama_Bahan = $parsedBody["Nama_Bahan"];
        $Harga_Bahan = $parsedBody["Harga_Bahan"];
        $Jumlah_Stok = $parsedBody["Jumlah_Stok"];
        
        $db = $this->get(PDO::class);

        // Membuat panggilan ke stored procedure tambahPengguna
        $query = $db->prepare('CALL insert_Bahan_Baku(:ID_Bahan, :ID_Pemasok, :Nama_Bahan, :Harga_Bahan, :Jumlah_Stok)');
        $query->bindParam(':ID_Bahan', $ID_Bahan, PDO::PARAM_STR);
        $query->bindParam(':ID_Pemasok', $ID_Pemasok, PDO::PARAM_STR);
        $query->bindParam(':Nama_Bahan', $Nama_Bahan, PDO::PARAM_STR);
        $query->bindParam(':Harga_Bahan', $Harga_Bahan, PDO::PARAM_STR);
        $query->bindParam(':Jumlah_Stok', $Jumlah_Stok, PDO::PARAM_STR);

        $query->execute();

        $response->getBody()->write(json_encode(
            [
                'message' => 'Data di tambahkan'
            ]
        ));

        return $response->withHeader("Content-Type", "application/json");
    }); 


    // put data
    $app->put('/bahan_baku/{id}', function (Request $request, Response $response, $args) {
        $parsedBody = $request->getParsedBody();

        $idPengguna = $args['id'];
        $nama = $parsedBody["nama"];
        $email = $parsedBody["email"];

        $db = $this->get(PDO::class);

        // Membuat panggilan ke stored procedure ubahPengguna
        $query = $db->prepare('CALL ubahPengguna(:idPengguna, :nama, :email)');
        $query->bindParam(':idPengguna', $idPengguna, PDO::PARAM_INT);
        $query->bindParam(':nama', $nama, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);

        $query->execute();

        $response->getBody()->write(json_encode(
            [
                'message' => 'Pengguna dengan ID ' . $idPengguna . ' telah diupdate'
            ]
        ));

        return $response->withHeader("Content-Type", "application/json");
    });

    //delete
    $app->delete('/user/{id}', function (Request $request, Response $response, $args) {
        $currentId = $args['id'];
        $db = $this->get(PDO::class);

        try {
            // Membuat panggilan ke stored procedure hapusPengguna
            $query = $db->prepare('CALL hapusPengguna(:idPengguna)');
            $query->bindParam(':idPengguna', $currentId, PDO::PARAM_INT);
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
                        'message' => 'Pengguna dengan ID ' . $currentId . ' telah dihapus dari database'
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


