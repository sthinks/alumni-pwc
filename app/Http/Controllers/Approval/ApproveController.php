<?php

namespace App\Http\Controllers\Approval;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApproveController extends Controller
{
    /**
     * Show repsonse page depending on logged in user is approved or not
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function show(Request $request)
    {
        $user = $request->user();

        // If user is already being approved, take him to the website
        if ($user->isApproved()) {
            if ($user->isAdmin()) {
                return redirect()->route('manager.campaigns.index');
            }
            return redirect()->route('home');
        }

        return response()->view('auth.not_approved');
    }
}
