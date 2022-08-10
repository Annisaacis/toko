<?php
// query_select('table', 'all', $select = "id=7")
function query_select($table = false, $select = null) {

	global $conn;
	$result;
	
	
	if($select) {
		// where select
		$result = mysqli_query($conn, "SELECT * FROM " . $table . " WHERE " . $select);
	} else {
		// get all
		$result = mysqli_query($conn, "SELECT * FROM " . $table);
	}
	
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		// menjadikan variabel $rows[] array assosiatif
		$rows[] = $row;
	}

	//mengembalikan array assosiatif
	return $rows;
}

function query_insert($table, $data) {
	global $conn;
	
	$value = "";
	$i = 1;
	foreach($data as $val) {
		$value .= "'" . $val . "'";
		if($i != count($data)) {
			$value .= ", ";
		}
		$i++;
	}
	unset($i);
	
	mysqli_query($conn, "INSERT INTO $table VALUES($value)");
	return mysqli_affected_rows($conn);
}
