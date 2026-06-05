<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Iuran;
use App\Models\Kegiatan;
use App\Models\Pengumuman;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Admin
        $admin = User::create([
            'nik' => '1234567890123456',
            'nama' => 'Admin Utama',
            'email' => 'admin@example.com',
            'no_hp' => '08123456789',
            'role' => 'admin',
            'password' => Hash::make('rahasia123'),
        ]);

        // 2. Seed Warga (Citizen)
        $warga = User::create([
            'nik' => '1234567890123457',
            'nama' => 'Budi Santoso',
            'email' => 'warga@example.com',
            'no_hp' => '08123456780',
            'role' => 'warga',
            'password' => Hash::make('rahasia123'),
        ]);

        // 3. Seed Iuran for Warga
        Iuran::create([
            'user_id' => $warga->id,
            'bulan' => 'Januari',
            'tahun' => 2026,
            'nominal' => 50000,
            'status' => 'lunas',
            'tanggal_bayar' => '2026-01-05',
        ]);

        Iuran::create([
            'user_id' => $warga->id,
            'bulan' => 'Februari',
            'tahun' => 2026,
            'nominal' => 50000,
            'status' => 'lunas',
            'tanggal_bayar' => '2026-02-06',
        ]);

        Iuran::create([
            'user_id' => $warga->id,
            'bulan' => 'Maret',
            'tahun' => 2026,
            'nominal' => 50000,
            'status' => 'lunas',
            'tanggal_bayar' => '2026-03-04',
        ]);

        Iuran::create([
            'user_id' => $warga->id,
            'bulan' => 'April',
            'tahun' => 2026,
            'nominal' => 50000,
            'status' => 'belum_bayar',
            'tanggal_bayar' => null,
        ]);

        Iuran::create([
            'user_id' => $warga->id,
            'bulan' => 'Mei',
            'tahun' => 2026,
            'nominal' => 50000,
            'status' => 'belum_bayar',
            'tanggal_bayar' => null,
        ]);

        // 4. Seed Announcements (Pengumuman)
        Pengumuman::create([
            'judul' => 'Agenda Kerja Bakti RT',
            'isi_pengumuman' => 'Diberitahukan kepada seluruh warga RT 01 untuk ikut berpartisipasi dalam kerja bakti massal membersihkan selokan dan fasilitas sosial untuk mengantisipasi musim hujan.',
            'tanggal_mulai' => '2026-06-01',
            'tanggal_selesai' => '2026-06-10',
            'aktif' => true,
        ]);

        Pengumuman::create([
            'judul' => 'Sosialisasi Keamanan Lingkungan',
            'isi_pengumuman' => 'Akan diadakan sosialisasi penting mengenai keamanan lingkungan komplek perumahan bekerja sama dengan Bhabinkamtibmas setempat. Kehadiran perwakilan setiap KK sangat diharapkan.',
            'tanggal_mulai' => '2026-06-03',
            'tanggal_selesai' => '2026-06-15',
            'aktif' => true,
        ]);

        // 5. Seed Activities (Kegiatan)
        Kegiatan::create([
            'judul' => 'Kerja Bakti Massal RT 01',
            'tanggal' => '2026-06-07',
            'deskripsi' => 'Kerja bakti pembersihan lingkungan komplek, saluran pembuangan air, serta penataan area taman bermain anak.',
            'lokasi' => 'Area Fasum Komplek RT 01',
            'foto' => null,
        ]);

        Kegiatan::create([
            'judul' => 'Rapat Rutin Pengurus & Warga',
            'tanggal' => '2026-06-15',
            'deskripsi' => 'Rapat bulanan untuk membahas evaluasi kas keuangan RT, rencana peremajaan pos satpam, serta koordinasi keamanan lingkungan.',
            'lokasi' => 'Balai Pertemuan RT 01',
            'foto' => null,
        ]);
    }
}
