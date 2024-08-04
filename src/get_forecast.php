<?php
require 'WeatherController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $city = $_POST['city'];
    $date = $_POST['date'];

    $formProcessor = new WeatherController($city, $date);
    $formProcessor->process();
}