<?php

class task3
{
	private $val1;
	private $val2;
	private $val3;
	private $var;
	

	function __construct($val1,$val2,$val3,$var){
		$this->val1 = $val1;
		$this->val2 = $val2;
		$this->val3 = $val3;
		$this->var = $var;				
		return $this;
	} 

	public function getTask3Data($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function setTask3Data($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }

}
?>