<?php

    use controller\Controller;

    require "controller/controller.php";

    $controller = new Controller();

    $author = $_POST["author"] ?? null;
    $comment = $_POST["comment"] ?? null;
    $action = $_GET["action"] ?? null;


    switch ($action) {
        case "post":
            $controller->getPost($_GET['id']);
            break;
        case "addComment":
            if (isset($_POST['edit']))
                $controller->editComment($_POST['edit'], $author, $comment);
            $controller->addComment($_GET["id"], $author, $comment);
            break;
        case "edit":
            $controller->modifyComment($_GET['edit']);
            break;
        default:
            $controller->listPosts();
            break;
    }
