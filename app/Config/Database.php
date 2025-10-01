<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations
     * and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to
     * use if no other is specified.
     */
    public string $defaultGroup = 'default_localhost';


    /**
     * The default database connection.
     */
    // Banco de dados
    public array $default_localhost = [
        'DSN'      => '',

        'hostname' => 'localhost',
        'username' => 'u482227589_wagner',
        //'username' => 'u482227589_danca',
        'password' => '212646@Wagner',
        'database' => 'u482227589_codebx',
        //'database' => 'u482227589_danca',
		'port'     => 3306,

        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
    ];

    /**
     * The default database connection producao.
     */
    public array $default_producao = [
        'DSN'      => '',

		'hostname' => 'localhost',
		'username' => 'miste079_usrtmp',
		'password' => 'us3rT3p7102',
		'database' => 'miste079_jafeston',
		'port'     => 3306,

        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
    ];


    /**
     * This database connection is used when
     * running PHPUnit database tests.
     */
    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => 'utf8_general_ci',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
    ];

    public function __construct()
    {
        parent::__construct();

        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        //if (ENVIRONMENT === 'testing') {
        //    $this->defaultGroup = 'tests';
        //}

        $_SERVER['SERVER_NAME'] = 'localhost';

		$_CONST_SERVER_NAME = $_SERVER['SERVER_NAME'];
		if( $_CONST_SERVER_NAME == "localhost" ){
			$this->defaultGroup = 'default_localhost';
		}else{
			$this->defaultGroup = 'default_producao';
		}

    }
}
