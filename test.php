<?php
    $servername = "localhost";
    $username = "root";
    $password = "ubuntu";
    $dbname = "event";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO users (firstname, lastname, username, password, avatar, type)
        VALUES ('John', 'Doe', 'john@example.com', 'John', 'Doe', 2)";

        // use exec() because no results are returned
        $conn->exec($sql);
        echo "New record created successfully";
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;
?>