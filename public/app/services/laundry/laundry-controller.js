mainApp.config(function($stateProvider) {
  $stateProvider
    
    .state('laundry', {
      url: '/service/Laundry/:id',
      
      views: {
        '': {
          templateUrl: 'app/services/laundry/laundry.html',
          controller: 'laundryCtrl'
        }
      },
      data: {
        displayName: 'Laundry',
      }
    })  
    

});
        
//$scope.clothPric  = {};        
mainApp.controller('laundryCtrl', ['$scope', 'CategoryFactory',
    '$stateParams',"$rootScope","$location","ngCart","ngCartItem", function ($scope, CategoryFactory, $stateParams,$rootScope,$location,ngCart,ngCartItem) {
        $scope.laundryServiceTypes = {};
        $scope.laundryServiceNames = {};
        $scope.now_showing = "service_types";
        $scope.getChildren = function (id,callback) {
            if (id == undefined) {
                return;
            }
            var promise = CategoryFactory.getChildren({parent_id:id}).$promise;
            promise.then(function (itemList) {
                callback(itemList);
                
            });
        };
        $scope.clothPrices = {};
        $scope.clothItems = null;
        $scope.showClothPriceList = function(parentId,parentName) {
            
            if ($scope.clothPrices[parentId]) {
                $scope.clothItems = $scope.clothPrices[parentId];
                return;
            }
            $scope.getChildren(parentId,function(itemList) {
                var name = parentName;
                var items = [];
                angular.forEach(itemList, function (value, key) {
                    items.push(value);
                
                });
                $scope.clothPrices[parentId] = {name:name,items:items};
                $scope.clothItems = $scope.clothPrices[parentId];
//                $scope.now_showing = "price_list";
                
            });
        };
        $scope.enquiry = {};
//        $scope.enquiry 
        $scope.showServices = function() {
            $scope.now_showing = "service_types";
        };
        $scope.addCartLaundry = function() {
            angular.forEach($scope.enquiry.items,function(value,key) {
//                var temp = value.split(":");
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
        
        
        $scope.$watch('$stateChangeStart', function () {
            $scope.getChildren($stateParams.id,function(itemList) {
                $scope.laundryServiceTypes = itemList;
                var first = true;
                angular.forEach($scope.laundryServiceTypes, function (value, key) {
                    if (first) {
                        first = false;
                        $scope.showClothPriceList(value.id,value.name);
                    }
                    $scope.laundryServiceNames[value.id] = value.name;
                });
                $scope.showClothPriceList();

            });
        });


    }]).directive('laundryprices', function () {
    return {
        restrict: 'E',
        templateUrl: 'app/services/laundry/laundry-prices.html'};
});;       