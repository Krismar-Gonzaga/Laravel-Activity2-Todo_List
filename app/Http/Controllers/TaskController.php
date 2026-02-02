<?php

namespace App\Http\Controllers;

use App\Models\Task; // Add this import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Use Auth instead of Session

class TaskController extends Controller
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
            'this_week' => Task::where('ususer_ider_id', $user->id)
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

    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|in:low,medium,high',
            'due_date' => 'nullable|date',
            // Add other fields if needed
        ]);

        $task = new Task();
        $task->user_id = Auth::id();
        $task->title = $validated['title'];
        $task->description = $validated['description'] ?? null;
        $task->priority = $validated['priority'] ?? 'low';
        $task->due_date = $validated['due_date'] ?? null;
        $task->save();

        return redirect()->route('dashboard')
            ->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified task.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Task $task)
    {
        // Check if user owns this task
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Check if user owns this task
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);
        
        $task->update($validated);
        
        return redirect()->route('dashboard')
            ->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        // Check if user owns this task
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $task->delete();
        
        return redirect()->route('dashboard')
            ->with('success', 'Task deleted successfully!');
    }

    /**
     * Search tasks.
     */
    public function search(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }
        
        $query = trim($request->get('query', ''));
        
        // If query is empty, redirect to dashboard
        if (empty($query)) {
            return redirect()->route('dashboard');
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
        
        // Search tasks - search in both title and description
        $tasksQuery = Task::where('user_id', $user->id)
            ->where(function($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%');
            });
        
        $tasks = $tasksQuery->latest()
            ->paginate(10)
            ->appends($request->only('query'));
        
        return view('Dashboard', compact('tasks', 'stats', 'query'));
    }

    /**
 * Toggle task completion status.
 */
public function toggleStatus(Task $task)
{
    if ($task->user_id !== Auth::id()) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized'
        ], 403);
    }
    
    $task->update([
        'is_completed' => !$task->is_completed,
        'completed_at' => $task->is_completed ? null : now(),
    ]);
    
    return response()->json([
        'success' => true,
        'is_completed' => $task->is_completed,
        'message' => $task->is_completed ? 'Task marked as complete!' : 'Task marked as incomplete!'
    ]);
}
}