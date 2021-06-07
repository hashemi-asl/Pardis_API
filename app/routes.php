<?php

// Base Home Route ...
$router->get('', 'HomeController@home');

// Users-related routes list ...
$router->get('users', 'UsersController@index');
$router->get('users/show', 'UsersController@show');
$router->post('users', 'UsersController@store');

// Books-related routes list ...
$router->get('books', 'BooksController@index');
$router->get('books/show', 'BooksController@show');
$router->post('books', 'BooksController@store');

$router->get('download', 'BooksController@downloadImage');