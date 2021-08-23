<?php

$statements = [
  'CREATE TABLE IF NOT EXISTS users( 
        user_id   INT AUTO_INCREMENT,
        first_name  VARCHAR(100) NOT NULL, 
        last_name   VARCHAR(100) NULL,
        mail VARCHAR(50) NULL UNIQUE,
        password VARCHAR(100) NOT NULL,
        PRIMARY KEY(user_id)
    );',
];
foreach ($statements as $statement) {
  Connection::getInstance()->pdo->exec($statement);
}
