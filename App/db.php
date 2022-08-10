<?php
// connect to db
require "config.php";

function connect_DB() {
	$conn = mysqli_connect(DB_HOSTNAME, DB_USER, DB_PSWD, DB_NAME);
	return $conn;
}

