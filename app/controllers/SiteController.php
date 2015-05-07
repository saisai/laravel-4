<?php

class SiteController  extends BaseController {

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
		 return View::make('sites.index')
                    ->with('title', 'Sites');
	}
	
	public function addLink()
	{
			$site = new Site;
			$site->title = Input::get('title');
			$site->link = Input::get('link');
			$site->description = Input::get('description');
			$site->created_at = date("Y-m-d H:i:s");
			$site->save();
			
			return Redirect::to('site')
						->with('success', 'Successfully added!');
			
	}
	
	public function listLink()
	{
		$data = Site::paginate(20);
		
		return View::make('sites.list')
						->with('title', 'List Sites')
						->with('data', $data);
	}
	
	public function viewSite($id)
	{
		$data = Site::find($id);
		
		return View::make('sites.detail')
						->with('title', 'View detail of site')
						->with('data', $data);
	}
	
	public function goeditSite($id)
	{
		$data = Site::find($id);
		return View::make('sites.edit')
						->with('title', 'Edit site')
						->with('data', $data);
	}
	
	public function saveEditSite()
	{
			Site::where('id', '=', Input::get('id'))
					->update(array(
					'title'=>Input::get('title'),
					'link'=>Input::get('link'),
					'description'=>Input::get('description'),
					'updated_at'=>date('Y-m-d H:i:s')
					));
					
		return Redirect::to('list-link')
						->with('success', 'Successfully edited!');							
				
	}
	
	public function deleteSite($id)
	{
		$result = Site::find($id);
		$result->delete();
		return Redirect::to('list-link')
					->with('success', 'Successfully deleted');
	}
}
