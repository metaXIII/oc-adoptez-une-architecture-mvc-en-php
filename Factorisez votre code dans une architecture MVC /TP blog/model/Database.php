<?php

    namespace model;

    use PDO;

    class Database
    {
        /**
         * @return PDO
         */
        public function getDbConnection(): PDO
        {
            try {
                $db = new PDO("mysql:host=localhost;dbname=oc_concevez_votre_site_web_avec_php_et_mysql;charset=utf8",
                    "root", "root");
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
            return $db;
        }
    }
