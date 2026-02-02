<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Add this import

class DashboardController extends Controller
{
    /**
     * Display a listing of tasks.
     */
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }
        
        // Get all tasks for the user
        $allTasks = Task::where('user_id', $user->id);
        
        // Calculate statistics
        $stats = [
            'total' => $allTasks->count(),
            'today' => Task::where('user_id', $user->id)
                ->whereDate('created_at', today())
                ->count(),
            'this_week' => Task::where('user_id', $user->id)
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->count(),
            'recent' => Task::where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get()
        ];
        
        // Get paginated tasks
        $tasks = Task::where('user_id', $user->id)
            ->latest()
            ->paginate(10);
        
        return view('Dashboard', compact('tasks', 'stats'));
    }

    
}