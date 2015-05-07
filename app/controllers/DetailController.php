<?php

class DetailController extends BaseController {

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

		$getFiles = DB::table('tb_upload')->get();
		$applyFor = DB::table('tb_apply_for')->get();


		return View::make('detail.index')
			->with('title', 'Data collected from Jobsdb.com')
			->with('link', Input::get('link'))
			->with('getFiles', $getFiles)
			->with('applyFor', $applyFor);
		  
		  //return \View::make('project.index')->with('title', 'Projects');
	}	

  	public function addData()
	{	

		//Validation
		$rules = array(		        
		       'email'    => array('required')
		       //'email'    => array('required', 'email')
		       // 'email'    => array('required', 'email', 'unique:users,email'),
		        //'qualification' => array('required', 'min:7')
		    );

    		//$validation = Validator::make(Input::all(), $rules);
    		$validation = Validator::make(Input::all(), $rules);
    		
    		if ($validation->fails())
		{
		    // The given data did not pass validation
		    //var_dump($validation->messages());
		    //return Redirect::route('show_detail')->withErrors($validation);
		    return Redirect::to('show_detail')->withErrors($validation)->withInput();
		}
		else
		{
    		
			$date = new DateTime;
			//echo $date->format('U = Y-m-d H:i:s') ;
			
			$email = Input::get('email');
			$link = Input::get('link');
			$qualification = Input::get('qualification');
			$responsibility = Input::get('responsibility');
			$companyInfo = Input::get('companyInfo');
			$salary = Input::get('salary');
			$cv_file_name = Input::get('cvFile');
			$apply_for = Input::get('applyFor');
			
			DB::table('tb_detail')->insert(array(
			    array('email' => $email, 
			    	'link' =>$link,
			    	'qualification' =>$qualification,
			    	'responsibility' =>$responsibility,
			    	'companyInfo' =>$companyInfo,
			    	'salary' =>$salary,
			    	'cv_file_name' => $cv_file_name,
			    	'apply_for_id' => $apply_for,
			    	'created_at' =>$date->format('Y-m-d H:i:s')  )		    
			));

			//Update detail field of tb_apply table to 1

			DB::table('tb_apply')
	            	->where('link',  $link)
	            	->update(array('detail' => 1, 'tb_detail_id' => DB::getPdo()->lastInsertId() ));

			return Redirect::route('list');
		}
	}

	public function editDetail()
	{
		
		// get all files
		$getFiles = DB::table('tb_upload')->get();
		$applyFor = DB::table('tb_apply_for')->get();

		//get 

		$link = Input::get('link');
		//$email = DB::table('tb_detail')->where('link', $link)->pluck('email');
		//$data = DB::table('tb_detail')->where('link', $link)->get();
		$apply = DB::select( DB::raw("SELECT *  FROM tb_detail WHERE link = '$link'  "));
		foreach($apply as $data):
			$email = $data->email;
			$qualification = $data->qualification;
			$responsibility =$data->responsibility;
			$companyInfo = $data->companyInfo;
			$salary =$data->salary;
			$apply_for_id = $data->apply_for_id;
			$cv_file_name = $data->cv_file_name;
		endforeach;
		
		
		return View::make('detail.showedit')
			->with('title', 'Editing')
			->with('email', $email )
			->with('link', $link)
			->with('qualification', $qualification )
			->with('responsibility', $responsibility )
			->with('companyInfo', $companyInfo )
			->with('salary', $salary )
			->with('cv_file_name', $cv_file_name)
			->with('apply_for_id', $apply_for_id)
			->with('applyFor', $applyFor)
			->with('getFiles', $getFiles);
	}

	public function editDetailData()
	{
		$date = new DateTime;
		$email = Input::get('email');
		$link = Input::get('link');
		$qualification = Input::get('qualification');
		$responsibility = Input::get('responsibility');
		$companyInfo = Input::get('companyInfo');
		$salary = Input::get('salary');	
		$apply_for_id = Input::get('apply_for_id');	
		$cv_file_name= Input::get('cvFile');	
		
		DB::table('tb_detail')
		            ->where('link', $link)
		            ->update(array(
		            	'email' => $email, 
		            	'qualification' => $qualification, 
		            	'responsibility' => $responsibility, 
		            	'companyInfo' => $companyInfo, 
		            	'salary' => $salary, 
		            	'cv_file_name' => $cv_file_name,
		            	'apply_for_id' => $apply_for_id,
		            	'updated_at' =>$date->format('Y-m-d H:i:s') ));

		  return Redirect::route('list');
	}

	public function viewDetail()
	{

		$getId = Input::get('detailId');
		$result = DB::select( DB::raw("SELECT D.email email, D.link link, D.qualification qualification, D.responsibility responsibility, D.companyInfo companyInfo, D.salary salary, U.filename filename, A.title title  FROM tb_detail AS D LEFT JOIN tb_upload AS U ON D.cv_file_name=U.id LEFT JOIN tb_apply_for AS A ON D.apply_for_id = A.id  WHERE D.id = $getId  "));
		//dd(DB::getQueryLog());
		foreach($result as $data):
			$email = $data->email;
			$link = $data->link;
			$qualification = $data->qualification;
			$responsibility = $data->responsibility;
			$companyInfo = $data->companyInfo;
			$salary = $data->salary;
			$cv_file_name = $data->filename;
			$title = $data->title;
		endforeach;

		/*
		$data = DB::table('tb_detail')
			->where('tb_detail.id', '=', $getId)
			->leftJoin('tb_upload', function($join)
			{
				$join->on('tb_detail.id', '=', 'tb_upload.id');
			})
			->first();
			*/
			


		//$getId = Input::get('detailId');
		//$data = DB::table('tb_detail')->where('id', $getId)->first();

		return View::make('detail.showdetail')
			->with('title', 'Editing')
			->with('email', $email )
			->with('link', $link)
			->with('qualification', $qualification )
			->with('responsibility', $responsibility )
			->with('companyInfo', $companyInfo )
			->with('salary', $salary )
			->with('cv_file_name', $cv_file_name)
			->with('titles', $title);		

	}

}
