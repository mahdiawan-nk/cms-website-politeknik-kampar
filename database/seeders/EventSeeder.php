<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel sebelum melakukan seeding
        Event::truncate();

        $events = [
            [
                'title' => [
                    'id' => 'Seminar Internasional: Green Energy & Sustainability Inovasi Industri Kelapa Sawit',
                    'en' => 'International Seminar: Green Energy & Sustainability in Palm Oil Industry Innovations',
                ],
                'location' => [
                    'id' => 'Auditorium Utama Kampus Poltek Kampar',
                    'en' => 'Main Auditorium, Poltek Kampar Campus',
                ],
                'content' => [
                    'id' => '<p>Seminar internasional menghadirkan pakar energi terbarukan dari universitas ternama dan praktisi industri kelapa sawit untuk membahas transisi energi hijau dan pengolahan limbah ramah lingkungan.</p>',
                    'en' => '<p>International seminar featuring renewable energy experts from leading universities and industry practitioners to discuss green energy transition and eco-friendly waste management.</p>',
                ],
                'event_date'     => Carbon::now()->addDays(6)->toDateString(),
                'start_time'     => '08:30:00',
                'end_time'       => '16:00:00',
                'time_zone'      => 'WIB',
                'featured_image' => 'events/seminar-green-energy.jpg',
                'status'         => 'published',
            ],
            [
                'title' => [
                    'id' => 'Workshop Penulisan Jurnal Ilmiah Scopus untuk Dosen dan Peneliti Muda',
                    'en' => 'Scopus Scientific Journal Writing Workshop for Lecturers & Young Researchers',
                ],
                'location' => [
                    'id' => 'Ruang Rapat Multimedia, Gedung A',
                    'en' => 'Multimedia Conference Room, Building A',
                ],
                'content' => [
                    'id' => '<p>Pelatihan intensif pemetaan ide penelitian, teknik bedah artikel, serta strategi menembus jurnal bereputasi terindeks Scopus Q1/Q2 bersama editor jurnal internasional.</p>',
                    'en' => '<p>Intensive training on research mapping, article critique techniques, and strategies for getting published in Scopus Q1/Q2 indexed journals with international editors.</p>',
                ],
                'event_date'     => Carbon::now()->addDays(14)->toDateString(),
                'start_time'     => '09:00:00',
                'end_time'       => '12:30:00',
                'time_zone'      => 'WIB',
                'featured_image' => 'events/workshop-journal.jpg',
                'status'         => 'published',
            ],
            [
                'title' => [
                    'id' => 'Job Fair Vokasi & Rekrutmen Langsung PT Perkebunan Nusantara Group',
                    'en' => 'Vocational Job Fair & Direct Recruitment PT Perkebunan Nusantara Group',
                ],
                'location' => [
                    'id' => 'Gedung Serbaguna Politeknik Kampar',
                    'en' => 'Multipurpose Hall, Politeknik Kampar',
                ],
                'content' => [
                    'id' => '<p>Ajang bursa kerja khusus lulusan diploma dan vokasi. Tersedia puluhan posisi karier untuk lulusan Teknik, Pengolahan Sawit, dan Informatika dengan sistem interview langsung di lokasi.</p>',
                    'en' => '<p>Special job fair for diploma and vocational graduates. Dozens of career openings in Engineering, Palm Processing, and IT with walk-in interviews available.</p>',
                ],
                'event_date'     => Carbon::now()->addDays(22)->toDateString(),
                'start_time'     => '08:00:00',
                'end_time'       => '17:00:00',
                'time_zone'      => 'WIB',
                'featured_image' => 'events/job-fair-2026.jpg',
                'status'         => 'published',
            ],
            [
                'title' => [
                    'id' => 'Kuliah Umum: Penerapan Smart Farming & Agriculture 4.0 di Perkebunan Modern',
                    'en' => 'Public Lecture: Implementation of Smart Farming & Agriculture 4.0 in Modern Plantations',
                ],
                'location' => [
                    'id' => 'Ruang Amphitheater Gedung Laboratorium',
                    'en' => 'Amphitheater Room, Laboratory Building',
                ],
                'content' => [
                    'id' => '<p>Kuliah tamu pemanfaatan sensor IoT, pemetaan drone, dan otomatisasi mekanisasi pertanian dalam meningkatkan efisiensi panen kelapa sawit secara presisi.</p>',
                    'en' => '<p>Guest lecture on IoT sensors, drone mapping, and agricultural mechanization automation to enhance precision harvesting efficiency.</p>',
                ],
                'event_date'     => Carbon::now()->addDays(30)->toDateString(),
                'start_time'     => '10:00:00',
                'end_time'       => '12:00:00',
                'time_zone'      => 'WIB',
                'featured_image' => null,
                'status'         => 'published',
            ],
            [
                'title' => [
                    'id' => 'Upacara Bendera Peringatan HUT Kemerdekaan Republik Indonesia Ke-81',
                    'en' => 'Flag Ceremony for the 81st Independence Day of the Republic of Indonesia',
                ],
                'location' => [
                    'id' => 'Lapangan Utama Kampus Politeknik Kampar',
                    'en' => 'Main Field, Politeknik Kampar Campus',
                ],
                'content' => [
                    'id' => '<p>Pelaksanaan upacara bendera memperingati HUT RI ke-81 wajib dihadiri oleh seluruh dosen, tenaga kependidikan, dan perwakilan organisasi mahasiswa.</p>',
                    'en' => '<p>Commemorative flag ceremony for the 81st Indonesian Independence Day mandatory for all faculty members, staff, and student organization representatives.</p>',
                ],
                'event_date'     => Carbon::parse('2026-08-17')->toDateString(),
                'start_time'     => '07:00:00',
                'end_time'       => '09:30:00',
                'time_zone'      => 'WIB',
                'featured_image' => 'events/upacara-17agustus.jpg',
                'status'         => 'published',
            ],
            [
                'title' => [
                    'id' => 'Pelatihan Sertifikasi K3 Umum & Keselamatan Kerja Pabrik Kelapa Sawit',
                    'en' => 'General OHS Certification & Safety Training in Palm Oil Mills',
                ],
                'location' => [
                    'id' => 'Ruang Pelatihan UPT K3 Kampus',
                    'en' => 'OHS Training Room, Campus Center',
                ],
                'content' => [
                    'id' => '<p>Program pembekalan standar Kesehatan dan Keselamatan Kerja (K3) industri bagi mahasiswa tingkat akhir guna mempersiapkan sertifikasi profesi kerja.</p>',
                    'en' => '<p>Industrial Occupational Health and Safety (OHS) standard training program for final-year students preparing for professional certification.</p>',
                ],
                'event_date'     => Carbon::now()->addDays(40)->toDateString(),
                'start_time'     => '08:00:00',
                'end_time'       => '16:00:00',
                'time_zone'      => 'WIB',
                'featured_image' => null,
                'status'         => 'published',
            ],
            [
                'title' => [
                    'id' => 'Pameran Karya Inovasi Teknologi Terapan (Vokasi Expo 2026)',
                    'en' => 'Applied Technology Innovation Exhibition (Vocational Expo 2026)',
                ],
                'location' => [
                    'id' => 'Plaza Utama Kampus & Area Parkir Barat',
                    'en' => 'Main Plaza & West Parking Area',
                ],
                'content' => [
                    'id' => '<p>Ajang pameran prototype alat industri, olahan pangan lokal, dan produk karya tugas akhir mahasiswa civitas akademika Politeknik Kampar.</p>',
                    'en' => '<p>Exhibition showcase for industrial tool prototypes, local food processing products, and student final project innovations.</p>',
                ],
                'event_date'     => Carbon::now()->addDays(50)->toDateString(),
                'start_time'     => '09:00:00',
                'end_time'       => '16:30:00',
                'time_zone'      => 'WIB',
                'featured_image' => 'events/vokasi-expo.jpg',
                'status'         => 'published',
            ],
            [
                'title' => [
                    'id' => 'Sidang Terbuka Senat Wisuda Ke-XV Sarjana Terapan & Diploma Politeknik Kampar',
                    'en' => '15th Graduation Ceremony of Applied Bachelor & Diploma Politeknik Kampar',
                ],
                'location' => [
                    'id' => 'Grand Ballroom Labersa Hotel / Auditorium Kampus',
                    'en' => 'Grand Ballroom / Campus Auditorium',
                ],
                'content' => [
                    'id' => '<p>Rangkaian wisuda resmi dan pelantikan lulusan program Diploma dan Sarjana Terapan Politeknik Kampar Tahun Akademik 2025/2026.</p>',
                    'en' => '<p>Official graduation ceremony and inauguration of Diploma and Applied Bachelor degree graduates Academic Year 2025/2026.</p>',
                ],
                'event_date'     => Carbon::now()->addDays(75)->toDateString(),
                'start_time'     => '08:00:00',
                'end_time'       => '13:00:00',
                'time_zone'      => 'WIB',
                'featured_image' => 'events/wisuda-2026.jpg',
                'status'         => 'published',
            ],
            // 1 ITEM DRAFT (Uji Coba Filter Draft)
            [
                'title' => [
                    'id' => '[DRAF] Mini Simposium Internasional Pengolahan Limbah Kelapa Sawit',
                    'en' => '[DRAFT] International Mini Symposium on Palm Oil Waste Management',
                ],
                'location' => [
                    'id' => 'Ruang Sidang Utama Gedung Direktorat',
                    'en' => 'Main Meeting Room, Directorate Building',
                ],
                'content' => [
                    'id' => '<p>Draf agenda simposium yang masih dalam tahap pengesahan narasumber internasional.</p>',
                    'en' => '<p>Draft symposium agenda pending finalization with international keynote speakers.</p>',
                ],
                'event_date'     => Carbon::now()->addDays(90)->toDateString(),
                'start_time'     => '09:00:00',
                'end_time'       => '15:00:00',
                'time_zone'      => 'WIB',
                'featured_image' => null,
                'status'         => 'draft',
            ],
            // 1 ITEM ARCHIVED (Uji Coba Filter Past / Archive)
            [
                'title' => [
                    'id' => 'Bootcamp & Workshop Pengembangan Web Modern dengan Laravel & Tailwind CSS',
                    'en' => 'Modern Web Development Bootcamp & Workshop with Laravel & Tailwind CSS',
                ],
                'location' => [
                    'id' => 'Laboratorium Komputer & Jaringan',
                    'en' => 'Computer & Networking Lab',
                ],
                'content' => [
                    'id' => '<p>Kegiatan pelatihan pemrograman web modern periode lalu yang telah selesai dilaksanakan.</p>',
                    'en' => '<p>Archived web development workshop event successfully concluded in the previous term.</p>',
                ],
                'event_date'     => Carbon::now()->subMonths(2)->toDateString(),
                'start_time'     => '08:30:00',
                'end_time'       => '15:30:00',
                'time_zone'      => 'WIB',
                'featured_image' => null,
                'status'         => 'archived',
            ],
        ];

        foreach ($events as $data) {
            Event::create($data);
        }
    }
}
