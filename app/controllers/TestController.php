<?php

class TestController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	
  public function showIndex()
	{	
		var_dump(Upload::find(6));
		echo App::getBootstrapFile().'<br />';
		//dd(mcrypt_list_algorithms());
	
		if(App::runningInConsole())
		{
			echo "I'm in the console";
		}
		
		$is_evening = (date('G') > 18) ? true : false;
		App::instance('myapp.evening', $is_evening);
		
		$mydata = "test";
		// Somewhere in your code
		App::instance('mydata', $mydata);

		// Later
		$mydata = App::make('mydata');
		echo $mydata. '<br />';
		
		
		// Somewhere in your code
		App::singleton('mysingleton', 'stdClass');

		// Later
		$var = App::make('mysingleton');
		$var->test = '123';

		// Even later
		$var2 = App::make('mysingleton');
		echo $var2->test;		
		
		/*
		 return View::make('project.index')
			->with('title', 'Projects');
			*/
	}
	
	
	public function putEmail($email)
	{
		DB::table('tb_upload')
				->insert(
				array(
				'title'=>$email
				));
		//return Response::json(array('email'=>$email));
		//echo $email;
	}

}
