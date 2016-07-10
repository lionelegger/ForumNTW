angular.module('forumApp', [])
    .controller('questionsController', function($scope, $http) {


        $http.get("questions.json").then(function(response) {
            $scope.questions = response.data.questions;
        });

        //var questions = this;

        /*questions.title = "Liste de questions";
        
        questions.list = [
            {text: "Pomme"},
            {text: "Fraise"},
            {text: "Banane"},
            {text: "Poire"}
        ];*/
    });
