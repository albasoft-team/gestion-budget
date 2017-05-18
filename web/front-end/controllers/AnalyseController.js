'use strict';

gestionBudget.controller('analyseDonnees',['$scope','donneesBudgetService', function ($scope,donneesBudgetService) {

    $scope.formData = {};
    $scope.donnees = {};
    $scope.linkedFrame = [];
    $scope.profondeur = 0 ;
    $scope.analyser = function (form) {
        $scope.msg = []; var i = 0;
        if (form.axe && form.composant && form.portee) {
            if ($scope.profondeur !== 0) {
                for (i=0; i <= $scope.profondeur ; i ++) {
                    if (angular.element(document.getElementById('linkedchart-container'+i)))
                        angular.element(document.getElementById('linkedchart-container'+i)).remove();
                }
            }
            donneesBudgetService.postData(form)
                .then(function (response) {
                    // console.log(JSON.parse(response));
                    $scope.donnees = response;
                    renderCarte($scope.donnees, form.portee);

                }, function (msg) {

                })
        }
        else {
            $scope.msg.push("Veuillez choisir un composant, un axe et une portée  !!!")
        }

    };
    var k = 1 ;
    var renderCarte = function (donnees, portee) {
        if (portee == 'commune'){$scope.profondeur = 2;}
        if (portee == 'departement'){$scope.profondeur = 1;}
        var i = 0;
        for (i = 1; i <= $scope.profondeur; i++) {
            angular.element(document.getElementById('chartRender')).append("<div class='chartRen' style='width: 600px; display: block;margin-left: auto; margin-right: auto;margin-top: 20px' id= 'linkedchart-container"+i+"'></div>");
            // angular.element(document.getElementsByClassName('chartRen')).attr();
            $scope.linkedFrame.push({
                type: "column2D",
                "renderAt" : "linkedchart-container"+i,
                overlayButton: {
                    show : false
                    // message: 'Retour',
                    // fontSize : '12',
                    // padding : '1',
                    // fontColor: '#ffffff',
                    // bgColor: '#008ee4'
                }})
        }

        FusionCharts.ready(function () {
            var populationMap = new FusionCharts({
                type: 'maps/senegal',
                dataLoadStartMessageFont: 'Helvetica',
                dataLoadStartMessageFontSize: '24',
                dataLoadStartMessageColor: '#00FF00',
                renderAt: 'chart-container',
                width : 600,
                height : 300,
                dataFormat: 'json',
                dataSource: donnees
            });
            populationMap.configureLink($scope.linkedFrame);

            populationMap.render();
        });
        k++;
    };
    renderCarte($scope.donnees);
}]);
