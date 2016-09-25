<?php
    $weather = "";
    $error = "";
    if(array_key_exists('city', $_GET)) {
        $city = str_replace(' ', '', $_GET['city']);
        $file_headers = @get_headers("http://www.weather-forecast.com/locations/".$city."/forecasts/latest");
        if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
            $error = "That city could not be found.";
        } else {
            $forecastPage = file_get_contents("http://www.weather-forecast.com/locations/".$city."/forecasts/latest");
            $pageArray = explode('3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">', $forecastPage);
            if(sizeof ($pageArray) > 1) {
                $secondPageArray = explode('</span></span></span>', $pageArray[1]);
                if(sizeof($secondPageArray) > 1) {
                    $weather = $secondPageArray[0];
                } else {
                    $error = "That city could not be found.";
                }
            } else {
                $error = "That city could not be found.";
            }

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Weather Scraper</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
    <style type="text/css">
        html {
            background: url(background.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        body {
            background: none;
        }
        .container {
            text-align: center;
            margin-top: 100px;
            width: 450px;
        }
        input {
            margin: 20px 0;
        }
        #weather {
            margin-top: 15px;
        }
    </style>
  </head>
  <body>
    <div class="container">
        <h1>What's The Weather?</h1>
        <form>
          <fieldset class="form-group">
            <label for="city">Enter the name of a city.</label>
            <input type="text" class="form-control" name="city" id="city" aria-describedby="emailHelp" placeholder="Eg. London, Tokyo" value="<?php
                if(array_key_exists('city', $_GET)) {
                    echo $_GET['city'];
                }
             ?>">
          </fieldset>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div id="weather">
            <?php
                if($weather) {
                    echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
                } else  if($error) {
                    echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                }
            ?>
        </div>
    </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script>
  </body>
</html>