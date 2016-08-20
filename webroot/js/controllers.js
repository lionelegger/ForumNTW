as.controller('MainCtrl', function($scope, $http) {

    $http.get('/users/current.json')
        .success(function(data) {
            if (undefined != data.user) {
                $scope.currentUserId = data.user.id;
                $scope.currentUserName = data.user.name;
                $scope.currentUserEmail = data.user.email;
                $scope.currentUserRole = data.user.role;
            }
        }).error(function(data) {
        $scope.currentUserId = 'undefined';
    });

    $scope.logout = function(){
        $http.get('Users/logout');
        console.log("call logout");
        $scope.loadQuestions();
        console.log("call loadQuestion");
    };

});

/**
 * Filter to render HTML code
 */
as.filter("sanitize", ["$sce", function($sce) {
    return function(htmlCode){
        return $sce.trustAsHtml(htmlCode);
    }
}]);

as.controller('LoginCtrl', function($scope, $rootScope, $http) {
    $scope.login = {};
    $scope.submitLogin = function() {
        console.log('call login');
        $http.post('/Users/login', $scope.login)
            .success(function(data, status, headers, config) {
                // console.log($scope.login);
                console.log("logged!");
            }).error(function(data, status, headers, config) {
                $scope.loginErrorMsg = "<div class='text-danger'>An error occurred...</div>";
        });
    }
});

as.controller('QuestionsCtrl', function($scope, $rootScope, $http) {
    console.log('call QuestionsCtrl');

    // Load the list of questions
    $scope.loadQuestions = function() {
        console.log('call loadQuestions');
        $http.get('/questions.json')
            .success(function(data, status, headers, config) {
                $scope.questions = data.questions;
                console.log("Questions refreshed!");
            }).error(function(data, status, headers, config) {
        });
    };

    $scope.loadQuestions();

    // Edit a question (part1: when press on edit button => load the data)
    $scope.editQuestionLoad = function(id) {
        console.log('call editQuestionLoad');
        console.log('Load question ' + id + '...');
        $http
            .get('/Questions/view/' + id + '.json')
            .success(function(data, status, headers, config) {
                $scope.questionToEdit.title = data.question.title;
                $scope.questionToEdit.body = data.question.body;
                $scope.questionToEdit.id = data.question.id;
            }).error(function(data, status, headers, config) {

        });
    };

    // Edit a question (part2: when press on save button => update the data)
    $scope.questionToEdit = {};
    $scope.editQuestionSave = function(id) {
        console.log('call editQuestionSave');
        console.log('Update question ' + id + '...');
        $http
            .post('/Questions/edit/' + id, $scope.questionToEdit)
            .success(function(data, status, headers, config) {
                console.log("Update done successfully");
                $scope.loadQuestions();
            }).error(function(data, status, headers, config) {
                console.log("Something went wrong during update");
        });
    };

    // Add a question
    $scope.questionToAdd = {};
    $scope.addQuestion = function() {
        console.log('call addQuestion');
        $http
            .post('/Questions/add', $scope.questionToAdd)
            .success(function(data, status, headers, config) {
                $scope.loadQuestions();
                console.log("call loadQuestion");
                $scope.questionToAdd = {};
            }).error(function(data, status, headers, config) {
        });
    };

    // Delete a question
    $scope.deleteQuestion = function(id) {
        console.log('call delQuestion');
        console.log('Delete question ' + id + '...');
        $http
            .delete('/Questions/delete/' + id)
            .success(function(data, status, headers, config) {
                $scope.loadQuestions();
                console.log("call loadQuestion");
            }).error(function(data, status, headers, config) {
        });
    };
});

