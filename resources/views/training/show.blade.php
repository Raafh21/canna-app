@extends('layout.main')

@section('container')

<br>
<br>
<br>
Nama Siswa   :  {{$training->nama_siswa}}
<br>
<br>
Nama Sekolah :  {{$training->nama_sekolah}}
<table class="mt-4 table table-bordered text-nowrap text-center">
    <thead>
        <tr>
            <th colspan="24">Nilai Rata-rata Raport</th>
        </tr>
        <tr>
            <th colspan="5">Matematika</th>
            <th rowspan="2">Rata-rata</th>
            <th rowspan="2">Grade</th>
            <th colspan="5">IPA</th>
            <th rowspan="2">Rata-rata</th>
            <th rowspan="2">Grade</th>
            <th colspan="5">IPS</th>
            <th rowspan="2">Rata-rata</th>
            <th rowspan="2">Grade</th>
        </tr>
        <tr>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
        </tr>
    </thead>
    <tr>
        <td>{{$training->mtk_1}}</td>
        <td>{{$training->mtk_2}}</td>
        <td>{{$training->mtk_3}}</td>
        <td>{{$training->mtk_4}}</td>
        <td>{{$training->mtk_5}}</td>
        <td>{{$training->mtk_rata}}</td>
        <td>{{$training->mtk_grade}}</td>
        <td>{{$training->ipa_1}}</td>
        <td>{{$training->ipa_2}}</td>
        <td>{{$training->ipa_3}}</td>
        <td>{{$training->ipa_4}}</td>
        <td>{{$training->ipa_5}}</td>
        <td>{{$training->ipa_rata}}</td>
        <td>{{$training->ipa_grade}}</td>
        <td>{{$training->ips_1}}</td>
        <td>{{$training->ips_2}}</td>
        <td>{{$training->ips_3}}</td>
        <td>{{$training->ips_4}}</td>
        <td>{{$training->ips_5}}</td>
        <td>{{$training->ips_rata}}</td>
        <td>{{$training->ips_grade}}</td>
    </tr>
</table>

@endsection