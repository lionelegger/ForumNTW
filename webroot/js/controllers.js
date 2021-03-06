as.controller('MainCtrl', function($scope, $http, $location) {

    // to get the current user
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

    // to logout
    $scope.logout = function(){
        $http.get('Users/logout');
        console.log("call logout");
        $scope.loadQuestions();
        console.log("call loadQuestion");
    };

    // for navigation (to get the current page)
    $scope.isCurrentPath = function (path) {
        return $location.path() == path;
    };

});

as.controller('QuestionsCtrl', function($scope, $rootScope, $http) {
    // Load the list of questions
    // console.log('call QuestionsCtrl');
    $scope.loadQuestions = function() {
        console.log('call loadQuestions');
        $http.get('/questions.json')
            .success(function(data) {
                $scope.questions = data.questions;
            }).error(function(data, status, headers, config) {
        });
    };
    $scope.loadQuestions();

    // Edit a question (part1: when press on edit button => load the data)
    $scope.editQuestionLoad = function(id) {
        //console.log('call editQuestionLoad');
        //console.log('Load question ' + id + '...');
        $http
            .get('/Questions/view/' + id + '.json')
            .success(function(data, status, headers, config) {
                $scope.questionToEdit.title = data.question.title;
                $scope.questionToEdit.body = data.question.body;
                $scope.questionToEdit.id = data.question.id;
            }).error(function(data, status, headers, config) {
                console.log("Something went wrong during edit Question load");
        });
    };

    // Edit a question (part2: when press on save button => update the data)
    $scope.questionToEdit = {};
    $scope.editQuestionSave = function(id) {
        //console.log('call editQuestionSave');
        //console.log('Update question ' + id + '...');
        $http
            .post('/Questions/edit/' + id, $scope.questionToEdit)
            .success(function(data, status, headers, config) {
                //console.log("Update done successfully");
                $scope.loadQuestions();
            }).error(function(data, status, headers, config) {
                console.log("Something went wrong during edit Question save");
        });
    };

    // Add a question
    $scope.questionToAdd = {};
    $scope.addQuestion = function() {
        // console.log('call addQuestion');
        $http
            .post('/Questions/add', $scope.questionToAdd)
            .success(function(data, status, headers, config) {
                $scope.loadQuestions();
                //console.log("call loadQuestion");
                $scope.questionToAdd = {};
            }).error(function(data, status, headers, config) {
                console.log("Something went wrong during save Question");
        });
    };

    // Delete a question (part 1: Ask for confirmation)
    $scope.questionToDelete = {};
    $scope.deleteQuestionLoad = function(id) {
        $http
            .get('/Questions/view/' + id + '.json')
            .success(function(data, status, headers, config) {
                $scope.questionToDelete.title = data.question.title;
                $scope.questionToDelete.body = data.question.body;
                $scope.questionToDelete.id = data.question.id;
            }).error(function(data, status, headers, config) {
                console.log("Something went wrong during loading of Question");
        });
    };

    // Delete a question (part 2: Delete the question)
    $scope.deleteQuestionSave = function(id) {
        // console.log('call delQuestion');
        // console.log('Delete question ' + id + '...');
        $http
            .delete('/Questions/delete/' + id)
            .success(function(data, status, headers, config) {
                $scope.loadQuestions();
                // console.log("call loadQuestion");
            }).error(function(data, status, headers, config) {
            console.log("Something went wrong during the Question deletion");
        });
    };
});


as.controller('AnswersCtrl', function($scope, $rootScope, $http, $routeParams) {
    console.log('call AnswersCtrl');

    // Load the list of answers corresponding to a specific question
    $scope.loadAnswers = function() {
        // console.log('call loadAnswers for question '  + $routeParams['id']);
        $http.get('/questions/' + $routeParams['id'] +'.json')
            .success(function(data, status, headers, config) {
                $scope.question = data.question;
                $scope.answers = data.question.answers;
                // console.log($scope.question.answers);
                // console.log('Question ' + $routeParams['id'] +' and corresponding answers loaded!');
            }).error(function(data, status, headers, config) {
        });
    };
    $scope.loadAnswers();


    // Edit an answer (part1: when press on edit button => load the data)
    $scope.editAnswerLoad = function(id) {
        // console.log('call editAnswerLoad');
        // console.log('Load answer ' + id + '...');
        $http
            .get('/Answers/view/' + id + '.json')
            .success(function(data, status, headers, config) {
                $scope.answerToEdit.message = data.answer.message;
                $scope.answerToEdit.id = data.answer.id;
            }).error(function(data, status, headers, config) {
        });
    };

    // Edit an answer (part2: when press on save button => update the data)
    $scope.answerToEdit = {};
    $scope.editAnswerSave = function(id) {
        // console.log('call editAnswerSave');
        // console.log('Update answer ' + id + '...');
        $http
            .post('/Answers/edit/' + id, $scope.answerToEdit)
            .success(function(data, status, headers, config) {
                // console.log("Update done successfully");
                $scope.loadAnswers();
            }).error(function(data, status, headers, config) {
            console.log("Something went wrong during update");
        });
    };

    // Add an answer
    $scope.answerToAdd = {};
    $scope.addAnswer = function() {
        // console.log('call addAnswer');
        $http
            .post('/Questions/view/' + $routeParams['id'], $scope.answerToAdd)
            .success(function(data, status, headers, config) {
                $scope.answerToAdd = {};
                $scope.loadAnswers();
                // console.log("call loadAnswers");
            }).error(function(data, status, headers, config) {
        });
    };


    // Delete an answer (part 1: Ask for confirmation)
    $scope.answerToDelete = {};
    $scope.deleteAnswerLoad = function(id) {
        $http
            .get('/Answers/view/' + id + '.json')
            .success(function(data) {
                $scope.answerToDelete.message = data.answer.message;
                $scope.answerToDelete.id = data.answer.id;
            }).error(function(data, status, headers, config) {
        });
    };

    // Delete a answer (part 2: Delete the answer)
    $scope.deleteAnswerSave = function(id) {
        // console.log('call delAnswer');
        // console.log('Delete answer ' + id + '...');
        $http
            .delete('/Answers/delete/' + id)
            .success(function(data, status, headers, config) {
                $scope.loadAnswers();
                // console.log("call loadAnswers");
            }).error(function(data, status, headers, config) {
        });
    };
});

as.controller('SearchCtrl', function($scope, $rootScope, $http) {
    // console.log('call SearchCtrl');
    // Load the list of answers
    $scope.search = function() {
        // console.log("button questions = " + $scope.inQuestions)
        // console.log("button answers = " + $scope.inAnswers)
        // console.log('call search for text : ' + $scope.searchTxt);

        // Search in Answers only (=> the question has to show also)
        if ($scope.inAnswers){
            $http.get('/Answers/search.json?searchTxt=' + $scope.searchTxt)
                .success(function(data) {
                    $scope.answers = data.answers;
                    // console.log($scope.answers);
                    // console.log("Answers loaded!");
                }).error(function(data, status, headers, config) {
            });
        }

        // Search in Questions only (=> the answers do not show)
        if ($scope.inQuestions){
            $http.get('/Questions/search.json?searchTxt=' + $scope.searchTxt)
                .success(function(data) {
                    $scope.questions = data.questions;
                    // console.log($scope.questions);
                    // console.log("Questions loaded!");
                }).error(function(data, status, headers, config) {
            });
        }
    };
});
