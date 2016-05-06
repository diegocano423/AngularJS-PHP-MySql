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
                            console.debug('create.servicio: error');
                            error(response.data);
                        } else {
                            console.debug('crear.servicio: success');
                            success(response.data[0]);
                        }
                    }, function(response) {
                        console.debug('crear.servicio: error');
                        error(response.data);
                    });
                }
            },

            edit: function (){
                var route = url + backEnd + 'edit';

            },

            delete: function (){

            },

            getOne: function (){

            },

            getAll: function(){

            }
        };

    	return serviceFunctions;

    }]);