<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class MasterModel extends Model {
	
	protected $attributes = array();
	protected $rules = array();
	public $validation = array();
	
	public function validate()
    {
		$this->validation = Validator::make($this->attributes, $this->rules);

		return $this->validation->passes();
    }
	
	public function setAttributes($data=array())
	{
		foreach($data as $k=>$v)
		{
			$this->$k = $v;
		}
		$this->attributes = $data;
	}
	
	public function save(array $options=array())
    {
		if($this->validate())
			return parent::save();
		else
			return false;
    }
	
	public function showErrors()
	{
		$str = '';
		if(!empty($this->validation))
		{
			$errors = $this->validation->errors()->all();
			$str .= '<ul>';

			foreach($errors as $k=>$v)
			{
				$str .= "<li>".$v."</li>";
			}
			$str .= '</ul>';
		}
		return $str;
	}
}

?>