<!DOCTYPE html>
<html lang="en" ng-app="mainApp">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <!--<link rel="icon" href="/app/assets/lib/bootstrap/favicon.ico">-->

        <title>ServEaseMe</title>

        <!-- Bootstrap core CSS -->
        <link href="/app/assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="bower_components/bootstrap-sweetalert/lib/sweet-alert.css" rel="stylesheet">
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="/app/assets/lib/bootstrap/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="/app/assets/lib/bootstrap/starter-template.css" rel="stylesheet">
        <link href="/app/commmon/app/css/main.css" rel="stylesheet">
        <link href="/app/assets/lib/bootstrap/font-awesome.css" rel="stylesheet">
        <link href="/app/assets/lib/bootstrap/social-buttons.css" rel="stylesheet">
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css"> 
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/app/commmon//app/css/main.css"> 
        <script src="/app/config.js"></script>


        <?php
        //if ($env == 'local') {
        if ($env == 'production') {
            include_once('welcome-lib.php');
            ?>


        <?php } else {
            ?>


            <script type="text/javascript" src="dist/lib/minifyify-lib.js"></script>   
            <script type="text/javascript" src="dist/app/minifyify-app.js"></script>   
            <?php
        }
        ?>
        <script src="app/assets/lib/bootstrap/ui-bootstrap-tpls-1.1.2.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    </head>

    <body>
        
        <nav role="navigation" class="navbar navbar-collapse navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <!--<ul class="nav navbar-nav navbar-right">
            <li>
                
            </li>
          
        </ul>-->
<!--        <div class="container" style="    margin-top: 40px;" ng-controller="orderItemCtrl">

            <div id='ajax_loader' style="position: fixed; left: 40%; top: 30%;z-index: 999999" ng-show='$root.show_loader'>
                <img src="https://www.drupal.org/files/issues/ajax-loader.gif"></img>
            </div>
        </div>-->
        <div class="container" style="    ng-controller="orderItemCtrl">

            <div id='ajax_loader' style="position: fixed; left: 40%; top: 30%;z-index: 999999" ng-show='$root.show_loader'>
                <img src="https://www.drupal.org/files/issues/ajax-loader.gif"></img>
            </div>
        </div>
        <div class="navbar-header">
            
            
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand"><a style="margin-bottom:10%;" href="#/" class=""><img src="/app/assets/app/images/logo.png"></a></div>
            
            
        
        </div>
        <ngcart-summary template_url="/app/templates/ngCart/summary.html"></ngcart-summary>

          
        
      
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" ng-controller="loginCtrl" class="collapse navbar-collapse navbar-right">
            <ul class="nav navbar-nav">
                
                <li><a href="#/about-us">About Us</a></li>
                <li  role="menu" aria-labelledby="menu1"    ng-show="$root.user.email"  data-no-collapse="true">
                    <a data-target="#" href="" data-toggle="dropdown" class="dropdown-toggle">
                            {{$root.user.email}}<b class="caret"></b></a>
                    
                    <ul class="dropdown-menu">
                        <li><a href="#/my-info">My info</a></li>
                        <li><a href="#/orders">My Orders</a></li>
                        <li><a href="" ng-click="logout();">Logout</a></li>
                    </ul>
                </li>
                    
                     
                    
            </ul>
            
        </div>
        
        
    </nav>
        <div class='container' ui-view>
        </div>
    </body>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<style>
    
</style>
</html>