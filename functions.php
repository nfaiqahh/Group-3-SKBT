<?php

function insert($tableName, $attribute, $values) {
	//connect to localhost
	$link = mysqli_connect("localhost","root","");

	if(!$link) {
		die("Could not connect to database:".mysqli_connect_error());
	}
	else {
		//echo "Successfully connect to database <br>";
	}

	//select db to work with
	$db_selected = mysqli_select_db($link, "group11_db");

	if(!$db_selected) {
		$sql = "CREATE DATABASE group11_db";
		if(mysqli_query($link, $sql)) { //this is the part where we execute the sql
			//echo "Database created successfully <br>";
			$db_selected = mysqli_select_db($link, "group11_db");
		}
		else {
			echo "Error creating database <br>";
		}
	}
	else {
		//echo "Database group11_db selected <br>";
	}

	$sql = "INSERT INTO ".$tableName." (".$attribute.") VALUES (".$values.")";
	if(mysqli_query($link, $sql)) {
		//echo "Data entered successfully <br>";
	}
	else {
		echo "Error inserting data into table:".mysqli_error($link).".<br>";
	}

	mysqli_close($link);
}

function select($tableName, $attribute, $values, $resultAttribute) {
	//connect to localhost
	$link = mysqli_connect("localhost","root","");

	if(!$link) {
		die("Could not connect to database:".mysqli_connect_error());
	}
	else {
		//echo "Successfully connect to database <br>";
	}

	//select db to work with
	$db_selected = mysqli_select_db($link, "group11_db");

	if(!$db_selected) {
		$sql = "CREATE DATABASE group11_db";
		if(mysqli_query($link, $sql)) { //this is the part where we execute the sql
			//echo "Database created successfully <br>";
			$db_selected = mysqli_select_db($link, "group11_db");
		}
		else {
			echo "Error creating database <br>";
		}
	}
	else {
		//echo "Database group11_db selected <br>";
	}

	$sql = "SELECT * FROM ".$tableName." WHERE ".$attribute." = ".$values;
	if($result = mysqli_query($link, $sql)) {
		while($row = mysqli_fetch_assoc($result)) {
			return $row[$resultAttribute];
		}
	}
	else {
		echo "Error selecting data into table:".mysqli_error($link).".<br>";
	}

	mysqli_close($link);
}

class Pic {
 
    const DB_HOST = 'localhost';
    const DB_NAME = 'group11_db';
    const DB_USER = 'root';
    const DB_PASSWORD = '';
 
    /**
     * Open the database connection
     */
    public function __construct() {
        // open database connection
        $conStr = sprintf("mysql:host=%s;dbname=%s;charset=utf8", self::DB_HOST, self::DB_NAME);
 
        try {
            $this->pdo = new PDO($conStr, self::DB_USER, self::DB_PASSWORD);
            //for prior PHP 5.3.6
            //$conn->exec("set names utf8");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
 
    /**
     * close the database connection
     */
    public function __destruct() {
        // close the database connection
        $this->pdo = null;
    }
	
	public function insertPic($tableName, $attribute, $file, $values) {
        $blob = fopen($file, 'rb');
 
		$sql = "INSERT INTO ".$tableName." (".$attribute.") VALUES (".$values.",:pic)";
        $stmt = $this->pdo->prepare($sql);
 
        $stmt->bindParam(':pic', $blob, PDO::PARAM_LOB);
 
        return $stmt->execute();
    }
}
?>