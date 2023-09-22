<?php

namespace App\Http\Controllers\Alumni;

use App\Enums\TermConditionType;
use App\Http\Controllers\Controller;
use App\TermCondition;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function export(string $name) {
        $term = TermCondition::whereType($name)->firstOrFail();
        $filename = $name . '.pdf';
        switch ($name){
            case TermConditionType::UserAgreement:
                return Pdf::loadView('alumni.contract.export.user_agreement')->download($filename);
            case TermConditionType::ClarificationText:
                return Pdf::loadView('alumni.contract.export.clarify')->download($filename);
            default:
                abort(404);
        }
    }
}
