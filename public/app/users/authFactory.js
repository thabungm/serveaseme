'use strict';
mainApp.factory('AuthFactory', ['$resource', '$rootScope', '$cookies','$location', function ($resource, $rootScope, $cookies,$location) {
        var user;
        return{
            setAuthorizationHeader: function () {
                HEADERS = {Authorization: "Bearer " + $rootScope.user.token};
            },
            setAuthorizationHeaderSocial: function (token) {
                HEADERS = {Authorization: "Bearer " + token};
            },
            resetAuthorizationHeader: function() {
                HEADERS = null;
            }
            ,
            setUser: function (aUser) {

                $rootScope.user = aUser;
                $cookies.put('user', JSON.stringify(aUser));
                this.setAuthorizationHeader();


            },
            
            syncCookieUser: function () {

                var user = $cookies.get('user');
                if (!user) {
                    return;
                }
                $rootScope.user = JSON.parse(user);

                console.log(JSON.stringify($rootScope.user));
                console.log($rootScope.user);
                this.setAuthorizationHeader();

            },
            getUser: function () {

                return $rootScope.user;
            },
            logout: function () {
                $rootScope.user = undefined;
                this.resetAuthorizationHeader();
                $cookies.remove("user");
                $rootScope.$emit('emptyCart');
                console.log("LOGGED OUT");
//                $location("/");
                
            },
            isLoggedIn: function () {
                console.log(this.getUser());
                return(this.getUser()) ? true : false;
            },
            login: function (username, password,callback) {
                var self = this;
//                console.log(username + password);
                var Login = $resource(APP_URL.login, {},
                        {
                            login: {method: "POST"}
                        }
                );
                var promise = Login.login({email: username, password: password}).$promise;
                promise.then(function (result) {

                    if (result.token) {
                        console.log(result.token);
                        result.user['token'] = result.token;
                        self.setUser(result.user);
                        callback(null);
                    } 
                    

                },function(error) {
                    console.log(error);
                    callback(error) 
                });
            },
            loginWithToken: function (token,callback) {
                var self = this;
//                console.log(username + password);
                self.setAuthorizationHeaderSocial(token);
                var Login = $resource(APP_URL.userbytoken, {},{
                    query: {method: 'GET', headers: HEADERS,isArray:false},
                });
                var promise = Login.query({token:token}).$promise;
                promise.then(function (result) {

                    if (result) {
                        console.log(token);
                        result['token'] = token;
                        self.setUser(result);
                        callback(null);
                    } 
                    

                },function(error) {
                    console.log(error);
                    callback(error) 
                });
            }
        }
    }]);