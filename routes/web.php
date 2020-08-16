<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
    ->middleware('checkRole');      - prihlásený
    ->middleware('checkRole:1');    - moderáror
    ->middleware('checkRole:2');    - admin
    ->middleware('checkRole:god');  - hlavný admin
 *  */



Route::get('/', 'HomeController@index')->name('/');
Route::get('home', 'HomeController@index')->name('home');

Route::get('kontakt-admin', 'HomeController@contactAdmin')->name('home.contactAdmin');
Route::post('kontakt-admin', 'HomeController@contactAdminSave');


//AUTH ROUTES
    //Auth::routes();
    Route::get('prihlasit', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('prihlasit', 'Auth\LoginController@login');
    Route::get('odhlasit', 'Auth\LoginController@logout')->name('logout')->middleware('checkRole');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

    Route::get('registracia', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('registracia', 'Auth\RegisterController@register');

    //OAUTH LOGIN
    Route::get('oauth/{service}', 'Auth\LoginController@redirectToProvider')->name('oauth.login');
    Route::get('oauth/{service}/callback', 'Auth\LoginController@handleProviderCallback');
//https://tjspacince.sk/oauth/facebook/callback

//ADMIN
    Route::get('admin', 'Admin\AdminController@index')->name('admin.index')->middleware('checkRole:2');
    Route::get('admin/uzivatelia', 'Admin\UserController@index')->name('admin.user.index')->middleware('checkRole:2');
    Route::get('admin/kontakt-admin', 'Admin\AdminController@contactsList')->name('admin.kontakt-admin')->middleware('checkRole:2');
    Route::get('admin/kontakt-admin/{msgID}', 'Admin\AdminController@contactsShow')->name('admin.kontakt-admin.showDetail')->middleware('checkRole:2');
    Route::post('admin/kontakt-admin/{msgID}', 'Admin\AdminController@contactsReadSwitch')->name('admin.kontakt-admin.contactsReadSwitch')->middleware('checkRole:2');
    Route::delete('admin/kontakt-admin/{msgID}', 'Admin\AdminController@contactsReadDel')->name('admin.kontakt-admin.contactsReadDel')->middleware('checkRole:2');

    Route::delete('admin/uzivatelia/{user_id}/vymazat', 'Admin\UserController@delete')->name('admin.user.delete')->middleware('checkRole:2');


//ARTICLES
    Route::get('admin/clanky', 'ArticleController@adminList')->name('article.adminList')->middleware('checkRole:1');
    Route::get('clanok/pridat', 'ArticleController@create')->name('article.create')->middleware('checkRole:1');
    Route::post('clanok/pridat', 'ArticleController@store')->middleware('checkRole:1');
    Route::get('clanok/{article_id}/upravit', 'ArticleController@edit')->name('article.edit')->middleware('checkRole:1');
    Route::patch('clanok/{article_id}/upravit', 'ArticleController@update')->middleware('checkRole:1');
    Route::delete('clanok/{article_id}/vymazat', 'ArticleController@delete')->name('article.delete')->middleware('checkRole:2');
    Route::get('clanky', 'ArticleController@index')->name('article.index');
    Route::get('clanky/{tag}', 'ArticleController@index')->name('article.index.tag');
    Route::get('clanok/{article_slug}', 'ArticleController@show')->name('article.show');

//PAGES
    Route::get('admin/stranky', 'PageController@adminList')->name('page.adminList')->middleware('checkRole:1');
    Route::get('stranka/pridat', 'PageController@create')->name('page.create')->middleware('checkRole:1');
    Route::post('stranka/pridat', 'PageController@store')->middleware('checkRole:1');
    Route::get('stranka/{page_id}/upravit', 'PageController@edit')->name('page.edit')->middleware('checkRole:1');
    Route::patch('stranka/{page_id}/upravit', 'PageController@update')->middleware('checkRole:1');
    Route::delete('stranka/{page_id}/vymazat', 'PageController@delete')->name('page.delete')->middleware('checkRole:2');


//CLUBS
    Route::get('admin/kluby', 'ClubController@adminList')->name('club.adminList')->middleware('checkRole:1');
    Route::get('klub/pridat', 'ClubController@create')->name('club.create')->middleware('checkRole:1');
    Route::post('klub/pridat', 'ClubController@store')->middleware('checkRole:1');
    Route::get('klub/{club_id}/upravit', 'ClubController@edit')->name('club.edit')->middleware('checkRole:1');
    Route::patch('klub/{club_id}/upravit', 'ClubController@update')->middleware('checkRole:1');
    Route::delete('klub/{club_id}/vymazat', 'ClubController@delete')->name('club.delete')->middleware('checkRole:2');
    Route::get('klub/{club}', 'ClubController@show')->name('club.show');
    Route::get('autocomplete_club', 'ClubController@search');

//PLAYERS
    Route::get('admin/hraci', 'PlayerController@adminList')->name('player.adminList')->middleware('checkRole:1');
    Route::get('admin/hraci/{active}', 'PlayerController@adminList')->middleware('checkRole:1');

    Route::get('hraci', 'PlayerController@index')->name('player.players');
    Route::get('hraci/{season_name}', 'PlayerController@index');
    Route::get('hrac/pridat', 'PlayerController@create')->name('player.create')->middleware('checkRole:1');
    Route::post('hrac/pridat', 'PlayerController@store')->middleware('checkRole:1');
    Route::get('hrac/{player_id}/upravit', 'PlayerController@edit')->name('player.edit')->middleware('checkRole:1');
    Route::patch('hrac/{player_id}/upravit', 'PlayerController@update')->middleware('checkRole:1');
    Route::get('hrac/{player_id}', 'PlayerController@show')->name('player.show');
    Route::put('hrac/{player_id}/switchactive', 'PlayerController@switchactive')->name('player.switchactive');
    Route::delete('hrac/{player_id}/vymazat', 'PlayerController@delete')->name('player.delete')->middleware('checkRole:2');


//ADMIN - SEASONS
    Route::get('admin/seasons', 'Admin\SeasonController@index')->name('admin.seasons.index')->middleware('checkRole:2');
    Route::post('admin/seasons', 'Admin\SeasonController@store')->middleware('checkRole:2');
    Route::patch('admin/seasons/{season_id}/upravit', 'Admin\SeasonController@edit')->name('admin.seasons.edit')->middleware('checkRole:2');
    Route::put('admin/seasons/{season_id}/aktivovat', 'Admin\SeasonController@activation')->name('admin.seasons.activation')->middleware('checkRole:2');
    Route::delete('admin/seasons/{season_id}/vymazat', 'Admin\SeasonController@delete')->name('admin.seasons.delete')->middleware('checkRole:3');

//ADMIN - TEAMS
    Route::get('admin/teams', 'Admin\TeamController@index')->name('admin.teams.index')->middleware('checkRole:2');
    Route::post('admin/teams', 'Admin\TeamController@store')->middleware('checkRole:2');
    Route::patch('admin/teams/{team_id}/upravit', 'Admin\TeamController@edit')->name('admin.teams.edit')->middleware('checkRole:2');
    Route::put('admin/teams/{team_id}/aktivovat', 'Admin\TeamController@activation')->name('admin.teams.activation')->middleware('checkRole:2');
    Route::delete('admin/teams/{team_id}/vymazat', 'Admin\TeamController@delete')->name('admin.teams.delete')->middleware('checkRole:3');


//MACTHS
    Route::get('zapas/pridat', 'MatchController@create')->name('matchs.create')->middleware('checkRole:1');
    Route::post('zapas/pridat', 'MatchController@store')->middleware('checkRole:1');
    Route::get('zapas/{match_id}/upravit', 'MatchController@edit')->name('matchs.edit')->middleware('checkRole:1');
    Route::patch('zapas/{match_id}/upravit', 'MatchController@update')->middleware('checkRole:1');
    Route::put('zapas/{match_id}/upravit', 'MatchController@setResult')->name('matchs.setResult')->middleware('checkRole:1');
    Route::get('admin/zapas/adminList/{team_slug}/{season_id}', 'MatchController@adminList')->middleware('checkRole:1');
    Route::get('admin/zapas/adminList/{team_slug}', 'MatchController@adminList')->middleware('checkRole:1');
    Route::get('admin/zapas/adminList', 'MatchController@adminList')->name('admin.matchs.adminList')->middleware('checkRole:1');

    
    Route::get('zapasy/{team_slug}/{season_slug}/json', 'MatchController@getMatchsJSON');
    Route::get('zapasy/{team_slug}', 'MatchController@index')->name('matchs.index');
    Route::get('zapasy/{team_slug}/{season_slug}', 'MatchController@index');
    

    Route::delete('zapas/{match_id}/vymazat', 'MatchController@delete')->name('matchs.delete');
    Route::get('zapas/{match}', 'MatchController@show')->name('matchs.show');

//TABLES
    Route::get('tabulka/pridat', 'Admin\TableController@create')->name('tables.create')->middleware('checkRole:1');
    Route::post('tabulka/pridat', 'Admin\TableController@store')->middleware('checkRole:1');
    Route::get('admin/tabulka/adminList', 'Admin\TableController@adminList')->name('admin.tables.adminList')->middleware('checkRole:1');
    Route::get('admin/tabulka/adminList/{team_slug}', 'Admin\TableController@adminList')->middleware('checkRole:1');

    Route::get('tabulka/{table_id}/upravit', 'Admin\TableController@edit')->name('tables.edit')->middleware('checkRole:1');
    Route::patch('tabulka/{table_id}/upravit', 'Admin\TableController@update')->middleware('checkRole:1');
    Route::delete('admin/tabulka/{table_id}/vymazat', 'Admin\TableController@delete')->name('admin.tables.delete')->middleware('checkRole:2');

    Route::get('tabulka/{team_slug}/{season_slug}/json', 'Admin\TableController@getTableJSON');
    Route::get('tabulka/{team_slug}/{season_slug}', 'Admin\TableController@show');
    Route::get('tabulka/{team_slug}', 'Admin\TableController@show')->name('tables.show');
    Route::get('tabulka', 'Admin\TableController@show');

// PLAYER STATISTCS
    Route::get('admin/statistikazapasu/{match_id}', 'MatchController@setMatchStats')->name('admin.playerstatistic')->middleware('checkRole:1');
    Route::get('admin/statistikazapasu/{match_id}/{active}', 'MatchController@setMatchStats')->middleware('checkRole:1');
    Route::patch('admin/statistikazapasu/{match_id}', 'MatchController@saveMatchStats')->middleware('checkRole:1');
    Route::patch('admin/statistikazapasu/{match_id}/{active}', 'MatchController@saveMatchStats')->middleware('checkRole:1');


//PDF
    Route::get('plagat', 'PDFController@plagat')->name('pdf.plagat');
    Route::get('plagat/{date}', 'PDFController@plagat');
    Route::get('listky/{key}/{type}/{count}', 'PDFController@tickets');
    Route::get('listky/{key}/{type}', 'PDFController@tickets');
    Route::get('listky/{key}', 'PDFController@tickets')->name('pdf.tickets');
    Route::get('rozlosovanie', 'PDFController@fixtures')->name('pdf.fixtures');
    Route::post('rozlosovanie', 'PDFController@getFixtures');

//CRON
    Route::get('cron/plagat/{key}', 'CronController@plagat');

// REKLAMA
    Route::get('admin/reklama/kampane', 'AdCampaignsController@index')->name('admin.reklama.kampane')->middleware('checkRole:2');
    Route::post('admin/reklama/kampane', 'AdCampaignsController@store')->middleware('checkRole:2');
    Route::get('admin/reklama/kampane/{campaign}', 'AdCampaignsController@edit')->name('admin.reklama.kampane.edit')->middleware('checkRole:2');
    Route::patch('admin/reklama/kampane/{campaign}', 'AdCampaignsController@update')->middleware('checkRole:2');
    Route::delete('admin/reklama/kampane/{campaign}', 'AdCampaignsController@delete')->middleware('checkRole:2');

    Route::get('admin/reklamy/{campaign}', 'AdController@index')->name('admin.reklama')->middleware('checkRole:2');
    Route::post('admin/reklamy/{campaign}', 'AdController@store')->middleware('checkRole:2');
    Route::get('admin/reklama/{ad}', 'AdController@edit')->name('admin.reklama.edit')->middleware('checkRole:2');
    Route::patch('admin/reklama/{ad}', 'AdController@update')->middleware('checkRole:2');
    Route::delete('admin/reklama/{ad}', 'AdController@delete')->middleware('checkRole:2');

    Route::get('api/reklama/show/{size}', 'AdController@show');
    Route::get('api/reklama/click/{ad}', 'AdController@click');


// STRANKY - POSLEDNA VOLI TOMU ZE AZ NAKONIEC IDEME HADAT SEM
    Route::get('{page_slug}', 'PageController@show')->name('page.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
