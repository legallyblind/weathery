<?php
require 'Weather.php';

class WeatherController {
    private $city;
    private $date;
    private $weatherApp;

    public function __construct($city, $date)
    {
        $this->city = $city;
        $this->date = $date;
        $this->weatherApp = new Weather();
    }

    /**
     * Send request to Weather API and process the result.
     *
     * @return void
     */
    public function process(): void
    {
        if ($this->validateInput()) {
            $weatherData = $this->weatherApp->getWeather($this->city, $this->date);
            if(!$weatherData) {
                echo "<p>Weather data not found for the given city and date.</p>";
                return;
            }
            $this->processResult($weatherData);
        } else {
            echo "<p>Invalid input. Please try again.</p>";
        }
    }

    /**
     * Validate POST request input.
     *
     * @return bool
     */
    private function validateInput(): bool
    {
        if (!is_string($this->city) || empty($this->city)) {
            return false;
        }

        $dateFormat = 'Y-m-d';
        $d = DateTime::createFromFormat($dateFormat, $this->date);

        //check if date is not more than 5 days in the future, or in the past
        $now = new DateTime();
        $now->modify('+5 days');
        if ($d === false || $d > $now || $d < new DateTime()) {
            return false;
        }

        return $d && $d->format($dateFormat) === $this->date;
    }


    /**
     * Process parsed data into XLXS file.
     *
     * @credit <https://stackoverflow.com/a/10424955>
     * @param $weatherData
     * @return void
     */
    private function processResult($weatherData): void
    {
        $data = [
            ["City", $this->city],
            ["Date", $this->date],
            ["Temperature", $weatherData['main']['temp'] . " °C"],
            ["Description", "On " . $this->date . " you will experience " . $weatherData['weather'][0]['description']],
        ];
        // Excel file name for download
        $fileName = "pocasie-" . $this->date . ".xls";
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Type: application/vnd.ms-excel;");
        header("Pragma: no-cache");
        header("Expires: 0");
        $out = fopen("php://output", 'w');
        foreach ($data as $item)
        {
            fputcsv($out, $item,"\t");
        }
        fclose($out);
    }
}