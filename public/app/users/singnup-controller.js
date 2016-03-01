mainApp.config(['$routeProvider', function ($routeProvider) {
        
        $routeProvider.when('/signup',
                {
                    templateUrl: 'app/users/signup-partial.html',
                    controller: 'signupCtrl'
                }
        );
}]);
mainApp.controller('signupCtrl', ['$scope', 'UserFactory','$location', function ($scope, UserFactory,$location) {
        $scope.user = {};
        $scope.submit = function (isValid) {
            $scope.errorMessage = "";
            if (isValid) {
                var promise = UserFactory.save($scope.user).$promise;
                promise.then(function(result) {
                  if (result.error) {
                      $scope.errorMessage = result.error;
                  } else {
//                      $scope.sucessMsg = "Great! Account successfully created"u
                        swal("Awesome! You have created your account!");
                      $scope.errorMessage = "";
                      $location.path("#/");
                  }  
                    
                });
            }
            

        };

    }
]);