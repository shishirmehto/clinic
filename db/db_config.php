<?php
	$cid = mysqli_connect("localhost","root","","hospital");
	function iud($query)
	{
		global $cid;
		$query = mysqli_query($cid,$query);
		return mysqli_affected_rows($cid);
	}
	function select($query)
	{
		global $cid;
		$res = mysqli_query($cid,$query);
		return $res;
	}
	
?>