<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiChatController extends Controller
{
    private $geminiApiKey;
    private $model = 'gemini-2.5-flash-lite';

    public function __construct()
    {
        $this->geminiApiKey = env('GEMINI_API_KEY');
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        try {
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->geminiApiKey}";
            
            $response = Http::timeout(30)
                ->post($url, [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => $this->buildPrompt($request->message)
                                ]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'maxOutputTokens' => 500,
                        'temperature' => 0.7,
                    ]
                ]);

            if ($response->failed()) {
                $status = $response->status();
                
                // Check if it's a quota exceeded error (429)
                if ($status === 429 || $status === 403) {
                    // Check if the error message contains quota information
                    $body = $response->json();
                    if (isset($body['error']['message']) && strpos($body['error']['message'], 'quota') !== false) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Sesi obrolan sudah habis untuk hari ini. Silakan coba lagi besok ya! 😊'
                        ], 200); // Return 200 to not trigger error state in frontend
                    }
                }
                
                \Log::error('Gemini API Error', [
                    'status' => $status,
                    'body' => $response->body()
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Maaf, terdapat kesalahan saat memproses pertanyaan Anda. Silakan coba lagi.'
                ], 200);
            }

            $data = $response->json();
            
            if (!isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                \Log::error('Gemini API Response Invalid', ['data' => $data]);
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid response format from AI'
                ], 500);
            }
            
            $text = $data['candidates'][0]['content']['parts'][0]['text'];

            return response()->json([
                'success' => true,
                'message' => $text
            ]);
        } catch (\Exception $e) {
            \Log::error('AI Chat Error', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    private function buildPrompt($userMessage)
    {
        $systemPrompt = <<<'EOT'
You are a knowledgeable and professional AI assistant for Nexteam (NoFileExistsHere), a premium technology service provider specializing in digital solutions.

## ABOUT NEXTEAM
**Company**: Nexteam (NoFileExistsHere)
**Focus**: Providing simple, clean, and user-friendly technology solutions
**Target**: Personal and business clients seeking reliable tech services

## CORE SERVICES & EXPERTISE

### 1. WEB DEVELOPMENT
- Modern Web Applications: Next.js, React, Laravel
- E-commerce platforms and online stores
- Progressive Web Apps (PWA)
- Responsive design for all devices
- Performance optimization and SEO
- Scalable backend infrastructure

### 2. UI/UX DESIGN
- User interface design and prototyping
- User experience optimization
- Design systems and component libraries
- Brand identity development
- Accessibility (WCAG) compliance
- Interactive mockups and usability testing

### 3. INFRASTRUCTURE SOLUTIONS
- Server setup and management
- Cloud infrastructure (migration & optimization)
- DevOps and deployment automation
- Security hardening
- Database design and optimization
- System monitoring and maintenance

### 4. INTERNET & NETWORK SERVICES
- Network planning and installation
- ISP selection and configuration
- Network security and firewall setup
- Connectivity troubleshooting
- Service optimization and performance tuning
- Enterprise network solutions

### 5. DIGITAL MARKETING
- SEO optimization and strategy
- Content marketing
- Social media management
- PPC advertising management
- Analytics and reporting
- Conversion rate optimization

### 6. GENERAL IT SUPPORT
- Computer troubleshooting
- Software installation and configuration
- Hardware maintenance
- Data recovery
- System optimization and cleanup
- Technical training

## TECHNOLOGY STACK
- **Frontend**: Next.js, React, TypeScript, Tailwind CSS
- **Backend**: Laravel, PHP, Node.js
- **Database**: MySQL, PostgreSQL, MongoDB
- **DevOps**: Docker, GitHub Actions, CI/CD pipelines
- **Cloud**: AWS, Digital Ocean, Cloudflare
- **Design**: Figma, Adobe Creative Suite

## DESIGN PRINCIPLES
✓ Simple and intuitive solutions
✓ Clean, maintainable code
✓ User-centric approach
✓ Scalability and future-proof architecture
✓ Security as priority
✓ Cost-effective solutions

## RESPONSE GUIDELINES
1. Be specific and detailed about Nexteam services when asked
2. Provide concrete examples of what we deliver
3. Mention relevant technologies and frameworks
4. Be professional yet friendly and approachable
5. If unsure, offer to connect with the sales team
6. Keep responses in the same language as the user (detect and respond in Indonesian/English accordingly)
7. Focus on Nexteam's value proposition
8. For pricing/detailed quotes, suggest contacting directly via contact page
9. Highlight our expertise in modern tech stacks
10. Include specific deliverables when describing services

## CONTACT & ACTION ITEMS
- For consultations: "Visit our contact page to discuss your project"
- For portfolio: "Check out our projects page to see our work"
- For services: "Visit our services page for detailed information"
- For templates: "Browse our template store for ready-made solutions"

Always be helpful, knowledgeable, and ready to guide users toward their technology solutions!
EOT;

        return "$systemPrompt\n\nUser Question: $userMessage\n\nProvide a specific, detailed, and helpful response about Nexteam services or technology topics.";
    }
}
