angular.module('RappiApp', [])
   .controller('RappiController', function($scope,$http) {
       $scope.AppName = "Rappi";
       $scope.logs = [];
       $scope.input = '';

       $validators = [{
       	regex: '^[0-9]{1}$',
       	desc:"number of test-cases"
       },
       {
       	regex: '^[0-9]{1}[" "][0-9]{1}',
       	desc:"matrix size and operations numbers"
       },
       {
       	regex: '^(UPDATE )[0-9]{1}[" "][0-9]{1}[" "][0-9]{1}[" "][0-9]{1}',
       	desc:"Update"
       },
       {
       	regex: '^(QUERY )[0-9]{1}[" "][0-9]{1}[" "][0-9]{1}[" "][0-9]{1}[" "][0-9]{1}[" "][0-9]{1}',
       	desc:"Query"
       }];

       $scope.step = 0;
       $scope.maxQuerys = null;
       $scope.querys = 0;
       $scope.iteration = 0;

       $scope.submit = function() {

       	$scope.logs.push({message:$scope.input,class:'terminal--input'});
       	$scope.disabled = true;

       	if ($scope.maxQuerys != 0 && $scope.maxQuerys == $scope.querys) {
       		$scope.querys = 0;
       		$scope.maxQuerys = 0;
       		if ($scope.iterationSize==  $scope.iteration) {
       			$scope.step = 0
       		}else{
       			$scope.step = 1
       		}
       	}

       	if ($scope.step == 0) {
       		 regex = new RegExp($validators[0].regex);
       		 if (regex.test($scope.input)) {
       			$scope.iterationSize = parseInt($scope.input);
       		 	$scope.submitSizeTest(parseInt($scope.input));
       		 }else{
       		 	$scope.logError($validators[0].desc);
       		 }
       	}else if ($scope.step == 1)
       	{
       		$scope.iteration ++;
       		 regex = new RegExp($validators[1].regex);
       		 if (regex.test($scope.input)) {
       		 	var data = $scope.input.split(" ");
       		 	$scope.maxQuerys = parseInt(data[1]);
       		 	$scope.CreateMatrix(parseInt(data[0]),parseInt(data[1]));
       		 }else{
       			$scope.logError($validators[1].desc);
       		 }
       	}else
       	{	
       		 regex1 = new RegExp($validators[2].regex);
       		 regex2 = new RegExp($validators[3].regex);
       		 var data = $scope.input.split(" ");
       		 if (regex1.test($scope.input)) {
				$scope.setQuery("UPDATE",data[1],data[2],data[3],data[4]);
       		 }else if (regex2.test($scope.input)) {
				$scope.setQuery("QUERY",[data[1],data[4]],[data[2],data[5]],[data[3],data[6]]);
       		 }else{
       			$scope.logError($validators[2].desc + ' or ' +  $validators[3].desc);
       		 }
       	}
       	$scope.input = '';
       }
       	$scope.logError = function(message) {
       			$scope.logs.push({message:'expected: ' +  message,class:'terminal--output'});
       			$scope.disabled = false;
       	}
       $scope.submitSizeTest = function(size) {
       	$http.post('/public/index.php/CreateTestCases', {size:size}).then(function(response) {
       		$scope.disabled = false;
       		$scope.logs.push({message:$scope.input,class:'terminal--output'});
       		$scope.step ++;
       	}, console.log);
       }
       $scope.CreateMatrix = function(size,operations) {
       	$http.post('/public/index.php/CreateMatrix', {size:size,operations:operations}).then(function(response) {
       		$scope.disabled = false;
       		$scope.logs.push({message:$scope.input,class:'terminal--output'});
       		$scope.step ++;
       	}, console.log);
       }


       $scope.setQuery = function(query,x,y,z,value) {
       	var dataPost = {
       		query : query,
       		x:x,
       		y:y,
       		z,z,
       		value
       	};
       	$scope.step ++;
       	$scope.querys ++;
       	$http.post('/public/index.php/executeQuery', dataPost).then(function(response) {
       		$scope.disabled = false;
       		$scope.logs.push({message:response.data,class:'terminal--output'});
       	}, console.log);
       }


});