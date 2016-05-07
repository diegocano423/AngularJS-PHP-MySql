maintenance.controller('DetailCtrl', ['$scope', 'RequestService', '$location', '$routeParams', function ($scope, RequestService, $location, $routeParams) {

    RequestService.getOne($routeParams.title).then(function (response) {
        $scope.singleGame = response.data[0];
        console.log($scope.singleGame);
	});

    console.log($routeParams.title);

}]);