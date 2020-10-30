<?php

    function week07Online() {
        $dbUrl = getenv('DATABASE_URL');
        $dbOpts = parse_url($dbUrl);
        $dbHost = $dbOpts["host"];
        $dbPort = $dbOpts["port"];
        $dbUser = $dbOpts["user"];
        $dbPassword = $dbOpts["pass"];
        $dbName = ltrim($dbOpts["path"],'/');

        $dsn = "pgsql:host=$dbHost;port=$dbPort;dbname=$dbName";
        $dbOptions = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        try {
            $db = new PDO($dsn, $dbUser, $dbPassword, $dbOptions);
            return $db;
        } catch(PDOException $ex) {
            echo 'Error!: ' . $ex->getMessage();
            die();
        }
    }

    week07Online();
?>