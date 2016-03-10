mainApp.config(function($stateProvider) {
  $stateProvider
    .state('login', {
      url: '/login',
      
      views: {
        '': {
          templateUrl: 'app/users/login-partial.html',
          controller: 'loginCtrl'
        }
      },
      data: {
        displayName: '',
      }
    })
    

})

/*
mainApp.config(['$routeProvider', function ($routeProvider) {

        $routeProvider.when('/login',
                {
                    templateUrl: 'app/users/login-partial.html',
                    controller: 'loginCtrl'
                }
        );
        $routeProvider.when('/auth-token/:token',
                {
                    templateUrl: 'app/users/login-partial.html',
                    controller: 'loginCtrl'
                }
        );
    }]);
    */
mainApp.controller('loginCtrl', ['$scope', 'AuthFactory','$location','ItemFactory','$routeParams','$state','$rootScope', function ($scope, Auth, $location,ItemFactory,$routeParams,$state,$rootScope) {
        $scope.user = {};
        $scope.facebookLoginLink = LOGIN_FACEBOOK_LINK;
        $scope.submit = function () {
            Auth.login($scope.user.email, $scope.user.password, function (err) {
                if (err) {
                    if (err.status == 401) {
                        $scope.errorMessage = "Login failed";
                    }
                } else {
                   // $rootScope.previous_url = "";
                   // $rootScope.previous_url = "/";
                   if ($rootScope.user.role == 'admin') {
                    $state.go("admin_orders");
                    return;
                   }
                   $location.path("/");
                } 

            });
        };
       
       
        $scope.logout = function () {
            Auth.logout();
            $location.path("/login");
        }
        
        
        if ($routeParams.token) {
            Auth.loginWithToken($routeParams.token,function (err) {
                if (err) {
                    if (err.status == 401) {
                        $scope.errorMessage = "Login failed";
                    }
                } else {
                   // $rootScope.previous_url = "";
                   // $rootScope.previous_url = "/";
                   $location.path("/");
                } 

            });
        }


    }
]).directive('login', function () {
    return {
        restrict: 'E',
        template:'<div style="margin-top:16px;" ng-show="$root.user.email"  class="dropdown nav navbar-nav navbar-right"\n\
     role="menu" aria-labelledby="menu1">\n\
<a data-target="#" href="" data-toggle="dropdown" class="dropdown-toggle">{{$root.user.email}}<b class="caret"></b></a><ul class="dropdown-menu"><li><a href="#/my-info">My info</a></li><li><a href="" ng-click="logout();">Logout</a></li></ul></div>'    };
});