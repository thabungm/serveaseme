'use strict';
mainApp.factory('ProductFactoryzzz', ['$resource',
    function ($resource) {
        return $resource(API_ENGINE_URL + 'items/:itemId', {}, {
            get: {method: 'GET', headers:HEADERS,params: {itemId: '@itemId'}},
            getAllCategories: {method: 'GET', headers:HEADERS,url:APP_URL.get_all_category,isArray:true},
            save: {method: 'GET', isArray: true},
            getProductsByPath: {method: 'post',headers:HEADERS,url:APP_URL.item_children}


            //tree: {method:'GET', isArray:true,url:API_ENGINE_URL+"category/tree"}
        });
    }]);

mainApp.factory('ProductListFactory', ['$resource',
    function ($resource) {
        return $resource(API_ENGINE_URL + 'category/:id/items',
        {}, 
        {
            get: {method: 'GET',headers:HEADERS, params: {category_id: '@category_id', id: '@id'},isArray:true},
            save: {method: 'GET',headers:HEADERS, isArray: true},
            
        });
    }]);



mainApp.factory('CategoryFactory', ['$resource',
    function ($resource) {
        return $resource(API_ENGINE_URL + 'items/:itemId', {}, {
            getChildren:{method:'GET',headers:HEADERS,params: {parent_id: '@parent_id'},url:APP_URL.get_children,isArray:true},
            ///////////
            get: {method: 'GET', headers:HEADERS,params: {itemId: '@itemId'}},
            getAllCategories: {method: 'GET', headers:HEADERS,url:APP_URL.get_all_category,isArray:true},
            save: {method: 'GET', isArray: true},
            getProductsByPath: {method: 'post',headers:HEADERS,url:APP_URL.item_children}


            //tree: {method:'GET', isArray:true,url:API_ENGINE_URL+"category/tree"}
        });
    }]);
