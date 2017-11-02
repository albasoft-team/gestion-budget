'use strict';

gestionBudget.controller('donneesBudget',['$scope','donneesBudgetService', 'NgTableParams','$timeout','$locale', function ($scope, donneesBudgetService, NgTableParams,$timeout, $locale) {
    $scope.allDonneesBudget = [];
    $scope.chapitrecompte = '';
    $scope.libellecompte = '';
    $scope.numerocompte = '';
    $locale.NUMBER_FORMATS.GROUP_SEP = ' ';


    $scope.shearch = {compte:{numeroCompte : '',libelle :'', chapitre : {designation:''}}};

        //$scope.allDonnessBudget = donneesBudgetService.getDonneesBudget()
        donneesBudgetService.getDonneesBudget()
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
    $scope.isnumber = true;

    $scope.saveDonneeBudget = function(data, id) {
        angular.extend(data, {id: id});
        $scope.allDonneesBudget = [];
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
                    $scope.allDonneesBudget.push(item);
                });
                pagination($scope.allDonneesBudget);
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
                return donneesBudget.slice((params.page() - 1) * params.count(), params.page() * params.count());
            }
        });
    };



    $scope.enableBtn = function (id, budget) {
         $('.editable-input').mask('000 000 000 000 000', {reverse: true});
         $('.editable-input').mask('#00 000 000 000 000', {reverse: true});
         $('.editable-input').mask('##0 000 000 000 000', {reverse: true});
         $('#dbTable div ').addClass('popover-wrapper');
        if (angular.element(document.getElementById("validForm"+id)).attr("disabled")) {
            angular.element(document.getElementById("validForm"+id)).removeAttr("disabled","disabled");
        }
    };
    $scope.setMarkeur = function (data, id,budget) {
        console.log('ici');
       if (!data.match(/[\d\s]+/g)) {
           angular.element(document.getElementById("elem"+id+budget)).find("input").css('border','2px solid #a94442');
           // angular.element(document.getElementById("validForm"+id)).attr("disabled","disabled");
       }
       else {
           angular.element(document.getElementById("elem"+id+budget)).find("input").css('border','2px solid #b2dba1');
           // angular.element(document.getElementById("validForm"+id)).removeAttr("disabled","disabled");
       }
    };


    $(document).on('change', 'input:radio[id^="chkcommune"]', function (event) {
        $('#dvcommune').show();
    });
    $(document).on('change', 'input:radio[id^="radioStacked1"]', function (event) {
        $('#dvcommune').hide();
    });
}]);
