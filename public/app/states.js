mainApp.config(function($stateProvider) {
  $stateProvider
    .state('home', {
      url: '/#',
      
      views: {
        '': {
          templateUrl: 'app/items/all-products.html',
          controller: 'itemCtrl'
        }
      },
      data: {
        displayName: 'Home',
      }
    }).state('order_preview', {
      url: '/order-preview',
      
      views: {
        '': {
          templateUrl: 'app/ordersenquiry/enquiry-preview.html',
          controller: 'orderItemCtrl'
        }
      },
      data: {
        displayName: 'Order preview',
      }
    }).state('order_summary', {
      url: '/order-summary/:order_id',
      
      views: {
        '': {
          templateUrl: 'app/ordersenquiry/order-summary.html',
          controller: 'orderItemCtrl'
        }
      },
      data: {
        displayName: 'Order preview',
      }
    }).state('cart_details', {
      url: '/cart-details',
      
      views: {
        '': {
          templateUrl: 'app/ordersenquiry/cart-details.html',
          controller: 'orderItemCtrl'
        }
      },
      data: {
        displayName: 'Cart details',
      }
    }).state('orders', {
      url: '/orders',
      
      views: {
        '': {
          templateUrl: 'app/ordersenquiry/order-history.html',
          controller: 'orderItemCtrl'
        }
      },
      data: {
        displayName: 'Cart details',
      }
    }).state('drivers', {
      url: '/service/Drivers/:id',
      
      views: {
        '': {
          templateUrl: 'app/services/driver/driver.html',
          controller: 'driverCtrl'
        }
      },
      data: {
        displayName: 'Drivers',
      }
    }).state('address', {
      url: '/address',
      
      views: {
        '': {
          templateUrl: 'app/users/address-partial.html',
          controller: 'addressCtrl'
        }
      },
      data: {
        displayName: 'Address',
      }
    }).state('edit_address', {
      url: '/address/:id/edit',
      
      views: {
        '': {
          templateUrl: 'app/users/address-save.html',
                    controller: 'addressCtrl'
        }
      },
      data: {
        displayName: 'Edit address',
      }
    }).state('my_info',{
      url: '/my-info',
      
      views: {
        '': {
          templateUrl: 'app/users/my-info.html',
                    controller: 'userCtrl'
        }
      },
      data: {
        displayName: 'Edit address',
      }
    }).state('about_us',{
      url: '/about-us',
      
      views: {
        '': {
          templateUrl: 'app/home/about-us.html',
                  
        }
      },
      data: {
        displayName: 'Edit address',
      }
    }).state('admin_orders',{
      url: '/admin/orders',
      
      views: {
        '': {
          templateUrl: 'app/admin/admin-orders.html',
          controller: 'adminCtrl'
          
                  
        }
      },
      data: {
        displayName: 'Edit address',
      }
    }).state('signup',{
      url: '/signup',
      
      views: {
        '': {
          templateUrl: 'app/users/signup-partial.html',
          controller: 'signupCtrl'
          
                  
        }
      },
      data: {
        displayName: 'Edit address',
      }
    }).state('forgo_password',{
      url: '/forgot-password',
      
      views: {
        '': {
          templateUrl: 'app/users/forgot-password.html',
          controller: 'userCtrl'
          
                  
        }
      },
      data: {
        displayName: 'Edit address',
      }
    }).state('admin_category',{
      url: '/admin/category',
      
      views: {
        '': {
          templateUrl: 'app/admin/admin-category.html',
          controller: 'adminCtrl'
          
                  
        }
      },
      data: {
        displayName: 'Admin Items',
      }
    })
    


    ///
    




}).run(function($state) {
  $state.go('home');
});

