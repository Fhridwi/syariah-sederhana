<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSantriRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan untuk melakukan request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi untuk permintaan penyimpanan data santri.
     */
    public function rules(): array
    {
        return [
            'nis' => 'required|numeric|unique:santris,nis',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'angkatan' => 'required|string|max:20',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:500',
            'program' => 'nullable|string|max:100',
            'sekolah_formal' => 'nullable|string|max:100',
            'madrasah_diniyah' => 'nullable|string|max:100',
            'telepon_orang_tua' => 'nullable|string|regex:/^[0-9\s\-\+\(\)]*$/|max:20',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10000',
            'status_santri' => 'required|in:aktif,alumni',
        ];
    }

    /**
     * Pesan error kustom untuk validasi.
     */
    public function messages(): array
    {
        return [
            'nis.required' => 'NIS wajib diisi.',
            'nis.numeric' => 'NIS harus berupa angka.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'nama.required' => 'Nama lengkap wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'angkatan.required' => 'Angkatan wajib diisi.',
            'status_santri.required' => 'Status santri wajib dipilih.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Format foto harus jpg, jpeg, atau png.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ];
    }
}
