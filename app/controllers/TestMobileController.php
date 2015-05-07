<?php

class TestMobileController extends BaseController {

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
			$strKeyword = Input::get("txtKeyword");
			 $data = DB::select( DB::raw("SELECT * FROM customer WHERE Name LIKE '%".$strKeyword."%'  "));
			 echo json_encode($data);

	}

	public function postData()
	{
		//Validation
		//var_dump(Input::file('file'));
		$rules = array(
			'title' => 'required',
			'file' => 'required',
		);
		
		$validation = Validator::make(Input::all(), $rules);
		
		if ($validation->fails()):
			return Redirect::to('upload')->withErrors($validation)->withInput();
		else:
			$destinationPath = public_path().'/assets/files';
			$file = Input::file('file');
			$filename = Input::file('file')->getClientOriginalName();
			$upload_success = Input::file('file')->move($destinationPath, $filename);

			if( $upload_success ) {
			   $date = new DateTime;
			   $title = Input::get('title');
					
					/*
			    DB::table('tb_upload')->insert(
			    	array(
			    		array(
			    			'title' => $title,
			    			'filename' =>  $filename,
			    			'created_at' => $date->format('Y-m-d H:i:s')
			    			)
			    		)
			    	);
					*/
					
					$upload = new Upload;
					$upload->title = $title;
					$upload->filename= $filename;
					$upload->created_at = date("Y-m-d H:i:s"); 
					$upload->save();
					return Redirect::route('upload')->with('success', 'File was uploaded succesfully.');	
			    
			   //return Response::json('success', 200);
			} else {
			   //return Response::json('error', 400);
			}
		endif;
	}
	
	public function listUpload()
	{
				//$data = DB::table('tb_upload')->get(); 
				$data = Upload::all();
				return View::make('upload.list')
					->with('title', 'Listing Upload Data')
					->with('data', $data);
	}
	
	public function editUpload($id)
	{
		//$upload = DB::table('tb_upload')->where('id', $id)->first();
		
		$upload = Upload::find($id);
		//$upload->delete();
		
		return View::make('upload.edit')
			->with('title', 'Edit Upload Data')
			->with('result', $upload);

		
		

	}
	
	public function deleteImage($id)
	{			
			//$upload = DB::table('tb_upload')->where('id', $id)->first();
			$upload = Upload::find($id);
			$file = $upload->filename;
			//return public_path().'/assets/files/'.$file;
			File::delete(public_path().'/assets/files/'.$file);

			return View::make('upload.reuploadimage')
				->with('title', 'Reupload Image')
				->with('data', $upload);
	}
	
	public function reuploadImage()
	{
		$id = Input::get('id');		
		//$upload = DB::table('tb_upload')->where('id', $id)->first();
		//$upload = Upload::find($id);
		//$filename = $upload->filename;
		$destinationPath = public_path().'/assets/files';
		$file = Input::file('file');
		$filename = Input::file('file')->getClientOriginalName();
		$upload_success = Input::file('file')->move($destinationPath, $filename);
		
		if( $upload_success ):
				Upload::where('id', '=', $id)->update(array('filename' => $filename,'updated_at' => date("Y-m-d H:i:s")));
				return Redirect::route('edit_upload', array($id));
		endif;
	}
	
	public function editUploadData()
	{
		$id = Input::get('id');
		$title = Input::get('title');
		//$upload = Upload::find($id);
		//$title = $upload->title;

		/*
		Update with query builder
		*/
		/*
		DB::table('tb_upload')
			->where('id', $id)
			->update(array('title'=> $title, 'updated_at'=>date("Y-m-d H:i:s")));
		*/
		Upload::where('id', '=', $id)
						->update(array(
										'title'=>$title,
										'updated_at'=>date("Y-m-d H:i:s")
										));
			
		return Redirect::route('list_upload')
					->with('success', 'Succesfully updated');
		
	}
	
	public function deleteUpload($id)
	{
	
		//$upload = DB::table('tb_upload')->where('id', $id)->first();
		$upload = Upload::find($id);
		$filename = $upload->filename;
		$upload->delete();
		File::delete(public_path().'/assets/files/'.$filename);
		DB::table('tb_upload')->where('id','=', $id)->delete();		
		return Redirect::to('list_upload')
				->with('success', 'Succesfully deleted.');

	}
	
	public function editImage($id)
	{
		return $id;
	}

}
