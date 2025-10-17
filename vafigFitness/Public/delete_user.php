<?php
session_start();
require_once '../Classes/User.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);

    $user = new User();

    if ($id == $_SESSION['user_id']) {
        header("Location: dashboard.php?error=self_delete");
        exit();
    }

    if($_SESSION['rol'] !== 'admin'){
        header("Location: dashboard.php?error=not_authorized");
        exit();
    }else{
        if ($user->deleteUser($id)) {
            header("Location: dashboard.php?success=deleted");
            exit();
        } else {
            header("Location: dashboard.php?error=delete_failed");
            exit();
        }
    }
} else {
    header("Location: dashboard.php?error=invalid_id");
    exit();
}
