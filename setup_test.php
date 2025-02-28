<?php $host="mysql"; $port="3306"; $login="admin"; $pass="iris"; $dbase="aci-EMR"; try { $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbase", $login, $pass); $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); echo "Connected successfully to database
"; $sql = "CREATE TABLE IF NOT EXISTS users (id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)"; $conn->exec($sql); echo "Test table created successfully
"; } catch(PDOException $e) { echo "Connection failed: " . $e->getMessage() . "
"; } ?>
