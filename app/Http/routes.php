<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

// Route::get('/', 'KnowledgesController@index');
// Route::resource('knowledges', 'KnowledgesController');

//ユーザー登録　
Route::get('signup', 'Auth\AuthController@getRegister')->name('signup.get');
Route::post('signup', 'Auth\AuthController@postRegister')->name('signup.post');

//ログイン認証
Route::get('login', 'Auth\AuthController@getLogin')->name('login.get');
Route::post('login', 'Auth\AuthController@postLogin')->name('login.post');
Route::get('logout', 'Auth\AuthController@getLogout')->name('logout.get');

//ログイン後の操作
Route::group(['middleware' => 'auth'], function() {
Route::resource('knowledges', 'KnowledgesController');
Route::get('register', 'KnowledgesController@register')->name('knowledges.register'); //knowledge登録画面への遷移ルーティング

Route::resource('fields', 'FieldsController');

//Route:: ~ ()の一番最初の''で囲った箇所はURI URLの中の特定のページ
// /users/1/knowdges/3　の１と３は変数。これを　 /users/{user_id}/knowdges/{id}　と書く　あるユーザーの複数あるうちの特定のKnowledgeのページ
// route('knowdges.show', [$user->id, $knowledges->id]);　と　
// action('KnowledgesController@show', [$user->id, $knowledges->id]);　は同じこと。
// Route::get('/users/{user_id}/knowdges/{id}/fields/{field_id}', 'KnowledgesController@show')->name('knowdges.show');
//上はあるuserにblongToするKnoweldgeのうちの特定の一つのKnowledgeにblongToする分野のページへのRouting
//KnowledgessControllerのshow()において変数$fieldを扱うにはRoutingでここまで指定する必要がある

});
