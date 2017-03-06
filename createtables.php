<?php
	/* sql to create table */
	/* sql to create table */
	$sql = "CREATE TABLE IF NOT EXISTS school (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	name VARCHAR(40) NOT NULL UNIQUE,
	reg_date TIMESTAMP
	)";
	
	
	if (!$conn->query($sql) === TRUE) {
		echo "Error creating table: " . $conn->error . "<br />";
	}
	
	$sql = "CREATE TABLE IF NOT EXISTS member (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	firstname VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL,
	email VARCHAR(50),
	reg_date TIMESTAMP
	)";
	
	
	if (!$conn->query($sql) === TRUE) {
		echo "Error creating table: " . $conn->error . "<br />";
	}

	
	$sql = "CREATE TABLE IF NOT EXISTS schoolmember (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	member_id INT(6) UNSIGNED NOT NULL,
	school_id INT(6) unsigned NOT NULL,
	FOREIGN KEY(member_id) REFERENCES member(id),
	FOREIGN KEY(school_id) REFERENCES school(id)	
	)";
	
	
	if (!$conn->query($sql) === TRUE) {
		echo "Error creating table: " . $conn->error . "<br />";
	}

?>