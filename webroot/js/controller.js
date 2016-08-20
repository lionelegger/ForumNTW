var that = this;

function initialize() {
    //console.log ("inside initialize");
    'use strict';

    $('#loginModal').on('shown.bs.modal', function () {
        $('#email').focus();
    });

    $('#addQuestionModal').on('shown.bs.modal', function () {
        $('#title').focus();
    });

    $('#addQuestion').on('click', function () {
        console.log('add question!!');
    });

    $('#refreshQuestions').on('click', function () {
        console.log('refresh questions!!');
    });

}


angular.module('forumApp', [])
    .controller('viewQuestionsController', function($scope, $http) {

        $http.get("questions.json").then(function(response) {
            $scope.questions = response.data.questions;
        });
    })
    .controller('addQuestionController', function($scope, $http) {
        // create a blank object to handle form data.
        $scope.question = {};
        // calling our submit function.
        $scope.addQuestion = function() {
            // Posting data to php file
            $http({
                method  : 'POST',
                url     : 'Questions/addQuestion.php',
                data    : $scope.question, //forms user object
                headers : {'Content-Type': 'application/x-www-form-urlencoded'}
            })
                .success(function(data) {
                    if (data.errors) {
                        // Showing errors.
                        $scope.errorTitle = data.errors.title;
                        $scope.errorBody = data.errors.body;
                    } else {
                        $scope.message = data.message;
                    }
                });
        };

    })
    // TODO: loginController is not used
    .controller('loginController', function($scope, $http) {

        // create a blank object to handle form data.
        $scope.user = {};
        // calling our submit function.
        $scope.submitForm = function() {
            // Posting data to php file
            $http({
                method  : 'POST',
                url     : 'users/login.php',
                data    : $scope.user, //forms user object
                headers : {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .success(function(data) {
                if (data.errors) {
                    // Showing errors.
                    $scope.errorName = data.errors.name;
                    $scope.errorUserName = data.errors.username;
                    $scope.errorEmail = data.errors.email;
                } else {
                    $scope.message = data.message;
                }
            });
        };

    })





