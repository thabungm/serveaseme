
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


