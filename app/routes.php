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

    //bahan baku
    $app->get('/bahan_baku/{ID_Bahan}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Bahan_Baku_ByID(:ID_Bahan)');
        $query->execute(['ID_Bahan' => $args['ID_Bahan']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });


    //dapertemen 
    $app->get('/departemen/{ID_Departemen}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Departemen_ByID(:ID_Departemen)');
        $query->execute(['ID_Departemen' => $args['ID_Departemen']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    //karyawan
    $app->get('/karyawan/{ID_Karyawan}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Karyawan_ByID(:ID_Karyawan)');
        $query->execute(['ID_Karyawan' => $args['ID_Karyawan']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    //mobil
    $app->get('/mobil/{ID_Mobil}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Mobil_ByID(:ID_Mobil)');
        $query->execute(['ID_Mobil' => $args['ID_Mobil']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    //model mobil
    $app->get('/model_mobil/{ID_Model}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Model_Mobil_ByID(:ID_Model)');
        $query->execute(['ID_Model' => $args['ID_Model']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    //pabrik
    $app->get('/pabrik/{ID_Pabrik}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Pabrik_ByID(:ID_Pabrik)');
        $query->execute(['ID_Pabrik' => $args['ID_Pabrik']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    //pabrikasi mobil
    $app->get('/pabrikasi_mobil/{ID_Pabrikasi}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Pabrikasi_Mobil_ByID(:ID_Pabrikasi)');
        $query->execute(['ID_Pabrikasi' => $args['ID_Pabrikasi']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

    //pemasok
    $app->get('/pemasok/{ID_Pemasok}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);

        $query = $db->prepare('CALL Read_Pemasok_ByID(:ID_Pemasok)');
        $query->execute(['ID_Pemasok' => $args['ID_Pemasok']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results[0]));

        return $response->withHeader("Content-Type", "application/json");
    });

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
        $query->bindParam(':Tahun_Produksi', $Tahun_Produksi, PDO::PARAM_DATE);
        $query->bindParam(':Warna_Mobil', $Warna_Mobil, PDO::PARAM_STR);

        $query->execute();

        $response->getBody()->write(json_encode(
            [
                'message' => 'Data di tambahkan'
            ]
        ));

        return $response->withHeader("Content-Type", "application/json");
    }); 


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
            $query->bindParam(':Tahun_Produksi', $Tahun_Produksi, PDO::PARAM_DATE);
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

