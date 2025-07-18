<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImageGenerationController extends Controller
{
    public function generate(Request $request)
    {
        $prompt = $request->input('promt');
        $model = $request->input('model');

        if (!$prompt || !$model) {
            return response()->json(['error' => 'Промт или модель не указаны'], 400);
        }

        switch ($model) {
            case 'sd15':
                return $this->generateWithSD15($prompt);
            case 'flux':
                return $this->generateWithFLUX($prompt);
            default:
                return response()->json(['error' => 'Неизвестная модель'], 400);
        }
    }

    private function generateWithSD15($promt)
    {
        $response = Http::post('https://modelslab.com/api/v6/images/text2img', [
            'key' => env('SD_API_KEY'),
            'model_id' => 'stable-diffusion-v1-5',
            'prompt' => $promt,
            'width' => 768,
            'height' => 768,
            'samples' => 1,
            'num_inference_steps' => 30,
            'guidance_scale' => 7.5,
            'safety_checker' => 'no',
            'enhance_prompt' => 'yes'
        ]);

        if (!$response->ok()) {
            return response()->json(['error' => 'Ошибка генерации'], 500);
        }

        $imageUrl = $response->json('output.0');

        return response()->json([
            'model' => 'sd15',
            'image_url' => $imageUrl,
            'prompt' => $promt
        ]);
    }

    private function generateWithFLUX($prompt)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('FLUX_API_KEY'),
            'Content-Type' => 'application/json'
        ])->post('https://inference.api.nscale.com/v1/images/generations', [
                    'model' => 'black-forest-labs/FLUX.1-schnell',
                    'prompt' => $prompt,
                    'size' => '1024x1024',
                    'n' => 1
                ]);

        if (!$response->ok()) {
            return response()->json([
                'error' => 'Ошибка генерации',
                'details' => $response->body()
            ], 500);
        }

        $imageUrl = $response->json('data.0.url') ?? null;

        return response()->json([
            'model' => 'flux',
            'image_url' => $imageUrl,
            'prompt' => $prompt
        ]);
    }
}
