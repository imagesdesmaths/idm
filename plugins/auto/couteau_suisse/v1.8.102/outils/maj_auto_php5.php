<?php
// PHP 5 mini : utilise sqlite pour questionner SVN 1.7
function cs_svn17($dir) {
	if(!class_exists('PDO')) return false;
	try { 
		$db = new PDO('sqlite:' . $dir);
	//	foreach ($db->query('SELECT * FROM SQLite_master WHERE type=\'table\';') as $row) print_r($row);
		if($res = $db->query('SELECT root FROM REPOSITORY;')) {
			foreach($res as $row) { $url = $row[0]; break; }
			if($res = $db->query("SELECT repos_path FROM NODES WHERE local_relpath='$b';"))
				foreach($res as $row) { $url .= '/' . $row[0]; break; }
			if($res = $db->query("SELECT MAX(changed_revision) FROM NODES WHERE local_relpath LIKE '$b%';"))
				foreach ($res as $row) return array($row[0], $url);
		}
	} catch(PDOException $e) {
		return false;
	}
	return false;
}
?>