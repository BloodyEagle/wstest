<?php
declare(strict_types = 1);

namespace wsTest;

use Pixie\Connection;
use Pixie\QueryBuilder\QueryBuilderHandler;

const config = array( //конфиг БД
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'dev',
            'username'  => 'dev',
            'password'  => 'Gfhjkz!',
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix'    => 'uts_'
        );

new \Pixie\Connection('mysql', config, 'QB');