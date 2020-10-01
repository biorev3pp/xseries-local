<?php

Auth::routes();

/*-------  Front Links -----------------------------------------------*/

Route::get('/', 'SearchController@index')->name('welcome');
Route::get('/community', 'SearchController@community')->name('community');
Route::get('/community/{id}/{type_id?}', 'SearchController@elevationCommunities')->name('elevation-communities');
Route::get('/subcommunity', 'SearchController@community')->name('subcommunity');
Route::get('/elevations', 'SearchController@elevations')->name('elevation');
Route::get('/search-elevations', 'SearchController@searchElevations')->name('search-elevation');
Route::get('/plats/{id}/{home_id}/{home_type_id}', 'XplatController@plat')->name('xplat');
Route::get('/plat', 'XplatController@index')->name('plat');
Route::get('/floor/{community_slug}/{home_slug}/{home_type_slug?}', 'XfloorController@index')->name('xfloor');
Route::post('/floor/pricesession', 'XfloorController@priceSession');

Route::get('/home/{community_slug}/{home_slug}/{home_type_slug?}', 'XhomeController@index')->name('xhome');
Route::get('/viewpdf', 'HomeController@viewPdf');

Route::get('/xplat/search', 'XplatController@search');
/*--------------------------------------------------------------------*/

/*-------  Temprarory Modules Link -----------------------------------*/
Route::get('/xfloor', 'XfloorController@index')->name('floor');

/*--------------------------------------------------------------------*/

Route::get('admin/login', function() {  
    if(Auth::id()) {
        if(Auth::user()->admin_role_id == 2){

          return redirect('/');   

        }
         if(Auth::user()->admin_role_id==4)
        {
          return redirect(route('manager-dashboard'));   
        }
        return redirect(route('dashboard')); 
        
    }
    return view('admin.login');
})->name('admin-login');

Route::post('/admin/login', 'Auth\LoginController@adminLogin')->name('admin-login-check');

/*------------  Admin Section  ----------------------------------------*/

Route::get('/admin', 'Admin\DashboardController@index')->name('home')->middleware('auth');
Route::group(['prefix'=>'admin','middleware'=>'auth','admin_role_check'], function () { 

    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
	Route::get('/states', 'Admin\DashboardController@listStates')->name('states');
    Route::get('/states/cities', 'Admin\DashboardController@listCities')->name('cities');
    Route::get('/syncing-data', 'Admin\DashboardController@syncingData')->name('syncing-data');
    

    // Analytics URLS
    Route::get('/analytics', 'Admin\AnalyticsController@index')->name('analytics');

    /// Community URLS
    Route::get('/communities', 'Admin\CommunitiesController@index')->name('communities');
    Route::get('/communities/add', 'Admin\CommunitiesController@add')->name('add-community');
    Route::get('/communities/view/{id}', 'Admin\CommunitiesController@view')->name('view-community');
    Route::post('/communities/create', 'Admin\CommunitiesController@create')->name('create-community');
    Route::get('/communities/edit/{id}', 'Admin\CommunitiesController@edit')->name('edit-community');
    Route::post('/communities/modify/{id}', 'Admin\CommunitiesController@modify')->name('modify-community');
    Route::post('/communities/view', 'Admin\CommunitiesController@bulkEdit')->name('bulk-edit');
    Route::post('/communities/delete', 'Admin\CommunitiesController@destroy')->name('delete-community');
    Route::post('/communities/upload_csv', 'Admin\CommunitiesController@upload_csv')->name('upload-csv');
    Route::post('/communities/nearby_locations', 'Admin\CommunitiesController@nearbyLocations')->name('nearby_locations');
    Route::post('/communities/add_new_locations', 'Admin\CommunitiesController@addNewLocations')->name('add_new_locations');
    Route::post('/communities/delete_new_locations', 'Admin\CommunitiesController@deleteNewLocations')->name('delete_new_locations');
    Route::post('/communities/changeStatus/{id}', 'Admin\CommunitiesController@changeStatus');

    // For community image gallery 
    Route::post('/uploadFile','Admin\CommunitiesController@uploadFile')->name('uploadFile');
	
	//Community Homes
	Route::get('/communities/homes/{community_id}', 'Admin\CommunitiesController@CommunityHomes')->name('communities_homes');
	Route::post('/communities/homes/store', 'Admin\CommunitiesController@storeCommunityHomes')->name('save_communities_homes');
    Route::post('/homes/updateStatus/{id}', 'Admin\HomeController@updateStatus');
    Route::get('/communities/homes/destroy/{id}', 'Admin\CommunitiesController@destroyCommunityHomes');
	
	//Lot Homes
    Route::get('/communities/lot/homes/{community_id}/{lot_id}', 'Admin\CommunitiesController@LotHomes')->name('lot_homes');
    Route::post('communities/lot/homes/store', 'Admin\CommunitiesController@storeLotHomes')->name('save_lot_homes');
    Route::post('communities/lot/homes/delete', 'Admin\CommunitiesController@destroyLotHomes')->name('delete_lot_homes');
    Route::post('/communities/update_lot', 'Admin\CommunitiesController@update_lot')->name('update-lot');
    Route::post('/lot/{id}','Admin\CommunitiesController@lotdelete')->name('lotdelete');
    Route::post('/edit/plat/image', 'Admin\CommunitiesController@editSvgOrImage')->name('edit_plat_image');
    Route::get('/homes', 'Admin\PagesController@homes')->name('homes');
    Route::get('homes/features/{id}', 'Admin\FeaturesController@index')->name('features');
    Route::get('homes/features/create/{id}', 'Admin\FeaturesController@create')->name('create_feature');
    Route::get('homes/features/edit/{id}', 'Admin\FeaturesController@edit')->name('edit_feature');
    Route::post('homes/features/{id}', 'Admin\FeaturesController@store')->name('save_feature');
    Route::post('homes/features/edit/{id}','Admin\FeaturesController@update')->name('update_feature');
    Route::post('features/delete', 'Admin\FeaturesController@delete')->name('delete_feature');
    Route::post('/homes/features', 'Admin\FeaturesController@upload_csv')->name('upload-feature-csv');

    //Home Routes
	Route::get('/homes', 'Admin\HomeController@index')->name('homes');
    Route::get('/homes/{home_id}', 'Admin\HomeController@edit')->name('edit_homes');
    Route::post('/homes/update', 'Admin\HomeController@update')->name('update_homes');
    Route::post('/homes/store', 'Admin\HomeController@store')->name('save_homes');
    Route::get('/homes/destroy/{id}', 'Admin\HomeController@destroy');

    // Home Elevation type route
    Route::get('/homes/elevation_type/{home_id}', 'Admin\HomeController@listHomeElevationType')->name('homes_elevation_type');
    Route::get('/homes/elevation_type/edit/{id}/', 'Admin\HomeController@editElevationType')->name('elevation_type_edit');
    Route::post('/homes/elevations/store', 'Admin\HomeController@createElevation')->name('save_elevation');
    Route::get('/homes/elevation_type_delete/{id}', 'Admin\HomeController@destroyElevationType');
    Route::post('/homes/elevation/update', 'Admin\HomeController@updateElevation')->name('update_homes_elevation');
    Route::post('/homes/elevation_type/upload_csv', 'Admin\HomeController@upload_home_type_csv')->name('upload-elevations-type-csv');
    Route::get('/homes/gallery/{id}', 'Admin\HomeController@gallery')->name('view-gallery');
    Route::get('/homes/type/gallery/{id}', 'Admin\HomeController@typeGallery')->name('view-type-gallery');


    //Home Color Scheme Routes
    Route::get('/homes/color_scheme/{home_id}', 'Admin\HomeController@listColorScheme')->name('homes_color_scheme');
    Route::get('/homes/type/color_scheme/{home_id}', 'Admin\HomeController@listTypeColorScheme')->name('homes_type_color_scheme');
    Route::get('/homes/color_scheme_edit/{color_scheme_id}', 'Admin\HomeController@editColorScheme')->name('color_scheme_edit');
    Route::post('/homes/color_scheme_update', 'Admin\HomeController@updateColorScheme')->name('color_scheme_update');
    Route::post('/homes/color_scheme/store', 'Admin\HomeController@storeColorScheme')->name('save_color_scheme');
    Route::post('/homes/color_scheme/store/csv', 'Admin\HomeController@storeColorSchemeCSV')->name('upload-color-scheme-csv');
    Route::post('/homes/color_scheme/store/feature/csv', 'Admin\HomeController@storeColorSchemeFeatureCSV')->name('upload-color-scheme-feature-csv');
    /*Route::post('/homes/color_scheme_delete', 'Admin\HomeController@destroyColorScheme')->name('color_scheme_delete');*/
    Route::get('/homes/color_scheme_delete/{id}', 'Admin\HomeController@destroyColorScheme');

    //Home Color Features Routes
    Route::get('/homes/color_features/{color_scheme_id}', 'Admin\HomeController@listFeature')->name('color_features');
    Route::get('/homes/color_features_edit/{feature_id}', 'Admin\HomeController@editFeature')->name('color_features_edit');
    Route::post('/homes/color_features_update', 'Admin\HomeController@updateFeature')->name('color_features_update');
    Route::post('/homes/color_features/store', 'Admin\HomeController@storeColorFeature')->name('color_features_save');

    Route::post('/homes/upgrade_features/store', 'Admin\HomeController@storeUpgradeFeature')->name('upgrade_features_save');
    Route::post('/homes/upgrade_features/check', 'Admin\HomeController@checkUpgradeFeature')->name('checkUpgrade');
    Route::get('/homes/color_features/delete/{id}', 'Admin\HomeController@destroyColorFeature');
    Route::post('/homes/upgrade_images/store', 'Admin\HomeController@storeUpgradeImage')->name('upgrade_image_save');

    //Floor Routes
    Route::get('/floors', 'Admin\FloorController@index')->name('new_floors');
    Route::get('/floors/create', 'Admin\FloorController@create');
    Route::get('/floors/edit/{id}', 'Admin\FloorController@edit');
    Route::post('/floors', 'Admin\FloorController@store');
    Route::post('/floors/edit/{id}','Admin\FloorController@update');
    Route::get('/floors/{id}','Admin\FloorController@delete');

     //Floor ACL Settings Routes
    Route::get('features/set-acl/{id}', 'Admin\FeaturesController@setACLOptions')->name('feature_acl_option');
    Route::post('features/get_acl_form', 'Admin\FeaturesController@getACLRow')->name('feature_acl_row');
    Route::post('features/save-acl', 'Admin\FeaturesController@saveAclSettings')->name('saveAclSettings');
    Route::get('features/view-set-acl/{id}', 'Admin\FeaturesController@deleteAclSettings')->name('deleteAclSettings');
    Route::post('features/re_order_list', 'Admin\FeaturesController@reOrderList');

	//Admin Profile Routes
    Route::get('profile', 'Admin\ProfileController@index')->name('profile');
    Route::get('profile/edit/{id}','Admin\ProfileController@edit')->name('editprofile');
    Route::post('profile/edit/{id}','Admin\ProfileController@update');

    //Change Password Routes
    Route::get('profile/changepassword','Admin\ProfileController@showChangePasswordForm')->name('showChangePasswordForm');
    Route::post('profile/changepassword','Admin\ProfileController@changePassword')->name('changePassword');

    //Configuration Settings Routes
    Route::get('settings', 'Admin\SettingsController@index')->name('settings');
    Route::post('settings/save', 'Admin\SettingsController@update');
    Route::post('settings/{id}', 'Admin\SettingsController@updateAdmins');
    Route::get('settings/import-history', 'Admin\SettingsController@importHistory')->name('import-history');
    Route::get('settings/import-images-history', 'Admin\SettingsController@importImagesHistory')->name('import-images-history');


    // ADMIN ESTIMATE
    Route::get('/estimates', 'Admin\DashboardController@estimates')->name('estimates');
    Route::post('/estimates/delete', 'Admin\DashboardController@destroyEstimates')->name('delete_estimate');
    Route::get('/pdf-estimates/{id}','Admin\ExportController@EstimatesSinglePdfReport')->name('pdf-estimates');     

    // Exports Routes
    Route::get('/export-lots/{id}','Admin\ExportController@exportLots')->name('export-lots');
    Route::get('/export-leads','Admin\ExportController@leadsReport')->name('export-leads');
    Route::get('/export-estimates','Admin\ExportController@EstimatesReport')->name('export-estimates');
    Route::get('/single-estimates/{id}','Admin\ExportController@EstimatesSingleReport')->name('single-estimates');
    // Export Success And Skip Data
    Route::get('/mega-export/success/{timestamp}','API\ImportController@exportSuccess')->name('export-success-history');
    // Export Error Data
    Route::get('/mega-export/error/{timestamp}','API\ImportController@exportError')->name('export-error-history');
    //save lat long into database
    Route::post('/saveLatlong','Admin\CommunitiesController@saveLatlong')->name('saveLatlong');
    /* Leads  Status */
    Route::get('/leads', 'Admin\DashboardController@listUsers')->name('leads');
    Route::post('/leads/update', 'Admin\DashboardController@Update')->name('update_lead');
    Route::post('/leads/delete', 'Admin\DashboardController@destroy')->name('delete_lead');
    /* Leads  Status End */

    Route::post('/estimates/delete', 'Admin\DashboardController@destroyEstimates')->name('delete_estimate');
    // Accounts
    Route::post('/upload-home-file','Admin\HomeController@uploadHomeFile')->name('uploadHomeFile');
    Route::get('/accounts', 'Admin\AccountsController@index')->name('accounts');
    Route::post('/accounts/update', 'Admin\AccountsController@updateAccounts')->name('update_account');
    Route::post('/accounts/delete', 'Admin\AccountsController@deleteAccounts')->name('delete_account');
    Route::Post('/create/account','Admin\AccountsController@create')->name('create_account');
    Route::get('/view/account/{id}','Admin\AccountsController@view')->name('view_account');
    Route::post('/connect/manager/community/','Admin\AccountsController@connectCommunitiesToManager')->name('connect_community');
    Route::post('/delete/manager/community','Admin\AccountsController@deleteManagerCommunities')->name('delete_manager_coms');
    Route::post('/connect/admin/manager/','Admin\AccountsController@connectManagerToAdmin')->name('connect_manager');
    Route::post('/delete/admin/manager','Admin\AccountsController@deleteAdminManagers')->name('delete_admin_managers'); 
    // Bulk Upload 
    Route::get('/uploads','Admin\BulkUploadController@index')->name('uploads'); 
    Route::get('/uploads/media','Admin\BulkUploadController@returnBulkMediaView')->name('bulk-media');
    Route::post('/uploads/images','Admin\BulkUploadController@storeImgTemporary')->name('bulk-image-upload');
    Route::get('/uploads/unmapped','Admin\BulkUploadController@returnUnmappedView')->name('unmapped');
    Route::get('/uploads/data','Admin\BulkUploadController@returnBulkDataView')->name('bulk-data');
    
});
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('/home/colorschemes', 'XhomeController@GetColorSchemes'); // for ajax call on home page to show color schemes
    Route::post('/home/homefeatures', 'XhomeController@GetFeatures'); // for ajax call on home page to show features
    Route::post('/home/homemanufacturer', 'XhomeController@Getmanufacturer'); // for ajax call on home page to show
    Route::post('/home/upgradefeatures', 'XhomeController@Getupgradefeatures'); // for ajax call on home page to show 
    Route::post('/home/save_msg', 'XhomeController@saveMsg'); // for ajax call on home page to save msg in session
    Route::post('/home/pricesession', 'XhomeController@priceSession');
    Route::post('/home/finish', 'XhomeController@Finish');
    Route::get('/user_logout', 'XhomeController@userLogout')->name('user_logout');

    Route::post('/get-feature-data', 'XfloorController@getFeatureData');
    Route::post('/get-floor-data', 'XfloorController@getFloorData');
    Route::post('/finalpage', 'XfloorController@finalHomePage');
    /*Route::get('/estimate/{id}', 'XfloorController@estimate');*/
    Route::get('/estimate', 'HomeController@estimate')->name('estimate');
    Route::post('/pdf', 'HomeController@estimate')->name('download_pdf');
    //Route::get('/estimate2', 'HomeController@estimate')->name('estimate2');
    Route::post('/floor/save-msg', 'XfloorController@saveMsg');


    /*    User Dashboard   */
    Route::get('/user_dashboard', 'DashboardController@index')->name('user_dashboard');
    Route::post('/user_dashboard/update', 'DashboardController@Update')->name('update');
    Route::post('/user_dashboard/delete', 'DashboardController@destroy')->name('delete_user'); 
    //Change Password Routes
    Route::get('user/change-password','SettingsController@showChangePasswordForm')->name('user_showChangePasswordForm');
    Route::post('user_changepassword','SettingsController@changePassword')->name('user_changepassword');
    Route::get('user-estimates/{id}','Admin\ExportController@EstimatesSingleUserReport')->name('detail-estimates');
    //user Settings Routes
    Route::get('/user_settings', 'SettingsController@index')->name('user_settings');
    // Route::post('/user_settings/save', 'User\SettingsController@update');
    Route::post('/user_settings_save', 'SettingsController@updateUsers')->name('user_settings_save');
    Route::get('user/user-estimates', 'Admin\DashboardController@userEstimates')->name('user-estimates');
    Route::get('/user-pdf-estimates/{id}','Admin\ExportController@EstimatesSingleUserPdfReport')->name('user-pdf-estimates');
    Route::get('/user/profile', 'DashboardController@index')->name('user_dashboard');
    /*    User Dashboard  End */

    Route::apiResource('cities', 'API\CitiesController');
    Route::apiResource('communities', 'API\CommunitiesController');

    Route::get('/get-cities-list/{id}', 'API\CitiesController@getHtmlList');
    Route::get('/get-communities-list/{cid}', 'API\CommunitiesController@getHtmlList');
    Route::post('/setlotcount', 'API\CommunitiesController@setlotcount');
    Route::post('/sethomeform', 'API\CommunitiesController@sethomeform');


/*------------------------------MANAGER SECTION--------------------*/

Route::group(['prefix'=>'/admin/manager','middleware'=>['auth','manager']], function () { 
    Route::get('/dashboard', 'Admin\ManagerController@index')->name('manager-dashboard');
    // Community URLS
    
   Route::get('/communities', 'Admin\ManagerController@showCommunities')->name('manager-communities');
   Route::get('/communities/view/{id}', 'Admin\ManagerController@view')->name('manager-view-community');
    Route::post('/communities/nearby_locations', 'Admin\CommunitiesController@nearbyLocations')->name('manager-nearby_locations');
   //Community Homes
   Route::get('/communities/homes/{community_id}', 'Admin\ManagerController@CommunityHomes')->name('manager-communities_homes');
   
   // HOMES URLS
   Route::get('/homes', 'Admin\ManagerController@Homeindex')->name('manager-homes');
   
    /* Leads  Status */
   Route::get('/leads', 'Admin\ManagerController@listUsers')->name('manager-leads');
   
     // Analytics URLS
   Route::get('/analytics', 'Admin\ManagerController@Analyticsindex')->name('manager-analytics');
   
    //Home Color Scheme Routes
   Route::get('/homes/color_scheme/{home_id}', 'Admin\ManagerController@listColorScheme')->name('manager-homes_color_scheme');
   
   // Home Elevation type route
   Route::get('/homes/elevation_type/{home_id}', 'Admin\ManagerController@listHomeElevationType')->name('manager-homes_elevation_type');
   Route::get('/homes/gallery/{id}', 'Admin\ManagerController@gallery')->name('manager-view-gallery');

   //Home Color Features Routes
   Route::get('/homes/color_features/{color_scheme_id}', 'Admin\ManagerController@listFeature')->name('manager-color_features');

   //Floor Routes
   Route::get('/floors', 'Admin\ManagerController@Floorindex')->name('manager-new_floors');

   //Features Routes
   Route::get('homes/features/{id}', 'Admin\ManagerController@Featureindex')->name('manager-features');
   

   // Set option default
   Route::post('set_default', 'Admin\DesignController@set_default')->name('set_default');

   //Floor ACL Settings Routes
   Route::get('features/set-acl/{id}', 'Admin\FeaturesController@setACLOptions')->name('feature_acl_option');
   Route::post('features/get_acl_form', 'Admin\FeaturesController@getACLRow')->name('feature_acl_row');
   Route::post('features/save-acl', 'Admin\FeaturesController@saveAclSettings')->name('saveAclSettings');
   Route::get('features/view-set-acl/{id}', 'Admin\FeaturesController@deleteAclSettings')->name('deleteAclSettings');
   Route::post('features/re_order_list', 'Admin\FeaturesController@reOrderList');
   
   //Admin Profile Routes
   Route::get('profile', 'Admin\ProfileController@index')->name('manager-profile');


   //Configuration Settings Routes
   Route::get('settings', 'Admin\SettingsController@index')->name('manager-settings');

   /*------------EXPORT-----------------*/   
   Route::get('/export-leads','Admin\ExportController@leadsReport')->name('manager-export-leads');
   Route::post('/export-estimates','Admin\ExportController@EstimatesReport')->name('manager-export-estimates');
   
   Route::get('/single-estimates/{id}','Admin\ExportController@EstimatesSingleReport')->name('manager-single-estimates');
   Route::get('/pdf-estimates/{id}','Admin\ExportController@EstimatesSinglePdfReport')->name('manager-pdf-estimates');
 
   /* Leads  Status */
   Route::get('/leads', 'Admin\ManagerController@listUsers')->name('manager-leads');
// ADMIN ESTIMATE
   Route::get('/estimates', 'Admin\ManagerController@estimates')->name('manager-estimates');
   Route::post('/estimates/delete', 'Admin\ManagerController@destroyEstimates')->name('manager-delete_estimate');
   Route::get('/assign/estimates','Admin\ManagerController@assignEstimates')->name('assign_estimates');
   Route::post('/assigned','Admin\ManagerController@estimateToCustomer')->name('assign-estimate-customer');

//CREATE CUSTOMER BY MANAGER
Route::Post('/create/account','Admin\ManagerController@createCustomer')->name('manager-create_account');
Route::post('/delete/account','Admin\ManagerController@deleteCustomer')->name('manager-delete_lead');
Route::post('/replicate/estimate','Admin\ManagerController@replicateEstimate')->name('manager-copy_estimate');
   
//LOGOUT
   Route::get('/logout', 'Auth\LoginController@logout')->name('manager-logout');
}); 

// PDF download from the email sent.
Route::get('/estimates/src/email/{email}/id/{estimate_id}/uid/{user_id}','Admin\ManagerController@downloadEstimateSentByMail');

Route::get('/verify/mail',function(){
    return view('auth.passwords.email');
})->name('reset-email'); 
Route::get('/reset/password',function(){
    return view('auth.passwords.reset');
})->name('reset-password');
Route::post('/password/update','API\LoginController@updatePasswordAdmin')->name('update-password');
Route::post('/reset/otp','API\LoginController@forgotPasswordAdmin')->name('otp');
