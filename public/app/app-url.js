var HEADERS = {};
var headerss = {Authorization : "dfsdfsdfsfs"};
var APP_URL = {
    login: API_ENGINE_URL + "authenticate",
    userbytoken: API_ENGINE_URL + "user-by-token",
    signup: API_ENGINE_URL + "users",
    update: API_ENGINE_URL + "users",
    delete: API_ENGINE_URL + "users",
    get_me: API_ENGINE_URL + "me",
    
    order_item: API_ENGINE_URL + "orders",
    order_read: API_ENGINE_URL + "orders/:id",
    order_update: API_ENGINE_URL + "orders/:id",
    order_delete: API_ENGINE_URL + "orders/:id",
    order_history: API_ENGINE_URL + "orders-history",
    
//    place_enquiry: API_ENGINE_URL + "enquiry",
    
    read_item:API_ENGINE_URL + "items/:id",
    get_category_items:API_ENGINE_URL + "category/:id/items",
    get_all_category:API_ENGINE_URL + "category",
    change_password:API_ENGINE_URL + "changepassword/:id",
    forgot_password:API_ENGINE_URL + "resetpassword",
    item_children:API_ENGINE_URL + "item-children",
    // address
    address_by_userid:API_ENGINE_URL + "address/user/:id",
    address_remove:API_ENGINE_URL + "address/remove",
    
    get_children:API_ENGINE_URL + "children/:parent_id",
    admin_order_history:API_ENGINE_URL + "admin/orders",
    admin_order_details:API_ENGINE_URL + "admin/order-details/:id",
    add_item:API_ENGINE_URL + "admin/items",
    update_item:API_ENGINE_URL + "admin/items",
    delete_item:API_ENGINE_URL + "admin/items/:id",
    
};


