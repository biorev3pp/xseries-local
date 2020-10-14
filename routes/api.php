<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::apiResource('cities', 'API\CitiesController');
Route::apiResource('communities', 'API\CommunitiesController');

Route::get('/get-cities-list/{id}', 'API\CitiesController@getHtmlList');

Route::get('/get-communities', 'API\CommunitiesController@getActiveList');
Route::get('/get-communities-list/{cid}', 'API\CommunitiesController@getHtmlList');
Route::post('/setlotcount', 'API\CommunitiesController@setlotcount');
Route::post('/sethomeform', 'API\CommunitiesController@sethomeform');
Route::post('/communities/change-status', 'API\CommunitiesController@changeStatus');
Route::post('/get-lots', 'API\CommunitiesController@getLots');
Route::post('/get-all-lots', 'API\CommunitiesController@getAllLots');
Route::post('/disable-lots', 'API\CommunitiesController@disableLots');
Route::post('/filterhome', 'API\CommunitiesController@search');
Route::get('/community-homes/{community_id}', 'API\CommunitiesController@CommunityHomes');
Route::get('/get-gallery/{id}', 'API\CommunitiesController@getGallery');
Route::post('/delete-image', 'API\CommunitiesController@deleteImage');

Route::get('/community/get-features/{id}', 'API\CommunitiesController@getFeatures');
Route::post('/community/update-feature', 'API\CommunitiesController@updateFeature');
Route::post('/community/delete-feature', 'API\CommunitiesController@deleteFeature');

//Floor Status
Route::post('/floorStatus/{id}', 'API\AdminController@floorStatus');

//Community Status
Route::post('/communityStatus/{id}', 'API\AdminController@communityStatus');
Route::post('/communities/update-color-legend', 'API\CommunitiesController@updateColorLegend');
Route::get('/communities/get-color-legend/{id}', 'API\CommunitiesController@getColorLegend');
Route::post('/delete-color-legend', 'API\CommunitiesController@deleteColorLegend');

//Home Status
Route::post('/homeStatus/{id}', 'API\AdminController@homeStatus');

//Color Scheme Status
Route::post('/colorschemeStatus/{id}', 'API\AdminController@colorschemeStatus');

//Color Feature Status
Route::post('/colorfeatureStatus/{id}', 'API\AdminController@colorfeatureStatus');

// Ajax Login
Route::post('/user-login', 'API\LoginController@index');
Route::post('/user-check', 'API\LoginController@check');
Route::post('/user-register', 'API\LoginController@register');
Route::post('/forgot-password', 'API\LoginController@forgotPassword');
Route::post('/update-password', 'API\LoginController@updatePassword');
Route::post('/verify-code', 'API\LoginController@VerifyCode');
// elevation type status
Route::post('/elevationtypestatus/{id}', 'API\AdminController@homeStatus');
Route::post('/contact-mail', 'XplatController@sendMailToAdmin');

// Analytics URLS
Route::post('/admin/analytics', 'Admin\AnalyticsController@analytics')->name('analytics');
Route::get('/get-all-communities', 'Admin\AnalyticsController@getCommunitiesExistsInAnalyticsTable');
Route::post('/get-all-elevation-feature', 'Admin\AnalyticsController@getElevationExistsInFeatureAnalyticsTable');
Route::get('/get-all-communities-lot', 'Admin\AnalyticsController@getCommunitiesExistsInLotAnalyticsTable');
Route::get('/get-all-communities-type', 'Admin\AnalyticsController@getCommunitiesExistsInElevationTypeAnalyticsTable');
Route::get('/get-all-communities-color', 'Admin\AnalyticsController@getCommunitiesExistsInColorSchemeAnalyticsTable');
Route::get('/get-all-communities-upgrade', 'Admin\AnalyticsController@getCommunitiesExistsInColorSchemeUpgradeAnalyticsTable');

Route::post('/get-all-elevations', 'Admin\AnalyticsController@getElevationExistsInElevationTypeAnalyticsTable');
Route::post('/get-all-elevation-types/', 'Admin\AnalyticsController@getElevationTypeExistsInColorSchemeAnalyticsTable');
Route::post('/get-all-elevation-types-upgrade/', 'Admin\AnalyticsController@getElevationTypeExistsInColorSchemeUpgradeAnalyticsTable');
Route::get('/get-all-color-schemes/{id}', 'Admin\AnalyticsController@getColorSchemeExistsInColorSchemeUpgradeAnalyticsTable');

Route::get('/get-all-countries', 'Admin\AnalyticsController@getCountriesExistsInAnalyticsTable');
Route::get('/get-all-states/{country_name}', 'Admin\AnalyticsController@getStatesExistsInAnalyticsTable');
Route::get('/get-all-cities/{state_name}', 'Admin\AnalyticsController@getCitiesExistsInAnalyticsTable');

// New Analytics
Route::Post('/store/analytics','Admin\AnalyticsController@storeAnalytics');
Route::Post('/store/upgrade/analytics','Admin\AnalyticsController@storeUpgradeFeatures');
Route::Post('/store/floor/features/analytics','Admin\AnalyticsController@storeFloorFeatures');
Route::get('/get-home-gallery/{id}', 'API\HomeController@getHomeGallery');
Route::post('/delete-home-image', 'API\HomeController@deleteHomeImage');

Route::Post('/google-sign-in-data','API\LoginController@google_login');
Route::Post('/fb-sign-in-data','API\LoginController@fb_login');
Route::get('/get-admin-roles','Admin\AccountsController@getAdminRoles');
Route::get('/site/settings','Admin\SettingsController@settings');

//ESTIMATE MAIL
Route::post('/email/estimate','Admin\ManagerController@mailEstimate');

// Refresh Plat
Route::get('/refresh-lots', 'XplatController@refresh');
Route::post('/select-elevation-type','API\CommunitiesController@selectElevationType');
Route::post('/get-elevation', 'API\HomeController@getElevation');

Route::post('/get-distance', 'API\HomeController@getDistance');

// Mega Import
Route::apiresource('/mega-import', 'API\ImportController');
Route::post('/map/sheet/columns','API\ImportController@getColumnsToMap');

// Bulk upload APIs
Route::post('/get-all', 'Admin\BulkUploadController@getImagesForSelectedType');
Route::post('/uploads/delete','Admin\BulkUploadController@deleteImage');
Route::post('/get/unmapped/images','Admin\BulkUploadController@unmappedImages');
Route::post('/clean/dir','Admin\BulkUploadController@cleanDir');
Route::get('/community','Admin\BulkUploadController@getAllCommunities');
Route::get('/community/home/{id}','Admin\BulkUploadController@getAllHomesForCommunity');
Route::get('/community/home/floor/{id}','Admin\BulkUploadController@getAllHomesFloor');
Route::get('/community/home/data/{id}','Admin\BulkUploadController@getAllHomeRelatedData');
Route::get('/community/home/type/colorscheme/{id}','Admin\BulkUploadController@getAllHomeTypesColorSchemeForHomeType');
Route::post('/community/images/','Admin\BulkUploadController@imagesExistInDatabaseForSelectedType');
/** Bulk Image Uploads */
Route::get('/options/{type}','Admin\BulkUploadController@getDropDownOptions');
Route::post('/update/image','Admin\BulkUploadController@updateImage');
Route::post('/bulk/upload','Admin\BulkUploadController@confirmedUploadNow');