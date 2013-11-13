<?php


class MyPaging{
	
	public $per_page = 5;
    public $cur_page;
	public $page_num;
	public $data_sel;
	public $data = array();
	
	public function __construct($cur_page, $data) {
		$this->data = $data;
		$this->page_num = ceil(count($this->data)/$this->per_page);
		
		if($cur_page > $this->page_num){
			$this->cur_page=$this->page_num;
		}
		else if($cur_page < 1 ){
			$this->cur_page = 1;
		} else {
			$this->cur_page = $cur_page;
		}
		
		$this->data_sel = count($data) - $this->per_page * ($this->page_num - 1);
		
    }
	
	public function getData(){
		if($this->data_sel>0 && $this->cur_page==$this->page_num){
			$datax = array_slice($this->data,$this->per_page * ($this->cur_page -1));
		} else {
			$datax = array_slice($this->data,$this->cur_page-1, $this->per_page);
		}
		
		return $datax;
	}
	
	public function getPerPage(){
		return $this->per_page;
	}
	
	public function getPageNum(){
		return $this->page_num;
	}
	
	public function getCurPage(){
		return $this->cur_page;
	}
}