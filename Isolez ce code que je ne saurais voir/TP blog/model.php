<?php
    function getPosts()
    {
        try {
            $bdd = new PDO("mysql:host=localhost;dbname=oc_concevez_votre_site_web_avec_php_et_mysql;charset=utf8",
                "root", "root");
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        return $bdd->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');
    }
