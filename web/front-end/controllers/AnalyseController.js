'use strict';

gestionBudget.controller('analyseDonnees',['$scope','donneesBudgetService', function ($scope,donneesBudgetService) {

    $scope.formData = {};
    $scope.donnees = {};
    $scope.linkedFrame = [];
    $scope.profondeur = 0 ;
    $scope.label = '';
    $scope.analyser = function (form) {
        $scope.msg = []; var i = 0;
        if (form.axe && form.composant && form.portee) {
            if ($scope.profondeur !== 0) {
                if (angular.element(document.getElementById('panel2')))
                    angular.element(document.getElementById('panel2')).css('display','none');

            }
            donneesBudgetService.postData(form)
                .then(function (response) {
                    // console.log(JSON.parse(response));
                    $scope.donnees = response;
                    renderCarte($scope.donnees, form.portee, form.axe);
                }, function (msg) {

                })
        }
        else {
            $scope.msg.push("Veuillez choisir un composant, un axe et une portée  !!!")
        }

    };

    var renderCarte = function (donnees, portee, axe) {
        if (portee == 'commune'){$scope.profondeur = 2;}
        if (portee == 'departement'){$scope.profondeur = 1;}
        var i = 0;
        // for (i = 1; i <= $scope.profondeur; i++) {

        // angular.element(document.getElementsByClassName('chartRen')).attr();
        // $scope.linkedFrame.push({
        //     type: "column2D",
        //     "renderAt" : "linkedchart-container"+i,
        //     overlayButton: {
        //         show : false
        //         // message: 'Retour',
        //         // fontSize : '12',
        //         // padding : '1',
        //         // fontColor: '#ffffff',
        //         // bgColor: '#008ee4'
        //     }})
        // }


        FusionCharts.ready(function () {
            var populationMap = new FusionCharts({
                type: 'maps/senegal',
                renderAt: 'chart-container',
                width : 500,
                height : 300,
                dataFormat: 'json',
                dataSource: donnees,
                "events": {
                    "overlayButtonClick": function (eventObj, dataObj) {

                    },
                    "entityRollover": function(evt, data) {
                        if (data.value) {
                            angular.element(document.getElementById('message')).css('display','block');
                            angular.element(document.getElementById('message')).text("Region de " + data.label + "\n" +" : "+ axe +" = " + data.value + " M");
                        }
                    },
                    "entityRollout": function(evt, data) {
                        angular.element(document.getElementById('message')).css('display','none')
                    },
                    "entityClick": function(evt, data) {
                        i = 1;
                        angular.element(document.getElementById('head')).text(data.label);
                        if (angular.element(document.getElementById('panel2')).length !== 0) {
                            angular.element(document.getElementById('panel2')).css('display','none');
                        }
                        angular.element(document.getElementById('panel2')).css('display','block');

                        var results = [];
                        var  donneesPie = JSON.parse(donnees);
                        if (data.value !== null) {
                            angular.forEach(donneesPie.linkeddata, function (item) {
                                if (item.id == data.originalId) {
                                    results.push(item);
                                }
                            });
                            var  dataSourcePie = {};
                            var chatAt = {"startingangle": "120",
                                            "showlabels": "0",
                                            "showborder": "1",
                                            "borderColor": "#CCCCCC",
                                            "showlegend": "1",
                                            "enablemultislicing": "0",
                                            "slicingdistance": "15",
                                            "showpercentvalues": "1",
                                            "showpercentintooltip": "1"
                            };


                            chatAt.caption = results[0].linkedchart.chart.caption;

                            dataSourcePie.chart = chatAt;
                            dataSourcePie.colorrange = {
                                color : [
                                    {"minvalue" : 0,"maxvalue" :20000000, "code" :"f8bd19",  "displayvalue" :"< 20M"},
                                    {"minvalue" :"20000000","maxvalue" :50000000,"code" :"6baa01","displayvalue" :"20-50M"},
                                    {"minvalue" :"50000000","maxvalue" :100000000,"code" :"eed698","displayvalue" :"50-100M"},
                                    {"minvalue" :"100000000","maxvalue" :130000000,"code" :"fa0808","displayvalue" :"100-120M"},
                                    {"minvalue" :"120000000","maxvalue" :1500000000,"code" :"#b3cccc","displayvalue" :"120-150M"},
                                    {"minvalue" :"150000000","maxvalue" :200000000,"code" :"#c65353","displayvalue" :"150-200M"},
                                    {"minvalue" :"200000000","maxvalue" :500000000,"code" :"#999966","displayvalue" :"200-500M"},
                                    {"minvalue" :"500000000","maxvalue" :1000000000,"code" :"#00a3cc","displayvalue" :"500-1000M"}]};
                            dataSourcePie.data = [];
                            dataSourcePie.data = results[0].linkedchart.data;
                            dataSourcePie.linkeddata = [];
                            angular.forEach(results[0].linkedchart.linkeddata, function (it) {
                                var chatAt2 = {"startingangle": "120",
                                    "showlabels": "0",
                                    "showlegend": "1",
                                    "showborder": "1",
                                    "borderColor": "#CCCCCC",
                                    "enablemultislicing": "0",
                                    "slicingdistance": "15",
                                    "showpercentvalues": "1",
                                    "showpercentintooltip": "0"
                                };
                                chatAt2.caption = it.linkedchart.chart.caption;
                                it.linkedchart.chart = chatAt2;
                                dataSourcePie.linkeddata.push(it);
                            });

                            // dataSourcePie.linkeddata = results[0].linkedchart.linkeddata;

                            var chartPie = new FusionCharts({
                                type: 'pie3D',
                                width : 500,
                                height : 300,
                                renderAt: 'linkedchart-container1',
                                dataFormat: 'json',
                                dataSource: dataSourcePie
                            });
                            chartPie.configureLink({
                                type : 'pie3D',
                                overlayButton: {
                                    message: 'Retour',
                                    fontSize : '8',
                                    padding : '0',
                                    fontColor: '#ffffff',
                                    bgColor: '#008ee4'
                                }},0);
                            chartPie.render('linkedchart-container1');
                        }
                    }

                }
            });
            populationMap.configureLink({
                type: "column2D",
                "renderAt" : "linkedchart-container",
                // "canvasBgAlpha": "0",
                "showborder": "1",
                "bgColor": "#DDDDDD",
                overlayButton: {
                    message: 'Retour',
                    fontSize : '8',
                    padding : '0',
                    fontColor: '#ffffff',
                    bgColor: '#008ee4'
                }},0);

            populationMap.render();


        });
    };

    renderCarte($scope.donnees);
}]);
