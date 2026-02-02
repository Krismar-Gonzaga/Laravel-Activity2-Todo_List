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
    public function index(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }
        
        // Get search query
        $query = trim($request->get('query', ''));
        
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
        
        // Get paginated tasks - apply search filter if query exists
        $tasksQuery = Task::where('user_id', $user->id);
        
        if (!empty($query)) {
            $tasksQuery->where(function($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%');
            });
        }
        
        $tasks = $tasksQuery->latest()
            ->paginate(10)
            ->appends($request->only('query'));
        
        return view('Dashboard', compact('tasks', 'stats', 'query'));
    }

    
}