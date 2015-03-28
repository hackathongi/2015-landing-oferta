
var myApp = angular.module('hackathonApp',[]);

myApp.controller('LandingController', ['$scope', '$http', '$location', function($scope, $http, $location) {
  
	/*$scope.job = {};
  
	// Simple GET request example :
	$http.get('https://demo3532506.mockable.io/items').
	  success(function(data, status, headers, config) {
		// this callback will be called asynchronously
		// when the response is available
		$scope.job = data;
	  }).
	  error(function(data, status, headers, config) {
		// called asynchronously if an error occurs
		// or server returns response with an error status.
	  });*/
	  $scope.shared_url = $location.$$absUrl;
}]);
