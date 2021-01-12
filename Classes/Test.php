<?php

Class Test
{
	public $name = 'mouad';
	public $ram = '2GB';
	
	public function pressPower()
	{
		echo 'aaaaaaaaaa <br>';
		return $this;
	}
	
	public function bootPhone()
	{
		echo 'bbbbbbbbbb <br>';
		return $this;  // for enable chaining
	}

	public function sayWelcome()
	{
		echo 'ccccccccccc <br>';
		return $this;   // important writing "return $this" for functions chaining
	}

	
}




