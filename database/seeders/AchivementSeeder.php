<?php

namespace Database\Seeders;

use App\Enums\AchievementLevel;
use App\Enums\AchievementType;
use App\Models\Achivement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AchivementSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        $sampleAchivements = [
            [
                'title' => [
                    'id' => 'Juara 1 World AI Hackathon 2025',
                    'en' => '1st Place World AI Hackathon 2025',
                ],
                'category' => ['id' => 'AKADEMIK', 'en' => 'ACADEMIC'],
                'type' => AchievementType::COMPETITION,
                'level' => AchievementLevel::INTERNATIONAL,
                'year' => 2025,
                'organizer' => ['id' => 'Teknik Informatika', 'en' => 'Informatics Engineering'],
                'description' => [
                    'id' => 'Tim Robotics berhasil meraih medali emas dengan inovasi pendeteksi bencana berbasis Artificial Intelligence.',
                    'en' => 'Robotics team won the gold medal with an AI-based disaster detection innovation.',
                ],
                'is_featured' => true,
            ],
            [
                'title' => [
                    'id' => 'Medali Emas POMNAS Basket Putra',
                    'en' => 'Gold Medal POMNAS Men Basketball',
                ],
                'category' => ['id' => 'OLAHRAGA', 'en' => 'SPORTS'],
                'type' => AchievementType::COMPETITION,
                'level' => AchievementLevel::NATIONAL,
                'year' => 2025,
                'organizer' => ['id' => 'UKM Olahraga', 'en' => 'Sports Student Club'],
                'description' => [
                    'id' => 'Tim Basket Putra berhasil mempertahankan gelar juara bertahan dalam Pekan Olahraga Mahasiswa Nasional.',
                    'en' => 'Men Basketball Team successfully defended their championship title at the National Student Sports Week.',
                ],
                'is_featured' => true,
            ],
            [
                'title' => [
                    'id' => 'Grand Prix Choir Competition Praha',
                    'en' => 'Praha Grand Prix Choir Competition Winner',
                ],
                'category' => ['id' => 'SENI & BUDAYA', 'en' => 'ARTS & CULTURE'],
                'type' => AchievementType::COMPETITION,
                'level' => AchievementLevel::INTERNATIONAL,
                'year' => 2024,
                'organizer' => ['id' => 'PSM Kampus', 'en' => 'University Student Choir'],
                'description' => [
                    'id' => 'Paduan Suara Mahasiswa memenangkan kategori Folklore pada kompetisi internasional di Praha.',
                    'en' => 'Student Choir won the Folklore category at the international competition in Prague.',
                ],
                'is_featured' => true,
            ],
            [
                'title' => [
                    'id' => 'Paten Terdaftar: Sensor Kualitas Air IoT',
                    'en' => 'Registered Patent: IoT Water Quality Sensor',
                ],
                'category' => ['id' => 'INOBAS & TEKNOLOGI', 'en' => 'INNOVATION & TECH'],
                'type' => AchievementType::PATENT,
                'level' => AchievementLevel::NATIONAL,
                'year' => 2025,
                'organizer' => ['id' => 'Teknik Elektro', 'en' => 'Electrical Engineering'],
                'description' => [
                    'id' => 'Pendaftaran paten resmi untuk alat pemantau pH dan polutan air otomatis berbasis telemetri IoT.',
                    'en' => 'Official patent registration for an automated IoT telemetry-based water pH and pollutant monitoring device.',
                ],
                'is_featured' => true,
            ],
            [
                'title' => [
                    'id' => 'Hibah Penelitian Kedaireka Matching Fund',
                    'en' => 'Kedaireka Matching Fund Research Grant',
                ],
                'category' => ['id' => 'PENELITIAN', 'en' => 'RESEARCH'],
                'type' => AchievementType::RESEARCH_GRANT,
                'level' => AchievementLevel::NATIONAL,
                'year' => 2024,
                'organizer' => ['id' => 'LPPM Kampus', 'en' => 'Institute for Research & Community Service'],
                'description' => [
                    'id' => 'Riset komersialisasi alat pengolah limbah kelapa sawit meraih dana hibah dari Kemendikbudristek.',
                    'en' => 'Research on the commercialization of palm oil waste processing equipment secured a grant from the Ministry.',
                ],
                'is_featured' => true,
            ],
            [
                'title' => [
                    'id' => 'Juara 1 Kontes Mobil Hemat Energi (KMHE)',
                    'en' => '1st Place Energy-Efficient Vehicle Contest',
                ],
                'category' => ['id' => 'AKADEMIK', 'en' => 'ACADEMIC'],
                'type' => AchievementType::COMPETITION,
                'level' => AchievementLevel::NATIONAL,
                'year' => 2025,
                'organizer' => ['id' => 'Teknik Mesin', 'en' => 'Mechanical Engineering'],
                'description' => [
                    'id' => 'Mobil prototipe listrik berhasil mencatatkan rekor efisiensi konsumsi daya tertinggi.',
                    'en' => 'The prototype electric vehicle recorded the highest power efficiency record.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Publikasi Jurnal Scopus Q1 IEEE Transactions',
                    'en' => 'IEEE Transactions Scopus Q1 Journal Publication',
                ],
                'category' => ['id' => 'PUBLIKASI', 'en' => 'PUBLICATION'],
                'type' => AchievementType::PUBLICATION,
                'level' => AchievementLevel::INTERNATIONAL,
                'year' => 2026,
                'organizer' => ['id' => 'Teknik Informatika', 'en' => 'Informatics Engineering'],
                'description' => [
                    'id' => 'Publikasi ilmiah mahasiswa dan dosen tentang algoritma optimasi jaringan smart grid.',
                    'en' => 'Scientific publication by students and lecturers on smart grid network optimization algorithms.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Juara 1 National Cyber Security Contest',
                    'en' => '1st Winner National Cyber Security Contest',
                ],
                'category' => ['id' => 'AKADEMIK', 'en' => 'ACADEMIC'],
                'type' => AchievementType::COMPETITION,
                'level' => AchievementLevel::NATIONAL,
                'year' => 2025,
                'organizer' => ['id' => 'Cyber Security Club', 'en' => 'Cyber Security Club'],
                'description' => [
                    'id' => 'Tim Cyber berhasil menyelesaikan tantangan Capture The Flag (CTF) kategori infrastruktur kritis.',
                    'en' => 'Cyber Team successfully completed the Capture The Flag (CTF) challenge in critical infrastructure.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Paten HKI: Bioplastik Limbah Tapioka',
                    'en' => 'IPR Patent: Tapioca Waste Bioplastic',
                ],
                'category' => ['id' => 'INOVASI', 'en' => 'INNOVATION'],
                'type' => AchievementType::PATENT,
                'level' => AchievementLevel::NATIONAL,
                'year' => 2024,
                'organizer' => ['id' => 'Teknik Pengolahan Sawit', 'en' => 'Palm Oil Processing Tech'],
                'description' => [
                    'id' => 'Inovasi plastik ramah lingkungan yang terurai penuh dalam tanah kurang dari 30 hari.',
                    'en' => 'Eco-friendly plastic innovation that fully degrades in soil in under 30 days.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Medali Perak World Skills Asia Competition',
                    'en' => 'Silver Medal World Skills Asia Competition',
                ],
                'category' => ['id' => 'AKADEMIK', 'en' => 'ACADEMIC'],
                'type' => AchievementType::COMPETITION,
                'level' => AchievementLevel::INTERNATIONAL,
                'year' => 2024,
                'organizer' => ['id' => 'Teknik Otomasi Industri', 'en' => 'Industrial Automation Tech'],
                'description' => [
                    'id' => 'Prestasi gemilang pada bidang Mechanical Engineering CAD tingkat Asia.',
                    'en' => 'Outstanding achievement in Mechanical Engineering CAD at the Asian level.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Juara 2 Pekan Ilmiah Mahasiswa Nasional (PIMNAS)',
                    'en' => '2nd Place National Student Scientific Week',
                ],
                'category' => ['id' => 'AKADEMIK', 'en' => 'ACADEMIC'],
                'type' => AchievementType::COMPETITION,
                'level' => AchievementLevel::NATIONAL,
                'year' => 2025,
                'organizer' => ['id' => 'UKM Penelitian & Riset', 'en' => 'Research Student Club'],
                'description' => [
                    'id' => 'Penelitian kategori PKM-Kewirausahaan berhasil menyabet medali perak.',
                    'en' => 'Research in the Entrepreneurship category won the silver medal.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Hibah Research Grant Bank Indonesia',
                    'en' => 'Bank Indonesia Research Grant Award',
                ],
                'category' => ['id' => 'PENELITIAN', 'en' => 'RESEARCH'],
                'type' => AchievementType::RESEARCH_GRANT,
                'level' => AchievementLevel::NATIONAL,
                'year' => 2025,
                'organizer' => ['id' => 'Keuangan & Perbankan', 'en' => 'Finance & Banking'],
                'description' => [
                    'id' => 'Pemenang dana riset nasional pengembangan ekosistem pembayaran digital UMKM.',
                    'en' => 'Winner of national research funding for MSME digital payment ecosystem development.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Juara 1 Debat Bahasa Inggris NADC Regional',
                    'en' => '1st Champion NADC Regional English Debate',
                ],
                'category' => ['id' => 'AKADEMIK', 'en' => 'ACADEMIC'],
                'type' => AchievementType::COMPETITION,
                'level' => AchievementLevel::REGIONAL,
                'year' => 2025,
                'organizer' => ['id' => 'English Student Club', 'en' => 'English Student Club'],
                'description' => [
                    'id' => 'Tim Debat berhasil melaju ke tingkat nasional setelah mendominasi babak final regional.',
                    'en' => 'Debate Team advanced to national level after dominating the regional finals.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Juara 1 Pekan Olahraga Daerah (PORDA) Taekwondo',
                    'en' => '1st Gold Medal Regional Sports Week Taekwondo',
                ],
                'category' => ['id' => 'OLAHRAGA', 'en' => 'SPORTS'],
                'type' => AchievementType::COMPETITION,
                'level' => AchievementLevel::REGIONAL,
                'year' => 2024,
                'organizer' => ['id' => 'UKM Taekwondo', 'en' => 'Taekwondo Student Club'],
                'description' => [
                    'id' => 'Atlet mahasiswa merebut medali emas kelas kyorugi under 63kg.',
                    'en' => 'Student athlete claimed the gold medal in kyorugi under 63kg category.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Penghargaan Green Campus Sustainable Award',
                    'en' => 'Green Campus Sustainable Award Recognition',
                ],
                'category' => ['id' => 'PENGHARGAAN', 'en' => 'AWARD'],
                'type' => AchievementType::AWARD,
                'level' => AchievementLevel::NATIONAL,
                'year' => 2025,
                'organizer' => ['id' => 'Pusat Pengelolaan Lingkungan', 'en' => 'Environmental Management Center'],
                'description' => [
                    'id' => 'Penghargaan nasional atas konsistensi penerapan green-technology di lingkungan kampus.',
                    'en' => 'National award for consistency in applying green technology across campus.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Paten Alat Pemisah Cangkang Sawit Otomatis',
                    'en' => 'Patent for Automatic Palm Shell Separator',
                ],
                'category' => ['id' => 'PATEN', 'en' => 'PATENT'],
                'type' => AchievementType::PATENT,
                'level' => AchievementLevel::NATIONAL,
                'year' => 2024,
                'organizer' => ['id' => 'Teknik Mesin', 'en' => 'Mechanical Engineering'],
                'description' => [
                    'id' => 'Paten inovasi mekanik yang meningkatkan efisiensi pemisahan limbah hingga 40%.',
                    'en' => 'Mechanical innovation patent boosting waste separation efficiency by up to 40%.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Juara 1 International Student Innovation Fair (ISIF)',
                    'en' => '1st Gold Award International Student Innovation Fair',
                ],
                'category' => ['id' => 'AKADEMIK', 'en' => 'ACADEMIC'],
                'type' => AchievementType::COMPETITION,
                'level' => AchievementLevel::INTERNATIONAL,
                'year' => 2025,
                'organizer' => ['id' => 'Teknik Informatika', 'en' => 'Informatics Engineering'],
                'description' => [
                    'id' => 'Inovasi aplikasi deteksi dini penyakit tanaman berbasis Computer Vision meraih Gold Award.',
                    'en' => 'Computer Vision-based plant disease detection app innovation earned the Gold Award.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Publikasi International Conference on Green Tech (ICGT)',
                    'en' => 'Publication at International Conference on Green Tech',
                ],
                'category' => ['id' => 'PUBLIKASI', 'en' => 'PUBLICATION'],
                'type' => AchievementType::PUBLICATION,
                'level' => AchievementLevel::INTERNATIONAL,
                'year' => 2025,
                'organizer' => ['id' => 'Teknik Elektro', 'en' => 'Electrical Engineering'],
                'description' => [
                    'id' => 'Paper ilmiah terpilih sebagai Best Presenter pada konferensi internasional di Singapura.',
                    'en' => 'Scientific paper selected as Best Presenter at an international conference in Singapore.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Juara 1 Business Plan Competition Young Entrepreneur',
                    'en' => '1st Champion Young Entrepreneur Business Plan',
                ],
                'category' => ['id' => 'KEWIRAUSAHAAN', 'en' => 'ENTREPRENEURSHIP'],
                'type' => AchievementType::COMPETITION,
                'level' => AchievementLevel::NATIONAL,
                'year' => 2025,
                'organizer' => ['id' => 'Inkubator Bisnis', 'en' => 'Business Incubator'],
                'description' => [
                    'id' => 'Startup mahasiswa berbasis pengolahan kompos organik meraih pendanaan modal usaha.',
                    'en' => 'Student startup based on organic compost processing secured seed funding.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Juara 1 Festival Seni Mahasiswa Daerah (PEKSIMIDA)',
                    'en' => '1st Winner Regional Student Art Festival',
                ],
                'category' => ['id' => 'SENI & BUDAYA', 'en' => 'ARTS & CULTURE'],
                'type' => AchievementType::COMPETITION,
                'level' => AchievementLevel::REGIONAL,
                'year' => 2024,
                'organizer' => ['id' => 'UKM Fotografi & Seni', 'en' => 'Photography & Arts Club'],
                'description' => [
                    'id' => 'Karya fotografi jurnalistik mahasiswa memenangkan Juara 1 tingkat provinsi.',
                    'en' => 'Student journalistic photography work won 1st Place at the provincial level.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Hibah Riset Penelitian Dosen Pemula (PDP) BRIN',
                    'en' => 'BRIN Early Career Researcher Grant',
                ],
                'category' => ['id' => 'PENELITIAN', 'en' => 'RESEARCH'],
                'type' => AchievementType::RESEARCH_GRANT,
                'level' => AchievementLevel::NATIONAL,
                'year' => 2025,
                'organizer' => ['id' => 'LPPM Kampus', 'en' => 'Institute for Research & Community Service'],
                'description' => [
                    'id' => 'Kolaborasi riset pemetaan potensi energi terbarukan lokal didanai BRIN.',
                    'en' => 'Collaborative research mapping local renewable energy potential funded by BRIN.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Juara 1 Hackathon Smart City Kominfo',
                    'en' => '1st Champion Smart City Hackathon Kominfo',
                ],
                'category' => ['id' => 'AKADEMIK', 'en' => 'ACADEMIC'],
                'type' => AchievementType::COMPETITION,
                'level' => AchievementLevel::NATIONAL,
                'year' => 2025,
                'organizer' => ['id' => 'Teknik Informatika', 'en' => 'Informatics Engineering'],
                'description' => [
                    'id' => 'Solusi transportasi publik terpadu berbasis IoT memenangkan piala kementerian.',
                    'en' => 'Integrated IoT-based public transportation solution won the ministry trophy.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Medali Emas Kejuaraan Pencak Silat Antar Perguruan Tinggi',
                    'en' => 'Gold Medal Inter-University Pencak Silat Championship',
                ],
                'category' => ['id' => 'OLAHRAGA', 'en' => 'SPORTS'],
                'type' => AchievementType::COMPETITION,
                'level' => AchievementLevel::NATIONAL,
                'year' => 2024,
                'organizer' => ['id' => 'UKM Pencak Silat', 'en' => 'Pencak Silat Student Club'],
                'description' => [
                    'id' => 'Kategori Seni Tunggal Putra berhasil memboyong medali emas nasional.',
                    'en' => 'Men Single Artistic Category successfully brought home the national gold medal.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Paten Telemetri Monitoring Alat Berat Tambang',
                    'en' => 'Patent Heavy Equipment Telemetry Monitoring System',
                ],
                'category' => ['id' => 'PATEN', 'en' => 'PATENT'],
                'type' => AchievementType::PATENT,
                'level' => AchievementLevel::NATIONAL,
                'year' => 2026,
                'organizer' => ['id' => 'Teknik Elektro', 'en' => 'Electrical Engineering'],
                'description' => [
                    'id' => 'Sistem sensor pelacak kondisi komponen kritis alat berat secara real-time.',
                    'en' => 'Sensor system tracking the real-time condition of critical heavy equipment components.',
                ],
                'is_featured' => false,
            ],
            [
                'title' => [
                    'id' => 'Juara 1 Lomba Inovasi Teknologi Tepat Guna (TTG)',
                    'en' => '1st Place Appropriate Technology Innovation Contest',
                ],
                'category' => ['id' => 'INOVASI', 'en' => 'INNOVATION'],
                'type' => AchievementType::COMPETITION,
                'level' => AchievementLevel::LOCAL,
                'year' => 2025,
                'organizer' => ['id' => 'Teknik Mesin', 'en' => 'Mechanical Engineering'],
                'description' => [
                    'id' => 'Mesin pemipil jagung hemat energi tingkat kabupaten membantu petani lokal.',
                    'en' => 'Energy-saving corn sheller machine at the regency level aiding local farmers.',
                ],
                'is_featured' => false,
            ],
        ];

        foreach ($sampleAchivements as $data) {
            $slug = Str::slug($data['title']['id']);

            Achivement::updateOrCreate(
                ['slug' => $slug],
                [
                    'image' => null, // dapat diisi path default jika ada
                    'year' => $data['year'],
                    'type' => $data['type'],
                    'level' => $data['level'],
                    'title' => $data['title'],
                    'category' => $data['category'],
                    'description' => $data['description'],
                    'organizer' => $data['organizer'],
                    'is_featured' => $data['is_featured'],
                ]
            );
        }
    }
}
