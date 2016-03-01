'use strict';
mainApp.factory('ItemFactory', ['$resource', '$rootScope', '$cookies', function ($resource, $rootScope, $cookies) {
        return $resource(API_ENGINE_URL + 'users/:id',
                {},
                {
                    getChildren: {method: 'GET', headers: HEADERS, params: {parent_id: '@parent_id'},url:APP_URL.get_children,isArray:true},
                    getAllCategories: {method: 'GET', headers:HEADERS,url:APP_URL.get_all_category,isArray:true},

                    save: {method: 'POST', headers: HEADERS,url:APP_URL.add_item},
                    update: {method: 'PUT', headers: HEADERS,url:APP_URL.update_item},
                    changePassword: {method: 'PUT', headers: HEADERS,url: APP_URL.change_password},
                    forgotPassword: {method: 'POST', headers: HEADERS,url: APP_URL.forgot_password}
                   
                });

    }]);


