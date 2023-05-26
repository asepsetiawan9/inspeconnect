<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $desa = [
            [
                "id_kecamatan" => 1,
                "name_desa" => "Cimuncang"
            ],
            [
                "id_kecamatan" => 1,
                "name_desa" => "Ciwalen"
            ],
            [
                "id_kecamatan" => 1,
                "name_desa" => "Kota Kulon"
            ],
            [
                "id_kecamatan" => 1,
                "name_desa" => "Kota Wetan"
            ],
            [
                "id_kecamatan" => 1,
                "name_desa" => "Margawati"
            ],
            [
                "id_kecamatan" => 1,
                "name_desa" => "Muara Sanding"
            ],
            [
                "id_kecamatan" => 1,
                "name_desa" => "Pakuwon"
            ],
            [
                "id_kecamatan" => 1,
                "name_desa" => "Paminggir"
            ],
            [
                "id_kecamatan" => 1,
                "name_desa" => "Regol"
            ],
            [
                "id_kecamatan" => 1,
                "name_desa" => "Sukamantri"
            ],
            [
                "id_kecamatan" => 1,
                "name_desa" => "Sukanegla"
            ],
            [
                "id_kecamatan" => 2,
                "name_desa" => "Cimurah"
            ],
            [
                "id_kecamatan" => 2,
                "name_desa" => "Godog"
            ],
            [
                "id_kecamatan" => 2,
                "name_desa" => "Jatisari"
            ],
            [
                "id_kecamatan" => 2,
                "name_desa" => "Karangpawitan"
            ],
            [
                "id_kecamatan" => 2,
                "name_desa" => "Karangsari"
            ],
            [
                "id_kecamatan" => 2,
                "name_desa" => "Lebakagung"
            ],
            [
                "id_kecamatan" => 2,
                "name_desa" => "Mekarsari"
            ],
            [
                "id_kecamatan" => 2,
                "name_desa" => "Sindanggalih"
            ],
            [
                "id_kecamatan" => 2,
                "name_desa" => "Sindanglaya"
            ],
            [
                "id_kecamatan" => 2,
                "name_desa" => "Sindangpalay"
            ],
            [
                "id_kecamatan" => 2,
                "name_desa" => "Situgede"
            ],
            [
                "id_kecamatan" => 2,
                "name_desa" => "Situjaya"
            ],
            [
                "id_kecamatan" => 2,
                "name_desa" => "Situsaeur"
            ],
            [
                "id_kecamatan" => 2,
                "name_desa" => "Situsari"
            ],
            [
                "id_kecamatan" => 2,
                "name_desa" => "Suci"
            ],
            [
                "id_kecamatan" => 2,
                "name_desa" => "Tanjungsari"
            ],
            [
                "id_kecamatan" => 3,
                "name_desa" => "Cinunuk"
            ],
            [
                "id_kecamatan" => 3,
                "name_desa" => "Sindangmekar"
            ],
            [
                "id_kecamatan" => 3,
                "name_desa" => "Sindangprabu"
            ],
            [
                "id_kecamatan" => 3,
                "name_desa" => "Sindangratu"
            ],
            [
                "id_kecamatan" => 3,
                "name_desa" => "Sukamenak"
            ],
            [
                "id_kecamatan" => 3,
                "name_desa" => "Wanajaya"
            ],
            [
                "id_kecamatan" => 3,
                "name_desa" => "Wanamekar"
            ],
            [
                "id_kecamatan" => 3,
                "name_desa" => "Wanaraja"
            ],
            [
                "id_kecamatan" => 3,
                "name_desa" => "Wanasari"
            ],
            [
                "id_kecamatan" => 4,
                "name_desa" => "Cimanganten"
            ],
            [
                "id_kecamatan" => 4,
                "name_desa" => "Jati"
            ],
            [
                "id_kecamatan" => 4,
                "name_desa" => "Langensari"
            ],
            [
                "id_kecamatan" => 4,
                "name_desa" => "Mekarjaya"
            ],
            [
                "id_kecamatan" => 4,
                "name_desa" => "Mekarwangi"
            ],
            [
                "id_kecamatan" => 4,
                "name_desa" => "Panjiwangi"
            ],
            [
                "id_kecamatan" => 4,
                "name_desa" => "Pasawahan"
            ],
            [
                "id_kecamatan" => 4,
                "name_desa" => "Rancabango"
            ],
            [
                "id_kecamatan" => 4,
                "name_desa" => "Sirnajaya"
            ],
            [
                "id_kecamatan" => 4,
                "name_desa" => "Sukajadi"
            ],
            [
                "id_kecamatan" => 4,
                "name_desa" => "Sukawangi"
            ],
            [
                "id_kecamatan" => 4,
                "name_desa" => "Tanjung Kamuning"
            ],
            [
                "id_kecamatan" => 4,
                "name_desa" => "Pananjung"
            ],
            [
                "id_kecamatan" => 5,
                "name_desa" => "Cibunar"
            ],
            [
                "id_kecamatan" => 5,
                "name_desa" => "Haurpanggung"
            ],
            [
                "id_kecamatan" => 5,
                "name_desa" => "Jayaraga"
            ],
            [
                "id_kecamatan" => 5,
                "name_desa" => "Kersamenak"
            ],
            [
                "id_kecamatan" => 5,
                "name_desa" => "Mekargalih"
            ],
            [
                "id_kecamatan" => 5,
                "name_desa" => "Sukabakti"
            ],
            [
                "id_kecamatan" => 5,
                "name_desa" => "Tarogong"
            ],
            [
                "id_kecamatan" => 6,
                "name_desa" => "Bagendit"
            ],
            [
                "id_kecamatan" => 6,
                "name_desa" => "Banyuresmi"
            ],
            [
                "id_kecamatan" => 6,
                "name_desa" => "Binakarya"
            ],
            [
                "id_kecamatan" => 6,
                "name_desa" => "Cimareme"
            ],
            [
                "id_kecamatan" => 6,
                "name_desa" => "Cipicung"
            ],
            [
                "id_kecamatan" => 6,
                "name_desa" => "Dangdeur"
            ],
            [
                "id_kecamatan" => 6,
                "name_desa" => "Karyamukti"
            ],
            [
                "id_kecamatan" => 6,
                "name_desa" => "Karyasari"
            ],
            [
                "id_kecamatan" => 6,
                "name_desa" => "Pamekarsari"
            ],
            [
                "id_kecamatan" => 6,
                "name_desa" => "Sukakarya"
            ],
            [
                "id_kecamatan" => 6,
                "name_desa" => "Sukalaksana"
            ],
            [
                "id_kecamatan" => 6,
                "name_desa" => "Sukamukti"
            ],
            [
                "id_kecamatan" => 6,
                "name_desa" => "Sukaraja"
            ],
            [
                "id_kecamatan" => 6,
                "name_desa" => "Sukaratu"
            ],
            [
                "id_kecamatan" => 6,
                "name_desa" => "Sukasenang"
            ],
            [
                "id_kecamatan" => 7,
                "name_desa" => "Cintaasih"
            ],
            [
                "id_kecamatan" => 7,
                "name_desa" => "Cisarua"
            ],
            [
                "id_kecamatan" => 7,
                "name_desa" => "Cintakarya"
            ],
            [
                "id_kecamatan" => 7,
                "name_desa" => "Cintarakyat"
            ],
            [
                "id_kecamatan" => 7,
                "name_desa" => "Cintarasa"
            ],
            [
                "id_kecamatan" => 7,
                "name_desa" => "Parakan"
            ],
            [
                "id_kecamatan" => 7,
                "name_desa" => "Samarang"
            ],
            [
                "id_kecamatan" => 7,
                "name_desa" => "Sirnasari"
            ],
            [
                "id_kecamatan" => 7,
                "name_desa" => "Sukakarya"
            ],
            [
                "id_kecamatan" => 7,
                "name_desa" => "Sukalaksana"
            ],
            [
                "id_kecamatan" => 7,
                "name_desa" => "Sukarasa"
            ],
            [
                "id_kecamatan" => 7,
                "name_desa" => "Tanjung Karya"
            ],
            [
                "id_kecamatan" => 7,
                "name_desa" => "Tanjunganom"
            ],
            [
                "id_kecamatan" => 8,
                "name_desa" => "Barusari"
            ],
            [
                "id_kecamatan" => 8,
                "name_desa" => "Karyamekar"
            ],
            [
                "id_kecamatan" => 8,
                "name_desa" => "Padaasih"
            ],
            [
                "id_kecamatan" => 8,
                "name_desa" => "Padamukti"
            ],
            [
                "id_kecamatan" => 8,
                "name_desa" => "Padamulya"
            ],
            [
                "id_kecamatan" => 8,
                "name_desa" => "Padasuka"
            ],
            [
                "id_kecamatan" => 8,
                "name_desa" => "Padawaas"
            ],
            [
                "id_kecamatan" => 8,
                "name_desa" => "Pasirkiamis"
            ],
            [
                "id_kecamatan" => 8,
                "name_desa" => "Pasirwangi"
            ],
            [
                "id_kecamatan" => 8,
                "name_desa" => "Sarimukti"
            ],
            [
                "id_kecamatan" => 8,
                "name_desa" => "Sinarjaya"
            ],
            [
                "id_kecamatan" => 8,
                "name_desa" => "Talaga"
            ],
            [
                "id_kecamatan" => 9,
                "name_desa" => "Cangkuang"
            ],
            [
                "id_kecamatan" => 9,
                "name_desa" => "Ciburial"
            ],
            [
                "id_kecamatan" => 9,
                "name_desa" => "Cipancar"
            ],
            [
                "id_kecamatan" => 9,
                "name_desa" => "Dano"
            ],
            [
                "id_kecamatan" => 9,
                "name_desa" => "Haruman"
            ],
            [
                "id_kecamatan" => 9,
                "name_desa" => "Jangkurang"
            ],
            [
                "id_kecamatan" => 9,
                "name_desa" => "Kandangmukti"
            ],
            [
                "id_kecamatan" => 9,
                "name_desa" => "Leles"
            ],
            [
                "id_kecamatan" => 9,
                "name_desa" => "Lembang"
            ],
            [
                "id_kecamatan" => 9,
                "name_desa" => "Margaluyu"
            ],
            [
                "id_kecamatan" => 9,
                "name_desa" => "Salamnunggal"
            ],
            [
                "id_kecamatan" => 9,
                "name_desa" => "Sukarame"
            ],
            [
                "id_kecamatan" => 10,
                "name_desa" => "Cikembulan"
            ],
            [
                "id_kecamatan" => 10,
                "name_desa" => "Cisaat"
            ],
            [
                "id_kecamatan" => 10,
                "name_desa" => "Gandamekar"
            ],
            [
                "id_kecamatan" => 10,
                "name_desa" => "Harumansari"
            ],
            [
                "id_kecamatan" => 10,
                "name_desa" => "Hegarsari"
            ],
            [
                "id_kecamatan" => 10,
                "name_desa" => "Kadungora"
            ],
            [
                "id_kecamatan" => 10,
                "name_desa" => "Karangmulya"
            ],
            [
                "id_kecamatan" => 10,
                "name_desa" => "Karangtengah"
            ],
            [
                "id_kecamatan" => 10,
                "name_desa" => "Mandalasari"
            ],
            [
                "id_kecamatan" => 10,
                "name_desa" => "Mekarbakti"
            ],
            [
                "id_kecamatan" => 10,
                "name_desa" => "Neglasari"
            ],
            [
                "id_kecamatan" => 10,
                "name_desa" => "Rancasalak"
            ],
            [
                "id_kecamatan" => 10,
                "name_desa" => "Talagasari"
            ],
            [
                "id_kecamatan" => 10,
                "name_desa" => "Tanggulun"
            ],
            [
                "id_kecamatan" => 11,
                "name_desa" => "Dungusiku"
            ],
            [
                "id_kecamatan" => 11,
                "name_desa" => "Karanganyar"
            ],
            [
                "id_kecamatan" => 11,
                "name_desa" => "Karangsari"
            ],
            [
                "id_kecamatan" => 11,
                "name_desa" => "Leuwigoong"
            ],
            [
                "id_kecamatan" => 11,
                "name_desa" => "Margacinta"
            ],
            [
                "id_kecamatan" => 11,
                "name_desa" => "Margahayu"
            ],
            [
                "id_kecamatan" => 11,
                "name_desa" => "Sindangsari"
            ],
            [
                "id_kecamatan" => 11,
                "name_desa" => "Tambak Sari"
            ],
            [
                "id_kecamatan" => 12,
                "name_desa" => "Cibatu"
            ],
            [
                "id_kecamatan" => 12,
                "name_desa" => "Cibunar"
            ],
            [
                "id_kecamatan" => 12,
                "name_desa" => "Girimukti"
            ],
            [
                "id_kecamatan" => 12,
                "name_desa" => "Karyamukti"
            ],
            [
                "id_kecamatan" => 12,
                "name_desa" => "Keresek"
            ],
            [
                "id_kecamatan" => 12,
                "name_desa" => "Kertajaya"
            ],
            [
                "id_kecamatan" => 12,
                "name_desa" => "Mekarsari"
            ],
            [
                "id_kecamatan" => 12,
                "name_desa" => "Padasuka"
            ],
            [
                "id_kecamatan" => 12,
                "name_desa" => "Sindangsuka"
            ],
            [
                "id_kecamatan" => 12,
                "name_desa" => "Sukalilah"
            ],
            [
                "id_kecamatan" => 12,
                "name_desa" => "Wanakerta"
            ],
            [
                "id_kecamatan" => 13,
                "name_desa" => "Girijaya"
            ],
            [
                "id_kecamatan" => 13,
                "name_desa" => "Kersamanah"
            ],
            [
                "id_kecamatan" => 13,
                "name_desa" => "Mekarraya"
            ],
            [
                "id_kecamatan" => 13,
                "name_desa" => "Nanjungjaya"
            ],
            [
                "id_kecamatan" => 13,
                "name_desa" => "Sukamaju"
            ],
            [
                "id_kecamatan" => 13,
                "name_desa" => "Sukamerang"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Baru Dua"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Bunisari"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Campaka"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Cibunar"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Cihaurkuning"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Cikarang"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Cilampuyang"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Cinagara"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Cisitu"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Citeras"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Girimakmur"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Karangmulya"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Kutanagara"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Lewobaru"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Malangbong"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Mekarasih"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Mekarmulya"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Sanding"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Sakawayang"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Sekarwangi"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Sukajaya"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Sukamanah"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Sukarasa"
            ],
            [
                "id_kecamatan" => 14,
                "name_desa" => "Sukaratu"
            ],
            [
                "id_kecamatan" => 15,
                "name_desa" => "Maripari"
            ],
            [
                "id_kecamatan" => 15,
                "name_desa" => "Mekar Hurip"
            ],
            [
                "id_kecamatan" => 15,
                "name_desa" => "Mekarluyu"
            ],
            [
                "id_kecamatan" => 15,
                "name_desa" => "Mekarwangi"
            ],
            [
                "id_kecamatan" => 15,
                "name_desa" => "Pasanggrahan"
            ],
            [
                "id_kecamatan" => 15,
                "name_desa" => "Sudalarang"
            ],
            [
                "id_kecamatan" => 15,
                "name_desa" => "Sukahaji"
            ],
            [
                "id_kecamatan" => 15,
                "name_desa" => "Sukaluyu"
            ],
            [
                "id_kecamatan" => 15,
                "name_desa" => "Sukamukti"
            ],
            [
                "id_kecamatan" => 15,
                "name_desa" => "Sukasono"
            ],
            [
                "id_kecamatan" => 15,
                "name_desa" => "Sukawening"
            ],
            [
                "id_kecamatan" => 16,
                "name_desa" => "Caringin"
            ],
            [
                "id_kecamatan" => 16,
                "name_desa" => "Cinta"
            ],
            [
                "id_kecamatan" => 16,
                "name_desa" => "Cintamanik"
            ],
            [
                "id_kecamatan" => 16,
                "name_desa" => "Sindanggalih"
            ],
            [
                "id_kecamatan" => 17,
                "name_desa" => "Banjarsari"
            ],
            [
                "id_kecamatan" => 17,
                "name_desa" => "Bayongbong"
            ],
            [
                "id_kecamatan" => 17,
                "name_desa" => "Ciburuy"
            ],
            [
                "id_kecamatan" => 17,
                "name_desa" => "Ciela"
            ],
            [
                "id_kecamatan" => 17,
                "name_desa" => "Cikedokan"
            ],
            [
                "id_kecamatan" => 17,
                "name_desa" => "Cinisti"
            ],
            [
                "id_kecamatan" => 17,
                "name_desa" => "Hegarmanah"
            ],
            [
                "id_kecamatan" => 17,
                "name_desa" => "Karyajaya"
            ],
            [
                "id_kecamatan" => 17,
                "name_desa" => "Mekarjaya"
            ],
            [
                "id_kecamatan" => 17,
                "name_desa" => "Mekarsari"
            ],
            [
                "id_kecamatan" => 17,
                "name_desa" => "Mulyasari"
            ],
            [
                "id_kecamatan" => 17,
                "name_desa" => "Pamalayan"
            ],
            [
                "id_kecamatan" => 17,
                "name_desa" => "Panembong"
            ],
            [
                "id_kecamatan" => 17,
                "name_desa" => "Selakuray"
            ],
            [
                "id_kecamatan" => 17,
                "name_desa" => "Sirnagalih"
            ],
            [
                "id_kecamatan" => 17,
                "name_desa" => "Sukamanah"
            ],
            [
                "id_kecamatan" => 17,
                "name_desa" => "Sukarame"
            ],
            [
                "id_kecamatan" => 17,
                "name_desa" => "Sukasenang"
            ],
            [
                "id_kecamatan" => 18,
                "name_desa" => "Barusuda"
            ],
            [
                "id_kecamatan" => 18,
                "name_desa" => "Cigedug"
            ],
            [
                "id_kecamatan" => 18,
                "name_desa" => "Cintanagara"
            ],
            [
                "id_kecamatan" => 18,
                "name_desa" => "Sindangsari"
            ],
            [
                "id_kecamatan" => 18,
                "name_desa" => "Sukahurip"
            ],
            [
                "id_kecamatan" => 19,
                "name_desa" => "Cilawu"
            ],
            [
                "id_kecamatan" => 19,
                "name_desa" => "Dangiang"
            ],
            [
                "id_kecamatan" => 19,
                "name_desa" => "Dawungsari"
            ],
            [
                "id_kecamatan" => 19,
                "name_desa" => "Dayeuhmanggung"
            ],
            [
                "id_kecamatan" => 19,
                "name_desa" => "Desakolot"
            ],
            [
                "id_kecamatan" => 19,
                "name_desa" => "Karyamekar"
            ],
            [
                "id_kecamatan" => 19,
                "name_desa" => "Mangurakyat"
            ],
            [
                "id_kecamatan" => 19,
                "name_desa" => "Margalaksana"
            ],
            [
                "id_kecamatan" => 19,
                "name_desa" => "Mekarmukti"
            ],
            [
                "id_kecamatan" => 19,
                "name_desa" => "Mekarsari"
            ],
            [
                "id_kecamatan" => 19,
                "name_desa" => "Ngamplang"
            ],
            [
                "id_kecamatan" => 19,
                "name_desa" => "Ngamplangsari"
            ],
            [
                "id_kecamatan" => 19,
                "name_desa" => "Pasanggrahan"
            ],
            [
                "id_kecamatan" => 19,
                "name_desa" => "Sukahati"
            ],
            [
                "id_kecamatan" => 19,
                "name_desa" => "Sukamaju"
            ],
            [
                "id_kecamatan" => 19,
                "name_desa" => "Sukamukti"
            ],
            [
                "id_kecamatan" => 19,
                "name_desa" => "Sukamurni"
            ],
            [
                "id_kecamatan" => 19,
                "name_desa" => "Sukatani"
            ],
            [
                "id_kecamatan" => 20,
                "name_desa" => "Balewangi"
            ],
            [
                "id_kecamatan" => 20,
                "name_desa" => "Cidatar"
            ],
            [
                "id_kecamatan" => 20,
                "name_desa" => "Cintaasih"
            ],
            [
                "id_kecamatan" => 20,
                "name_desa" => "Cipaganti"
            ],
            [
                "id_kecamatan" => 20,
                "name_desa" => "Cisero"
            ],
            [
                "id_kecamatan" => 20,
                "name_desa" => "Cisurupan"
            ],
            [
                "id_kecamatan" => 20,
                "name_desa" => "Kramatwangi"
            ],
            [
                "id_kecamatan" => 20,
                "name_desa" => "Pakuwon"
            ],
            [
                "id_kecamatan" => 20,
                "name_desa" => "Pamulihan"
            ],
            [
                "id_kecamatan" => 20,
                "name_desa" => "Pangauban"
            ],
            [
                "id_kecamatan" => 20,
                "name_desa" => "Simpangsari"
            ],
            [
                "id_kecamatan" => 20,
                "name_desa" => "Sirnajaya"
            ],
            [
                "id_kecamatan" => 20,
                "name_desa" => "Sirnagalih"
            ],
            [
                "id_kecamatan" => 20,
                "name_desa" => "Situsari"
            ],
            [
                "id_kecamatan" => 20,
                "name_desa" => "Sukatani"
            ],
            [
                "id_kecamatan" => 20,
                "name_desa" => "Sukawangi"
            ],
            [
                "id_kecamatan" => 20,
                "name_desa" => "Tambakbaya"
            ],
            [
                "id_kecamatan" => 21,
                "name_desa" => "Cintadamai"
            ],
            [
                "id_kecamatan" => 21,
                "name_desa" => "Mekarjaya"
            ],
            [
                "id_kecamatan" => 21,
                "name_desa" => "Padamukti"
            ],
            [
                "id_kecamatan" => 21,
                "name_desa" => "Sukajaya"
            ],
            [
                "id_kecamatan" => 21,
                "name_desa" => "Sukalilah"
            ],
            [
                "id_kecamatan" => 21,
                "name_desa" => "Sukamulya"
            ],
            [
                "id_kecamatan" => 21,
                "name_desa" => "Sukaresmi"
            ],
            [
                "id_kecamatan" => 22,
                "name_desa" => "Cibodas"
            ],
            [
                "id_kecamatan" => 22,
                "name_desa" => "Cikajang"
            ],
            [
                "id_kecamatan" => 22,
                "name_desa" => "Cikandang"
            ],
            [
                "id_kecamatan" => 22,
                "name_desa" => "Cipangramatan"
            ],
            [
                "id_kecamatan" => 22,
                "name_desa" => "Giriawas"
            ],
            [
                "id_kecamatan" => 22,
                "name_desa" => "Girijaya"
            ],
            [
                "id_kecamatan" => 22,
                "name_desa" => "Kramatwangi"
            ],
            [
                "id_kecamatan" => 22,
                "name_desa" => "Margamulya"
            ],
            [
                "id_kecamatan" => 22,
                "name_desa" => "Mekarjaya"
            ],
            [
                "id_kecamatan" => 22,
                "name_desa" => "Mekarsari"
            ],
            [
                "id_kecamatan" => 22,
                "name_desa" => "Padasuka"
            ],
            [
                "id_kecamatan" => 22,
                "name_desa" => "Simpang"
            ],
            [
                "id_kecamatan" => 23,
                "name_desa" => "Banjarwangi"
            ],
            [
                "id_kecamatan" => 23,
                "name_desa" => "Bojong"
            ],
            [
                "id_kecamatan" => 23,
                "name_desa" => "Dangiang"
            ],
            [
                "id_kecamatan" => 23,
                "name_desa" => "Jayabakti"
            ],
            [
                "id_kecamatan" => 23,
                "name_desa" => "Kadongdong"
            ],
            [
                "id_kecamatan" => 23,
                "name_desa" => "Mulyajaya"
            ],
            [
                "id_kecamatan" => 23,
                "name_desa" => "Padahurip"
            ],
            [
                "id_kecamatan" => 23,
                "name_desa" => "Tanjungjaya"
            ],
            [
                "id_kecamatan" => 23,
                "name_desa" => "Talagajaya"
            ],
            [
                "id_kecamatan" => 23,
                "name_desa" => "Talagasari"
            ],
            [
                "id_kecamatan" => 23,
                "name_desa" => "Wangunjaya"
            ],
            [
                "id_kecamatan" => 24,
                "name_desa" => "Cigintung"
            ],
            [
                "id_kecamatan" => 24,
                "name_desa" => "Ciudian"
            ],
            [
                "id_kecamatan" => 24,
                "name_desa" => "Girimukti"
            ],
            [
                "id_kecamatan" => 24,
                "name_desa" => "Karangagung"
            ],
            [
                "id_kecamatan" => 24,
                "name_desa" => "Mekartani"
            ],
            [
                "id_kecamatan" => 24,
                "name_desa" => "Pancasura"
            ],
            [
                "id_kecamatan" => 24,
                "name_desa" => "Singajaya"
            ],
            [
                "id_kecamatan" => 24,
                "name_desa" => "Sukamulya"
            ],
            [
                "id_kecamatan" => 24,
                "name_desa" => "Sukawangi"
            ],
            [
                "id_kecamatan" => 25,
                "name_desa" => "Cihurip"
            ],
            [
                "id_kecamatan" => 25,
                "name_desa" => "Cisangkal"
            ],
            [
                "id_kecamatan" => 25,
                "name_desa" => "Jayamukti"
            ],
            [
                "id_kecamatan" => 25,
                "name_desa" => "Mekarwangi"
            ],
            [
                "id_kecamatan" => 26,
                "name_desa" => "Pangrumasan"
            ],
            [
                "id_kecamatan" => 26,
                "name_desa" => "Peundeuy"
            ],
            [
                "id_kecamatan" => 26,
                "name_desa" => "Purwajaya"
            ],
            [
                "id_kecamatan" => 26,
                "name_desa" => "Saribakti"
            ],
            [
                "id_kecamatan" => 26,
                "name_desa" => "Sukanagara"
            ],
            [
                "id_kecamatan" => 26,
                "name_desa" => "Toblong"
            ],
            [
                "id_kecamatan" => 27,
                "name_desa" => "Bojong"
            ],
            [
                "id_kecamatan" => 27,
                "name_desa" => "Bojong Kidul"
            ],
            [
                "id_kecamatan" => 27,
                "name_desa" => "Jatimulya"
            ],
            [
                "id_kecamatan" => 27,
                "name_desa" => "Mancagahar"
            ],
            [
                "id_kecamatan" => 27,
                "name_desa" => "Mandalakasih"
            ],
            [
                "id_kecamatan" => 27,
                "name_desa" => "Paas"
            ],
            [
                "id_kecamatan" => 27,
                "name_desa" => "Pameungpeuk"
            ],
            [
                "id_kecamatan" => 27,
                "name_desa" => "Sirnabakti"
            ],
            [
                "id_kecamatan" => 28,
                "name_desa" => "Cisompet"
            ],
            [
                "id_kecamatan" => 28,
                "name_desa" => "Cihaurkuning"
            ],
            [
                "id_kecamatan" => 28,
                "name_desa" => "Cikondang"
            ],
            [
                "id_kecamatan" => 28,
                "name_desa" => "Depok"
            ],
            [
                "id_kecamatan" => 28,
                "name_desa" => "Jatisari"
            ],
            [
                "id_kecamatan" => 28,
                "name_desa" => "Margamulya"
            ],
            [
                "id_kecamatan" => 28,
                "name_desa" => "Neglasari"
            ],
            [
                "id_kecamatan" => 28,
                "name_desa" => "Panyindangan"
            ],
            [
                "id_kecamatan" => 28,
                "name_desa" => "Sindangsari"
            ],
            [
                "id_kecamatan" => 28,
                "name_desa" => "Sukamukti"
            ],
            [
                "id_kecamatan" => 28,
                "name_desa" => "Sukanagara"
            ],
            [
                "id_kecamatan" => 29,
                "name_desa" => "Cigaronggong"
            ],
            [
                "id_kecamatan" => 29,
                "name_desa" => "Karyamukti"
            ],
            [
                "id_kecamatan" => 29,
                "name_desa" => "Karyasari"
            ],
            [
                "id_kecamatan" => 29,
                "name_desa" => "Maroko"
            ],
            [
                "id_kecamatan" => 29,
                "name_desa" => "Mekarmukti"
            ],
            [
                "id_kecamatan" => 29,
                "name_desa" => "Mekarsari"
            ],
            [
                "id_kecamatan" => 29,
                "name_desa" => "Mekarwangi"
            ],
            [
                "id_kecamatan" => 29,
                "name_desa" => "Najaten"
            ],
            [
                "id_kecamatan" => 29,
                "name_desa" => "Sagara"
            ],
            [
                "id_kecamatan" => 29,
                "name_desa" => "Sancang"
            ],
            [
                "id_kecamatan" => 29,
                "name_desa" => "Simpang"
            ],
            [
                "id_kecamatan" => 30,
                "name_desa" => "Awassagara"
            ],
            [
                "id_kecamatan" => 30,
                "name_desa" => "Cigadog"
            ],
            [
                "id_kecamatan" => 30,
                "name_desa" => "Cijambe"
            ],
            [
                "id_kecamatan" => 30,
                "name_desa" => "Cikelet"
            ],
            [
                "id_kecamatan" => 30,
                "name_desa" => "Ciroyom"
            ],
            [
                "id_kecamatan" => 30,
                "name_desa" => "Girimukti"
            ],
            [
                "id_kecamatan" => 30,
                "name_desa" => "Karangsari"
            ],
            [
                "id_kecamatan" => 30,
                "name_desa" => "Kertamukti"
            ],
            [
                "id_kecamatan" => 30,
                "name_desa" => "Linggamanik"
            ],
            [
                "id_kecamatan" => 30,
                "name_desa" => "Pamalayan"
            ],
            [
                "id_kecamatan" => 30,
                "name_desa" => "Tipar"
            ],
            [
                "id_kecamatan" => 31,
                "name_desa" => "Bungbulang"
            ],
            [
                "id_kecamatan" => 31,
                "name_desa" => "Bojong"
            ],
            [
                "id_kecamatan" => 31,
                "name_desa" => "Cihikeu"
            ],
            [
                "id_kecamatan" => 31,
                "name_desa" => "Gunamekar"
            ],
            [
                "id_kecamatan" => 31,
                "name_desa" => "Gunung Jampang"
            ],
            [
                "id_kecamatan" => 31,
                "name_desa" => "Hanjuang"
            ],
            [
                "id_kecamatan" => 31,
                "name_desa" => "Hegarmanah"
            ],
            [
                "id_kecamatan" => 31,
                "name_desa" => "Margalaksana"
            ],
            [
                "id_kecamatan" => 31,
                "name_desa" => "Mekarbakti"
            ],
            [
                "id_kecamatan" => 31,
                "name_desa" => "Mekarjaya"
            ],
            [
                "id_kecamatan" => 31,
                "name_desa" => "Sinarjaya"
            ],
            [
                "id_kecamatan" => 31,
                "name_desa" => "Tegallega"
            ],
            [
                "id_kecamatan" => 31,
                "name_desa" => "Wangunjaya"
            ],
            [
                "id_kecamatan" => 32,
                "name_desa" => "Cijayana"
            ],
            [
                "id_kecamatan" => 32,
                "name_desa" => "Jayabaya"
            ],
            [
                "id_kecamatan" => 32,
                "name_desa" => "Karangwangi"
            ],
            [
                "id_kecamatan" => 32,
                "name_desa" => "Mekarmukti"
            ],
            [
                "id_kecamatan" => 32,
                "name_desa" => "Mekarsari"
            ],
            [
                "id_kecamatan" => 33,
                "name_desa" => "Depok"
            ],
            [
                "id_kecamatan" => 33,
                "name_desa" => "Jatiwangi"
            ],
            [
                "id_kecamatan" => 33,
                "name_desa" => "Jayamekar"
            ],
            [
                "id_kecamatan" => 33,
                "name_desa" => "Karangsari"
            ],
            [
                "id_kecamatan" => 33,
                "name_desa" => "Neglasari"
            ],
            [
                "id_kecamatan" => 33,
                "name_desa" => "Panyindangan"
            ],
            [
                "id_kecamatan" => 33,
                "name_desa" => "Pasirlangu"
            ],
            [
                "id_kecamatan" => 33,
                "name_desa" => "Sukamulya"
            ],
            [
                "id_kecamatan" => 33,
                "name_desa" => "Talagawangi"
            ],
            [
                "id_kecamatan" => 33,
                "name_desa" => "Tanjungjaya"
            ],
            [
                "id_kecamatan" => 33,
                "name_desa" => "Tanjungmulya"
            ],
            [
                "id_kecamatan" => 33,
                "name_desa" => "Tegalgede"
            ],
            [
                "id_kecamatan" => 33,
                "name_desa" => "Wangunjaya"
            ],
            [
                "id_kecamatan" => 34,
                "name_desa" => "Garumukti"
            ],
            [
                "id_kecamatan" => 34,
                "name_desa" => "Linggarjati"
            ],
            [
                "id_kecamatan" => 34,
                "name_desa" => "Pakenjeng"
            ],
            [
                "id_kecamatan" => 34,
                "name_desa" => "Panawa"
            ],
            [
                "id_kecamatan" => 34,
                "name_desa" => "Pananjung"
            ],
            [
                "id_kecamatan" => 35,
                "name_desa" => "Cikarang"
            ],
            [
                "id_kecamatan" => 35,
                "name_desa" => "Cisewu"
            ],
            [
                "id_kecamatan" => 35,
                "name_desa" => "Girimukti"
            ],
            [
                "id_kecamatan" => 35,
                "name_desa" => "Karangsewu"
            ],
            [
                "id_kecamatan" => 35,
                "name_desa" => "Mekarsewu"
            ],
            [
                "id_kecamatan" => 35,
                "name_desa" => "Nyalindung"
            ],
            [
                "id_kecamatan" => 35,
                "name_desa" => "Panggalih"
            ],
            [
                "id_kecamatan" => 35,
                "name_desa" => "Pamalayan"
            ],
            [
                "id_kecamatan" => 35,
                "name_desa" => "Sukajaya"
            ],
            [
                "id_kecamatan" => 36,
                "name_desa" => "Caringin"
            ],
            [
                "id_kecamatan" => 36,
                "name_desa" => "Cimahi"
            ],
            [
                "id_kecamatan" => 36,
                "name_desa" => "Indralayang"
            ],
            [
                "id_kecamatan" => 36,
                "name_desa" => "Purbayani"
            ],
            [
                "id_kecamatan" => 36,
                "name_desa" => "Samuderajaya"
            ],
            [
                "id_kecamatan" => 36,
                "name_desa" => "Sukarame"
            ],
            [
                "id_kecamatan" => 37,
                "name_desa" => "Mekarmukti"
            ],
            [
                "id_kecamatan" => 37,
                "name_desa" => "Mekarmulya"
            ],
            [
                "id_kecamatan" => 37,
                "name_desa" => "Mekarwangi"
            ],
            [
                "id_kecamatan" => 37,
                "name_desa" => "Selaawi"
            ],
            [
                "id_kecamatan" => 37,
                "name_desa" => "Sukalaksana"
            ],
            [
                "id_kecamatan" => 37,
                "name_desa" => "Sukamaju"
            ],
            [
                "id_kecamatan" => 37,
                "name_desa" => "Sukamulya"
            ],
            [
                "id_kecamatan" => 38,
                "name_desa" => "Cigagade"
            ],
            [
                "id_kecamatan" => 38,
                "name_desa" => "Cijolang"
            ],
            [
                "id_kecamatan" => 38,
                "name_desa" => "Ciwangi"
            ],
            [
                "id_kecamatan" => 38,
                "name_desa" => "Dunguswiru"
            ],
            [
                "id_kecamatan" => 38,
                "name_desa" => "Galihpakuwon"
            ],
            [
                "id_kecamatan" => 38,
                "name_desa" => "Limbangan Barat"
            ],
            [
                "id_kecamatan" => 38,
                "name_desa" => "Limbangan Tengah"
            ],
            [
                "id_kecamatan" => 38,
                "name_desa" => "Limbangan Timur"
            ],
            [
                "id_kecamatan" => 38,
                "name_desa" => "Neglasari"
            ],
            [
                "id_kecamatan" => 38,
                "name_desa" => "Pangeureunan"
            ],
            [
                "id_kecamatan" => 38,
                "name_desa" => "Pasirwaru"
            ],
            [
                "id_kecamatan" => 38,
                "name_desa" => "Simpen Kaler"
            ],
            [
                "id_kecamatan" => 38,
                "name_desa" => "Simpen Kidul"
            ],
            [
                "id_kecamatan" => 38,
                "name_desa" => "Surabaya"
            ],
            [
                "id_kecamatan" => 39,
                "name_desa" => "Cigawir"
            ],
            [
                "id_kecamatan" => 39,
                "name_desa" => "Cirapuhan"
            ],
            [
                "id_kecamatan" => 39,
                "name_desa" => "Mekarsari"
            ],
            [
                "id_kecamatan" => 39,
                "name_desa" => "Pelitaasih"
            ],
            [
                "id_kecamatan" => 39,
                "name_desa" => "Putrajawa"
            ],
            [
                "id_kecamatan" => 39,
                "name_desa" => "Samida"
            ],
            [
                "id_kecamatan" => 39,
                "name_desa" => "Selaawi"
            ],
            [
                "id_kecamatan" => 40,
                "name_desa" => "Cipareuan"
            ],
            [
                "id_kecamatan" => 40,
                "name_desa" => "Cibiuk Kaler"
            ],
            [
                "id_kecamatan" => 40,
                "name_desa" => "Cibiuk Kidul"
            ],
            [
                "id_kecamatan" => 40,
                "name_desa" => "Lingkungpasir"
            ],
            [
                "id_kecamatan" => 40,
                "name_desa" => "Majasari"
            ],
            [
                "id_kecamatan" => 41,
                "name_desa" => "Babakan Loa"
            ],
            [
                "id_kecamatan" => 41,
                "name_desa" => "Cihuni"
            ],
            [
                "id_kecamatan" => 41,
                "name_desa" => "Cimarabas"
            ],
            [
                "id_kecamatan" => 41,
                "name_desa" => "Citangtu"
            ],
            [
                "id_kecamatan" => 41,
                "name_desa" => "Karangsari"
            ],
            [
                "id_kecamatan" => 41,
                "name_desa" => "Sukahurip"
            ],
            [
                "id_kecamatan" => 41,
                "name_desa" => "Sukamulya"
            ],
            [
                "id_kecamatan" => 41,
                "name_desa" => "Sukarasa"
            ],
            [
                "id_kecamatan" => 42,
                "name_desa" => "Cigadog"
            ],
            [
                "id_kecamatan" => 42,
                "name_desa" => "Linggamukti"
            ],
            [
                "id_kecamatan" => 42,
                "name_desa" => "Sadang"
            ],
            [
                "id_kecamatan" => 42,
                "name_desa" => "Sukalaksana"
            ],
            [
                "id_kecamatan" => 42,
                "name_desa" => "Sukaratu"
            ],
            [
                "id_kecamatan" => 42,
                "name_desa" => "Tegalpanjang"
            ],
            [
                "id_kecamatan" => 42,
                "name_desa" => "Tenjonagara"
            ],
        ];

        DB::table('desa')->insert($desa);
    }
}
