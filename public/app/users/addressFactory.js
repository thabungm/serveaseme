'use strict';
mainApp.factory('AddressFactory', ['$resource', '$rootScope', '$cookies', function ($resource, $rootScope, $cookies) {
        return $resource(API_ENGINE_URL + 'address/:id',
                {},
                {
                    get: {method: 'GET', headers: HEADERS, params: {id: '@id'}},
                    delete: {method: 'POST', headers: HEADERS,  url:APP_URL.address_remove},
                    save: {method: 'POST', headers: HEADERS},
                    update: {method: 'PUT', headers: HEADERS},
                    getAddressByUser: {method: 'GET',params:{id:'@id'}, url:APP_URL.address_by_userid,isArray:true}

                });

    }]);