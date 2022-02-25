<?php

try {
    $server = 'localhost';
    $db = 'exo_203';
    $user = 'root';
    $pswd = '';

    $bdd = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pswd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stm = $bdd->prepare("
        SELECT e.prenom, e.nom, e.login, e.password, info.rue, info.cp, info.ville, info.pays
        FROM eleve as e
        INNER JOIN eleve_information as info ON e.information_id = info.id
");


    if($stm->execute()) {
        foreach ($stm->fetchAll() as $item) {
            echo "<pre>" . print_r($item) . "</pre>";
        }
    }

    $stm = $bdd->prepare("
        SELECT comp.niveau, competence.titre, competence.description, e.nom, e.nom, e.login, e.password
        FROM eleve_competence as comp
        INNER JOIN eleve as e ON comp.eleve_id = e.id
        INNER JOIN competence ON comp.competence_id = competence.id
");
    if($stm->execute()) {
        foreach ($stm->fetchAll() as $item) {
            echo "<pre>" . print_r($item) . "</pre>";
        }
    }

}
catch (PDOException $e) {
    echo $e->getMessage();
}
