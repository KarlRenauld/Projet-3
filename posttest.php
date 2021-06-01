<?php
include_once('config.php');
        $req = $connection-> prepare("INSERT INTO posts (bank_id, comment, user_id) VALUES (?, ?, ?)");
        $data = $req->execute([$_COOKIE['acteur_id'], $_POST['comment'], $_POST['author']]);
        //header('Location: acteur.php?acteur='. $_COOKIE['acteur_id'] .'');
        var_dump([$_COOKIE['acteur_id']]);
        var_dump([$_POST['comment']]);
        var_dump([$_POST['author']]);