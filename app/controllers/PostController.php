<?php

class PostController  extends BaseController {

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
		 //return View::make('posts.index')
       //             ->with('title', 'Sites');
										
		$data = DB::select( DB::raw("SELECT tt.term_id id, t.name name, tt.parent parent FROM terms AS t LEFT JOIN term_taxonomy AS tt ON t.term_id = tt.term_id order by tt.parent desc") );
		
		// changed stdClass array to array
		$array = json_decode(json_encode($data), true);	
  	$result = Helpers::Category_combo($array,0,0);
			
		 return View::make('posts.index')
                    ->with('title', 'Posts')
                    ->with('data', $result);										
	}
	
	public function addPost()
	{
			$post = new Post;
			
			//Get skip number of posts
			$id = Helpers::getSkipNumber('posts', 'id');
			if($id):
				$post->id = $id;
				$post->post_title = Input::get('title');
				$post->post_content = Input::get('description');
				$post->post_parent = Input::get('category');
				$post->created_at = date("Y-m-d H:i:s");			
				$post->save();
			else:
				$post->post_title = Input::get('title');
				$post->post_content = Input::get('description');
				$post->post_parent = Input::get('category');
				$post->created_at = date("Y-m-d H:i:s");			
				$post->save();			
			endif;
			
			return Redirect::to('post')
						->with('success', 'Successfully added!');
			
	}
	
	public function listPost()
	{
		//$data = DB::select( DB::raw("SELECT tt.term_id id, t.name name, tt.parent parent FROM terms AS t LEFT JOIN term_taxonomy AS tt ON t.term_id = tt.term_id order by tt.parent desc") );
		$data = DB::select( DB::raw("SELECT T.name name, P.* FROM posts as P INNER JOIN terms as T WHERE P.post_parent=T.term_id") );
		return View::make('posts.list')
					->with('title', 'List Posts')
					->with('data', $data);
		/*
		$data = Site::paginate(20);		
		return View::make('sites.list')
						->with('title', 'List Sites')
						->with('data', $data);
		*/
	}
	
	public function viewPost($id)
	{
		$data = Post::find($id);
		
		return View::make('posts.detail')
						->with('title', $data->post_title)
						->with('data', $data);
	}
	
	public function goeditPost($id)
	{
		
		$data = DB::select( DB::raw("SELECT tt.term_id id, t.name name, tt.parent parent FROM terms AS t LEFT JOIN term_taxonomy AS tt ON t.term_id = tt.term_id order by tt.parent desc") );
		
		// changed stdClass array to array
		$array = json_decode(json_encode($data), true);	
  	
		
		$result = Post::find($id);
		
		$selectedid = $result->post_parent ;
		$results = Helpers::Category_combo_selected($array,0,0,0, $selectedid);
		return View::make('posts.edit')
						->with('title', 'Edit post')
						->with('result', $result)
						->with('data', $results);
	}
	
	public function saveEditPost()
	{
			Post::where('id', '=', Input::get('id'))
					->update(array(
					'post_title'=>Input::get('title'),
					'post_content'=>Input::get('description'),
					'post_parent' => Input::get('category'),
					'updated_at'=>date('Y-m-d H:i:s')
					));
					
		return Redirect::to('list-post')
						->with('success', 'Successfully edited!');							
				
	}
	
	public function deletePost($id)
	{
		$result = Post::find($id);
		$result->delete();
		return Redirect::to('list-post')
					->with('success', 'Successfully deleted');
	}
}
