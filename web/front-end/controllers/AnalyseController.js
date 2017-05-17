'use strict';

gestionBudget.controller('analyseDonnees',['$scope','donneesBudgetService', function ($scope,donneesBudgetService) {

    $scope.formData = {};
    $scope.donnees = {};

    $scope.analyser = function (form) {
        $scope.msg = [];
        if (form.axe && form.composant && form.portee) {
            // donneesBudgetService.postDonnesAnalyse(form)
            //     .then(function (donneesanalyse) {
            //         console.log(JSON.parse(donneesanalyse.data));
            //         $scope.donnees = JSON.parse(donneesanalyse.data) ;
            //         renderCarte($scope.donnees);
            //     }, function (msg) {
            //         alert(msg);
            //     })

            // console.log(form);
            donneesBudgetService.postData(form)
                .then(function (response) {
                    // console.log(JSON.parse(response));
                    $scope.donnees = response;
                    renderCarte($scope.donnees);
                }, function (msg) {

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
                type: "column2D",
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
}]);
