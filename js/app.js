
var myApp = angular.module('hackathonApp',[]);

myApp.controller('LandingController', ['$scope', '$http', function($scope, $http) {
  $scope.greeting = 'Hola!';
  
  $scope.items = [1,2,3,4];
}]);
