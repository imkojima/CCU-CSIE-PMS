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

require_once('db_object.php');


// Function:  Specific Search 
//    Input:  $keyword (for serach keyword) $table(which table for search)  $type(for search type)
//   Output:  array of results(will different format according to table)
function Search($keyword,$table,$part){
  $dbc=new pms_db();

  if($table =='Property'){
      switch($part){                 
        case 'full':                   //full type can search all type
          $str="SELECT * FROM Property WHERE p_name LIKE '%".$keyword."%' or p_acc='".$keyword."'or p_state='".$keyword."'";
          break;
        case 'name':                  //name type just seach name
          $str="SELECT * FROM Property WHERE p_name LIKE '%".$keyword."%'";
          break;
        case 'state':                //state type just search state
          $str="SELECT * FROM Property WHERE p_state LIKE '%".$keyword."%'";
          break; 
        case 'acc':                 //acc type just search p_acc state
          $str="SELECT * FROM Property WHERE p_acc = '".$keyword."'";
          break;
        case 'id':
          $str="SELECT * FROM Property WHERE p_id = '".$keyword."'";
          break;
      }
  }
/*
  if($table =='Record'){
       switch($part){
         case 'u_acc':
           $str="SELECT * FROM Record WHERE u_acc = '".$keyword."'";
          break;
       }
  }
 */
  $result=$dbc->my_query($str,2);

  $i=0;
  foreach($result as $row){           // use foreach to run the array
         if($row)
            $data[$i] = $row;
         $i++;
  } 

  $dbc->close();
  return $data;
}

 
?>
