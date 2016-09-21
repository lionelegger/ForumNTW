# Project #1: Forum
made by [Lionel EGGER](mailto:lionelegger@gmail.com)

##Server PHP
Installation of MAMP with phpMyAdmin (that administrates mySQL)

## Creation of CakePHP Application Skeleton

A skeleton for creating applications with [CakePHP](http://cakephp.org) 3.x.
The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

### Installation

1. Download [Composer](http://getcomposer.org/doc/00-intro.md) or update `composer self-update`:
A. In shell, go to the directory where you want to install composer
B. run the following instructions:
```sql
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('SHA384', 'composer-setup.php') === 'e115a8dc7871f15d853148a7fbac7da27d6c0030b848d9b3dc09e2a0388afed865e6a3d6b3c0fad45c48e2b5fc1196ae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
```
2. Run `php composer.phar create-project --prefer-dist cakephp/app Forum`.

You should now be able to visit the path to where you installed the app and see the setup traffic lights.

### Configuration
Edition of `config/app.php` and setup the 'Datasources' and any other configuration relevant for the application:
- username: ‘root’
- password: ‘root’
- database: ‘Forum’


## creation of Forum DATABASE
Creation of a DATABASE called 'Forum' in phpMyAdmin
The relational design of the FORUM database is illustrated in [this powerpoint](database.pptx)

### Creation of 3 tables
Creation of the 3 tables in phpMyAdmin

#### TABLE users
```sql
CREATE TABLE users(
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  role VARCHAR(20) NOT NULL,
  created DATETIME DEFAULT NULL,
  modified DATETIME DEFAULT NULL
);
```
#### TABLE questions
```sql
CREATE TABLE questions(
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  title VARCHAR(50) NOT NULL,
  body TEXT NOT NULL,
  created DATETIME DEFAULT NULL,
  modified DATETIME DEFAULT NULL,
  answers_count INT NOT NULL,
  FOREIGN KEY user_key(user_id) REFERENCES users(id)
);
```

#### TABLE answers
```sql
CREATE TABLE answers(
  id INT AUTO_INCREMENT PRIMARY KEY,
  question_id INT NOT NULL,
  user_id INT NOT NULL,
  message TEXT NOT NULL,
  created DATETIME DEFAULT NULL,
  modified DATETIME DEFAULT NULL,
  FOREIGN KEY question_key(question_id) REFERENCES questions(id),
  FOREIGN KEY user_key(user_id) REFERENCES users(id)
);
```

Now all traffic lights are green when accessing the [http://localhost:8888](http://localhost:8888/).

## CAKEPHP 3

### Generation of elements users, questions and answers
In shell, run the following instructions.
```sh
bin/cake bake all Users
bin/cake bake all Questions
bin/cake bake all Answers
```


### Creating RESTful Routes
[CAKEPHP documentation](http://book.cakephp.org/3.0/en/development/routing.html#resource-routes)

In *config/routes.php*:
```php
Router::scope('/', function ($routes) {
    $routes->extensions(['json']);
    $routes->resources('Questions');
    $routes->resources('Users');
    $routes->resources('Answers');
});
```


Now you get a json file when you make requests like [http://localhost:8888/questions/index.json](http://localhost:8888/questions/index.json) or
[http://localhost:8888/questions/view/1.json](http://localhost:8888/questions/view/1.json)


### User accounts type preparation
Follow Exercice5 of TP CakePHP2.pdf
Creation of 3 types of accounts:
* **Admin** (can delete any question or answer of anybody)
* **Author** (can create or answer a question; can delete only his own questions and answers)
* **User** (can only view but cannot ask a question. But user can add an answer and edit/delete his own answers)

Creation of 6 accounts (password is always 'password'):
1. admin@email.com (Admin)
2. nicolas@email.com (Author)
3. camille@email.com (Author)
4. author@email.com (Author)
5. lionel@email.com (User)
6. user@email.com (User)


### CakePHP [USERS controller](/src/Controller/Component/UsersController.php):

* function login() : Log in a user and redirects to homepage
* function logout() : Log out a user and redirects to homepage
* function current() : Gets the current user logged


### CakePHP [QUESTIONS controller](/src/Controller/Component/QuestionsController.php):

* function index() : lists all questions (with users information)
* function view() : Renders a specific question (id) with its corresponding answers (and users who post them)
* function add() : Add a new question (post method)
* function edit() : Edit a question
* function delete() : Delete a question
* function isAuthorized() : Set the rights to add/edit/delete a question
    - Admin: can add a question and edit/delete any question
    - Author: can add a question and edit/delete his own questions only
    - User: can only see questions but not add/edit/delete a question
* function search() : search in title and body of the question (used in search page)


### CakePHP [ANSWERS controller](/src/Controller/Component/AnswersController.php):

* function add() : Add a new answer (post method)
* function edit() : Edit an answer
* function delete() : Delete an answer
* function isAuthorized() : Set the rights to add/edit/delete a question
    - Admin: can add a answer and edit/delete any answer
    - Author & User: can add an answer and edit/delete his own answers only
* function search() : search in message of the answer (used in search page). When we search in the answers, we get the relative question also.


### CakePHP [HOMEPAGE](/src/Template/Pages/home.ctp)

This page contains the main html structure of all other pages. It contains the <head> and all files inclusions (like css and js files)
It contains also the navigation (nav) where you can find the navigation, as well as the login/logout functionality.
The AnjularJs application "ng-app" is defined at the body level of this page and runs the "MainCtrl" (defined in [controllers.js](webroot/js/controllers.js)).
The AngularJs templates are loaded in the div.container using ngView directive (see below in app.js)


## ANGULARJS controllers

### [app.js](/webroot/js/app.js)

A specific templateUrl is loaded in the div.container of the homepage using the directive ngView (using ngRoute service defined in js/app.js)

* when "/questions", it loads the templateUrl "partial/questions.html" and runs the QuestionsCtrl
* when "/questions/:id", it loads the templateUrl "partial/answers.html" and runs the AnswersCtrl
* when "/search", it loads the templateUrl "partial/search.html" and runs the SearchCtrl


### [Controllers.js](/webroot/js/controllers.js)

#### MainCtrl
* The first function gets the current user (in order to show/hide the actions buttons relatively to the current user)
* The second function will logout the user
* The third function help us to know which is the current page in order to highlight it in the navigation

#### QuestionsCtrl
* The first function loads the full list of questions.
    This function is called when the controller is runned (when the template answers.html loads) but also at the end of the functions add, edit and delete functions in order to refresh the list.
* The second and third functions are the two step to edit a question.
    The first steps loads the question title and body in the modal.
    The second steps saves it in the database.
* The fourth function adds a question in the database.
* The last two functions are responsible to delete a question.
    The first steps asks confirmation and provides the question data.
    The second one performs the actual deletion.

#### AnswersCtrl
* The first function loads the full list of answers corresponding to a specific question.
    This function is called when the controller is runned (when the template answers.html loads) but also at the end of the function add, edit and delete in order to refresh the list.
* The other functions are very similar to the functions found in QuestionsCtrl to add, edit and delete answers.

#### SearchCtrl
* When the search function is called, we have two different cases: we can search in the questions or/and in the answers (or none of them).
    The difference is that when we perform a search in answers, we also get the corresponding question (see the search function of the AnswersCtrl)





