'use strict';

gestionBudget.factory('donneesBudgetService', function ($http, $q) {
    var factory = {
        donneesBudget : false,
        getDonneesBudget : function () {
            var  deferred = $q.defer();
            if (factory.donneesBudget !== false) {
                deferred.resolve(factory.donneesBudget);
            }
            else {
                $http.get(Routing.generate('all_donneesbudget'))
                    .then(function (data, status) {
                        factory.donneesBudget = data;
                        deferred.resolve(factory.donneesBudget);
                    },(function (data, status) {
                        deferred.reject('impossible de recuperer les donnees');
                    }));
            }
            return deferred.promise ;
        },
        setDonnesBudgets : function (donnees) {
            var  deferred = $q.defer();
            $http.post(Routing.generate('edit_donneesbudget'), donnees)
                .then(function (data,status) {
                    factory.donneesBudget = data;
                    deferred.resolve(factory.donneesBudget);
                },(function (data) {
                    deferred.reject('impossible de recuperer les donnees')
                }));
            return deferred.promise ;
        }
    };
    return factory;
});
