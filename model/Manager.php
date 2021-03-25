<?php
namespace model;

use classes\dbConnect;

class Manager
{
    private $_dsn           = 'mysql:host=localhost:3306;dbname=blog';
    private $_login         = 'blog';
    private $_password      = 'blog';


    /**
     * Attribut contenant l'instance PDO
     */
    protected $manager;

    public function __construct()
    {
        $this->manager = dbConnect::getDb($this->_dsn, $this->_login, $this->_password);
    }
}