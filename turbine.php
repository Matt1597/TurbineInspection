/**
* Author: Matthew Reilly
*/
<?php

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, notes FROM example";
$result = $conn->query($sql);
$a=array();
if ($result->num_rows > 0) {
 
//number of columns
$cols = 10;

$count = 10;

//creating str to be used as the table in html
$html = '<table class="blueTable">';
    
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($count == $cols){
            $html .= '<tr>';
            $count = 0;
            
        }
        //checking if divisible by 3 or 5
        $three = check($row["id"],3);
        $five =  check($row["id"],5);
        if($three + $five == 2){
            //if both divisible by 3 and 5 output this
            $html .= '     <td class="red">Coating Damage and Lightning Strike</td>     ';
            
        }else if($three == 1){
           //if divisible by only 3 output this
            $html .= '     <td class="yellow">Coating Damage</td>     ';
            
        }else if($five == 1){
            //if divisible by only 5 output this
            $html .= '     <td class="yellow">Lightning Strike</td>     ';
            
        }else{
            //of not divisible by 3 or 5 output the inspection number
             $html .= '     <td>' . $row["id"] . '</td>     ';
            
        }
        $count = $count + 1;
        if($count == $cols){
            
            $html .= "</tr>";
            
        }
    }
    $html .= '<table>';
    echo $html;
} 
else {
  echo "0 results";
}

$conn->close();

//checks where a number can be divided by another to create a whole number
function check($num,$divide){
    if(floor($num/$divide) == $num/$divide){
        return 1;
    }else{
        return 0;
    }

}

?>