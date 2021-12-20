<?php
//    var_dump(file_get_contents("php://input"));
 



header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
$result = array();

if ($method == 'PUT') {
     
    
    parse_str(file_get_contents("php://input"), $_PUT);    
    if (isset($_PUT['nim']) and isset($_PUT['nama']) and isset($_PUT['alamat']) and isset($_PUT['id_mhs'])) {
       
        $nim = $_PUT['nim'];
        $nama = $_PUT['nama'];
        $alamat = $_PUT['alamat'];
        $id_mhs = $_PUT['id_mhs'];
        $result['status'] = [
            "code" => 200,
            "descriptions" => "1 data update"
        ];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "kemahasiswaan";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "UPDATE  mahasiswa SET nim ='$nim' , nama ='$nama' , alamat ='$alamat' WHERE id_mhs = '$id_mhs'";
        $conn->query($sql);
        $result['result'] = [
         "nim" => $nim,
         "nama" => $nama,
         "alamat" => $alamat,
         
        ];
    } else {
        $result['status'] = [
            "code" => 400,
            "descriptions" => "Parameter invalid"
        ];
    }
} else {

    $result['status'] = [
        "code" => 400,
        "descriptions" => "Method is not valid"
    ];
}

echo json_encode($result);
