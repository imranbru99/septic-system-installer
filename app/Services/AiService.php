<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiService
{
    protected array $faq = [
        'estimate' => 'Clearbasin provides on-site septic evaluations across the Hudson Valley. Most visits take 45–75 minutes and may include a soil probe review. Call (845) 555-0192 or use the contact form to book.',
        'install' => 'New septic installs typically take 3–10 days depending on tank type, drain-field length, weather, and inspection scheduling. We handle permits and coordinate county inspections.',
        'tank' => 'We install concrete and polyethylene septic tanks sized to bedroom count and local code. Tank replacements usually need a pump-out, excavation, and new inlet/outlet fittings.',
        'drain' => 'Drain fields (leach lines or chamber systems) are sized from soil percolation rates and daily design flow. Failed fields often need rest, replacement laterals, or a redesign.',
        'pump' => 'Pump stations and effluent pumps are used when the field sits uphill of the tank. We stock common effluent pumps and floats for Mid-Hudson installs.',
        'warranty' => 'Clearbasin warrants workmanship for 2 years on new installs when maintenance guidelines are followed. Manufacturer warranties on tanks and ATUs still apply.',
        'permit' => 'Dutchess, Ulster, and Orange County permits are required for most new systems and major repairs. We prepare drawings and submit applications with your soil data.',
        'cost' => 'Hudson Valley conventional installs often range from $12,000–$35,000+ depending on soil, tank, field length, and rock. Exact quotes follow a site evaluation.',
        'schedule' => 'Peak seasons are late spring through early fall when soils are workable. Book 3–6 weeks ahead for installs; emergency backups get priority triage.',
        'payment' => 'We accept card, ACH, and check. A deposit holds the excavator schedule; progress payments align with tank set and final inspection.',
        'smell' => 'Odors near the tank lid or field can mean a full tank, blocked vent, or failing field. Avoid chemical “miracle” additives — schedule a diagnostic visit.',
        'maintenance' => 'Pump residential tanks every 3–5 years (sooner with garbage disposals or high occupancy). Keep vehicles and trees off the drain field.',
    ];

    public function chat(string $message, string $context = 'public'): string
    {
        $message = trim($message);
        if ($message === '') {
            return 'Ask us anything about septic installation, tanks, drain fields, permits, or scheduling.';
        }

        if ($reply = $this->callProvider($message, $context)) {
            return $reply;
        }

        return $this->demoReply($message, $context);
    }

    public function generateContent(string $prompt, string $type = 'blog'): string
    {
        $system = match ($type) {
            'service' => 'Write a concise septic installation service description for Clearbasin Septic Systems in Poughkeepsie, NY (Hudson Valley).',
            'automation' => 'Suggest practical ERP automation ideas for a residential septic installation contractor.',
            'troubleshoot' => 'Help a septic company admin troubleshoot operations, scheduling, inventory, or field failures.',
            default => 'Write helpful blog content for homeowners about septic systems, maintenance, and installation.',
        };

        if ($reply = $this->callProvider($prompt, $type, $system)) {
            return $reply;
        }

        return $this->demoContent($prompt, $type);
    }

    protected function callProvider(string $message, string $context, ?string $system = null): ?string
    {
        $system ??= 'You are the helpful assistant for Clearbasin Septic Systems, a Hudson Valley NY septic installer based in Poughkeepsie. Be concise, practical, and friendly. Never invent fake licenses or soil results.';

        $openaiKey = config('services.openai.key') ?: env('OPENAI_API_KEY');
        if ($openaiKey) {
            try {
                $response = Http::withToken($openaiKey)
                    ->timeout(25)
                    ->post('https://api.openai.com/v1/chat/completions', [
                        'model' => env('OPENAI_MODEL', 'gpt-4o-mini'),
                        'messages' => [
                            ['role' => 'system', 'content' => $system],
                            ['role' => 'user', 'content' => $message],
                        ],
                        'temperature' => 0.5,
                    ]);

                if ($response->successful()) {
                    return trim((string) data_get($response->json(), 'choices.0.message.content'));
                }
            } catch (\Throwable) {
                // fall through
            }
        }

        $geminiKey = config('services.gemini.key') ?: env('GEMINI_API_KEY');
        if ($geminiKey) {
            try {
                $response = Http::timeout(25)
                    ->post('https://generativelanguage.googleapis.com/v1beta/models/'.env('GEMINI_MODEL', 'gemini-1.5-flash').':generateContent?key='.$geminiKey, [
                        'contents' => [
                            ['parts' => [['text' => $system."\n\nUser: ".$message]]],
                        ],
                    ]);

                if ($response->successful()) {
                    return trim((string) data_get($response->json(), 'candidates.0.content.parts.0.text'));
                }
            } catch (\Throwable) {
                // fall through
            }
        }

        return null;
    }

    protected function demoReply(string $message, string $context): string
    {
        $lower = Str::lower($message);

        foreach ($this->faq as $key => $answer) {
            if (Str::contains($lower, $key) || Str::contains($lower, Str::plural($key))) {
                return $answer.' (Demo FAQ mode — add OPENAI_API_KEY or GEMINI_API_KEY for live AI.)';
            }
        }

        if (Str::contains($lower, ['price', 'cost', 'how much', 'quote'])) {
            return $this->faq['cost'].' (Demo FAQ mode.)';
        }

        if (Str::contains($lower, ['book', 'appoint', 'when', 'avail'])) {
            return $this->faq['schedule'].' (Demo FAQ mode.)';
        }

        if (Str::contains($lower, ['leach', 'field', 'perc'])) {
            return $this->faq['drain'].' (Demo FAQ mode.)';
        }

        if ($context === 'troubleshoot') {
            return 'Check job status, excavator assignment, and weather/soil hold flags first. Confirm tank SKUs on the job ticket match inventory, then re-sync the inspection calendar. (Demo mode.)';
        }

        return 'Thanks for reaching out to Clearbasin. We handle new septic installs, tank replacements, drain-field repairs, and pump stations across the Hudson Valley. Ask about estimates, permits, warranties, maintenance, or scheduling — or call (845) 555-0192. (Demo FAQ mode.)';
    }

    protected function demoContent(string $prompt, string $type): string
    {
        return match ($type) {
            'service' => "## Crafted for {$prompt}\n\nClearbasin crews evaluate soil, size tanks to code, set systems level, and restore the yard after inspection. Expect clear timelines, daily updates, and a tidy jobsite.",
            'automation' => "1. Auto-create site-evaluation appointments from web leads.\n2. Low-stock alerts for tanks, chambers, and effluent pumps.\n3. Rain/soil-moisture based install reschedule suggestions.\n4. Invoice draft when job status hits completed/inspected.\n5. Pump-out reminder emails 3 years after install.\n\nPrompt: {$prompt}",
            'troubleshoot' => "Likely causes for \"{$prompt}\": calendar overlap, missing tank reservation, unpaid deposit blocking schedule lock, or pending county permit. Verify the job record, inventory pulls, and invoice status before reassigning crews.",
            default => "# {$prompt}\n\nHomeowners often underestimate soil and setbacks. Perc test, size the tank, design the field, then excavate. Clearbasin documents each stage so your system passes inspection and lasts through Hudson Valley freeze-thaw cycles.\n\n(Demo generator — configure API keys for live content.)",
        };
    }
}
