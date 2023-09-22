<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'PwC Türkiye' => ['crm' => 'e71b1703-df12-e711-811a-02bf0a36f0c4', 'group' => 'pwc', 'desc' => 'PwC Türkiye ile ilgili bildirimleri almak istiyorum.'],
            'PwC Vergi' => ['crm' => 'e91b1703-df12-e711-811a-02bf0a36f0c4', 'group' => 'pwc', 'desc' => 'PwC Vergi ile ilgili bildirimleri almak istiyorum.'],
            'PwC Gümrük' => ['crm' => 'eb1b1703-df12-e711-811a-02bf0a36f0c4', 'group' => 'pwc', 'desc' => 'PwC Gümrük ile ilgili bildirimleri almak istiyorum.'],
            'PwC Business School' => ['crm' => 'ed1b1703-df12-e711-811a-02bf0a36f0c4', 'group' => 'pwc', 'desc' => 'PwC Business School ile ilgili bildirimleri almak istiyorum.'],
            'PwC GSG Hukuk' => ['crm' => '5a507808-f03f-e911-9585-02bf0a36f0c4', 'group' => 'pwc', 'desc' => 'GSG Hukuk ile ilgili bildirimleri almak istiyorum.'],
            'PwC Alumni' => ['crm' => 'ef1b1703-df12-e711-811a-02bf0a36f0c4', 'group' => 'alumni', 'desc' => 'PwC Türkiye Alumni ile ilgili bildirimleri almak istiyorum.'],
            'Ayrıcalık / İndirim' => ['crm' => 'AyricalikindirimMailing', 'group' => 'alumni', 'desc' => 'Ayrıcalıklarla ile ilgili bildirimleri almak istiyorum.'],
            'İş ilanları' => ['crm' => 'AlumniIsilanlariMailing', 'group' => 'alumni', 'desc' => 'Kariyer fırsatları ile ilgili bildirimleri almak istiyorum.'],
            'Directory' => ['crm' => null, 'group' => 'system', 'desc' => 'Directory İzni'],
        ];
        // truncate the table before populate
        DB::table('permissions')->delete();

        // populate the database
        foreach ($permissions as $key => $permission) {
            DB::table('permissions')->insert([
                'crm' => $permission['crm'],
                'name' => trim($key),
                'group' => $permission['group'],
                'slug' => Str::slug(trim($key)),
                'desc' => $permission['desc'],
                'editable' => $permission['editable'] ?? true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
