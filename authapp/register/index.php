<?php

require '../authapp.php';

@$nik = $_POST['nik'];
@$role = $_POST['role'];
echo AuthApp::register($nik, $role);

?>