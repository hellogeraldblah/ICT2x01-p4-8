<?php
  
class DBphp extends SQLite3
{
    function __construct()
    {
        $this->open('codar_infomations.db');
    }

}
$db = new DBphp();
$query1="SELECT * FROM car_info ORDER BY distance DESC";

$result=$db->query($query1);
    
/* Fetch Rows from the SQL query */
while ($row = $result->fetchArray()) {
    echo'<tr>';
    echo "<td><h4>{$row['speed']}</h4></td>
    <td><h4>{$row['distance']}</h4></td>
    <td><h4>{$row['direction']}</h4></td>";
    echo'</tr>';
}

$db->close();
?>


