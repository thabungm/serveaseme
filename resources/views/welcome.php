<!DOCTYPE html>

<html >
    <head>
        <title>ServEaseMe</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

        <script src="/js/laundry-book.js"></script>
        

        

    </head>
    <body ng-app="laundryModule">
    
        <div class="container">
            <div ng-controller="laundryController" class="content">
                <div class="address">
                    <form id="RegForm1" name="RegForm1" method="post"  enctype="multipart/form-data" onSubmit="return CheckRegister();">
                            <div class="col-md-7 col-md-22">
                            <div class="form-group">
                                <input type="text" name="name" ng-model="booking.name" class="form-control" placeholder="Name" maxlength="40" />
                            </div>
                            <div class="form-group">
                                <select name="area" ng-model="booking.area" class="form-control">
                                    <option value="">Area For Pickup</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" ng-model='booking.phone' name="phone" class="form-control" placeholder="Mobile Number" maxlength="40" />
                            </div>
                            <div class="form-group">
                            <textarea ng-model='booking.textarea' name="address" rows="4" cols="5" placeholder=" Pickup Address"  class="form-control form-control2">
        }
</textarea><!--                                <input type="text" name="address" class="form-control form-control2" placeholder="Pickup Address" </maxlength="100" />
 -->                            </div>
                            <div class="form-group form-control3">
                                <input type="text" ng-model='booking.email' name="email" class="form-control" placeholder="E-mail Id" maxlength="40" />
                            </div>
                            </div>
                            <div class="col-md-1">
                            <div class="form-group">
                                <input ng-model='booking.landmark' type="text" name="landmark" class="form-control" placeholder="Landmark" maxlength="40" />
                            </div>
                            <div class="form-group">
                                <input id="datepicker" ng-model='booking.booking_date' name="datepicker" class="form-control" placeholder="Pickup Date" maxlength="40" />
                            </div>
                            <div class="form-group">
                                <select ng-model='booking.pickup_time' name="p_time" class="form-control">
                                    <option value="">Time For Pickup</option>
                                    <option value="10am-11am">10am-11am</option>
                                    <option value="11am-12pm">11am-12pm</option>
                                    <option value="12pm-1pm">12pm-1pm</option>
                                    <option value="1pm-2pm">1pm-2pm</option>
                                    <option value="2pm-3pm">2pm-3pm</option>
                                    <option value="3pm-4pm">3pm-4pm</option>
                                    <option value="4pm-5pm">4pm-5pm</option>
                                    <option value="5pm-6pm">5pm-6pm</option>
                                    <option value="6pm-7pm">6pm-7pm</option>
                                    <option value="7pm-8pm">7pm-8pm</option>
                                    <option value="8pm-9pm">8pm-9pm</option>
                                </select>
                            </div>
                            </div>
                            <button type="submit" name="Submit" class="btn btn-orange2 pull-right">BOOK YOUR PICKUP</button>
                        </form>

                </div>
            </div>
        </div>
    </body>
</html>
