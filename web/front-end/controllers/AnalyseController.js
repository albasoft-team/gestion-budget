'use strict';

gestionBudget.controller('analyseDonnees',['$scope','donneesBudgetService', function ($scope,donneesBudgetService) {

    $scope.formData = {};
    $scope.donnees = [];
    $scope.analyser = function (form) {
        donneesBudgetService.postDonnesAnalyse(form)
            .then(function (donneesanalyse) {
                if (donneesanalyse.data.length > 0 ) {
                    angular.forEach(donneesanalyse.data, function (item) {
                        item.id = item.codeRegion;
                        item.value = item[1];
                        if (item.codeRegion === "SN.DK") {
                            item.link = "newchart-json-Dakar"
                        }
                        if (item.codeRegion === "SN.ST") {
                            item.link = "newchart-json-SaintLouis"
                        }
                        if (item.codeRegion === "SN.TH") {
                            item.link = "newchart-json-Thies"
                        }
                        if (item.codeRegion === "SN.DB") {
                            item.link = "newchart-json-Diourbel"
                        }

                        delete item.codeRegion;
                        delete item[1];
                        $scope.donnees.push(item);
                    })
                }
                renderCarte($scope.donnees);
            }, function (msg) {
                alert(msg);
            })
    };
    var renderCarte = function (donnees) {
        FusionCharts.ready(function () {
            var populationMap = new FusionCharts({
                type: 'maps/senegal',
                renderAt: 'chart-container',
                dataFormat: 'json',
                dataSource: {
                    "map": {
                        "theme" : "ocean",
                        "animation": "0",
                        "formatNumberScale": "0",
                        "showCanvasBorder": "0",
                        "showshadow": "0",
                        "fillColor": "#04A3ED",
                        "caption": "Le budget voté par région",
                        "entityFillHoverColor": "#E5E5E9"
                    },
                    "colorrange": {
                        "color": [
                            {
                                "minvalue": 0,
                                "maxvalue": 15000000,
                                "code": "#f8bd19",
                                "displayvalue": "< 20M"
                            },
                            {
                                "minvalue": "20000000",
                                "maxvalue": 22000000,
                                "code": "#6baa01",
                                "displayvalue": "20-50M"
                            },
                            {
                                "minvalue": "50000000",
                                "maxvalue": 86000000,
                                "code": "#eed698",
                                "displayvalue": "50-100M"
                            },
                            {
                                "minvalue": "100000000",
                                "maxvalue": 105000000,
                                "code": "#fa0808",
                                "displayvalue": "100-200M"
                            }

                        ]
                    },
                    "data": donnees,
                    "linkeddata": [
                        {
                        "id": "Dakar",
                        "linkedchart": {
                            "chart": {
                                "caption": "Dakar - Niveau département",
                                "showvalues": "0",
                                "formatNumberScale": "0",
                                "theme": "fint"
                            },
                            "categories": [{
                                "category": [{
                                    "label": "Dakar"
                                }, {
                                    "label": "Pikine"
                                }, {
                                    "label": "Rufisque"
                                }, {
                                    "label": "Guédiawaye"
                                }]

                            }],
                            "dataset": [
                                {
                                    "seriesname": "budget voté",
                                    "data": [{
                                        "value": "20540"
                                    }, {
                                        "value": "19300"
                                    }, {
                                        "value": "18400"
                                    }, {
                                        "value": "18400"
                                    }]

                                }
                            ]
                        }
                    },
                        {
                            "id": "SaintLouis",
                            "linkedchart": {
                                "chart": {
                                    "caption": "Saint-Louis - Niveau département",
                                    "showvalues": "0",
                                    "formatNumberScale": "0",
                                    "theme": "fint"
                                },
                                "categories": [{
                                    "category": [{
                                        "label": "Podor"
                                    }, {
                                        "label": "Dagana"
                                    }, {
                                        "label": "Saint-Louis"
                                    }]

                                }],
                                "dataset": [
                                    {
                                        "seriesname": "Niveau departement",
                                        "data": [
                                            {
                                                "value": "10000"
                                            }, {
                                                "value": "19900"
                                            }, {
                                                "value": "19200"
                                            }]
                                    }
                                ]
                            }
                        },
                        {
                            "id": "Diourbel",
                            "linkedchart": {
                                "chart": {
                                    "caption": "Diourbel - Niveau département",
                                    "showvalues": "0",
                                    "formatNumberScale": "0",
                                    "theme": "fint"
                                },
                                "categories": [{
                                    "category": [{
                                        "label": "Diourbel"
                                    }, {
                                        "label": "Bambey"
                                    }, {
                                        "label": "Mbacké"
                                    }]
                                }],
                                "dataset": [
                                    {
                                        "seriesname": "Diourbel - Niveau département",
                                        "data": [
                                            {
                                            "value": "23600"
                                        }, {
                                            "value": "21200"
                                        }, {
                                            "value": "19800"
                                        }]
                                    }
                                ]
                            }
                        },
                        {
                            "id": "Thies",
                            "linkedchart": {
                                "chart": {
                                    "caption": "Thies - Niveau département",
                                    "showvalues": "0",
                                    "formatNumberScale": "0",
                                    "theme": "fint"
                                },
                                "categories": [{
                                    "category": [{
                                        "label": "Thies"
                                    }, {
                                        "label": "Mbour"
                                    }, {
                                        "label": "Tivaouane"
                                    }]
                                }],
                                "dataset": [
                                    {
                                        "seriesname": "Thies - Niveau département",
                                        "data": [
                                            {
                                            "value": "24600"
                                        }, {
                                            "value": "21100"
                                        }, {
                                            "value": "19700"
                                        }]
                                    }
                                ]
                            }
                        }
                    ]

                }
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
    //             "linkeddata": [{
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
