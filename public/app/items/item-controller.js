mainApp.config(function($stateProvider) {
  $stateProvider
    .state('home', {
      url: '/',
      
      views: {
        'main@': {
          templateUrl: 'app/items/all-products.html',
          controller: 'itemCtrl'
        }
      },
      data: {
        displayName: 'Home',
      }
    }).state('order_preview', {
      url: '/order-preview',
      
      views: {
        '': {
          templateUrl: 'app/ordersenquiry/enquiry-preview.html',
          controller: 'orderItemCtrl'
        }
      },
      data: {
        displayName: 'Order preview',
      }
    }).state('order_summary', {
      url: '/order-summary/:order_id',
      
      views: {
        '': {
          templateUrl: 'app/ordersenquiry/order-summary.html',
          controller: 'orderItemCtrl'
        }
      },
      data: {
        displayName: 'Order preview',
      }
    }).state('cart_details', {
      url: '/cart-details',
      
      views: {
        '': {
          templateUrl: 'app/ordersenquiry/cart-details.html',
          controller: 'orderItemCtrl'
        }
      },
      data: {
        displayName: 'Cart details',
      }
    })
    

});
//mainApp.

// list 
// create
// update
//mainApp.config(['ui.router', function ($stateProvider) {
//        $stateProvider
//        .state('home', {
//            url:'/',
//            templateUrl: 'app/products/all-products.html',
//            controller: 'itemCtrl'
//        })
//        .state('about', {
//            url:'/about',
//            templateUrl: 'templates/about.html',
//            controller: 'AboutController'
//        });
 
        
        
//        $routeProvider.when('/admin/items',
//                {
//                    templateUrl: 'app/items/items.html',
//                    controller: 'adminItemCtrl'
//                }
//        );
//    }]);




mainApp.controller('itemCtrl', ['$scope', 'ItemFactory', '$stateParams', '$rootScope', '$location', function ($scope, ItemFactory, $stateParams, $rootScope, $location) {
        $scope.html="";
        $scope.helloWorld = "Hellow world";
        $scope.childrenList = "";
        $scope.getChildren = function (parentId) {
          //alert("HLLOW");

            var promise = ItemFactory.getChildren({parent_id: parentId}).$promise;
            promise.then(function (result) {
                $scope.categoryList = result;
                console.log("SADAD");
                
            });

        };
        $scope.getChildren(1);
        $scope.$watch('$viewContentLoaded', function () {
            $scope.getChildren(1);
        });

    }
]).directive('itemlist', function ($compile) {
    return {
        restrict: 'A',
        replace: true,
        link: function (scope, ele, attrs) {
            scope.$watch(attrs.itemlist, function (html) {
                ele.html(html);
                $compile(ele.contents())(scope);
            });
        }
    };
});


