<?php

class CategoryController  extends BaseController {

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
		 //$data = DB::table("terms")->get();
		 //$data = DB::raw("SELECT t.*, tt.* FROM terms AS t INNER JOIN term_taxonomy AS tt ON t.term_id = tt.term_id");

						
		$data = DB::select( DB::raw("SELECT tt.term_id id, t.name name, tt.parent parent FROM terms AS t LEFT JOIN term_taxonomy AS tt ON t.term_id = tt.term_id order by tt.parent desc") );
		
		// changed stdClass array to array
		$array = json_decode(json_encode($data), true);	
  	$result = Helpers::Category_combo($array,0,0);
			
		 return View::make('category.index')
                    ->with('title', 'Category')
                    ->with('data', $result);
		
	}
	
	public function addCategory()
	{
			$term = new Terms;
			$term->name = Input::get('title');
			//$category->description = Input::get('description');
			//$category->created_at = date("Y-m-d H:i:s");
			$term->save();
			
			if(Input::get('category') && Input::get('category') > 0 ):
				$termtaxonomy = new Termtaxonomy;
				$termtaxonomy->term_id = $term->id;			
				$termtaxonomy->parent = Input::get('category');			
				$termtaxonomy->save();
			else:
				$termtaxonomy = new Termtaxonomy;
				$termtaxonomy->term_id = $term->id;			
				$termtaxonomy->parent = 0;			
				$termtaxonomy->save();			
			endif;
			
			return Redirect::to('category')
						->with('success', 'Successfully added!');
			
	}
	
	public function listCategory()
	{
		//$data = Category::paginate(20);
		
		$data = DB::select( DB::raw("SELECT tt.term_id id, t.name name, tt.parent parent FROM terms AS t LEFT JOIN term_taxonomy AS tt ON t.term_id = tt.term_id order by tt.parent desc") );
		
		return View::make('category.list')
						->with('title', 'List Category')
						->with('data', $data);
	}
	
	public function viewCategory($id)
	{
		$data = Terms::find($id);
		
		return View::make('category.detail')
						->with('title', 'View detail of Category List')
						->with('data', $data);
	}
	
	public function goeditCategory($id)
	{
		$data = Terms::find($id);
		return View::make('category.edit')
						->with('title', 'Edit Category List')
						->with('data', $data);
	}
	
	public function saveEditCategory()
	{
			Terms::where('id', '=', Input::get('id'))
					->update(array(
					'title'=>Input::get('title'),
					'description'=>Input::get('description'),
					'updated_at'=>date('Y-m-d H:i:s')
					));
					
		return Redirect::to('list-category')
						->with('success', 'Successfully edited!');							
				
	}
	
	public function deleteCategory($id)
	{
			$result = Terms::find($id);
			$result->delete();
			return Redirect::to('list-category')
						->with('success', 'Successfully deleted!');										
	}
}


 







