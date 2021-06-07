<?php

require 'vendor/autoload.php';
require 'core/bootstrap.php';

$statement = <<<EOS

    INSERT INTO user
        (id, username, national_code)
    VALUES
        (1, 'User1', '001'),
        (2, 'User2', '002'),
        (3, 'User3', '003'),
        (4, 'User4', '004'),
        (5, 'User5', '005'),
        (6, 'User6', '006'),
        (7, 'User7', '007'),
        (8, 'User8', '008'),
        (9, 'User9', '009');
EOS;

try {
    \App\Core\App::get('database')->execute($statement);
    echo "Users Seeded Successfully!\n";
} catch (\PDOException $e) {
    exit($e->getMessage());
}