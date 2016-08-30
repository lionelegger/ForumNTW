# Project #1: Forum
made by [Lionel EGGER](mailto:lionelegger@gmail.com)

##Server PHP
Installation of MAMP with phpMyAdmin (that administrates mySQL)

## Creation of CakePHP Application Skeleton

[![Build Status](https://img.shields.io/travis/cakephp/app/master.svg?style=flat-square)](https://travis-ci.org/cakephp/app)
[![License](https://img.shields.io/packagist/l/cakephp/app.svg?style=flat-square)](https://packagist.org/packages/cakephp/app)

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
  message VARCHAR(255) NOT NULL,
  created DATETIME DEFAULT NULL,
  modified DATETIME DEFAULT NULL,
  FOREIGN KEY question_key(question_id) REFERENCES questions(id),
  FOREIGN KEY user_key(user_id) REFERENCES users(id)
);
```

Now all traffic lights are green when accessing the [http://localhost:8888](http://localhost:8888/).

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

### Modifications for USERS:

* /src/Controller/Component/UsersContoller.php :
    - function login() : Log in a user and redirects to homepage
    - function logout() : Log out a user and redirects to homepage
    - function current() : Allows us to know the current user logged and 



