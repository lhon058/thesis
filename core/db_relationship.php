<?php

	
	/* 10:18 Apr 22, 2014
	/ define the relationship between 
	/ sscbc current database and the myssc database using arrays
							*/
	
	$GLOBALS['relationship'] = array(

		/**
		 * student table relationship
		 */
		'student_table'    => array(

				'ssc_table_name'   => 'student',		// refer as the table name
				'myssc_table_name' => 'student',
				'StudentID'		   => 'studentRefID',
				'StudentNo'   	   => 'StudentNo',
				'FName' 	   	   => 'FName',
				'MName'		  	   => 'MName',
				'LName'		  	   => 'LName',
				
		),
		

	
	);





	


	
		
	?>
