<?php

    namespace controller;

    use model\CommentDAO;
    use model\PostDAO;

    require("model/PostDAO.php");
    require("model/CommentDAO.php");


    class Controller
    {

        private $postDAO;
        private $commentDAO;

        /**
         * Controller constructor.
         */
        public function __construct()
        {
            $this->postDAO = new PostDAO();
            $this->commentDAO = new CommentDAO();
        }

        public function listPosts()
        {
            $posts = $this->postDAO->getPosts();
            require('view/listPostsView.php');
        }

        public function getPost($id)
        {
            $this->getPostFromIdController($id);
            $post = $this->postDAO->getPost($id);
            $comments = $this->commentDAO->getComments($id);
            require('view/postView.php');
        }

        public function addComment($postId, $author, $comment)
        {
            $affectedLines = $this->commentDAO->addComment($postId, $author, $comment);

            if ($affectedLines === false) {
                die('Impossible d\'ajouter le commentaire !');
            } else {
                header('Location: index.php?action=post&id=' . $postId);
            }
        }


        public function modifyComment($edit)
        {
            $valueEdit = $this->commentDAO->modifyComment($edit);
            $this->getPostFromIdController($valueEdit['post_id']);
            $post = $this->postDAO->getPost($valueEdit['post_id']);
            $comments = $this->commentDAO->getComments($valueEdit['post_id']);
            require('view/postView.php');
            die();
        }

        /**
         * @param $id
         */
        public function getPostFromIdController($id)
        {
            if ((int)$id === 0) {
                header("location:index.php");
                die("Une erreur est survenue avec l'id du post");
            }
        }

        public function editComment($edit, $author, $comment)
        {
            $this->commentDAO->saveComment($edit, $author, $comment);
        }

    }

