var that = this;

function initialize() {
    //console.log ("inside initialize");
    'use strict';

    $('#myModal').on('shown.bs.modal', function () {
        console.log("tata");
        $('#myInput').focus();
    });
}

angular.module('forumApp', [])
    .controller('questionsController', function($scope, $http) {

        $http.get("questions.json").then(function(response) {
            $scope.questions = response.data.questions;
        });
    })

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

    });



