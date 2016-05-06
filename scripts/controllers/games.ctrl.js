maintenance.controller('GamesCtrl', ['$scope', 'RequestService', '$location', function ($scope, RequestService, $location) {

	$scope.createGame = function(){
        RequestService.create({
        	title: $scope.game.title,
        	description: $scope.game.description,
        	developer: $scope.game.developer,
        	console: $scope.game.console,
        	release: $scope.game.release
        }, function (response) {

            console.log(response);
        	if (response.error) {
        		console.log(response.error);
        	} else {
        		console.log(response.messages);
        	}
        }, function (response) {
        	$scope.error = response.messages;
        });
    };

}]);