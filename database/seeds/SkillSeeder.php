<?php

use App\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = ['Account Analysis','Actuarial ','Aging Reports','Annual Reports','Asset Management','Audit Schedules','Audits','Balance Sheets','Banking','Budgets','Business Awareness','Business Development','Business Restructring','Certified Public Accountant (CPA)','Chart of Accounts','Compliance','Consulting','Corporate Reports','Corporate Tax','Cost Accounting','Credit Management','Credits','Cyber Security','Data Analysis','Debt Management','Digital Strategy','Dispute Resolution','Finacial Law','Finance','Financial Advisory','Financial Analysis','Financial Due Diligence','Financial Reporting','Financial Statement Analysis','Financial Statements','Fixed Assets','Forensic ','Fraud','Global Mobilty','Human Resources Consulting','Human Resources Management','Immegration Consulting','Income Tax','Internal Auditing','Investigation','Invoices','Job Cost Reports','Law','Learning and Development','Management Consulting','Marketing','Merger and Acquisition','Modelling','Oracle','Payroll','Payroll Liabilities','Payroll Taxes','Performance Management','Personal Tax','Private Equity','Process Assurance','Project Finance','Project Management','Recruitment','Regulation','Regulatory Filings','Reporting','Research and Development (R&D)','Risk Assurance','Risk Management','Sales Receipts','SAP','Social Security','Staffing and Deployment','State Tax Law','Strategy Consulting','Sustainability','Tax Analysis','Tax Compliance','Tax Filing','Tax Law','Tax Liabilities','Tax Reporting','Tax Returns','Tax Technology','Technology Consulting','Transaction Services','Transfer Pricing','Transformation','Trial Balance','UI / UX Design','Valuation','Year-End Reporting'];
        foreach ($skills as $skill)
        {
            Skill::create(['name' => $skill]);
        }
    }
}
