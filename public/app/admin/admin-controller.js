var generateData = function () {
    var arr = [];
    var letterWords = ["alpha", "bravo", "charlie", "daniel", "earl", "fish", "grace", "henry", "ian", "jack", "karen", "mike", "delta", "alex", "larry", "bob", "zelda"]
    for (var i = 1; i < 60; i++) {
        var id = letterWords[Math.floor(Math.random() * letterWords.length)];
        arr.push({"id": id + i, "name": "name " + i, "description": "Description of item #" + i, "field3": id, "field4": "Some stuff about rec: " + i, "field5": "field" + i});
    }
    return arr;
}

var sortingOrder = 'name'; //default sort

mainApp.config(['$routeProvider', function ($routeProvider) {

        $routeProvider.when('/admin/orders',
                {
                    templateUrl: 'app/admin/admin-orders.html',
                    controller: 'userCtrl'
                }
        );
        $routeProvider.when('/admin/category',
                {
                    templateUrl: 'app/admin/admin-category.html',
                    controller: 'adminCtrl'
                }
        );



    }]);
mainApp.controller('adminCtrl', ['$scope', 'OrderFactory', '$location','$filter','ItemFactory', function ($scope,  OrderFactory, $location,$filter,ItemFactory) {

        $scope.status_colors = STATUS_COLORS;
        $scope.show_order_list=true;
        $scope.generateData = function() {
            
            

            var promise = OrderFactory.adminOrderHistory().$promise;
            promise.then(function(result) {
                $scope.items = result;
                $scope.search();
            });
        }
        $scope.sortingOrder = sortingOrder;
        $scope.pageSizes = [5, 10, 25, 50];
        $scope.reverse = false;
        $scope.filteredItems = [];
        $scope.groupedItems = [];
        $scope.itemsPerPage = 10;
        $scope.pagedItems = [];
        $scope.currentPage = 0;
//        $scope.items =  generateData();

        var searchMatch = function (haystack, needle) {
            if (!needle) {
                return true;
            }
            return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;
        };

        // init the filtered items
        $scope.search = function () {
            $scope.filteredItems = $filter('filter')($scope.items, function (item) {
                for (var attr in item) {
                    if (searchMatch(item[attr], $scope.query))
                        return true;
                }
                return false;
            });
            // take care of the sorting order
            if ($scope.sortingOrder !== '') {
                $scope.filteredItems = $filter('orderBy')($scope.filteredItems, $scope.sortingOrder, $scope.reverse);
            }
            $scope.currentPage = 0;
            // now group by pages
            $scope.groupToPages();
        };

        // show items per page
        $scope.perPage = function () {
            $scope.groupToPages();
        };

        // calculate page in place
        $scope.groupToPages = function () {
            $scope.pagedItems = [];

            for (var i = 0; i < $scope.filteredItems.length; i++) {
                if (i % $scope.itemsPerPage === 0) {
                    $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)] = [$scope.filteredItems[i]];
                } else {
                    $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)].push($scope.filteredItems[i]);
                }
            }
        };

        $scope.deleteItem = function (idx) {
            var itemToDelete = $scope.pagedItems[$scope.currentPage][idx];
            var idxInItems = $scope.items.indexOf(itemToDelete);
            $scope.items.splice(idxInItems, 1);
            $scope.search();

            return false;
        };

        $scope.range = function (start, end) {
            var ret = [];
            if (!end) {
                end = start;
                start = 0;
            }
            for (var i = start; i < end; i++) {
                ret.push(i);
            }
            return ret;
        };

        $scope.prevPage = function () {
            if ($scope.currentPage > 0) {
                $scope.currentPage--;
            }
        };

        $scope.nextPage = function () {
            if ($scope.currentPage < $scope.pagedItems.length - 1) {
                $scope.currentPage++;
            }
        };

        $scope.setPage = function () {
            $scope.currentPage = this.n;
        };

        // functions have been describe process the data for display
        $scope.generateData();


        // change sorting order
        $scope.sort_by = function (newSortingOrder) {
            if ($scope.sortingOrder == newSortingOrder)
                $scope.reverse = !$scope.reverse;

            $scope.sortingOrder = newSortingOrder;
        };

        $scope.orderDetails = {items:[]};
        $scope.showOrderDetails =function(id) {
            $scope.orderDetails.items = [];
            var promise = OrderFactory.adminGetOrderDetails({id:id}).$promise;
            promise.then(function(result) {
                var itemTotal = 0;
                
                
                angular.forEach(result,function(val) {
                    if (!$scope.orderDetails.status) {
                        $scope.orderDetails.status = val.status;
                    }
                    $scope.orderDetails.items.push(val);
                    itemTotal+= val.price*val.quantity;
                    
                    
                });
                $scope.orderDetails.total_amount = itemTotal;
                $scope.show_order_list = false;
                
                

            });
        }
    
    // /admin/category
    
    $scope.getCategories = function(parentId) {
        
    }
    
    
    $scope.deleteNode = function(data) {
        data.nodes = [];
    };
    $scope.addNode = function(data) {
        var post = data.nodes.length + 1;
        var newName = data.name + '-' + post;
        data.nodes.push({name: newName,nodes: []});
    };
    
    $scope.displayTree = function(node) {
        
        var promise = ItemFactory.getChildren({parent_id:node.id}).$promise;
        promise.then(function(itemList) {
            if (itemList) {
                node.nodes = itemList;
            } 

        });
        
        
    };
    $scope.tree = [{name: "ServEaseMe",id:1, nodes: []}];
    if ($location.path() == "/admin/category") {
        $scope.displayTree($scope.tree[0]);
    }
    
    $scope.itemCategory = {};
    $scope.saveNodeMode = false;
    $scope.showEditNode = function(data) {
        $scope.itemCategory = data;
        $scope.saveNodeMode = true;
    }
    
    $scope.showAddNode = function(data) {
        $scope.itemCategory = {};
        $scope.itemCategory.parent_id = data.id;
        
        $scope.saveNodeMode = true;
        
    }
    
    $scope.saveNodeItem = function () {
        if ($scope.itemCategory.id) {
        var promise = ItemFactory.update($scope.itemCategory).$promise;
        } else {
            var promise = ItemFactory.save($scope.itemCategory).$promise;

        }
        promise.then(function (result) {

            $scope.saveNodeMode = false;

        });



    }
    $scope.cancelSave = function () {
        
            $scope.saveNodeMode = false;


    }
    $scope.showOrderList = function() {
        $scope.show_order_list  = true;
    }


    
    
    
    
    
    
    
    
    
    
    
    
    
    
    }
    
    
    
    
    
]);
//initApp.$inject = ['$scope', '$filter'];

//$(document).ready(function() {});