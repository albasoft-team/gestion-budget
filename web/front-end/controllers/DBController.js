'use strict';

gestionBudget.controller('donneesBudget',['$scope','donneesBudgetService', function ($scope, donneesBudgetService) {

        $scope.allDonnessBudget = donneesBudgetService.getDonneesBudget()
            .then(function (donnesBudgets) {
                $scope.allDonnessBudget = JSON.parse(donnesBudgets.data);
                console.log($scope.allDonnessBudget);
            }, function (msg) {
                alert(msg);
            });
    $scope.saveDonneeBudget = function(data, id) {
        angular.extend(data, {id: id});
       // return donneesBudgetService.setDonnesBudgets(data);
        $scope.allDonnessBudget = donneesBudgetService.setDonnesBudgets(data)
            .then(function (dataBudgets) {
                $scope.allDonnessBudget = JSON.parse(dataBudgets.data);
                console.log($scope.allDonnessBudget);
            }, function (msg) {
                alert(msg);
            })
    };
}]);
