<?php

namespace App\Imports;

use App\Models\Poverty;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataManagementImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Poverty([
            'nik' => $row['nik'],
            'nama' => $row['nama'],
            'alamat' => $row['alamat'],
            'id_kecamatan' => $row['kecamatan'],
            'tempat_lahir' => $row['tempat_lahir'],
            'status' => $row['status'],
            'kk' => $row['kk'],
            'jk' => $row['jenis_kelamin'],
            'rt' => $row['rt'],
            'rw' => $row['rw'],
            'id_desa' => $row['desa'],
            'tgl' => $row['tanggal'],
            'foto_diri' => $row['foto_diri'],
            'status_pendidikan' => $row['status_pendidikan'],
            'pekerjaan' => $row['pekerjaan'],
            'tempat_tinggal' => $row['tempat_tinggal'],
            'pendidikan_terakhir' => $row['pendidikan_terakhir'],
            'jenis_pekerjaan' => $row['jenis_pekerjaan'],
            'sumber_air_minum' => $row['sumber_air_minum'],
            'bahan_bakar_memasak' => $row['bahan_bakar_memasak'],
            'foto_rumah' => $row['foto_rumah'],
            'desil' => $row['desil'],
            'penghasilan' => $row['penghasilan'],
            'dtks' => $row['dtks'],
            'penghasilan_perbulan' => $row['penghasilan_perbulan'],
            'bantuan_diterima' => $row['bantuan_diterima'],
            'tahun_input' => $row['tahun_input'],
            'sumber_penerangan_utama' => $row['sumber_penerangan_utama'],
            'bab' => $row['fasilitas_bab'],
        ]);
    }
}
