<?php
    $error = "";
    $successMessage = "";
    if($_POST) {
        if(!$_POST["email"]) {
            $error .= "An email address is required.<br>";
        }
        if(!$_POST["content"]) {
            $error .= "The content field is required.<br>";
        }
        if(!$_POST["subject"]) {
            $error .= "The subject field is required.<br>";
        }
        if($_POST['email'] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) {
            $error .= "The email address is invalid.<br>";
        }
        if($error != "") {
            $error ='<div class="alert alert-danger" role="alert"><p>There were error(s) in your form:</p>' . $error . '</div>';
        } else {
            $emailTo = "abdullah.alam.omi@gmail.com";
            $subject = $_POST['subject'];
            $content = $_POST['content'];
            $headers = "From: ".$_POST['email'];
            if(mail($emailTo, $subject, $content, $headers)) {
                $successMessage = '<div class="alert alert-success" role="alert">Your message was sent, we\'ll get back to you ASAP!</div>';
            } else {
                $error ='<div class="alert alert-danger" role="alert"><p><strong>Your message couldn\'t be sent - please try again later</strong></p>' . $error . '</div>';
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <h1>Get in touch!</h1>
        <div id="error"><? echo $error.$successMessage; ?></div>
        <form method="post">
          <fieldset class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address">
            <small class="text-muted">We'll never share your email with anyone else.</small>
          </fieldset>
          <fieldset class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject">
          </fieldset>

          <fieldset class="form-group">
            <label for="content">What would you like to ask us?</label>
            <textarea class="form-control" id="content" name="content" rows="3"></textarea>
          </fieldset>
          <button type="submit" id="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $("form").submit(function(e) {
            var error = "";
            if($("#email").val() == "") {
                error += "The email field is required.<br>";
            }
            if($("#subject").val() == "") {
                error += "The subject field is required.<br>";
            }
            if($("#content").val() == "") {
                error += "The content field is required.<br>";
            }
            if(error != "") {
                $("#error").html('<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in your form:</strong></p>' + error + '</div>');
                return false;
            } else {
                return true;
            }

        })
    </script>
  </body>
</html>