<?php
require_once '../vendor/autoload.php';

use Dotenv\Dotenv;
class Weather
{
    private $apiKey;
    private $apiUrl;

    public function __construct()
    {
        // Load environment variables from project root
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();

        $this->apiKey = $_ENV['OPENWEATHER_API_KEY'];
        $this->apiUrl = 'https://api.openweathermap.org/data/2.5/forecast';
    }

    /**
     * Send request to Weather API and return the requested date.
     *
     * @param $city
     * @param $date
     * @return mixed|null
     */
    public function getWeather($city, $date): mixed
    {
        $timestamp = strtotime($date);
        $currentDate = date('Y-m-d', $timestamp);

        $url = "{$this->apiUrl}?q={$city}&appid={$this->apiKey}&units=metric";

        try {
            $response = file_get_contents($url);
        }
        catch (Exception $_) {
            return null;
        }
        if ($response === false) {
            return null;
        }

        $data = json_decode($response, true);
        if (isset($data['list'])) {
            foreach ($data['list'] as $forecast) {
                if (str_contains($forecast['dt_txt'], $currentDate)) {
                    return $forecast;
                }
            }
        }

        return null;
    }
}
