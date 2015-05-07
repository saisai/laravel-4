<?php

class JobthaiController extends BaseController {

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

			 //$users = DB::table('job_thai')->paginate(200); 
			 $users = Jobthai::paginate(200);
			 return View::make('jobthai.index')
				->with('title', 'Data colllected from Jobthai.com')
				->with('users', $users);

		
			
	}

	public function addData()
	{	
		$errors = array(); //To store errors
		$form_data = array(); //Pass back the data to form

		$link = trim(e(Input::get('link')));
		$link = str_replace('&amp;','&',$link);


		$apply = DB::select( DB::raw("SELECT count(id) as id  FROM tb_apply WHERE link = '$link'  "));
		foreach($apply as $data):
			$countId = (int) $data->id;
		endforeach;

		if($countId > 0):
			$form_data['success'] = true;
		else:
			$title = Input::get('title');
			$name = $link;
			$from_which_website = Input::get('from_which_website');
			/*
			DB::table('tb_apply')->insert(array(
			array('title' => $title, 'link' => $name, 'from_which_webstie' => $from_which_website)		    
			));
			*/
			// Get skip number from tb_apply table
			$id = Helpers::getSkipNumber('tb_apply', 'id');			
			$apply = new Apply;
			if($id):				
				$apply->id = $id;
				$apply->title = $title;
				$apply->link = $name;
				$apply->from_which_webstie = $from_which_website;
				$apply->created_at = date("Y-m-d H:i:s");
				$apply->save();
			else:
				$apply->title = $title;
				$apply->link = $name;
				$apply->from_which_webstie = $from_which_website;
				$apply->created_at = date("Y-m-d H:i:s");
				$apply->save();
			endif;			
			$form_data['success'] = false;
		endif;

		
		//dd(DB::getQueryLog());

        		
		echo json_encode($form_data);
		//return Redirect::route('job-thai');
		
	}

}
