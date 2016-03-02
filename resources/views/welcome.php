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
        <link href="/app/commmon//app/css/main.css" rel="stylesheet">
        <link href="/app/assets/lib/bootstrap/font-awesome.css" rel="stylesheet">
        <link href="/app/assets/lib/bootstrap/social-buttons.css" rel="stylesheet">
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css"> 
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/app/commmon//app/css/main.css"> 
        <script src="/app/config.js"></script>

        
        
        <?php
            //if ($env == 'local') {
            if ($env != 'production') {
            include_once('welcome-lib.php');    

            ?>
            
        
            <?php
            } else {?>

        
             <script type="text/javascript" src="dist/lib/minifyify-lib.js"></script>   
             <script type="text/javascript" src="dist/app/minifyify-app.js"></script>   
            <?php
        }

         ?>


        
        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        

    </head>

    <body>


        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top main-header" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#/"><img src="/app/assets//app/images/logo.png"></a>
                    <!--<a class="navbar-brand" href="#/">Home</a>-->
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div ng-controller="loginCtrl" class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#/about-us">About Us</a>
                        </li>
<!--                        <li>
                            <a href="#">Career</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>-->
                    </ul>
                    <div class="pull-right"><ngcart-summary template_url="/app/templates/ngCart/summary.html"></ngcart-summary></div>

                    <login></login>
                   
                    
                    
                    
                </div>
                
                
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Page Content -->
        <div class="container" style="    margin-top: 40px;" ng-controller="orderItemCtrl">
            
            <div class="m-app-loading" ng-animate-children>

        <!--
            HACKY CODE WARNING: I'm putting Style block inside directive so that it
            will be removed from the DOM when we remove the directive container.
        -->
        <style type="text/css">
            div.m-app-loading {
                position: fixed ;
            }
            div.m-app-loading div.animated-container {
                background-color: #333333 ;
                bottom: 0px ;
                left: 0px ;
                opacity: 1.0 ;
                position: fixed ;
                right: 0px ;
                top: 0px ;
                z-index: 999999 ;
            }
            /* Used to initialize the ng-leave animation state. */
            div.m-app-loading div.animated-container.ng-leave {
                opacity: 1.0 ;
                transition: all linear 200ms ;
                    -webkit-transition: all linear 200ms ;
            }
            /* Used to set the end properties of the ng-leave animation state. */
            div.m-app-loading div.animated-container.ng-leave-active {
                opacity: 0 ;
            }
            div.m-app-loading div.messaging {
                color: #FFFFFF ;
                font-family: monospace ;
                left: 0px ;
                margin-top: -37px ;
                position: absolute ;
                right: 0px ;
                text-align: center ;
                top: 50% ;
            }
            div.m-app-loading h1 {
                font-size: 26px ;
                line-height: 35px ;
                margin: 0px 0px 20px 0px ;
            }
            div.m-app-loading p {
                font-size: 18px ;
                line-height: 14px ;
                margin: 0px 0px 0px 0px ;
            }
        </style>


        <!-- BEGIN: Actual animated container. -->
        <div class="animated-container">

            <div class="messaging">

                <h1>
                    Initializing the Awesome!
                </h1>

                <p>
                    Please stand by for your ticket to awesome-town!
                </p>

            </div>

        </div>
        <!-- END: Actual animated container. -->

    </div>
    <!-- END: App-Loading Screen. -->

            
            
            <div ng-view>


            </div>
        </div>
        <hr>

        <!-- Footer -->
        <!--        <footer>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>Copyright &copy; Your Website 2014</p>
                        </div>
                    </div>
                </footer>
                 /.container 
        
                 jQuery 
                <script src="js/jquery.js"></script>-->

        <!-- Bootstrap Core JavaScript -->

    </body>
    <script>
  
</script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</html>