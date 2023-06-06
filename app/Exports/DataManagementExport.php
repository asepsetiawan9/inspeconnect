<?php

namespace App\Exports;

use App\Models\Poverty;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DataManagementExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Poverty::all();
    }

    /**
    * @var Poverty $poverty
    */
    public function map($poverty): array
    {
        return [
            $poverty->nik,
            $poverty->nama,
            $poverty->alamat,
            $poverty->id_kecamatan, // Kolom ID Kecamatan
            $poverty->tempat_lahir,
            $poverty->status,
            $poverty->kk,
            $poverty->jk,
            $poverty->rt,
            $poverty->rw,
            $poverty->id_desa, // Kolom ID Desa
            $poverty->tgl,
            $poverty->foto_diri,
            $poverty->status_pendidikan,
            $poverty->pekerjaan,
            $poverty->tempat_tinggal,
            $poverty->pendidikan_terakhir,
            $poverty->jenis_pekerjaan,
            $poverty->sumber_air_minum,
            $poverty->bahan_bakar_memasak,
            $poverty->foto_rumah,
            $poverty->desil,
            $poverty->penghasilan,
            $poverty->dtks,
            $poverty->penghasilan_perbulan,
            $poverty->bantuan_diterima,
            $poverty->tahun_input,
            $poverty->sumber_penerangan_utama,
            $poverty->bab,
        ];
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Nama',
            'Alamat',
            'Kecamatan',
            'Tempat Lahir',
            'Status',
            'KK',
            'Jenis Kelamin',
            'RT',
            'RW',
            'Desa',
            'Tanggal',
            'Foto Diri',
            'Status Pendidikan',
            'Pekerjaan',
            'Tempat Tinggal',
            'Pendidikan Terakhir',
            'Jenis Pekerjaan',
            'Sumber Air Minum',
            'Bahan Bakar Memasak',
            'Foto Rumah',
            'Desil',
            'Penghasilan',
            'DTKS',
            'Penghasilan Perbulan',
            'Bantuan Diterima',
            'Tahun Input',
            'Sumber Penerangan Utama',
            'Fasilitas BAB',
        ];
    }
}
