<?php
/**
 * TOP API: taobao.crm.grade.get request
 * 
 * @author auto create
 * @since 1.0, 2013-11-04 12:54:06
 */
class CrmGradeGetRequest
{
	
	private $apiParas = array();
	
	public function getApiMethodName()
	{
		return "taobao.crm.grade.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
