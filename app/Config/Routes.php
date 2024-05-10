<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/home', 'Home::home');
$routes->get('/user/login', 'User::login');
$routes->get('/user/register', 'User::register');
$routes->get('/profile', 'User::logout');
$routes->get('/questions', 'Questions::create');
$routes->get('/search', 'Questions::search');
$routes->get('/myquestions', 'Questions::MyQuestions');
$routes->get('/answers', 'Answers::createAnswer');
$routes->post('/user/register', 'User::register');
$routes->post('/user/login', 'User::login');
$routes->post('/questions', 'Questions::create');
$routes->post('/myquestions', 'Questions::MyQuestions');
$routes->post('/answers', 'Answers::createAnswer');
$routes->post('/questionVote', 'Questions::vote');
$routes->post('/answerVote', 'Answers::vote');
$routes->post('/marked', 'Answers::mark');
$routes->post('/comments', 'Answers::comment');

$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
