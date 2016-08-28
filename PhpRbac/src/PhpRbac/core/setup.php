<?php

if ($adapter=="pdo_mysql")
{
	try {
		Jf::$Db=new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
	}
	catch (PDOException $e)
	{
		throw $e;
	}
}
elseif ($adapter=="pdo_sqlite")
{
		Jf::$Db=new PDO("sqlite:{$dbname}",$user,$pass);
// 		Jf::$Db=new PDO("sqlite::memory:",$user,$pass);
}
elseif($adapter == 'mysqli') # default to mysqli
{
	@Jf::$Db=new mysqli($host,$user,$pass,$dbname);
}else{
	throw new Exception('unknow database type');
}
