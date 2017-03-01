// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'App' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'

// Global Variable
var paramsUrl = "http://localhost/stsv3/excel/vc/v7/advanced/backend/web/index.php";

angular.module('App', ['ionic', 'ngCordova', 'ngAnimate'])

        .run(['$ionicPlatform',
            function ($ionicPlatform) {
                $ionicPlatform.ready(function () {
                    if (window.cordova && window.cordova.plugins.Keyboard) {
                        // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
                        // for form inputs)
                        cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

                        // Don't remove this line unless you know what you are doing. It stops the viewport
                        // from snapping when text inputs are focused. Ionic handles this internally for
                        // a much nicer keyboard experience.
                        cordova.plugins.Keyboard.disableScroll(true);
                    }
                    if (window.StatusBar) {
                        StatusBar.styleDefault();
                    }

                });
            }])
        .config(['$stateProvider',
            '$urlRouterProvider',
            '$ionicConfigProvider',
            '$compileProvider',
            function ($stateProvider, $urlRouterProvider, $ionicConfigProvider, $compileProvider) {

                $compileProvider.imgSrcSanitizationWhitelist(/^\s*(https?|ftp|file|blob|content|ms-appx|x-wmapp0):|data:image\/|img\//);
                $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|file|ghttps?|ms-appx|x-wmapp0):/);

                $ionicConfigProvider.scrolling.jsScrolling(ionic.Platform.isIOS());

                $stateProvider
                        .state('home', {
                            url: "/home",
                            templateUrl: "templates/home.html",
                            controller: 'HomeController'
                        })
                        .state('app', {
                            url: '/app',
                            abstract: true,
                            controller: 'AppController',
                            templateUrl: 'templates/menu.html'
                        })
                        .state('app.gallery', {
                            url: "/gallery",
                            cache: false,
                            views: {
                                viewContent: {
                                    templateUrl: "templates/gallery.html",
                                    controller: 'GalleryController'
                                }
                            }
                        })
                        .state('app.salesreport', {
                            url: "/salesreport/{title}",
                            params: {
                                color: null,
                                icon: null
                            },
                            cache: false,
                            views: {
                                viewContent: {
                                    templateUrl: "templates/salesreport.html",
                                    controller: 'SalesreportController'
                                }
                            }
                        })
                        .state('app.stockreport', {
                            url: "/stockreport/{title}",
                            params: {
                                color: null,
                                icon: null
                            },
                            cache: false,
                            views: {
                                viewContent: {
                                    templateUrl: "templates/stockreport.html",
                                    controller: 'StockreportController'
                                }
                            }
                        })
                        .state('app.salesview', {
                            url: "/salesview/{title}",
                            params: {
                                imei_no: null,
                                color: null,
                                icon: null
                            },
                            cache: false,
                            views: {
                                viewContent: {
                                    templateUrl: "templates/salesview.html",
                                    controller: 'SalesviewController'
                                }
                            }
                        })
                        .state('app.salesadd', {
                            url: "/salesadd/{title}",
                            params: {
                                color: null,
                                icon: null
                            },
                            cache: false,
                            views: {
                                viewContent: {
                                    templateUrl: "templates/salesadd.html",
                                    controller: 'SalesaddController'
                                }
                            }
                        })
                        .state('app.attendanceadd', {
                            url: "/attendanceadd/{title}",
                            params: {
                                color: null,
                                icon: null
                            },
                            cache: false,
                            views: {
                                viewContent: {
                                    templateUrl: "templates/attendanceadd.html",
                                    controller: 'AttendanceaddController'
                                }
                            }
                        })
                        .state('app.stockadd', {
                            url: "/stockadd/{title}",
                            params: {
                                color: null,
                                icon: null
                            },
                            cache: false,
                            views: {
                                viewContent: {
                                    templateUrl: "templates/stockadd.html",
                                    controller: 'StockaddController'
                                }
                            }
                        })
                        .state('app.stockview', {
                            url: "/stockview/{title}",
                            params: {
                                imei_no: null,
                                color: null,
                                icon: null
                            },
                            cache: false,
                            views: {
                                viewContent: {
                                    templateUrl: "templates/stockview.html",
                                    controller: 'StockviewController'
                                }
                            }
                        })
                        .state('app.leaderboard', {
                            url: "/leaderboard/{title}",
                            params: {
                                color: null,
                                icon: null
                            },
                            cache: false,
                            views: {
                                viewContent: {
                                    templateUrl: "templates/leaderboard.html",
                                    controller: 'LeaderboardController'
                                }
                            }
                        })
                        .state('app.leaderboardval', {
                            url: "/leaderboardval/{title}",
                            params: {
                                color: null,
                                icon: null
                            },
                            cache: false,
                            views: {
                                viewContent: {
                                    templateUrl: "templates/leaderboardval.html",
                                    controller: 'LeaderboardvalController'
                                }
                            }
                        })
                        .state('app.item', {
                            url: "/item/{title}",
                            params: {
                                color: null,
                                icon: null
                            },
                            cache: false,
                            views: {
                                viewContent: {
                                    templateUrl: "templates/item.html",
                                    controller: 'ItemController'
                                }
                            }
                        });

                $urlRouterProvider.otherwise(function ($injector, $location) {
                    var $state = $injector.get("$state");
                    $state.go("home");
                });
            }]);

/* global ionic, param */
(function (angular, ionic) {
    "use strict";

    ionic.Platform.isIE = function () {
        return ionic.Platform.ua.toLowerCase().indexOf('trident') > -1;
    }

    if (ionic.Platform.isIE()) {
        angular.module('ionic')
                .factory('$ionicNgClick', ['$parse', '$timeout', function ($parse, $timeout) {
                        return function (scope, element, clickExpr) {
                            var clickHandler = angular.isFunction(clickExpr) ? clickExpr : $parse(clickExpr);

                            element.on('click', function (event) {
                                scope.$apply(function () {
                                    if (scope.clicktimer)
                                        return; // Second call
                                    clickHandler(scope, {$event: (event)});
                                    scope.clicktimer = $timeout(function () {
                                        delete scope.clicktimer;
                                    }, 1, false);
                                });
                            });

                            // Hack for iOS Safari's benefit. It goes searching for onclick handlers and is liable to click
                            // something else nearby.
                            element.onclick = function (event) { };
                        };
                    }]);
    }

    function SelectDirective() {
        'use strict';

        return {
            restrict: 'E',
            replace: false,
            link: function (scope, element) {
                if (ionic.Platform && (ionic.Platform.isWindowsPhone() || ionic.Platform.isIE() || ionic.Platform.platform() === "edge")) {
                    element.attr('data-tap-disabled', 'true');
                }
            }
        };
    }

    angular.module('ionic')
            .directive('select', SelectDirective);

    /*angular.module('ionic-datepicker')
     .directive('select', SelectDirective);*/

})(angular, ionic);

(function () {
    'use strict';

    angular
            .module('App')
            .directive('holdList', holdList);

    holdList.$inject = ['$ionicGesture'];
    function holdList($ionicGesture) {

        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                $ionicGesture.on('hold', function (e) {

                    var content = element[0].querySelector('.item-content');

                    var buttons = element[0].querySelector('.item-options');
                    var buttonsWidth = buttons.offsetWidth;

                    ionic.requestAnimationFrame(function () {
                        content.style[ionic.CSS.TRANSITION] = 'all ease-out .25s';

                        if (!buttons.classList.contains('invisible')) {
                            content.style[ionic.CSS.TRANSFORM] = '';
                            setTimeout(function () {
                                buttons.classList.add('invisible');
                            }, 250);
                        } else {
                            buttons.classList.remove('invisible');
                            content.style[ionic.CSS.TRANSFORM] = 'translate3d(-' + buttonsWidth + 'px, 0, 0)';
                        }
                    });


                }, element);
            }
        };
    }
})();
(function () {
    'use strict';

    angular
            .module('App')
            .directive('ionMultipleSelect', ionMultipleSelect);

    ionMultipleSelect.$inject = ['$ionicModal', '$ionicGesture'];
    function ionMultipleSelect($ionicModal, $ionicGesture) {

        return {
            restrict: 'E',
            scope: {
                options: "="
            },
            controller: function ($scope, $element, $attrs) {
                $scope.multipleSelect = {
                    title: $attrs.title || "Select Options",
                    tempOptions: [],
                    keyProperty: $attrs.keyProperty || "id",
                    valueProperty: $attrs.valueProperty || "value",
                    selectedProperty: $attrs.selectedProperty || "selected",
                    templateUrl: $attrs.templateUrl || 'templates/multipleSelect.html',
                    renderCheckbox: $attrs.renderCheckbox ? $attrs.renderCheckbox == "true" : true,
                    animation: $attrs.animation || 'slide-in-up'
                };

                $scope.OpenModalFromTemplate = function (templateUrl) {
                    $ionicModal.fromTemplateUrl(templateUrl, {
                        scope: $scope,
                        animation: $scope.multipleSelect.animation
                    }).then(function (modal) {
                        $scope.modal = modal;
                        $scope.modal.show();
                    });
                };

                $ionicGesture.on('tap', function (e) {
                    $scope.multipleSelect.tempOptions = $scope.options.map(function (option) {
                        var tempOption = {};
                        tempOption[$scope.multipleSelect.keyProperty] = option[$scope.multipleSelect.keyProperty];
                        tempOption[$scope.multipleSelect.valueProperty] = option[$scope.multipleSelect.valueProperty];
                        tempOption[$scope.multipleSelect.selectedProperty] = option[$scope.multipleSelect.selectedProperty];

                        return tempOption;
                    });
                    $scope.OpenModalFromTemplate($scope.multipleSelect.templateUrl);
                }, $element);

                $scope.saveOptions = function () {
                    for (var i = 0; i < $scope.multipleSelect.tempOptions.length; i++) {
                        var tempOption = $scope.multipleSelect.tempOptions[i];
                        for (var j = 0; j < $scope.options.length; j++) {
                            var option = $scope.options[j];
                            if (tempOption[$scope.multipleSelect.keyProperty] == option[$scope.multipleSelect.keyProperty]) {
                                option[$scope.multipleSelect.selectedProperty] = tempOption[$scope.multipleSelect.selectedProperty];
                                break;
                            }
                        }
                    }
                    $scope.closeModal();
                };

                $scope.closeModal = function () {
                    $scope.modal.remove();
                };
                $scope.$on('$destroy', function () {
                    if ($scope.modal) {
                        $scope.modal.remove();
                    }
                });
            }
        };
    }
})();
(function () {
    'use strict';

    angular
            .module('App')
            .directive('ionSearchSelect', ionSearchSelect);

    ionSearchSelect.$inject = ['$ionicModal', '$ionicGesture'];
    function ionSearchSelect($ionicModal, $ionicGesture) {

        return {
            restrict: 'E',
            scope: {
                options: "=",
                optionSelected: "="
            },
            controller: function ($scope, $element, $attrs) {
                $scope.searchSelect = {
                    title: $attrs.title || "Search",
                    keyProperty: $attrs.keyProperty,
                    valueProperty: $attrs.valueProperty,
                    templateUrl: $attrs.templateUrl || 'templates/searchSelect.html',
                    animation: $attrs.animation || 'slide-in-up',
                    option: null,
                    searchvalue: "",
                    enableSearch: $attrs.enableSearch ? $attrs.enableSearch == "true" : true
                };

                $ionicGesture.on('tap', function (e) {

                    if (!!$scope.searchSelect.keyProperty && !!$scope.searchSelect.valueProperty) {
                        if ($scope.optionSelected) {
                            $scope.searchSelect.option = $scope.optionSelected[$scope.searchSelect.keyProperty];
                        }
                    } else {
                        $scope.searchSelect.option = $scope.optionSelected;
                    }
                    $scope.OpenModalFromTemplate($scope.searchSelect.templateUrl);
                }, $element);

                $scope.saveOption = function () {
                    if (!!$scope.searchSelect.keyProperty && !!$scope.searchSelect.valueProperty) {
                        for (var i = 0; i < $scope.options.length; i++) {
                            var currentOption = $scope.options[i];
                            if (currentOption[$scope.searchSelect.keyProperty] == $scope.searchSelect.option) {
                                $scope.optionSelected = currentOption;
                                break;
                            }
                        }
                    } else {
                        $scope.optionSelected = $scope.searchSelect.option;
                    }
                    $scope.searchSelect.searchvalue = "";
                    $scope.modal.remove();
                };

                $scope.clearSearch = function () {
                    $scope.searchSelect.searchvalue = "";
                };

                $scope.closeModal = function () {
                    $scope.modal.remove();
                };
                $scope.$on('$destroy', function () {
                    if ($scope.modal) {
                        $scope.modal.remove();
                    }
                });

                $scope.OpenModalFromTemplate = function (templateUrl) {
                    $ionicModal.fromTemplateUrl(templateUrl, {
                        scope: $scope,
                        animation: $scope.searchSelect.animation
                    }).then(function (modal) {
                        $scope.modal = modal;
                        $scope.modal.show();
                    });
                };
            }
        };
    }
})();
(function () {
    'use strict';

    angular
            .module('App')
            .controller('AppController', AppController);

    AppController.$inject = ['$scope', '$ionicPopover', '$state'];
    function AppController($scope, $ionicPopover, $state) {

        $scope.name = window.localStorage.getItem('name');
        $scope.employee_id = window.localStorage.getItem('employee_id');
        $scope.designation = window.localStorage.getItem('designation');

        // Box Item
        $scope.box = [
            {
                color: "#002F57",
                icon: "ion-android-checkbox-outline",
                title: "Attendance",
                url: "app.attendanceadd"
            },
            {
                color: "#002F57",
                icon: "ion-calendar",
                title: "MI"
            },
            {
                color: "#002F57",
                icon: "ion-camera",
                title: "Add Sales",
                url: "app.salesadd"
            },
//            {
//                color: "#002F57",
//                icon: "ion-ios-camera-outline",
//                title: "Add Stock",
//                url: "app.stockadd"
//            },
            {
                color: "#002F57",
                icon: "ion-document-text",
                title: "Sales Report",
                url: "app.salesreport"
            },
            {
                color: "#002F57",
                icon: "ion-cube",
                title: "Leaderboard (Vol)",
                url: "app.leaderboard"
            },
            {
                color: "#002F57",
                icon: "ion-cube",
                title: "Leaderboard (Val)",
                url: "app.leaderboardval"
            },
            {
                color: "#002F57",
                icon: "ion-clipboard",
                title: "Stock Report",
                url: "app.stockreport"
            },
            {
                color: "#002F57",
                icon: "ion-ios-grid-view",
                title: "TGT vs ACHV"
            },
            {
                color: "#002F57",
                icon: "ion-ios-bookmarks",
                title: "Taining"
            },
            {
                color: "#002F57",
                icon: "ion-arrow-expand",
                title: "Complain Box"
            }
        ];

        $scope.items = [
            {
                color: "#002F57",
                icon: "ion-android-checkbox-outline",
                title: "Attendance"
            },
            {
                color: "#00a65a",
                icon: "ion-calendar",
                title: "MI"
            },
            {
                color: "#E47500",
                icon: "ion-camera",
                title: "Sales"
            },
            {
                color: "#A3216B",
                icon: "ion-ios-camera-outline",
                title: "Stock"
            },
            {
                color: "#206AA7",
                icon: "ion-document-text",
                title: "Sales Report"
            },
            {
                color: "#AD5CE9",
                icon: "ion-clipboard",
                title: "Stock Report"
            },
            {
                color: "#F8E548",
                icon: "ion-cube",
                title: "Leaderboard"
            },
            {
                color: "#3DBEC9",
                icon: "ion-ios-grid-view",
                title: "TGT vs ACHV"
            },
            {
                color: "#D86B67",
                icon: "ion-ios-bookmarks",
                title: "Taining"
            },
            {
                color: "#5AD863",
                icon: "ion-arrow-expand",
                title: "Complain Box"
            }
        ];

        $scope.exitApp = function () {
            window.localStorage.clear();
            ionic.Platform.exitApp();
            $state.go("home");
        };

        $ionicPopover.fromTemplateUrl('templates/modals/popover.html', {
            scope: $scope
        }).then(function (popover) {
            $scope.popover = popover;
        });

        $scope.openPopover = function ($event) {
            $scope.popover.show($event);
        };

        $scope.$on('$destroy', function () {
            $scope.popover.remove();
        });
    }
})();
(function () {
    'use strict';

    angular
            .module('App')
            .controller('GalleryController', GalleryController);

    GalleryController.$inject = ['$scope', '$state', '$ionicLoading'];
    function GalleryController($scope, $state, $ionicLoading) {

        $scope.showLoading = function () {

            $ionicLoading.show({
                template: '<ion-spinner icon="android"></ion-spinner>',
                showBackdrop: true,
                maxWidth: 500,
            });

        };

        $scope.openItem = function (box) {

            $scope.showLoading();
            $state.go(box.url, {title: box.title, icon: box.icon, color: box.color});

        };

    }
})();

// Add Attendance Controller
(function () {
    'use strict';

    angular
            .module('App')
            // For Clock Start
            .factory('ClockSrv', function ($interval) {
                'use strict';
                var service = {
                    clock: addClock,
                    cancelClock: removeClock
                };

                var clockElts = [];
                var clockTimer = null;
                var cpt = 0;

                function addClock(fn) {
                    var elt = {
                        id: cpt++,
                        fn: fn
                    };
                    clockElts.push(elt);
                    if (clockElts.length === 1) {
                        startClock();
                    }
                    return elt.id;
                }

                function removeClock(id) {
                    for (var i in clockElts) {
                        if (clockElts[i].id === id) {
                            clockElts.splice(i, 1);
                        }
                    }
                    if (clockElts.length === 0) {
                        stopClock();
                    }
                }

                function startClock() {
                    if (clockTimer === null) {
                        clockTimer = $interval(function () {
                            for (var i in clockElts) {
                                clockElts[i].fn();
                            }
                        }, 1000);
                    }
                }

                function stopClock() {
                    if (clockTimer !== null) {
                        $interval.cancel(clockTimer);
                        clockTimer = null;
                    }
                }

                return service;
            })

            .run(function ($rootScope, $filter, ClockSrv) {
                ClockSrv.clock(function () {
                    // console.log($filter('date')(Date.now(), 'yyyy-MM-dd HH:mm:ss')); 
                    $rootScope.clock = $filter('date')(Date.now(), 'dd/MM/yyyy HH:mm:ss');
                });

            })
            // For Clock End
            .controller('AttendanceaddController', AttendanceaddController);

    AttendanceaddController.$inject = ['$scope', '$http', '$stateParams', '$ionicViewSwitcher', '$state', '$ionicHistory', '$ionicLoading', '$ionicScrollDelegate', '$timeout', '$filter', 'ClockSrv'];
    function AttendanceaddController($scope, $http, $stateParams, $ionicViewSwitcher, $state, $ionicHistory, $ionicLoading, $ionicScrollDelegate, $timeout, $filter, ClockSrv) {

        $scope.item = {
            title: $stateParams.title,
            icon: $stateParams.icon,
            color: $stateParams.color
        };

        if (!$scope.item.title) {
            $ionicViewSwitcher.nextDirection('back');
            $ionicHistory.nextViewOptions({
                disableBack: true,
                disableAnimate: true,
                historyRoot: true
            });
            $state.go('app.gallery');
        }

        $scope.showLoading = function () {

            $ionicLoading.show({
                template: '<ion-spinner icon="android"></ion-spinner>',
                showBackdrop: true,
                maxWidth: 500,
            });

        };

        $scope.hideLoading = function () {
            $ionicLoading.hide();
        };

        $scope.doRefresh = function () {

            $scope.hideLoading();

        };

        $scope.doRefresh();

        $scope.choice = {};
        var linkFetchAttendance = paramsUrl + '/appbasic/attendance_fetch';
        $scope.showLoading();
        $http.post(linkFetchAttendance, {employee_id: window.localStorage.getItem("employee_id")}).then(function (res) {

            if (res.data.response == 'Error') {

                $scope.form_in = true;

                $scope.success_message = false;
                $scope.message = res.data.message;
                $scope.error_message = true;


            } else if (res.data.response == 'OUT') {

                $scope.form_in = true;
                $scope.form_out = true;

                $scope.error_message = false;
                $scope.success_message = false;

            }else if (res.data.response == 'DONE') {

                $scope.form_in = true;
                $scope.form_out = false;

                $scope.message = res.data.message;
                $scope.error_message = true;
                $scope.success_message = false;

            } else {

                $scope.form_in = false;

                $scope.error_message = false;
                $scope.success_message = false;

                $scope.attendance_question = res.data;

            }

            $scope.hideLoading();

        });

        $scope.remark = {};
        $scope.showRemark = function (questionId) {

            $scope.remark[questionId] = true;

        };
        $scope.hideRemark = function (questionId) {

            $scope.remark[questionId] = false;

        };

        var linkAddAttendance = paramsUrl + '/appbasic/add_attendance';
        $scope.submit = function () {

            $scope.showLoading();
            $http.post(linkAddAttendance, {employee_id: window.localStorage.getItem("employee_id"), answer: JSON.stringify($scope.choice)}).then(function (res) {

                if (res.data.response == 'Error') {

                    $ionicScrollDelegate.scrollTop();

                    $scope.form_in = false;

                    $scope.success_message = false;
                    $scope.message = res.data.message;
                    $scope.error_message = true;


                } else if (res.data.response == 'Success') {

                    $scope.form_in = true;

                    $scope.error_message = false;
                    $scope.message = res.data.message;
                    $scope.success_message = true;

                }

                $scope.hideLoading();

            });
        };
        
        var linkAddAttendanceOut = paramsUrl + '/appbasic/add_attendance_out';
        $scope.submit_out = function () {

            $scope.showLoading();
            $http.post(linkAddAttendanceOut, {employee_id: window.localStorage.getItem("employee_id")}).then(function (res) {

                if (res.data.response == 'Error') {

                    $scope.form_out = true;

                    $scope.success_message = false;
                    $scope.message = res.data.message;
                    $scope.error_message = true;

                } else if (res.data.response == 'Success') {

                    $scope.form_out = false;

                    $scope.error_message = false;
                    $scope.message = res.data.message;
                    $scope.success_message = true;

                }

                $scope.hideLoading();

            });
        };
    }
})();

(function () {
    'use strict';

    angular
            .module('App')
            .controller('SalesreportController', SalesreportController);

    SalesreportController.$inject = ['$scope', '$http', '$stateParams', '$ionicViewSwitcher', '$state', '$ionicHistory', '$ionicLoading'];
    function SalesreportController($scope, $http, $stateParams, $ionicViewSwitcher, $state, $ionicHistory, $ionicLoading) {

        $scope.item = {
            title: $stateParams.title,
            icon: $stateParams.icon,
            color: $stateParams.color
        };

        if (!$scope.item.title) {
            $ionicViewSwitcher.nextDirection('back');
            $ionicHistory.nextViewOptions({
                disableBack: true,
                disableAnimate: true,
                historyRoot: true
            });
            $state.go('app.gallery');
        }

        $scope.showLoading = function () {

            $ionicLoading.show({
                template: '<ion-spinner icon="android"></ion-spinner>',
                showBackdrop: true,
                maxWidth: 500,
            });

        };

        $scope.hideLoading = function () {
            $ionicLoading.hide();
        };

        $scope.viewSales = function (imei_no) {

            $scope.showLoading();
            $state.go('app.salesview', {title: 'Sales Entry Detail View', icon: 'ion-eye', color: '#002F57', imei_no: imei_no});

        };

        $scope.doRefresh = function () {

            var link = paramsUrl + '/appbasic/sales_report';
            $http.post(link, {employee_id: window.localStorage.getItem('employee_id')}).then(function (res) {

                if (res.data.response == 'Error') {

                    $scope.message = res.data.message;
                    $scope.error_message = true;

                } else {

                    $scope.error_message = false;
                    $scope.sales_model = res.data;

                }

                $scope.hideLoading();

            }).finally(function () {
                // Stop the ion-refresher from spinning
                $scope.$broadcast('scroll.refreshComplete');
            });
        };

        $scope.doRefresh();
    }
})();

// Leaderboard Volume Ranking
(function () {
    'use strict';

    angular
            .module('App')
            .controller('LeaderboardController', LeaderboardController);

    LeaderboardController.$inject = ['$scope', '$http', '$stateParams', '$ionicViewSwitcher', '$state', '$ionicHistory', '$ionicLoading'];
    function LeaderboardController($scope, $http, $stateParams, $ionicViewSwitcher, $state, $ionicHistory, $ionicLoading) {

        $scope.item = {
            title: $stateParams.title,
            icon: $stateParams.icon,
            color: $stateParams.color
        };

        if (!$scope.item.title) {
            $ionicViewSwitcher.nextDirection('back');
            $ionicHistory.nextViewOptions({
                disableBack: true,
                disableAnimate: true,
                historyRoot: true
            });
            $state.go('app.gallery');
        }

        $scope.showLoading = function () {

            $ionicLoading.show({
                template: '<ion-spinner icon="android"></ion-spinner>',
                showBackdrop: true,
                maxWidth: 500,
            });

        };

        $scope.hideLoading = function () {
            $ionicLoading.hide();
        };

        $scope.doRefresh = function () {

            var link = paramsUrl + '/appbasic/leaderboard';
            $http.post(link, {employee_id: window.localStorage.getItem('employee_id')}).then(function (res) {

                if (res.data.response == 'Error') {

                    $scope.message = res.data.message;
                    $scope.error_message = true;

                } else {

                    $scope.error_message = false;
                    $scope.leaderboard = res.data;
                    
                    console.log(res.data);

                }

                $scope.hideLoading();

            }).finally(function () {
                // Stop the ion-refresher from spinning
                $scope.$broadcast('scroll.refreshComplete');
            });
        };

        $scope.doRefresh();
    }
})();

// Leaderboard Value Ranking
(function () {
    'use strict';

    angular
            .module('App')
            .controller('LeaderboardvalController', LeaderboardvalController);

    LeaderboardvalController.$inject = ['$scope', '$http', '$stateParams', '$ionicViewSwitcher', '$state', '$ionicHistory', '$ionicLoading'];
    function LeaderboardvalController($scope, $http, $stateParams, $ionicViewSwitcher, $state, $ionicHistory, $ionicLoading) {

        $scope.item = {
            title: $stateParams.title,
            icon: $stateParams.icon,
            color: $stateParams.color
        };

        if (!$scope.item.title) {
            $ionicViewSwitcher.nextDirection('back');
            $ionicHistory.nextViewOptions({
                disableBack: true,
                disableAnimate: true,
                historyRoot: true
            });
            $state.go('app.gallery');
        }

        $scope.showLoading = function () {

            $ionicLoading.show({
                template: '<ion-spinner icon="android"></ion-spinner>',
                showBackdrop: true,
                maxWidth: 500,
            });

        };

        $scope.hideLoading = function () {
            $ionicLoading.hide();
        };

        $scope.doRefresh = function () {

            var link = paramsUrl + '/appbasic/leaderboard_val';
            $http.post(link, {employee_id: window.localStorage.getItem('employee_id')}).then(function (res) {

                if (res.data.response == 'Error') {

                    $scope.message = res.data.message;
                    $scope.error_message = true;

                } else {

                    $scope.error_message = false;
                    $scope.leaderboard = res.data;
                    
                    console.log(res.data);

                }

                $scope.hideLoading();

            }).finally(function () {
                // Stop the ion-refresher from spinning
                $scope.$broadcast('scroll.refreshComplete');
            });
        };

        $scope.doRefresh();
    }
})();

(function () {
    'use strict';

    angular
            .module('App')
            .controller('StockreportController', StockreportController);

    StockreportController.$inject = ['$scope', '$http', '$stateParams', '$ionicViewSwitcher', '$state', '$ionicHistory', '$ionicLoading'];
    function StockreportController($scope, $http, $stateParams, $ionicViewSwitcher, $state, $ionicHistory, $ionicLoading) {

        $scope.item = {
            title: $stateParams.title,
            icon: $stateParams.icon,
            color: $stateParams.color
        };

        if (!$scope.item.title) {
            $ionicViewSwitcher.nextDirection('back');
            $ionicHistory.nextViewOptions({
                disableBack: true,
                disableAnimate: true,
                historyRoot: true
            });
            $state.go('app.gallery');
        }

        $scope.showLoading = function () {

            $ionicLoading.show({
                template: '<ion-spinner icon="android"></ion-spinner>',
                showBackdrop: true,
                maxWidth: 500,
            });

        };

        $scope.hideLoading = function () {
            $ionicLoading.hide();
        };

        $scope.viewStock = function (imei_no) {

            $scope.showLoading();
            $state.go('app.stockview', {title: 'Stock Entry Detail View', icon: 'ion-eye', color: '#002F57', imei_no: imei_no});

        };

        $scope.doRefresh = function () {

            var link = paramsUrl + '/appbasic/stock_report';
            $http.post(link, {employee_id: window.localStorage.getItem('employee_id')}).then(function (res) {

                if (res.data.response == 'Error') {

                    $scope.message = res.data.message;
                    $scope.error_message = true;

                } else {

                    $scope.error_message = false;
                    $scope.stock_model = res.data;

                }

                $scope.hideLoading();

            }).finally(function () {
                // Stop the ion-refresher from spinning
                $scope.$broadcast('scroll.refreshComplete');
            });
        };

        $scope.doRefresh();
    }
})();

(function () {
    'use strict';

    angular
            .module('App')
            .controller('SalesviewController', SalesviewController);

    SalesviewController.$inject = ['$scope', '$http', '$stateParams', '$ionicViewSwitcher', '$state', '$ionicHistory', '$ionicLoading'];
    function SalesviewController($scope, $http, $stateParams, $ionicViewSwitcher, $state, $ionicHistory, $ionicLoading) {

        $scope.item = {
            title: $stateParams.title,
            icon: $stateParams.icon,
            color: $stateParams.color,
            imei_no: $stateParams.imei_no
        };

        if (!$scope.item.imei_no) {
            $ionicViewSwitcher.nextDirection('back');
            $ionicHistory.nextViewOptions({
                disableBack: true,
                disableAnimate: true,
                historyRoot: true
            });
            $state.go('app.gallery');
        }

        $scope.showLoading = function () {

            $ionicLoading.show({
                template: '<ion-spinner icon="android"></ion-spinner>',
                showBackdrop: true,
                maxWidth: 500,
            });

        };

        $scope.hideLoading = function () {
            $ionicLoading.hide();
        };

        $scope.doRefresh = function () {

            var link = paramsUrl + '/appbasic/sales_view';
            $http.post(link, {imei_no: $scope.item.imei_no}).then(function (res) {

                if (res.data.response == 'Error') {

                    $scope.message = res.data.message;
                    $scope.error_message = true;

                } else {

                    $scope.error_message = false;
                    $scope.sales_model = res.data;

                }

                $scope.hideLoading();

            }).finally(function () {
                // Stop the ion-refresher from spinning
                $scope.$broadcast('scroll.refreshComplete');
            });
        };

        $scope.doRefresh();
    }
})();

// Add Sales Controller
(function () {
    'use strict';

    angular
            .module('App')
            .controller('SalesaddController', SalesaddController);

    SalesaddController.$inject = ['$scope', '$http', '$stateParams', '$ionicViewSwitcher', '$state', '$ionicHistory', '$ionicLoading', '$cordovaBarcodeScanner'];
    function SalesaddController($scope, $http, $stateParams, $ionicViewSwitcher, $state, $ionicHistory, $ionicLoading, $cordovaBarcodeScanner) {

        $scope.item = {
            title: $stateParams.title,
            icon: $stateParams.icon,
            color: $stateParams.color
        };

        if (!$scope.item.title) {
            $ionicViewSwitcher.nextDirection('back');
            $ionicHistory.nextViewOptions({
                disableBack: true,
                disableAnimate: true,
                historyRoot: true
            });
            $state.go('app.gallery');
        }

        $scope.showLoading = function () {

            $ionicLoading.show({
                template: '<ion-spinner icon="android"></ion-spinner>',
                showBackdrop: true,
                maxWidth: 500,
            });

        };

        $scope.hideLoading = function () {
            $ionicLoading.hide();
        };

        $scope.scanBarcode = function () {
            $cordovaBarcodeScanner.scan().then(function (barcodeData) {

                var barcodeText = barcodeData.text;

                if (barcodeText.length === 15) {

                    $scope.showLoading();

                    $scope.error_message = false;
                    $scope.imei_no = barcodeText;

                    var linkStockFetch = paramsUrl + '/appbasic/stock_fetch';
                    $http.post(linkStockFetch, {imei_no: $scope.imei_no, employee_id: window.localStorage.getItem("employee_id")}).then(function (res) {

                        if (res.data.response == 'Error') {

                            $scope.stock_item = false;

                            $scope.message = res.data.message;
                            $scope.error_message = true;

                            $scope.scanned_imei = true;

                        } else {

                            $scope.error_message = false;

                            $scope.scanned_imei = false;

                            $scope.stock_item = true;
                            $scope.stock_model = res.data;
                            $scope.stock_imei_no = res.data.imei_no;

                        }

                        $scope.hideLoading();

                    }).finally(function () {
                        // Stop the ion-refresher from spinning
                        $scope.$broadcast('scroll.refreshComplete');
                    });


                } else {

                    $scope.stock_item = false;
                    $scope.message = 'Please scan the correct barcode.';
                    $scope.error_message = true;

                }

                //console.log("Barcode Format -> " + imageData.format);
                //console.log("Cancelled -> " + imageData.cancelled);
            }, function (error) {

                alert("An error occured -> " + error);

            });
        };

        $scope.doRefresh = function () {

            $scope.hideLoading();

        };

        $scope.doRefresh();

        var linkAddSales = paramsUrl + '/appbasic/add_sales';
        $scope.submit = function () {

            $scope.showLoading();
            $http.post(linkAddSales, {imei_no: $scope.stock_imei_no, employee_id: window.localStorage.getItem("employee_id")}).then(function (res) {

                if (res.data.response == 'Error') {

                    $scope.stock_item = false;

                    $scope.success_message = false;
                    $scope.message = res.data.message;
                    $scope.error_message = true;

                    $scope.scanned_imei = false;

                } else if (res.data.response == 'Success') {

                    $scope.stock_item = false;

                    $scope.error_message = false;
                    $scope.message = res.data.message;
                    $scope.success_message = true;

                    $scope.scanned_imei = false;

                }

                $scope.hideLoading();

            });
        };
    }
})();

// Add Stock Controller
(function () {
    'use strict';

    angular
            .module('App')
            .controller('StockaddController', StockaddController);

    StockaddController.$inject = ['$scope', '$http', '$stateParams', '$ionicViewSwitcher', '$state', '$ionicHistory', '$ionicLoading', '$cordovaBarcodeScanner'];
    function StockaddController($scope, $http, $stateParams, $ionicViewSwitcher, $state, $ionicHistory, $ionicLoading, $cordovaBarcodeScanner) {

        $scope.item = {
            title: $stateParams.title,
            icon: $stateParams.icon,
            color: $stateParams.color
        };

        if (!$scope.item.title) {
            $ionicViewSwitcher.nextDirection('back');
            $ionicHistory.nextViewOptions({
                disableBack: true,
                disableAnimate: true,
                historyRoot: true
            });
            $state.go('app.gallery');
        }

        $scope.showLoading = function () {

            $ionicLoading.show({
                template: '<ion-spinner icon="android"></ion-spinner>',
                showBackdrop: true,
                maxWidth: 500,
            });

        };

        $scope.hideLoading = function () {
            $ionicLoading.hide();
        };

        $scope.scanBarcode = function () {
            $cordovaBarcodeScanner.scan().then(function (barcodeData) {

                var barcodeText = barcodeData.text;

                if (barcodeText.length === 15) {

                    $scope.showLoading();

                    $scope.error_message = false;
                    $scope.imei_no = barcodeText;

                    var linkInventoryFetch = paramsUrl + '/appbasic/inventory_fetch';
                    $http.post(linkInventoryFetch, {imei_no: $scope.imei_no, employee_id: window.localStorage.getItem("employee_id")}).then(function (res) {

                        if (res.data.response == 'Error') {

                            $scope.inventory_item = false;

                            $scope.message = res.data.message;
                            $scope.error_message = true;

                            $scope.scanned_imei = true;

                        } else {

                            $scope.error_message = false;

                            $scope.scanned_imei = false;

                            $scope.inventory_item = true;
                            $scope.inventory_model = res.data;
                            $scope.inventory_imei_no = res.data.imei_no;

                        }

                        $scope.hideLoading();

                    }).finally(function () {
                        // Stop the ion-refresher from spinning
                        $scope.$broadcast('scroll.refreshComplete');
                    });


                } else {

                    $scope.inventory_item = false;
                    $scope.message = 'Please scan the correct barcode.';
                    $scope.error_message = true;

                }

                //console.log("Barcode Format -> " + imageData.format);
                //console.log("Cancelled -> " + imageData.cancelled);

            }, function (error) {

                alert("An error occured -> " + error);

            });
        };

        $scope.doRefresh = function () {

            $scope.hideLoading();

        };

        $scope.doRefresh();
        $scope.inventory_item = true;
        var linkAddStock = paramsUrl + '/appbasic/add_stock';
        $scope.submit = function () {

            $scope.showLoading();
            $http.post(linkAddStock, {imei_no: '442525525551514', employee_id: window.localStorage.getItem("employee_id")}).then(function (res) {

                if (res.data.response == 'Error') {

                    $scope.stock_item = false;

                    $scope.success_message = false;
                    $scope.message = res.data.message;
                    $scope.error_message = true;

                    $scope.scanned_imei = false;

                } else if (res.data.response == 'Success') {

                    $scope.stock_item = false;

                    $scope.error_message = false;
                    $scope.message = res.data.message;
                    $scope.success_message = true;

                    $scope.scanned_imei = false;

                }

                $scope.hideLoading();

            });
        };
    }
})();

(function () {
    'use strict';

    angular
            .module('App')
            .controller('StockviewController', StockviewController);

    StockviewController.$inject = ['$scope', '$http', '$stateParams', '$ionicViewSwitcher', '$state', '$ionicHistory', '$ionicLoading'];
    function StockviewController($scope, $http, $stateParams, $ionicViewSwitcher, $state, $ionicHistory, $ionicLoading) {

        $scope.item = {
            title: $stateParams.title,
            icon: $stateParams.icon,
            color: $stateParams.color,
            imei_no: $stateParams.imei_no
        };

        if (!$scope.item.imei_no) {
            $ionicViewSwitcher.nextDirection('back');
            $ionicHistory.nextViewOptions({
                disableBack: true,
                disableAnimate: true,
                historyRoot: true
            });
            $state.go('app.gallery');
        }

        $scope.showLoading = function () {

            $ionicLoading.show({
                template: '<ion-spinner icon="android"></ion-spinner>',
                showBackdrop: true,
                maxWidth: 500,
            });

        };

        $scope.hideLoading = function () {
            $ionicLoading.hide();
        };

        $scope.doRefresh = function () {

            var link = paramsUrl + '/appbasic/stock_view';
            $http.post(link, {imei_no: $scope.item.imei_no}).then(function (res) {

                if (res.data.response == 'Error') {

                    $scope.message = res.data.message;
                    $scope.error_message = true;

                } else {

                    $scope.error_message = false;
                    $scope.stock_model = res.data;

                }

                $scope.hideLoading();

            }).finally(function () {
                // Stop the ion-refresher from spinning
                $scope.$broadcast('scroll.refreshComplete');
            });
        };

        $scope.doRefresh();
    }
})();

// Home Controller
(function () {
    'use strict';

    angular
            .module('App')
            .controller('HomeController', HomeController);

    HomeController.$inject = ['$scope', '$http', '$ionicPopup', '$ionicLoading', '$state'];
    function HomeController($scope, $http, $ionicPopup, $ionicLoading, $state) {

        if (window.localStorage.getItem("hrId") != undefined) {
            $state.go('app.gallery');
        }

        console.log(window.localStorage.getItem("hrId"));

        $scope.data = {};

        $scope.showAlert = function (message) {

            var alertPopup = $ionicPopup.alert({
                title: 'Error',
                template: message
            });

        };

        $scope.showLoading = function (message) {

            $ionicLoading.show({
                template: '<ion-spinner icon="android"></ion-spinner>',
                showBackdrop: true,
                maxWidth: 500,
                duration: 2000
            });

        };

        var link = paramsUrl + '/appbasic/login';
        $scope.submit = function () {

            $http.post(link, {username: $scope.data.username, password: $scope.data.password}).then(function (res) {

                if (res.data.response == 'Error') {

                    $scope.showAlert(res.data.message);

                } else {

                    $scope.showLoading();

                    window.localStorage.setItem('hrId', res.data.hrId);
                    window.localStorage.setItem('name', res.data.name);
                    window.localStorage.setItem('employee_id', res.data.employee_id);
                    window.localStorage.setItem('designation', res.data.designation);
                    window.localStorage.setItem('userRole', res.data.userRole);
                    window.localStorage.setItem('joining_date', res.data.joining_date);
                    window.localStorage.setItem('image_web_filename', res.data.image_web_filename);

                    $state.go('app.gallery');

                }

            });
        };
    }
})();
(function () {
    'use strict';

    angular
            .module('App')
            .controller('ItemController', ItemController);

    ItemController.$inject = ['$scope', '$stateParams', '$ionicViewSwitcher', '$state', '$ionicHistory'];
    function ItemController($scope, $stateParams, $ionicViewSwitcher, $state, $ionicHistory) {

        $scope.item = {
            title: $stateParams.title,
            icon: $stateParams.icon,
            color: $stateParams.color
        };

        if (!$scope.item.color) {
            $ionicViewSwitcher.nextDirection('back');
            $ionicHistory.nextViewOptions({
                disableBack: true,
                disableAnimate: true,
                historyRoot: true
            });
            $state.go('app.gallery');
        }
    }
})();
(function () {
    'use strict';

    angular
            .module('App')
            .factory('Modals', Modals);

    Modals.$inject = ['$ionicModal'];
    function Modals($ionicModal) {

        var modals = [];

        var _openModal = function ($scope, templateUrl, animation) {
            return $ionicModal.fromTemplateUrl(templateUrl, {
                scope: $scope,
                animation: animation || 'slide-in-up',
                backdropClickToClose: false
            }).then(function (modal) {
                modals.push(modal);
                modal.show();
            });
        };

        var _closeModal = function () {
            var currentModal = modals.splice(-1, 1)[0];
            currentModal.remove();
        };

        var _closeAllModals = function () {
            modals.map(function (modal) {
                modal.remove();
            });
            modals = [];
        };

        return {
            openModal: _openModal,
            closeModal: _closeModal,
            closeAllModals: _closeAllModals
        };
    }
})();