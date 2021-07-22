<?php

    namespace model;

    use PDOStatement;

    class CommentDAO
    {
        private $db;

        /**
         * PostDAO constructor.
         */
        public function __construct()
        {
            $this->db = new Database();
        }


        /**
         * @param $postId
         * @return false| PDOStatement
         */
        public function getComments($postId)
        {
            $comments = $this->db->getDbConnection()->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
            $comments->execute(array($postId));
            return $comments;
        }

        /**
         * @param $id
         * @param $author
         * @param $comment
         * @return bool
         */
        public function addComment($id, $author, $comment): bool
        {
            try {
                $update = $this->db->getDbConnection()->prepare("insert into comments (post_id, author, comment, comment_date) values (:id, :author, :comment, NOW())");
                $update->execute(["id" => $id, "author" => $author, "comment" => $comment]);
            } catch (\Exception $exception) {
                return false;
            }
            return true;
        }

        public function modifyComment($edit)
        {
            try {
                return $this->db->getDbConnection()->query("select * from comments where id = $edit")->fetch();
            } catch (\Exception $exception) {
                die($exception->getMessage());
            }
        }

        public function saveComment($edit, $author, $comment)
        {
            try {
                $this->db->getDbConnection()->prepare("update comments set author = :author, comment = :comment where id = :id")
                    ->execute(["author" => $author, "comment" => $comment, "id" => $edit]);
            } catch (\Exception $exception) {
                die($exception->getMessage());
            }
        }

    }
