@extends('layouts.app')

@section('title', 'Create New Task - TaskFlow')

@push('styles')
<style>
    /* =========== CSS VARIABLES (Matching Dashboard) =========== */
    :root {
        --black: #1a1a1a;
        --white: #ffffff;
        --slate-50: #f8fafc;
        --slate-100: #f1f5f9;
        --slate-200: #e2e8f0;
        --slate-300: #cbd5e1;
        --slate-400: #94a3b8;
        --slate-500: #64748b;
        --slate-600: #475569;
        --slate-700: #334155;
        --slate-800: #1e293b;
        --slate-900: #0f172a;
        
        --emerald-50: #ecfdf5;
        --emerald-100: #d1fae5;
        --emerald-400: #34d399;
        --emerald-500: #10b981;
        
        --blue-50: #eff6ff;
        --blue-400: #60a5fa;
        --blue-500: #3b82f6;
        
        --amber-50: #fffbeb;
        --amber-400: #fbbf24;
        --amber-500: #f59e0b;
        
        --red-50: #fef2f2;
        --red-400: #f87171;
        --red-500: #ef4444;
        
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        
        --radius-sm: 0.5rem;
        --radius: 0.75rem;
        --radius-lg: 1rem;
        --radius-xl: 1.25rem;
        
        --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* =========== PAGE LAYOUT =========== */
    .create-page {
        min-height: 100vh;
        background: var(--white);
    }

    .page-header {
        background: var(--white);
        border-bottom: 1px solid var(--slate-100);
        padding: 1.5rem 0;
        position: sticky;
        top: 0;
        z-index: 50;
        backdrop-filter: blur(8px);
        background: rgba(255, 255, 255, 0.95);
    }

    .page-content {
        max-width: 42rem;
        margin: 0 auto;
        padding: 2rem 1.5rem 4rem;
    }

    /* =========== HEADER =========== */
    .header-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1rem;
        background: var(--slate-50);
        border: 1px solid var(--slate-200);
        border-radius: var(--radius);
        color: var(--slate-700);
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: var(--transition);
    }

    .back-button:hover {
        background: var(--slate-100);
        border-color: var(--slate-300);
        color: var(--slate-900);
        transform: translateX(-2px);
    }

    .header-title {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .header-icon {
        width: 2.5rem;
        height: 2.5rem;
        background: var(--black);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow-md);
    }

    .header-icon i {
        color: var(--white);
        font-size: 1.125rem;
    }

    .header-text h1 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--slate-900);
        letter-spacing: -0.025em;
    }

    .header-text p {
        font-size: 0.875rem;
        color: var(--slate-500);
        margin-top: 0.125rem;
        font-weight: 500;
    }

    /* =========== FORM CARD =========== */
    .form-card {
        background: var(--white);
        border: 1px solid var(--slate-100);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow);
        margin-top: 2rem;
        animation: fadeInUp 0.4s ease-out forwards;
        overflow: hidden;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--slate-100);
        background: var(--white);
    }

    .form-header h2 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--slate-900);
        letter-spacing: -0.025em;
        margin-bottom: 0.25rem;
    }

    .form-header p {
        font-size: 0.875rem;
        color: var(--slate-500);
    }

    .form-body {
        padding: 2rem;
    }

    /* =========== FORM ELEMENTS =========== */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--slate-700);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .form-label i {
        color: var(--slate-500);
        font-size: 0.75rem;
    }

    .required {
        color: var(--red-500);
        margin-left: 0.25rem;
    }

    .form-control {
        width: 100%;
        padding: 0.875rem 1rem;
        background: var(--white);
        border: 1px solid var(--slate-200);
        border-radius: var(--radius);
        font-size: 0.9375rem;
        color: var(--slate-900);
        transition: var(--transition);
        outline: none;
        font-family: inherit;
    }

    .form-control:focus {
        border-color: var(--black);
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
    }

    .form-control::placeholder {
        color: var(--slate-400);
    }

    .form-control.is-invalid {
        border-color: var(--red-500);
        background: var(--red-50);
    }

    .form-control.is-invalid:focus {
        border-color: var(--red-500);
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    .invalid-feedback {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8125rem;
        color: var(--red-500);
        margin-top: 0.5rem;
    }

    .invalid-feedback i {
        font-size: 0.875rem;
    }

    .form-text {
        font-size: 0.8125rem;
        color: var(--slate-500);
        margin-top: 0.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .char-count {
        font-weight: 500;
        transition: var(--transition);
    }

    .char-count.warning {
        color: var(--amber-500);
    }

    .char-count.danger {
        color: var(--red-500);
    }

    textarea.form-control {
        min-height: 8rem;
        resize: vertical;
        line-height: 1.5;
    }

    /* =========== OPTIONAL SECTION =========== */
    .optional-section {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid var(--slate-100);
    }

    .optional-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .optional-header h3 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--slate-700);
        letter-spacing: -0.025em;
    }

    .optional-header i {
        color: var(--slate-400);
        font-size: 0.875rem;
    }

    /* =========== PRIORITY SELECTOR =========== */
    .priority-group {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.75rem;
    }

    .priority-option {
        position: relative;
    }

    .priority-option input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .priority-label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.875rem 1rem;
        background: var(--white);
        border: 1px solid var(--slate-200);
        border-radius: var(--radius);
        color: var(--slate-700);
        font-size: 0.875rem;
        font-weight: 500;
        transition: var(--transition);
        cursor: pointer;
    }

    .priority-label:hover {
        border-color: var(--slate-300);
        background: var(--slate-50);
        transform: translateY(-2px);
    }

    .priority-option input:checked + .priority-label {
        border-color: var(--color);
        background: var(--bg);
        color: var(--color);
        box-shadow: 0 0 0 3px rgba(var(--rgb), 0.1);
    }

    .priority-option.low { --color: var(--slate-600); --bg: var(--slate-50); --rgb: 100, 116, 139; }
    .priority-option.medium { --color: var(--amber-500); --bg: var(--amber-50); --rgb: 245, 158, 11; }
    .priority-option.high { --color: var(--red-500); --bg: var(--red-50); --rgb: 239, 68, 68; }

    .priority-label i {
        font-size: 0.75rem;
    }

    /* =========== DATE PICKER =========== */
    .date-wrapper {
        position: relative;
    }

    .date-wrapper i {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--slate-400);
        pointer-events: none;
    }

    /* =========== FORM ACTIONS =========== */
    .form-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.75rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid var(--slate-100);
    }

    .btn {
        padding: 0.875rem 1.5rem;
        border-radius: var(--radius);
        font-size: 0.9375rem;
        font-weight: 500;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        outline: none;
    }

    .btn-secondary {
        background: var(--white);
        color: var(--slate-700);
        border: 1px solid var(--slate-200);
    }

    .btn-secondary:hover {
        background: var(--slate-50);
        border-color: var(--slate-300);
        color: var(--slate-900);
    }

    .btn-primary {
        background: var(--black);
        color: var(--white);
        box-shadow: var(--shadow-md);
    }

    .btn-primary:hover {
        background: var(--slate-800);
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    /* =========== TIPS SECTION =========== */
    .tips-section {
        background: var(--slate-50);
        border: 1px solid var(--slate-100);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        margin-top: 2rem;
    }

    .tips-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .tips-header i {
        color: var(--amber-500);
        font-size: 1.125rem;
    }

    .tips-header h3 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--slate-900);
    }

    .tips-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .tips-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.5rem 0;
        font-size: 0.875rem;
        color: var(--slate-600);
        line-height: 1.5;
    }

    .tips-list li i {
        color: var(--emerald-500);
        font-size: 0.75rem;
        margin-top: 0.125rem;
        flex-shrink: 0;
    }

    /* =========== ALERTS =========== */
    .alert {
        padding: 1rem 1.5rem;
        border-radius: var(--radius);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        animation: fadeIn 0.5s ease-out;
    }

    .alert-success {
        background: var(--emerald-50);
        color: var(--emerald-500);
        border: 1px solid var(--emerald-100);
    }

    .alert-error {
        background: var(--red-50);
        color: var(--red-500);
        border: 1px solid var(--red-100);
    }

    .alert i {
        font-size: 1.125rem;
    }

    .alert-close {
        background: none;
        border: none;
        color: inherit;
        opacity: 0.5;
        cursor: pointer;
        padding: 0.25rem;
        margin-left: auto;
        transition: var(--transition);
    }

    .alert-close:hover {
        opacity: 1;
    }

    /* =========== RESPONSIVE =========== */
    @media (max-width: 768px) {
        .page-content {
            padding: 1.5rem 1rem 3rem;
        }

        .header-inner {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }

        .header-title {
            flex-direction: column;
            gap: 0.75rem;
        }

        .form-body {
            padding: 1.5rem;
        }

        .form-header {
            padding: 1.5rem 1.5rem 1rem;
        }

        .priority-group {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .page-content {
            padding: 1rem 0.75rem 2rem;
        }

        .form-card {
            margin-top: 1.5rem;
        }

        .form-body {
            padding: 1.25rem;
        }
    }
</style>
@endpush

@section('content')
<div class="create-page">
    <!-- Page Header -->
    <header class="page-header">
        <div class="page-content">
            <div class="header-inner">
                <a href="{{ route('dashboard') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    Back to Dashboard
                </a>
                
                <div class="header-title">
                    <div class="header-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="header-text">
                        <h1>Create New Task</h1>
                        <p>Add a task to your workflow</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="page-content">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="alert-close" data-bs-dismiss="alert">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
                <button type="button" class="alert-close" data-bs-dismiss="alert">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <!-- Form Card -->
        <div class="form-card">
            <div class="form-header">
                <h2>Task Details</h2>
                <p>Fill in the details below to create a new task</p>
            </div>
            
            <form action="{{ route('tasks.store') }}" method="POST" id="taskForm" class="form-body">
                @csrf
                
                <!-- Task Title -->
                <div class="form-group">
                    <label for="title" class="form-label">
                        <i class="fas fa-heading"></i>
                        Task Title
                        <span class="required">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           class="form-control @error('title') is-invalid @enderror" 
                           value="{{ old('title') }}" 
                           placeholder="What needs to be done?"
                           required 
                           autofocus
                           maxlength="255">
                    
                    @error('title')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                    
                    <div class="form-text">
                        <span>Be specific and descriptive</span>
                        <span id="charCount" class="char-count">0/255</span>
                    </div>
                </div>

                <!-- Task Description -->
                @if(config('features.description', true))
                <div class="form-group">
                    <label for="description" class="form-label">
                        <i class="fas fa-align-left"></i>
                        Description
                        <span class="optional">(Optional)</span>
                    </label>
                    <textarea name="description" 
                              id="description" 
                              class="form-control @error('description') is-invalid @enderror" 
                              rows="4" 
                              placeholder="Add more details about this task...">{{ old('description') }}</textarea>
                    
                    @error('description')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @endif

                <!-- Optional Fields Section -->
                <div class="optional-section">
                    <div class="optional-header">
                        <i class="fas fa-cogs"></i>
                        <h3>Additional Settings</h3>
                    </div>

                    <!-- Priority -->
                    @if(config('features.priority', true))
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-flag"></i>
                            Priority
                        </label>
                        <div class="priority-group">
                            <div class="priority-option low">
                                <input type="radio" name="priority" id="low" value="low" checked>
                                <label for="low" class="priority-label">
                                    <i class="fas fa-arrow-down"></i>
                                    Low
                                </label>
                            </div>
                            
                            <div class="priority-option medium">
                                <input type="radio" name="priority" id="medium" value="medium">
                                <label for="medium" class="priority-label">
                                    <i class="fas fa-minus"></i>
                                    Medium
                                </label>
                            </div>
                            
                            <div class="priority-option high">
                                <input type="radio" name="priority" id="high" value="high">
                                <label for="high" class="priority-label">
                                    <i class="fas fa-arrow-up"></i>
                                    High
                                </label>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Due Date -->
                    @if(config('features.due_date', true))
                    <div class="form-group">
                        <label for="due_date" class="form-label">
                            <i class="fas fa-calendar-alt"></i>
                            Due Date
                        </label>
                        <div class="date-wrapper">
                            <input type="datetime-local" 
                                   name="due_date" 
                                   id="due_date" 
                                   class="form-control @error('due_date') is-invalid @enderror" 
                                   value="{{ old('due_date') }}">
                            <i class="fas fa-calendar"></i>
                        </div>
                        
                        @error('due_date')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    @endif
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-redo"></i>
                        Clear
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Create Task
                    </button>
                </div>
            </form>
        </div>

        <!-- Tips Section -->
        <div class="tips-section">
            <div class="tips-header">
                <i class="fas fa-lightbulb"></i>
                <h3>Tips for effective tasks</h3>
            </div>
            <ul class="tips-list">
                <li>
                    <i class="fas fa-check"></i>
                    <span>Use action-oriented language (e.g., "Write report" not "Report writing")</span>
                </li>
                <li>
                    <i class="fas fa-check"></i>
                    <span>Be specific and measurable (include quantities or deadlines)</span>
                </li>
                <li>
                    <i class="fas fa-check"></i>
                    <span>Break large tasks into smaller, manageable subtasks</span>
                </li>
                <li>
                    <i class="fas fa-check"></i>
                    <span>Set realistic priorities and deadlines</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Character counter
        const titleInput = document.getElementById('title');
        const charCount = document.getElementById('charCount');
        
        function updateCharCount() {
            const count = titleInput.value.length;
            charCount.textContent = `${count}/255`;
            charCount.className = 'char-count';
            
            if (count > 200) {
                charCount.classList.add('warning');
            }
            if (count > 230) {
                charCount.classList.remove('warning');
                charCount.classList.add('danger');
            }
        }
        
        titleInput.addEventListener('input', updateCharCount);
        updateCharCount(); // Initial update
        
        // Set cursor to end of input if there's existing text
        if (titleInput.value) {
            titleInput.focus();
            titleInput.setSelectionRange(titleInput.value.length, titleInput.value.length);
        }
        
        // Form validation
        const form = document.getElementById('taskForm');
        const submitBtn = form.querySelector('button[type="submit"]');
        
        form.addEventListener('submit', function(e) {
            const title = titleInput.value.trim();
            
            // Basic validation
            if (!title) {
                e.preventDefault();
                showError('Please enter a task title');
                titleInput.focus();
                return;
            }
            
            if (title.length > 255) {
                e.preventDefault();
                showError('Task title must be 255 characters or less');
                titleInput.focus();
                return;
            }
            
            // Show loading state
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating...';
            submitBtn.disabled = true;
            
            // Reset button after 5 seconds (in case form submission fails)
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 5000);
        });
        
        // Form reset handler
        form.addEventListener('reset', function() {
            updateCharCount();
            titleInput.focus();
        });
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + Enter to submit
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                form.submit();
            }
            
            // Escape to go back
            if (e.key === 'Escape') {
                window.location.href = "{{ route('dashboard') }}";
            }
        });
        
        // Auto-advance focus on Enter in title (except when Ctrl/Cmd is pressed)
        titleInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.ctrlKey && !e.metaKey && !e.shiftKey) {
                e.preventDefault();
                const description = document.getElementById('description');
                if (description) {
                    description.focus();
                }
            }
        });
        
        // Due date default to tomorrow
        const dueDateInput = document.getElementById('due_date');
        if (dueDateInput && !dueDateInput.value) {
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            tomorrow.setHours(9, 0, 0, 0); // 9 AM tomorrow
            
            const timezoneOffset = tomorrow.getTimezoneOffset() * 60000; // offset in milliseconds
            const localISOTime = new Date(tomorrow - timezoneOffset).toISOString().slice(0, 16);
            dueDateInput.value = localISOTime;
        }
        
        // Helper function to show errors
        function showError(message) {
            // Remove any existing error alerts
            const existingAlerts = document.querySelectorAll('.alert-error');
            existingAlerts.forEach(alert => alert.remove());
            
            // Create new error alert
            const alert = document.createElement('div');
            alert.className = 'alert alert-error';
            alert.innerHTML = `
                <i class="fas fa-exclamation-circle"></i>
                <span>${message}</span>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            // Insert after header
            const header = document.querySelector('.header-inner');
            header.parentElement.insertAdjacentElement('afterend', alert);
            
            // Scroll to error
            alert.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
</script>
@endpush