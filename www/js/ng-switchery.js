'use strict';

/**
 * Module to use Switchery as a directive for angular.
 * @TODO implement Switchery as a service, https://github.com/abpetkov/switchery/pull/11
 */
angular.module('NgSwitchery', [])
    .directive('uiSwitch', ['$window', '$timeout', function($window, $timeout) {

        /**
         * Initializes the HTML element as a Switchery switch.
         *
         * @TODO add a way to provide options for Switchery
         * $timeout is in place as a workaround to work within angular-ui tabs.
         *
         * @param scope
         * @param elem
         * @param attrs
         */
        function linkSwitchery(scope, elem, attrs) {
            $timeout(function() {
                var init = new $window.Switchery(elem[0]);
                if (attrs.ngModel) {
                	/*console.log("ANONYMOUS = " + scope.user.anonymous);
                	console.log(attrs);
                	console.log(scope);
                	console.log(elem);
                	//init.setPosition(scope.user.anonymous == true ? true : false);*/
                	
                    scope.$watch(attrs.ngModel, function() {
                        init.setPosition(false);
                    });
					
                }
                
                scope.user.anonymous = scope.user.anonymous == true ? true : false;
            }, 0);
            
            elem.on('change', function () {
            	//console.log(attrs.ngModel);
            	eval("scope." + attrs.ngModel + " = !scope." + attrs.ngModel);
            	//console.log(eval("scope." + attrs.ngModel));
            	/*
                   attrs.ngModel = !attrs.ngModel;
				   console.log(attrs.ngModel);
				   //console.log(eval("scope." + attrs.ngModel));
				   scope[attrs.ngModel] = "TEST";
				*/
				
				  // console.log(scope[attrs.ngModel]);
                });
        }
        return {
            restrict: 'AE',
            link: linkSwitchery
        }
    }]);



/**
 * Module to use Switchery as a directive for angular.
 * @TODO implement Switchery as a service, https://github.com/abpetkov/switchery/pull/11
 */
 /*
angular.module('NgSwitchery', [])
    .directive('uiSwitch', ['$window', '$timeout', '$parse',
        function ($window, $timeout, $parse) {

            /**
             * Initializes the HTML element as a Switchery switch.
             *
             * @TODO add a way to provide options for Switchery
             * $timeout is in place as a workaround to work within angular-ui tabs.
             * setTimeout is in place as a workaround to work within angular-ui tabs.
             *
             * @param scope
             * @param elem
             * @param attrs
             */
             
           // var template = '<input ng-model="switcheryVar" />';
             /*
            function linkSwitchery(scope, elem, attrs) {

                var options;
                try {
                    options = $parse(attrs.uiSwitch)(scope);
                }
                catch (e) {
                    options = {};
                }

                $timeout(function() {
	                var init = new $window.Switchery(elem[0]);
	                if (attrs.ngModel) {
	                    scope.$watch(attrs.ngModel, function() {
	                        init.setPosition(false);
	                    });
	                }
	            }, 0);

                elem.on('change', function () {
                    scope.$apply(function () {
                        scope.switcheryVar = elem[0].checked;
                    });
                });
            }

            return {
                restrict: 'AE',
                link: linkSwitchery,
      //          template: template,
                replace: true,
                scope: {
                    switcheryVar: '='
                }
            };
        }
    ]);*/