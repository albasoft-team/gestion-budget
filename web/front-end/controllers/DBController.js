'use strict';

gestionBudget.controller('donneesBudget',['$scope','donneesBudgetService', 'NgTableParams', function ($scope, donneesBudgetService, NgTableParams) {
    $scope.allDonneesBudget = [];

    $scope.initialise = function () {
        $scope.allDonnessBudget = donneesBudgetService.getDonneesBudget()
        $scope.allDonneesB = donneesBudgetService.getDonneesBudget()
            .then(function (donnesBudgets) {
                var results = JSON.parse(donnesBudgets.data);
                angular.forEach(results, function (item) {
                    $scope.allDonneesBudget.push(item);
                });
                // $scope.allDonneesBudget = JSON.parse(donnesBudgets.data);
                pagination($scope.allDonneesBudget);
                // console.log($scope.allDonnessBudget);
            }, function (msg) {
                alert(msg);
            });
    };
    $scope.saveDonneeBudget = function(data, id) {
        angular.extend(data, {id: id});
       // return donneesBudgetService.setDonnesBudgets(data);
        $scope.allDonneesB = donneesBudgetService.setDonnesBudgets(data)
            .then(function (dataBudgets) {
                var results = JSON.parse(dataBudgets.data);
                angular.forEach(results, function (item) {
                    $scope.allDonneesBudget.push(item);
                });
                // $scope.allDonneesBudget = JSON.parse(dataBudgets.data);
                pagination($scope.allDonneesBudget);
                // console.log($scope.allDonneesBudget);
            }, function (msg) {
                alert(msg);
            })
    };

    var pagination = function (donneesBudget) {
        $scope.allDonnees = new NgTableParams({
            page: 1,
            count: 5
        }, {
            getData: function (params) {
                params.total(donneesBudget.length);
                // var sortedData = params.sorting() ? $filter('orderBy')($scope.allDonneesBudget, params.orderBy()) : $scope.allDonneesBudget;
                // var orderedData = params.filter() ? $filter('filter')(sortedData, params.filter()) : sortedData;
                // params.total(orderedData.length);
                return donneesBudget.slice((params.page() - 1) * params.count(), params.page() * params.count());
            }
        });
    };



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
