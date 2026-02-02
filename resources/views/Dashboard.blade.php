@extends('layouts.app')

@section('title', 'Dashboard - TaskFlow')

@push('styles')
<style>
    /* =========== CSS RESET & VARIABLES =========== */
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
        --shadow-xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        
        --radius-sm: 0.5rem;
        --radius: 0.75rem;
        --radius-lg: 1rem;
        --radius-xl: 1.25rem;
        
        --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: var(--white);
        color: var(--slate-900);
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    /* =========== UTILITY CLASSES =========== */
    .animate-in {
        animation: animateIn 0.3s ease-out forwards;
    }

    .fade-in {
        animation: fadeIn 0.5s ease-out;
    }

    .slide-in-from-top-2 {
        animation: slideInFromTop 0.3s ease-out;
    }

    @keyframes animateIn {
        from {
            opacity: 0;
            transform: translateY(8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideInFromTop {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* =========== HEADER =========== */
    .dashboard-header {
        background: var(--white);
        border-bottom: 1px solid var(--slate-100);
        padding: 1.5rem 0;
        position: sticky;
        top: 0;
        z-index: 50;
        backdrop-filter: blur(8px);
        background: rgba(255, 255, 255, 0.95);
    }

    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .brand-section {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .brand-icon {
        width: 2.5rem;
        height: 2.5rem;
        background: var(--black);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow-md);
    }

    .brand-icon i {
        color: var(--white);
        font-size: 1.125rem;
    }

    .brand-text h1 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--slate-900);
        letter-spacing: -0.025em;
    }

    .brand-text p {
        font-size: 0.875rem;
        color: var(--slate-500);
        margin-top: 0.125rem;
        font-weight: 500;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem 0.75rem;
        border-radius: var(--radius);
        transition: var(--transition);
        cursor: pointer;
    }

    .user-profile:hover {
        background: var(--slate-50);
    }

    .user-avatar {
        width: 2.5rem;
        height: 2.5rem;
        background: var(--black);
        color: var(--white);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1rem;
    }

    .user-info h3 {
        font-size: 0.9375rem;
        font-weight: 600;
        color: var(--slate-900);
    }

    .user-info p {
        font-size: 0.8125rem;
        color: var(--slate-500);
        margin-top: 0.125rem;
    }

    /* =========== STATS GRID =========== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.25rem;
        margin: 2rem 0;
    }

    .stat-card {
        background: var(--white);
        border: 1px solid var(--slate-100);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: var(--slate-200);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--card-color) 0%, var(--card-color-light) 100%);
    }

    .stat-card.total { --card-color: var(--black); --card-color-light: var(--slate-800); }
    .stat-card.today { --card-color: var(--emerald-500); --card-color-light: var(--emerald-400); }
    .stat-card.week { --card-color: var(--blue-500); --card-color-light: var(--blue-400); }
    .stat-card.recent { --card-color: var(--amber-500); --card-color-light: var(--amber-400); }

    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .stat-icon {
        width: 2.75rem;
        height: 2.75rem;
        background: var(--card-bg, var(--slate-50));
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--card-color, var(--slate-700));
    }

    .stat-icon.total { --card-bg: var(--slate-100); }
    .stat-icon.today { --card-bg: var(--emerald-50); }
    .stat-icon.week { --card-bg: var(--blue-50); }
    .stat-icon.recent { --card-bg: var(--amber-50); }

    .stat-trend {
        font-size: 0.875rem;
        font-weight: 500;
        padding: 0.375rem 0.75rem;
        border-radius: 999px;
        background: var(--trend-bg, var(--slate-50));
        color: var(--trend-color, var(--slate-700));
    }

    .stat-trend.positive { --trend-bg: var(--emerald-50); --trend-color: var(--emerald-500); }
    .stat-trend.negative { --trend-bg: var(--red-50); --trend-color: var(--red-500); }

    .stat-value {
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--slate-900);
        line-height: 1;
        margin-bottom: 0.5rem;
        letter-spacing: -0.025em;
    }

    .stat-label {
        font-size: 0.875rem;
        color: var(--slate-500);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* =========== MAIN CONTENT =========== */
    .main-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem 3rem;
    }

    /* =========== TOOLBAR =========== */
    .toolbar {
        background: var(--white);
        border: 1px solid var(--slate-100);
        border-radius: var(--radius-lg);
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .search-wrapper {
        position: relative;
        flex: 1;
        min-width: 300px;
    }

    .search-input {
        width: 100%;
        padding: 0.875rem 1rem 0.875rem 3rem;
        background: var(--slate-50);
        border: 1px solid var(--slate-200);
        border-radius: var(--radius);
        font-size: 0.9375rem;
        color: var(--slate-900);
        transition: var(--transition);
        outline: none;
    }

    .search-input:focus {
        background: var(--white);
        border-color: var(--black);
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
    }

    .search-input::placeholder {
        color: var(--slate-400);
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--slate-400);
        font-size: 0.9375rem;
    }

    .clear-search-btn {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--slate-400);
        cursor: pointer;
        padding: 0.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: var(--transition);
        width: 1.5rem;
        height: 1.5rem;
    }

    .clear-search-btn:hover {
        background: var(--slate-100);
        color: var(--slate-700);
    }

    .action-buttons {
        display: flex;
        gap: 0.75rem;
        align-items: center;
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

    .btn-outline {
        background: var(--white);
        color: var(--slate-700);
        border: 1px solid var(--slate-200);
    }

    .btn-outline:hover {
        border-color: var(--slate-300);
        background: var(--slate-50);
    }

    /* =========== TASK SECTIONS =========== */
    .section {
        background: var(--white);
        border: 1px solid var(--slate-100);
        border-radius: var(--radius-lg);
        overflow: hidden;
        margin-bottom: 1.5rem;
        animation: animateIn 0.4s ease-out forwards;
    }

    .section-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--slate-100);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title h2 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--slate-900);
        letter-spacing: -0.025em;
    }

    .section-icon {
        width: 2.5rem;
        height: 2.5rem;
        background: var(--slate-50);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--slate-700);
    }

    .section-actions {
        display: flex;
        align-items: center;
        gap: 5px;
        position: relative;
    }
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .count-badge {
        margin-right: 10px;
        background: var(--slate-100);
        color: var(--slate-700);
        padding: 0.375rem 0.875rem;
        border-radius: 999px;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }

    .count-badge i {
        font-size: 0.8125rem;
    }

    

    /* =========== TASK LIST =========== */
    .task-list {
        padding: 0.5rem;
    }

    .task-item {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--slate-100);
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: var(--transition);
        position: relative;
    }

    .task-item:last-child {
        border-bottom: none;
    }

    .task-item:hover {
        background: var(--slate-50);
    }

    .task-checkbox {
        width: 1.25rem;
        height: 1.25rem;
        border: 2px solid var(--slate-300);
        border-radius: 0.375rem;
        appearance: none;
        cursor: pointer;
        transition: var(--transition);
        position: relative;
    }

    .task-checkbox:checked {
        background: var(--black);
        border-color: var(--black);
    }

    .task-checkbox:checked::after {
        content: '✓';
        position: absolute;
        color: white;
        font-size: 0.75rem;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .task-content {
        flex: 1;
        min-width: 0;
    }

    .task-title {
        font-size: 0.9375rem;
        font-weight: 500;
        color: var(--slate-900);
        margin-bottom: 0.375rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .task-title.completed {
        color: var(--slate-400);
        text-decoration: line-through;
    }

    .task-description {
        font-size: 0.8125rem;
        color: var(--slate-500);
        line-height: 1.5;
        margin-bottom: 0.5rem;
    }

    .task-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 0.8125rem;
        color: var(--slate-500);
    }

    .task-meta-item {
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .priority-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .priority-high {
        background: var(--red-50);
        color: var(--red-500);
    }

    .priority-medium {
        background: var(--amber-50);
        color: var(--amber-500);
    }

    .priority-low {
        background: var(--slate-100);
        color: var(--slate-600);
    }

    .task-actions {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        opacity: 0;
        transition: var(--transition);
    }

    .task-item:hover .task-actions {
        opacity: 1;
    }

    .btn-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--white);
        border: 1px solid var(--slate-200);
        border-radius: var(--radius);
        color: var(--slate-600);
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-icon:hover {
        background: var(--slate-50);
        border-color: var(--slate-300);
        color: var(--slate-900);
        transform: scale(1.05);
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        min-width: 160px;
        background: var(--white);
        border: 1px solid var(--slate-200);
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
        padding: 8px 0;
        margin-top: 8px;
        z-index: 1000;
        display: none;
    }

    .dropdown:hover .dropdown-menu,
    .dropdown:focus-within .dropdown-menu {
        display: block;
        animation: fadeIn 0.2s ease;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        padding: 10px 16px;
        color: var(--slate-700);
        text-decoration: none;
        font-size: 14px;
        transition: var(--transition);
    }

    .dropdown-item:hover {
        background: var(--slate-50);
        color: var(--slate-900);
    }

    .dropdown-item i {
        width: 20px;
        margin-right: 8px;
        color: var(--slate-500);
    }

    /* Fix for All Tasks section sort dropdown */
    .btn-outline.dropdown-toggle {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
    }

    .btn-outline.dropdown-toggle::after {
        margin-left: 4px;
        vertical-align: 0;
    }

    .btn-icon.edit:hover {
        background: var(--blue-50);
        border-color: var(--blue-400);
        color: var(--blue-500);
    }

    .btn-icon.delete:hover {
        background: var(--red-50);
        border-color: var(--red-400);
        color: var(--red-500);
    }

    /* =========== EMPTY STATE =========== */
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }

    .empty-icon {
        width: 5rem;
        height: 5rem;
        background: var(--slate-50);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: var(--slate-400);
        font-size: 2rem;
    }

    .empty-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--slate-900);
        margin-bottom: 0.5rem;
    }

    .empty-description {
        font-size: 0.9375rem;
        color: var(--slate-500);
        margin-bottom: 2rem;
        max-width: 28rem;
        margin-left: auto;
        margin-right: auto;
    }

    /* =========== PAGINATION =========== */
    .pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 1.5rem;
        border-top: 1px solid var(--slate-100);
    }

    .page-item {
        list-style: none;
    }

    .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: var(--radius);
        border: 1px solid var(--slate-200);
        background: var(--white);
        color: var(--slate-700);
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: var(--transition);
    }

    .page-link:hover {
        border-color: var(--slate-300);
        background: var(--slate-50);
    }

    .page-item.active .page-link {
        background: var(--black);
        border-color: var(--black);
        color: var(--white);
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

    /* =========== DELETE MODAL =========== */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .modal.show {
        display: flex !important;
        animation: modalFadeIn 0.2s ease-out;
    }

    @keyframes modalFadeIn {
        from {
            background: rgba(0, 0, 0, 0);
            backdrop-filter: blur(0);
        }
        to {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }
    }

    .modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        animation: overlayFadeIn 0.2s ease-out;
    }

    @keyframes overlayFadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .modal-content {
        position: relative;
        background: var(--white);
        border-radius: var(--radius-lg);
        width: 100%;
        max-width: 420px;
        box-shadow: var(--shadow-xl);
        animation: modalContentSlideIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        z-index: 1;
        border: 1px solid var(--slate-200);
    }

    @keyframes modalContentSlideIn {
        from {
            opacity: 0;
            transform: translateY(-20px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .modal-header {
        padding: 1.5rem 1.5rem 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid var(--slate-100);
    }

    .modal-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--slate-900);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .modal-title i {
        color: var(--red-500);
        font-size: 1.25rem;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: var(--slate-400);
        cursor: pointer;
        transition: var(--transition);
        line-height: 1;
        padding: 0.25rem;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-sm);
    }

    .modal-close:hover {
        background: var(--slate-700-50);
        color: var(--slate-700);
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-body p {
        color: var(--slate-700);
        line-height: 1.6;
        font-size: 0.9375rem;
    }

    .modal-body p:first-child {
        margin-bottom: 0.75rem;
    }

    .modal-body p:last-child {
        color: var(--slate-500);
        font-size: 0.875rem;
    }

    #deleteTaskTitle {
        color: var(--slate-900);
        font-weight: 600;
        word-break: break-word;
    }

    .modal-footer {
        padding: 1rem 1.5rem 1.5rem;
        border-top: 1px solid var(--slate-100);
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
    }

    .btn-danger {
        background: var(--red-500);
        color: var(--white);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: var(--radius);
        font-size: 0.9375rem;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-danger:hover {
        background: var(--red-600);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
    }

    .btn-danger:active {
        transform: translateY(0);
    }

    .modal-cancel {
        padding: 0.75rem 1.5rem;
        background: var(--white);
        color: var(--slate-700);
        border: 1px solid var(--slate-200);
        border-radius: var(--radius);
        font-size: 0.9375rem;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
    }

    
    .modal .btn-danger {
        background: var(--red-500);
        color: var(--white);
        border: none;
    }

    .modal .btn-danger:hover {
        background: #b91c1c; /* darker red */
        color: var(--white);
        border: none;
    }


    .modal-cancel:hover {
        background: var(--slate-50);
        border-color: var(--slate-300);
    }

    /* Delete icon in task actions */
    .btn-icon.delete {
        position: relative;
    }

    .btn-icon.delete:hover {
        background: var(--red-50);
        border-color: var(--red-100);
        color: var(--red-500);
    }

    /* Danger button loading state */
    .btn-danger.loading {
        position: relative;
        
    }

    .btn-danger.loading span {
        color: transparent; /* Only hide the text span, not the icon */
    }

    .btn-danger.loading i {
        opacity: 0; /* Hide the icon too when loading */
    }

    .btn-danger.loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin: -10px 0 0 -10px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    /* Keep hover effect even when loading */
    .btn-danger.loading:hover {
        background: var(--red-400);
    }

    .btn-danger.loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin: -10px 0 0 -10px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Warning highlight for modal */
    .warning-highlight {
        background: var(--red-50);
        border-left: 4px solid var(--red-500);
        padding: 1rem;
        border-radius: var(--radius);
        margin: 1rem 0;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .warning-highlight i {
        color: var(--red-500);
        font-size: 1.125rem;
        flex-shrink: 0;
    }

    .warning-highlight p {
        color: var(--slate-700);
        font-size: 0.875rem;
        line-height: 1.5;
        margin: 0;
    }

    /* Responsive modal adjustments */
    @media (max-width: 640px) {
        .modal-content {
            max-width: 95%;
            margin: 1rem;
        }
        
        .modal-footer {
            flex-direction: column-reverse;
        }
        
        .modal-footer button {
            width: 100%;
            justify-content: center;
        }
        
        .modal-header,
        .modal-body,
        .modal-footer {
            padding-left: 1.25rem;
            padding-right: 1.25rem;
        }
    }

    /* =========== RESPONSIVE =========== */
    @media (max-width: 768px) {
        .main-content {
            padding: 0 1rem 2rem;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .stat-card {
            padding: 1.25rem;
        }

        .stat-value {
            font-size: 1.75rem;
        }

        .toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .search-wrapper {
            min-width: 100%;
        }

        .action-buttons {
            width: 100%;
            justify-content: stretch;
        }

        .btn {
            flex: 1;
            justify-content: center;
        }

        .section-header {
            flex-direction: column;
            align-items: stretch;
            gap: 1rem;
        }

        .section-actions {
            justify-content: space-between;
        }

        .task-item {
            padding: 1rem;
            flex-wrap: wrap;
        }

        .task-actions {
            opacity: 1;
            width: 100;
            justify-content: flex-end;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--slate-100);
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .header-content {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }

        .brand-section {
            justify-content: center;
        }

        .user-profile {
            justify-content: center;
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

        /* Add to your existing CSS section */

        /* Logout Dropdown Styles */
        .dropdown-header {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--slate-100);
            background: var(--slate-50);
        }

        .dropdown-body {
            padding: 0.5rem 0;
        }

        .dropdown-divider {
            height: 1px;
            background: var(--slate-100);
            margin: 0.5rem 0;
        }

        .dropdown-item.logout {
            color: var(--red-500);
        }

        .dropdown-item.logout:hover {
            background: var(--red-50);
            color: var(--red-600);
        }

        /* Ensure dropdown menu is hidden by default */
        .dropdown .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--white);
            border: 1px solid var(--slate-200);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            z-index: 1000;
            min-width: 200px;
            margin-top: 0.5rem;
        }

        /* Show dropdown when parent has 'show' class */
        .dropdown.show .dropdown-menu {
            display: block;
            animation: fadeIn 0.2s ease;
        }

        /* Toggle dropdown on click */
        .dropdown-toggle {
            cursor: pointer;
        }

        /* Optional: Add logout confirmation modal if you want it */
        #logoutConfirmationModal .modal-content {
            max-width: 400px;
        }

        #logoutConfirmationModal .modal-body {
            text-align: center;
            padding: 2rem;
        }

        #logoutConfirmationModal .modal-body i {
            font-size: 3rem;
            color: var(--amber-500);
            margin-bottom: 1rem;
        }

        #logoutConfirmationModal .modal-footer {
            justify-content: center;
            gap: 1rem;
        }

        /* Add to your CSS section - Profile Image Styles */
        .user-avatar {
            width: 2.5rem;
            height: 2.5rem;
            background: var(--black);
            color: var(--white);
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: var(--radius);
        }

        /* Profile image in dropdown */
        .dropdown-header .user-avatar {
            width: 2rem;
            height: 2rem;
            font-size: 0.875rem;
            border: 2px solid var(--slate-200);
            background: var(--slate-100);
        }

        .dropdown-header .user-avatar img {
            border-radius: calc(var(--radius) - 2px);
        }

        /* Profile image hover effects */
        .user-profile:hover .user-avatar {
            transform: scale(1.05);
            transition: var(--transition);
            border-color: var(--blue-500);
        }

        /* Make sure dropdown user info aligns properly */
        .dropdown-header .user-info {
            min-width: 0;
        }

        .dropdown-header .user-info h4 {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
        }

        .dropdown-header .user-info p {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
        }

        /* Email styling in user info */
        .user-info p {
            font-size: 0.8125rem;
            color: var(--slate-500);
            margin-top: 0.125rem;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .user-info p i {
            font-size: 0.75rem;
            color: var(--slate-400);
        }

        /* Optional: Add email icon */
        .user-info p::before {
            content: '\f0e0'; /* FontAwesome envelope icon */
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 0.75rem;
            color: var(--slate-400);
            margin-right: 0.375rem;
        }

        /* Alternative: If you prefer showing both email and something else */
        .user-info .email-display {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            color: var(--slate-500);
            font-size: 0.75rem;
        }

        .user-info .email-display i {
            color: var(--slate-400);
        }
    }
</style>
@endpush

@section('content')
<!-- Header -->
<header class="dashboard-header">
    <div class="main-content">
        <div class="header-content">
            <div class="brand-section">
                <div class="brand-icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="brand-text">
                    <h1>Task Dashboard</h1>
                    <p>Manage your workflow efficiently</p>
                </div>
            </div>
            
            <!-- Updated User Profile with Logout Dropdown -->
            <div class="dropdown">
                <div class="user-profile" id="userProfileDropdown" style="cursor: pointer;">
                    <!-- Profile Image -->
                    @if(Auth::user()->profile_image)
                        <div class="user-avatar" style="background: none; overflow: hidden; border: 2px solid var(--slate-200);">
                            <img src="{{ Storage::url(Auth::user()->profile_image) }}" 
                                alt="{{ Auth::user()->name }}"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    @else
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    
                    <div class="user-info">
                        <h3>{{ Auth::user()->name }}</h3>
                        <!-- Changed from Productivity score to Email -->
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                    <i class="fas fa-chevron-down" style="font-size: 0.875rem; color: var(--slate-400); margin-left: 0.5rem;"></i>
                </div>
                
                <!-- Logout Dropdown Menu -->
                <div class="dropdown-menu" style="min-width: 200px; right: 0; left: auto;">
                    <div class="dropdown-header" style="padding: 0.75rem 1rem; border-bottom: 1px solid var(--slate-100);">
                        <div class="user-info" style="display: flex; align-items: center; gap: 0.75rem;">
                            <!-- Profile Image in dropdown -->
                            @if(Auth::user()->profile_image)
                                <div class="user-avatar" style="width: 2rem; height: 2rem; font-size: 0.875rem; background: none; overflow: hidden; border: 2px solid var(--slate-200);">
                                    <img src="{{ Storage::url(Auth::user()->profile_image) }}" 
                                        alt="{{ Auth::user()->name }}"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            @else
                                <div class="user-avatar" style="width: 2rem; height: 2rem; font-size: 0.875rem;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <h4 style="font-size: 0.875rem; font-weight: 600; color: var(--slate-900); margin: 0;">
                                    {{ Auth::user()->name }}
                                </h4>
                                <p style="font-size: 0.75rem; color: var(--slate-500); margin: 0.125rem 0 0;">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dropdown-body" style="padding: 0.5rem 0;">
                        <a href="{{ route('profile.show') }}" class="dropdown-item">
                            <i class="fas fa-user me-2"></i>
                            My Profile
                        </a>
                        <a href="{{ route('settings.show') }}" class="dropdown-item" wire:navigate>
                            <i class="fas fa-cog me-2"></i>
                            Settings
                        </a>
                        <div class="dropdown-divider" style="height: 1px; background: var(--slate-100); margin: 0.5rem 0;"></div>
                        
                        <!-- Logout Form -->
                        <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                            @csrf
                            <button type="submit" class="dropdown-item" 
                                    style="background: none; border: none; width: 100%; text-align: left; color: var(--red-500);">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="main-content">
    <!-- Alerts -->
    @if(session('error'))
        <div class="alert alert-error animate-in fade-in slide-in-from-top-2">
            <i class="fas fa-circle-exclamation"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif
    
    @if(session('success'))
        <div class="alert alert-success animate-in fade-in slide-in-from-top-2">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    
    <!-- Statistics -->
    <div class="stats-grid">
        <div class="stat-card total animate-in" style="animation-delay: 0.1s;">
            <div class="stat-header">
                <div class="stat-icon total">
                    <i class="fas fa-layer-group"></i>
                </div>
                <span class="stat-trend positive">+12%</span>
            </div>
            <div class="stat-value">{{ $stats['total'] ?? 0 }}</div>
            <div class="stat-label">Total Tasks</div>
        </div>
        
        <div class="stat-card today animate-in" style="animation-delay: 0.2s;">
            <div class="stat-header">
                <div class="stat-icon today">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <span class="stat-trend positive">+8%</span>
            </div>
            <div class="stat-value">{{ $stats['today'] ?? 0 }}</div>
            <div class="stat-label">Today</div>
        </div>
        
        <div class="stat-card week animate-in" style="animation-delay: 0.3s;">
            <div class="stat-header">
                <div class="stat-icon week">
                    <i class="fas fa-calendar-week"></i>
                </div>
                <span class="stat-trend positive">+15%</span>
            </div>
            <div class="stat-value">{{ $stats['this_week'] ?? 0 }}</div>
            <div class="stat-label">This Week</div>
        </div>
        
        <div class="stat-card recent animate-in" style="animation-delay: 0.4s;">
            <div class="stat-header">
                <div class="stat-icon recent">
                    <i class="fas fa-history"></i>
                </div>
                <span class="stat-trend negative">-3%</span>
            </div>
            <div class="stat-value">{{ isset($stats['recent']) ? $stats['recent']->count() : 0 }}</div>
            <div class="stat-label">Recent Activity</div>
        </div>
    </div>
    
    <!-- Toolbar -->
    <div class="toolbar animate-in" style="animation-delay: 0.5s;">
        <div class="search-wrapper">
            <i class="fas fa-search search-icon"></i>
                <form action="{{ route('dashboard') }}" method="GET" id="searchForm">                <input type="text" 
                       name="query" 
                       id="searchInput"
                       class="search-input" 
                       placeholder="Search tasks, descriptions..." 
                       value="{{ request('query') ?? (isset($query) ? $query : '') }}"
                       autocomplete="off">
                @if(request('query') || (isset($query) && $query))
                    <button type="button" 
                            id="clearSearchBtn"
                            class="clear-search-btn" 
                            title="Clear search"
                            style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--slate-400); cursor: pointer; padding: 0.25rem; display: flex; align-items: center; justify-content: center; border-radius: 50%; transition: var(--transition);">
                        <i class="fas fa-times"></i>
                    </button>
                @endif
            </form>
        </div>
        
        <div class="action-buttons">
            <button class="btn btn-outline">
                <i class="fas fa-filter"></i>
                Filter
            </button>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                New Task
            </a>
        </div>
    </div>
    
    <!-- Recent Activities -->
    <div class="section" style="animation-delay: 0.6s;">
        <div class="section-header">
            <div class="section-title">
                <div class="section-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h2>Recent Activities</h2>
            </div>
            <div class="section-actions">
                <span class="count-badge">
                    <i class="fas fa-layer-group"></i>
                    {{ isset($stats['recent']) ? $stats['recent']->count() : 0 }}
                </span>
                <div class="dropdown">
                    <button class="btn-icon" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i>View all</a></li>
                        
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="task-list">
            @if(isset($stats['recent']) && $stats['recent']->count() > 0)
                @foreach($stats['recent'] as $task)
                    <div class="task-item">
                        <input type="checkbox" 
                        class="task-checkbox status-toggle" 
                        data-task-id="{{ $task->id }}"
                        data-url="{{ route('tasks.toggle-status', $task) }}"
                        {{ $task->is_completed ? 'checked' : '' }}>
                        <div class="task-content">
                            <div class="task-title {{ $task->is_completed ? 'completed' : '' }}">
                                {{ $task->title }}
                                <span class="priority-badge priority-{{ $task->priority ?? 'low' }}">
                                    {{ ucfirst($task->priority ?? 'low') }}
                                </span>
                            </div>

                            @if($task->description)
                                <p class="task-description">{{ Str::limit($task->description, 120) }}</p>
                            @endif
                            <div class="task-meta">
                                @if($task->is_completed && $task->completed_at)
                                    <span class="task-meta-item">
                                        <i class="fas fa-check-circle"></i>
                                        Completed {{ $task->completed_at->format('M d') }}
                                    </span>
                                @endif
                                @if($task->due_date)
                                    <span class="task-meta-item">
                                        <i class="far fa-calendar-alt"></i>
                                        Due {{ $task->due_date->format('M d') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="task-actions">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn-icon edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task?')">
                                @csrf
                                @method('DELETE')
                                <button type="button" 
                                        class="btn-icon delete delete-btn" 
                                        data-task-id="{{ $task->id }}"
                                        data-task-title="{{ $task->title }}"
                                        data-delete-url="{{ route('tasks.destroy', $task) }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h3 class="empty-title">No Recent Tasks</h3>
                    <p class="empty-description">Your recent activities will appear here as you start working.</p>
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Create First Task
                    </a>
                </div>
            @endif
        </div>
    </div>
    
    <!-- All Tasks -->
    <div class="section" style="animation-delay: 0.7s;">
        <div class="section-header">
            <div class="section-title">
                <div class="section-icon">
                    <i class="fas fa-list-check"></i>
                </div>
                <h2>All Tasks</h2>
            </div>
            <div class="section-actions">
                <span class="count-badge">
                    <i class="fas fa-tasks"></i>
                    {{ isset($tasks) ? $tasks->total() : 0 }}
                </span>
                <div class="dropdown">
                    <button class="btn btn-outline dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-sort me-2"></i>
                        Sort
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?sort=latest">
                            <i class="fas fa-arrow-down me-2"></i>Newest First
                        </a></li>
                        <li><a class="dropdown-item" href="?sort=oldest">
                            <i class="fas fa-arrow-up me-2"></i>Oldest First
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="task-list">
            @if(isset($tasks) && $tasks->count() > 0)
                @foreach($tasks as $task)
                    <div class="task-item">
                        <input type="checkbox" 
                        class="task-checkbox status-toggle" 
                        data-task-id="{{ $task->id }}"
                        data-url="{{ route('tasks.toggle-status', $task) }}"
                        {{ $task->is_completed ? 'checked' : '' }}>
                        <div class="task-content">
                            <div class="task-title {{ $task->completed_at ? 'completed' : '' }}">
                                {{ $task->title }}
                                <span class="priority-badge priority-{{ $task->priority ?? 'low' }}">
                                    {{ ucfirst($task->priority ?? 'low') }}
                                </span>
                            </div>
                            @if($task->description)
                                <p class="task-description">{{ Str::limit($task->description, 120) }}</p>
                            @endif
                            <div class="task-meta">
                                @if($task->is_completed && $task->completed_at)
                                    <span class="task-meta-item">
                                        <i class="fas fa-check-circle"></i>
                                        Completed {{ $task->completed_at->format('M d') }}
                                    </span>
                                @endif
                                @if($task->due_date)
                                    <span class="task-meta-item">
                                        <i class="far fa-calendar-alt"></i>
                                        {{ $task->due_date->format('M d, Y') }}
                                    </span>
                                @endif
                                <span class="task-meta-item">
                                    <i class="far fa-clock"></i>
                                    Created {{ $task->created_at->format('M d') }}
                                </span>
                            </div>
                        </div>
                        <div class="task-actions">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn-icon edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task?')">
                                @csrf
                                @method('DELETE')
                                <button type="button" 
                                        class="btn-icon delete delete-btn" 
                                        data-task-id="{{ $task->id }}"
                                        data-task-title="{{ $task->title }}"
                                        data-delete-url="{{ route('tasks.destroy', $task) }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
                
                @if($tasks->hasPages())
                    <div class="pagination">
                        @if(!$tasks->onFirstPage())
                            <li class="page-item">
                                <a href="{{ $tasks->previousPageUrl() }}" class="page-link">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                        @endif
                        
                        @foreach(range(1, $tasks->lastPage()) as $i)
                            @if($i == $tasks->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $i }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a href="{{ $tasks->url($i) }}" class="page-link">{{ $i }}</a>
                                </li>
                            @endif
                        @endforeach
                        
                        @if($tasks->hasMorePages())
                            <li class="page-item">
                                <a href="{{ $tasks->nextPageUrl() }}" class="page-link">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        @endif
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    @if(request('query'))
                        <h3 class="empty-title">No Tasks Found</h3>
                        <p class="empty-description">No tasks match your search query "{{ request('query') }}". Try a different search term.</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline">
                            <i class="fas fa-arrow-left"></i>
                            Clear Search
                        </a>
                    @else
                        <h3 class="empty-title">No Tasks Found</h3>
                        <p class="empty-description">Get started by creating your first task and organizing your workflow.</p>
                        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Create First Task
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal" style="display: none;">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="fas fa-exclamation-triangle text-red-500"></i>
                    Delete Task
                </h3>
                <button type="button" class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete "<strong id="deleteTaskTitle"></strong>"?</p>
                <p class="text-sm text-gray-500 mt-2">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline modal-cancel">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        Delete Task
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltips.forEach(el => new bootstrap.Tooltip(el));
        
        // Enhanced search functionality
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');
        const clearSearchBtn = document.getElementById('clearSearchBtn');
        let searchTimeout;
        
        if (searchInput && searchForm) {
            // Submit on Enter key
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(searchTimeout);
                    searchForm.submit();
                }
            });
            
            // Auto-submit after user stops typing (debounce)
            searchInput.addEventListener('input', function(e) {
                clearTimeout(searchTimeout);
                const query = this.value.trim();
                
                // Show/hide clear button
                if (query && !clearSearchBtn) {
                    // Clear button will be shown on next page load
                }
                
                // Auto-submit after 500ms of no typing (optional - comment out if you prefer manual search)
                // Uncomment the lines below if you want real-time search
                /*
                searchTimeout = setTimeout(() => {
                    if (query.length > 0) {
                        searchForm.submit();
                    } else if (query.length === 0 && window.location.pathname.includes('/search')) {
                        // Redirect to dashboard if search is cleared
                        window.location.href = '{{ route("dashboard") }}';
                    }
                }, 500);
                */
            });
            
            // Clear search functionality
            if (clearSearchBtn) {
                clearSearchBtn.addEventListener('click', function() {
                    searchInput.value = '';
                    window.location.href = '{{ route("dashboard") }}';
                });
            }
        }

        // Get modal elements
        const deleteModal = document.getElementById('deleteModal');
        const deleteTaskTitle = document.getElementById('deleteTaskTitle');
        const deleteForm = document.getElementById('deleteForm');
        const modalCancelBtn = document.querySelector('.modal-cancel');
        const modalCloseBtn = document.querySelector('.modal-close');
        
        // Function to show modal
        function showDeleteModal(taskTitle, deleteUrl) {
            deleteTaskTitle.textContent = taskTitle;
            deleteForm.action = deleteUrl;
            deleteModal.classList.add('show');
            deleteModal.style.display = 'flex';
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
        }
        
        // Function to hide modal
        function hideDeleteModal() {
            deleteModal.classList.remove('show');
            setTimeout(() => {
                deleteModal.style.display = 'none';
            }, 300);
            document.body.style.overflow = '';
        }
        
        // Handle delete button clicks
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                console.log('Delete button clicked');
                console.log('Task title:', this.dataset.taskTitle);
                console.log('Delete URL:', this.dataset.deleteUrl);
                
                const taskTitle = this.dataset.taskTitle;
                const deleteUrl = this.dataset.deleteUrl;
                showDeleteModal(taskTitle, deleteUrl);
            });
        });
        
        // Handle modal close
        modalCancelBtn.addEventListener('click', hideDeleteModal);
        modalCloseBtn.addEventListener('click', hideDeleteModal);
        
        // Close modal when clicking overlay
        deleteModal.addEventListener('click', function(e) {
            if (e.target === this || e.target.classList.contains('modal-overlay')) {
                hideDeleteModal();
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && deleteModal.classList.contains('show')) {
                hideDeleteModal();
            }
        });
        
        // Task checkbox AJAX functionality
        const checkboxes = document.querySelectorAll('.status-toggle');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const taskId = this.dataset.taskId;
                const url = this.dataset.url;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const isChecked = this.checked;
                
                // Find ALL checkboxes for this task (in both sections)
                const allTaskCheckboxes = document.querySelectorAll(`#task-checkbox-${taskId}, [data-task-id="${taskId}"]`);
                
                // Update all checkboxes for this task to match the clicked one
                allTaskCheckboxes.forEach(cb => {
                    if (cb !== this) {
                        cb.checked = isChecked;
                        cb.disabled = true; // Disable while updating
                    }
                });
                
                // Show loading state on all checkboxes
                this.disabled = true;
                
                // Make AJAX request
                fetch(url, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        _method: 'PUT'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Find ALL task items for this task (in both sections)
                        const allTaskItems = document.querySelectorAll(`[data-task-id="${taskId}"]`).forEach(cb => {
                            const taskItem = cb.closest('.task-item');
                            const taskTitle = taskItem.querySelector('.task-title');
                            
                            // Update UI for all instances
                            if (data.is_completed) {
                                taskTitle.classList.add('completed');
                            } else {
                                taskTitle.classList.remove('completed');
                            }
                        });
                        
                        // Show success message
                        showToast(data.message, 'success');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Revert all checkboxes on error
                    allTaskCheckboxes.forEach(cb => {
                        cb.checked = !isChecked;
                    });
                    showToast('Error updating task status', 'error');
                })
                .finally(() => {
                    // Re-enable all checkboxes
                    allTaskCheckboxes.forEach(cb => {
                        cb.disabled = false;
                    });
                });
            });
        });

        // Toast notification function
        function showToast(message, type = 'info') {
            // Remove existing toast
            const existingToast = document.querySelector('.custom-toast');
            if (existingToast) {
                existingToast.remove();
            }
            
            // Create toast element
            const toast = document.createElement('div');
            toast.className = `custom-toast toast-${type}`;
            toast.innerHTML = `
                <div class="toast-content">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                    <span>${message}</span>
                </div>
            `;
            
            // Add to body
            document.body.appendChild(toast);
            
            // Show toast
            setTimeout(() => toast.classList.add('show'), 10);
            
            // Remove after 3 seconds
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Add CSS for toast notifications
        const toastStyle = document.createElement('style');
        toastStyle.textContent = `
            .custom-toast {
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 12px 20px;
                border-radius: 8px;
                background: white;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                z-index: 9999;
                transform: translateX(120%);
                transition: transform 0.3s ease;
                display: flex;
                align-items: center;
                gap: 10px;
                max-width: 300px;
            }
            
            .custom-toast.show {
                transform: translateX(0);
            }
            
            .toast-success {
                border-left: 4px solid #10b981;
                color: #10b981;
            }
            
            .toast-error {
                border-left: 4px solid #ef4444;
                color: #ef4444;
            }
            
            .toast-info {
                border-left: 4px solid #3b82f6;
                color: #3b82f6;
            }
            
            .toast-content {
                display: flex;
                align-items: center;
                gap: 8px;
            }
            
            .toast-content i {
                font-size: 1.2rem;
            }
        `;
        document.head.appendChild(toastStyle);
        
        // Smooth animations on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.section').forEach(el => {
            observer.observe(el);
        });
        
        // Search input focus effect
        const searchWrapper = document.querySelector('.search-wrapper');
        if (searchWrapper) {
            const searchInput = searchWrapper.querySelector('input');
            searchInput.addEventListener('focus', () => {
                searchWrapper.style.transform = 'scale(1.02)';
            });
            
            searchInput.addEventListener('blur', () => {
                searchWrapper.style.transform = 'scale(1)';
            });
        }
    });



    // Add this to your existing JavaScript section or create a new script block

    // User profile dropdown functionality
    const userProfileDropdown = document.getElementById('userProfileDropdown');
    const userDropdown = userProfileDropdown?.closest('.dropdown');

    if (userDropdown) {
        // Toggle dropdown on click
        userProfileDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userDropdown.contains(e.target)) {
                userDropdown.classList.remove('show');
            }
        });

        // Handle logout with optional confirmation
        const logoutForm = document.getElementById('logoutForm');
        if (logoutForm) {
            // For direct logout (no confirmation)
            logoutForm.addEventListener('submit', function(e) {
                // If you want a confirmation, comment out the next line
                // and use the modal approach below
                return true; // Proceed with logout
            });
        }
    }
</script>
@endpush