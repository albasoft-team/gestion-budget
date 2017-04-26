'use strict';

var gestionBudget = angular.module('gestionBudget',['xeditable'])
    .config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);
gestionBudget.run(function (editableOptions) {
    editableOptions.theme = 'bs3';
});