'use strict';

gestionBudget.controller('donneesBudget',['$scope','donneesBudgetService', function ($scope, donneesBudgetService) {

    $scope.initialise = function () {
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
    }

    $(document).on('change', 'input:radio[id^="chkcommune"]', function (event) {
        $('#dvcommune').show();
    });
    $(document).on('change', 'input:radio[id^="radioStacked1"]', function (event) {
        $('#dvcommune').hide();
    });
    //
    // $('#chkcommune').on('click', function () {
    //
    //    if( $('#chkcommune').is(':checked') )
    //
    //    {
    //        console.log('ici');
    //        $('#dvcommune').show();
    //    }
    // })
    // $('#radioStacked1').on('click', function () {
    //
    //    if( $('#radioStacked1').is(':checked') )
    //    {
    //        $('#dvcommune').hide();
    //    }
    // })

}]);
