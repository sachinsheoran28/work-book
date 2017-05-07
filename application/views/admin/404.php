<!DOCTYPE html>
<html>
    <head>
        <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
        <title>TODO supply a title</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        
         <div class="row">
            <div class="col-lg-offset-4 col-lg-8">
                <img class="img-responsive text-center" src="http://localhost/glocalthinkers/assets/images/404.jpg">
                
            </div>
           
            <?php if(isset($_SESSION["is_admin_login"]) && $_SESSION["is_admin_login"]==1) {
               echo ' <h3 class="text-center">Go Back On <a href="'.base_url().'admin/dashboard">Dashboard</a></h3>';
            } else { 
                  echo ' <h3 class="text-center">Go Back On <a href="'.base_url().'home">Home Page</a></h3>';
            
            }
?>
            
      </div><!-- /#page-wrapper -->
    </body>
</html>
