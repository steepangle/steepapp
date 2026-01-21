<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArchiveItem;
use Illuminate\Support\Facades\Auth;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the archive items.
     */
    public function index()
    {
        $user = Auth::user();

        // Get the IDs of the user's groups
        $userGroupIds = $user ? $user->groups()->pluck('id')->toArray() : [];

        // Access map for blade display
        $accessMap = [
            'omega'  => ['symbol' => '🟥 Ω', 'name' => 'Supreme Root Access', 'color' => '#ff0000'],
            'phi'    => ['symbol' => '🟧 Φ', 'name' => 'Prime Directive Access', 'color' => '#ff6600'],
            'sigma'  => ['symbol' => '🟨 Σ', 'name' => 'System Integrity Access', 'color' => '#ffd500'],
            'delta'  => ['symbol' => '🟩 Δ', 'name' => 'Director Access', 'color' => '#33cc33'],
            'lambda' => ['symbol' => '🟦 Λ', 'name' => 'Licensed Access', 'color' => '#3399ff'],
            'theta'  => ['symbol' => '🟪 Θ', 'name' => 'Trusted Network Access', 'color' => '#9966ff'],
            'psi'    => ['symbol' => '⚪ Ψ', 'name' => 'Public Protocol Access', 'color' => '#cccccc'],
            'chi'    => ['symbol' => '⛔ Χ', 'name' => 'Restricted / Quarantined', 'color' => '#000000'],
        ];

        // Query archive items with access control
        $archiveItems = ArchiveItem::where(function ($query) use ($userGroupIds) {
            $query->where('access_level', 'public')
                ->orWhereExists(function ($subquery) use ($userGroupIds) {
                    $subquery->selectRaw('1')
                        ->from('archive_item_user_groups')
                        ->whereColumn('archive_item_user_groups.archive_item_id', 'archive_items.id')
                        ->whereIn('archive_item_user_groups.user_group_id', $userGroupIds);
                });
        })->get();

        return view('archives.index', compact('archiveItems', 'accessMap'));
    }
}
