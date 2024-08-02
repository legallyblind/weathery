<?php
require_once 'vendor/autoload.php';

use Dotenv\Dotenv;
class Weather
{
    private $apiKey;
    private $apiUrl;

    public function __construct()
    {
        // Load environment variables
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        $this->apiKey = $_ENV['OPENWEATHER_API_KEY'];
        $this->apiUrl = 'https://api.openweathermap.org/data/3.0/onecall';
    }

}
?>
