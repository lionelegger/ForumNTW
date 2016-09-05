as = angular.module('myApp', ['ngRoute']);
as.config(function($routeProvider) {
    $routeProvider
        .when('/questions', {templateUrl: 'partials/questions.html', controller: 'QuestionsCtrl'})
        .when('/search', {templateUrl: 'partials/search.html', controller: 'SearchCtrl'})
        .when('/questions/:id', {templateUrl: 'partials/answers.html', controller: 'AnswersCtrl'})
        .otherwise({redirectTo: '/questions'});
});


function initialize() {
    //console.log ("inside initialize");
    'use strict';

    // Put here any JS that should be loaded at initialization

}
