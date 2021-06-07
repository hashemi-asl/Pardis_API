<?php

header("Content-Type: application/json; charset=UTF-8");

use \App\Core\App;
use \App\Core\Database\{QueryBuilder, Connection};

App::bind('config', require 'config.php');

App::bind('database', new QueryBuilder(
    Connection::make(App::get('config')['database'])
));
