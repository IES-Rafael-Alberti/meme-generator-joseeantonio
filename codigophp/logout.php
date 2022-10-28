<?php
require("testlogin.php");

unset($_SESSION["usuario"]);
session_destroy();
session_write_close();
header("Location: login.php");