<?php

    namespace model;

    use model\Database;

    require("model/Database.php");

    class PostDAO
    {

        private $db;

        /**
         * PostDAO constructor.
         */
        public function __construct()
        {
            $this->db = new Database();
        }


        public function getPosts()
        {

            $req = $this->db->getDbConnection()->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');
            return $req;
        }

        public function getPost($postId)
        {
            $req = $this->db->getDbConnection()->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
            $req->execute(array($postId));
            $post = $req->fetch();
            return $post;
        }


    }
