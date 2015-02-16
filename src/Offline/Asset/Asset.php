<?php namespace Offline\Asset;

use Illuminate\Database\DatabaseManager;

/**
 * Class Asset
 * @package Offline\Asset
 */
class Asset
{

    /**
     * Registry config
     *
     * @var array
     */
    protected $assets;


    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->assets = [];
    }

    public function __call($method, $args) {
        dd($method);
    }


}
