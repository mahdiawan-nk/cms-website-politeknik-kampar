<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Pastikan ada user untuk author_id (ambil ID pertama atau buat jika kosong)
        $authorId = User::first()?->id ?? User::factory()->create([
            'name' => 'Admin Redaksi',
            'email' => 'redaksi@politeknik.ac.id',
        ])->id;

        // 2. Data variasi topik berdasarkan ID Kategori
        $categoriesData = [
            1 => [
                'name_id' => 'Berita',
                'topics' => [
                    ['id' => 'Pelaksanaan Wisuda Gelombang I Politeknik Kampar', 'en' => 'Graduation Ceremony Phase I of Kampar Polytechnic'],
                    ['id' => 'Inovasi Teknologi Terapan Mahasiswa Teknik Pengolahan Sawit', 'en' => 'Applied Technology Innovation by Palm Oil Processing Students'],
                    ['id' => 'Kerjasama Strategis Politeknik Kampar dengan Industri Sawit Nasional', 'en' => 'Strategic Partnership between Kampar Polytechnic and National Palm Oil Industry'],
                    ['id' => 'Politeknik Kampar Raih Penghargaan Kampus Vokasi Inovatif', 'en' => 'Kampar Polytechnic Wins Innovative Vocational Campus Award'],
                    ['id' => 'Kunjungan Kerja Industri dan Studi Banding Akademik Vokasi', 'en' => 'Industrial Visit and Vocational Academic Benchmarking'],
                ],
            ],
            2 => [
                'name_id' => 'Pengumuman',
                'topics' => [
                    ['id' => 'Pengumuman Penerimaan Mahasiswa Baru (PMB) Jalur Beasiswa', 'en' => 'Announcement of New Student Admissions Scholarship Track'],
                    ['id' => 'Jadwal Registrasi Ulang dan Pembayaran UKT Semester Genap', 'en' => 'Re-registration Schedule and Tuition Fee Payment'],
                    ['id' => 'Pemberitahuan Libur Akademik dan Hari Libur Nasional', 'en' => 'Notice of Academic Holiday and National Holidays'],
                    ['id' => 'Prosedur Pengajuan Beasiswa Prestasi dan Kurang Mampu', 'en' => 'Application Procedure for Achievement & Need-Based Scholarships'],
                    ['id' => 'Pengumuman Hasil Seleksi Administrasi Calon Dosen & Tendik', 'en' => 'Announcement of Administrative Selection Results for Faculty & Staff Candidates'],
                ],
            ],
            3 => [
                'name_id' => 'Agenda',
                'topics' => [
                    ['id' => 'Seminar Nasional Teknologi Terapan dan Industri Hijau', 'en' => 'National Seminar on Applied Technology and Green Industry'],
                    ['id' => 'Workshop Digital Marketing dan Kewirausahaan Mahasiswa Vokasi', 'en' => 'Digital Marketing & Vocational Student Entrepreneurship Workshop'],
                    ['id' => 'Job Fair & Career Expo Politeknik Kampar', 'en' => 'Job Fair & Career Expo Kampar Polytechnic'],
                    ['id' => 'Pelatihan K3 Sertifikasi BNSP untuk Mahasiswa Tingkat Akhir', 'en' => 'BNSP Occupational Health and Safety Training for Senior Students'],
                    ['id' => 'Kuliah Umum Bersama Pakar Industri Minyak Kelapa Sawit', 'en' => 'Public Lecture with Palm Oil Industry Experts'],
                ],
            ],
        ];

        // 3. Generasi 25 data per kategori (Total 75 postingan)
        foreach ($categoriesData as $categoryId => $category) {
            $topics = $category['topics'];

            for ($i = 1; $i <= 25; $i++) {
                // Pilih topik secara berulang (round-robin)
                $topic = $topics[($i - 1) % count($topics)];

                $titleId = "{$topic['id']} Vol. {$i}";
                $titleEn = "{$topic['en']} Vol. {$i}";

                // Suffix angka unik 4 digit untuk slug
                $uniqueCode = rand(1000, 9999);
                $slugId = Str::slug($topic['id']) . "-{$i}-{$uniqueCode}";
                $slugEn = Str::slug($topic['en']) . "-{$i}-{$uniqueCode}";

                // Mengatur status publikasi (sebagian published, sebagian draft)
                $isPublished = $i <= 22; // 22 published, 3 draft
                $status = $isPublished ? 'published' : 'draft';
                $publishedAt = $isPublished ? now()->subDays(25 - $i)->subHours(rand(1, 12)) : null;

                Post::create([
                    'category_id' => $categoryId,
                    'author_id'   => $authorId,

                    // Translatable Fields (JSON Multi-Bahasa)
                    'title' => [
                        'id' => $titleId,
                        'en' => $titleEn,
                    ],
                    'slug' => [
                        'id' => $slugId,
                        'en' => $slugEn,
                    ],
                    'excerpt' => [
                        'id' => "Informasi resmi dan detail penting mengenai {$titleId} di lingkungan kampus Politeknik Kampar.",
                        'en' => "Official information and key details regarding {$titleEn} at Kampar Polytechnic campus.",
                    ],
                    'content' => [
                        'id' => "<p>Berikut adalah rincian lengkap mengenai <strong>{$titleId}</strong>.</p><p>Politeknik Kampar terus berkomitmen meningkatkan kualitas pendidikan vokasi berbasis teknologi terapan guna mencetak lulusan unggul, inovatif, dan siap kerja di dunia industri modern.</p><p>Informasi lebih lanjut dapat diakses melalui sekretariat atau bagian layanan mahasiswa.</p>",
                        'en' => "<p>Here are the complete details regarding <strong>{$titleEn}</strong>.</p><p>Kampar Polytechnic remains committed to strengthening vocational education based on applied technology to produce competent, innovative, and industry-ready graduates.</p><p>For further details, please reach out to the campus administration desk.</p>",
                    ],

                    // SEO Multi-Bahasa
                    'meta_title' => [
                        'id' => "{$titleId} | Politeknik Kampar",
                        'en' => "{$titleEn} | Kampar Polytechnic",
                    ],
                    'meta_description' => [
                        'id' => "Baca artikel selengkapnya tentang {$titleId} di website resmi Politeknik Kampar.",
                        'en' => "Read the complete article about {$titleEn} on the official Kampar Polytechnic website.",
                    ],
                    'meta_keywords' => [
                        'id' => strtolower("politeknik kampar, {$category['name_id']}, teknologi terapan, kampus vokasi"),
                        'en' => strtolower("kampar polytechnic, {$category['name_id']}, applied technology, vocational campus"),
                    ],

                    // Non-Translatable Fields
                    'featured_image' => 'posts/featured/sample-' . (($i % 5) + 1) . '.jpg',
                    'og_image'       => null,
                    'canonical_url'  => null,
                    'is_indexable'   => true,
                    'status'         => $status,
                    'published_at'   => $publishedAt,
                ]);
            }
        }
    }
}
