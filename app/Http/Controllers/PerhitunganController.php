<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerhitunganController extends Controller
{
    private function format_decimal($value)
    {
        return round($value, 8);
    }

    private function proses_DT($db_object, $parent, $kasus_cabang1, $kasus_cabang2, $kasus_cabang3) 
    {
        echo "cabang 1<br>";
        $this->pembentukan_tree($db_object, $parent, $kasus_cabang1);
        echo "cabang 2<br>";
        $this->pembentukan_tree($db_object, $parent, $kasus_cabang2);
        echo "cabang 3<br>";
        $this->pembentukan_tree($db_object, $parent, $kasus_cabang3);
    }

    public function pembentukan_tree($db_object, $N_parent, $kasus)
    {
        //mengisi kondisi
        if ($N_parent != '') {
            $kondisi = $N_parent . " AND " . $kasus;
        } else {
            $kondisi = $kasus;
        }
        echo $kondisi . "<br>";
        //cek data heterogen / homogen???
        $cek = $this->cek_heterohomogen($db_object, 'hasil', $kondisi);
        if ($cek == 'homogen') {
            echo "<br>LEAF ||";
           $hasil = DB::table('tb_training2')
                    ->select('hasil')
                    ->distinct()
                    ->whereRaw(DB::raw("COALESCE('$kondisi', 0) <> 0"))
                    ->first();

            $keputusan = $hasil->hasil;
            $this->pangkas($db_object, $N_parent, $kasus, $keputusan);
        }//jika data masih heterogen
        else if ($cek == 'heterogen') {
            //jika kondisi tidak kosong kondisi_kelas_asli=tambah and
            $kondisi_kelas_asli = '';
            if ($kondisi != '') {
                $kondisi_kelas_asli = $kondisi . " AND ";
            }
            $jml_ipa = $this->jumlah_data($db_object, "$kondisi_kelas_asli hasil='IPA'");
            $jml_ips = $this->jumlah_data($db_object, "$kondisi_kelas_asli hasil='IPS'");
            
            $jml_total = $jml_ipa + $jml_ips;
            echo "Jumlah Data = " . $jml_total . "<br>";
            echo "Jumlah IPA = " . $jml_ipa . "<br>";
            echo "Jumlah IPS = " . $jml_ips . "<br>";

            //hitung entropy semua
            $entropy_all = $this->hitung_entropy($jml_ipa, $jml_ips);
            echo "Entropy All = " . $entropy_all . "<br>";

            echo "<table class='table table-bordered table-striped  table-hover'>";
            echo "<tr><th>Nilai Atribut</th> <th>Jumlah Data</th> <th>Jumlah IPA</th> <th>Jumlah IPS</th> "
            . "<th>Entropy</th> <th>Gain</th><tr>";

            DB::table('gain')->truncate();
            //hitung gain atribut KATEGORIKAL
            $this->hitung_gain($db_object, $kondisi, "Minat", $entropy_all, "minat='IPA'", "minat='IPS'", "", "", "");

            //Nilai Matematika
            $this->hitung_gain($db_object, $kondisi, "Nilai Matematika", $entropy_all, "mtk_grade='A'", "mtk_grade='B'", "mtk_grade='C'", "", "");
            
            //Nilai IPA
            $this->hitung_gain($db_object, $kondisi, "Nilai IPA", $entropy_all, "ipa_grade='A'", "ipa_grade='B'", "ipa_grade='C'", "", "");

            //Nilai IPS
            $this->hitung_gain($db_object, $kondisi, "Nilai IPS", $entropy_all, "ips_grade='A'", "ips_grade='B'", "ips_grade='C'", "", "");

            //Nilai Tes
            $this->hitung_gain($db_object, $kondisi, "Nilai Tes", $entropy_all, "nilai_tes='A'", "nilai_tes='B'", "nilai_tes='C'", "", "");
            

            echo "</table>";
            //ambil nilai gain terbesar
            $max_gain = DB::table('gain')->max('gain');
            $row = DB::table('gain')->where('gain', $max_gain)->first();
            if ($row !== null) {
            $atribut = $row->atribut;
            echo "Atribut terpilih = " . $atribut . ", dengan nilai gain = " . $max_gain . "<br>";
            } else {
            echo "Tidak dapat menemukan baris dengan nilai gain terbesar";
            }
            echo "<br>================================<br>";

            //jika max gain = 0 perhitungan dihentikan dan mengambil keputusan
            if ($max_gain == 0) {
                echo "<br>LEAF ";
                $NIPA = $kondisi . " AND hasil='IPA'";
                $NIPS = $kondisi . " AND hasil='IPS'";

                $jumlahIPA = $this->jumlah_data($db_object, "$NIPA");
                $jumlahIPS = $this->jumlah_data($db_object, "$NIPS");

                if($jumlahIPA >= $jumlahIPS) {
                    $keputusan = 'IPA';
                }
                else {
                    $keputusan = 'IPS';
                }
                //insert atau lakukan pemangkasan cabang
                $this->pangkas($db_object, $N_parent, $kasus, $keputusan);
            }
            //jika max_gain >0 lanjut..
            else {
                
                //Atribut Minat terpilih
                if ($atribut == "Minat") {
                    $this->proses_DT($db_object, $kondisi, "(minat='IPA')", "(minat='IPS')", "");
                }

                //Nilai Matematika Terpilih
                if ($atribut == "Nilai Matematika") {
                    $this->proses_DT($db_object, $kondisi, "(mtk_grade='A')", "(mtk_grade='B')", "(mtk_grade='C')");
                }

                //Nilai IPA Terpilih
                if ($atribut == "Nilai IPA") {
                    $this->proses_DT($db_object, $kondisi, "(ipa_grade='A')", "(ipa_grade='B')", "(ipa_grade='C')");
                }
                //Nilai IPS Terpilih
                if ($atribut == "Nilai IPS") {
                    $this->proses_DT($db_object, $kondisi, "(ips_grade='A')", "(ips_grade='B')", "(ips_grade='C')");
                }
                //Nilai Tes Terpilih
                if ($atribut == "Nilai Tes") {
                    $this->proses_DT($db_object, $kondisi, "(nilai_tes='A')", "(nilai_tes='B')", "(nilai_tes='C')");
                }

                
            }//end else jika max_gain>0
            // }// end jumlah<3
        }//end else if($cek=='heterogen'){
    }

    private function cek_nilaiAtribut($db_object, $field , $kondisi)
    {
        $hasil = array();
        if($kondisi==''){
            $sql = DB::table('tb_training2')->select(DB::raw("DISTINCT($field)"))->get();
        }else{
            $sql = DB::table('tb_training2')->select(DB::raw("DISTINCT($field)"))->whereRaw($kondisi)->get();
        }
        $a=0;
        foreach($sql as $row){
            $hasil[$a] = $row->{$field};
            $a++;
        }   
        return $hasil;
    }

    private function cek_heterohomogen($db_object, $field, $kondisi) 
    {
        //sql disticnt
        if ($kondisi == '') {
            $sql = DB::select("SELECT DISTINCT($field) FROM tb_training2");
        } else {
            $sql = DB::select("SELECT DISTINCT($field) FROM tb_training2 WHERE $kondisi");
        }
        //jika jumlah data 1 maka homogen
        if (count($sql) == 1) {
            $nilai = "homogen";
        } else {
            $nilai = "heterogen";
        }
        return $nilai;
    }

    private function jumlah_data($db_object, $kondisi) 
    {
        //sql
        if ($kondisi == '') {
            $sql = "SELECT COUNT(*) FROM tb_training2 $kondisi";
        } else {
            $sql = "SELECT COUNT(*) FROM tb_training2 WHERE $kondisi";
        }

        $query = DB::select($sql);
        $row = $query[0];
        $jml = $row->{'COUNT(*)'};
        return $jml;
    }

    private function pangkas($db_object, $PARENT, $KASUS, $LEAF) 
    {
        DB::table('t_keputusan')->insert([
            'parent' => $PARENT,
            'akar' => $KASUS,
            'keputusan' => $LEAF
        ]);

        echo "Keputusan = " . $LEAF . "<br>================================<br>";
    }

    private function hitung_gain($db_object, $kasus, $atribut, $ent_all, $kondisi1, $kondisi2, $kondisi3, $kondisi4) 
    {
        $data_kasus = '';
        if ($kasus != '') {
            $data_kasus = $kasus . " AND ";
        }

        //untuk atribut 2 nilai atribut	
        if ($kondisi3 == '') {
            $j_sanguin1 = $this->jumlah_data($db_object, "$data_kasus hasil='IPA' AND $kondisi1");
            $j_koleris1 = $this->jumlah_data($db_object, "$data_kasus hasil='IPS' AND $kondisi1");

            $jml1 = $j_sanguin1 + $j_koleris1;
            
            $j_sanguin2 = $this->jumlah_data($db_object, "$data_kasus hasil='IPA' AND $kondisi2");
            $j_koleris2 = $this->jumlah_data($db_object, "$data_kasus hasil='IPS' AND $kondisi2");
            
            $jml2 = $j_sanguin2 + $j_koleris2;
            //hitung entropy masing-masing kondisi
            $jml_total = $jml1 + $jml2;
            $ent1 = $this->hitung_entropy($j_sanguin1, $j_koleris1);
            $ent2 = $this->hitung_entropy($j_sanguin2, $j_koleris2);
            $gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2));
            //desimal 3 angka dibelakang koma
            $gain = $this->format_decimal($gain);
            echo "<tr>";
            echo "<td>" . $kondisi1 . "</td>";
            echo "<td>" . $jml1 . "</td>";
            echo "<td>" . $j_sanguin1 . "</td>";
            echo "<td>" . $j_koleris1 . "</td>";
            echo "<td>" . $ent1 . "</td>";
            echo "<td>&nbsp;</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>" . $kondisi2 . "</td>";
            echo "<td>" . $jml2 . "</td>";
            echo "<td>" . $j_sanguin2 . "</td>";
            echo "<td>" . $j_koleris2 . "</td>";
            echo "<td>" . $ent2 . "</td>";
            echo "<td>" . $gain . "</td>";
            echo "</tr>";

            echo "<tr><td colspan='8'></td></tr>";
        }
        //untuk atribut 3 nilai atribut
        else if($kondisi4==''){
            $j_sanguin1 = $this->jumlah_data($db_object, "$data_kasus hasil='IPA' AND $kondisi1");
            $j_koleris1 = $this->jumlah_data($db_object, "$data_kasus hasil='IPS' AND $kondisi1");

            $jml1 = $j_sanguin1 + $j_koleris1;
            
            $j_sanguin2 = $this->jumlah_data($db_object, "$data_kasus hasil='IPA' AND $kondisi2");
            $j_koleris2 = $this->jumlah_data($db_object, "$data_kasus hasil='IPS' AND $kondisi2");

            $jml2 = $j_sanguin2 + $j_koleris2;
            
            $j_sanguin3 = $this->jumlah_data($db_object, "$data_kasus hasil='IPA' AND $kondisi3");
            $j_koleris3 = $this->jumlah_data($db_object, "$data_kasus hasil='IPS' AND $kondisi3");

            $jml3 = $j_sanguin3 + $j_koleris3;
            
            //hitung entropy masing-masing kondisi
            $jml_total = $jml1 + $jml2 + $jml3;
            $ent1 = $this->hitung_entropy($j_sanguin1 , $j_koleris1);
            $ent2 = $this->hitung_entropy($j_sanguin2 , $j_koleris2);
            $ent3 = $this->hitung_entropy($j_sanguin3 , $j_koleris3);
            $gain = $ent_all - ((($jml1/$jml_total)*$ent1) + (($jml2/$jml_total)*$ent2) 
                        + (($jml3/$jml_total)*$ent3));		
    
            //desimal 3 angka dibelakang koma
            $gain = $this->format_decimal($gain);	
            echo "<tr>";
            echo "<td>".$kondisi1."</td>";
            echo "<td>".$jml1."</td>";
            echo "<td>".$j_sanguin1."</td>";
            echo "<td>".$j_koleris1."</td>";
            echo "<td>".$ent1."</td>";
            echo "<td>&nbsp;</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>".$kondisi2."</td>";
            echo "<td>".$jml2."</td>";
            echo "<td>".$j_sanguin2."</td>";
            echo "<td>".$j_koleris2."</td>";
            echo "<td>".$ent2."</td>";
            echo "<td>&nbsp;</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>".$kondisi3."</td>";
            echo "<td>".$jml3."</td>";
            echo "<td>".$j_sanguin3."</td>";
            echo "<td>".$j_koleris3."</td>";
            echo "<td>".$ent3."</td>";
            echo "<td>".$gain."</td>";
            echo "</tr>";
            echo "<tr><td colspan='8'></td></tr>";
        }
        
        DB::table('gain')->insert([
            'node_id' => '1',
            'atribut' => $atribut,
            'gain' => $gain
        ]);
    }

    private function hitung_entropy($nilai1, $nilai2) 
    {
        $total = $nilai1 + $nilai2;

        $atribut1 = (-($nilai1 / $total) * (log(($nilai1 / $total), 2)));
        $atribut2 = (-($nilai2 / $total) * (log(($nilai2 / $total), 2)));

        $atribut1 = is_nan($atribut1) ? 0 : $atribut1;
        $atribut2 = is_nan($atribut2) ? 0 : $atribut2;

        $entropy = $atribut1 + $atribut2;

        // Round the result to 3 decimal places
        $entropy = round($entropy, 8);

        return $entropy;
    }


    public function index()
    {
        $jumlahData = DB::table('tb_training')->count();
        $jumlahIPA = DB::table('tb_training')
            ->where('hasil', '<>', 'IPA')
            ->count();

        $jumlahIPS = DB::table('tb_training')
            ->where('hasil', '<>', 'IPS')
            ->count();

        $entropyAll = (-$jumlahIPA / $jumlahData) * log($jumlahIPA / $jumlahData, 2) + (-$jumlahIPS / $jumlahData) * log($jumlahIPS / $jumlahData, 2);

        DB::table('t_keputusan')->truncate();
        $db_object = new \stdClass();
        $this->pembentukan_tree($db_object, "", "");

        return view('perhitungan', [
            'title' => 'Perhitungan',
            'jumlahData' => $jumlahData,
            'jumlahIPA' => $jumlahIPA,
            'jumlahIPS' => $jumlahIPS,
            'entropyAll' => $entropyAll
        ]);
    }

    public function pohon() 
    {
        return view('pohon', [
            'title' => 'Pohon Keputusan'
        ]);
    }
   
    public function mining() 
    {
        // Jumlah Data Training
        $jumlahData = DB::table('tb_training2')->count();
        $dataLatih = DB::table('tb_training2')->get();

        return view('mining', [
            'title' => 'Mining C.45',
            'jumlahData' => $jumlahData,
            'dataLatih' => $dataLatih
        ]);
    }
    
    public function uji() 
    {

        return view('uji', [
            'title' => 'Uji Pohon Keputusan'
        ]);
    }

}