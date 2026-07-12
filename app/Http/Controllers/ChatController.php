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
        $experiences = $portfolioData['experience'] ?? [];

        // Format portfolio data as context string
        $context = "Context about Lyshan Dave:\n";
        $context .= "- Name: " . ($profile['name'] ?? 'Lyshan Dave') . "\n";
        $context .= "- Title: " . ($profile['title'] ?? 'AI / Software Engineer / Content Creator') . "\n";
        $context .= "- Location: " . ($profile['location'] ?? 'Metro Manila, Philippines') . "\n";
        $context .= "- About Info:\n";
        foreach (($profile['about'] ?? []) as $aboutParagraph) {
            $context .= "  " . $aboutParagraph . "\n";
        }
        $context .= "- Email: " . ($profile['email'] ?? 'lyshandavet@gmail.com') . "\n";
        
        $context .= "\nWork & Academic Experience:\n";
        foreach ($experiences as $exp) {
            $context .= "- Role: " . ($exp['role'] ?? '') . "\n";
            $context .= "  Company/School: " . ($exp['company'] ?? '') . " (" . ($exp['period'] ?? '') . ")\n";
            $context .= "  Description: " . ($exp['description'] ?? '') . "\n";
            $context .= "  Highlights:\n";
            foreach (($exp['highlights'] ?? []) as $highlight) {
                $context .= "    * " . $highlight . "\n";
            }
            $context .= "  Technologies Used: " . implode(', ', $exp['technologies'] ?? []) . "\n";
        }

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

        $systemInstruction = "You are Lyshan Dave's personal AI Assistant, representing Lyshan Dave (AI / Software Engineer / Content Creator). You must act as if you are his real-life personal assistant or Lyshan himself (written from a close, personal, and highly human perspective). Speak naturally, conversationally, and warmly like a friendly developer. Avoid dry, robotic, or overly formal corporate language. Use casual formatting, micro-expressions, or friendly tone where appropriate.\n\n";
        $systemInstruction .= "CRITICAL INSTRUCTIONS:\n";
        $systemInstruction .= "1. RESPONSE LANGUAGE: You must reply in the EXACT SAME language that the user used. If the user asks in English, reply in natural English. If the user asks in Tagalog, reply in natural conversational Tagalog. If they use Taglish (mixed English and Tagalog), reply in natural Taglish. Do not be overly formal in Tagalog; speak like a local Filipino developer.\n";
        $systemInstruction .= "2. ABOUT LYSHAN: Answer questions about Lyshan Dave's projects, technical skills (React, Laravel, CSS, etc.), experiences (Core Technology, GCM Tech Services, AICS), certifications (TESDA, Cisco), education, and contact details accurately using the provided context.\n";
        $systemInstruction .= "3. HANDLING OUT-OF-TOPIC QUESTIONS: If the user asks general, out-of-topic questions (e.g. asking for coding assistance, explaining programming concepts, general facts, science, math, history, writing code, debugging, or personal developer questions), you MUST answer them fully, accurately, and helpful using your general knowledge as a large language model. Do not refuse, do not say you only answer portfolio questions, and do not say you are offline. Answer them directly and naturally in the user's language. If it is relevant, you can briefly/smoothly connect it back to Lyshan's projects or skills, but prioritize giving a direct, complete, and helpful answer first.\n";
        $systemInstruction .= "4. DO NOT mention that you are an AI, Google, Gemini, or a large language model. You are Lyshan Dave's dedicated assistant.\n\n";
        $systemInstruction .= "Here is the complete context about Lyshan Dave:\n" . $context;

        // Build Gemini API payload
        $contents = [];
        $expectedRole = 'user'; // Gemini requires conversation history to start with a 'user' turn
        
        foreach ($history as $chat) {
            $role = $chat['sender'] === 'user' ? 'user' : 'model';
            if ($role === $expectedRole) {
                $contents[] = [
                    'role' => $role,
                    'parts' => [['text' => $chat['text']]]
                ];
                // Toggle expected role to alternate
                $expectedRole = ($expectedRole === 'user') ? 'model' : 'user';
            }
        }
        
        // If the history ends with a 'user' message, pop it because our new message is 'user'
        if ($expectedRole === 'model' && !empty($contents)) {
            array_pop($contents);
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
