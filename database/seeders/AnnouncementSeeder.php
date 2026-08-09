<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel sebelum melakukan seeding
        Announcement::truncate();

        $announcements = [
            [
                'title' => [
                    'id' => 'Pengumuman Pelaksanaan Ujian Akhir Semester (UAS) Genap TA 2025/2026',
                    'en' => 'Announcement of Even Semester Final Examination Schedule AY 2025/2026',
                ],
                'badge' => ['id' => 'Akademik', 'en' => 'Academic'],
                'content' => [
                    'id' => '<p>Diberitahukan kepada seluruh mahasiswa bahwa Pelaksanaan Ujian Akhir Semester (UAS) Genap TA 2025/2026 akan dilaksanakan secara tatap muka. Harap menyelesaikan administrasi UKT sebelum mencetak kartu ujian.</p>',
                    'en' => '<p>All students are informed that the Even Semester Final Examinations AY 2025/2026 will be held in person. Please complete your tuition fee administration before printing examination cards.</p>',
                ],
                'is_important' => true,
                'published_at' => Carbon::now()->subDays(2),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Pemberitahuan Libur Nasional Hari Kemerdekaan dan Cuti Bersama Kampus',
                    'en' => 'Notice of National Independence Day Holiday and Campus Joint Leave',
                ],
                'badge' => ['id' => 'Umum', 'en' => 'General'],
                'content' => [
                    'id' => '<p>Dalam rangka memperingati Hari Kemerdekaan Republik Indonesia, seluruh kegiatan perkuliahan dan pelayanan administrasi kampus ditiadakan pada tanggal 17-18 Agustus.</p>',
                    'en' => '<p>In celebration of the Independence Day of the Republic of Indonesia, all lecture activities and administrative services will be suspended on August 17-18.</p>',
                ],
                'is_important' => false,
                'published_at' => Carbon::now()->subDays(4),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Alur Pendaftaran Ulang Mahasiswa Baru Jalur Beasiswa Ikatan Dinas PT Sawit Sejahtera',
                    'en' => 'Re-registration Flow for New Students via PT Sawit Sejahtera Service Scholarship',
                ],
                'badge' => ['id' => 'PMB', 'en' => 'Admissions'],
                'content' => [
                    'id' => '<p>Mahasiswa baru yang dinyatakan lolos seleksi beasiswa wajib mengunggah dokumen persyaratam melalui portal PMB resmi sebelum batas waktu yang ditentukan.</p>',
                    'en' => '<p>New students accepted under the scholarship program are required to upload verification documents through the official admissions portal before the deadline.</p>',
                ],
                'is_important' => true,
                'published_at' => Carbon::now()->subDays(7),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Panduan Pengajuan Proposal Program Kreativitas Mahasiswa (PKM) Kemendikbud',
                    'en' => 'Guidelines for Submitting Student Creativity Program (PKM) Proposals',
                ],
                'badge' => ['id' => 'Kemahasiswaan', 'en' => 'Student Affairs'],
                'content' => [
                    'id' => '<p>Tim Program Kreativitas Mahasiswa (PKM) yang akan mengajukan proposal dapat mengunduh panduan penyusunan format terbaru tahun 2026 pada lampiran berikut.</p>',
                    'en' => '<p>Student Creativity Program (PKM) teams submitting proposals can download the latest 2026 formatting guidelines in the attachment below.</p>',
                ],
                'is_important' => false,
                'published_at' => Carbon::now()->subDays(10),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Jadwal Pemeliharaan Rutin Server Sistem Informasi Akademik (SIAKAD)',
                    'en' => 'Scheduled Maintenance Notice for Academic Information System (SIAKAD)',
                ],
                'badge' => ['id' => 'Layanan', 'en' => 'Services'],
                'content' => [
                    'id' => '<p>Layanan SIAKAD tidak dapat diakses sementara pada hari Sabtu mulai pukul 22.00 WIB hingga Minggu pukul 06.00 WIB dalam rangka peningkatan performa server.</p>',
                    'en' => '<p>SIAKAD services will be temporarily unavailable on Saturday from 10:00 PM WIB to Sunday 06:00 AM WIB for server performance upgrades.</p>',
                ],
                'is_important' => false,
                'published_at' => Carbon::now()->subDays(12),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Prosedur dan Syarat Pengajuan Bebas Pustaka Perpustakaan Pusat',
                    'en' => 'Procedures and Requirements for Central Library Clearance',
                ],
                'badge' => ['id' => 'Layanan', 'en' => 'Services'],
                'content' => [
                    'id' => '<p>Bagi mahasiswa tingkat akhir yang membutuhkan Surat Bebas Pustaka untuk syarat wisuda, silakan mengembalikan seluruh pinjaman buku dan menyerahkan draf tugas akhir.</p>',
                    'en' => '<p>For final-year students needing Library Clearance Certificate for graduation, please return all borrowed books and submit final thesis drafts.</p>',
                ],
                'is_important' => false,
                'published_at' => Carbon::now()->subDays(15),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Pembukaan Pendaftaran Pertukaran Mahasiswa Merdeka (PMM) Angkatan V',
                    'en' => 'Registration Open for Independent Student Exchange (PMM) Batch V',
                ],
                'badge' => ['id' => 'Kemahasiswaan', 'en' => 'Student Affairs'],
                'content' => [
                    'id' => '<p>Pendaftaran Program Pertukaran Mahasiswa Merdeka telah dibuka. Mahasiswa semester 3 dan 5 yang berminat dapat berkonsultasi dengan DPA masing-masing.</p>',
                    'en' => '<p>Registration for the Independent Student Exchange Program is now open. Interested 3rd and 5th-semester students may consult their academic advisors.</p>',
                ],
                'is_important' => true,
                'published_at' => Carbon::now()->subDays(18),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Jadwal Pembayaran UKT/SPP Semester Ganjil TA 2026/2027',
                    'en' => 'Tuition Fee Payment Schedule for Odd Semester Academic Year 2026/2027',
                ],
                'badge' => ['id' => 'Akademik', 'en' => 'Academic'],
                'content' => [
                    'id' => '<p>Pembayaran UKT/SPP dapat dilakukan melalui Bank Mitra terdekat atau M-Banking mulai tanggal 1 hingga 20 bulan depan.</p>',
                    'en' => '<p>Tuition payments can be made through partner banks or mobile banking apps from the 1st to the 20th of next month.</p>',
                ],
                'is_important' => true,
                'published_at' => Carbon::now()->subDays(20),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Pendaftaran Yudisium Gelombang III Fakultas Teknik & Vokasi',
                    'en' => 'Registration for Phase III Graduation Clearance (Yudisium) Engineering & Vocational Faculty',
                ],
                'badge' => ['id' => 'Akademik', 'en' => 'Academic'],
                'content' => [
                    'id' => '<p>Pendaftaran yudisium ditutup pada akhir bulan ini. Diharapkan seluruh calon wisudawan telah melengkapi validasi nilai dan bebas revisi penguji.</p>',
                    'en' => '<p>Yudisium registration closes at the end of this month. All prospective graduates are expected to complete grade validation and examiner revisions.</p>',
                ],
                'is_important' => false,
                'published_at' => Carbon::now()->subDays(22),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Edaran Rekrutmen Terbuka Asisten Laboratorium Komputer dan Pengolahan Sawit',
                    'en' => 'Open Recruitment Notice for Computer & Palm Oil Processing Lab Assistants',
                ],
                'badge' => ['id' => 'Karir', 'en' => 'Career'],
                'content' => [
                    'id' => '<p>Laboratorium membuka kesempatan bagi mahasiswa minimal semester 5 yang memiliki nilai matakuliah minimal B+ untuk menjadi Asisten Praktikum.</p>',
                    'en' => '<p>The laboratory opens opportunities for students (minimum semester 5) with a minimum course grade of B+ to become Lab Assistants.</p>',
                ],
                'is_important' => false,
                'published_at' => Carbon::now()->subDays(25),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Sosialisasi Bahaya Narkoba dan Edukasi Kesehatan Reproduksi Remaja',
                    'en' => 'Anti-Drug Campaign and Youth Reproductive Health Education Session',
                ],
                'badge' => ['id' => 'Kemahasiswaan', 'en' => 'Student Affairs'],
                'content' => [
                    'id' => '<p>Bekerjasama dengan BNN, kampus mengadakan sosialisasi pencegahan penyalahgunaan narkotika yang wajib diikuti seluruh mahasiswa tingkat satu.</p>',
                    'en' => '<p>In collaboration with BNN, the university conducts a narcotics prevention campaign mandatory for all first-year students.</p>',
                ],
                'is_important' => false,
                'published_at' => Carbon::now()->subDays(28),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Pendaftaran Program Pelatihan Bahasa Inggris dan Tes Sertifikasi TOEFL',
                    'en' => 'Registration for English Training Program and TOEFL Certification Test',
                ],
                'badge' => ['id' => 'Layanan', 'en' => 'Services'],
                'content' => [
                    'id' => '<p>UUP Bahasa membuka pendaftaran intensive TOEFL Preparation Course untuk persiapan syarat pendamping ijazah (SKPI).</p>',
                    'en' => '<p>The Language Center opens registration for an intensive TOEFL Preparation Course in preparation for diploma supplement requirements.</p>',
                ],
                'is_important' => false,
                'published_at' => Carbon::now()->subDays(30),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Pengumuman Hasil Seleksi Penerima Beasiswa Kemitraan Industri',
                    'en' => 'Selection Results Announcement for Industrial Partnership Scholarships',
                ],
                'badge' => ['id' => 'Beasiswa', 'en' => 'Scholarship'],
                'content' => [
                    'id' => '<p>Selamat kepada pendaftar yang dinyatakan lolos tahap wawancara akhir. Daftar nama penerima manfaat dapat diunduh pada dokumen terlampir.</p>',
                    'en' => '<p>Congratulations to candidates who passed the final interview phase. The list of beneficiaries is available in the attached document.</p>',
                ],
                'is_important' => true,
                'published_at' => Carbon::now()->subDays(33),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Panduan Pengisian Kartu Rencana Studi (KRS) Online Semester Ganjil',
                    'en' => 'Guide to Online Study Plan Card (KRS) Filling for Odd Semester',
                ],
                'badge' => ['id' => 'Akademik', 'en' => 'Academic'],
                'content' => [
                    'id' => '<p>Pengisian KRS wajib diawali dengan konsultasi Dosen Pembimbing Akademik (DPA). Pastikan tidak terjadi bentrok jadwal kuliah yang dipilih.</p>',
                    'en' => '<p>Online KRS submission must begin with an Academic Advisor consultation. Ensure no schedule conflicts exist in selected courses.</p>',
                ],
                'is_important' => false,
                'published_at' => Carbon::now()->subDays(35),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Pemberitahuan Uji Coba Jaringan Wi-Fi Baru di Area Perpustakaan dan Gedung Kuliah',
                    'en' => 'Notice of New Wi-Fi Network Trial at Library and Lecture Buildings',
                ],
                'badge' => ['id' => 'Fasilitas', 'en' => 'Facilities'],
                'content' => [
                    'id' => '<p>Unit UPT Komputer sedang melakukan peningkatan bandwidth Wi-Fi kampus. Mahasiswa dapat mengoneksikan perangkat menggunakan akun SSO masing-masing.</p>',
                    'en' => '<p>IT Support Unit is upgrading campus Wi-Fi bandwidth. Students can connect their devices using their respective SSO accounts.</p>',
                ],
                'is_important' => false,
                'published_at' => Carbon::now()->subDays(40),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Pelaksanaan Program Vaksinasi Booster dan Pemeriksaan Kesehatan Gratis',
                    'en' => 'Booster Vaccination Program and Free Health Checkup Event',
                ],
                'badge' => ['id' => 'Umum', 'en' => 'General'],
                'content' => [
                    'id' => '<p>Klinik Pratama Kampus menyelenggarakan layanan pemeriksaan kesehatan gratis meliputi tekanan darah, gula darah, dan vaksinasi booster gratis.</p>',
                    'en' => '<p>Campus Health Clinic provides free medical checkups including blood pressure, blood sugar, and free booster vaccinations.</p>',
                ],
                'is_important' => false,
                'published_at' => Carbon::now()->subDays(45),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Kompetisi Inovasi Vokasi Terapan Nasional (KIVTN) 2026',
                    'en' => 'National Applied Vocational Innovation Competition (KIVTN) 2026',
                ],
                'badge' => ['id' => 'Kemahasiswaan', 'en' => 'Student Affairs'],
                'content' => [
                    'id' => '<p>Undangan bagi civitas akademika untuk berpartisipasi dalam ajang kompetisi inovasi teknologi terapan berskala nasional.</p>',
                    'en' => '<p>Invitation for academic members to participate in the national-scale applied technology innovation competition.</p>',
                ],
                'is_important' => false,
                'published_at' => Carbon::now()->subDays(50),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Aturan Penggunaan Parkir Kendaraan Roda Dua dan Roda Empat Dalam Kampus',
                    'en' => 'Regulations on Two-Wheeled and Four-Wheeled Vehicle Parking On Campus',
                ],
                'badge' => ['id' => 'Fasilitas', 'en' => 'Facilities'],
                'content' => [
                    'id' => '<p>Seluruh civitas akademika diwajibkan menempelkan stiker parkir resmi kampus demi menjaga keamanan serta kerapian lokasi parkir.</p>',
                    'en' => '<p>All campus members are required to display official parking stickers to maintain security and order in parking areas.</p>',
                ],
                'is_important' => false,
                'published_at' => Carbon::now()->subDays(55),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Undangan Pemilihan Umum Mahasiswa (PEMIRA) Ketua & Wakil BEM',
                    'en' => 'Invitation to Student General Election (PEMIRA) for BEM Chair & Vice Chair',
                ],
                'badge' => ['id' => 'Kemahasiswaan', 'en' => 'Student Affairs'],
                'content' => [
                    'id' => '<p>Gunakan hak pilih Anda secara bijak dalam Pemilihan Umum Mahasiswa secara elektronik (E-Voting) pada portal yang telah disediakan.</p>',
                    'en' => '<p>Exercise your voting rights wisely in the Electronic Student General Election (E-Voting) via the designated portal.</p>',
                ],
                'is_important' => false,
                'published_at' => Carbon::now()->subDays(60),
                'status' => 'published',
            ],
            [
                'title' => [
                    'id' => 'Batas Akhir Penyerahan Berkas Bebas Pinjam Alat Laboratorium Praktikum',
                    'en' => 'Deadline for Submitting Laboratory Equipment Clearance Forms',
                ],
                'badge' => ['id' => 'Akademik', 'en' => 'Academic'],
                'content' => [
                    'id' => '<p>Mahasiswa yang melakukan kegiatan penelitian wajib mengembalikan alat praktikum dan mendapatkan pengesahan dari Pranata Laboratorium Pendidikan.</p>',
                    'en' => '<p>Students conducting research activities must return lab equipment and obtain sign-off from Educational Lab Technicians.</p>',
                ],
                'is_important' => false,
                'published_at' => Carbon::now()->subDays(65),
                'status' => 'published',
            ],
            // 3 ITEM DRAFT (Untuk pengujian filter status)
            [
                'title' => [
                    'id' => '[DRAF] Rencana Pelaksanaan Kuliah Lapangan Industri Kelapa Sawit',
                    'en' => '[DRAFT] Implementation Plan for Palm Oil Industrial Field Study',
                ],
                'badge' => ['id' => 'Akademik', 'en' => 'Academic'],
                'content' => [
                    'id' => '<p>Draft pengumuman rencana peninjauan lapangan mahasiswa ke kebun dan pabrik pengolahan kelapa sawit mitra.</p>',
                    'en' => '<p>Draft announcement for student field study visits to partner palm oil plantations and processing mills.</p>',
                ],
                'is_important' => false,
                'published_at' => null,
                'status' => 'draft',
            ],
            [
                'title' => [
                    'id' => '[DRAF] Pembukaan Pendaftaran Program Magang Bersertifikat (MBKM)',
                    'en' => '[DRAFT] Registration Open for Certified Internship Program (MBKM)',
                ],
                'badge' => ['id' => 'Karir', 'en' => 'Career'],
                'content' => [
                    'id' => '<p>Konsep informasi kuota magang industri BUMN dan Swasta semester depan.</p>',
                    'en' => '<p>Concept note for SOE and private industry internship quotas for next semester.</p>',
                ],
                'is_important' => false,
                'published_at' => null,
                'status' => 'draft',
            ],
            // 3 ITEM ARCHIVED (Untuk pengujian arsip)
            [
                'title' => [
                    'id' => 'Jadwal Wisuda Sarjana Terapan & Diploma Periode I TA 2024/2025',
                    'en' => 'Applied Bachelor & Diploma Graduation Schedule Phase I AY 2024/2025',
                ],
                'badge' => ['id' => 'Akademik', 'en' => 'Academic'],
                'content' => [
                    'id' => '<p>Arsip pengumuman wisuda periode lalu yang telah selesai dilaksanakan.</p>',
                    'en' => '<p>Archived announcement from the previous completed graduation ceremony.</p>',
                ],
                'is_important' => false,
                'published_at' => Carbon::now()->subYear(),
                'status' => 'archived',
            ],
            [
                'title' => [
                    'id' => 'Pengadaan Lomba Karya Tulis Ilmiah Mahasiswa Vokasi 2025',
                    'en' => 'Vocational Student Scientific Writing Competition 2025',
                ],
                'badge' => ['id' => 'Kemahasiswaan', 'en' => 'Student Affairs'],
                'content' => [
                    'id' => '<p>Arsip informasi perlombaan karya ilmiah tahun sebelumnya.</p>',
                    'en' => '<p>Archived information regarding last year\'s scientific paper competition.</p>',
                ],
                'is_important' => false,
                'published_at' => Carbon::now()->subMonths(10),
                'status' => 'archived',
            ],
            [
                'title' => [
                    'id' => 'Pendaftaran Beasiswa Unggulan Mahasiswa Berprestasi Tahun 2025',
                    'en' => 'Out-standing Student Excellence Scholarship Registration 2025',
                ],
                'badge' => ['id' => 'Beasiswa', 'en' => 'Scholarship'],
                'content' => [
                    'id' => '<p>Arsip penerimaan beasiswa unggulan periode lalu.</p>',
                    'en' => '<p>Archived excellence scholarship intake from the previous period.</p>',
                ],
                'is_important' => false,
                'published_at' => Carbon::now()->subMonths(8),
                'status' => 'archived',
            ],
        ];

        foreach ($announcements as $data) {
            Announcement::create($data);
        }
    }
}
