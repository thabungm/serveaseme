mainApp.factory('OrderFactory', ['$resource',
    function ($resource) {
        return $resource(APP_URL.order_item,
                {},
                {
                    get: {method: 'GET', headers: HEADERS, params: {category_id: '@category_id', id: '@id'}, isArray: true},
                    placeOrder: {method: 'POST', params: {}},
                    getOrderHistory: {method: 'GET',  params: {},url:APP_URL.order_history,isArray:true},
                    adminOrderHistory: {method: 'POST',  params: {},url:APP_URL.admin_order_history,isArray:true},
                    adminGetOrderDetails: {method: 'GET',  params: {id:'@id'},url:APP_URL.admin_order_details,isArray:true}
                });
    }]);