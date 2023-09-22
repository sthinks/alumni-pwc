<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PwCSubLosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sublos = ['Corporate Tax', 'Certification', 'M&A-ITS','R&D','Transfer Pricing','Indirect Tax', 'TRS', 'Accounting', 'Payroll', 'P&O', 'Global Mobility','HRC', 'Legal Total', 'Corporate Law', 'Dispute Resolution Services', 'Financial Law', 'Audit', 'Core Audit', 'Controls Assurance', 'Special', 'Audit - PwC Business School', 'Accounting Advisory', 'RAS', 'Risk Assurance', 'Cyber', 'CMAAS', 'Growth - Transaction Related', 'Growth - Other', 'Capital Raising - CM Advisory', 'Capital Raising - Other', 'Divestitures', 'Stress', 'Change - IFRS 15/16', 'CMAAS', 'CONSULTING', 'Finance', 'Customer', 'G&PS', 'Operations', 'Strategy&', 'Technology consulting', 'DEALS', 'TS', 'CF', 'BRS', 'VMA', 'FS', 'Acceleration Centre - EE', 'Acceleration Centre - SDC', 'Acceleration Centre - CC', 'Acceleration Centre - CoE', 'Acceleration Centre - German', 'Acceleration Centre - Tax', 'Acceleration Centre - Digital', 'Acceleration Centre - Admin', 'Bilgi Güvenliği', 'Bilgi Teknolojileri', 'Dil Hizmetleri', 'Eğitim & Gelişim', 'Finans', 'İdari işler', 'İnsan Kaynakları', 'MCBD', 'Hukuk'];
        foreach ($sublos as $sublo) {
            DB::table('pwc_sublos')->insert([
                'name' => $sublo,
            ]);
        }
    }
}
