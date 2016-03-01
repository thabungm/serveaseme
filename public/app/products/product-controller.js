mainApp.config(['$routeProvider', function ($routeProvider) {
       
       

       
       
        $routeProvider.when('/',
                {
                    templateUrl: 'app/products/all-products.html',
                    controller: 'productController'
                }
        );
        
        
       
       
        $routeProvider.otherwise({redirectTo: '/'});
    }]);
mainApp.controller('productController', ['$scope', 'CategoryFactory',
    '$routeParams', function ($scope, CategoryFactory, $routeParams) {
        $scope.categoryList = {};
        $scope.getChildren = function (id) {
            var promise = CategoryFactory.getChildren({parent_id:id}).$promise;
            promise.then(function (productList) {
                $scope.categoryList = productList;
            });
        }
        $scope.$watch('$viewContentLoaded', function () {
            $scope.getChildren(1);
        });


    }]);
















mainApp.controller('laundryCtrl', ['$scope', '$rootScope', 'ItemFactory', 'AddressFactory',
    '$routeParams', '$location', function ($scope, $rootScope, ItemFactory, AddressFactory, $routeParams, $location) {
        $scope.order = {};
        $scope.order.service_type = [];


        var promise = ItemFactory.getProductsByPath({path: "Laundry/"}).$promise;
        promise.then(function (productList) {
            console.log(productList);
            $scope.itemList = productList;
            $scope.laundryMenList = productList['Laundry/Men/'];
            $scope.laundryWomenList = productList['Laundry/Women/'];
            $scope.laundryKidList = productList['Laundry/Kids/'];
        });


        $scope.addService = function () {

            if ($scope.order.service_type.length == 0) {

                $scope.errorMessage = "Please tick atleast 1 service!";
            } else {
                $location.path("/address/service/?service_type=" + $scope.order.service_type.join(","));
//                $location.path("/address?z=1");
//                                  #/address
            }
            //#/address
        }


        console.log("TESTING ###");

    }]);





