<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to 'column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = 'main';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function TanggalToIndo($date) {
        $result = null;
        if (($date != '0000-00-00')||($date != NULL)||($date != " ")||($date != "")) {
            $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

            $tahun = substr($date, 0, 4);
            $bulan = substr($date, 5, 2);
            $tgl = substr($date, 8, 2);
          
            $result = $tgl." ".$BulanIndo[(int) $bulan - 1]." ".$tahun;
            //$result = $date;
        } else {
            $result = "";
        }
        return($result);
    }

    public function idr($angka) {
        $result = "Rp " . number_format($angka, 2, ',', '.');
        return $result;
    }

    public function tglDefault() {
        date_default_timezone_get('Asia/Jakarta');
        $tanggal_now = date('Y-m-d');
        $tambah_tanggal = mktime(0, 0, 0, 1, 1, date('Y') - 27);
        $result = date('Y-m-d', $tambah_tanggal);

        return $result;
    }
    
    public function expired($mulai, $akhir) {
        $tgl_mulai = strtotime($mulai);
        $tgl_selesai = strtotime($akhir);
        $sekarang = strtotime(date('Y-m-d'));
        
        if($sekarang < $tgl_mulai)
        {$result = "<b>Tidak Valid</b>";}
            elseif(($sekarang >= $tgl_mulai)&&($sekarang <= $tgl_selesai))
            {$result = "<b>Mou Masih Berlaku</b>";}
                elseif ($sekarang > $tgl_selesai) 
                {$result = "<b>Mou Expired</b>";}

        return $result;
    }

}
