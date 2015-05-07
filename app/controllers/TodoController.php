<?php

class TodoController  extends BaseController {

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
		 return View::make('todo.index')
                    ->with('title', 'Todo List');
	}
	
	public function addTodolist()
	{
			$todolist = new Todolist;
			
			// Get skip number from tb_todolist table
			$id = Helpers::getSkipNumber('tb_todolist', 'id');
			if($id):
				$todolist->id = $id;
				$todolist->title = Input::get('title');
				$todolist->description = Input::get('description');
				$todolist->created_at = date("Y-m-d H:i:s");
				$todolist->save();
			else:
				$todolist->title = Input::get('title');
				$todolist->description = Input::get('description');
				$todolist->created_at = date("Y-m-d H:i:s");
				$todolist->save();			
			endif;
			
			return Redirect::to('todo')
						->with('success', 'Successfully added!');
			
	}
	
	public function listTodo()
	{
		$data = Todolist::paginate(20);
		
		return View::make('todo.list')
						->with('title', 'List TodoList')
						->with('data', $data);
	}
	
	public function viewTodo($id)
	{
		$data = Todolist::find($id);
		
		return View::make('todo.detail')
						->with('title', $data->title)
						->with('data', $data);
	}
	
	public function goeditTodo($id)
	{
		$data = Todolist::find($id);
		return View::make('todo.edit')
						->with('title', 'Edit Todo List')
						->with('data', $data);
	}
	
	public function saveEditTodo()
	{
			Todolist::where('id', '=', Input::get('id'))
					->update(array(
					'title'=>Input::get('title'),
					'description'=>Input::get('description'),
					'updated_at'=>date('Y-m-d H:i:s')
					));
					
		return Redirect::to('list-todolist')
						->with('success', 'Successfully edited!');							
				
	}
	
	public function deleteTodo($id)
	{
			$result = Todolist::find($id);
			$result->delete();
			return Redirect::to('list-todolist')
						->with('success', 'Successfully deleted!');										
	}
}
