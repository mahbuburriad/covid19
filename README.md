<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License">
</p>

## About Covid19 Project
covid19 corona virus score application is a web application framework with expressive, elegant syntax and build with laravel 8. This is open source project under MIT License. That means its free and you can contribute to this open source project.

## Working Method:
This application using various type of API. and Web Scraper to really work this application perfectly. Have lots of information.
Interface is currently inspired from Worldometer.

## API & URL Providers (Thanks from Me to provide open source API for all of us)
**Live Data Source:**  [Worldometers](https://www.worldometers.info/coronavirus/)  
**Data by date John Hopkins University & Pomber from github:**  [John Hopkins - Pomber](https://github.com/pomber/covid19)  
**Bangladesh District Wise Data source:**  [dghs.gov.bd](https://dashboard.dghs.gov.bd/webportal/pages/covid19.php)  
**Vaccine Tracker Data Source:**  [The New Work Times](https://www.nytimes.com/interactive/2020/science/coronavirus-vaccine-tracker.html)  
**Get vaccine trial data from RAPS (Regulatory Affairs Professional Society). Specifically published by Jeff Craven:** [RAPS](https://www.raps.org/news-and-articles/news-articles/2020/3/covid-19-vaccine-tracker)  
**Get therapeutics trial data from RAPS (Regulatory Affairs Professional Society). Specifically published by Jeff Craven:** [RAPS](https://www.raps.org/news-and-articles/news-articles/2020/3/covid-19-therapeutics-tracker)  
**USA Data Source:** [Worldometer](https://www.worldometers.info/coronavirus/country/us/)  
**India Data Source:** [Get COVID-19 government reported data for a specific country](https://www.mohfw.gov.in/)  
**API for covid19:** [Corona Ninja](https://corona.lmao.ninja/)

Project Framework
- Laravel 8

## Server Requirements

This Covid19 project has a few system requirements. You should ensure that your web server has the following minimum PHP version and extensions:
-   PHP >= 7.3
-   BCMath PHP Extension
-   Ctype PHP Extension
-   Fileinfo PHP Extension
-   JSON PHP Extension
-   Mbstring PHP Extension
-   OpenSSL PHP Extension
-   PDO PHP Extension
-   Tokenizer PHP Extension
-   XML PHP Extension
- fopen_url_allow = true
- composer

## How to install
**clone this project**
```
https://github.com/mahbuburriad/covid19.git
```
**Go to directory**
> app/providers/AppServiceProvider.php

**Comment this code with `/* */` under boot() function**
```
/*
$basic_settings = Settings::all();  
unset($settings);  
$settings = array();  
foreach ($basic_settings as $bSet) {  
  $settings[$bSet['settings_key']] = $bSet['settings_value'];  
}  
View::share('settings', $settings);
*/
```
**Open Terminal and install the composer**
```
composer install
```
**make an .env file**
```
cp .env.example .env
```
**Open .env file and modify the database name, username and password**
```
DB_CONNECTION=mysql  
DB_HOST=localhost  
DB_PORT=3306  
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
**generate Key**
```
php artisan key:generate
```
**Storage Link**
```
php artisan storage:link
```
**dump autoload the composer**
```
composer dump-autoload
```
**Database Migration**
```
php artisan migrate --seed
```

### Now Uncomment the previous commented file and function
**Go to directory**
> app/providers/AppServiceProvider.php

**uncomment this code under `boot()` function**
```
$basic_settings = Settings::all();  
unset($settings);  
$settings = array();  
foreach ($basic_settings as $bSet) {  
  $settings[$bSet['settings_key']] = $bSet['settings_value'];  
}  
View::share('settings', $settings);
```
**Now serve this project**
```
php artisan serve
```

**Now Grab all live data by run this url**
- http://localhost:8000/dataGet/live
- http://localhost:8000/dataGet/continent
- http://localhost:8000/dataGet/therapeutics
- http://localhost:8000/dataGet/vaccine
- http://localhost:8000/dataGet/yesterday
- http://localhost:8000/dataInsert
- http://localhost:8000/stateInsert
- http://localhost:8000/vaccineInsert
- http://localhost:8000/dataGet/indiaData
- http://localhost:8000/dataGet/usaData
- http://localhost:8000/sitemap

**Now Check that all data implemented**
> http://localhost:8000/check

## Recommendation
- You need always update data so best way is use cron job for automatically scrap data time to time.

## Contact Information
For any type of problem comment here or knock me on mail
- **Mail:** mahbubur.riad@gmail.com
- **website:** https://mahbuburriad.com
- **covid19 website:** https://covid19.mahbuburriad.com


## Contributing

Thank you for considering contributing to the Covid19 Project. You can contribute this project whatever need and update.

## Code of Conduct

In order to ensure that the covid19 project member is welcoming to all

## Security Vulnerabilities

If you discover a security vulnerability within covid19 project, please send an e-mail to Mahbubur Riad via [mahbubur.riad@gmail.com](mailto:mahbubur.riad@gmail.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
