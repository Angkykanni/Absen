<?php
session_start();

session_unset();
session_destroy();

header("Location: /absen/login.php");
