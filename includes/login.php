<?php include "db.php";session_start();if (isset($_POST['login'])){    $username = $_POST['username'];    $user_password = $_POST['user_password'];    $username = mysqli_real_escape_string($connection, $username );    $user_password = mysqli_real_escape_string($connection, $user_password );    $query = "SELECT * FROM users WHERE username = '{$username}' ";    $select_user_query = mysqli_query($connection, $query);    if (!$select_user_query){        die("QUERY FAILED". mysqli_error($connection));    }    // GET USER ALL INFORMATION.    foreach ($select_user_query as $user_query){       $db_user_id = $user_query['user_id'];       $db_username = $user_query['username'];       $db_user_password = $user_query['user_password'];       $db_user_firstname = $user_query['user_firstname'];       $db_user_lastname = $user_query['user_lastname'];       $db_user_role = $user_query['user_role'];    }    // LOGIN CONDITIONS    if ($username === $db_username  && $user_password === $db_user_password){        $_SESSION['user_id'] = $db_user_id;        $_SESSION['username'] = $db_username;        $_SESSION['user_firstname'] = $db_user_firstname;        $_SESSION['user_lastname'] = $db_user_lastname;        $_SESSION['user_role'] = $db_user_role;        header("Location: ../admin");    }else{        header("Location: ../index.php");    }}