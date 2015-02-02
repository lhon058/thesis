<?php
	
	/**
	 * 	@Mine 1:27am 06/17/2014
	 *  {This class handles all the sql file transaction }
	 *  Customized in order handle custom imports
	 */
	
	// include database relationships
	

class Importer extends PDO_Mine
{

	// set variables
	public    $file = null;
	public    $table_name = null;
	public 	  $table_len;


	protected $relationship_name;
	protected $line_number = 0;
	protected $start_number = [];
	protected $end_number = [];
	protected $fields;
	protected $values;
	protected $lines;
	protected $table_relationship,
			  $myssc_table ,
			  $foreign_keys_rel,
			  $column_names,
			  $table_exceptions,
			  $error_logs;


	public function __construct($file, $table_name, $relationship_name)
	{
		//set relationship link
		$this->foreign_keys_rel = Config::get($GLOBALS['relationship'], "foreign_key_relationship");

		$this->column_names = Config::get($GLOBALS['relationship'], "column_names");

		// add the data to the class variables
		$this->file 			 = $file;
		$this->table_name 		 = $table_name;
		$this->relationship_name = $relationship_name;

		// add the single qoutes
		$this->table_name = '`'.$table_name.'`';

		// get the length of the table name
		$this->table_len = strlen($this->table_name);

		//read the entire fiel
		$this->lines = file($file);

		// 
		$this->table_relationship = Config::get($GLOBALS['relationship'], $this->relationship_name);
		$this->myssc_table 		  = $this->table_relationship['myssc_table_name'];



		// table exceptions
		$this->table_exceptions = Config::get($GLOBALS['relationship'],'table_exceptions');

	}

	/**
	 * [process_all Calls all the required functions to simplify the work]
	 * @return [void] [nothing]
	 */
	public function process_all()
	{
		$num_of_imports = $this->getNumberOfInsert($this->table_name,$this->table_len);
		
		$data = $this->import_table_data();
		
		$this->process_data($data);
		//$this->view_as_table();
		$this->insert_values();
	}

	public function process_all_view($has_ignore = false)
	{
		$num_of_imports = $this->getNumberOfInsert($this->table_name,$this->table_len);
		
		$data = $this->import_table_data();
		
		$this->process_data($data);
		$this->view_as_table();
		$this->insert_values($has_ignore);

	}


	/**
	 * [import_table_data Process the first part of the parsing]
	 * @return [type] [description]
	 */
	public function import_table_data()
	{	
		
		
		// just for making it easier
	
		$table_name = $this->table_name;
		$table_len  = $this->table_len;
		

		//initialize the variables needed
		$templine = '';
		$has_insert = false;


		$lines = $this->lines;
		
		
		foreach($lines as $line)
		{

			if(isset($lines[$this->line_number-1]))
			{
				$this->previous_line = $lines[$this->line_number-1];
			}
			if(isset($lines[$this->line_number+1]))
			{
				$this->next_line = $lines[$this->line_number+1];
			}
				

			$this->line_number++;
			
			

    		
			// Skip it if it's a comment
			if (substr($line, 0, 2) == '--' || $line == '')
			    continue;


			
			
			//verify if the INSERT INTO statement has the same table name as the requested
			if(substr($line, 0, 11) == 'INSERT INTO' && substr($line , 12, $table_len) == $table_name )
			{			
					echo $this->myssc_table;
					$last_id = PDO_Mine::getInstance()
								->query("SELECT * FROM `db_updates` WHERE `table_name`= '$this->myssc_table' ORDER BY `last_max_id` DESC")
								->first()->last_max_id;	
					
					

						

					$comma_pos = strpos($this->previous_line,',');
					$prev_value = substr($this->previous_line, 2, $comma_pos - 2);

					$comma_pos = strpos($this->next_line,',');
					$next_value = substr($this->next_line, 2, $comma_pos - 2);

					if($test = Config::get($this->table_exceptions, $this->myssc_table))
					{
						$string_length =  strlen($this->next_line);
						$temp_string = substr($this->next_line,0, $string_length - 2);
						
						$comma_pos = strpos($this->next_line,',');
						$last_comma =  strripos($temp_string,',');
						
						$next_value = str_replace(')','',substr($temp_string, $last_comma + 1));
						
						//if($this->myssc_table_name == "student_subjects")
							//$last_id = $last_id - 1;
					}
					
					
					if(!is_numeric($prev_value) && $next_value >= $last_id && is_numeric($next_value))
					{

						$has_insert = true;
					
					}else if(is_numeric($prev_value) && is_numeric($next_value) && $next_value >= $last_id)
					{
						$has_insert = true;	
							
					}
					else
					{
						continue;
					}
					
			}

			// Add this line to the current segment
			if($has_insert == true)
				$templine .= $line;

			// If it has a semicolon at the end, it's the end of the query
			if (substr(trim($line), -1, 1) == ';' && $has_insert == true)
			{
			
				$pre_array = Config::get($GLOBALS['relationship'], $this->relationship_name);

				$templine =  str_replace($table_name,"`".Config::get($pre_array, 'myssc_table_name')."`",$templine);
				$this->table_name = Config::get($pre_array,'myssc_table_name');
			    
			    
			    
				
			    // Reset temp variable to empty
				$has_insert = false;
				return $templine;
			    
			    
			    

			}
		}
		 
	}


	public function process_data($sql_value)
	{
		/**
		 *  This function outlines an Insert statement into a table
		 *  This enables a more viewable resource to the user
		 *
		 *  Two criterias must be met 
		 *   [First]  = After the `TABLE NAME` all required field name must be get
		 *   [Second] = Then after the `VALUES` all the data must be parsed
		 **/

		// get the first occurence of the symbol "("
		$field_bracket_pos = strpos($sql_value, '(') ;


		// cut the remaining string 
		$new_sql_value = substr($sql_value, $field_bracket_pos+1);

		$field_last_bracket_pos = strpos($new_sql_value, ')');


		$table_fields = substr($new_sql_value, 0, $field_last_bracket_pos);
		$table_relationship = Config::get($GLOBALS['relationship'], $this->relationship_name);



		$table_fields = explode(',',$table_fields);
		
		
		
		$array_pos = 0;
		foreach ($table_fields as $field) {
			
			$field = str_ireplace("`","",$field);
			if(Config::get($table_relationship, $field))
			{
				$field_pos[] = $array_pos;
				$new_field_names[] = Config::get($table_relationship, $field);

			}

			$array_pos++;
			
		}

		

	


		$values = $this->loop_trough_values($new_sql_value);

		
		//echo func::print_pre($values);
		//echo "<pre>",print_r($values,true);
		foreach ($values as $value)
		{
			$count = 0;
			$f_value = null;
			$has_invalid = false;
			if(!empty($value))
			{
				
				foreach ($value as $key => $items)
				{
					if($count > count($field_pos) - 1)
					{
						break;
					}

					if($key === $field_pos[$count] )
					{
						
						if($foreign_table = Config::get($this->foreign_keys_rel,$new_field_names[$count]))
						{
							if(!$column_name = Config::get($this->column_names,$new_field_names[$count]))
								$column_name = $new_field_names[$count];


							$is_valid = PDO_Mine::getInstance()->get($foreign_table,array($column_name,"=",$items))
										->count();


							
							echo $is_valid ."<br>";
							if($is_valid == 0) 
							{
								$checker = PDO_Mine::getInstance()->query("SELECT * FROM `$foreign_table` WHERE `$column_name` = '$items'")
								->count();

								if($checker == 0)
								{
									$this->error_logs[] =  $foreign_table . "---- " . $column_name . "------" . $items . " -- " . $is_valid ."<br>";
									$has_invalid = true;
									$f_value[] = "NULL";	
								}
								
								
							}
									
							
						}
							
										

						
		
						if($has_invalid == true)
						{

							$has_invalid = false;
						}
						else
							$f_value[] = $items;
						
						$count++;
					}

					

				}
			}

				
			if(!empty($f_value))
				$final_value[] = $f_value;
			
		}

		
		//echo "<pre>",print_r($final_value,true);
		//func::print_pre($final_value);
		$this->fields = $new_field_names;
		$this->values = $final_value;
	}


	public  function view_as_table()
	{

		echo "<table border = '1'><th> Count </th>";
		foreach ($this->fields as $a) {
			echo "<th style = 'font-size:13px;padding:3px;'> $a " ; ?> <button onclick = "ajax(' <?php echo $a ?>'	,'process')" > <?php echo $a; ?> Change</button> <?php
			echo "</th>";
		}
		$count = 1 ;
		foreach ($this->values as $a) {
			echo "<tr style = 'font-size:13px;padding:3px;'> <td> $count </td>";
			foreach ($a as $value) {

				echo "<td> $value </td>";
			}
			echo "</tr>";
			$count++;
		}

		echo "</table>";
	

	}


	/**
	 * [This function loop through the values of an sql `INSERT` statement]
	 * 	! This requires a processed statement (Meaning : that it is processed by the first other functions )
	 * @param  [String] $sql_values [passed sql `INSERT` Statement]
	 * @return [return an array of values]
	 */
	public function loop_trough_values($sql_values)
	{
		
		$new_sql = $sql_values; // set a holder for the sql values


		// loop through the values if there is an available '(' symbol
		
		while($field_first_bracket_pos = strpos($new_sql, '('))
		{

			//remove other string before "(" symbol
			$new_sql = substr($new_sql, $field_first_bracket_pos + 1);


			// get the position of the last closing parenthesis
			
			$field_last_bracket_pos = strpos($new_sql, ')');

			// check if the next value of the ")" is a comma
			
			$nxt_symbol = substr($new_sql,$field_last_bracket_pos+1,1);

			
			if($nxt_symbol != "," && $nxt_symbol != ";")
				$field_last_bracket_pos = strpos($new_sql, '),');
			else if($nxt_symbol == ";")
					$field_last_bracket_pos = strpos($new_sql, ');');
				
			
			
			if($field_last_bracket_pos == false)
				$field_last_bracket_pos = strpos($new_sql, ');');

			
			// cut the String up to the first closing parenthesis
			$str_values  = substr($new_sql, 0, $field_last_bracket_pos);

			// get a new value for sql statement without the values that are cut
			$new_sql = substr($new_sql, $field_last_bracket_pos + 1);

			$f_value = "";

			/**
			 * [Get all the values that are separated with comma]
			 * @var [int] comma_pos
			 */
			

			while($comma_pos = strpos($str_values,',') )
			{
			
				
				// @!PROBLEM = requires recursive method 
				
				// get the value which is separated by the comma
				$value = substr($str_values,0,$comma_pos);
				

				// get an identifier to check if the previous value match the given statement
				
				$identifier = substr($value,strlen($value) - 1,strlen($value) );

				// check if the given value is a number
				$sub_idetifier = preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $value);
				
				$next_comma_pos = strpos($str_values, ",", $comma_pos + 1);
				

				/************************************
					This is only a test
					Sept 15. 2014 (Solved problems encountered with comma inside a value)
					OCT 3. 2014 (Problems encountered with subjects table)
				*/
				//echo "<br>".$str_values ."<br>";
				if(!is_numeric($value) && $value != "NULL")
				{

					$first_quot = strpos($str_values, "'");
					$next_quot = strpos($str_values, "'",$first_quot + 1);
					echo $value . "  " .$first_quot. "  " .$comma_pos . "  " . $next_quot."<br>";
					
					if($comma_pos > $next_quot)
					{

						$validator = substr($value, $next_quot - 1  ,1);
						
						if($validator == "\\")
						{
							$next_quot = $next_quot = strpos($str_values, "'",$next_quot + 1);
						}
					}

					while($comma_pos < $next_quot && $comma_pos > $first_quot )
					{	
						//echo "-----". strlen($str_values) . " ---- " .$str_values . "<br>";
						//echo "$value ----  |||| First == ". $first_quot . "Comma == ". $comma_pos . " -- Next == ".$next_quot ."<br>";
						$comma_pos = strpos($str_values,',',$comma_pos + 1);
						$value = substr($str_values,0,$comma_pos);

					}
				}
				

				/*
				************************************/

				// this part is the old solution for the comma inside the value problem

				//echo "$value -- Old Comma Pos = ". $comma_pos. " ---- Next Comma Pos = ". $next_comma_pos . "<br>";
				/*
				if($identifier != '\'' && !is_numeric($identifier) && $value != "NULL" 
					|| is_numeric($identifier) && $sub_idetifier)
				{
					
					// repeat the steps

					$str_values = preg_replace('/,/', '', $str_values, 1);
					
					$comma_pos =  strpos($str_values,',') ;
					$value = substr($str_values,0,$comma_pos);

					$identifier = substr($value,strlen($value) - 1,strlen($value) );
					$sub_idetifier = preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $value);

					if($identifier != '\'' && !is_numeric($identifier) && $value != "NULL" 
						|| is_numeric($identifier) && $sub_idetifier)
					{
						

							$str_values = preg_replace('/,/', '', $str_values, 1);
					
							$comma_pos =  strpos($str_values,',') ;
							$value = substr($str_values,0,$comma_pos);

							$identifier = substr($value,strlen($value) - 1,strlen($value) );
							$sub_idetifier = preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $value);

							if($identifier != '\'' && !is_numeric($identifier) && $value != "NULL" 
								|| is_numeric($identifier) && $sub_idetifier)
							{
								

									$str_values = preg_replace('/,/', '', $str_values, 1);
							
									$comma_pos =  strpos($str_values,',') ;
									$value = substr($str_values,0,$comma_pos);

							}
					}
					
				
						
					
					//echo "Problem : ". $value ."<br>";
					
				}*/


				$new_str_values = substr($str_values, $comma_pos + 1);
				
				$str_values = $new_str_values;




				$f_value[] = $value;

				if(!strpos($str_values,','))
				{
					$f_value[] = $str_values;
				}
				 		
			}
			
			
			$values[] = $f_value;

			

			
			

		}
		
		if(empty($values))
			exit;
		
		return $values;

	}

	
	/**
	 * Insert the parsed data into the database
	 * @param  [type] $fields [description]
	 * @param  [type] $values [description]
	 * @return [type]         [description]
	 */
	public function insert_values($has_ignore)
	{

		

		// get the instance of the database
		$pdo = PDO_Mine::getInstance();

		// set an array for the length
		$array_length = [];

		// counter
		$count = 1;

		// convert the array of fields into an String sql format
		$fields =  "`" . implode('` , `', $this->fields) ."`";
		$sql_value = '';
		
		// get the size of the array of values
		$array_size = sizeof($this->values);

		// set the max value to the lowest possible number
		$max_value = 0;
		
		

		// get the max value of the last update
		$last_id = $pdo->get("db_updates",array('table_name','=',$this->myssc_table))->first()->last_max_id;
			
		// loop through the values
		foreach ($this->values as $value)
		{

			// get the array length
			$array_length[] = sizeof($value);


			

			if($count == $array_size)
			{
				$total_number = ($array_size + $last_id) ;
			

				if($test = Config::get($this->table_exceptions, $this->myssc_table))
					$max_value = $value[sizeof($value) - 1];
				else
					$max_value = $value[0];

		
			}
			if(isset($array_length[1]))
			{
				$array_count = $count-1;
				if($array_length[$array_count] != $array_length[$array_count-1])
				{
					$gap = $array_length[$array_count - 1] - $array_length[$array_count];
					if($gap > 0)
						$value[$array_count + $gap] = "'error'";
				}
			}


			$sql_value .= "(".implode(',', $value) ."),";
			$count++;
		}
		
		if($last_id <= $max_value)
		{
			
			$ignore = ($has_ignore == true ? "IGNORE" : "");
			$insert_sql = "INSERT $ignore INTO  `$this->myssc_table` ($fields) VALUES $sql_value";
			

			$last_comma = strripos($insert_sql, ",");
			$insert_sql = substr($insert_sql,0, $last_comma);

			echo $insert_sql;
			
			if(!empty($this->error_logs))
				$this->error_logs = implode(",", $this->error_logs);

			
			
			if($result = $pdo->query($insert_sql))
			{
				if(!$result->error())
				{
					$pdo->insert(
						'db_updates',array
						 (
						 	'table_name'   => $this->myssc_table,
						 	"last_max_id"  => $total_number,
						 	"date_updated" =>  date('Y-m-d H:i:s'),
						 	"error_logs"   =>  $this->error_logs
						 )

						);
				}
				
			
			}
		}
		
	}

	
	public function getNumberOfInsert($table_name,$table_len)
	{
		$counter = 0;

	

		$lines = $this->lines;

		// Loop through each line
		
		foreach($lines as $line)
		{
			if(substr($line, 0, 11) == 'INSERT INTO' && substr($line , 12, $table_len) == $table_name) 
			{
				$counter++;
			}
		}

		return $counter;
	}

	



}




