<?php

namespace App\Controllers;

use App\Core\App;

class UsersController
{
    /**
     * Show all users.
     */
    public function index()
    {
        $users = App::get('database')->selectAll('user');

        echo(json_encode($users));
    }

    /**
     * Show requested user.
     */
    public function show()
    {
        $user = App::get('database')->find('user', $_GET['id']);

        echo(json_encode($user));
    }

    /**
     * Store a new user in the database.
     */
    public function store()
    {
        App::get('database')->insert('user', [
            'username' => $_POST['username'],
            'national_code' => $_POST['national_code'],
        ]);

        header('HTTP/1.1 201 User Created Successfully');

    }
}
