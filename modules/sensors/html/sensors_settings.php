<span class="belka">&nbsp Sensors<span class="okno"> 
<table>
<?php
$db = new PDO('sqlite:dbf/nettemp.db');
$rows = $db->query("SELECT * FROM sensors");
$row = $rows->fetchAll();
$numRows = count($row);
if ($numRows == 0 ) { echo "<span class=\"brak\"><img src=\"media/ico/Sign-Stop-icon.png\" /></span>"; }

$sth1 = $db->prepare("select * from settings ");
$sth1->execute();
$result2 = $sth1->fetchAll();
foreach ($result2 as $a) {
$lcd=$a["lcd"];
}


?>
<tr>
<td></td>
<td><center>Name</center></td>
<td></td>
<td><center>Sensor id</center></td>
<td><center>Size</center></td>
<td><center>Status</center></td>
<?php if ( $lcd == 'on' ) { ?> <td>LCD</td> <?php } else { ?> <td></td> <?php } ?>
<td></td>
<td></td>
<td></td>
</tr>
<?php foreach ($row as $a) { 	
	
?>
<tr>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<td><img src="media/ico/TO-220-icon.png" /></td>
<td><input type="text" name="name_new" size="12" maxlength="30" value="<?php echo $a["name"]."\t"; ?>" /></td>
<input type="hidden" name="name_id" value="<?php echo $a["id"]."\t"; ?>" />
<input type="hidden" name="id_name2" value="id_name3"/>
<td><input type="image" src="media/ico/Actions-edit-redo-icon.png" /></td>
</form>


<td><?php 	echo  $a["rom"] ;?></td>
<?php
	$id_rom3 = str_replace(" ", "_", $a["rom"]);
	$id_rom2 = "$id_rom3.sql";
	$file3 =  "db/$id_rom2";
	if (file_exists($file3) && ( 0 != filesize($file3)))
   {?>
<td><?php $filesize = (filesize("$file3") * .0009765625) * .0009765625; echo round($filesize, 3) ?>MB</td>
<td><center><img src="media/ico/Ok-icon.png" /></center></td>
</form>
<?php   }
else { ?> 
<td>Error - no sql base</td>
<?php } ?>

<?php 
if ( $lcd == 'on' ) { 
?>
    <form action="" method="post"> 	
    <input type="hidden" name="lcdid" value="<?php echo $a["id"]; ?>" />
    <td><input type="checkbox" name="lcdon" value="on" <?php echo $a["lcd"] == 'on' ? 'checked="checked"' : ''; ?> onclick="this.form.submit()" /></td>
    <input type="hidden" name="lcd" value="lcd" />
    </form>
<?php
}
?>



<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post"  >
<input type="hidden" name="usun_czujniki" value="<?php echo $a["rom"]; ?>" />
<input type="hidden" name="usun2" value="usun3" />
<td><input type="image" src="media/ico/Close-2-icon.png" /></td>
</form>

</tr>
		

<?php 

}  

?>
</table>
</span></span>
