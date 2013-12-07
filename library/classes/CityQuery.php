<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
require_once("shared/global_constants.php");
require_once("classes/City.php");
require_once("classes/Query.php");

/******************************************************************************
 * MemberQuery data access component for library members
 *
 * @author Ganesh Margabandhu <dave@stevens.name>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class CityQuery extends Query {
  var $_itemsPerPage = 1;
  var $_rowNmbr = 0;
  var $_currentRowNmbr = 0;
  var $_currentPageNmbr = 0;
  var $_rowCount = 0;
  var $_pageCount = 0;

  function setItemsPerPage($value) {
    $this->_itemsPerPage = $value;
  }
  function getCurrentRowNmbr() {
    return $this->_currentRowNmbr;
  }
  function getRowCount() {
    return $this->_rowCount;
  }
  function getPageCount() {
    return $this->_pageCount;
  }
  /* * Used to select the distinct locations from the database
   * *
   * */
	function getCities(){
		$sql = $this->mkSQL("select * from biblio_city where city_name IN (select distinct loc_city from biblio_location)");
		return array_map(array($this, '_mkObj'), $this->exec($sql));
	}
  
	function getCityOfLocation($chosenlocationid)
	{
		$sql = $this->mkSQL("select loc_city as city from biblio_location where locationid= %Q",$chosenlocationid);
		$result= $this->exec($sql);
		return $result[0]['city'];
	}
  function _mkObj($array) {
    $city = new City();
    $city->setCityid($array["cityid"]);
    $city->setCityName($array["city_name"]);
    $city->setLastChangeDt($array["last_change_dt"]);
    $city->setLastChangeUserid($array["last_change_userid"]);
    $city->setLatitude($array["city_latitude"]);
    $city->setLongitude($array["city_longitude"]);
    return $city;
  }
  
  /****************************************************************************
   * Inserts a new library location into the member table.
   * @param Member $mbr library member to insert
   * @return integer the id number of the newly inserted member
   * @access public
   ****************************************************************************
   */
  function insert($city) {
    $sql = $this->mkSQL("insert into biblio_city (cityid, city_name, create_dt, last_change_dt, last_change_userid, latitude, longitude) "
           . "values (null, %Q, sysdate(), sysdate(), %N, %N)", $city->getCityName(), "1", $city->getLatitude(), $city->getLongitude());

    $this->exec($sql);
    $cityid = $this->_conn->getInsertId();
    return $cityid;
    
  }

  /****************************************************************************
   * Update a library member in the member table.
   * @param Member $mbr library member to update
   * @access public
   ****************************************************************************
   */
  function update($city) {
    $sql = $this->mkSQL("update biblio_city set last_change_dt = sysdate(), last_change_userid=%N, city_name=%Q, "
	. " city_latitude=%Q, city_longitude=%Q where cityid=%N", $city->getLastChangeUserid(), $city->getCityName(),$city->getLatitude(), 		$city->getLongitude(), $city->getCityid());
    $this->exec($sql);
  }

  /****************************************************************************
   * Deletes a library location from the member table.
   * @param string $mbrid Member id of library member to delete
   * @access public
   ****************************************************************************
  */
    
  function delete($cityid) {
    $sql = $this->mkSQL("delete from biblio_city where cityid = %N ", $cityid);
    $this->exec($sql);
  }
 
}


?>
