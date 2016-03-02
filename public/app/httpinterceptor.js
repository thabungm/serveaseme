mainApp.factory('httpinterceptor',['$q','$location','$rootScope','$cookies',function($q,$location,$rootScope,$cookies){
    return {
            request: function (req) {
                if (HEADERS) {
                    req.headers.Authorization = HEADERS.Authorization;

                }
                $rootScope.show_loader++;
                return req;
//            return response || $q.when(response);
            },
        response: function(response){
            $rootScope.show_loader--;
            if (response.status === 401) {
                console.log("Response 401");
               //AuthFactory.logout();
            }
            return response || $q.when(response);
        },
        responseError: function(rejection) {
            $rootScope.show_loader--;
            if (rejection.status === 401) {
                console.log("Response Error 401",rejection);
                
                $rootScope.user = undefined;
                $cookies.remove("user");
                HEADERS = null;
                $location.path("/");
            } else {
                console.log(rejection);
//                alert(rejection.error);
                
            }
            return $q.reject(rejection);
        }
    }
}])
.config(['$httpProvider',function($httpProvider) {
    //Http Intercpetor to check auth failures for xhr requests
    $httpProvider.interceptors.push('httpinterceptor');
}]);