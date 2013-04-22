<?php
/*
    This file is part of CCU CSIE Property Management System.

    CCU CSIE Property Management System is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    CCU CSIE Property Management System is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with CCU CSIE Property Management System.  If not, see <http://www.gnu.org/licenses/>.
*/		
	class pms_db{
	
		private $connect; // connecting instruction
		private $col_in_table;	// an array , all columns in each table
		
		public function __construct(){
			$host = '127.0.0.1';	//MySQL Server IP
			$user = 'root';			//MySQL Account Name
			$passwd = 'office107';	//MySQL Account Password
			$db = 'CCUPMS';			//MySQL Database Name
			$this->connect = mysql_connect($host,$user,$passwd) or die("oops! , failed to connect to database!");
			mysql_select_db($db);
			mysql_query('SET NAMES utf8',$this->connect); 
			mysql_query('SET CHARACTER_SET_CLIENT=utf8',$this->connect);
			mysql_query('SET CHARACTER_SET_RESULTS=utf8',$this->connect);				
			$this->col_in_table['Notice'] = array('n_id','n_date','content');
			$this->col_in_table['Product'] = array('p_id','p_acc','p_name','model','p_state');
			$this->col_in_table['Record'] = array('re_id','p_acc','u_acc','re_state','re_date');
			$this->col_in_table['Reserve'] = array('r_id','u_id','p_id','date','r_state');
			$this->col_in_table['User'] = array('u_id','u_acc','name','grade','phone','mail','competence');
			//echo 'construct success!<br/>';
		}
		
		public function my_query($str,$type){
			$sql=mysql_query($str,$this->connect) or die ('failed to query, check your command');
				//if ($sql===true||$sql===false)
				  //  return $sql;
			   // if ($sql==null)
				 //   return null;
				//if ($return_type==0){
				  //  return mysql_fetch_array($sql);
			   // }
			   // else{
					if ($type==2)
					{
						while ($ret[$i]=mysql_fetch_array($sql))
						$i++;						
						return $ret;
					}
					else
					{
					    //echo 'database has been updated'.'<br/>';
						return NULL;
					}
			   // }					
		}
		
		public function close(){			
			mysql_close($this->connect);					
		}
		
		public function __destruct(){		
		}		
		
	}	


?>


