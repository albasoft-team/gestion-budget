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
        // if (!isNumeric(data.budgetDemande) || !isNumeric(data.budgetVote)  || !isNumeric(data.budgetrecouvre)  ) {
        //     $scope.isnumber = false;
        //     $scope.msgErreur = "La valeur saisie doit être un entier ou un décimal !!!";
        //     $timeout(function () {
        //         $scope.isnumber = true;
        //         angular.element('#editForm'+id).triggerHandler('click');
        //     },5000);
        //     // $('#alert').delay(3000).hide();
        //     // angular.element(document.getElementById('editForm')).click();
        //     return;
        // }
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
                // $scope.allDonneesBudget = JSON.parse(dataBudgets.data);
                pagination($scope.allDonneesBudget);
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
    FusionCharts.ready(function () {
        var populationMap = new FusionCharts({
            type: 'maps/senegal',
            renderAt: 'chart-container',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "animation": "0",
                    "showbevel": "0",
                    "theme" : "fint",
                    "usehovercolor": "1",
                    "canvasbordercolor": "FFFFFF",
                    "bordercolor": "FFFFFF",
                    "showlegend": "0",
                    "showshadow": "0",
                    "legendposition": "BOTTOM",
                    "legendborderalpha": "0",
                    "legendbordercolor": "ffffff",
                    "legendallowdrag": "0",
                    "legendshadow": "0",
                    "caption": "Le nombre de population par région",
                    "connectorcolor": "000000",
                    "fillalpha": "80",
                    "hovercolor": "CCCCCC",
                    "showborder": 0
                },
                "colorrange": {
                    "minvalue": "0",
                    "startlabel": "Low",
                    "endlabel": "High",
                    "code": "e44a00",
                    "gradient": "1",
                    "color": [
                        {
                            "maxvalue": 30000,
                            "displayvalue": "Average",
                            "code": "f8bd19"
                        },
                        {
                            "maxvalue": 100000,
                            "code": "6baa01"
                        }
                    ],
                    "maxvalue": 0
                },
                "data": [
                    {
                        "id": "SN.DK",
                        "value": ""
                    },
                    {
                        "id": "SN.ST",
                        "value": ""
                    },
                    {
                        "id": "SN.LG",
                        "value": ""
                    },
                    {
                        "id": "SN.MT",
                        "value": ""
                    },
                    {
                        "id": "SN.TC",
                        "value": ""
                    },
                    {
                        "id": "SN.KD",
                        "value": ""
                    },
                    {
                        "id": "SN.ZG",
                        "value": ""
                    },
                    {
                        "id": "SN.KL",
                        "value": ""
                    },
                    {
                        "id": "SN.FK",
                        "value": ""
                    },
                    {
                        "id": "SN.DB",
                        "value": ""
                    },
                    {
                        "id": "SN.TH",
                        "value": ""
                    }

                ]
            }
        }).render();
    });

    $scope.enableBtn = function (id, budget) {
        // $('.money').mask('000.000.000.000.000,00', {reverse: true});
        //  $('.editable-input').mask('#.##0,00', {reverse: false});
         $('.editable-input').mask('000 000 000 000 000', {reverse: true});
         $('.editable-input').mask('#00 000 000 000 000', {reverse: true});
         $('.editable-input').mask('##0 000 000 000 000', {reverse: true});
         $('#dbTable div ').addClass('popover-wrapper');
        if (angular.element(document.getElementById("validForm"+id)).attr("disabled")) {
            angular.element(document.getElementById("validForm"+id)).removeAttr("disabled","disabled");
        }
    };
    $scope.setMarkeur = function (data, id,budget) {
       if (!data.match(/[\d\s]+/g)) {
           angular.element(document.getElementById("gb"+id+budget)).find("input").css('border','2px solid #a94442');
           angular.element(document.getElementById("validForm"+id)).attr("disabled","disabled");
       }
       else {
           angular.element(document.getElementById("gb"+id+budget)).find("input").css('border','2px solid #b2dba1');
           angular.element(document.getElementById("validForm"+id)).removeAttr("disabled","disabled");
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
