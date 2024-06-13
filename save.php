<?php

$dsn = 'mysql:dbname=dev;host=127.0.0.1;charset=utf8';
$user = 'user';
$password = 'password';

$db = new PDO($dsn, $user, $password);
$query = 'INSERT INTO wst_answer(`region`, `regionrm`, `school`, `class`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`, `c7`, `c8`, `c9`, `c10`, `c11`, `c12`, `c13`, `c14`, `c15`) '
        . 'VALUES('.$db->quote($_POST['region']).', '
		.$db->quote($_POST['regionrm']).', '
		.$db->quote($_POST['school']).', '
		.$db->quote($_POST['class']).', '
        .$db->quote($_POST['cat'][1]).', '
		.$db->quote($_POST['cat'][2]).', '
		.$db->quote($_POST['cat'][3]).', '
		.$db->quote($_POST['cat'][4]).', '
		.$db->quote($_POST['cat'][5]).', '
        .$db->quote($_POST['cat'][6]).', '
		.$db->quote($_POST['cat'][7]).', '
		.$db->quote($_POST['cat'][8]).', '
		.$db->quote($_POST['cat'][9]).', '
		.$db->quote($_POST['cat'][10]).', '
        .$db->quote($_POST['cat'][11]).', '
		.$db->quote($_POST['cat'][12]).', '
		.$db->quote($_POST['cat'][13]).', '
		.$db->quote($_POST['cat'][14]).', '
		.$db->quote($_POST['cat'][15]).' )';
$i = $db->query($query); 