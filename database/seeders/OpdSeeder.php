<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Badan Kepegawaian dan Diklat',
                'desc' => 'Badan Kepegawaian dan Diklat',
                'alamat' => 'Jl. Pahlawan No.47, Sukagalih, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'badan-kepegawaian-dan-diklat'
            ],
            [
                'name' => 'Badan Kesatuan Bangsa dan Politik',
                'desc' => 'Badan Kesatuan Bangsa dan Politik',
                'alamat' => 'Jl. Patriot No.10A, Sukagalih, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'badan-kesatuan-bangsa-dan-politik'
            ],
            [
                'name' => 'Badan Penanggulangan Bencana Daerah',
                'desc' => 'Badan Penanggulangan Bencana Daerah',
                'alamat' => 'Jl. Terusan Pahlawan No.66, Sukagalih, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'badan-penanggulangan-bencana-daerah'
            ],
            [
                'name' => 'Badan Pendapatan Daerah',
                'desc' => 'Badan Pendapatan Daerah',
                'alamat' => 'Jl. Otista No.278, Sukagalih, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'badan-pendapatan-daerah'
            ],
            [
                'name' => 'Badan Pengelolaan Keuangan dan Aset Daerah',
                'desc' => 'Badan Pengelolaan Keuangan dan Aset Daerah',
                'alamat' => 'Jl. Kiansantang No.3, Regol, Kec. Garut Kota, Kabupaten Garut, Jawa Barat 44118',
                'slug' => 'badan-pengelolaan-keuangan-dan-aset-daerah'
            ],
            [
                'name' => 'Badan Perencanaan Pembangunan Daerah',
                'desc' => 'Badan Perencanaan Pembangunan Daerah',
                'alamat' => 'Jl. Patriot No.8, Sukagalih, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 4415',
                'slug' => 'badan-perencanaan-pembangunan-daerah'
            ],
            [
                'name' => 'Dinas Kependudukan dan Pecatatan Sipil',
                'desc' => 'Dinas Kependudukan dan Pecatatan Sipil',
                'alamat' => 'Jl. Patriot No.14, Sukagalih, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'dinas-kependudukan-dan-pecatatan-sipil'
            ],
            [
                'name' => 'Dinas Kesehatan',
                'desc' => 'Dinas Kesehatan',
                'alamat' => 'Jl. Proklamasi No.7, Jayaraga, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'dinas-kesehatan'
            ],
            [
                'name' => 'Dinas Ketahanan Pangan',
                'desc' => 'Dinas Ketahanan Pangan',
                'alamat' => 'Jl. Terusan Pahlawan No.70, Sukagalih, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'dinas-ketahanan-pangan'
            ],
            [
                'name' => 'Dinas Koperasi dan UKM',
                'desc' => 'Dinas Koperasi dan UKM',
                'alamat' => 'Jl. Ahmad Yani No.202, Kota Wetan, Kec. Garut Kota, Kabupaten Garut, Jawa Barat 44111',
                'slug' => 'dinas-koperasi-dan-ukm'
            ],
            [
                'name' => 'Dinas Lingkungan Hidup',
                'desc' => 'Dinas Lingkungan Hidup',
                'alamat' => 'Jl. Terusan Pahlawan, Sukagalih, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'dinas-lingkungan-hidup'
            ],
            [
                'name' => 'Dinas Pariwisata dan Kebudayaan',
                'desc' => 'Dinas Pariwisata dan Kebudayaan',
                'alamat' => 'Jl. Raya Ciledug No.120, Kota Kulon, Kec. Garut Kota, Kabupaten Garut, Jawa Barat 44114',
                'slug' => 'dinas-pariwisata-dan-kebudayaan'
            ],
            [
                'name' => 'Dinas Pekerjaan Umum dan Penataan Ruang',
                'desc' => 'Dinas Pekerjaan Umum dan Penataan Ruang',
                'alamat' => 'Jl. Raya Samarang No.117, Sukagalih, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'dinas-pekerjaan-umum-dan-penataan-ruang'
            ],
            [
                'name' => 'Dinas Pemadam Kebakaran',
                'desc' => 'Dinas Pemadam Kebakaran',
                'alamat' => 'Jl. Merdeka No.100, Haurpanggung, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'dinas-pemadam-kebakaran'
            ],
            [
                'name' => 'Dinas Pemberdayaan Masyarakat dan Desa',
                'desc' => 'Dinas Pemberdayaan Masyarakat dan Desa',
                'alamat' => 'Jl. Otista No.176, Pasawahan, Kec. Tarogong Kaler, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'dinas-pemberdayaan-masyarakat-dan-desa'
            ],
            [
                'name' => 'Dinas Pemuda dan Olahraga',
                'desc' => 'Dinas Pemuda dan Olahraga',
                'alamat' => 'Jl. Pasundan No.49, Kota Kulon, Kec. Garut Kota, Kabupaten Garut, Jawa Barat 44112',
                'slug' => 'dinas-pemuda-dan-olahraga'
            ],
            [
                'name' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu',
                'desc' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu',
                'alamat' => 'Jl. Patriot No.3, Sukagalih, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'dinas-penanaman-modal-dan-pelayanan-terpadu-satu-pintu'
            ],
            [
                'name' => 'Dinas Pendidikan',
                'desc' => 'Dinas Pendidikan',
                'alamat' => 'Jl. Pembangunan No.179, Sukagalih, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'dinas-pendidikan'
            ],
            [
                'name' => 'Dinas Pengendalian Penduduk, Keluarga Berencana, Pemberdayaan Perempuan dan Perlindungan Anak',
                'desc' => 'Dinas Pengendalian Penduduk, Keluarga Berencana, Pemberdayaan Perempuan dan Perlindungan Anak',
                'alamat' => 'Jl. Terusan Pahlawan No.66, Sukagalih, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'dinas-pengendalian-penduduk-keluarga-berencana-pemberdayaan-perempuan-dan-perlindungan-anak'
            ],
            [
                'name' => 'Dinas Perhubungan',
                'desc' => 'Dinas Perhubungan',
                'alamat' => 'Haurpanggung, Tarogong Kidul, Haurpanggung, Kec. Garut Kota, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'dinas-perhubungan'
            ],
            [
                'name' => 'Dinas Perikanan dan Peternakan',
                'desc' => 'Dinas Perikanan dan Peternakan',
                'alamat' => 'Jl. Bratayuda No.96, Kota Kulon, Kec. Garut Kota, Kabupaten Garut, Jawa Barat 44112',
                'slug' => 'dinas-perikanan-dan-peternakan'
            ],
            [
                'name' => 'Dinas Perindustrian, Perdagangan, Energi dan Sumber Daya Mineral',
                'desc' => 'Dinas Perindustrian, Perdagangan, Energi dan Sumber Daya Mineral',
                'alamat' => 'Jayaraga, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'dinas-perindustrian-perdagangan-energi-dan-sumber-daya-mineral'
            ],
            [
                'name' => 'Dinas Perpustakaan dan Kearsipan',
                'desc' => 'Dinas Perpustakaan dan Kearsipan',
                'alamat' => 'Jalan RSU dr. Slamet No. 8 dan 17, Sukakarya, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'dinas-perpustakaan-dan-kearsipan'
            ],
            [
                'name' => 'Dinas Pertanian',
                'desc' => 'Dinas Pertanian',
                'alamat' => 'JL. Pembangunan, No. 183, Tarogong, Sukajaya, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44154',
                'slug' => 'dinas-pertanian'
            ],
            [
                'name' => 'Dinas Perumahan dan Permukiman',
                'desc' => 'Dinas Perumahan dan Permukiman',
                'alamat' => 'Jl. Raya Samarang No.115, Sukagalih, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'dinas-perumahan-dan-permukiman'
            ],
            [
                'name' => 'Dinas Sosial',
                'desc' => 'Dinas Sosial',
                'alamat' => 'l. Raya Samarang No.115, Sukagalih, Kec. Tarogong Kidul,. Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'dinas-sosial'
            ],
            [
                'name' => 'Dinas Tenaga Kerja dan Transmigrasi',
                'desc' => 'Dinas Tenaga Kerja dan Transmigrasi',
                'alamat' => 'Jl. Guntur Cendana No.1, Haurpanggung, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'dinas-tenaga-kerja-dan-transmigrasi'
            ],
            [
                'name' => 'Inspektorat Daerah',
                'desc' => 'Inspektorat Daerah',
                'alamat' => 'Jl. Patriot No.3, Sukagalih, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'inspektorat-daerah'
            ],
            [
                'name' => 'RSUD DR. Slamet',
                'desc' => 'RSUD DR. Slamet',
                'alamat' => 'Jl.RSU Dr. Slamet No 12, Garut. Tarogong Kidul, 44151',
                'slug' => 'rsud-dr-slamet'
            ],
            [
                'name' => 'Satuan Polisi Pamong Praja',
                'desc' => 'Satuan Polisi Pamong Praja',
                'alamat' => 'Jl. Pahlawan No.51, Sukagalih, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'satuan-polisi-pamong-praja'
            ],
            [
                'name' => 'Sekretariat Daerah',
                'desc' => 'Sekretariat Daerah',
                'alamat' => 'Jl. Pembangunan Tarogong No. 199, Garut, Jawa Barat.',
                'slug' => 'sekretariat-daerah'
            ],
            [
                'name' => 'Sekretariat Dewan Perwakilan Rakyat Daerah',
                'desc' => 'Sekretariat Dewan Perwakilan Rakyat Daerah',
                'alamat' => 'Jl. Patriot No.2, Sukagalih, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151',
                'slug' => 'sekretariat-dewan-perwakilan-rakyat-daerah'
            ],
            [
                'name' => 'Dinas Komunikasi dan Informatika',
                'desc' => 'Dinas Komunikasi dan Informatika',
                'alamat' => 'Jl. Pembangunan No.181, Sukagalih, Tarogong Kidul, Kabupaten Garu',
                'slug' => 'dinas-komunikasi-dan-informatika'
            ],
        ];
        
        DB::statement('ALTER TABLE opd AUTO_INCREMENT = 2;');
        DB::table('opd')->insert($data);
    }
}
