maintenance.controller('DetailCtrl', ['$scope', 'RequestService', '$location', '$routeParams', function ($scope, RequestService, $location, $routeParams) {

    var gameTitle = $routeParams.title;

    RequestService.getOne(gameTitle).then(function (response) {
        $scope.singleGame = response.data[0];
    });

    $scope.deleteGame = function(){
        RequestService.delete(gameTitle).then(function (response) {
            $location.path('/');
        });
    };

    $scope.startEdition = function(){
        $scope.editForm = true;
    };

    $scope.editGame = function(){
        RequestService.edit({
            title: $scope.singleGame.title,
            description: $scope.singleGame.description,
            developer: $scope.singleGame.developer,
            console: $scope.singleGame.console,
            release: $scope.singleGame.release
        }, function (response) {
            console.log(response);
            if (response.error) {
                console.log(response.error);
            } else {
                console.log(response.messages);
                $scope.editForm = false;
            }
        }, function (response) {
            $scope.error = response.messages;
        });
    };
}]);