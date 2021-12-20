<?php
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
$result = array();

if ($method == 'POST') {

    if (isset($_POST['nim']) and isset($_POST['nama']) and isset($_POST['alamat']) ) {
        
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];

        $foto_tmp = $_FILES['foto']['tmp_name'];
        $nama_foto = $_FILES['foto']['name'];

         move_uploaded_file($foto_tmp, 'foto/'.$nama_foto);

        $result['status'] = [
            "code" => 200,
            "descriptions" => "1 data inserted"
        ];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "kemahasiswaan";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "INSERT INTO  mahasiswa (nim,nama,alamat , foto) VALUES ('$nim','$nama','$alamat','$nama_foto')";
        $conn->query($sql);
        $result['result'] = [
         "nim" => $nim,
         "nama" => $nama,
         "alamat" => $alamat,
        ];
    } else {
        $result['status'] = [
            "code" => 400,
            "descriptions" => "test"
        ];
    }
} else {

    $result['status'] = [
        "code" => 400,
        "descriptions" => "Method is not valid"
    ];
}

echo json_encode($result);
