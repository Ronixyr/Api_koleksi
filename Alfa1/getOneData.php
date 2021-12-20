<?php
  header('Content-Type: application/json');
  $method = $_SERVER['REQUEST_METHOD'];
  $result = array();

  if($method == 'GET'){
      
      if(isset($_GET['nim'])){
      $nim = $_GET['nim'];
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "kemahasiswaan";

// Create connection
     $conn = new mysqli($servername, $username, $password, $dbname);
     $sql = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
     $Hasil = $conn->query($sql);     
     $result['result'] = $Hasil->fetch_all(MYSQLI_ASSOC);


      }else{
      $result['status'] = [
       "code" => 400,
       "descriptions" => "Parameter invalid"];

      }
      
  }else {
     
      $result['status'] = [
       "code" => 400,
       "descriptions" => "request Not valid"];

  }

echo json_encode($result);
