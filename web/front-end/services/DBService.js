'use strict';

gestionBudget.factory('donneesBudgetService', function ($http, $q) {
    var factory = {
        donneesBudget : false,
        chapitre: false,
        getDonneesBudget : function () {
            var  deferred = $q.defer();
            if (factory.donneesBudget !== false) {
                deferred.resolve(factory.donneesBudget);
            }
            else {
                $http.get('/donneesbudget/allDonneesBudget')
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
            $http.post('/donneesbudget/editDonneeBudget', donnees, { headers : {'Content-Type': 'application/json'}})
                .then(function (data,status) {
                    factory.donneesBudget = data;
                    deferred.resolve(factory.donneesBudget);
                },(function (data) {
                    deferred.reject('impossible de recuperer les donnees')
                }));
            return deferred.promise ;
        }
        // getChapitre : function () {
        //     var  deferred = $q.defer();
        //     if (factory.chapitre !== false) {
        //         deferred.resolve(factory.chapitre);
        //     }
        //     else {
        //         $http.get('/chapitre/allDonneesBudget')
        //             .then(function (data, status) {
        //                 factory.chapitre = data;
        //                 deferred.resolve(factory.chapitre);
        //             },(function (data, status) {
        //                 deferred.reject('impossible de recuperer les donnees');
        //             }));
        //     }
        // }
    };
    return factory;
});
