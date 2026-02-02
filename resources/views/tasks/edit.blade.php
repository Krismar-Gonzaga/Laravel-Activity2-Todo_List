@extends('layouts.app')

@section('title', 'Edit Task - TaskFlow')

@push('styles')
<style>
    .task-form-container {
        max-width: 600px;
        margin: 2rem auto;
        padding: 0 1.5rem;
    }
    
    .form-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        padding: 2rem;
    }
    
    .form-header {
        margin-bottom: 2rem;
        text-align: center;
    }
    
    .form-header h1 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 0.5rem;
    }
    
    .form-header p {
        color: #64748b;
        font-size: 0.875rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #334155;
        margin-bottom: 0.5rem;
    }
    
    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.9375rem;
        color: #334155;
        transition: border-color 0.2s;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #1a1a1a;
        box-shadow: 0 0 0 3px rgba(26, 26, 26, 0.1);
    }
    
    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }
    
    .form-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }
    
    .priority-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .priority-high { background: #fef2f2; color: #ef4444; }
    .priority-medium { background: #fffbeb; color: #f59e0b; }
    .priority-low { background: #f1f5f9; color: #475569; }
    
    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e2e8f0;
    }
    
    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-size: 0.9375rem;
        font-weight: 500;
        transition: all 0.2s;
        cursor: pointer;
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-primary {
        background: #1a1a1a;
        color: white;
        flex: 1;
        justify-content: center;
    }
    
    .btn-primary:hover {
        background: #2d2d2d;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .btn-outline {
        background: white;
        color: #475569;
        border: 1px solid #e2e8f0;
    }
    
    .btn-outline:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }
    
    .alert {
        padding: 1rem 1.25rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .alert-error {
        background: #fef2f2;
        color: #ef4444;
        border: 1px solid #fecaca;
    }
    
    .alert i {
        font-size: 1.125rem;
    }
</style>
@endpush

@section('content')
<div class="task-form-container">
    @if ($errors->any())
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span>Please fix the following errors:</span>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="form-card">
        <div class="form-header">
            <h1>Edit Task</h1>
            <p>Update your task details below</p>
        </div>
        
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title" class="form-label">Task Title *</label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       class="form-control" 
                       value="{{ old('title', $task->title) }}" 
                       required 
                       placeholder="Enter task title">
            </div>
            
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" 
                          name="description" 
                          class="form-control form-textarea" 
                          placeholder="Enter task description (optional)">{{ old('description', $task->description) }}</textarea>
            </div>
            
            <div class="form-group">
                <label for="priority" class="form-label">Priority</label>
                <select id="priority" name="priority" class="form-control form-select">
                    <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="due_date" class="form-label">Due Date (Optional)</label>
                <input type="datetime-local" 
                       id="due_date" 
                       name="due_date" 
                       class="form-control" 
                       value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d\TH:i') : '') }}">
            </div>
            
            <div class="form-group">
                <div class="form-label">Current Status</div>
                <div class="priority-badge priority-{{ $task->priority ?? 'low' }}">
                    {{ ucfirst($task->priority ?? 'low') }} Priority
                </div>
                @if($task->is_completed)
                    <div class="priority-badge" style="background: #ecfdf5; color: #10b981; margin-top: 0.5rem;">
                        <i class="fas fa-check-circle"></i> Completed
                    </div>
                @endif
            </div>
            
            <div class="form-actions">
                <a href="{{ route('dashboard') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i>
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Update Task
                </button>
            </div>
        </form>
    </div>
</div>
@endsection