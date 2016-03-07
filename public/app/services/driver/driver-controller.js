mainApp.config(['$routeProvider', function ($routeProvider) {
        
        
        $routeProvider.when('/service/Drivers/:id',
                {
                    templateUrl: 'app/services/driver/driver.html',
                    controller: 'driverCtrl'
                }
        );}]);
        
//$scope.clothPric  = {};        
mainApp.controller('driverCtrl', ['$scope', 'ItemFactory',
    '$routeParams',"$rootScope","$location","ngCart","ngCartItem", function ($scope, ItemFactory, $routeParams,$rootScope,$location,ngCart,ngCartItem) {
        
        $scope.now_showing = "service_types";
        
        
       
        $scope.dirverItems =[];
       
       
        $scope.enquiry = {};
        $scope.showServices = function() {
            $scope.now_showing = "service_types";
        };
        $scope.addCartDriver = function() {
            angular.forEach($scope.enquiry.items,function(value,key) {
                $rootScope.$emit('addToCartEnquiry', {id:value,name:$scope.laundryServiceNames[value]});
            });
            
            $location.path("/address");
        };
        $scope.showAddressDetails = function() {
            if(ngCart.getTotalItems()==0) {
                $scope.errorMessage = "No items added!";
                return false;
            }
            
            $location.path("/address");
        };
        
        
        $scope.$watch('$viewContentLoaded', function () {
            var promise = ItemFactory.getChildren({parent_id:$routeParams.id}).$promise;
            promise.then(function(itemList) {
                $scope.dirverItems = itemList;
            });

        });


    }]).directive('laundryprices', function () {
    return {
        restrict: 'E',
        templateUrl: 'app/services/laundry/laundry-prices.html'};
});;       