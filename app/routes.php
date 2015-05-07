<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/*
Route::get('/', function()
{
	echo asset('css/yourcssfile.css');
	//return View::make('hello');
});
*/
//Route::get('/', array( 'as' => 'home', uses'=>'HomeController@showIndex'));
//Route::get('/', array('as' =>'home','uses' => 'HomeController@showIndex'));














//Route::match(array('GET', 'POST'),'add_job_db',array('as'=>'add_job_db','uses'=> 'JobdbController@addData'));


/**
 * Unauthenticated group 
 */
Route::group(array('before'=>'guest'),function(){

//Add data with put
//curl -i -X PUT localhost/jobs/public/api/addtest/asdfasdf
Route::put('api/addtest/{email}', array('uses' => 'TestController@putEmail'));

Route::get('home', array('as' => 'home', 'uses' => 'AboutusController@showIndex'));
Route::get('test', array('as' => 'test', 'uses' => 'TestController@showIndex'));
Route::get('test-jobdb', array('as' => 'test-jobdb', 'uses' => 'TestjobdbController@showIndex'));
Route::get('test-jobthai', array('as' => 'test-jobthai', 'uses' => 'TestjobdbController@showJobthai'));
Route::get('test-jobbkk', array('as' => 'test-jobbkk', 'uses' => 'TestjobdbController@showJobbkk'));

//Route::get('/', array('as' =>'home','uses' => 'HomeController@showIndex'));
Route::get('/', 'AboutusController@showIndex');
Route::get('about-us', array('as' => 'about-us', 'uses'=>'AboutusController@showIndex'));
Route::get('projects', 'ProjectController@showIndex');
// route to process the form
Route::post('login', array('uses' => 'HomeController@doLogin'));
// route to show the login form
Route::get('login', array('uses' => 'HomeController@showLogin'));

// Test Mobile
Route::get('test-mobile', array('as'=>'test-mobile', 'uses'=>'TestMobileController@showIndex'));

});	//Unauthenticated group 





/**
 * Authenticated group
 */
Route::group(array('before'=>'auth'),function(){
 	/**
	 * Sign out (GET)
	 */
	 
	 Route::get('home', array('as' => 'home', 'uses' => 'AboutusController@showIndex'));
	 //Route::get('/', array('as' =>'home','uses' => 'HomeController@showIndex'));
	 Route::get('/', 'AboutusController@showIndex');
	Route::get('job-bkk', array('as' => 'job-bkk', 'uses' => 'JobbkkController@showIndex'));
	 
	Route::get('job-thai', array('as' =>'job-thai', 'uses' =>  'JobthaiController@showIndex'));

		Route::get('job-db',array('as' =>'job-db', 'uses' =>  'JobdbController@showIndex'));

	Route::get('list',array('as' =>'list', 'uses' =>  'ListingController@showIndex'));
	Route::get('delete_list/{id}',array('as'=>'delete_list', 'uses'=>'ListingController@deleteList'));
	Route::post('selected-search',array('as'=>'selected-search', 'uses'=>'ListingController@searchList'));

		/*
	 * CSRF Protection group
	 */
	Route::group(array('before'=>'csrf'),function(){


	
		Route::post('post_apply', 'ListingController@postApply');

		Route::post('add_job_thai', 'JobthaiController@addData');

		Route::post('add_job_db', 'JobdbController@addData');
		
		Route::post('edit_detail', 'DetailController@editDetail');

		Route::post('edit_detail_data', 'DetailController@editDetailData');

		Route::post('add_detail', 'DetailController@addData');		
	
	});
	

	 
Route::match(array('GET', 'POST'),'show_detail',array('as'=>'show_detail', 'uses' => 'DetailController@showIndex'));
Route::post('delete-all',array('as'=>'delete-all', 'uses' => 'ListingController@allDelete'));


Route::post('view_detail', 'DetailController@viewDetail');	 
Route::get('upload',array('as' =>'upload', 'uses' =>  'UploadController@showIndex'));
Route::post('upload_data',array('as' =>'upload_data', 'uses' =>  'UploadController@postData'));
Route::get('list_upload',array('as' =>'list_upload', 'uses' =>  'UploadController@listUpload'));
Route::get('edit_upload/{id}', array('as' => 'edit_upload', 'uses'=> 'UploadController@editUpload'));
Route::get('delete_image/{id}', array('as' => 'delete_image', 'uses'=> 'UploadController@deleteImage'));
Route::post('reupload_image', array('as'=>'reupload_image', 'uses'=>'UploadController@reuploadImage'));
Route::post('edit_upload_data', array('as'=>'edit_upload_data', 'uses'=>'UploadController@editUploadData'));
Route::get('delete_upload/{id}', array('as'=>'delete_upload', 'uses'=>'UploadController@deleteUpload'));
Route::get('edit_image/{id}', array('as' =>'editUpload', 'uses'=>'UploadController@editImage'));

//Apply For Controller
Route::get('apply-for',array('as' =>'apply-for', 'uses' =>  'ApplyforController@showIndex'));
Route::post('add_apply_for', array('as' => 'add_apply_for', 'uses' => 'ApplyforController@addApplyFor'));
Route::get('list_apply_for', array('as' => 'list_apply_for', 'uses' => 'ApplyforController@listApplyFor'));
Route::get('edit_apply_for/{id}', array('as' => 'edit_apply_for', 'uses' => 'ApplyforController@editApplyFor'));
Route::post('save_edit_apply_for', array('as' => 'save_edit_apply_for', 'uses' => 'ApplyforController@saveEditApplyFor'));
Route::get('delete-apply-for/{id}', array('as' => 'delete-apply-for', 'uses' => 'ApplyforController@deleteApplyFor'));

// route to process the form
Route::get('log-out', array('as' =>'log-out', 'uses' => 'HomeController@doLogout'));

// tb_applied_times
Route::get('how-many-applies/{id}', array('as'=>'how-many-applies', 'uses'=>'AppliedtimesController@showIndex'));

// site
Route::get('site', array('as'=>'sites', 'uses'=>'SiteController@showIndex'));
Route::post('add_link', array('as'=>'add_link', 'uses'=>'SiteController@addLink'));
Route::get('list-link', array('as'=>'list-link', 'uses'=>'SiteController@listLink'));
Route::get('view-site/{id}', array('as'=>'view-site', 'uses'=>'SiteController@viewSite'));
Route::get('edit-go-site/{id}', array('as'=>'edit-go-site', 'uses'=>'SiteController@goeditSite'));
Route::post('save-edit-site', array('as'=>'save-edit-site', 'uses'=>'SiteController@saveEditSite'));
Route::get('delete-site/{id}', array('as'=>'delete-site', 'uses'=>'SiteController@deleteSite'));
// Job Top Gun
Route::get('job-top-gun', array('as'=>'job-top-gun', 'uses'=>'JobtopgunController@showIndex'));

// Todo List
Route::get('todo', array('as'=>'todo', 'uses'=>'TodoController@showIndex'));
Route::post('add-todolist', array('as'=>'add-todolist', 'uses'=>'TodoController@addTodolist'));
Route::get('list-todolist', array('as'=>'list-todolist', 'uses'=>'TodoController@listTodo'));
Route::get('view-todo/{id}', array('as'=>'view-todo', 'uses'=>'TodoController@viewTodo'));
Route::get('edit-go-todo/{id}', array('as'=>'edit-go-todo', 'uses'=>'TodoController@goeditTodo'));
Route::post('save-edit-todo', array('as'=>'save-edit-todo', 'uses'=>'TodoController@saveEditTodo'));
Route::get('delete-todo/{id}', array('as'=>'delete-todo', 'uses'=>'TodoController@deleteTodo'));

// category
Route::get('category', array('as'=>'category', 'uses'=>'CategoryController@showIndex'));
Route::post('add-category', array('as'=>'add-category', 'uses'=>'CategoryController@addCategory'));
Route::get('list-category', array('as'=>'list-category', 'uses'=>'CategoryController@listCategory'));
Route::get('view-category/{id}', array('as'=>'view-category', 'uses'=>'CategoryController@viewCategory'));
Route::get('edit-go-category/{id}', array('as'=>'edit-go-category', 'uses'=>'CategoryController@goeditCategory'));
Route::post('save-edit-category', array('as'=>'save-edit-category', 'uses'=>'CategoryController@saveEditCategory'));
Route::get('delete-category/{id}', array('as'=>'delete-category', 'uses'=>'CategoryController@deleteCategory'));


// post
Route::get('post', array('as'=>'post', 'uses'=>'PostController@showIndex'));
Route::post('add-post', array('as'=>'add-post', 'uses'=>'PostController@addPost'));
Route::get('list-post', array('as'=>'list-post', 'uses'=>'PostController@listPost'));
Route::get('view-post/{id}', array('as'=>'view-post', 'uses'=>'PostController@viewPost'));
Route::get('edit-go-post/{id}', array('as'=>'edit-go-site', 'uses'=>'PostController@goeditPost'));
Route::post('save-edit-post', array('as'=>'save-edit-post', 'uses'=>'PostController@saveEditPost'));
Route::get('delete-post/{id}', array('as'=>'delete-post', 'uses'=>'PostController@deletePost'));



Route::get('sg-job-db',array('as' =>'sg-job-db', 'uses' =>  'SgJobdbController@showIndex'));
Route::get('sg-stjobs',array('as' =>'sg-stjobs', 'uses' =>  'SgStJobsController@showIndex'));
Route::get('sg-jobscentral',array('as' =>'sg-jobscentral', 'uses' =>  'SgJobscentralController@showIndex'));
Route::get('sg-monster',array('as' =>'sg-jobscentral', 'uses' =>  'SgJobsmonsterController@showIndex'));



}); //Authenticated group


/*
Route::post('submit', function(){
	return 'aaa';
});

Route::post('foo/bar', function()
	{
		$data = Input::all();
		var_dump($data);
	});
Route::get('hello', function()
{
	echo Helpers::doMessage();
	//return __FILE__;
});
*/

//To check the error

App::error(function(Exception $exception) {
echo '<pre>';
echo 'MESSAGE :: ';
    print_r($exception->getMessage());
echo '<br> CODE ::';
    print_r($exception->getCode());
echo '<br> FILE NAME ::';
    print_r($exception->getFile());
echo '<br> LINE NUMBER ::';
    print_r($exception->getLine());
die();// if you want than only
});




