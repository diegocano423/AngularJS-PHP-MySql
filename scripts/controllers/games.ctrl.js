maintenance.controller('GamesCtrl', ['$scope', '$location','RequestSrvc', function ($scope, RequestSrvc, $location) {
	$scope.init = function () {
        $scope.game = {
        	title: null,
        	description: null,
        	developer: null,
        	console: null,
        	release: null
        }
	};

	$scope.creteGame = function(){
        RequestSrvc.creteGame({
        	title: $scope.game.title,
        	description: $scope.game.description,
        	developer: $scope.game.developer,
        	console: $scope.game.console,
        	release: $scope.game.release
        }, function (response) {
        	if (response.error) {
        		console.log(response.error);
        	} else {
        		console.log(response.message);
        	}
        }, function (response) {
        	console.log(response.message);
        });
    };

	$scope.init();
}]);