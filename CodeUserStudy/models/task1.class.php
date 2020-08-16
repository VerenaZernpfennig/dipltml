<?php

class task1
{
	private $val1;
	private $val2;
	private $val3;
	private $val4;
	private $val5;
	private $val6;

	function __construct($val1,$val2,$val3,$val4,$val5,$val6){
		$this->val1 = $val1;
		$this->val2 = $val2;
		$this->val3 = $val3;
		$this->val4 = $val4;
		$this->val5 = $val5;
		$this->val6 = $val6;		
		return $this;
	} 

	public function getTask1Data($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function setTask1Data($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }

}
?>
