<?php
class Helpers {

		
    public static function doMessage() {
        $message = 'Hello';
        return $message;
    }
	
	
	

	public static  function Category_combo($items,$parent,$level=0,$parent_id=0)
	{
		$hasChildren = false;
		$childrenHtml = '';
		foreach($items as $item)
		{
			if ($item['parent'] == $parent) 
			{
				$hasChildren = true;

				if($item['parent']==0)
					$sub_option=$item['name'];
				else
					$sub_option= $item['name'];
					//$sub_option= "- ".$item['name'];

				if($parent_id==$item['id'])
					$sel='selected="selected"';
				else
					$sel='';

				$childrenHtml .= '<option class="level-'.$level.'"  value="'.$item['id'].'" '.$sel.' >'.$sub_option;         
				$level++;
				$childrenHtml .= Helpers::Category_combo($items,$item['id'],$level,$parent_id);         
				$level=$level-1;
				$childrenHtml .= '</option>';           
			}
		}
		if (!$hasChildren) {
			$outputHtml = '';
		}
		// Returns the HTML
		return sprintf($childrenHtml);
	}
	
	public static  function Category_combo_selected($items,$parent,$level=0,$parent_id=0, &$aa)
	{		
		$selectedid = $aa;		
		$hasChildren = false;
		$childrenHtml = '';
		foreach($items as $item)
		{
			
			if ($item['parent'] == $parent) 
			{
				$hasChildren = true;

				if($item['parent']==0)
					$sub_option=$item['name'];
				else
					$sub_option= $item['name'];
					//$sub_option= "- ".$item['name'];

				if($item['id'] == $selectedid)
					$childrenHtml .= '<option class="level-'.$level.'"  value="'.$item['id'].'" selected  >'.$sub_option;         
				else
					$childrenHtml .= '<option class="level-'.$level.'"  value="'.$item['id'].'"  >'.$sub_option;
					
				$level++;
				$childrenHtml .= Helpers::Category_combo_selected($items,$item['id'],$level,$parent_id, $selectedid);         
				$level=$level-1;
				$childrenHtml .= '</option>';           
			}
		}
		if (!$hasChildren) {
			$outputHtml = '';
		}
		// Returns the HTML
		return sprintf($childrenHtml);
	}	
	
	
	public static function getSkipNumber($table, $id)
	{
		$data = DB::select( DB::raw("SELECT * FROM $table ORDER BY $id asc") );
		
		$i = 1;
		foreach($data as $v)
		{
			
			if($i!=$v->$id)
				return $i;
			++$i;
		}
		
		return $i;
	}




 
	
	
}