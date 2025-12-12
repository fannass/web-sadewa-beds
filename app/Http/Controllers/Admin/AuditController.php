<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Audit;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        $query = Audit::with(['room', 'user'])->orderBy('created_at', 'desc');

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->filled('status')) {
            $query->where('new_status', $request->status);
        }

        $audits = $query->paginate(20);

        return view('admin.audits', compact('audits'));
    }
}
