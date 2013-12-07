<?php
	
//generates a html table from a query result

class tableUtility
{
	private $queryResult;
	private $headElements;
	private $horizontal=TRUE;
	private $emptyMsg="No data found";

	// constructor
	public function tableUtility($queryResult,$tableHeadElements)
	{
		$this->queryResult=$queryResult;
		$this->headElements=$tableHeadElements;
	}
	// sets the alignment of the table.
	/*
	public function  setHorizontalTable($isHorizontal)
	{
		$this->horizontal=$isHorizontal;
	}
	*/
	public function setHorizontalTable()
	{
		$this->horizontal=false;
	}
	// displays table
	public function generateTable()
	{
		if(!($this->isResultEmpty()))
		{
			echo "<table style='font-size:15px'; id=\"table-search\">";
			if ($this->horizontal==TRUE)
			{
	
				$this->generateHorizontalTable();
			}
			else
			{
				$this->generateVerticalTable();
			}
			echo "</table>";			
		}
		else
		{
			$this->displayEmptyMsg();
		}
		
	}
	private function generateVerticalTable()
	{
		//display the data
		$i = 1;
		while ($rows = mysql_fetch_array($this->queryResult,MYSQL_ASSOC))
		{
			// variable for coloring oddeven rows
			foreach ($rows as $keys=>$data)
			{
				echo "<tr>";				
				$j=1;
				echo "<td align=\"left\">".$this->headElements[$i-1]."</td>";
				echo "<td align=\"left\">".$data ."</td>";
				echo "</tr>";
				$i++;
			}
		}

	}
	private function generateHorizontalTable()
	{
		
		echo "<thead><tr>";
		
		foreach ($this->headElements as $element)
		{
			echo "<th>". $element . "</th>";
		}
		echo "</thead></tr>";

		//display the data
		$i = 1;
		while ($rows = mysql_fetch_array($this->queryResult,MYSQL_ASSOC))
		{
			// variable for coloring oddeven rows
			
			echo "<tr>";
			foreach ($rows as $keys=>$data){echo "<td align=\"right\">".$data ."</td>";}
			echo "</tr>";
			$i++;
		}
	}
	private function isResultEmpty()
	{
		echo $this->queryResult;
		if(mysql_num_rows($this->queryResult)>0)
			return false;
		else 
			return true;
	}
	private function displayEmptyMsg()
	{
		echo $this->emptyMsg;
	}

}
?>
