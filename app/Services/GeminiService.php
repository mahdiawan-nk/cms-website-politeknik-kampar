<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected string $apiKey;

    protected string $model;

    public function __construct(string $model = 'gemini-flash-latest')
    {
        $this->apiKey = env('GEMINI_API_KEY', '');
        $this->model = $model;
    }

    /**
     * Generate JSON content dari Gemini API menggunakan x-goog-api-key header.
     *
     * @throws Exception
     */
    public function generateJson(string $prompt): array
    {
        if (empty($this->apiKey)) {
            throw new Exception('GEMINI_API_KEY belum dikonfigurasi pada file .env.');
        }

        $endpoint = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent";

        $response = Http::withHeaders([
            'Content-Type'   => 'application/json',
            'x-goog-api-key' => $this->apiKey, // Menggunakan header sesuai dokumen resmi
        ])->post($endpoint, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt],
                    ],
                ],
            ],
            'generationConfig' => [
                'responseMimeType' => 'application/json',
            ],
        ]);

        // dd($response);
        if ($response->failed()) {
            $errorMessage = $response->json('error.message') ?? 'Terjadi kesalahan saat terhubung ke Gemini API.';
            throw new Exception($errorMessage);
        }

        $rawJson = $response->json('candidates.0.content.parts.0.text');
        $data = json_decode($rawJson, true);

        if (! is_array($data)) {
            throw new Exception('Format respons dari AI tidak valid atau kosong.');
        }

        return $data;
    }
}
