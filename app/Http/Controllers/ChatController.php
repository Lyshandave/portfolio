<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'history' => 'nullable|array',
        ]);

        $message = $request->input('message');
        $history = $request->input('history', []);

        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            // Fallback response if API key is not configured
            return response()->json([
                'reply' => $this->getFallbackResponse($message),
            ]);
        }

        // Get Lyshan Dave's portfolio details to use as context
        $portfolioData = config('portfolio', []);
        $profile = $portfolioData['profile'] ?? [];
        $skills = $portfolioData['techStack'] ?? [];
        $projects = $portfolioData['projects'] ?? [];
        $certs = $portfolioData['all_certifications'] ?? [];

        // Format portfolio data as context string
        $context = "Context about Lyshan Dave:\n";
        $context .= "- Name: " . ($profile['name'] ?? 'Lyshan Dave') . "\n";
        $context .= "- Title: " . ($profile['title'] ?? 'Computer Systems Technician & Web Developer') . "\n";
        $context .= "- Bio: " . ($profile['bio'] ?? '') . "\n";
        $context .= "- Email: " . ($profile['email'] ?? 'lyshandavet@gmail.com') . "\n";
        
        $context .= "\nSkills:\n";
        foreach ($skills as $category => $items) {
            $context .= "- $category: " . implode(', ', array_map(fn($s) => $s['name'], $items)) . "\n";
        }

        $context .= "\nProjects:\n";
        foreach ($projects as $project) {
            $context .= "- Title: " . ($project['title'] ?? '') . "\n";
            $context .= "  Slug: " . ($project['slug'] ?? '') . "\n";
            $context .= "  Description: " . ($project['description'] ?? '') . "\n";
            $context .= "  Tech: " . implode(', ', $project['technologies'] ?? []) . "\n";
            $context .= "  Demo: " . ($project['demo'] ?? '') . "\n";
        }

        $context .= "\nCertifications:\n";
        foreach ($certs as $cert) {
            $context .= "- Title: " . ($cert['title'] ?? '') . " from " . ($cert['issuer'] ?? '') . " (" . ($cert['date'] ?? '') . ")\n";
        }

        $systemInstruction = "You are Lyshan Dave's AI Assistant, representing Lyshan Dave (a Computer Systems Technician and Web Developer). Your job is to answer questions about Lyshan Dave's portfolio, experiences, projects, skills, education, and credentials.\n\n";
        $systemInstruction .= "CRITICAL INSTRUCTIONS:\n";
        $systemInstruction .= "1. Respond in the language used by the user in their latest query. If they ask in English, reply in English. If they ask in Tagalog/Taglish, reply in Tagalog/Taglish.\n";
        $systemInstruction .= "2. Be polite, professional, and friendly.\n";
        $systemInstruction .= "3. For out-of-topic questions (e.g. general questions about programming, science, history, coding problems, etc.), answer them accurately and helpfully using your knowledge as a large language model. If possible, try to smoothly link it back to Lyshan's work or skills, but prioritize answering the user's question accurately.\n";
        $systemInstruction .= "4. Do not mention Google, Gemini, or that you are a large language model. You are Lyshan Dave's personal portfolio AI assistant.\n\n";
        $systemInstruction .= "Here is the exact data about Lyshan Dave:\n" . $context;

        // Build Gemini API payload
        $contents = [];
        
        // Add conversation history
        foreach ($history as $chat) {
            $contents[] = [
                'role' => $chat['sender'] === 'user' ? 'user' : 'model',
                'parts' => [['text' => $chat['text']]]
            ];
        }

        // Append current message
        $contents[] = [
            'role' => 'user',
            'parts' => [['text' => $message]]
        ];

        try {
            // Using gemini-2.5-flash which is free, fast, and very accurate
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
                'contents' => $contents,
                'systemInstruction' => [
                    'parts' => [['text' => $systemInstruction]]
                ],
                'generationConfig' => [
                    'maxOutputTokens' => 1000,
                    'temperature' => 0.7,
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
                if ($reply) {
                    return response()->json(['reply' => $reply]);
                }
            }

            Log::error('Gemini API Error: ' . $response->body());
        } catch (\Exception $e) {
            Log::error('Chatbot API Exception: ' . $e->getMessage());
        }

        return response()->json([
            'reply' => $this->getFallbackResponse($message),
        ]);
    }

    private function getFallbackResponse($message)
    {
        $msg = strtolower($message);
        
        // Check language of input
        $isTagalog = preg_match('/(ako|si|ano|salamat|kumusta|kamusta|may|ang|mga|sa|nila|ito|diyan)/i', $msg);

        if ($isTagalog) {
            if (str_contains($msg, 'hello') || str_contains($msg, 'hi') || str_contains($msg, 'uy')) {
                return "Uy, hello! Ako pala si Lyshan. Ano ang maitutulong ko sa iyo ngayon?";
            }
            if (str_contains($msg, 'skills') || str_contains($msg, 'marunong') || str_contains($msg, 'tech')) {
                return "May kaalaman at karanasan ako sa Frontend gaya ng React at Tailwind, pati sa Backend gamit ang Laravel at Node.js.";
            }
            return "Pasensya na, medyo offline ako ngayon. Mag-iwan ka na lang ng mensahe sa email ko sa lyshandavet@gmail.com!";
        } else {
            if (str_contains($msg, 'hello') || str_contains($msg, 'hi') || str_contains($msg, 'hey')) {
                return "Hello there! I'm Lyshan's AI Assistant. How can I help you today?";
            }
            if (str_contains($msg, 'skills') || str_contains($msg, 'tech') || str_contains($msg, 'know')) {
                return "I have experience with Frontend technologies like React and Tailwind CSS, as well as Backend with Laravel and Node.js.";
            }
            return "Sorry, I am currently offline. Please send an email directly to lyshandavet@gmail.com!";
        }
    }
}
