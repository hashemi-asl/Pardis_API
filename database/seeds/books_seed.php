<?php

require 'vendor/autoload.php';
require 'core/bootstrap.php';

$statement = <<<EOS

    INSERT INTO book
        (id, user_id, name, description)
    VALUES
        (1, 1, 'Book1', 'Description of Book1'),
        (2, 2, 'Book2', 'Description of Book2'),
        (3, 3, 'Book3', 'Description of Book3'),
        (4, 4, 'Book4', 'Description of Book4'),
        (5, 5, 'Book5', 'Description of Book5'),
        (6, 6, 'Book6', 'Description of Book6'),
        (7, 7, 'Book7', 'Description of Book7'),
        (8, 8, 'Book8', 'Description of Book8'),
        (9, 9, 'Book9', 'Description of Book9');

EOS;

try {
    \App\Core\App::get('database')->execute($statement);
    echo "Books Seeded Successfully!\n";
} catch (\PDOException $e) {
    exit($e->getMessage());
}