<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Menu;
use Illuminate\Support\Facades\File;

class MigrateMenuData extends Command
{
    protected $signature = 'menu:migrate';
    protected $description = 'Migrate JSON menu items to DB';

    public function handle()
    {
        $path = public_path('data/menu.json');
        
        if (!File::exists($path)) {
            $this->error('No JSON file found!');
            return;
        }

        $json = File::get($path);
        $decoded = json_decode($json, true);
        
        $menus = $decoded['menus'] ?? [];
        foreach ($menus as $item) {
            Menu::updateOrCreate(
                ['id' => $item['id']],
                [
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'image' => $item['image'] ?? 'default.png',
                ]
            );
        }
        $this->info('Migrated successfully.');
    }
}
