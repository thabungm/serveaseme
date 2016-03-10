/*
mainApp.config(['$routeProvider', function ($routeProvider) {


        $routeProvider.when('/order-preview',
                {
                    templateUrl: 'app/ordersenquiry/enquiry-preview.html',
                    controller: 'orderItemCtrl'
                }
        );

        $routeProvider.when('/orders',
                {
                    templateUrl: 'app/ordersenquiry/order-history.html',
                    controller: 'orderItemCtrl'
                }
        );
        $routeProvider.when('/order-summary',
                {
                    templateUrl: 'app/ordersenquiry/order-summary.html',
                    controller: 'orderItemCtrl'
                }
        );
        $routeProvider.when('/order-success',
                {
                    templateUrl: 'app/ordersenquiry/order-success.html',
                    controller: 'orderItemCtrl'
                }
        );



    }]);
*/
mainApp.controller('orderItemCtrl', ['$scope', '$rootScope', 'AddressFactory','OrderFactory', '$cookies','$location','ngCart','$stateParams', function ($scope, $rootScope, AddressFactory,OrderFactory, $cookies,$location,ngCart,$stateParams) {


        $rootScope.$on('addToCartEnquiry', function (idk, item) {
            console.log($cookies.get('enquiry_made'));
            if ($cookies.get('enquiry_made') == undefined) {
                var enquiry = {items:{}};
                enquiry.items[item.id] = item;
            } else {
                var enquiry = JSON.parse($cookies.get('enquiry_made'));
                if (enquiry.items) {
                    enquiry.items[item.id] = item;

                } else {
                    enquiry.items = {};
                    enquiry.items[item.id] = item;
                }
            }
            $cookies.put('enquiry_made', JSON.stringify(enquiry));
            $rootScope.$emit('syncEnquiryMade');
        });
        
        
        $scope.removeFromEnquiryCart = function() {};

        $rootScope.$on('addEnquiryDetails', function (idk, item) {
            var x =$cookies.get('enquiry_made');
            if ($cookies.get('enquiry_made')!=null) {
                var enquiry = JSON.parse($cookies.get('enquiry_made'));

            } else {
                var enquiry = {};

            }
            angular.forEach(item, function (value, key) {
                enquiry[key] = value;
            });
            $cookies.put('enquiry_made', JSON.stringify(enquiry));
            $rootScope.$emit('syncEnquiryMade');
        });

        $rootScope.$on('syncEnquiryMade', function () {
            var enquiry = null;
            if ($cookies.get('enquiry_made')) {
                 enquiry = JSON.parse($cookies.get('enquiry_made'));
            }

            $rootScope.enquiry_made = enquiry;
            console.log($rootScope.enquiry_made);

        });
        
        $rootScope.$on('emptyCart', function () {
            ngCart.empty();
            $cookies.put('enquiry_made', JSON.stringify({}));
            $rootScope.$emit('syncEnquiryMade');
        });


        if ($rootScope.enquiry_made)
        if ($rootScope.enquiry_made.address_id) {
            var promise = AddressFactory.get({id: $rootScope.enquiry_made.address_id}).$promise;
            promise.then(function (result) {
                if (result.error) {
                    $scope.errorMessage = result.error;
                } else {
                    $scope.errorMessage = "";
                    $scope.address = result;
                }

            });

        }
        $scope.enquiry_made = $rootScope.enquiry_made;
        
        $rootScope.formatDate = function(inputDate) {
            return new Date(inputDate).toISOString();
        };
        
        


        $scope.checkout = function() {
            var order = {};
            order.address_id = $scope.enquiry_made.address_id;
            
            order.pickup_date = $scope.enquiry_made.pickup_date
            order.pickup_time = $scope.enquiry_made.pickup_time;
            order.items = ngCart.getItems();
            var promise = OrderFactory.placeOrder(order).$promise;
            promise.then(function(result) {
                swal("Order placed!","Our team will contact you soon!");
                $rootScope.$emit('emptyCart');
                $location.path("/order-summary/"+result.id);
                
            })
        };
        $scope.orderHistory = {};
        $scope.oneAtATime = true;
        $scope.status = {
            isFirstOpen: true,
            isFirstDisabled: false
        };
        
        $scope.getTotal = function(quantity,amt) {
            return quantity*amt;
        };
        $scope.statusClass = STATUS_COLORS;

        $scope.lengthOfOrder = 0;
        $scope.getOrderHistory = function() {
            var promise = OrderFactory.getOrderHistory().$promise;
            
            //orderhistory
            //  orderhistory[]  
            //  orderhistory
            //  orderhistory
            
            promise.then(function(result) {
                angular.forEach(result,function(val) {
                    if ($scope.orderHistory[val.order_id]) {
                        $scope.orderHistory[val.order_id].items.push(val);
                        $scope.orderHistory[val.order_id].total_amnt = $scope.getTotal(val.quantity,val.price) + $scope.orderHistory[val.order_id].total_amnt;
                    } else {
                        
                        $scope.orderHistory[val.order_id] = {total_amnt:$scope.getTotal(val.quantity,val.price),items:[val],order_date:val.order_date,status:val.status,pickup_date:val.pickup_date};
                    }
                });
                $scope.lengthOfOrder = Object.keys($scope.orderHistory).length;
                console.log($scope.lengthOfOrder);
                
                
            })
        };
        $scope.orderSummary = {};
        $scope.orderSummaryTotal = 0;
        $scope.getMyOrderSummary = function(orderId) {
            var promise = OrderFactory.getMyOrderSummary({id:orderId}).$promise;
            promise.then(function(resp) {
                $scope.orderSummary = resp;
                angular.forEach(resp,function(val) {
                  $scope.orderSummaryTotal+=$scope.getTotal(val.quantity,val.price);
                });
                console.log("#############################");
                console.log($scope.orderSummaryTotal);

            }); 

        }



        if ($location.path() == '/orders') {
            $scope.getOrderHistory();
        }
        var sss = $location.path() ;
        if ($stateParams.order_id) {
            $scope.getMyOrderSummary($stateParams.order_id);
        }


    }]);

