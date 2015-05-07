<?php

class JobbkkController extends BaseController {

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

			 #$jobsdb = DB::table('tb_jobbkk')->orderBy('time', 'desc')->paginate(200); 
			 
			 //$jobsdb = DB::select( DB::raw("SELECT * FROM `tb_jobbkk` where match(title) against('developer programmer')"));
			 $q = array('developer programmer');
			 $jobsdb = Jobbkk::whereRaw("MATCH(title) AGAINST(? IN BOOLEAN MODE)",array($q))
								->get();
			 return View::make('jobbkk.index')
				->with('title', 'Data collected from Jobbkk.com')
				->with('jobsdb', $jobsdb);
				
				/*
			 $perPage = 200;
			 if(isset($_GET['page']) && $_GET['page'] == 1)
			 {
				$start = 0;
				//$perPage = 5;
				$count = DB::table('tb_jobbkk')->count();
				$jobsdb = DB::select( DB::raw("SELECT * FROM `tb_jobbkk` where match(title) against('developer programmer') LIMIT {$start}, {$perPage}"));
				$jobsdb = Paginator::make($jobsdb, $count, $perPage);
			 }
			 elseif(isset($_GET['page']))
			 {
				$start = $perPage * ($_GET['page'] - 1);
				$count = DB::table('tb_jobbkk')->count();
				$jobsdb = DB::select( DB::raw("SELECT * FROM `tb_jobbkk` where match(title) against('developer programmer') LIMIT {$start}, {$perPage} "));
				$jobsdb = Paginator::make($jobsdb, $count, $perPage);
			 }
			 
			 else
			 {
				$start = 0;
				$count = DB::table('tb_jobbkk')->count();
				$jobsdb = DB::select( DB::raw("SELECT * FROM `tb_jobbkk` where match(title) against('developer programmer') LIMIT {$start}, {$perPage} "));
				$jobsdb = Paginator::make($jobsdb, $count, $perPage);
			 }
			 return View::make('jobbkk.index')
				->with('title', 'Data collected from Jobsdb.com')
				->with('jobsdb', $jobsdb);
				*/


	}

	public function addData()
	{


		$errors = array(); //To store errors
		$form_data = array(); //Pass back the data to form

		$link = trim(e(Input::get('link')));


		//$data = DB::select( DB::raw("SELECT * , (SELECT count(A.id) FROM tb_apply AS D LEFT JOIN tb_applied_times AS A ON D.id=A.id)as times FROM tb_apply LIMIT {$start}, {$perPage} "));
		$result = DB::select( DB::raw("SELECT count(*) as countID  FROM `tb_apply` WHERE `link` = '$link'  "));
		//$result = Jobbkk::whereRaw("SELECT count(*) as countID  FROM `tb_apply` WHERE `link` = '$link'  ");


		//dd(DB::getQueryLog());
		
		foreach($result as $data):
			$countID = (int) $data->countID;
		endforeach;

		if( $countID == 0):
			$title = Input::get('title');
			$name = trim(e(Input::get('link')));
			$from_which_website = Input::get('from_which_website');

			/*
			DB::table('tb_apply')->insert(array(
			array('title' => $title, 'link' => $name, 'from_which_webstie' => $from_which_website)		    
			));
			*/
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
