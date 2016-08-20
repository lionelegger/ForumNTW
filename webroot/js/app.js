as = angular.module('myApp', ['ngRoute']);
as.config(function($routeProvider) {
    $routeProvider
        .when('/questions', {templateUrl: 'partials/questions.html', controller: 'QuestionsCtrl'})
        //.when('/new-question', {templateUrl: 'partials/new-question.html', controller: 'NewQuestionCtrl'})
        .when('/answers/:id', {templateUrl: 'partials/answers.html', controller: 'LoadAnswersCtrl'})
        .otherwise({redirectTo: '/questions'});
});


function initialize() {
    //console.log ("inside initialize");
    'use strict';

    $('#loginModal').on('shown.bs.modal', function () {
        $('#email').focus();
    });

    $('#addQuestionModal').on('shown.bs.modal', function () {
        $('#title').focus();
    });
}

