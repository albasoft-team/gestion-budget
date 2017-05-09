'use strict';

var gestionBudget = angular.module('gestionBudget',['ui.utils.masks','xeditable','smart-table','ngTable','ng-fusioncharts'])
    .config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);
gestionBudget.run(function (editableOptions) {
    editableOptions.theme = 'bs3';
});
//
// gestionBudget.filter('filterByNumCompte', function () {
//     return function (items, lettre) {
//         if (items) {
//             var filtered = [];
//             var letterMatch = new RegExp(lettre, 'igm');
//             for (var i = 0; i < items.length; i++) {
//                 var item = items[i];
//                 if (letterMatch.test(item.compte.numeroCompte)) {
//                     filtered.push(item);
//                 }
//             }
//             return filtered;
//         }
//
//     };
// });
//
// gestionBudget.filter('filterByLibelleCompte', function () {
//
//     return function (items, lettre) {
//         if (items) {
//             var filtered = [];
//             var letterMatch = new RegExp(lettre, 'igm');
//             for (var i = 0; i < items.length; i++) {
//                 var item = items[i];
//                 if (letterMatch.test(item.compte.libelle)) {
//                     filtered.push(item);
//                 }
//             }
//             return filtered;
//         }
//
//     };
// });
//
// gestionBudget.filter('filterByChapitreCompte', function () {
//     return function (items, lettre) {
//         if (items) {
//             var filtered = [];
//             var letterMatch = new RegExp(lettre, 'igm');
//             for (var i = 0; i < items.length; i++) {
//                 var item = items[i];
//                 if (letterMatch.test(item.compte.chapitre.designation)) {
//                     filtered.push(item);
//                 }
//             }
//             return filtered;
//         }
//
//     };
// });