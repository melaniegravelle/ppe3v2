<?php
namespace controller;

use model\Resultats;
use model\ResultatsManager;
// use classes\sodiumSecure;

class ResultatsController extends Controller
{
    public function __construct()
    {
        $this->resultatsManagers = new ResultatsManager();

        // $this->sodiumSecure = new SodiumSecure();
        // parent::__construct();
    }

    public function defaultAction()
    {

    }
}