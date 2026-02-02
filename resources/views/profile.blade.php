@extends('layouts.app')

@section('title', 'My Profile - TaskFlow')

@push('styles')
<style>
    /* =========== PROFILE PAGE STYLES =========== */
    .profile-page {
        background: linear-gradient(135deg, var(--slate-50) 0%, #ffffff 100%);
        min-height: 100vh;
    }

    .main-content {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem 1.5rem 3rem;
    }

    /* Back Navigation */
    .back-navigation {
        margin-bottom: 2rem;
        position: relative;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        background: var(--white);
        border: 2px solid var(--slate-200);
        border-radius: var(--radius);
        color: var(--slate-700);
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
        position: relative;
        overflow: hidden;
    }

    .back-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.05), transparent);
        transition: var(--transition);
    }

    .back-link:hover {
        background: var(--white);
        border-color: var(--black);
        color: var(--slate-900);
        transform: translateX(-4px);
        box-shadow: var(--shadow);
    }

    .back-link:hover::before {
        left: 100%;
    }

    /* Profile Header */
    .profile-header {
        background: var(--white);
        border: 2px solid var(--slate-100);
        border-radius: var(--radius-lg);
        padding: 2.5rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow);
        border-left: 4px solid var(--blue-500);
        border-right: 4px solid var(--blue-500);
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--blue-500) 0%, var(--emerald-500) 100%);
        z-index: 1;
    }

    .profile-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--blue-500) 0%, var(--emerald-500) 100%);
        z-index: 1;
    }

    .profile-header-content {
        display: flex;
        align-items: center;
        gap: 2rem;
        position: relative;
        z-index: 2;
    }

    @media (max-width: 768px) {
        .profile-header-content {
            flex-direction: column;
            text-align: center;
            gap: 1.5rem;
        }
    }

    .profile-avatar-wrapper {
        position: relative;
        flex-shrink: 0;
    }

    .avatar-container {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid var(--white);
        background: linear-gradient(135deg, var(--black) 0%, var(--slate-800) 100%);
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        position: relative;
        transition: var(--transition);
    }

    .avatar-container:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 48px rgba(0, 0, 0, 0.2);
    }

    .avatar-container::before {
        content: '';
        position: absolute;
        inset: -2px;
        border-radius: 50%;
        background: linear-gradient(45deg, var(--blue-500), var(--emerald-500), var(--amber-500));
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .avatar-container:hover::before {
        opacity: 1;
    }

    .avatar-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-initials {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: 700;
        color: var(--white);
        text-transform: uppercase;
    }

    .profile-info {
        flex: 1;
    }

    .profile-header-actions {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        display: flex;
        gap: 0.5rem;
    }

    .profile-name {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--slate-900);
        margin-bottom: 0.5rem;
        line-height: 1.2;
        position: relative;
        display: inline-block;
    }

    .profile-name::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, var(--blue-500), var(--emerald-500));
        border-radius: 2px;
    }

    .profile-email {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--slate-600);
        font-size: 1rem;
        margin-bottom: 1rem;
        padding: 0.5rem 1rem;
        background: var(--slate-50);
        border: 1px solid var(--slate-200);
        border-radius: var(--radius);
        width: fit-content;
    }

    .profile-email i {
        color: var(--blue-500);
        font-size: 0.875rem;
    }

    .profile-bio {
        color: var(--slate-700);
        font-size: 0.9375rem;
        line-height: 1.5;
        margin-bottom: 1.5rem;
        max-width: 500px;
        padding: 1rem;
        background: var(--slate-50);
        border: 1px solid var(--slate-200);
        border-radius: var(--radius);
        border-left: 4px solid var(--emerald-500);
    }

    .profile-stats {
        display: flex;
        gap: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--slate-200);
        position: relative;
    }

    .profile-stats::before {
        content: '';
        position: absolute;
        top: -1px;
        left: 0;
        width: 100px;
        height: 2px;
        background: linear-gradient(90deg, var(--blue-500), transparent);
    }

    @media (max-width: 768px) {
        .profile-stats {
            justify-content: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }
    }

    .profile-stat {
        text-align: center;
        position: relative;
        padding: 0.5rem;
        min-width: 100px;
    }

    .profile-stat::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 1px solid var(--slate-200);
        border-radius: var(--radius);
        background: var(--white);
        z-index: -1;
        transition: var(--transition);
    }

    .profile-stat:hover::before {
        border-color: var(--blue-300);
        box-shadow: var(--shadow-sm);
        transform: translateY(-2px);
    }

    .stat-number {
        display: block;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--slate-900);
        margin-bottom: 0.25rem;
        position: relative;
    }

    .stat-number::before {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        height: 2px;
        background: linear-gradient(90deg, var(--emerald-500), var(--blue-500));
        border-radius: 1px;
    }

    .stat-label {
        font-size: 0.75rem;
        color: var(--slate-500);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
    }

    /* Profile Sections Grid */
    .profile-sections-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
        position: relative;
    }

    @media (min-width: 768px) {
        .profile-sections-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .profile-section.full-width {
            grid-column: 1 / -1;
        }
    }

    /* Profile Section */
    .profile-section {
        background: var(--white);
        border: 2px solid var(--slate-100);
        border-radius: var(--radius-lg);
        padding: 2rem;
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
        animation: animateIn 0.4s ease-out forwards;
        position: relative;
        overflow: hidden;
    }

    .profile-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, var(--blue-500), var(--emerald-500));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .profile-section:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-4px);
        border-color: var(--slate-200);
    }

    .profile-section:hover::before {
        opacity: 1;
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--slate-100);
        position: relative;
    }

    .section-header::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 60px;
        height: 2px;
        background: linear-gradient(90deg, var(--blue-500), var(--emerald-500));
    }

    .section-icon {
        width: 2.5rem;
        height: 2.5rem;
        background: linear-gradient(135deg, var(--blue-50), var(--emerald-50));
        border: 2px solid var(--blue-100);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--blue-600);
        flex-shrink: 0;
        transition: var(--transition);
    }

    .profile-section:hover .section-icon {
        background: linear-gradient(135deg, var(--blue-100), var(--emerald-100));
        border-color: var(--blue-300);
        transform: rotate(5deg);
    }

    .section-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--slate-900);
        flex: 1;
        position: relative;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 40px;
        height: 2px;
        background: var(--slate-300);
        transition: var(--transition);
    }

    .profile-section:hover .section-title::after {
        width: 80px;
        background: linear-gradient(90deg, var(--blue-500), var(--emerald-500));
    }

    /* Info Display Styles */
    .info-display {
        margin-bottom: 1.5rem;
    }

    .info-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--slate-700);
        margin-bottom: 0.5rem;
        padding-left: 0.5rem;
        position: relative;
    }

    .info-label::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 16px;
        background: var(--blue-500);
        border-radius: 2px;
    }

    .info-value {
        display: block;
        padding: 0.875rem 1rem;
        background: var(--slate-50);
        border: 2px solid var(--slate-200);
        border-radius: var(--radius);
        font-size: 0.9375rem;
        color: var(--slate-900);
        min-height: 48px;
        display: flex;
        align-items: center;
    }

    .info-value.empty {
        color: var(--slate-500);
        font-style: italic;
    }

    textarea.info-value {
        min-height: 100px;
        white-space: pre-wrap;
        line-height: 1.5;
    }

    /* Settings Section */
    .settings-section {
        background: linear-gradient(135deg, var(--blue-50) 0%, #eff6ff 100%);
        border: 2px solid var(--blue-100);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-top: 2rem;
        animation: animateIn 0.4s ease-out 0.4s backwards;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .settings-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border: 2px solid var(--blue-200);
        border-radius: var(--radius-lg);
        opacity: 0.3;
        pointer-events: none;
    }

    .settings-section .section-header {
        border-bottom-color: var(--blue-200);
    }

    .settings-section .section-header::after {
        background: linear-gradient(90deg, var(--blue-500), var(--emerald-500));
    }

    .settings-section .section-icon {
        background: linear-gradient(135deg, var(--blue-100), #dbeafe);
        border-color: var(--blue-300);
        color: var(--blue-600);
    }

    .settings-section:hover .section-icon {
        background: linear-gradient(135deg, var(--blue-200), #bfdbfe);
        transform: rotate(5deg);
    }

    .settings-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    @media (min-width: 768px) {
        .settings-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .setting-item {
        background: var(--white);
        border: 2px solid var(--blue-200);
        border-radius: var(--radius);
        padding: 1.5rem;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .setting-item:hover {
        border-color: var(--blue-300);
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .setting-item-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .setting-icon {
        width: 2.5rem;
        height: 2.5rem;
        background: var(--blue-100);
        border: 2px solid var(--blue-200);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--blue-600);
        flex-shrink: 0;
    }

    .setting-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--slate-900);
        flex: 1;
    }

    .setting-description {
        font-size: 0.875rem;
        color: var(--slate-600);
        margin-bottom: 1rem;
        line-height: 1.5;
    }

    /* Danger Zone */
    .danger-zone {
        background: linear-gradient(135deg, var(--red-50) 0%, #fff5f5 100%);
        border: 2px solid var(--red-200);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-top: 2rem;
        animation: animateIn 0.4s ease-out 0.5s backwards;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .danger-zone::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border: 2px solid var(--red-300);
        border-radius: var(--radius-lg);
        opacity: 0.3;
        pointer-events: none;
    }

    .danger-zone .section-header {
        border-bottom-color: var(--red-200);
    }

    .danger-zone .section-header::after {
        background: linear-gradient(90deg, var(--red-500), var(--amber-500));
    }

    .danger-zone .section-icon {
        background: linear-gradient(135deg, var(--red-100), #fed7d7);
        border-color: var(--red-300);
        color: var(--red-600);
    }

    .danger-zone .section-title {
        color: var(--red-600);
    }

    .danger-zone:hover .section-icon {
        background: linear-gradient(135deg, var(--red-200), #feb2b2);
        transform: rotate(5deg);
    }

    .danger-warning {
        background: var(--white);
        border: 2px solid var(--red-200);
        border-radius: var(--radius);
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        position: relative;
        border-left: 4px solid var(--red-500);
    }

    .danger-warning::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        border: 2px solid var(--red-300);
        border-radius: var(--radius);
        opacity: 0.5;
        pointer-events: none;
    }

    .danger-warning i {
        color: var(--red-500);
        margin-right: 0.5rem;
        font-size: 1.25rem;
    }

    .danger-warning p {
        color: var(--slate-700);
        font-size: 0.9375rem;
        margin: 0;
        line-height: 1.5;
    }

    /* Button Styles */
    .btn {
        padding: 0.875rem 1.5rem;
        border-radius: var(--radius);
        font-size: 0.9375rem;
        font-weight: 500;
        transition: var(--transition);
        border: 2px solid transparent;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: var(--transition);
    }

    .btn:hover::before {
        left: 100%;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--black) 0%, var(--slate-800) 100%);
        color: var(--white);
        box-shadow: var(--shadow-md);
        border: none;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, var(--slate-800) 0%, var(--slate-900) 100%);
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .btn-outline {
        background: var(--white);
        color: var(--slate-700);
        border: 2px solid var(--slate-300);
    }

    .btn-outline:hover {
        border-color: var(--black);
        background: var(--slate-50);
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .btn-danger {
        background: linear-gradient(135deg, var(--red-500) 0%, var(--red-600) 100%);
        color: var(--white);
        border: none;
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, var(--red-600) 0%, var(--red-700) 100%);
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }

    .btn-icon {
        width: 40px;
        height: 40px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius);
    }

    /* Alert Styles */
    .alert {
        padding: 1rem 1.5rem;
        border-radius: var(--radius);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        animation: fadeIn 0.5s ease-out;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .alert::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: currentColor;
        opacity: 0.2;
    }

    .alert-success {
        background: linear-gradient(135deg, var(--emerald-50), #d1fae5);
        color: var(--emerald-700);
        border-color: var(--emerald-200);
    }

    .alert-error {
        background: linear-gradient(135deg, var(--red-50), #fee2e2);
        color: var(--red-700);
        border-color: var(--red-200);
    }

    .alert i {
        font-size: 1.125rem;
    }

    /* Modal Styles */
    /* =========== IMPROVED MODAL STYLES =========== */
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
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(12px) saturate(180%);
        -webkit-backdrop-filter: blur(12px) saturate(180%);
        animation: modalFadeIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modal.show {
        display: flex !important;
        opacity: 1;
    }

    .modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: transparent;
        cursor: pointer;
    }

    .modal-content {
        position: relative;
        background: var(--white);
        border-radius: 20px;
        width: 100%;
        max-width: 520px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3), 
                    0 0 0 1px rgba(255, 255, 255, 0.1) inset,
                    0 1px 0 rgba(255, 255, 255, 0.6) inset;
        animation: modalSlideIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        overflow: hidden;
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        position: relative;
        transform-origin: center;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
    }

    .modal-content::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, 
            var(--blue-500) 0%, 
            var(--emerald-500) 50%,
            var(--blue-500) 100%);
        background-size: 200% 100%;
        z-index: 1;
        animation: gradientShift 3s ease infinite;
    }

    .modal-content::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 20px;
        padding: 1px;
        background: linear-gradient(135deg, 
            rgba(59, 130, 246, 0.1) 0%, 
            rgba(16, 185, 129, 0.1) 100%);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
        z-index: 0;
    }

    /* Modal entrance animation enhancement */
    .modal.show .modal-content {
        animation: modalSlideIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    /* Subtle glow effect on modal */
    .modal-content {
        filter: drop-shadow(0 25px 50px rgba(0, 0, 0, 0.15));
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-40px) scale(0.92) rotateX(5deg);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1) rotateX(0deg);
        }
    }

    @keyframes gradientShift {
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }

    .modal-header {
        padding: 2rem 2rem 1.5rem;
        border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.95) 100%);
        position: relative;
        z-index: 2;
        backdrop-filter: blur(10px);
    }

    .modal-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, 
            transparent 0%, 
            var(--blue-500) 50%, 
            transparent 100%);
        border-radius: 2px;
        opacity: 0.6;
    }

    .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--slate-900);
        display: flex;
        align-items: center;
        gap: 1rem;
        letter-spacing: -0.02em;
        margin: 0;
    }

    .modal-title i {
        color: var(--white);
        background: linear-gradient(135deg, var(--blue-500) 0%, var(--emerald-500) 100%);
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        font-size: 1.125rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .modal-content:hover .modal-title i {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }

    .modal-close {
        background: rgba(241, 245, 249, 0.8);
        border: 2px solid transparent;
        border-radius: 12px;
        color: var(--slate-600);
        cursor: pointer;
        padding: 0;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 1.5rem;
        font-weight: 300;
        line-height: 1;
        position: relative;
        overflow: hidden;
    }

    .modal-close::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, var(--slate-100), var(--slate-200));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modal-close:hover {
        background: var(--red-50);
        border-color: var(--red-200);
        color: var(--red-600);
        transform: rotate(90deg) scale(1.1);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
    }

    .modal-close:hover::before {
        opacity: 1;
    }

    .modal-close:active {
        transform: rotate(90deg) scale(0.95);
    }

    .modal-body {
        padding: 2rem;
        max-height: calc(90vh - 180px);
        overflow-y: auto;
        overflow-x: hidden;
        background: var(--white);
        position: relative;
        z-index: 2;
        flex: 1;
    }

    .modal-body::-webkit-scrollbar {
        width: 6px;
    }

    .modal-body::-webkit-scrollbar-track {
        background: transparent;
    }

    .modal-body::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, var(--blue-300), var(--emerald-300));
        border-radius: 10px;
    }

    .modal-body::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, var(--blue-400), var(--emerald-400));
    }

    .modal-footer {
        padding: 1.5rem 2rem 2rem;
        border-top: 1px solid rgba(226, 232, 240, 0.8);
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        background: linear-gradient(180deg, rgba(248, 250, 252, 0.95) 0%, rgba(255, 255, 255, 0.95) 100%);
        position: relative;
        z-index: 2;
        backdrop-filter: blur(10px);
    }

    .modal-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, 
            transparent 0%, 
            var(--emerald-500) 50%, 
            transparent 100%);
        border-radius: 2px;
        opacity: 0.6;
    }

    /* Form Styles in Modal - Improved */
    .modal .form-group {
        margin-bottom: 1.75rem;
        position: relative;
    }

    .modal .form-group:last-child {
        margin-bottom: 0;
    }

    .modal .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--slate-800);
        margin-bottom: 0.625rem;
        padding-left: 1rem;
        position: relative;
        letter-spacing: 0.01em;
    }

    .modal .form-label::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 18px;
        background: linear-gradient(180deg, var(--blue-500), var(--emerald-500));
        border-radius: 2px;
        box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
    }

    .modal .form-label.required::after {
        content: '*';
        color: var(--red-500);
        margin-left: 0.25rem;
        font-weight: 700;
        font-size: 1.1em;
    }

    .modal .form-control {
        width: 100%;
        padding: 0.9375rem 1.125rem;
        background: var(--white);
        border: 2px solid var(--slate-200);
        border-radius: 12px;
        font-size: 0.9375rem;
        color: var(--slate-900);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        outline: none;
        font-family: inherit;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .modal .form-control:hover {
        border-color: var(--slate-300);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    .modal .form-control:focus {
        border-color: var(--blue-500);
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12),
                    0 4px 12px rgba(59, 130, 246, 0.15);
        background: var(--white);
        transform: translateY(-1px);
    }

    .modal .form-control.is-invalid {
        border-color: var(--red-400);
        background: linear-gradient(to right, var(--white) 0%, rgba(254, 242, 242, 0.3) 100%);
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.12),
                    0 2px 8px rgba(239, 68, 68, 0.15);
    }

    .modal .form-control.is-invalid:focus {
        border-color: var(--red-500);
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.2),
                    0 4px 12px rgba(239, 68, 68, 0.2);
    }

    .modal .form-text {
        font-size: 0.8125rem;
        color: var(--slate-500);
        margin-top: 0.5rem;
        display: block;
        padding-left: 1rem;
        line-height: 1.5;
    }

    .modal .form-text.error {
        color: var(--red-700);
        background: linear-gradient(to right, var(--red-50) 0%, rgba(254, 242, 242, 0.5) 100%);
        padding: 0.625rem 0.875rem;
        border-radius: 8px;
        border-left: 4px solid var(--red-500);
        margin-top: 0.625rem;
        font-weight: 600;
        box-shadow: 0 2px 6px rgba(239, 68, 68, 0.1);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .modal .form-text.error::before {
        content: '⚠';
        font-size: 1rem;
        line-height: 1;
    }

    .modal textarea.form-control {
        min-height: 100px;
        resize: vertical;
        line-height: 1.5;
    }

    /* Image Upload in Modal - Improved */
    .modal .image-upload-area {
        border: 3px dashed var(--slate-300);
        border-radius: 16px;
        padding: 3rem 2rem;
        text-align: center;
        background: linear-gradient(135deg, var(--slate-50) 0%, var(--blue-50) 100%);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        margin-bottom: 1rem;
        position: relative;
        overflow: hidden;
    }

    .modal .image-upload-area::before {
        content: '';
        position: absolute;
        inset: -2px;
        border-radius: 16px;
        background: linear-gradient(135deg, var(--blue-500), var(--emerald-500));
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }

    .modal .image-upload-area:hover {
        border-color: var(--blue-500);
        background: linear-gradient(135deg, var(--blue-50) 0%, var(--emerald-50) 100%);
        transform: translateY(-3px) scale(1.01);
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.2),
                    0 0 0 1px rgba(59, 130, 246, 0.1);
        border-style: solid;
    }

    .modal .image-upload-area:hover::before {
        opacity: 0.1;
    }

    .modal .image-upload-area.drag-over {
        border-color: var(--emerald-500);
        background: linear-gradient(135deg, var(--emerald-50) 0%, var(--blue-50) 100%);
        border-style: solid;
        transform: scale(1.02);
        box-shadow: 0 12px 32px rgba(16, 185, 129, 0.25);
    }

    .modal .current-image-container {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        margin: 0 auto 2rem;
        overflow: hidden;
        border: 4px solid var(--white);
        box-shadow: var(--shadow-lg);
        position: relative;
        z-index: 2;
        transition: var(--transition);
    }

    .modal .image-upload-area:hover .current-image-container {
        transform: scale(1.05);
        box-shadow: var(--shadow-xl);
        border-color: var(--blue-100);
    }

    .modal .image-placeholder {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--slate-300) 0%, var(--slate-400) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        font-size: 3rem;
        font-weight: 700;
        color: var(--white);
        border: 4px solid var(--white);
        position: relative;
        z-index: 2;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .modal .upload-prompt {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        position: relative;
        z-index: 2;
    }

    .modal .upload-prompt i {
        font-size: 2.5rem;
        color: var(--blue-600);
        background: linear-gradient(135deg, var(--white) 0%, var(--blue-50) 100%);
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid var(--blue-200);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2),
                    0 0 0 1px rgba(59, 130, 246, 0.1) inset;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .modal .upload-prompt i::before {
        content: '';
        position: absolute;
        inset: -2px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--blue-400), var(--emerald-400));
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }

    .modal .image-upload-area:hover .upload-prompt i {
        transform: translateY(-6px) scale(1.05);
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3),
                    0 0 0 2px rgba(59, 130, 246, 0.2) inset;
        color: var(--blue-700);
        border-color: var(--blue-400);
        background: linear-gradient(135deg, var(--blue-50) 0%, var(--emerald-50) 100%);
    }

    .modal .image-upload-area:hover .upload-prompt i::before {
        opacity: 0.1;
    }

    .modal .upload-text {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--slate-800);
    }

    .modal .upload-subtext {
        font-size: 0.875rem;
        color: var(--slate-600);
    }

    .modal .file-input {
        display: none;
    }

    /* Password Input Group in Modal - Improved */
    .modal .input-group {
        position: relative;
    }

    .modal .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: var(--white);
        border: 2px solid var(--slate-300);
        border-radius: var(--radius-sm);
        color: var(--slate-600);
        cursor: pointer;
        padding: 0.375rem;
        transition: var(--transition);
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal .password-toggle:hover {
        background: var(--slate-100);
        border-color: var(--slate-400);
        color: var(--slate-900);
        transform: translateY(-50%) scale(1.1);
    }

    /* Delete Account Modal Specific Styles */
    #deleteAccountModal .modal-content {
        max-width: 480px;
        background: linear-gradient(135deg, #ffffff 0%, #fef2f2 100%);
    }

    #deleteAccountModal .modal-content::before {
        background: linear-gradient(90deg, 
            var(--red-500) 0%, 
            var(--amber-500) 50%,
            var(--red-500) 100%);
    }

    #deleteAccountModal .modal-header {
        background: linear-gradient(180deg, rgba(254, 242, 242, 0.95) 0%, rgba(255, 255, 255, 0.95) 100%);
        border-bottom-color: rgba(254, 202, 202, 0.5);
    }

    #deleteAccountModal .modal-header::after {
        background: linear-gradient(90deg, 
            transparent 0%, 
            var(--red-500) 50%, 
            transparent 100%);
    }

    #deleteAccountModal .modal-title {
        color: var(--red-700);
    }

    #deleteAccountModal .modal-title i {
        background: linear-gradient(135deg, var(--red-500) 0%, var(--amber-500) 100%);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    #deleteAccountModal .modal-content:hover .modal-title i {
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
    }

    #deleteAccountModal .modal-body {
        background: var(--white);
    }

    #deleteAccountModal .warning-highlight {
        background: linear-gradient(135deg, var(--red-50) 0%, rgba(254, 242, 242, 0.8) 100%);
        border: 2px solid var(--red-200);
        border-radius: 12px;
        padding: 1.5rem;
        margin: 1.5rem 0;
        border-left: 5px solid var(--red-500);
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.1);
        position: relative;
        overflow: hidden;
    }

    #deleteAccountModal .warning-highlight::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, transparent 0%, rgba(239, 68, 68, 0.05) 100%);
        pointer-events: none;
    }

    #deleteAccountModal .warning-highlight i {
        color: var(--red-500);
        font-size: 1.5rem;
        margin-top: 0.125rem;
        position: relative;
        z-index: 1;
    }

    #deleteAccountModal .warning-highlight p {
        color: var(--red-800);
        font-weight: 600;
        margin: 0;
        line-height: 1.6;
        position: relative;
        z-index: 1;
    }

    #deleteAccountModal .modal-footer {
        background: linear-gradient(180deg, rgba(254, 242, 242, 0.95) 0%, rgba(255, 255, 255, 0.95) 100%);
        border-top-color: rgba(254, 202, 202, 0.5);
    }

    #deleteAccountModal .modal-footer::before {
        background: linear-gradient(90deg, 
            transparent 0%, 
            var(--red-500) 50%, 
            transparent 100%);
    }

    /* Specific button states for modal */
    .modal .btn {
        position: relative;
        overflow: hidden;
        font-weight: 600;
        letter-spacing: 0.01em;
        border-radius: 12px;
        padding: 0.9375rem 1.75rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .modal .btn-primary {
        background: linear-gradient(135deg, var(--black) 0%, var(--slate-800) 100%);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15),
                    0 0 0 1px rgba(0, 0, 0, 0.05) inset;
    }

    .modal .btn-primary:hover {
        background: linear-gradient(135deg, var(--slate-800) 0%, var(--slate-900) 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2),
                    0 0 0 1px rgba(0, 0, 0, 0.1) inset;
    }

    .modal .btn-primary:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .modal .btn-outline {
        background: var(--white);
        border: 2px solid var(--slate-300);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .modal .btn-outline:hover {
        border-color: var(--slate-400);
        background: var(--slate-50);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .modal .btn-danger {
        background: linear-gradient(135deg, var(--red-500) 0%, var(--red-600) 100%);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
    }

    .modal .btn-danger:hover {
        background: linear-gradient(135deg, var(--red-600) 0%, var(--red-700) 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.3);
    }

    .modal .btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }

    .modal .btn.loading {
        position: relative;
        color: transparent !important;
        pointer-events: none;
    }

    .modal .btn.loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: var(--white);
        animation: spin 0.8s linear infinite;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    @keyframes spin {
        to { transform: translate(-50%, -50%) rotate(360deg); }
    }

    /* Responsive modal improvements */
    @media (max-width: 768px) {
        .modal {
            padding: 0.75rem;
            backdrop-filter: blur(8px);
        }
        
        .modal-content {
            max-width: 100%;
            margin: auto;
            border-radius: 16px;
            max-height: 95vh;
        }
        
        .modal-header {
            padding: 1.5rem 1.5rem 1.25rem;
        }
        
        .modal-body {
            padding: 1.5rem;
            max-height: calc(95vh - 160px);
        }
        
        .modal-footer {
            padding: 1.25rem 1.5rem 1.5rem;
            flex-direction: column-reverse;
            gap: 0.75rem;
        }
        
        .modal-footer .btn {
            width: 100%;
            justify-content: center;
            padding: 1rem 1.5rem;
        }
        
        .modal-title {
            font-size: 1.25rem;
        }
        
        .modal-title i {
            width: 36px;
            height: 36px;
            font-size: 1rem;
        }
        
        .modal-close {
            width: 36px;
            height: 36px;
            font-size: 1.25rem;
        }
        
        .modal .image-upload-area {
            padding: 2rem 1.5rem;
        }
        
        .modal .current-image-container,
        .modal .image-placeholder {
            width: 110px;
            height: 110px;
            margin-bottom: 1.5rem;
        }
        
        .modal .image-placeholder {
            font-size: 2.25rem;
        }
        
        .modal .upload-prompt i {
            width: 64px;
            height: 64px;
            font-size: 1.875rem;
        }
        
        .modal .form-group {
            margin-bottom: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .modal {
            padding: 0.5rem;
        }
        
        .modal-content {
            border-radius: 12px;
        }
        
        .modal-header {
            padding: 1.25rem 1.25rem 1rem;
        }
        
        .modal-body {
            padding: 1.25rem;
        }
        
        .modal-footer {
            padding: 1rem 1.25rem 1.25rem;
        }
        
        .modal-title {
            font-size: 1.125rem;
            gap: 0.75rem;
        }
        
        .modal-title i {
            width: 32px;
            height: 32px;
            font-size: 0.9375rem;
        }
        
        .modal .form-control {
            padding: 0.875rem 1rem;
            font-size: 0.875rem;
        }
        
        .modal .form-label {
            font-size: 0.8125rem;
            padding-left: 0.875rem;
        }
        
        .modal .image-upload-area {
            padding: 1.5rem 1rem;
        }
        
        .modal .current-image-container,
        .modal .image-placeholder {
            width: 90px;
            height: 90px;
            margin-bottom: 1.25rem;
        }
        
        .modal .image-placeholder {
            font-size: 2rem;
        }
        
        .modal .upload-prompt i {
            width: 56px;
            height: 56px;
            font-size: 1.625rem;
        }
        
        .modal .upload-text {
            font-size: 1rem;
        }
        
        .modal .upload-subtext {
            font-size: 0.8125rem;
        }
    }

    @media (max-width: 640px) {
        .profile-stats {
            justify-content: space-between;
        }

        .profile-stat {
            flex: 1;
            min-width: 80px;
        }

        .settings-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="profile-page">
    <div class="main-content">
        <!-- Back Navigation -->
        <div class="back-navigation animate-in">
            <a href="{{ route('dashboard') }}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success animate-in">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error animate-in">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Profile Header -->
        <div class="profile-header animate-in">
            <div class="profile-header-content">
                <div class="profile-avatar-wrapper">
                    <div class="avatar-container" id="avatarPreviewContainer">
                        @if(Auth::user()->profile_image)
                            <img src="{{ Storage::url(Auth::user()->profile_image) }}" 
                                 alt="{{ Auth::user()->name }}" 
                                 id="avatarImage">
                        @else
                            <div class="avatar-initials">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="profile-info">
                    <h1 class="profile-name">{{ Auth::user()->name }}</h1>
                    
                    <div class="profile-email">
                        <i class="fas fa-envelope"></i>
                        {{ Auth::user()->email }}
                    </div>
                    
                    @if(Auth::user()->bio)
                        <p class="profile-bio">{{ Auth::user()->bio }}</p>
                    @endif
                    
                    <div class="profile-stats">
                        <div class="profile-stat">
                            <span class="stat-number">{{ $stats['total_tasks'] ?? 0 }}</span>
                            <span class="stat-label">Total Tasks</span>
                        </div>
                        <div class="profile-stat">
                            <span class="stat-number">{{ $stats['completed_tasks'] ?? 0 }}</span>
                            <span class="stat-label">Completed</span>
                        </div>
                        <div class="profile-stat">
                            <span class="stat-number">{{ Auth::user()->created_at->format('M Y') }}</span>
                            <span class="stat-label">Member Since</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Edit Profile Button -->
            <div class="profile-header-actions">
                <button class="btn btn-primary btn-sm" onclick="showEditProfileModal()">
                    <i class="fas fa-edit"></i>
                    Edit Profile
                </button>
            </div>
        </div>

        <div class="profile-sections-grid">
            <!-- Personal Information Section -->
            <div class="profile-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <h2 class="section-title">Personal Info</h2>
                    <button class="btn btn-outline btn-sm" onclick="showEditProfileModal()">
                        <i class="fas fa-edit"></i>
                    </button>
                </div>
                
                <div class="info-display">
                    <label class="info-label">Full Name</label>
                    <div class="info-value">{{ Auth::user()->name }}</div>
                </div>

                <div class="info-display">
                    <label class="info-label">Email Address</label>
                    <div class="info-value">{{ Auth::user()->email }}</div>
                </div>

                <div class="info-display">
                    <label class="info-label">Bio</label>
                    <div class="info-value {{ !Auth::user()->bio ? 'empty' : '' }}">
                        {{ Auth::user()->bio ?: 'No bio provided' }}
                    </div>
                </div>
            </div>

            <!-- Contact Information Section -->
            <div class="profile-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-address-book"></i>
                    </div>
                    <h2 class="section-title">Contact Info</h2>
                    <button class="btn btn-outline btn-sm" onclick="showEditProfileModal()">
                        <i class="fas fa-edit"></i>
                    </button>
                </div>
                
                <div class="info-display">
                    <label class="info-label">Phone Number</label>
                    <div class="info-value {{ !Auth::user()->phone ? 'empty' : '' }}">
                        {{ Auth::user()->phone ?: 'Not provided' }}
                    </div>
                </div>

                <div class="info-display">
                    <label class="info-label">Location</label>
                    <div class="info-value {{ !Auth::user()->location ? 'empty' : '' }}">
                        {{ Auth::user()->location ?: 'Not provided' }}
                    </div>
                </div>

                <div class="info-display">
                    <label class="info-label">Website</label>
                    <div class="info-value {{ !Auth::user()->website ? 'empty' : '' }}">
                        {{ Auth::user()->website ?: 'Not provided' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Section -->
        <div class="settings-section">
            <div class="section-header">
                <div class="section-icon">
                    <i class="fas fa-cog"></i>
                </div>
                <h2 class="section-title">Account Settings</h2>
            </div>
            
            <div class="settings-grid">
                <!-- Profile Picture Setting -->
                <div class="setting-item">
                    <div class="setting-item-header">
                        <div class="setting-icon">
                            <i class="fas fa-camera"></i>
                        </div>
                        <h3 class="setting-title">Profile Picture</h3>
                    </div>
                    <p class="setting-description">Update your profile photo. Supported formats: JPG, PNG, GIF. Max size: 2MB.</p>
                    <button class="btn btn-outline btn-sm" onclick="showImageUploadModal()">
                        <i class="fas fa-upload"></i>
                        Change Photo
                    </button>
                </div>

                <!-- Password Setting -->
                <div class="setting-item">
                    <div class="setting-item-header">
                        <div class="setting-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="setting-title">Account Security</h3>
                    </div>
                    <p class="setting-description">Manage your email address and password from the account settings page.</p>
                    <a href="{{ route('settings.show') }}" class="btn btn-outline btn-sm">
                        <i class="fas fa-cog"></i>
                        Open Settings
                    </a>
                </div>
            </div>
        </div>

        
    </div>
</div>

<!-- Edit Profile Modal -->
<div id="editProfileModal" class="modal" style="display: none;">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="fas fa-user-edit"></i>
                Edit Profile
            </h3>
            <button type="button" class="modal-close" onclick="hideEditProfileModal()">&times;</button>
        </div>
        <form action="{{ route('profile.update') }}" method="POST" id="editProfileForm">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label required">Full Name</label>
                    <input type="text" 
                           name="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', Auth::user()->name) }}" 
                           required>
                    @error('name')
                        <small class="form-text error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" 
                              class="form-control @error('bio') is-invalid @enderror" 
                              rows="3"
                              placeholder="Tell us a little about yourself...">{{ old('bio', Auth::user()->bio ?? '') }}</textarea>
                    @error('bio')
                        <small class="form-text error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" 
                           name="phone" 
                           class="form-control @error('phone') is-invalid @enderror" 
                           value="{{ old('phone', Auth::user()->phone ?? '') }}"
                           placeholder="+1 (555) 123-4567">
                    @error('phone')
                        <small class="form-text error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Location</label>
                    <input type="text" 
                           name="location" 
                           class="form-control @error('location') is-invalid @enderror" 
                           value="{{ old('location', Auth::user()->location ?? '') }}"
                           placeholder="City, Country">
                    @error('location')
                        <small class="form-text error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Website</label>
                    <input type="url" 
                           name="website" 
                           class="form-control @error('website') is-invalid @enderror" 
                           value="{{ old('website', Auth::user()->website ?? '') }}"
                           placeholder="https://example.com">
                    @error('website')
                        <small class="form-text error">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="hideEditProfileModal()">Cancel</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Change Password Modal -->


<!-- Image Upload Modal -->
<div id="imageUploadModal" class="modal" style="display: none;">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="fas fa-camera"></i>
                Update Profile Picture
            </h3>
            <button type="button" class="modal-close" onclick="hideImageUploadModal()">&times;</button>
        </div>
        <form action="{{ route('profile.image.update') }}" method="POST" enctype="multipart/form-data" id="imageUploadForm">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label for="profileImageModal" class="image-upload-area">
                        <div id="imagePreviewModal">
                            @if(Auth::user()->profile_image)
                                <div class="current-image-container">
                                    <img src="{{ Storage::url(Auth::user()->profile_image) }}" 
                                         alt="Current Profile" 
                                         id="currentImageModal">
                                </div>
                            @else
                                <div class="image-placeholder">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="upload-prompt">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span class="upload-text">Click to upload new picture</span>
                            <span class="upload-subtext">or drag and drop your image here</span>
                        </div>
                    </label>
                    
                    <input type="file" 
                           name="profile_image" 
                           id="profileImageModal" 
                           class="file-input" 
                           accept="image/*"
                           onchange="previewImageModal(event)">
                    
                    @error('profile_image')
                        <small class="form-text error">{{ $message }}</small>
                    @enderror
                    
                    <small class="form-text">Maximum file size: 2MB. Allowed formats: JPG, PNG, GIF</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="hideImageUploadModal()">Cancel</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Update Picture
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Account Modal -->
<div id="deleteAccountModal" class="modal" style="display: none;">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="fas fa-exclamation-triangle" style="color: var(--red-500);"></i>
                Delete Account
            </h3>
            <button type="button" class="modal-close" onclick="hideDeleteAccountModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete your account?</p>
            <div class="warning-highlight">
                <i class="fas fa-exclamation-circle"></i>
                <p>This action cannot be undone. All your tasks and data will be permanently deleted.</p>
            </div>
            <p>Please enter your password to confirm:</p>
            <input type="password" 
                   class="form-control" 
                   id="confirmDeletePassword"
                   placeholder="Enter your password">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline" onclick="hideDeleteAccountModal()">Cancel</button>
            <button type="button" class="btn btn-danger" id="confirmDeleteBtn" disabled>
                <i class="fas fa-trash"></i>
                Delete Account
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal Functions
        function showEditProfileModal() {
            const modal = document.getElementById('editProfileModal');
            modal.classList.add('show');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function hideEditProfileModal() {
            const modal = document.getElementById('editProfileModal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
            document.body.style.overflow = '';
        }

        function showChangePasswordModal() {
            const modal = document.getElementById('changePasswordModal');
            modal.classList.add('show');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            
            // Clear password fields
            document.getElementById('currentPassword').value = '';
            document.getElementById('newPassword').value = '';
            document.getElementById('confirmPassword').value = '';
        }

        function hideChangePasswordModal() {
            const modal = document.getElementById('changePasswordModal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
            document.body.style.overflow = '';
        }

        function showImageUploadModal() {
            const modal = document.getElementById('imageUploadModal');
            modal.classList.add('show');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function hideImageUploadModal() {
            const modal = document.getElementById('imageUploadModal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
            document.body.style.overflow = '';
        }

        function showDeleteAccountModal() {
            const modal = document.getElementById('deleteAccountModal');
            modal.classList.add('show');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            
            // Clear password field
            document.getElementById('confirmDeletePassword').value = '';
            document.getElementById('confirmDeleteBtn').disabled = true;
        }

        function hideDeleteAccountModal() {
            const modal = document.getElementById('deleteAccountModal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
            document.body.style.overflow = '';
        }

        // Image Preview Function for Modal
        window.previewImageModal = function(event) {
            const reader = new FileReader();
            const imagePreview = document.getElementById('imagePreviewModal');
            const avatarPreviewContainer = document.getElementById('avatarPreviewContainer');
            
            reader.onload = function() {
                // Update modal image preview
                if (imagePreview.querySelector('img')) {
                    imagePreview.querySelector('img').src = reader.result;
                } else {
                    imagePreview.innerHTML = `
                        <div class="current-image-container">
                            <img src="${reader.result}" alt="Preview">
                        </div>
                    `;
                }
                
                // Update header avatar preview
                const avatarImg = avatarPreviewContainer.querySelector('img');
                if (avatarImg) {
                    avatarImg.src = reader.result;
                } else {
                    const initials = avatarPreviewContainer.querySelector('.avatar-initials');
                    if (initials) {
                        initials.style.display = 'none';
                    }
                    const img = document.createElement('img');
                    img.src = reader.result;
                    img.alt = 'Profile';
                    avatarPreviewContainer.appendChild(img);
                }
            }
            
            if (event.target.files[0]) {
                // Validate file size
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (event.target.files[0].size > maxSize) {
                    showToast('File size must be less than 2MB!', 'error');
                    event.target.value = '';
                    return;
                }
                
                // Validate file type
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(event.target.files[0].type)) {
                    showToast('Only JPG, PNG, and GIF files are allowed!', 'error');
                    event.target.value = '';
                    return;
                }
                
                reader.readAsDataURL(event.target.files[0]);
            }
        }

        // Password Toggle Function
        window.togglePassword = function(inputId) {
            const input = document.getElementById(inputId);
            const toggle = input.nextElementSibling;
            const icon = toggle.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Form Submission Handlers
        const editProfileForm = document.getElementById('editProfileForm');
        const changePasswordForm = document.getElementById('changePasswordForm');
        const imageUploadForm = document.getElementById('imageUploadForm');
        
        if (editProfileForm) {
            editProfileForm.addEventListener('submit', function(e) {
                // Validate form
                const name = this.querySelector('input[name="name"]').value.trim();
                const email = this.querySelector('input[name="email"]').value.trim();
                
                if (!name || !email) {
                    e.preventDefault();
                    showToast('Please fill in all required fields', 'error');
                    return;
                }
                
                // Show loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
                
                // Submit will proceed
            });
        }
        
        if (changePasswordForm) {
            changePasswordForm.addEventListener('submit', function(e) {
                const password = document.getElementById('newPassword').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                
                if (password && password !== confirmPassword) {
                    e.preventDefault();
                    showToast('Passwords do not match!', 'error');
                    return;
                }
                
                // Show loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
            });
        }
        
        if (imageUploadForm) {
            imageUploadForm.addEventListener('submit', function(e) {
                const fileInput = document.getElementById('profileImageModal');
                if (!fileInput.files[0]) {
                    e.preventDefault();
                    showToast('Please select an image to upload', 'error');
                    return;
                }
                
                // Show loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
            });
        }

        // Password confirmation for account deletion
        const confirmDeletePassword = document.getElementById('confirmDeletePassword');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        
        if (confirmDeletePassword && confirmDeleteBtn) {
            confirmDeletePassword.addEventListener('input', function() {
                confirmDeleteBtn.disabled = this.value.length === 0;
            });

            confirmDeleteBtn.addEventListener('click', function() {
                // Here you would typically make an AJAX request to delete the account
                showToast('Account deletion feature is not implemented yet.', 'info');
                hideDeleteAccountModal();
            });
        }

        // Close modals when clicking overlay
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                // Close if clicking the modal backdrop or overlay
                if (e.target === this || e.target.classList.contains('modal-overlay')) {
                    if (this.id === 'editProfileModal') hideEditProfileModal();
                    if (this.id === 'changePasswordModal') hideChangePasswordModal();
                    if (this.id === 'imageUploadModal') hideImageUploadModal();
                    if (this.id === 'deleteAccountModal') hideDeleteAccountModal();
                }
            });
            
            // Prevent modal content clicks from closing the modal
            const modalContent = modal.querySelector('.modal-content');
            if (modalContent) {
                modalContent.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
        });

        // Close modals with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (document.getElementById('editProfileModal').classList.contains('show')) hideEditProfileModal();
                if (document.getElementById('changePasswordModal').classList.contains('show')) hideChangePasswordModal();
                if (document.getElementById('imageUploadModal').classList.contains('show')) hideImageUploadModal();
                if (document.getElementById('deleteAccountModal').classList.contains('show')) hideDeleteAccountModal();
            }
        });

        // Toast Notification Function
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

        // Add CSS for custom alerts if not already present
        if (!document.querySelector('style[data-toast-style]')) {
            const toastStyle = document.createElement('style');
            toastStyle.setAttribute('data-toast-style', 'true');
            toastStyle.textContent = `
                .custom-toast {
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    padding: 12px 20px;
                    border-radius: var(--radius);
                    background: var(--white);
                    box-shadow: var(--shadow-lg);
                    z-index: 9999;
                    transform: translateX(120%);
                    transition: transform 0.3s ease;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    max-width: 300px;
                    border-left: 4px solid transparent;
                }
                
                .custom-toast.show {
                    transform: translateX(0);
                }
                
                .toast-success {
                    border-left-color: var(--emerald-500);
                    color: var(--emerald-500);
                }
                
                .toast-error {
                    border-left-color: var(--red-500);
                    color: var(--red-500);
                }
                
                .toast-info {
                    border-left-color: var(--blue-500);
                    color: var(--blue-500);
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
        }

        // Drag and drop for image upload in modal
        const imageUploadArea = document.querySelector('#imageUploadModal .image-upload-area');
        if (imageUploadArea) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                imageUploadArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                imageUploadArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                imageUploadArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                imageUploadArea.style.borderColor = 'var(--blue-500)';
                imageUploadArea.style.background = 'var(--blue-50)';
                imageUploadArea.style.transform = 'scale(1.02)';
            }

            function unhighlight() {
                imageUploadArea.style.borderColor = '';
                imageUploadArea.style.background = '';
                imageUploadArea.style.transform = '';
            }

            imageUploadArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                
                if (files.length > 0) {
                    const file = files[0];
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    
                    if (!allowedTypes.includes(file.type)) {
                        showToast('Only JPG, PNG, and GIF files are allowed!', 'error');
                        return;
                    }
                    
                    const maxSize = 2 * 1024 * 1024; // 2MB
                    if (file.size > maxSize) {
                        showToast('File size must be less than 2MB!', 'error');
                        return;
                    }
                    
                    // Create a new FileList-like object
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    document.getElementById('profileImageModal').files = dataTransfer.files;
                    
                    // Trigger change event
                    const event = new Event('change', { bubbles: true });
                    document.getElementById('profileImageModal').dispatchEvent(event);
                }
            }
        }

        // Animation on scroll
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
        
        document.querySelectorAll('.profile-section, .settings-section, .danger-zone').forEach(el => {
            observer.observe(el);
        });

        // Make functions available globally
        window.showEditProfileModal = showEditProfileModal;
        window.hideEditProfileModal = hideEditProfileModal;
        window.showChangePasswordModal = showChangePasswordModal;
        window.hideChangePasswordModal = hideChangePasswordModal;
        window.showImageUploadModal = showImageUploadModal;
        window.hideImageUploadModal = hideImageUploadModal;
        window.showDeleteAccountModal = showDeleteAccountModal;
        window.hideDeleteAccountModal = hideDeleteAccountModal;
    });
</script>
@endpush