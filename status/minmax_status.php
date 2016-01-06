<?php
$root=$_SERVER["DOCUMENT_ROOT"];
$db = new PDO("sqlite:$root/dbf/nettemp.db");
$rows = $db->query("SELECT * FROM sensors WHERE minmax='on'");
$result = $rows->fetchAll();
$numRows = count($result);
if ( $numRows > '0' ) { ?>

<div class="grid-item">
<div class="panel panel-default">
<div class="panel-heading">Sensors Min Max</div>
<div class="table-responsive">
<table class="table table-hover table-condensed">
<tbody>
<tr>
   <th></th>
<!--  <th>Hour</th> -->
    <th>Day</th>
    <th>Week</th>
    <th>Month</th>
</tr>
<?php
foreach ($result as $a) {

$rom=$a['rom'];
$file=$rom .".sql";


    $db1 = new PDO("sqlite:$root/db/$file");
    $h = $db1->query("select min(value) AS hmin, max(value) AS hmax from def WHERE time BETWEEN datetime('now','localtime','-1 hour') AND datetime('now','localtime')") or die('hour');
    $h = $h->fetch(); 
    $d = $db1->query("select min(value) AS dmin, max(value) AS dmax from def WHERE time BETWEEN datetime('now','localtime','-1 day') AND datetime('now','localtime')") or die('day');
    $d = $d->fetch(); 
    $w = $db1->query("select min(value) AS wmin, max(value) AS wmax from def WHERE time BETWEEN datetime('now','localtime','-7 day') AND datetime('now','localtime')") or die('week');
    $w = $w->fetch(); 
    $m = $db1->query("select min(value) AS mmin, max(value) AS mmax from def WHERE time BETWEEN datetime('now','localtime','-1 months') AND datetime('now','localtime')") or die('week');
    $m = $m->fetch(); 

    echo "<tr>
	<td>".$a['name'] ."</td>
<!--	<td><span class=\"label label-info\">".number_format($h['hmin'], 1, '.', '')."</span><span class=\"label label-warning\">".number_format($h['hmax'], 1, '.', '')."</span></td> -->
	<td><span class=\"label label-info\">".number_format($d['dmin'], 1, '.', '')."</span><span class=\"label label-warning\">".number_format($d['dmax'], 1, '.', '')."</span></td>
	<td><span class=\"label label-info\">".number_format($w['wmin'], 1, '.', '')."</span><span class=\"label label-warning\">".number_format($w['wmax'], 1, '.', '')."</span></td>
	<td><span class=\"label label-info\">".number_format($m['mmin'], 1, '.', '')."</span><span class=\"label label-warning\">".number_format($m['mmax'], 1, '.', '')."</span></td>
	</tr>";
}
?>
</tbody>
</table>
</div>
</div>
</div>
<?php 
}
?>