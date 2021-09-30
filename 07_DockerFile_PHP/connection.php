<?php
    $host = (isset($_ENV["HOST"])) ? $_ENV["HOST"] : '192.168.68.106';
    $user = (isset($_ENV["USER"])) ? $_ENV["USER"] : 'root';
    $password = (isset($_ENV["PASSWORD"])) ? $_ENV["PASSWORD"] : 'senha';
    $database = (isset($_ENV["DATABASE"])) ? $_ENV["DATABASE"] : 'docker';
    $port = (isset($_ENV["PORT"])) ? $_ENV["PORT"] : '3306';
?>

