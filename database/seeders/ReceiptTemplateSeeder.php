<?php

namespace Database\Seeders;

use App\Models\ReceiptTemplate;
use Illuminate\Database\Seeder;

class ReceiptTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'name' => 'Classic Receipt',
                'slug' => 'classic-receipt',
                'view_path' => 'payment.receipt-reprint.pdf',
                'description' => 'Standard two-copy payment receipt format.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Premium Green Receipt',
                'slug' => 'premium-green-receipt',
                'view_path' => 'payment.receipt-templates.premium-green',
                'description' => 'Formal real estate receipt with green project theme.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Compact Classic Receipt',
                'slug' => 'compact-receipt',
                'view_path' => 'payment.receipt-templates.compact',
                'description' => 'Clean compact receipt format with customer and payment details.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Corporate Slate Receipt',
                'slug' => 'corporate-slate-receipt',
                'view_path' => 'payment.receipt-templates.corporate-slate',
                'description' => 'Formal slate and white receipt for corporate use.',
                'sort_order' => 4,
            ],
            [
                'name' => 'Executive Gold Receipt',
                'slug' => 'executive-gold-receipt',
                'view_path' => 'payment.receipt-templates.executive-gold',
                'description' => 'Premium formal receipt with restrained gold accent.',
                'sort_order' => 5,
            ],
            [
                'name' => 'Minimal White Receipt',
                'slug' => 'minimal-white-receipt',
                'view_path' => 'payment.receipt-templates.minimal-white',
                'description' => 'Simple white receipt with clean green accent.',
                'sort_order' => 6,
            ],
        ];

        foreach ($templates as $template) {
            ReceiptTemplate::updateOrCreate(
                ['slug' => $template['slug']],
                [
                    ...$template,
                    'status' => 'active',
                ]
            );
        }

        if (! ReceiptTemplate::where('is_active', true)->exists()) {
            ReceiptTemplate::where('slug', 'premium-green-receipt')->update(['is_active' => true]);
        }
    }
}
