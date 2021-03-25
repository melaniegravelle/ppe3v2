<?php
namespace model;

use classes\dbConnect;

class Manager
{
    // private $_dsn           = 'mysql:host=localhost:3306;dbname=blog';
    // private $_login         = 'blog';
    // private $_password      = 'blog';

    private $_dsn           = 'mysql:host=localhost:3306;dbname=ppe3_groupe2';
    private $_login         = 'ppe3groupe2';
    private $_password      = 'l9PTjHdJpD6tQwB8';


    /**
     * Attribut contenant l'instance PDO
     */
    protected $manager;

    public function __construct()
    {
        $this->manager = dbConnect::getDb($this->_dsn, $this->_login, $this->_password);
    }
}