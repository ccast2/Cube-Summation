angular.module('RappiApp', [])
   .controller('RappiController', function($scope) {
       $scope.AppName = "Rappi";
       $scope.logs = [];
       $scope.input = '';

       $scope.submit = function() {
       	$scope.logs.push({message:$scope.input,class:'terminal--input'});
       	$scope.logs.push({message:$scope.input,class:'terminal--output'});
       	$scope.input = '';

       }
});