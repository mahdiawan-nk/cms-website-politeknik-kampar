# STYLE_GUIDE.md — Eco-Industrial Polkam Global Design System

Dokumen ini berisi spesifikasi *global design tokens*, variabel warna, tipografi, dan komponen UI dasar berbasis **Tailwind CSS** untuk seluruh website Politeknik Kampar.

---

## 1. Global Design Principles

* **Precision Engineering Meets Nature:** Perpaduan elemen struktur teknis (*blueprint grid*, *sharp corners*) dengan estetika alam (*soft rounded curves*, *emerald accent*, *ambient glow*).
* **High-Contrast Readability:** Latar belakang terang (*Canvas Slate*) dikombinasikan dengan teks gelap tegas (*Slate 900*) serta aksen kontras (*Safety Orange* & *Emerald Green*).
* **Layered Elevation:** Penggunaan *glassmorphism backdrop blur*, *tinted shadows*, dan kedalaman layer visual.

---

## 2. Color Tokens (Palet Warna Global)

### A. Brand Colors

| Token | Hex Code | Tailwind Class | Peran & Penggunaan |
| --- | --- | --- | --- |
| `eco-primary` | `#10B981` | `emerald-500` | Aksesibilitas eco utama, button utama, garis aksen |
| `eco-dark` | `#059669` | `emerald-600` | Hover state eco, text gradient endpoint |
| `eco-light` | `#D1FAE5` | `emerald-100` | Background icon soft, badge eco |
| `industrial-primary` | `#FF8C00` | `amber-500` / `#FF8C00` | Aksen teknik/keamanan, overline text, button sekunder |
| `industrial-dark` | `#E07B00` | `amber-600` | Hover state elemen industri |
| `industrial-light` | `#FFEDD5` | `amber-100` | Background badge industri, soft alert |

### B. Neutrals & Canvas

| Token | Hex Code | Tailwind Class | Peran & Penggunaan |
| --- | --- | --- | --- |
| `canvas-base` | `#F8FAFC` | `slate-50` | Latar belakang global utama |
| `surface-white` | `#FFFFFF` | `white` | Surface kartu, modal, container |
| `surface-glass` | `rgba(255,255,255,0.6)` | `white/60` | Surface transparan (*backdrop blur*) |
| `text-primary` | `#0F172A` | `slate-900` | Judul, heading, teks resolusi tinggi |
| `text-secondary` | `#475569` | `slate-600` | Paragraf utama, deskripsi |
| `text-muted` | `#64748B` | `slate-500` | Sub-label, caption, metadata |
| `border-soft` | `#E2E8F0` | `slate-200` | Border netral elemen & kartu |
| `border-glass` | `rgba(226,232,240,0.6)` | `slate-200/60` | Border elemen glassmorphism |

---

## 3. Typography System

### Font Families

* **Sans-Serif (`font-sans`):** `Plus Jakarta Sans` / `Inter` (Heading, Body Text, UI)
* **Monospace (`font-mono`):** `JetBrains Mono` / `Fira Code` (Statistik, Data Teknis, Code, Badge)

### Text Scale & Hierarchy

```html
<!-- Display Heading -->
<h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.1]">
  Judul Utama
</h1>

<!-- Section Heading -->
<h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-[1.15]">
  Judul <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#10B981] to-[#059669]">Highlight</span>
</h2>

<!-- Card Title -->
<h3 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight leading-snug">
  Judul Komponen
</h3>

<!-- Overline Category -->
<div class="flex items-center gap-3 mb-4">
  <span class="w-10 h-[2px] bg-gradient-to-r from-[#FF8C00] to-transparent"></span>
  <span class="text-xs font-bold tracking-[0.2em] uppercase text-[#FF8C00] font-sans">
    KATEGORI OVERLINE
  </span>
</div>

<!-- Body Text -->
<p class="text-base sm:text-lg font-normal text-slate-600 leading-relaxed">
  Teks paragraf standar untuk deskripsi dan isi konten.
</p>

<!-- Technical Data Tag -->
<span class="font-mono text-xs font-semibold text-[#10B981] uppercase tracking-wider">
  DATA-CODE // SPEC-2026
</span>

```

---

## 4. Canvas, Grid & Elevation

### Global Base Canvas Structure

```html
<div class="relative w-full py-24 lg:py-32 bg-[#F8FAFC] overflow-hidden font-sans text-slate-900">
  <!-- Top Accent Strip -->
  <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]"></div>

  <!-- Industrial Blueprint Grid -->
  <div class="absolute inset-0 bg-[linear-gradient(to_right,#00000005_1px,transparent_1px),linear-gradient(to_bottom,#00000005_1px,transparent_1px)] bg-[size:36px_36px] pointer-events-none"></div>

  <!-- Ambient Glows -->
  <div class="absolute top-1/2 left-1/4 -translate-y-1/2 w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>
  <div class="absolute top-1/2 right-1/4 -translate-y-1/2 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>
</div>

```

### Border Radius Tokens

* **Pill / Badge:** `rounded-full`
* **Input / Button:** `rounded-xl`
* **Standard Card:** `rounded-3xl`
* **Engineered Frame:** `rounded-[2.5rem]`

### Custom Tinted Shadow Tokens

* **Eco Glow:** `shadow-[0_20px_40px_-10px_rgba(16,185,129,0.12)]`
* **Industrial Glow:** `shadow-[0_20px_40px_-10px_rgba(255,140,0,0.15)]`
* **Card Soft:** `shadow-[0_10px_30px_-5px_rgba(15,23,42,0.03)]`

---

## 5. Micro-Interactions & Motion

| Konteks Animasi | Durasi Tailwind | Easing Curve |
| --- | --- | --- |
| **Hover State & Buttons** | `duration-300` | `ease-out` |
| **Card Elevation & Color Shift** | `duration-500` | `ease-out` |
| **Image Zoom & Framing** | `duration-700` s/d `duration-1000` | `cubic-bezier(0.25, 1, 0.5, 1)` |

---

## 6. Global UI Component Library

### A. Buttons

```html
<!-- Primary Button (Eco) -->
<button class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-[#10B981] hover:bg-[#059669] text-white font-bold text-sm tracking-wide rounded-xl shadow-[0_10px_25px_-5px_rgba(16,185,129,0.4)] hover:shadow-[0_15px_30px_-5px_rgba(16,185,129,0.5)] transition-all duration-300 transform hover:-translate-y-0.5">
  <span>Aksi Utama</span>
  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
</button>

<!-- Secondary Button (Industrial) -->
<button class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-[#FF8C00] hover:bg-[#E07B00] text-white font-bold text-sm tracking-wide rounded-xl shadow-[0_10px_25px_-5px_rgba(255,140,0,0.3)] hover:shadow-[0_15px_30px_-5px_rgba(255,140,0,0.4)] transition-all duration-300 transform hover:-translate-y-0.5">
  <span>Aksi Sekunder</span>
  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
</button>

```

### B. Glassmorphic Card Container

```html
<div class="relative p-8 rounded-3xl bg-white/60 backdrop-blur-xl border border-slate-200/60 shadow-[0_10px_30px_-5px_rgba(15,23,42,0.03)] hover:shadow-[0_20px_40px_-10px_rgba(16,185,129,0.12)] hover:bg-white/90 transition-all duration-500 group overflow-hidden">
  <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-1/2 bg-gradient-to-b from-[#10B981] to-[#FF8C00] rounded-r-full opacity-40 group-hover:opacity-100 group-hover:h-3/4 transition-all duration-500"></div>
  <div class="relative z-10">
    <!-- Card Content -->
  </div>
</div>

```

### C. Engineered Photo Frame

```html
<div class="relative w-full max-w-[480px] aspect-[4/5] group">
  <div class="absolute inset-0 bg-white rounded-[2.5rem] shadow-[0_20px_40px_-10px_rgba(16,185,129,0.1)] group-hover:shadow-[0_30px_60px_-15px_rgba(255,140,0,0.15)] transition-shadow duration-700 ease-out border border-slate-100"></div>
  
  <!-- Precision Corner Indicators -->
  <div class="absolute -top-1 -left-1 w-10 h-10 border-t-2 border-l-2 border-[#10B981] rounded-tl-[2.6rem] opacity-0 group-hover:opacity-100 group-hover:-translate-x-2 group-hover:-translate-y-2 transition-all duration-700 ease-out z-20"></div>
  <div class="absolute -bottom-1 -right-1 w-10 h-10 border-b-2 border-r-2 border-[#FF8C00] rounded-br-[2.6rem] opacity-0 group-hover:opacity-100 group-hover:translate-x-2 group-hover:translate-y-2 transition-all duration-700 ease-out z-20"></div>

  <div class="absolute inset-3 rounded-[2rem] overflow-hidden bg-slate-100 z-10">
    <img src="IMAGE_URL" alt="Media" class="w-full h-full object-cover transform scale-100 group-hover:scale-105 transition-transform duration-1000 ease-[cubic-bezier(0.25,1,0.5,1)]">
  </div>
</div>

```

### D. Badges & Form Elements

```html
<!-- Badge Industrial -->
<span class="inline-flex items-center gap-1.5 px-3 py-1 bg-[#FF8C00] text-white rounded-full text-[10px] font-bold uppercase tracking-widest shadow-sm">
  <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
  STATUS BADGE
</span>

<!-- Input Field -->
<div class="flex flex-col gap-2">
  <label class="text-xs font-bold uppercase tracking-wider text-slate-700 font-sans">Label Form</label>
  <input type="text" placeholder="Masukkan data..." 
    class="w-full px-5 py-4 rounded-xl bg-white/80 border border-slate-200 text-slate-900 text-sm focus:outline-none focus:border-[#10B981] focus:ring-2 focus:ring-[#10B981]/20 transition-all font-sans placeholder:text-slate-400">
</div>

```