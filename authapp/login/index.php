<?php

require '../authapp.php';

@$nik = $_POST['nik'];
@$password = $_POST['password'];
echo AuthApp::login($nik, $password);

?>
