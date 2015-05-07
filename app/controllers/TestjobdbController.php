<?php

class TestjobdbController extends BaseController {

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

			 $jobsdb = DB::table('jobs_db')->orderBy('time', 'desc')->paginate(200); 
	 		//$jobsdb = DB::table('jobs_db')->paginate(200); 
			 return View::make('test.index')
				->with('title', 'Data collected from Jobsdb.com')
				->with('jobsdb', $jobsdb);


	}
	
  public function showJobthai()
	{

			 $jobsdb = DB::table('job_thai')->paginate(200); 
	 		//$jobsdb = DB::table('jobs_db')->paginate(200); 
			 return View::make('test.jobthai')
				->with('title', 'Data collected from Jobthai.com')
				->with('jobsdb', $jobsdb);


	}	
	
  public function showJobbkk()
	{

			 $jobsdb = DB::table('tb_jobbkk')->orderBy('time', 'desc')->paginate(200); 
	 		//$jobsdb = DB::table('jobs_db')->paginate(200); 
			 return View::make('test.jobbkk')
				->with('title', 'Data collected from Jobbkk.com')
				->with('jobsdb', $jobsdb);


	}		
	
	
	

}
