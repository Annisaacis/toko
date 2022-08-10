<?php
session_start();

function not_login($redirect = "login.php") {
	if( !isset($_SESSION["login"]) ) {
		header("Location: " . $redirect);
	}	
}

function login($redirect = "index.php") {
	if($_SESSION["login"] == true) {
		header("Location: " . $redirect);
	}
}

function add_user($data) {
	global $conn;

	$username = strtolower(stripslashes($data["username"])); // fungsi stripslashes supaya tidak ada backslash
	$password = mysqli_real_escape_string($conn, $data["password"]); // fungsi supaya data base dapat menyimpan ; dan dll untuk password
	$conf_pass = mysqli_real_escape_string($conn, $data["password2"]);

	require "query.php";
	// cek username sudah atau belum
	$result = query_select("user", "username = '$username'");
	if($result) {
		echo "<script>
				alert('username yang dipilih sudah terdaftar!');
			</script>";
			return false;
	}

	// cek konfirmasi password
	if( $password !== $conf_pass ) {
		echo "<script>
			alert('Konfirmasi password tidak sesuai');
			</script>
		";
		return false;
	}

	// enkripsi password
	// Password_default merupakan enkripsi menggunakan algoritma defaultnya
	$password = password_hash($password, PASSWORD_DEFAULT);
	
	$data = ["", $username, $password];
		
	// tambahkan user baru ke data base
	query_insert("user", $data);
	return mysqli_affected_rows($conn);
}
 
 
function verify_login($data) {
	if( password_verify($data["user_pswd"], $data["db_pswd"]) ) {
		$_SESSION["login"] = true;
		header("Location: " . $data["redirect"]);
		exit;
	}
}