'use strict';

gestionBudget.controller('donneesBudget',['$scope','donneesBudgetService', 'NgTableParams','$timeout', function ($scope, donneesBudgetService, NgTableParams,$timeout) {
    $scope.allDonneesBudget = [];
    $scope.chapitrecompte = '';
    $scope.libellecompte = '';
    $scope.numerocompte = '';

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
                        "value": "4128"
                    },
                    {
                        "id": "SN.ST",
                        "value": "47013"
                    },
                    {
                        "id": "SN.LG",
                        "value": "50737"
                    },
                    {
                        "id": "SN.MT",
                        "value": "41230"
                    },
                    {
                        "id": "SN.TC",
                        "value": "70828"
                    },
                    {
                        "id": "SN.KD",
                        "value": "69557"
                    },
                    {
                        "id": "SN.ZG",
                        "value": "69791"
                    },
                    {
                        "id": "SN.KL",
                        "value": "48139"
                    },
                    {
                        "id": "SN.FK",
                        "value": "54529"
                    },
                    {
                        "id": "SN.DB",
                        "value": "86482"
                    },
                    {
                        "id": "SN.TH",
                        "value": "86482"
                    }

                ]
            }
        }).render();
    });
    $scope.donneesDataSource =
        {
            "chart": {
                "animation": "0",
                "showbevel": "0",
                "usehovercolor": "1",
                "canvasbordercolor": "FFFFFF",
                "bordercolor": "FFFFFF",
                "showlegend": "1",
                "showshadow": "0",
                "legendposition": "BOTTOM",
                "legendborderalpha": "0",
                "legendbordercolor": "ffffff",
                "legendallowdrag": "0",
                "legendshadow": "0",
                "caption": "Website Visits for the month of Jan 2014",
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
                            "value": "4128"
                        },
                        {
                            "id": "SN.ST",
                            "value": "47013"
                        },
                        {
                            "id": "SN.LG",
                            "value": "50737"
                        },
                        {
                            "id": "SN.MT",
                            "value": "41230"
                        },
                        {
                            "id": "SN.TC",
                            "value": "70828"
                        },
                        {
                            "id": "SN.KD",
                            "value": "69557"
                        },
                        {
                            "id": "SN.ZG",
                            "value": "69791"
                        },
                        {
                            "id": "SN.KL",
                            "value": "48139"
                        },
                        {
                            "id": "SN.FK",
                            "value": "54529"
                        },
                        {
                            "id": "SN.DB",
                            "value": "86482"
                        },
                        {
                            "id": "SN.TH",
                            "value": "86482"
                        }

                ]
        };
    $scope.setMarkeur = function (data, id,budget) {
       if (!isNumeric(data)) {
           angular.element(document.getElementById("gb"+id+budget)).find("input").css('border','2px solid #a94442');
           angular.element(document.getElementById("validForm")).attr("disabled","disabled");
       }
       else {
           angular.element(document.getElementById("gb"+id+budget)).find("input").css('border','2px solid #b2dba1');
           angular.element(document.getElementById("validForm")).removeAttr("disabled","disabled");
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
