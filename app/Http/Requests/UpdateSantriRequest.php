<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSantriRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nis' => 'required|string|max:20',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'angkatan' => 'required|string|max:20',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'program' => 'nullable|string|max:100',
            'sekolah_formal' => 'nullable|string|max:100',
            'madrasah_diniyah' => 'nullable|string|max:100',
            'telepon_orang_tua' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
            'status_santri' => 'required|in:aktif,alumni',
        ];
    }

    public function messages()
    {
        return [
            'nis.required' => 'NIS wajib diisi.',
            'nama.required' => 'Nama lengkap wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'angkatan.required' => 'Angkatan wajib diisi.',
            'status_santri.required' => 'Status santri wajib dipilih.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.max' => 'Ukuran foto maksimal 10MB.',
        ];
    }
}
