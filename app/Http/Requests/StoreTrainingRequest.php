<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama_siswa' => 'required|max:255',
            'nama_sekolah' => 'required|max:255',
            'minat' => 'required|max:255',
            'nilai_test' => 'required|max:255'

            // 'nilai_mtk1' => 'required|max:255',
            // 'nilai_mtk2' => 'required|max:255',
            // 'nilai_mtk3' => 'required|max:255',
            // 'nilai_mtk4' => 'required|max:255',
            // 'nilai_mtk5' => 'required|max:255',

            // 'nilai_ipa1' => 'required|max:255',
            // 'nilai_ipa2' => 'required|max:255',
            // 'nilai_ipa3' => 'required|max:255',
            // 'nilai_ipa4' => 'required|max:255',
            // 'nilai_ipa5' => 'required|max:255',

            // 'nilai_ips1' => 'required|max:255',
            // 'nilai_ips2' => 'required|max:255',
            // 'nilai_ips3' => 'required|max:255',
            // 'nilai_ips4' => 'required|max:255',
            // 'nilai_ips5' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'nama_siswa.required' => 'Nama Siswa Tidak Boleh Kosong.',
            'nama_sekolah.required' => 'Nama sekolah Tidak Boleh Kosong.',
            'minat.required' => 'Minat Tidak Boleh Kosong.',
            'nilai_test.required' => 'Nilai tes Tidak Boleh Kosong.'

            // 'nilai_mtk1.required' => 'Nilai Matematika Tidak Boleh Kosong.',
            // 'nilai_mtk2.required' => 'Nilai Matematika Tidak Boleh Kosong.',
            // 'nilai_mtk3.required' => 'Nilai Matematika Tidak Boleh Kosong.',
            // 'nilai_mtk4.required' => 'Nilai Matematika Tidak Boleh Kosong.',
            // 'nilai_mtk5.required' => 'Nilai Matematika Tidak Boleh Kosong.',

            // 'nilai_ipa1.required' => 'Nilai IPA Tidak Boleh Kosong.',
            // 'nilai_ipa2.required' => 'Nilai IPA Tidak Boleh Kosong.',
            // 'nilai_ipa3.required' => 'Nilai IPA Tidak Boleh Kosong.',
            // 'nilai_ipa4.required' => 'Nilai IPA Tidak Boleh Kosong.',
            // 'nilai_ipa5.required' => 'Nilai IPA Tidak Boleh Kosong.',

            // 'nilai_ips1.required' => 'Nilai IPS Tidak Boleh Kosong.',
            // 'nilai_ips2.required' => 'Nilai IPS Tidak Boleh Kosong.',
            // 'nilai_ips3.required' => 'Nilai IPS Tidak Boleh Kosong.',
            // 'nilai_ips4.required' => 'Nilai IPS Tidak Boleh Kosong.',
            // 'nilai_ips5.required' => 'Nilai IPS Tidak Boleh Kosong.'
        ];
    }
}
