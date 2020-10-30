<?php

function regUserOutcome($username, $password) {
    $db = week07Online();
     $sql = 'INSERT INTO week07_team_user (username, password) VALUES (:username, :password)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;       
}

function getUserOutcome($username) {
    $db = week07Online();
    $sql = 'SELECT username, password FROM week07_team_user WHERE username = :username';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $userData;
}