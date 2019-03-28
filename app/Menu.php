<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	// Recursive function that builds the menu from an array or object of items
	// In a perfect world some parts of this function would be in a custom Macro or a View
	public function buildMenu($menu, $parentid = 0) 
	{ 
	  $result = null;
	  foreach ($menu as $item) 
	    if ($item->parent_id == $parentid) { 
	      $result .= "<li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
	      <div class='dd-handle nested-list-handle'>
	        <span class='glyphicon glyphicon-move'></span>
	      </div>
	      <div class='nested-list-content'>{$item->label}
	        <div class='pull-right'>
	          <a href='".url("admin/menu/edit/{$item->id}")."'>Edit</a> |
	          <a href='#' class='delete_toggle' rel='{$item->id}'>Delete</a>
	        </div>
	      </div>".$this->buildMenu($menu, $item->id) . "</li>"; 
	    } 
	  return $result ?  "\n<ol class=\"dd-list\">\n$result</ol>\n" : null; 
	} 

	public function renderMenu($menu,$class = 'dd-list')
	{
    $html = "<ol class=\"".$class."\" id=\"menu-id\">";
    foreach($menu as $key => $value) {
      $html.= '<li class="dd-item dd3-item" data-id="'.$value['id'].'" >
                  <div class="dd-handle dd3-handle">Drag</div>
                  <div class="dd3-content"><span id="label_show'.$value['id'].'">'.$value['label'].'</span> 
                      <span class="span-right">/<span id="link_show'.$value['id'].'">'.$value['url'].'</span> &nbsp;&nbsp; 
                          <a class="edit-button" id="'.$value['id'].'" label="'.$value['label'].'" link="'.$value['url'].'" ><i class="fa fa-pencil"></i></a>
                          <a class="del-button" id="'.$value['id'].'"><i class="fa fa-trash"></i></a></span> 
                  </div>';
      if(array_key_exists('child',$value)) {
          $html .= renderMenu($value['child'],'child');
      }
        $html .= "</li>";
    }
    $html .= "</ol>";
    return $html;
	}

	// Getter for the HTML menu builder
	public function getHTML($items)
	{
		return $this->buildMenu($items);
	}

	// Getter for the HTML menu builder
	public function renderHTML($items)
	{
		return $this->renderMenu($items);
	}	
}
