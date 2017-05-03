'use strict';

gestionBudget.controller('donneesBudget',['$scope','donneesBudgetService', 'NgTableParams','$timeout', function ($scope, donneesBudgetService, NgTableParams,$timeout) {
    var allDonneesBudget = [];


        //$scope.allDonnessBudget = donneesBudgetService.getDonneesBudget()
        donneesBudgetService.getDonneesBudget()
            .then(function (donnesBudgets) {
                var results = JSON.parse(donnesBudgets.data);
                angular.forEach(results, function (item) {
                  allDonneesBudget.push(item);
                });
                // $scope.allDonneesBudget = JSON.parse(donnesBudgets.data);
                pagination(allDonneesBudget);
                // console.log($scope.allDonnessBudget);
            }, function (msg) {
                alert(msg);
            });
    $scope.isnumber = true;

    $scope.saveDonneeBudget = function(data, id) {
        angular.extend(data, {id: id});
        allDonneesBudget = [];
        if (!isNumeric(data.budgetDemande) || !isNumeric(data.budgetVote)  || !isNumeric(data.budgetrecouvre)  ) {
            $scope.isnumber = false;
            $scope.msgErreur = "La valeur saisie doit être un entier ou un décimal !!!";
            $timeout(function () {
                $scope.isnumber = true;
                angular.element('#editForm'+id).triggerHandler('click');
            },5000);
            // $('#alert').delay(3000).hide();
            // angular.element(document.getElementById('editForm')).click();
            return;
        }
        if (data.budgetrecouvre > data.budgetVote) {
            $scope.isnumber = false;
            $scope.msgErreur = "La valeur du budget recouvré ne peut pas être supérieur à celle du budget voté !!!";
            $timeout(function () {
                $scope.isnumber = true;
                angular.element('#editForm'+id).triggerHandler('click');
            },5000);
            return
        }
       // return donneesBudgetService.setDonnesBudgets(data);
         donneesBudgetService.setDonnesBudgets(data)
            .then(function (dataBudgets) {
                var results = JSON.parse(dataBudgets.data);
                angular.forEach(results, function (item) {
                    allDonneesBudget.push(item);
                });
                // $scope.allDonneesBudget = JSON.parse(dataBudgets.data);
                pagination(allDonneesBudget);
                // console.log($scope.allDonneesBudget);
            }, function (msg) {
                alert(msg);
            })
    };
    function isNumeric(num){
        return !isNaN(num)
    }
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

    $scope.setMarkeur = function (data, id,budget) {
       if (!isNumeric(data)) {
           angular.element(document.getElementById("gb"+id+budget)).find("input").css('border','2px solid #a94442');
       }
       else {
           angular.element(document.getElementById("gb"+id+budget)).find("input").css('border','2px solid #b2dba1');
       }
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
