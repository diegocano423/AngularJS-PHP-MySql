var maintenance = angular.module('maintenance', ['ngRoute', 'maintenance.service'])

maintenance.config(["$routeProvider", "$locationProvider", function ($routeProvider, $locationProvider) {
    $routeProvider
    .when("/", {
        templateUrl: "partials/front.html",
        controller: "GamesCtrl",
        controllerAs: "games"
    })

    $locationProvider.html5Mode({
      enabled: true,
      requireBase: false
    });
}]);