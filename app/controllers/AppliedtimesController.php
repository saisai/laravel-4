<?php

class AppliedtimesController extends BaseController {

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

  public function showIndex($id)
	{
			$result = Applytimes::where('id', '=', $id)->get();
			
			return View::make('appliedtimes.index')
						->with('title', 'Apply times from id '. $id )
						->with('data', $result);
				/*
			 $q = array('developer programmer');
			 $jobsdb = Jobbkk::whereRaw("MATCH(title) AGAINST(? IN BOOLEAN MODE)",array($q))
								->get();
			 return View::make('jobbkk.index')
				->with('title', 'Data collected from Jobbkk.com')
				->with('jobsdb', $jobsdb);
			*/
			
	}

	

}
