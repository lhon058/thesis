<?php


class PDO_Mine{

	private static  $_instance = null;
		private 	$_connect,
					$_db,
					$_query,
					$_error = false,
					$_results,
					$_count = 0;
					


	
	public function __construct( $host = null, $username = null, $password = null, $db = null)
	{
		
		if(!$db){
			$db = Config::get(null,'mysql/db');
		}

		if(!$host || !$username || !$password)
		{
			$host 		= Config::get(null,'mysql/host');
			$username   = Config::get(null,'mysql/username');
			$password 	= Config::get(null,'mysql/password');
		}
		
		
		try{
			
			$this -> _connect = new PDO("mysql:host=".$host.";dbname=".$db ,$username, $password );
			
			
			//echo "<b id = 'con_tag'style = 'color:rgba(0,0,255,0.8);float:right;'> PDO CONNECTED TO DB: $db</b><br>";
		
		}catch(Exception $e){

				die($e);
		}
		
	}


	public static function getInstance()
	{

		if(!isset(self::$_instance)){
			self::$_instance = new PDO_Mine("localhost","Mine","theone","evaluation");
		}

		return self::$_instance;

	}

	public static function setNewInstance($host = null, $username = null , $password = null, $db=null){

		echo "<script> var con_tag = document.getElementById('con_tag'); con_tag.innerHTML = '';</script>";
		if(isset(self::$_instance)){
			self::$_instance = new PDO_Mine($host, $username, $password, $db);
		}

		return self::$_instance;
	}
	

				//############################
				//##                        ##
				//##   QUERYING FUNCTIONS   ##
				//##                        ##
				//############################



	public function query($sql, $params = array())
	{

		$this -> _error = false;
		//echo '<br><br>'.$sql , '<br><br>';
		
		
		if($this-> _query = $this-> _connect->prepare($sql))
		{

			if(count($params))
			{
				$x = 1;
					foreach($params as $param => $value)
					{
						$this-> _query->bindValue($x, $value);
						$x++;					
					}
			}

			if($this-> _query ->execute()){

				$this-> _results = $this-> _query->fetchAll(PDO::FETCH_OBJ);	
				$this-> _count   = $this-> _query->rowCount();
				
			}else{
				$this-> _error = true;
				print_r($this-> _query->errorInfo());
			}
			

		} 


		else{

			echo 'Invalid Query';

			echo $this-> _connect->error;
			$this-> _error = true;
			echo $this-> _query -> error;

		}

		return $this;
	}

	private function action($action, $table, $where = array())
	{

		if(count($where) === 3)
		{

			$operators = array('=','>','<','>=','<=');

			$field = $where[0];
			$operator = $where[1];
			$value = $where[2];



			if(in_array($operator,$operators)){
				
				$sql = "{$action} FROM `{$table}` WHERE `{$field}` {$operator} ?";
				
				if(!$this->query($sql,array($value))->error())
				{
					return $this;
				}


			}

		}

		return false;

	}


	public function get($table, $where)
	{
		return $this->action("SELECT *", $table, $where);
	}

	public function delete($table, $where)
	{
		return $this->action('DELETE',$table,$where);
	}

	public function insert($table, $fields = array())
	{
		if(count($fields)){
			$keys = array_keys($fields);
			$values = array_values($fields);
			$value = '';
			$x = 1;
			foreach ($fields as $field) {
				
				$value .= "?";
				if($x < count($fields))
				{
					$value .= ",";
				}

				$x++;

			}
			
			$sql = "INSERT INTO {$table} ( `" . implode('`,`', $keys).  "`  ) VALUES ($value)";
			
			
			if(!$this->query($sql,$values)->error())
				return true;

		}

		return false;
	}

	public function update($table, $id, $fields)
	{
		$set = '';
		$x = 1;

		foreach ($fields as $name => $value) {
			$set .= "{$name} = ?";
			if($x < count($fields))
			{
				$set .= ",";
			}
			$x++; 
		}

		$sql = "UPDATE {$table} SET {$set} WHERE user_id = {$id}";

		if(!$this->query($sql, $fields)->error())
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	public function results(){ return $this-> _results; }

	public function error(){ return $this-> _error; }

	public function count(){ return $this-> _count; }

	public function first(){ return $this-> _results[0];}

	public function last()
	{
		$count_max = count($this-> _results);

		return $this-> _results[$count_max - 1];
	}

	public function array_field_convertion($array)
	{
		return '`'.implode('`, `',$array) .'`';
	}



	public function array_data_convertion($array)
	{
		return '\''.implode('\', \'',$array) .'\'';
	}

	public function use_pre_tags($array = array())
	{
		return "<pre> ". print_r($array) . "</pre>";
	}


}



?>