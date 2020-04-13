<?php
session_start();

unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['user_role']);
unset($_SESSION['email']);
header('location:login.php');