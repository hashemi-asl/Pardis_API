<?php
require 'vendor/autoload.php';
require 'core/bootstrap.php';

$statement = <<<EOS
    CREATE TABLE user (
        id INT NOT NULL AUTO_INCREMENT,
        username VARCHAR(100) NOT NULL,
        national_code VARCHAR(100) NOT NULL,
        
        PRIMARY KEY (id)
    ) ENGINE=INNODB;

    CREATE TABLE book (
        id INT NOT NULL AUTO_INCREMENT,
        user_id INT NOT NULL,
        name VARCHAR(100) NOT NULL,
        description VARCHAR(255) NOT NULL,
        image varchar(255) DEFAULT NULL,
        
        PRIMARY KEY (id),
        FOREIGN KEY (user_id)
        REFERENCES  user(id)
        ON DELETE CASCADE
    ) ENGINE=INNODB;

EOS;

try {
    \App\Core\App::get('database')->execute($statement);
    echo "Tables Created Successfully!\n";
} catch (\PDOException $e) {
    exit($e->getMessage());
}