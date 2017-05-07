<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login to Glocal thinkers audit </title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo HTTP_CSS_PATH; ?>signin.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->
      <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
      <script>
    function chBr() { 
    if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ) 
    {
        return false;
    }
    else if(navigator.userAgent.indexOf("Chrome") != -1 )
    {
        return true;
    }
    else if(navigator.userAgent.indexOf("Safari") != -1)
    {
        return false;
    }
    else if(navigator.userAgent.indexOf("Firefox") != -1 ) 
    {
         return true;
    }
    else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) //IF IE > 10
    {
      return false;
    }  
    else 
    {
       return false;
    }
    }

      </script>
    <script>
            $(function() {
                  if(!chBr()){
                      $('#chbrF').css('display', 'block');
                  }
                if (localStorage.chkbx && localStorage.chkbx != '') {
                    $('#remember_me').attr('checked', 'checked');
                    $('#username').val(localStorage.usrname);
                    $('#pass').val(localStorage.pass);
                } else {
                    $('#remember_me').removeAttr('checked');
                    $('#username').val('');
                    $('#pass').val('');
                }

                $('#remember_me').click(function() {

                    if ($('#remember_me').is(':checked')) {
                        // save username and password
                        localStorage.usrname = $('#username').val();
                        localStorage.pass = $('#pass').val();
                        localStorage.chkbx = $('#remember_me').val();
                    } else {
                        localStorage.usrname = '';
                        localStorage.pass = '';
                        localStorage.chkbx = '';
                    }
                });
            });

        </script>
        
  </head>

  <body>

    <div class="container">
        <?php
        if(isset($error) && $error !='')
        {
            ?>
        <div class="alert alert-danger">
        <?php echo $error; ?>
      </div>
        <?php
        }
        ?>
        <div id="chbrF" class="alert alert-danger" style="display: none;">
          Unsupported browser! Please Open this site in Chrome or Firefox. <a class="btn btn-sm btn-success" href="https://www.google.com/chrome/">Install Chrome</a>
        </div>
        <form class="form-signin panel" method="post" action="">
        <h2 class="form-signin-heading">Please sign in</h2>
		
        <input type="text" class="form-control" placeholder="Username" name="username" id="username" autofocus>
        <input type="password" id="pass" class="form-control" placeholder="Password" name="password">
        <label class="checkbox">
            <input type="checkbox" value="remember-me" id="remember_me">Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>