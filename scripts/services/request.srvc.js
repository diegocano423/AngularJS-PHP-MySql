angular.module('maintenance.service', [])
    .service('RequestService', ['$http' , '$location', function ($http, $location) {
        var url = $location.absUrl(),
    		backEnd = 'back-end/game/';

        var serviceFunctions = {
            create: function (game, success, error){
                var route = url + backEnd + 'create';
                data = {
                    title: game.title,
                    description: game.description,
                    developer: game.developer,
                    console: game.console,
                    release: game.release
                };

                if (data) {
                    return $http.post(route, data).then(function(response){
                        if (response.data.error) {
                            console.debug('create: error');
                            error(response.data);
                        } else {
                            console.debug('crear: success');
                            success(response.data[0]);
                        }
                    }, function(response) {
                        console.debug('crear: error');
                        error(response.data);
                    });
                }
            },

            edit: function (game, success, error){
                var route = url + backEnd + 'edit';
                data = {
                    title: game.title,
                    description: game.description,
                    developer: game.developer,
                    console: game.console, 
                    release: game.release
                }

                if (data) {
                    return $http.put(route, data).then(function(response) {
                        if (response.data.error) {
                            console.debug('edit: error');
                            error(response.data);
                        } else {
                            console.debug('edit: success');
                            success(response.data);
                        }
                    }, function(response) {
                        console.debug('edit: error');
                        error(response.data);
                    });
                }
            },

            delete: function (){

            },

            getOne: function (){

            },

            getAll: function(){
                var route = url + backEnd + 'getAll';
                data = {};
                return $http.get(route, data).then(function(response) {
                    if (response.error) {
                        console.debug('get: error');
                    } else {
                        console.debug('get: success');
                        data = response.data;
                    }
                }); 
            }
        };

    	return serviceFunctions;

    }]);