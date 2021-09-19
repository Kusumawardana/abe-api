<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', 'login@index');

$router->post('/login/proses', 'login@proseslogin');
$router->get('/login/profile/{id}','login@profile');
$router->get('/logout/{id}', 'login@logout');

$router->get('/berita/read/{from}/{to}/{id}/', 'beritas@read');
$router->get('/berita/read/{from}/{to}/{id}/{search}', 'beritas@search');
$router->get('/pengumuman/read/{from}/{to}/{id}', 'pengumumans@read');
$router->get('/pengumuman/read/{from}/{to}/{id}/{search}', 'pengumumans@search');
$router->get('/jenisflashcard/read/{id}', 'jenisflashcards@read');
$router->get('/flashcard/read/{from}/{to}/{type}/{id}', 'flashcards@readtype');
$router->get('/flashcard/read/{from}/{to}/{type}/{id}/{search}', 'flashcards@readtypesearch');
$router->get('/flashcard/readall/{type}/{id}', 'flashcards@readall');
$router->get('/flashcard/myread/{from}/{to}/{id}', 'flashcards@myread');
$router->get('/flashcard/myread/{from}/{to}/{id}/{search}', 'flashcards@myreadsearch');
$router->get('/flashcard/readvalid/{id}', 'flashcards@readvalid');
$router->get('/flashcard/mydelete/{id}', 'flashcards@mydelete');
$router->get('/flashcard/myread/{id}/{search}', 'flashcards@myreadsearch');
$router->get('/pengguna/read/{id}/{jenis}', 'penggunas@read');
$router->get('/jenispengguna/read/{id}', 'jenispenggunas@read');

$router->get('/anak/readanak/{from}/{to}/{id}', 'anaks@readanak');
$router->get('/anak/readanak/{from}/{to}/{id}/{search}', 'anaks@readanaksearch');

$router->get('/anak/readspesific/{from}/{to}/{id}', 'anaks@readspesific');
$router->get('/anak/readspesific/{from}/{to}/{id}/{search}', 'anaks@readspesificsearch');
$router->get('/perkembangan/read/{from}/{to}/{id}/{anak}', 'perkembangans@readanak');
$router->get('/perkembangan/read/{from}/{to}/{id}/{anak}/{search}', 'perkembangans@readanaksearch');
$router->get('/perkembangan/delete/{id}/{item}', 'perkembangans@delete');
$router->post('/perkembangan/create', 'perkembangans@create');
$router->get('/respon/read/{id}/{perkembangan}', 'respons@read');
$router->post('/respon/createortu', 'respons@createortu');
$router->get('/respon/deleteortu/{id}/{id2}', 'respons@deleteortu');
$router->get('/dibagikan/readpenerima/{id}', 'dibagikans@readpenerima');
$router->get('/dibagikan/readpengirim/{id}', 'dibagikans@readpengirim');
$router->get('/perbedaan/readadmin/{id}', 'perbedaans@readadmin');
$router->get('/perbedaan/myread/{id}', 'perbedaans@myread');



$router->post('/feedback/create', 'feedbacks@create');
$router->post('/dibagikan/create', 'dibagikans@create');

