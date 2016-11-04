<?php


/**
* Posts class
*/
class Posts
{
	private $_db;
	function __construct()
	{
		$this->_db = DB::getInstance();
	}

	public function getPosts($fr=0, $pp=10)
	{
		$query = "SELECT * FROM posts ORDER BY id DESC LIMIT {$fr}, {$pp}";
		return $this->_db->query($query)->results();
	}

	public function create( $fields )
	{
		if ($fields) {
			return $this->_db->insert( "posts", $fields );
		}

		return false ;
	}
}