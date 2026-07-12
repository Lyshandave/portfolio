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

        $systemInstruction = "You are Lyshan Dave's personal AI Assistant, representing Lyshan Dave (AI / Software Engineer / Content Creator). Speak naturally, conversationally, and warmly like a friendly human developer. Avoid dry, robotic, or overly formal corporate language.\n\n";
        $systemInstruction .= "CRITICAL INSTRUCTIONS:\n";
        $systemInstruction .= "1. RESPONSE LANGUAGE (STRICT): You MUST detect the language of the user's LATEST message (the very last message) and reply in that EXACT same language. If the user's last message is in English, you MUST reply in English. If it is in Tagalog, reply in conversational Tagalog. If it is in Taglish, reply in Taglish. Do not let previous chat history override the language of the latest query.\n";
        $systemInstruction .= "2. ABOUT LYSHAN: Answer questions about Lyshan Dave's projects, technical skills (React, Laravel, CSS, etc.), experiences (Core Technology, GCM Tech Services, AICS), certifications (TESDA, Cisco), education, and contact details accurately using the provided context.\n";
        $systemInstruction .= "3. HANDLING OUT-OF-TOPIC QUESTIONS (STRICT): If the user asks general, out-of-topic questions (e.g., 'who is the president of the philippines', 'how to write a binary search', history, science, math, coding problems, etc.), you MUST answer their question directly, fully, and accurately using your general knowledge. Do NOT ignore the question, do NOT reply with a generic greeting, and do NOT refuse. Answer it directly. Respond in the same language as their query.\n";
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
            // Using gemini-2.0-flash which is the current recommended fast model
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}", [
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
        
        // Exact word matching to avoid partial matches (e.g. "philippines" containing "hi")
        $words = preg_split('/\s+/', $msg);
        
        $isTagalog = false;
        $tagalogKeywords = ['ako', 'si', 'ano', 'salamat', 'kumusta', 'kamusta', 'may', 'ang', 'mga', 'sa', 'nila', 'ito', 'diyan'];
        foreach ($words as $word) {
            $cleanWord = trim($word, '?,.!');
            if (in_array($cleanWord, $tagalogKeywords)) {
                $isTagalog = true;
                break;
            }
        }

        $cleanWords = array_map(fn($w) => trim($w, '?,.!'), $words);

        if ($isTagalog) {
            if (array_intersect(['hello', 'hi', 'uy', 'helo'], $cleanWords)) {
                return "Uy, hello! Ako pala si Lyshan. Ano ang maitutulong ko sa iyo ngayon?";
            }
            if (array_intersect(['skills', 'marunong', 'tech', 'kakayahan'], $cleanWords)) {
                return "May kaalaman at karanasan ako sa Frontend gaya ng React at Tailwind, pati sa Backend gamit ang Laravel at Node.js.";
            }
            return "Pasensya na, medyo offline ako ngayon. Mag-iwan ka na lang ng mensahe sa email ko sa lyshandavet@gmail.com!";
        } else {
            if (array_intersect(['hello', 'hi', 'hey', 'helo'], $cleanWords)) {
                return "Hello there! I'm Lyshan's AI Assistant. How can I help you today?";
            }
            if (array_intersect(['skills', 'tech', 'know', 'capabilities'], $cleanWords)) {
                return "I have experience with Frontend technologies like React and Tailwind CSS, as well as Backend with Laravel and Node.js.";
            }
            return "Sorry, I am currently offline. Please send an email directly to lyshandavet@gmail.com!";
        }
    }
}
