<?php

class ListingController extends BaseController {

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
	 	
			 $perPage = 20;
			 if(isset($_GET['page']) && $_GET['page'] == 1)
			 {
				$start = 0;
				//$perPage = 5;
				$count = DB::table('tb_apply')->count();
				//$data = DB::select( DB::raw("SELECT * , (SELECT count(A.id) FROM tb_apply AS D LEFT JOIN tb_applied_times AS A ON D.id=A.id)as times FROM tb_apply ORDER BY id DESC LIMIT {$start}, {$perPage} "));
				//$data = DB::select( DB::raw("SELECT *  FROM tb_apply ORDER BY id DESC LIMIT {$start}, {$perPage} "));
				$data = DB::select( DB::raw("SELECT A.*, AF.title applyfortitle FROM tb_apply as A LEFT JOIN tb_detail AS D ON A.tb_detail_id = D.id LEFT JOIN tb_apply_for as AF ON D.apply_for_id = AF.id  ORDER BY A.created_at DESC LIMIT {$start}, {$perPage} "));
				$data = Paginator::make($data, $count, $perPage);
			 }
			 elseif(isset($_GET['page']))
			 {
				$start = $perPage * ($_GET['page'] - 1);
				$count = DB::table('tb_apply')->count();
				//$data = DB::select( DB::raw("SELECT * , (SELECT count(A.id) FROM tb_apply AS D LEFT JOIN tb_applied_times AS A ON D.id=A.id)as times FROM tb_apply ORDER BY id DESC LIMIT {$start}, {$perPage} "));
				$data = DB::select( DB::raw("SELECT A.*, AF.title applyfortitle FROM tb_apply as A LEFT JOIN tb_detail AS D ON A.tb_detail_id = D.id LEFT JOIN tb_apply_for as AF ON D.apply_for_id = AF.id  ORDER BY A.created_at DESC LIMIT {$start}, {$perPage} "));
				$data = Paginator::make($data, $count, $perPage);
			 }
			 
			 else
			 {
				$start = 0;
				$count = DB::table('tb_apply')->count();
				//$data = DB::select( DB::raw("SELECT * , (SELECT count(A.id) FROM tb_apply AS D LEFT JOIN tb_applied_times AS A ON D.id=A.id)as times FROM tb_apply ORDER BY id DESC LIMIT {$start}, {$perPage} "));
				//$data = DB::select( DB::raw("SELECT *  FROM tb_apply ORDER BY id DESC LIMIT {$start}, {$perPage} "));
				$data = DB::select( DB::raw("SELECT A.*, AF.title applyfortitle FROM tb_apply as A LEFT JOIN tb_detail AS D ON A.tb_detail_id = D.id LEFT JOIN tb_apply_for as AF ON D.apply_for_id = AF.id  ORDER BY A.created_at DESC LIMIT {$start}, {$perPage} "));
				//$queries = DB::getQueryLog();
				//return $queries;
				//return  end($queries);
				$data = Paginator::make($data, $count, $perPage);
			 }
			 
			 return View::make('listing.index')
				->with('title', 'Listing Data')
				->with('data', $data);

			
	}

	// Sending email
	public function postApply()
	{
	
		$tbApplyId = Input::get('tb_apply_id'); //tb_apply id will be added to apply_times
	
		$fireId = Input::get('fireId');

		$data = DB::table('tb_detail')
			->leftJoin('tb_upload', function( $funJoin)
			{
				$funJoin->on('tb_detail.cv_file_name', '=', 'tb_upload.id');
					
			})
			->where('tb_detail.id','=',  $fireId)
			->first();
		//dd(DB::getQueryLog()); to see mysql 
		$file_to_be_sent = public_path() .'/assets/files/'.$data ->filename;

		// Get Position Title
		$applyFor = DB::table('tb_apply_for')
								->where('id', $data->apply_for_id)->first();
		
		// I'm creating an array with user's info but most likely you can use $user->email or pass $user object to closure later
		$user = array(
			'email'=>$data->email,
			'apply_for'=>$applyFor->title
			//'name'=>'Sai Sai'
		);



		
		
		//exit;
		//return sizeof($user['email']);
		//return var_dump( explode(',', $user['email']));
		// the data that will be passed into the mail view blade template
		$data = array(
			'detail'=>''
			//'name'	=> $user['name']
		);

		$dd = explode(',', $user['email']);
		$html = "";
		$count = sizeof($dd);
		if( $count > 1):
			for($i = 0; $i < $count; $i++):
					$email = trim($dd[$i]);
					Mail::send('emails.welcome', $data, function($message) use ($user,$email, $file_to_be_sent)
					{
						$message->from('youremail@gmail.com', 'Site Admin');
						$message->to($email)->subject('Apply for '. $user['apply_for']);
						$message->attach($file_to_be_sent);
						//$message->to($user['email'], $user['name'])->subject('Welcome to My Laravel app!');
					});
			endfor;
		else:
			$email = trim($dd[0]);			
			Mail::send('emails.welcome', $data, function($message) use ($user,$email, $file_to_be_sent)
			{
				$message->from('youremail@gmail.com', 'Site Admin');
				$message->to($email)->subject('Apply for '. $user['apply_for']);
				$message->attach($file_to_be_sent);
				//$message->to($user['email'], $user['name'])->subject('Welcome to My Laravel app!');
			});			
			
		endif;		

		/*
		Mail::send('emails.welcome', $data, function($message) use ($user,$html, $file_to_be_sent)
		{
			////->to($user['email'])
		  $message->from('youremail@gmail.com', 'Site Admin')
		  $message.$html
							->subject('Apply for '. $user['apply_for']);
		  $message->attach($file_to_be_sent);
		  //$message->to($user['email'], $user['name'])->subject('Welcome to My Laravel app!');
		});
		*/
		// Add how many times to tb_applied_times table
		/*
		$date = new DateTime;
		DB::table('tb_applied_times')->insert(
			array(
				'id' => $tbApplyId,
				'created_at' =>$date->format('Y-m-d H:i:s')
				)
			);
			*/
		$applytimes = new Applytimes;
		$applytimes->id = $tbApplyId;
		$applytimes->created_at = date('Y-m-d H:i:s');
		$applytimes->save();
		
		
		// Get Count and add to tb_appl
		$getCount = DB::table('tb_applied_times')
                     ->select(DB::raw('count(*) as count'))
                     ->where('id', '=', $tbApplyId)
                     ->first();
		
		DB::table('tb_apply')
				->where('id',$tbApplyId)
				->update(array('apply_times'=> $getCount->count));
				
		
		return Redirect::route('list')->with('success', 'Message was sent succesfully.');		
	}
	
	public function deleteList($id)
	{
			/*
			DB::table('tb_apply')
					->where('id', $id)
					->delete();
			*/
			$apply = Apply::find($id);
			$apply->delete();
			return Redirect::route('list')
							->with('success', 'Successfully deleted!');
	}

	public function searchList()
	{
		$search = Input::get('txtSearching');
		$data = DB::select( DB::raw("SELECT id  FROM tb_detail WHERE email LIKE '%$search%' "));		
		$result = array();
		foreach($data as $key):
			$result[] = $key->id;
		endforeach;
		
		if( count($result) > 0 ):		

				$value =  implode(",", $result);

				$perPage = 20;
				if(isset($_GET['page']) && $_GET['page'] == 1)
				{
				$start = 0;
				$count = DB::table('tb_apply')->count();
				$data = DB::select( DB::raw("SELECT A.*, AF.title applyfortitle FROM tb_apply as A LEFT JOIN tb_detail AS D ON A.tb_detail_id = D.id LEFT JOIN tb_apply_for as AF ON D.apply_for_id = AF.id WHERE A.tb_detail_id IN ({$value})  ORDER BY A.id DESC LIMIT {$start}, {$perPage} "));
				$data = Paginator::make($data, $count, $perPage);
				}
				elseif(isset($_GET['page']))
				{
				$start = $perPage * ($_GET['page'] - 1);
				$count = DB::table('tb_apply')->count();
				$data = DB::select( DB::raw("SELECT A.*, AF.title applyfortitle FROM tb_apply as A LEFT JOIN tb_detail AS D ON A.tb_detail_id = D.id LEFT JOIN tb_apply_for as AF ON D.apply_for_id = AF.id WHERE A.tb_detail_id IN ({$value})  ORDER BY A.id DESC LIMIT {$start}, {$perPage} "));
				$data = Paginator::make($data, $count, $perPage);
				}

				else
				{
				$start = 0;
				$count = DB::table('tb_apply')->count();
				$data = DB::select( DB::raw("SELECT A.*, AF.title applyfortitle FROM tb_apply as A LEFT JOIN tb_detail AS D ON A.tb_detail_id = D.id LEFT JOIN tb_apply_for as AF ON D.apply_for_id = AF.id WHERE A.tb_detail_id IN ({$value})  ORDER BY A.id DESC LIMIT {$start}, {$perPage} "));
				//$data = DB::select( DB::raw("SELECT * FROM tb_apply WHERE id IN ($value)"));
				$data = Paginator::make($data, $count, $perPage);
				}	 
				return View::make('listing.index')
				->with('title', 'Listing Data')
				->with('data', $data);	
		else:
				
				return Redirect::route('list')
							->with('noresult', 'No result found');	

		
		endif;
		
		
	}
	
	public function allDelete()
	{
		//return "aa" . json_decode(Input::input('json_arr'));
		
		$data = json_decode(Input::input('link'));
		foreach($data as $key):
			$apply = Apply::find($key);
			$apply->delete();
		endforeach;
		
		$form_data['success'] = true;
		echo json_encode($form_data);
		//return gettype($data);
	}
}