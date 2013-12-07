<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
*/

require_once("functions/formatFuncs.php");

/****************************************************************************
 * Location represents a library location.  Contains business rules for
* location data validation.
*
* @author Ganesh Margabandhu <dave@stevens.name>;
* @version 1.0
* @access public
******************************************************************************
*/
class City {
	var $_cityid = 0;
	var $_cityname = 0;
	var $_addr1Error = 0;
	var $_createDt = "";
	var $_lastChangeDt = "";
	var $_lastChangeUserid = "";
	var $_latitude="";
	var $_longitude="";

	/****************************************************************************
	 * @return boolean true if data is valid, otherwise false.
	* @access public
	****************************************************************************
	*/
	function validateData() {
		$valid = true;
		if ($this->_city_name== "") {
			$valid = false;
			$this->_addr1Error  = "City name is required.";
		}
		return $valid;
	}


	/****************************************************************************
	 * Getter methods for all fields
	* @return string
	* @access public
	****************************************************************************
	*/
	function getCityid() {
		return $this->_cityid;
	}
	function getCityName() {
		return $this->_cityname;
	}
	function getCreateDt() {
		return $this->_createDt;
	}
	function getLastChangeDt() {
		return $this->_lastChangeDt;
	}
	function getLastChangeUserid() {
		return $this->_lastChangeUserid;
	}
	function getLatitude(){
		return $this->_latitude;
	}
	function getLongitude()
	{
		return $this->_longitude;
	}


	/****************************************************************************
	 * Setter methods for all fields
	* @param string $value new value to set
	* @return void
	* @access public
	****************************************************************************
	*/
	function setCityid($value) {
		$this->_cityid = trim($value);
	}
	function setCityName($value) {
		$this->_cityname = trim($value);
	}
	function setCreateDt($value) {
		$this->_createDt = trim($value);
	}
	function setLastChangeDt($value) {
		$this->_lastChangeDt = trim($value);
	}
	function setLastChangeUserid($value) {
		$this->_lastChangeUserid = trim($value);
	}
	function setLatitude($value){
		$this->_latitude = trim($value);
	}
	function setLongitude($value){
		$this->_longitude = trim($value);
	}

}

?>
