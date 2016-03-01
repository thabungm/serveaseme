//mainApp.

// list 
// create
// update
mainApp.config(['$routeProvider', function ($routeProvider) {
        $routeProvider.when('/admin/items',
                {
                    templateUrl: 'app/items/items.html',
                    controller: 'adminItemCtrl'
                }
        );
    }]);



mainApp.controller('itemCtrl', ['$scope', 'ItemFactory', '$routeParams', '$rootScope', '$location', function ($scope, ItemFactory, $routeParams, $rootScope, $location) {
        $scope.html="";
        $scope.childrenList = "";
        $scope.getChildren = function (parentId) {
            var promise = ItemFactory.getChildren({parent_id: parentId}).$promise;
            promise.then(function (result) {
                if (result.length == 0) {
                    
                } else {
                angular.forEach(result, function (value, key) {
                    $scope.html+= '<div><a ng-click="getChildren('+value.id+')" href="">'+value.name+'</a></div>';
                });
            }
            });

        };
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


