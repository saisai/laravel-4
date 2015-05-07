<?php

class SgStJobsController extends BaseController {

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

			 //$jobsdb = DB::table('jobs_db')->orderBy('time', 'desc')->paginate(200); 
	 		//$jobsdb = DB::table('jobs_db')->paginate(200); 
			$jobsdb = SgStJob::paginate(200);

			 return View::make('jobsdb.index')
				->with('title', 'Data collected from www.stjobs.sg')
				->with('jobsdb', $jobsdb);


	}

	public function addData()
	{


		$errors = array(); //To store errors
		$form_data = array(); //Pass back the data to form
		$getLink =trim(e(Input::get('link')));
		$link = str_replace("&amp;", "&", $getLink);

		
		
		//echo $link;
		//exit;

		//$apply = DB::table('tb_apply')->where('link', $link)->get();
		//$data = DB::select( DB::raw("SELECT * , (SELECT count(A.id) FROM tb_apply AS D LEFT JOIN tb_applied_times AS A ON D.id=A.id)as times FROM tb_apply LIMIT {$start}, {$perPage} "));
		$result = DB::select( DB::raw("SELECT count(*) as countID  FROM `tb_apply` WHERE `link` = '$link'  "));
		//dd(DB::getQueryLog());
		//exit;
		//$resultLink = "";
		foreach($result as $data):
			$countID = (int) $data->countID;
		endforeach;

		if( $countID == 0):
			$title = Input::get('title');
			$name = $link;//trim(e(Input::get('link')));
			$from_which_website = Input::get('from_which_website');
			/*
			DB::table('tb_apply')->insert(array(
			array('title' => $title, 'link' => $name, 'from_which_webstie' => $from_which_website)		    
			));*/
			$apply = new Apply;
			$apply->title = $title;
			$apply->link = $name;
			$apply->from_which_webstie = $from_which_website;
			$apply->created_at = date("Y-m-d H:i:s");
			$apply->save();			
			$form_data['success'] = false;
		else:
			$form_data['success'] = true;			
		endif;

		
		//dd(DB::getQueryLog());

        		
		echo json_encode($form_data);
		//return Redirect::route('job-thai');
		
		/*
		$title = Input::get('title');
		$name = Input::get('link');
		$from_which_website = Input::get('from_which_website');

		DB::table('tb_apply')->insert(array(
		    array('title' => $title, 'link' => $name, 'from_which_webstie' => $from_which_website)		    
		));
		return Redirect::route('job-db');
		*/
	}	

}
