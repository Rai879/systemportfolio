<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PagesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'slug' => 'privacy-policy',
                'title' => 'Kebijakan Privasi',
                'content' => '
                    <p class="text-muted text-end mb-4"><small>Terakhir diperbarui: ' . date('d F Y') . '</small></p>
                    <h2>1. Pengantar</h2>
                    <p>Kami menghargai privasi Anda dan berkomitmen untuk melindungi informasi pribadi yang Anda bagikan dengan kami.</p>
                    <h2>2. Informasi yang Kami Kumpulkan</h2>
                    <p>Kami dapat mengumpulkan informasi seperti Nama, alamat email, nomor telepon, alamat IP, jenis browser, perangkat yang digunakan, dan data log lainnya.</p>
                    <h2>3. Penggunaan Informasi</h2>
                    <ul>
                        <li>Menyediakan dan memelihara layanan kami</li>
                        <li>Memproses permintaan dan pertanyaan Anda</li>
                        <li>Mengirim pembaruan dan komunikasi penting</li>
                    </ul>
                ',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'slug' => 'terms-of-service',
                'title' => 'Syarat & Ketentuan',
                'content' => '
                    <p class="text-muted text-end mb-4"><small>Terakhir diperbarui: ' . date('d F Y') . '</small></p>
                    <h2>1. Ketentuan Umum</h2>
                    <p>Dengan mengakses atau menggunakan situs web kami, Anda setuju untuk terikat oleh Syarat & Ketentuan ini.</p>
                    <h2>2. Penggunaan Layanan</h2>
                    <p>Anda setuju untuk tidak menggunakan situs ini untuk tujuan yang melanggar hukum atau dilarang oleh ketentuan ini.</p>
                    <h2>3. Batasan Tanggung Jawab</h2>
                    <p>Kami tidak bertanggung jawab atas kerugian langsung, tidak langsung, insidental, atau konsekuensial yang timbul dari penggunaan layanan kami.</p>
                ',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('pages')->insertBatch($data);
    }
}
