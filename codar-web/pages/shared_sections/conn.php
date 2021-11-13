<?php
    $conn = new SQLite3('../databases/users.sqlite') or die("Unable to open database!");

    # User table
    $query = "CREATE TABLE IF NOT EXISTS `users`(user_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username TEXT, password TEXT, name TEXT)";

    # Challenges table

    # Achievements table

    $conn->exec($query);

    $query=$conn->query("SELECT COUNT(*) as count FROM `users`");

    $row=$query->fetchArray();

    $countRow=$row['count'];

    if($countRow == 0){
        $conn->exec("INSERT INTO `users` (username, password, name) VALUES('admin', 'admin', 'Administrator')");
    }



?>
