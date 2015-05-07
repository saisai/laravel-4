<?php

class ApplyforController extends BaseController {

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

			 return View::make('applyfor.index')
				->with('title', 'Apply for');

	}

	public function addApplyFor()
	{
		$title = Input::get('title');
		/*
		DB::table('tb_apply_for')
				->insert(array(
					'title' => $title,
					'created_at' => date("Y-m-d H:i:s")
				));
		*/
		$applyfor = new Applyfor;
		$applyfor->title = $title;
		$applyfor->created_at = date("Y-m-d H:i:s");
		$applyfor->save();
		return Redirect::action('ApplyforController@showIndex')
					->with('success', 'Successfully added!');
	}
	
	public function listApplyFor()
	{
		$data = Applyfor::paginate(30);
		//$data = DB::table('tb_apply_for')->paginate(30);
		return View::make('applyfor.list')
					->with('title', 'Listing Upload Data')
					->with('data', $data);
	}
	
	
	public function editApplyFor($id)
	{
		/*
		$data = DB::table('tb_apply_for')
							->where('id', $id)
							->first();
		*/
		$data = Applyfor::find($id);
		return View::make('applyfor.edit')
								->with('title', 'Edit')
								->with('data', $data);
		
	}
	
	public function saveEditApplyFor()
	{
		$id = Input::get('id');
		$title = Input::get('title');
		/*
		DB::table('tb_apply_for')
				->where('id', $id)
				->update(
				array(
				'title'=>$title,
				'updated_at'=>date("Y-m-d H:m:s")
				));
			*/
		Applyfor::where('id', '=', $id)->update(array('title'=>$title, 'updated_at'=>date("Y-m-d H:m:s")));
				
		return Redirect::to('list_apply_for')
						->with('success', 'Successfully edited!');

	}
	
	public function deleteApplyFor($id)
	{
			$applyfor = Applyfor::find($id);
			$applyfor->delete();
			return Redirect::to('list_apply_for')
						->with('success', 'Successfully deleted!');
	}
	
}