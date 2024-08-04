
# WeatherY

A simple, lightweight, and fast weather app that provides weather forecasting right in your browser.

## Getting started

Clone & enter repository

```bash
  git clone https://github.com/legallyblind/weathery
  cd weathery
```

Install local dependencies
```bash
  composer install
  npm install
```

## Run Locally

**Configure the `.env` file with OpenWeather API key based on the `.env.example` file.**


Serve the app, which will be accessible on `http://localhost:8080`
```bash
  composer run-script serve
```

Serving the app requires running the PHP built-in server, and a live tailwind transpiling script. 
```bash
  composer run-script serve
  npm run watch
```


## Tech Stack

**Frontend:** HTML, JS, TailwindCSS

**Backend:** PHP