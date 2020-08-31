<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'type' => 'admin',
            'email' => 'support@backtoschool.am',
            'password' => bcrypt('5%U9y9mt'),
            'remember_token' => Str::random(10),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        DB::table('faqs')->insert([
            'order' => '1',
            'question' => 'Ո՞Վ ԿԱՐՈՂ Է ՄԱՍՆԱԿՑԵԼ ԱԿՑԻԱՅԻՆ',
            'answer' => 'Ակցիային կարող են մասնակցել 14 (տասնչորս) տարին լրացած ՀՀ բոլոր գործունակ քաղաքացիները և  այն անձինք, ովքեր ՀՀ-ում ունեն բնակության թույլտվություն, Ակցիայի ընթացքում մշտական բնակվում են ՀՀ տարածքում (Այսուհետ՝ Ակցիայի Մասնակից):',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        DB::table('faqs')->insert([
            'order' => '1',
            'question' => 'ԻՆՉՊԵ՞Ս ՄԱՍՆԱԿՑԵԼ ԱԿՑԻԱՅԻՆ',
            'answer' => 'Ակցիային կարող են մասնակցել 14 (տասնչորս) տարին լրացած ՀՀ բոլոր գործունակ քաղաքացիները և  այն անձինք, ովքեր ՀՀ-ում ունեն բնակության թույլտվություն, Ակցիայի ընթացքում մշտական բնակվում են ՀՀ տարածքում (Այսուհետ՝ Ակցիայի Մասնակից):',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        DB::table('faqs')->insert([
            'order' => '1',
            'question' => 'ԱԿՑԻԱՅԻ ԱՆՑԿԱՑՄԱՆ ԺԱՄԿԵՏՆԵՐԸ',
            'answer' => 'Ակցիային կարող են մասնակցել 14 (տասնչորս) տարին լրացած ՀՀ բոլոր գործունակ քաղաքացիները և  այն անձինք, ովքեր ՀՀ-ում ունեն բնակության թույլտվություն, Ակցիայի ընթացքում մշտական բնակվում են ՀՀ տարածքում (Այսուհետ՝ Ակցիայի Մասնակից):',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        // $this->call(UserSeeder::class);
    }
}
