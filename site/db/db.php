<?php 
    $servername = "my-sql";
    $username = 'cd2';
    $password = 'nhat';
    $db = 'idor';

    // Tao ket noi MySQL
    $conn = new mysqli($servername,$username,$password,$db);
    if ($conn -> connect_error){
        die('Connection Failed : ' .$conn -> connect_error);
    }



?>