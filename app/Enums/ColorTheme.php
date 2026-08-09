<?php

namespace App\Enums;

enum ColorTheme: string
{
    case EMERALD = 'emerald';
    case AMBER   = 'amber';
    case BLUE    = 'blue';
    case VIOLET  = 'violet';
    case ROSE    = 'rose';
    case CYAN    = 'cyan';

    /**
     * Label ramah pengguna untuk form Admin / Dashboard CMS.
     */
    public function label(): string
    {
        return match($this) {
            self::EMERALD => 'Hijau Eco (Emerald)',
            self::AMBER   => 'Oranye Industri (Amber)',
            self::BLUE    => 'Biru Tekno (Blue)',
            self::VIOLET  => 'Ungu Inovasi (Violet)',
            self::ROSE    => 'Merah Energi (Rose)',
            self::CYAN    => 'Sian Riset (Cyan)',
        };
    }

    /**
     * Class untuk indikator garis / border aksen.
     */
    public function bgClass(): string
    {
        return match($this) {
            self::EMERALD => 'bg-emerald-500',
            self::AMBER   => 'bg-amber-500',
            self::BLUE    => 'bg-blue-500',
            self::VIOLET  => 'bg-violet-500',
            self::ROSE    => 'bg-rose-500',
            self::CYAN    => 'bg-cyan-500',
        };
    }

    /**
     * Class untuk teks angka / statistik.
     */
    public function textClass(): string
    {
        return match($this) {
            self::EMERALD => 'text-emerald-500',
            self::AMBER   => 'text-amber-500',
            self::BLUE    => 'text-blue-500',
            self::VIOLET  => 'text-violet-500',
            self::ROSE    => 'text-rose-500',
            self::CYAN    => 'text-cyan-500',
        };
    }

    /**
     * Class untuk efek hover border kartu.
     */
    public function hoverBorderClass(): string
    {
        return match($this) {
            self::EMERALD => 'hover:border-emerald-500/50',
            self::AMBER   => 'hover:border-amber-500/50',
            self::BLUE    => 'hover:border-blue-500/50',
            self::VIOLET  => 'hover:border-violet-500/50',
            self::ROSE    => 'hover:border-rose-500/50',
            self::CYAN    => 'hover:border-cyan-500/50',
        };
    }

    /**
     * Class untuk efek shadow glow kartu (Eco-Industrial Design System).
     */
    public function hoverGlowClass(): string
    {
        return match($this) {
            self::EMERALD => 'hover:shadow-[0_20px_40px_-10px_rgba(16,185,129,0.15)]',
            self::AMBER   => 'hover:shadow-[0_20px_40px_-10px_rgba(255,140,0,0.15)]',
            self::BLUE    => 'hover:shadow-[0_20px_40px_-10px_rgba(59,130,246,0.15)]',
            self::VIOLET  => 'hover:shadow-[0_20px_40px_-10px_rgba(139,92,246,0.15)]',
            self::ROSE    => 'hover:shadow-[0_20px_40px_-10px_rgba(244,63,94,0.15)]',
            self::CYAN    => 'hover:shadow-[0_20px_40px_-10px_rgba(6,182,212,0.15)]',
        };
    }
}