<?php

namespace App\Filament\Actions;

use App\Services\GeminiService;
use Closure;
use Filament\Actions\Action;
use Filament\Schemas\Components\Utilities\{Get, Set};
use Filament\Notifications\Notification;

class GenerateAiSampleAction extends Action
{
    protected string $targetField = '';

    protected string|Closure $prompt = '';

    protected ?Closure $transformDataCallback = null;

    public static function getDefaultName(): ?string
    {
        return 'generateAiSample';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Generate via AI')
            ->icon('heroicon-o-sparkles')
            ->color('success')
            ->modalHeading('Konfigurasi Sample AI')
            ->modalSubmitActionLabel('Generate Data')
            ->action(function (array $data, Set $set) {
                if (empty($this->targetField)) {
                    Notification::make()
                        ->title('Konfigurasi Belum Lengkap')
                        ->body('Target field belum ditentukan pada Action.')
                        ->warning()
                        ->send();

                    return;
                }

                // Rakit prompt: mengeksekusi closure jika prompt berupa callback dinamis
                $finalPrompt = $this->prompt instanceof Closure
                    ? call_user_func($this->prompt, $data)
                    : $this->prompt;

                try {
                    $service = new GeminiService();
                    $resultData = $service->generateJson($finalPrompt);

                    // Set data ke field repeater
                    $set($this->targetField, $resultData);

                    Notification::make()
                        ->title('Berhasil Generate')
                        ->body(count($resultData) . ' data sampel berhasil diisi oleh Gemini AI.')
                        ->success()
                        ->send();
                } catch (\Exception $e) {
                    Notification::make()
                        ->title('Gagal Generate')
                        ->body($e->getMessage())
                        ->danger()
                        ->send();
                }
            });
    }

    /**
     * Tentukan state path / name field repeater sasaran (misal: 'metadata.testimonials')
     */
    public function targetField(string $field): static
    {
        $this->targetField = $field;

        return $this;
    }

    /**
     * Tentukan prompt spesifik untuk field/block ini
     */
    public function prompt(string|Closure $prompt): static
    {
        $this->prompt = $prompt;

        return $this;
    }

    /**
     * Callback opsional jika perlu memodifikasi array sebelum dimasukkan ke form
     */
    public function transform(Closure $closure): static
    {
        $this->transformDataCallback = $closure;

        return $this;
    }
}
