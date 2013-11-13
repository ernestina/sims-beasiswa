<?php

/**
 * @author aisyah
 * @copyright 2012
 * 
 * cara nggunain
 * di controller
 * 
 * public function showAll($halaman=null, $batas=null) {
        $url = 'suratmasuk/index';        
        if(is_null($halaman)) $halaman=1;
        if(is_null($batas)) $batas=10;        
        $this->view->paging = new Paging($url, $batas, $halaman);
//        $this->view->jmlData = $this->model->countRow('suratmasuk');
        $this->view->jmlData = count($this->model->showAll());
        $posisi = $this->view->paging->cari_posisi();
        $listSurat = $this->model->showAll($posisi, $batas);        
        $this->view->listSurat = $listSurat;
//        var_dump($listSurat);
        $this->view->render('suratmasuk/suratmasuk');
    }
 * 
 * di view
 * 
 * if($this->jmlData>0){
            $jmlhal = $this->paging->jml_halaman($this->jmlData);
            $paging = $this->paging->navHalaman($jmlhal);
            echo $paging;
 */
class Paging {

    var $batas;
    var $page;
    var $url;

    public function __construct($url, $batas, $page = null) {
        if (is_null($page)) {
            $this->page = 0;
        } else {
            $this->page = $page;
        }
        $this->batas = $batas;
        $this->url = $url;
    }

    public function cari_posisi() {

        $posisi = ($this->page - 1) * $this->batas;
        return $posisi;
    }

    public function jml_halaman($jml_data) {
        $jml_hal = ceil($jml_data / $this->batas);
        return $jml_hal;
    }

    function navHalaman($jmlhalaman) {
        $link_halaman = "<div class=paging>";
        $link_halaman .= "HALAMAN $this->page DARI $jmlhalaman ";
// Link ke halaman berikutnya (Next) dan terakhir (Last) 
        if ($this->page==1){
            $next = $this->page + 1;
            
            $link_halaman .= " <span style='float:right'><a href=" . URL . "$this->url/$next><button id=next class=paging value='Next >' >Next ></button></a></span> 
                             ";
//            $link_halaman .= " <span style='float:right'><button id=next class=paging value='Next >' >Next ></button></span> 
//                             ";
        }elseif($this->page < $jmlhalaman AND $this->page!=1) {
            $next = $this->page + 1;
            
            $link_halaman .= " <span style='float:right'><a href=" . URL . "$this->url/$jmlhalaman><button id=next class=paging-kecil value='Next >' >>></button></a>
                            <a href=" . URL . "$this->url/$next><button id=last class=paging-kecil value='Next >' >></button></a></span> 
                             ";
        } 
//        else {
//            $link_halaman .= " <span style='float:right'><button class=paging value='Next >' >Next ></button></span>";
//        }        
// Link ke halaman pertama (first) dan sebelumnya (prev)
        if($this->page==$jmlhalaman){
            $prev = $this->page - 1;

            $link_halaman .= "<span style='float:right'><a href=" . URL . "$this->url/$prev><button id=prev class=paging value='< Prev' >< Prev</button></a></span>";
        }elseif($this->page > 1 AND $this->page!=$jmlhalaman) {

            $prev = $this->page - 1;

            $link_halaman .= "<span style='float:right'><a href=" . URL . "$this->url/$prev><button id=prev class=paging-kecil value='< Prev' ><</button></a>
                            <a href=" . URL . "$this->url/1><button id=first class=paging-kecil value='< Prev' ><<</button></a></span>";
        } 
//        else {
//            $link_halaman .= "<span style='float:right'><button class=paging value='< Prev' >< Prev</button></span>";
//        }


        
        $link_halaman .="</div>";
        return $link_halaman;
    }

}

