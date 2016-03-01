mainApp.config(['$routeProvider', function ($routeProvider) {

        
        $routeProvider.when('/address',
                {
                    templateUrl: 'app/users/address-partial.html',
                    controller: 'addressCtrl'
                }
        );
        $routeProvider.when('/address/service/:service_type',
                {
                    templateUrl: 'app/users/address-partial.html',
                    controller: 'addressCtrl'
                }
        );
        $routeProvider.when('/address/:id/edit',
                {
                    templateUrl: 'app/users/address-save.html',
                    controller: 'addressCtrl'
                }
        );

    }]);


mainApp.controller('addressCtrl', ['$scope', 'AddressFactory', '$routeParams', '$rootScope', '$location', function ($scope, AddressFactory, $routeParams, $rootScope, $location) {
        $scope.address = {};
        $scope.get = function () {
            $scope.errorMessage = "";
            var promise = AddressFactory.get({id: $routeParams.id}).$promise;
            promise.then(function (result) {
                if (result.error) {
                    $scope.errorMessage = result.error;
                } else {
                    $scope.errorMessage = "";
                    $scope.address = result;
                }

            });
        };

        $scope.getAddressList = function () {
//            console.log(HEADERS);
            var promise = AddressFactory.getAddressByUser({id: $rootScope.user.id}).$promise;
            promise.then(function (result) {
                $scope.addressList = result;
                if (0 == $scope.addressList.length) {
                    $scope.setMode('create_address');
                    console.log($scope.addressList.length);
                } else {
                    if ($location.path().indexOf("edit") > -1) {
                        console.log("EDIT MODE");
                        $scope.setMode("create_address");
                    } else {
                        $scope.setMode('');

                    }

                }

            });

        };

        $scope.setMode = function (mode) {
            $scope.mode = mode;
        };
        $scope.areaList = APP_LOCALITY;
        $scope.getAddressList();

        
        
        
        $scope.addressMode = "";
        $scope.save = function (isValid) {
            if (!isValid) {
                $scope.errorMessage = "Form fields incorrect";
                return;
            }
            $scope.address.user_id = $rootScope.user.id;

            $scope.errorMessage = "";
//            var isUpdate = false;
            if ($routeParams.id) {
                $scope.address.id = $routeParams.id;
                var promise = AddressFactory.update($scope.address).$promise;
//                isUpdate = true;

            } else {
                var promise = AddressFactory.save($scope.address).$promise;

            }
            promise.then(function (result) {
                if (result.error) {
                    $scope.errorMessage = result.error;
                } else {
                    $scope.errorMessage = "";
                    $scope.getAddressList();

                    $scope.address = result;
                    swal("Address saved!");
                    
                    if ($routeParams.id) {
                        $rootScope.back();
                    } else {
                        $scope.enquiry.address_id = result.id;
                    }
                    
                   
                }

            });
        };
        $scope.delete = function (deleteAddressId) {
//            console.log(deleteAddressId);
//            alert(deleteAddressId);
            
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55", 
                confirmButtonText: "Yes, delete it!", closeOnConfirm: false}, 
                function () {
//                swal("Deleted!", "Your imaginary file has been deleted.", "success");
                $scope.errorMessage = "";
                var promise = AddressFactory.delete({id: deleteAddressId}).$promise;
                promise.then(function (result) {
                    if (result.error) {
                        $scope.errorMessage = result.error;
                    } else {
                        swal("Delete successful!");
                        $scope.getAddressList();


                    }

                });
                
            });
            
            
            
        };
        
        $scope.availableTimeList = [];
        for (i = 8; i < 20; i++) {
            if (i < 12) {
                if (i + 1 == 12) {
                    $scope.availableTimeList.push({key:i,val:i + ":00 am  - " + (i + 1) + ":00 pm"});

                } else {
                    $scope.availableTimeList.push({key:i,val:i + ":00 am  - " + (i + 1) + ":00 am"});

                }

            } else if (i == 12) {
                $scope.availableTimeList.push({key:i,val:i + ":00 pm - 1:00 pm"});
            } else {

                $scope.availableTimeList.push({key:i,val:(i - 12) + ":00 pm - " + (i - 11) + ":00 pm"});

            }
        }
        
        $scope.order = {};
        var laundry_service = {dry_wash: 1, wash_iron: 2};
        if ($routeParams.service_type) {
            var laundry_type = $routeParams.service_type.split('=');
            var items = [];
            if (laundry_type[1]) {

                var temp = laundry_type[1].split(',');
                for (var i = 0; i < temp.length; i++) {

                    items.push(laundry_service[[temp[i]]]);
                }
                $scope.order.items = items;


            }
        } else {
            $scope.mode="create_address";
        }
//        console.log(items);

        $scope.enquiry = {};
        if ($rootScope.enquiry_made) {
            $scope.enquiry = $rootScope.enquiry_made;
        }
        $scope.enquiry.updated_by = $rootScope.user.id;
        $scope.placeEnquiry = function () {
            if ($scope.enquiry.address_id) {
                $rootScope.$emit('addEnquiryDetails',{
                    address_id:$scope.enquiry.address_id,
                    pickup_date:$scope.enquiry.pickup_date,
                    pickup_time:$scope.enquiry.pickup_time
                
                });
                $location.path("/order-preview");

            } else {
                $scope.errorMessage = "Please select an address";
            }


            return;


        };


        $scope.update = function () {
            $scope.errorMessage = "";
            console.log($scope.address);
            var promise = AddressFactory.update($scope.address).$promise;
            promise.then(function (result) {
                if (result.error) {
                    $scope.errorMessage = result.error;
                } else {
                    $scope.errorMessage = "";
                }

            });
        };
        
        $scope.$watch('$viewContentLoaded', function () {
            if ($routeParams.id) {
                $scope.get();
            }

        });

    }
]).directive('addressform', function () {
    return {
        restrict: 'E',
        templateUrl: 'app/users/address-save.html'};
}).directive('jqdatepicker', function () {
    return {
        restrict: 'A',
        require: 'ngModel',
         link: function (scope, element, attrs, ngModelCtrl) {
            $(element).datepicker({
                dateFormat: 'd/mm/yy',
                minDate:0,
                onSelect: function (date) {
                    scope.enquiry.pickup_date = date;
                    scope.$apply();
                }
            });
        }
    };
});
