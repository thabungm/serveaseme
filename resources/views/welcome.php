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
        <link href="/app/assets/lib/css/sweet-alert.css" rel="stylesheet">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="/app/assets/lib/bootstrap/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="/app/assets/lib/bootstrap/starter-template.css" rel="stylesheet">
        <link href="/app/commmon//app/css/main.css" rel="stylesheet">
        <link href="/app/assets/lib/bootstrap/font-awesome.css" rel="stylesheet">
        <link href="/app/assets/lib/bootstrap/social-buttons.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="/app/assets/lib/bootstrap/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="/app/assets/lib/bootstrap/assets/js/ie-emulation-modes-warning.js"></script>
        <script src="/app/assets/lib/js/sweet-alert.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


        <script src="/app/env.js"></script>
        <script src="/app/config.js"></script>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <!--<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.js"></script>-->
        <script src="bower_components/angular/angular.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular-animate.js"></script>
        <script src="bower_components/angular-sanitize/angular-sanitize.js"></script>
        <!--<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular-sanitize.js"></script>-->

        <script src="bower_components/angular-messages/angular-messages.js"></script>
        <link rel="stylesheet" href="/app/commmon//app/css/main.css"> 
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css"> 
        <script src="bower_components/angular-resource/angular-resource.js"></script>
        <script src="bower_components/ngCart/dist/ngCart.js"></script>
        
        <script src="bower_components/angular-cookies/angular-cookies.js"></script>
        <script src="bower_components/angular-route/angular-route.js"></script>
        <script src="/app/assets/lib/js/checklist-model.js"></script>
        <script src="/app/assets/lib/bootstrap/ui-bootstrap-tpls-1.1.2.min.js"></script>
        <script src="/app/app-url.js"></script>

        <script src="/app/locality.js"></script>
        <script src="/app/app.js"></script>
        <script src="/app/ordersenquiry/order-enquiry-controller.js"></script>

        <script src="/app/users/authFactory.js"></script>
        <script src="/app/items/itemFactory.js"></script>

        <script src="/app/products/product.js"></script>
        <script src="/app/products/orderFactory.js"></script>
        <script src="/app/products/product-controller.js"></script>
        <script src="/app/users/login-controller.js"></script>
        <script src="/app/users/singnup-controller.js"></script>
        <script src="/app/users/userFactory.js"></script>
        <script src="/app/users/addressFactory.js"></script>
        <script src="/app/users/user-controller.js"></script>
        <script src="/app/httpinterceptor.js"></script>
        <script src="/app/address/address-controller.js"></script>
        <script src="/app/items/item-controller.js"></script>
        
        <script src="/app/services/laundry/laundry-controller.js"></script>
        <script src="/app/ordersenquiry/orderFactory.js"></script>
        <script src="/app/ordersenquiry/order-enquiry-controller.js"></script>
        <script src="/app/admin/admin-controller.js"></script>
        <script src="/app/admin/admin-controller.js"></script>
        <script src="/app/services/driver/driver-controller.js"></script>
        
        
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