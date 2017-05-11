'use strict';

gestionBudget.controller('analyseDonnees',['$scope','donneesBudgetService', function ($scope,donneesBudgetService) {

    $scope.formData = {};
    $scope.donnees = {};

    $scope.analyser = function (form) {
        $scope.msg = [];
        if (form.axe && form.composant && form.portee) {
            donneesBudgetService.postDonnesAnalyse(form)
                .then(function (donneesanalyse) {
                    console.log(JSON.parse(donneesanalyse.data));
                    $scope.donnees = JSON.parse(donneesanalyse.data) ;
                    renderCarte($scope.donnees);
                }, function (msg) {
                    alert(msg);
                })
        }
        else {
            $scope.msg.push("Veuillez choisir un composant, un axe et une portée  !!!")
        }

    };
    var renderCarte = function (donnees) {
        FusionCharts.ready(function () {
            var populationMap = new FusionCharts({
                type: 'maps/senegal',
                renderAt: 'chart-container',
                width : 600,
                height : 300,
                dataFormat: 'json',
                dataSource: donnees
            });
            populationMap.configureLink(
                {
                type: "mscombidy2d",
                overlayButton: {
                    message: 'Retour',
                    fontSize : '12',
                    padding : '2',
                    fontColor: '#ffffff',
                    bgColor: '#008ee4'
                }
            },0);
            populationMap.render();
        });
    };
    renderCarte($scope.donnees);

    // FusionCharts.ready(function() {
    //     var wrCoverage = new FusionCharts({
    //         type: 'maps/usa',
    //         renderAt: 'chartContainer',
    //         width: '650',
    //         height: '450',
    //         dataFormat: 'json',
    //         dataSource: {
    //             "map": {
    //                 "theme": "fint",
    //                 "caption": "Shipping Volume and Costs",
    //                 "subcaption": "Distribution Network - Last Month",
    //                 "numberSuffix": "%",
    //                 "fillColor": "#cccccc",
    //                 "showHoverEffect": "0",
    //                 "showCanvasBorder": "0",
    //                 "borderColor": "#ffffff",
    //                 "showShadow": "0"
    //             },
    //             "data": [{
    //                 "id": "CA",
    //                 "showLabel": "0",
    //                 "color": "#008ee4",
    //                 "link": "newchart-json-California",
    //                 "hoverColor": "#ffccff",
    //                 "showHoverEffect": "1"
    //             }, {
    //                 "id": "TX",
    //                 "showLabel": "0",
    //                 "color": "#008ee4",
    //                 "link": "newchart-json-Texas",
    //                 "hoverColor": "#ffccff",
    //                 "showHoverEffect": "1"
    //             }, {
    //                 "id": "NC",
    //                 "showLabel": "0",
    //                 "color": "#008ee4",
    //                 "link": "newchart-json-NorthCarolina",
    //                 "hoverColor": "#ffccff",
    //                 "showHoverEffect": "1"
    //             }],
    //             "linkeddata": [
    //                 {
    //                 "id": "California",
    //                 "linkedchart": {
    //                     "chart": {
    //                         "caption": "California - Shipment Summary",
    //                         "subCaption": "Last Month",
    //                         "pyaxisname": "Units",
    //                         "syaxisname": "Cost",
    //                         "xAxisName": "State",
    //                         "showvalues": "0",
    //                         "labelDisplay": "rotate",
    //                         "slantLabel": "1",
    //                         "formatNumberScale": "0",
    //                         "sNumberPrefix": "$",
    //                         "theme": "fint"
    //                     },
    //                     "categories": [{
    //                         "category": [{
    //                             "label": "Washington"
    //                         }, {
    //                             "label": "Nevada"
    //                         }, {
    //                             "label": "Arizona"
    //                         }, {
    //                             "label": "Wyoming"
    //                         }, {
    //                             "label": "Idaho"
    //                         }, {
    //                             "label": "Utah"
    //                         }, {
    //                             "label": "Montana"
    //                         }]
    //
    //                     }],
    //                     "dataset": [
    //                         {
    //                         "seriesname": "Daily Shipment",
    //                         "data": [{
    //                             "value": "20540"
    //                         }, {
    //                             "value": "19300"
    //                         }, {
    //                             "value": "18400"
    //                         }, {
    //                             "value": "18400"
    //                         }, {
    //                             "value": "17400"
    //                         }, {
    //                             "value": "16500"
    //                         }, {
    //                             "value": "15600"
    //                         }]
    //
    //                     }
    //                     ]
    //                 }
    //             },
    //                 {
    //                 "id": "Texas",
    //                 "linkedchart": {
    //                     "chart": {
    //                         "caption": "Texas - Shipment Summary",
    //                         "subCaption": "Last Month",
    //                         "pyaxisname": "Units",
    //                         "syaxisname": "Cost",
    //                         "xAxisName": "State",
    //                         "showvalues": "0",
    //                         "labelDisplay": "rotate",
    //                         "slantLabel": "1",
    //                         "formatNumberScale": "0",
    //                         "sNumberPrefix": "$",
    //                         "theme": "fint"
    //                     },
    //                     "categories": [{
    //                         "category": [{
    //                             "label": "New Mexico"
    //                         }, {
    //                             "label": "North Dakota"
    //                         }, {
    //                             "label": "Arkansas"
    //                         }, {
    //                             "label": "Mississippi"
    //                         }, {
    //                             "label": "Illinois"
    //                         }, {
    //                             "label": "South Dakota"
    //                         }, {
    //                             "label": "Colorado"
    //                         }, {
    //                             "label": "Nebraska"
    //                         }, {
    //                             "label": "Oklahoma"
    //                         }, {
    //                             "label": "Minnesota"
    //                         }, {
    //                             "label": "Iowa"
    //                         }, {
    //                             "label": "Louisiana"
    //                         }, {
    //                             "label": "Wisconsin"
    //                         }, {
    //                             "label": "Kansas"
    //                         }, {
    //                             "label": "Missouri"
    //                         }]
    //
    //                     }],
    //                     "dataset": [
    //                         {
    //                         "seriesname": "Daily Shipment",
    //                         "data": [
    //                             {
    //                             "value": "21300"
    //                         }, {
    //                             "value": "19900"
    //                         }, {
    //                             "value": "19200"
    //                         }, {
    //                             "value": "18760"
    //                         }, {
    //                             "value": "17650"
    //                         }, {
    //                             "value": "17300"
    //                         }, {
    //                             "value": "17200"
    //                         }, {
    //                             "value": "16870"
    //                         }, {
    //                             "value": "16800"
    //                         }, {
    //                             "value": "16100"
    //                         }, {
    //                             "value": "15600"
    //                         }, {
    //                             "value": "15440"
    //                         }, {
    //                             "value": "14890"
    //                         }, {
    //                             "value": "13670"
    //                         }, {
    //                             "value": "12560"
    //                         }]
    //                     }
    //                     ]
    //                 }
    //             },
    //                 {
    //                 "id": "NorthCarolina",
    //                 "linkedchart": {
    //                     "chart": {
    //                         "caption": "North Carolina - Shipment Summary",
    //                         "subCaption": "Last Month",
    //                         "pyaxisname": "Units",
    //                         "syaxisname": "Cost",
    //                         "xAxisName": "State",
    //                         "showvalues": "0",
    //                         "labelDisplay": "rotate",
    //                         "slantLabel": "1",
    //                         "formatNumberScale": "0",
    //                         "sNumberPrefix": "$",
    //                         "theme": "fint"
    //                     },
    //                     "categories": [{
    //                         "category": [{
    //                             "label": "New York"
    //                         }, {
    //                             "label": "Florida"
    //                         }, {
    //                             "label": "Indiana"
    //                         }, {
    //                             "label": "Vermont"
    //                         }, {
    //                             "label": "Connecticut"
    //                         }, {
    //                             "label": "Michigan"
    //                         }, {
    //                             "label": "Georgia"
    //                         }, {
    //                             "label": "Virginia"
    //                         }, {
    //                             "label": "New Hampshire"
    //                         }, {
    //                             "label": "Massachusetts"
    //                         }, {
    //                             "label": "Ohio"
    //                         }, {
    //                             "label": "West Virginia"
    //                         }, {
    //                             "label": "South Carolina"
    //                         }, {
    //                             "label": "Kentucky"
    //                         }, {
    //                             "label": "Pennsylvania"
    //                         }, {
    //                             "label": "Indiana"
    //                         }, {
    //                             "label": "Maine"
    //                         }, {
    //                             "label": "Alabama"
    //                         }]
    //                     }],
    //                     "dataset": [
    //                         {
    //                         "seriesname": "Daily Shipment",
    //                         "data": [{
    //                             "value": "23600"
    //                         }, {
    //                             "value": "21200"
    //                         }, {
    //                             "value": "19800"
    //                         }, {
    //                             "value": "18400"
    //                         }, {
    //                             "value": "18340"
    //                         }, {
    //                             "value": "18200"
    //                         }, {
    //                             "value": "17400"
    //                         }, {
    //                             "value": "17260"
    //                         }, {
    //                             "value": "16900"
    //                         }, {
    //                             "value": "16590"
    //                         }, {
    //                             "value": "16540"
    //                         }, {
    //                             "value": "16430"
    //                         }, {
    //                             "value": "16230"
    //                         }, {
    //                             "value": "15850"
    //                         }, {
    //                             "value": "15600"
    //                         }, {
    //                             "value": "14700"
    //                         }, {
    //                             "value": "14680"
    //                         }, {
    //                             "value": "13400"
    //                         }]
    //                     }
    //                     ]
    //                 }
    //             }
    //             ]
    //         }
    //     });
    //     //Configure the second level chart's properties
    //     wrCoverage.configureLink({
    //         type: "mscombidy2d",
    //         overlayButton: {
    //             message: 'Back',
    //             fontColor: '880000',
    //             bgColor: 'FFEEEE',
    //             borderColor: '660000'
    //         }
    //     }, 0);
    //     wrCoverage.render();
    // });
}]);
