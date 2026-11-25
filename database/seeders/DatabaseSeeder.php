<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Job;
use App\Models\KbArticle;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin', 'manager', 'staff'] as $role) {
            Role::findOrCreate($role);
        }

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Clearbasin Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '(845) 555-0192',
            ]
        );
        $admin->syncRoles(['admin']);

        $manager = User::query()->updateOrCreate(
            ['email' => 'manager@clearbasin.example'],
            [
                'name' => 'Riley Vaughn',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'phone' => '(845) 555-0195',
            ]
        );
        $manager->syncRoles(['manager']);

        $staff = User::query()->updateOrCreate(
            ['email' => 'crew@clearbasin.example'],
            [
                'name' => 'Devon Park',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'phone' => '(845) 555-0198',
            ]
        );
        $staff->syncRoles(['staff']);

        $settings = [
            'company_name' => 'Clearbasin Septic Systems',
            'phone' => '(845) 555-0192',
            'email' => 'hello@clearbasinseptic.example',
            'address' => '418 Mill Street, Poughkeepsie, NY 12601',
            'whatsapp' => '+18455550192',
            'service_area' => 'Poughkeepsie, Kingston, Newburgh, Beacon, Rhinebeck, Hyde Park',
        ];
        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }

        $services = [
            [
                'name' => 'New Septic System Installation',
                'slug' => 'new-septic-system-installation',
                'tagline' => 'Tank, field, and inspection-ready',
                'summary' => 'Full conventional or chamber-system installs matched to soil tests and bedroom count.',
                'description' => "We coordinate perc/soil data, size the tank and drain field to county code, excavate carefully, set tanks level, and backfill after inspection.\nTypical install window: 3–10 days depending on rock, weather, and inspector availability.",
                'image_url' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1200&q=80',
                'base_price' => 18500,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Septic Tank Replacement',
                'slug' => 'septic-tank-replacement',
                'tagline' => 'Swap failed tanks without redesigning the field',
                'summary' => 'Pump-out, excavate, set a new concrete or poly tank, and reconnect inlet/outlet lines.',
                'description' => "When the tank is cracked or undersized but the field still performs, we replace the tank in place.\nIncludes risers, lids, and baffles; field evaluation recommended before booking.",
                'image_url' => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&w=1200&q=80',
                'base_price' => 6800,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Drain Field Repair & Rebuild',
                'slug' => 'drain-field-repair-rebuild',
                'tagline' => 'Restore percolation or redesign laterals',
                'summary' => 'Diagnose soggy yards and backups, then repair laterals or install a new absorption area.',
                'description' => "We camera and probe fields, check distribution boxes, and propose rest, repair, or full rebuild.\nChamber systems and engineered fill options are available when native soils are limiting.",
                'image_url' => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?auto=format&fit=crop&w=1200&q=80',
                'base_price' => 9200,
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Pump Station & Effluent Pump',
                'slug' => 'pump-station-effluent-pump',
                'tagline' => 'Lift effluent when gravity is not enough',
                'summary' => 'Install or service pump basins, floats, alarms, and effluent pumps for uphill fields.',
                'description' => "Clearbasin stocks common effluent pumps and control panels for Mid-Hudson installs.\nAlarms are tested before we leave; homeowners get a simple float checklist.",
                'image_url' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=1200&q=80',
                'base_price' => 4100,
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'name' => 'Soil Test & Permit Coordination',
                'slug' => 'soil-test-permit-coordination',
                'tagline' => 'Perc data and county paperwork handled',
                'summary' => 'Site evaluation, soil/perc coordination, drawings, and permit submission for new or replacement systems.',
                'description' => "We walk the lot for setbacks, wells, and slopes, then prepare permit packages for Dutchess, Ulster, or Orange County.\nIdeal before building permits or real-estate contingencies.",
                'image_url' => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?auto=format&fit=crop&w=1200&q=80',
                'base_price' => 950,
                'is_featured' => false,
                'sort_order' => 5,
            ],
            [
                'name' => 'Emergency Backup Response',
                'slug' => 'emergency-backup-response',
                'tagline' => 'Fast triage when sewage won’t drain',
                'summary' => 'Priority diagnostics for backups, odors, and alarm calls — pump-out coordination and temporary fixes.',
                'description' => "Call us for gurgling fixtures, wet spots over the field, or tank alarms.\nWe stabilize the home, recommend pump-out if needed, and schedule permanent repairs.",
                'image_url' => 'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?auto=format&fit=crop&w=1200&q=80',
                'base_price' => 450,
                'is_featured' => false,
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::query()->updateOrCreate(['slug' => $service['slug']], $service);
        }

        $products = [
            ['name' => '1000 Gal Concrete Septic Tank', 'sku' => 'TNK-CON-1000', 'category' => 'Tanks', 'unit_cost' => 980, 'unit_price' => 1450, 'stock_qty' => 6, 'unit' => 'each', 'reorder_level' => 2],
            ['name' => '1250 Gal Poly Septic Tank', 'sku' => 'TNK-PLY-1250', 'category' => 'Tanks', 'unit_cost' => 1120, 'unit_price' => 1680, 'stock_qty' => 4, 'unit' => 'each', 'reorder_level' => 1],
            ['name' => 'Chamber Leach Unit 4ft', 'sku' => 'CHM-LCH-4', 'category' => 'Drain Field', 'unit_cost' => 42, 'unit_price' => 68, 'stock_qty' => 120, 'unit' => 'each', 'reorder_level' => 40],
            ['name' => 'Effluent Pump 1/2 HP', 'sku' => 'PMP-EFF-050', 'category' => 'Pumps', 'unit_cost' => 210, 'unit_price' => 345, 'stock_qty' => 14, 'unit' => 'each', 'reorder_level' => 4],
            ['name' => '24in Tank Riser + Lid', 'sku' => 'RIS-24-LID', 'category' => 'Accessories', 'unit_cost' => 55, 'unit_price' => 95, 'stock_qty' => 28, 'unit' => 'set', 'reorder_level' => 8],
            ['name' => 'Distribution Box 4-Outlet', 'sku' => 'DBX-4OUT', 'category' => 'Drain Field', 'unit_cost' => 78, 'unit_price' => 125, 'stock_qty' => 18, 'unit' => 'each', 'reorder_level' => 5],
        ];
        foreach ($products as $product) {
            Product::query()->updateOrCreate(['sku' => $product['sku']], $product);
        }

        $customers = [
            ['name' => 'Hannah Morse', 'email' => 'hannah.morse@example.com', 'phone' => '(845) 555-3301', 'address' => '22 Orchard Ridge Rd', 'city' => 'Poughkeepsie', 'state' => 'NY', 'zip' => '12603'],
            ['name' => 'Luis Ortega', 'email' => 'luis.ortega@example.com', 'phone' => '(845) 555-3308', 'address' => '910 River Road', 'city' => 'Hyde Park', 'state' => 'NY', 'zip' => '12538'],
            ['name' => 'Ava Lindstrom', 'email' => 'ava.lindstrom@example.com', 'phone' => '(845) 555-3315', 'address' => '44 Maple Hollow Ln', 'city' => 'Rhinebeck', 'state' => 'NY', 'zip' => '12572'],
            ['name' => 'The Keller Household', 'email' => 'keller.home@example.com', 'phone' => '(845) 555-3320', 'address' => '701 Beacon View Ct', 'city' => 'Beacon', 'state' => 'NY', 'zip' => '12508'],
        ];
        $customerModels = [];
        foreach ($customers as $customer) {
            $customerModels[] = Customer::query()->updateOrCreate(['email' => $customer['email']], $customer);
        }

        $newInstall = Service::query()->where('slug', 'new-septic-system-installation')->first();
        $tankReplace = Service::query()->where('slug', 'septic-tank-replacement')->first();

        $jobs = [
            [
                'job_number' => 'CB-2401',
                'customer_id' => $customerModels[0]->id,
                'service_id' => $tankReplace?->id,
                'assigned_to' => $staff->id,
                'title' => 'Morse 1000-gal tank replacement',
                'status' => 'completed',
                'priority' => 'normal',
                'property_address' => '22 Orchard Ridge Rd, Poughkeepsie',
                'scheduled_start' => now()->subDays(20)->toDateString(),
                'scheduled_end' => now()->subDays(18)->toDateString(),
                'estimated_amount' => 7200,
                'final_amount' => 7450,
            ],
            [
                'job_number' => 'CB-2408',
                'customer_id' => $customerModels[1]->id,
                'service_id' => $newInstall?->id,
                'assigned_to' => $staff->id,
                'title' => 'Ortega new conventional system',
                'status' => 'in_progress',
                'priority' => 'high',
                'property_address' => '910 River Road, Hyde Park',
                'scheduled_start' => now()->subDays(2)->toDateString(),
                'scheduled_end' => now()->addDays(4)->toDateString(),
                'estimated_amount' => 24800,
                'final_amount' => null,
            ],
            [
                'job_number' => 'CB-2412',
                'customer_id' => $customerModels[2]->id,
                'service_id' => $newInstall?->id,
                'assigned_to' => $manager->id,
                'title' => 'Lindstrom chamber field install',
                'status' => 'scheduled',
                'priority' => 'normal',
                'property_address' => '44 Maple Hollow Ln, Rhinebeck',
                'scheduled_start' => now()->addDays(5)->toDateString(),
                'scheduled_end' => now()->addDays(9)->toDateString(),
                'estimated_amount' => 21900,
                'final_amount' => null,
            ],
        ];

        $jobModels = [];
        foreach ($jobs as $job) {
            $jobModels[] = Job::query()->updateOrCreate(['job_number' => $job['job_number']], $job);
        }

        $invoice = Invoice::query()->updateOrCreate(
            ['invoice_number' => 'INV-2401'],
            [
                'customer_id' => $customerModels[0]->id,
                'job_id' => $jobModels[0]->id,
                'issue_date' => now()->subDays(16)->toDateString(),
                'due_date' => now()->subDays(2)->toDateString(),
                'status' => 'paid',
                'subtotal' => 7450,
                'tax' => 596,
                'total' => 8046,
                'amount_paid' => 8046,
                'notes' => 'Thank you for choosing Clearbasin.',
            ]
        );

        Payment::query()->updateOrCreate(
            ['reference' => 'ACH-99211'],
            [
                'invoice_id' => $invoice->id,
                'amount' => 8046,
                'paid_at' => now()->subDays(10)->toDateString(),
                'method' => 'ach',
                'notes' => 'Final payment',
            ]
        );

        Invoice::query()->updateOrCreate(
            ['invoice_number' => 'INV-2408'],
            [
                'customer_id' => $customerModels[1]->id,
                'job_id' => $jobModels[1]->id,
                'issue_date' => now()->subDay()->toDateString(),
                'due_date' => now()->addDays(14)->toDateString(),
                'status' => 'sent',
                'subtotal' => 8000,
                'tax' => 640,
                'total' => 8640,
                'amount_paid' => 4000,
                'notes' => 'Deposit invoice for new septic install',
            ]
        );

        Appointment::query()->updateOrCreate(
            ['title' => 'Lindstrom soil & setback walkthrough'],
            [
                'customer_id' => $customerModels[2]->id,
                'job_id' => $jobModels[2]->id,
                'assigned_to' => $manager->id,
                'type' => 'estimate',
                'status' => 'confirmed',
                'starts_at' => now()->addDays(2)->setTime(10, 0),
                'ends_at' => now()->addDays(2)->setTime(11, 15),
                'location' => '44 Maple Hollow Ln, Rhinebeck',
            ]
        );

        Appointment::query()->updateOrCreate(
            ['title' => 'Ortega mid-install inspection prep'],
            [
                'customer_id' => $customerModels[1]->id,
                'job_id' => $jobModels[1]->id,
                'assigned_to' => $staff->id,
                'type' => 'walkthrough',
                'status' => 'scheduled',
                'starts_at' => now()->addDay()->setTime(14, 0),
                'ends_at' => now()->addDay()->setTime(14, 45),
                'location' => '910 River Road, Hyde Park',
            ]
        );

        $posts = [
            [
                'title' => 'Why Hudson Valley soils change drain-field design',
                'slug' => 'hudson-valley-soils-drain-fields',
                'excerpt' => 'Glacial till, clay pockets, and high water tables mean one size never fits all.',
                'body' => "Mid-Hudson soils vary lot to lot. A fast perc on one side of a driveway can fail twenty feet away.\n\nClearbasin walks setbacks, probes restrictive layers, and sizes chamber or conventional fields from real data — not a catalog sketch.\n\nIf you are buying land, budget for a soil test before assuming a septic will “just fit.”",
                'cover_image' => 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?auto=format&fit=crop&w=1200&q=80',
                'category' => 'design',
                'is_published' => true,
                'published_at' => now()->subDays(12),
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Septic tank pumping: how often is enough?',
                'slug' => 'septic-tank-pumping-schedule',
                'excerpt' => 'Skip the calendar myths — occupancy and garbage disposals matter more.',
                'body' => "A three-bedroom home with two people may go 4–5 years between pump-outs. Add a disposal and weekend guests, and sludge builds faster.\n\nWe recommend an inspection every 3 years and pumping based on measured solids — not a fixed guess. Keep records; buyers and inspectors ask.",
                'cover_image' => 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?auto=format&fit=crop&w=1200&q=80',
                'category' => 'maintenance',
                'is_published' => true,
                'published_at' => now()->subDays(7),
                'author_id' => $manager->id,
            ],
            [
                'title' => 'What to expect on septic install day',
                'slug' => 'what-to-expect-septic-install-day',
                'excerpt' => 'Equipment access, inspection holds, and lawn restoration — a homeowner checklist.',
                'body' => "Day one is excavation and tank set. Laterals or chambers follow once elevations check out. County inspectors typically want to see open trenches before backfill.\n\nClearbasin stakes the field, protects trees where possible, and grades the yard after approval. Keep vehicles off the field forever — compaction kills percolation.",
                'cover_image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=80',
                'category' => 'tips',
                'is_published' => true,
                'published_at' => now()->subDays(3),
                'author_id' => $admin->id,
            ],
        ];
        foreach ($posts as $post) {
            Post::query()->updateOrCreate(['slug' => $post['slug']], $post);
        }

        $articles = [
            [
                'title' => 'Soggy yard over the leach field',
                'slug' => 'soggy-yard-leach-field',
                'category' => 'common-issues',
                'summary' => 'Wet spots and lush grass often signal a saturated or failing absorption area.',
                'body' => "1. Stop heavy water use and laundry loads.\n2. Confirm the tank is not overdue for pumping.\n3. Check for crushed laterals or a tipped D-box.\n4. Schedule a Clearbasin diagnostic before adding chemical additives.\nDriving over the field worsens compaction — keep traffic off.",
                'sort_order' => 1,
            ],
            [
                'title' => 'Step-by-step: preparing for a septic install',
                'slug' => 'prep-for-septic-install',
                'category' => 'guides',
                'summary' => 'What homeowners can do before excavators arrive.',
                'body' => "1. Mark private utilities (sprinklers, pet fence, wells).\n2. Clear access for dump trucks and the excavator.\n3. Secure pets and plan alternate laundry if needed.\n4. Confirm permit approvals are in hand.\n5. Discuss final grade and seed with your crew lead.\nWe handle municipal dig-safe tickets for public utilities.",
                'sort_order' => 2,
            ],
            [
                'title' => 'Admin manual: creating a septic job in ERP',
                'slug' => 'admin-manual-create-job',
                'category' => 'admin-manual',
                'summary' => 'How staff open jobs, assign crews, and link invoices.',
                'body' => "1. Create or select the customer.\n2. Open Jobs → Create.\n3. Assign service type and excavator crew.\n4. Set status to scheduled once deposit and permit notes are logged.\n5. Add appointments for site eval, install days, and inspection.\n6. When complete, create invoice and record payment.\nManagers can override priority; staff should not void invoices.",
                'sort_order' => 3,
            ],
            [
                'title' => 'Troubleshooting: inventory shows negative tank stock',
                'slug' => 'troubleshoot-negative-tank-stock',
                'category' => 'troubleshooting',
                'summary' => 'Usually a missed receiving entry or double job pull.',
                'body' => "1. Check recent job material notes for tank SKUs.\n2. Confirm purchase receipts were entered.\n3. Adjust stock with a counted physical inventory.\n4. Raise reorder_level if crews stage spare tanks before peak season.\nUse AI Assistants → Troubleshooting for suggested automation rules.",
                'sort_order' => 4,
            ],
            [
                'title' => 'Protecting drain fields in winter',
                'slug' => 'protect-drain-fields-winter',
                'category' => 'guides',
                'summary' => 'Snow cover helps; vehicles and frozen pipes do not.',
                'body' => "Leave snow on the field for insulation. Avoid plowing across laterals. Insulate exposed risers and keep an eye on pump-station alarms during deep freezes.\nIf backups occur only in cold snaps, ask us about frozen lines vs. field saturation.",
                'sort_order' => 5,
            ],
            [
                'title' => 'Admin manual: AI content & chatbot modes',
                'slug' => 'admin-manual-ai-tools',
                'category' => 'admin-manual',
                'summary' => 'How demo FAQ mode and live API keys work.',
                'body' => "Public chatbot uses FAQ fallbacks when OPENAI_API_KEY and GEMINI_API_KEY are empty.\nIn /admin → AI Assistants you can generate blog drafts, service copy, automation ideas, and troubleshooting notes.\nNever paste customer secrets into prompts.",
                'sort_order' => 6,
            ],
        ];
        foreach ($articles as $article) {
            KbArticle::query()->updateOrCreate(
                ['slug' => $article['slug']],
                $article + ['is_published' => true]
            );
        }
    }
}
