<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerhitunganController extends Controller
{

    function format_decimal($value)
    {
        return round($value, 8);

           $mtk_rata = 84;
        if($mtk_rata < 75){
           echo $mtk_rata = 'C';
        } else if ($mtk_rata < 85){
            echo $mtk_rata = 'B';
        } else {
            echo $mtk_rata = 'A';
        }
    }

        //fungsi hitung rasio
    function hitung_rasio($kasus, $atribut, $gain, $nilai1, $nilai2, $nilai3, $nilai4, $nilai5)
    {
        $data_kasus = '';
        if ($kasus != '') {
            $data_kasus = $kasus . " AND ";
        }
        //menentukan jumlah nilai
        $jmlNilai = 5;
        //jika nilai 5 kosong maka nilai atribut-nya 4
        if ($nilai5 == '') {
            $jmlNilai = 4;
        }
        //jika nilai 4 kosong maka nilai atribut-nya 3
        if ($nilai4 == '') {
            $jmlNilai = 3;
        }
        DB::table('rasio_gain')->truncate();
        if ($jmlNilai == 3) {
            $opsi11 = $this->jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3')");
            $opsi12 = $this->jumlah_data("$data_kasus $atribut='$nilai1'");
            $tot_opsi1 = $opsi11 + $opsi12;
            $opsi21 = $this->jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai1')");
            $opsi22 = $this->jumlah_data("$data_kasus $atribut='$nilai2'");
            $tot_opsi2 = $opsi21 + $opsi22;
            $opsi31 = $this->jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2')");
            $opsi32 = $this->jumlah_data("$data_kasus $atribut='$nilai3'");
            $tot_opsi3 = $opsi31 + $opsi32;
            //hitung split info
            $opsi1 = (- ($opsi11 / $tot_opsi1) * (log(($opsi11 / $tot_opsi1), 2))) + (- ($opsi12 / $tot_opsi1) * (log(($opsi12 / $tot_opsi1), 2)));
            $opsi2 = (- ($opsi21 / $tot_opsi2) * (log(($opsi21 / $tot_opsi2), 2))) + (- ($opsi22 / $tot_opsi2) * (log(($opsi22 / $tot_opsi2), 2)));
            $opsi3 = (- ($opsi31 / $tot_opsi3) * (log(($opsi31 / $tot_opsi3), 2))) + (- ($opsi32 / $tot_opsi3) * (log(($opsi32 / $tot_opsi3), 2)));
            //desimal 3 angka dibelakang koma
            $opsi1 = $this->format_decimal($opsi1);
            $opsi2 = $this->format_decimal($opsi2);
            $opsi3 = $this->format_decimal($opsi3);
            //hitung rasio
            $rasio1 = $gain / $opsi1;
            $rasio2 = $gain / $opsi2;
            $rasio3 = $gain / $opsi3;
            //desimal 3 angka dibelakang koma
            $rasio1 = $this->format_decimal($rasio1);
            $rasio2 = $this->format_decimal($rasio2);
            $rasio3 = $this->format_decimal($rasio3);
            //cetak
            echo "Opsi 1 : <br>jumlah " . $nilai2 . "/" . $nilai3 . " = " . $opsi11 .
                "<br>jumlah " . $nilai1 . " = " . $opsi12 .
                "<br>Split = " . $opsi1 .
                "<br>Rasio = " . $rasio1 . "<br>";
            echo "Opsi 2 : <br>jumlah " . $nilai3 . "/" . $nilai1 . " = " . $opsi21 .
                "<br>jumlah " . $nilai2 . " = " . $opsi22 .
                "<br>Split = " . $opsi2 .
                "<br>Rasio = " . $rasio2 . "<br>";
            echo "Opsi 3 : <br>jumlah " . $nilai1 . "/" . $nilai2 . " = " . $opsi31 .
                "<br>jumlah " . $nilai3 . " = " . $opsi32 .
                "<br>Split = " . $opsi3 .
                "<br>Rasio = " . $rasio3 . "<br>";

            //insert 
           DB::table('rasio_gain')->insert([
                [
                    'id' => 'opsi1',
                    'opsi' => $nilai1,
                    'cabang1' => $nilai2,
                    'cabang2' => $nilai3,
                    'rasio_gain' => $rasio1
                ],
                [
                    'id' => 'opsi2',
                    'opsi' => $nilai2,
                    'cabang1' => $nilai3,
                    'cabang2' => $nilai1,
                    'rasio_gain' => $rasio2
                ],
                [
                    'id' => 'opsi3',
                    'opsi' => $nilai3,
                    'cabang1' => $nilai1,
                    'cabang2' => $nilai2,
                    'rasio_gain' => $rasio3
                ]
            ]);
        }

        $max_rasio = DB::table('rasio_gain')->max('rasio_gain');
        $row = DB::table('rasio_gain')->where('rasio_gain', $max_rasio)->first();
        $opsiMax = array();
        $opsiMax[0] = $row->opsi1;
        $opsiMax[1] = $row->opsi2;
        echo "<br>=========================<br>";
        return $opsiMax;
    }

        //fungsi utama
    function proses_DT($parent, $kasus_cabang1, $kasus_cabang2, $kasus_cabang3)
    {
        echo "cabang 1<br>";
        $this->pembentukan_tree($parent, $kasus_cabang1);
        echo "cabang 2<br>";
        $this->pembentukan_tree($parent, $kasus_cabang2);
        echo "cabang 3<br>";
        $this->pembentukan_tree($parent, $kasus_cabang3);
    }

    
    //fungsi proses dalam suatu kasus data
    function pembentukan_tree($N_parent, $kasus)
    {
        //mengisi kondisi
        if ($N_parent != '') {
            $kondisi = $N_parent . " AND " . $kasus;
        } else {
            $kondisi = $kasus;
        }
        echo $kondisi . "<br>";
        //cek data heterogen / homogen???
        $cek = $this->cek_heterohomogen('hasil', $kondisi);
        if ($cek == 'homogen') {
            echo "<br>LEAF ||";
            $keputusan = DB::table('tb_training2')
                            ->select(DB::raw('DISTINCT(hasil)'))
                            ->whereRaw($kondisi)
                            ->pluck('hasil')
                            ->first();
            //insert atau lakukan pemangkasan cabang
            pangkas($N_parent, $kasus, $keputusan);
        } //jika data masih heterogen
        else if ($cek == 'heterogen') {
            //jika kondisi tidak kosong kondisi_kelas_asli=tambah and
            $kondisi_kelas_asli = '';
            if ($kondisi != '') {
                $kondisi_kelas_asli = $kondisi . " AND ";
            }
            $jml_ipa = $this->jumlah_data("$kondisi_kelas_asli hasil='IPA'");
            $jml_ips = $this->jumlah_data("$kondisi_kelas_asli hasil='IPS'");

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
            $this->hitung_gain($kondisi, "minat", $entropy_all, "minat='IPA'", "minat='IPS'", "", "", "");

            //Nilai Matematika
            $this->hitung_gain($kondisi, "Nilai Matematika", $entropy_all, "mtk_grade='A'", "mtk_grade='B'", "mtk_grade='C'", "", "");

            //Nilai IPA
            $this->hitung_gain($kondisi, "Nilai IPA", $entropy_all, "ipa_grade='A'", "ipa_grade='B'", "ipa_grade='C'", "", "");

            //Nilai IPS
            $this->hitung_gain($kondisi, "Nilai IPS", $entropy_all, "ips_grade='A'", "ips_grade='B'", "ips_grade='C'", "", "");

            //Nilai Tes
            $this->hitung_gain($kondisi, "Nilai Tes", $entropy_all, "nilai_tes='A'", "nilai_tes='B'", "nilai_tes='C'", "", "");


            echo "</table>";
            //ambil nilai gain terBesar
            $max_gain = DB::table('gain')->max('gain');
            $row = DB::table('gain')->where('gain', $max_gain)->first();
            $atribut = $row->atribut;
            echo "Atribut terpilih = " . $atribut . ", dengan nilai gain = " . $max_gain . "<br>";
            echo "<br>================================<br>";


            //jika max gain = 0 perhitungan dihentikan dan mengambil keputusan
            if ($max_gain == 0) {
                echo "<br>LEAF ";
                $NIPA = $kondisi . " AND hasil='IPA'";
                $NIPS = $kondisi . " AND hasil='IPS'";

                $jumlahIPA = $this->jumlah_data("$NIPA");
                $jumlahIPS = $this->jumlah_data("$NIPS");

                if ($jumlahIPA >= $jumlahIPS) {
                    $keputusan = 'IPA';
                } else {
                    $keputusan = 'IPS';
                }
                //insert atau lakukan pemangkasan cabang
                pangkas($N_parent, $kasus, $keputusan);
            }
            //jika max_gain >0 lanjut..
            else {

                //Atribut Minat terpilih
                if ($atribut == "minat") {
                    $this->proses_DT($kondisi, "($atribut='IPA')", "($atribut='IPS')");
                }

                //Nilai Matematika Terpilih
                if ($atribut == "Nilai Matematika") {
                    $this->proses_DT($kondisi, "(mtk_grade='A')", "(mtk_grade='B')", "(mtk_grade='C')");
                }

                //Nilai IPA Terpilih
                if ($atribut == "Nilai IPA") {
                    $this->proses_DT($kondisi, "(ipa_grade='A')", "(ipa_grade='B')", "(ipa_grade='C')");
                }
                //Nilai IPS Terpilih
                if ($atribut == "Nilai IPS") {
                    $this->proses_DT($kondisi, "(ips_grade='A')", "(ips_grade='B')", "(ips_grade='C')");
                }
                //Nilai Tes Terpilih
                if ($atribut == "Nilai Tes") {
                    $this->proses_DT($kondisi, "(nilai_tes='A')", "(nilai_tes='B')", "(nilai_tes='C')");
                }
            } //end else jika max_gain>0
            // }// end jumlah<3
        } //end else if($cek=='heterogen'){
    }

    //fungsi cek nilai atribut
    function cek_nilaiAtribut($field, $kondisi)
    {
        //sql disticnt		
        $hasil = array();
        if ($kondisi == '') {
            $sql = DB::table('tb_training2')->distinct($field)->get();
        } else {
            $sql = DB::table('tb_training2')->distinct($field)->where($kondisi)->get();
        }
        $a = 0;
        foreach($sql as $row){
            $hasil[$a] = $row['0'];
            $a++;
        }
        return $hasil;
    }

    //fungsi cek heterogen data
    function cek_heterohomogen($field, $kondisi)
    {
        //sql disticnt
        if ($kondisi == '') {
            $sql = DB::table('tb_training2')->select(DB::raw("DISTINCT($field)"))->get();
        } else {
            $sql = DB::table('tb_training2')->select(DB::raw("DISTINCT($field)"))->whereRaw($kondisi)->get();
        }
        //jika jumlah data 1 maka homogen
        if ($sql->count() == 1) {
            $nilai = "homogen";
        } else {
            $nilai = "heterogen";
        }
        return $nilai;
    }

    //fungsi menghitung jumlah data
    function jumlah_data($kondisi)
    {
        if ($kondisi == '') {
            $count = DB::table('tb_training2')->count();
        } else {
            $count = DB::table('tb_training2')->whereRaw($kondisi)->count();
        }
        return $count;
    }

    //fungsi pemangkasan cabang
    function pangkas($PARENT, $KASUS, $LEAF)
    {
        DB::table('t_keputusan')->insert([
            'parent' => $PARENT,
            'akar' => $KASUS,
            'keputusan' => $LEAF
        ]);
        echo "Keputusan = " . $LEAF . "<br>================================<br>";
    }

    //fungsi menghitung gain
    function hitung_gain($kasus, $atribut, $ent_all, $kondisi1, $kondisi2, $kondisi3, $kondisi4)
    {
        $data_kasus = '';
        if ($kasus != '') {
            $data_kasus = $kasus . " AND ";
        }

        //untuk atribut 2 nilai atribut	
        if ($kondisi3 == '') {
            $j_sanguin1 = $this->jumlah_data("$data_kasus hasil='IPA' AND $kondisi1");
            $j_koleris1 = $this->jumlah_data("$data_kasus hasil='IPS' AND $kondisi1");

            $jml1 = $j_sanguin1 + $j_koleris1;

            $j_sanguin2 = $this->jumlah_data("$data_kasus hasil='IPA' AND $kondisi2");
            $j_koleris2 = $this->jumlah_data("$data_kasus hasil='IPS' AND $kondisi2");

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
        else if ($kondisi4 == '') {
            $j_sanguin1 = $this->jumlah_data("$data_kasus hasil='IPA' AND $kondisi1");
            $j_koleris1 = $this->jumlah_data("$data_kasus hasil='IPS' AND $kondisi1");

            $jml1 = $j_sanguin1 + $j_koleris1;

            $j_sanguin2 = $this->jumlah_data("$data_kasus hasil='IPA' AND $kondisi2");
            $j_koleris2 = $this->jumlah_data("$data_kasus hasil='IPS' AND $kondisi2");

            $jml2 = $j_sanguin2 + $j_koleris2;

            $j_sanguin3 = $this->jumlah_data("$data_kasus hasil='IPA' AND $kondisi3");
            $j_koleris3 = $this->jumlah_data("$data_kasus hasil='IPS' AND $kondisi3");

            $jml3 = $j_sanguin3 + $j_koleris3;

            //hitung entropy masing-masing kondisi
            $jml_total = $jml1 + $jml2 + $jml3;
            $ent1 = $this->hitung_entropy($j_sanguin1, $j_koleris1);
            $ent2 = $this->hitung_entropy($j_sanguin2, $j_koleris2);
            $ent3 = $this->hitung_entropy($j_sanguin3, $j_koleris3);
            $gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2)
                + (($jml3 / $jml_total) * $ent3));
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
            echo "<td>&nbsp;</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>" . $kondisi3 . "</td>";
            echo "<td>" . $jml3 . "</td>";
            echo "<td>" . $j_sanguin3 . "</td>";
            echo "<td>" . $j_koleris3 . "</td>";
            echo "<td>" . $ent3 . "</td>";
            echo "<td>" . $gain . "</td>";
            echo "</tr>";
            echo "<tr><td colspan='8'></td></tr>";
        }

        DB::table('gain')->insert([
            'node_id' => '1',
            'atribut' => $atribut,
            'gain' => $gain,
        ]);
    }

    //fungsi menghitung entropy
    function hitung_entropy($nilai1, $nilai2)
    {
        $total = $nilai1 + $nilai2;

        if ($total == 0) { // penanganan khusus saat total = 0
            return 0;
        }

        $atribut1 = (- ($nilai1 / $total) * (log(($nilai1 / $total), 2)));
        $atribut2 = (- ($nilai2 / $total) * (log(($nilai2 / $total), 2)));

        $atribut1 = is_nan($atribut1) ? 0 : $atribut1;
        $atribut2 = is_nan($atribut2) ? 0 : $atribut2;

        $entropy = $atribut1 + $atribut2;

        $entropy = $this->format_decimal($entropy);

        return $entropy;
    }

    public function index()
    {
       
        DB::table('t_keputusan')->truncate();
        $this->pembentukan_tree("","");
        
        $jumlahData = DB::table('tb_training')->count();
        $jumlahIPA = DB::table('tb_training')
            ->where('hasil', '<>', 'IPA')
            ->count();

        $jumlahIPS = DB::table('tb_training')
            ->where('hasil', '<>', 'IPS')
            ->count();

        $entropyAll = (-$jumlahIPA / $jumlahData) * log($jumlahIPA / $jumlahData, 2) + (-$jumlahIPS / $jumlahData) * log($jumlahIPS / $jumlahData, 2);

        return view('perhitungan', [
            'title' => 'Perhitungan',
            'jumlahData' => $jumlahData,
            'jumlahIPA' => $jumlahIPA,
            'jumlahIPS' => $jumlahIPS,
            'entropyAll' => $entropyAll
        ]);
    }

    public function mining()
    {
        $jumlahData = DB::table('tb_latih')->count();
        $dataLatih = DB::table('tb_latih')->get();

        return view('mining', [
            'title' => 'Proses Mining',
            'jumlahData' => $jumlahData,
            'dataLatih' => $dataLatih,
        ]);
    }

    public function pohon()
    {
        $jumlahDataRule = DB::table('t_keputusan')->count();
        $dataRule = DB::table('t_keputusan')->get();
        return view('pohon', [
            'title' => 'Pohon Keputusan',
            'jumlahDataRule' => $jumlahDataRule,
            'dataRule' => $dataRule,
        ]);
    }
}