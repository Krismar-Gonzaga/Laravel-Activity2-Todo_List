@extends('layouts.app')

@section('title', 'My Profile - TaskFlow')

@push('styles')
<style>
/* =========== PROFILE PAGE STYLES - IMPROVED AESTHETICS =========== */
:root {
    /* Keeping existing color variables but adding new ones */
    --gradient-primary: linear-gradient(135deg, var(--blue-500), var(--emerald-500));
    --gradient-dark: linear-gradient(135deg, var(--slate-800), var(--slate-900));
    --shadow-elevation: 0 10px 40px -10px rgba(0, 0, 0, 0.2);
    --shadow-elevation-hover: 0 20px 50px -15px rgba(0, 0, 0, 0.3);
    --border-glow: 0 0 0 2px rgba(59, 130, 246, 0.1);
}

.profile-page {
    background: radial-gradient(circle at 0% 0%, var(--slate-50) 0%, #ffffff 100%);
    min-height: 100vh;
    position: relative;
    isolation: isolate;
}

.profile-page::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 100% 100%, rgba(59, 130, 246, 0.03) 0%, transparent 50%);
    pointer-events: none;
    z-index: 0;
}

.main-content {
    max-width: 1100px;
    margin: 0 auto;
    padding: 2rem 1.5rem 4rem;
    position: relative;
    z-index: 1;
}

/* ===== ANIMATIONS ===== */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px) scale(0.98);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes shimmer {
    0% {
        background-position: -200% 0;
    }
    100% {
        background-position: 200% 0;
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-5px);
    }
}

.animate-in {
    animation: slideInUp 0.5s cubic-bezier(0.23, 1, 0.32, 1) forwards;
    opacity: 0;
}

/* ===== BACK NAVIGATION ===== */
.back-navigation {
    margin-bottom: 2rem;
    position: relative;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 0.625rem;
    padding: 0.75rem 1.5rem;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(203, 213, 225, 0.4);
    border-radius: 100px;
    color: var(--slate-700);
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    position: relative;
    overflow: hidden;
}

.back-link::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

.back-link:hover {
    background: var(--white);
    border-color: rgba(0, 0, 0, 0.2);
    color: var(--slate-900);
    transform: translateX(-4px) translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}

.back-link:hover::before {
    transform: translateX(100%);
}

.back-link i {
    font-size: 0.75rem;
    transition: transform 0.3s ease;
}

.back-link:hover i {
    transform: translateX(-4px);
}

/* ===== ALERT STYLES ===== */
.alert {
    padding: 1rem 1.5rem;
    border-radius: 16px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    animation: fadeInScale 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.alert::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transform: translateX(-100%);
    animation: shimmer 2s infinite;
}

.alert-success {
    background: linear-gradient(105deg, #ecfdf5 0%, #d1fae5 100%);
    color: #065f46;
    border-left: 5px solid #10b981;
}

.alert-error {
    background: linear-gradient(105deg, #fef2f2 0%, #fee2e2 100%);
    color: #b91c1c;
    border-left: 5px solid #ef4444;
}

.alert i {
    font-size: 1.25rem;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

/* ===== PROFILE HEADER ===== */
.profile-header {
    background: var(--white);
    border-radius: 32px;
    padding: 2.5rem;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
    box-shadow: var(--shadow-elevation);
    border: 1px solid rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(10px);
    animation: slideInUp 0.5s 0.1s cubic-bezier(0.23, 1, 0.32, 1) forwards;
    opacity: 0;
}

.profile-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 100%;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.03) 0%, rgba(16, 185, 129, 0.03) 100%);
    z-index: 0;
    pointer-events: none;
}

.profile-header::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 200%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent 0%, 
        rgba(59, 130, 246, 0.05) 25%,
        rgba(16, 185, 129, 0.05) 50%,
        rgba(59, 130, 246, 0.05) 75%,
        transparent 100%);
    animation: shimmer 8s infinite;
    pointer-events: none;
    z-index: 0;
}

.profile-header-content {
    display: flex;
    align-items: center;
    gap: 2.5rem;
    position: relative;
    z-index: 1;
}

@media (max-width: 768px) {
    .profile-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }
}

/* ===== AVATAR STYLES ===== */
.profile-avatar-wrapper {
    position: relative;
    flex-shrink: 0;
}

.avatar-container {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--slate-700) 0%, var(--slate-900) 100%);
    overflow: hidden;
    box-shadow: 0 15px 35px -8px rgba(0, 0, 0, 0.3);
    position: relative;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    border: 3px solid white;
}

.avatar-container::before {
    content: '';
    position: absolute;
    inset: -3px;
    border-radius: 50%;
    background: var(--gradient-primary);
    opacity: 0;
    transition: opacity 0.4s ease;
    z-index: -1;
}

.avatar-container:hover {
    transform: scale(1.05) rotate(2deg);
    box-shadow: 0 25px 40px -12px rgba(59, 130, 246, 0.4);
}

.avatar-container:hover::before {
    opacity: 1;
    animation: float 3s ease infinite;
}

.avatar-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.avatar-container:hover img {
    transform: scale(1.1);
}

.avatar-initials {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3.25rem;
    font-weight: 700;
    color: var(--white);
    text-transform: uppercase;
    background: var(--gradient-dark);
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

/* ===== PROFILE INFO ===== */
.profile-info {
    flex: 1;
}

.profile-header-actions {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    display: flex;
    gap: 0.5rem;
    z-index: 2;
}

.profile-name {
    font-size: 2rem;
    font-weight: 700;
    color: var(--slate-900);
    margin-bottom: 0.75rem;
    line-height: 1.2;
    position: relative;
    display: inline-block;
    letter-spacing: -0.02em;
}

.profile-name::after {
    content: '';
    position: absolute;
    bottom: -6px;
    left: 0;
    width: 80px;
    height: 4px;
    background: var(--gradient-primary);
    border-radius: 4px;
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
}

.profile-email {
    display: inline-flex;
    align-items: center;
    gap: 0.625rem;
    color: var(--slate-600);
    font-size: 0.9375rem;
    margin-bottom: 1.25rem;
    padding: 0.5rem 1.25rem;
    background: rgba(241, 245, 249, 0.7);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(203, 213, 225, 0.4);
    border-radius: 100px;
    width: fit-content;
    transition: all 0.3s ease;
}

.profile-email:hover {
    background: var(--slate-100);
    border-color: var(--slate-300);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px -8px rgba(0, 0, 0, 0.15);
}

.profile-email i {
    color: var(--blue-500);
    font-size: 0.875rem;
    transition: transform 0.3s ease;
}

.profile-email:hover i {
    transform: scale(1.1);
}

.profile-bio {
    color: var(--slate-700);
    font-size: 0.9375rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    max-width: 600px;
    padding: 1.25rem 1.5rem;
    background: rgba(241, 245, 249, 0.5);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(203, 213, 225, 0.3);
    border-radius: 20px;
    border-left: 4px solid var(--emerald-500);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    transition: all 0.3s ease;
}

.profile-bio:hover {
    background: rgba(241, 245, 249, 0.8);
    border-color: rgba(203, 213, 225, 0.6);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
}

/* ===== PROFILE STATS ===== */
.profile-stats {
    display: flex;
    gap: 2rem;
    padding-top: 1.5rem;
    margin-top: 0.5rem;
    border-top: 2px solid rgba(226, 232, 240, 0.6);
    position: relative;
}

.profile-stats::before {
    content: '';
    position: absolute;
    top: -2px;
    left: 0;
    width: 150px;
    height: 2px;
    background: var(--gradient-primary);
}

@media (max-width: 768px) {
    .profile-stats {
        justify-content: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
}

.profile-stat {
    text-align: center;
    position: relative;
    padding: 0.75rem 1.25rem;
    min-width: 120px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.profile-stat::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 16px;
    background: var(--white);
    border: 1px solid rgba(203, 213, 225, 0.4);
    z-index: -1;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
}

.profile-stat:hover {
    transform: translateY(-4px);
}

.profile-stat:hover::before {
    border-color: rgba(59, 130, 246, 0.3);
    box-shadow: 0 15px 30px -10px rgba(59, 130, 246, 0.2);
    background: linear-gradient(135deg, #ffffff, #f8fafc);
}

.stat-number {
    display: block;
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--slate-900); 
    margin-bottom: 0.25rem;
    position: relative;
}

.stat-label {
    font-size: 0.75rem;
    color: var(--slate-500);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 600;
}

/* ===== PROFILE SECTIONS GRID ===== */
.profile-sections-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.75rem;
    position: relative;
}

@media (min-width: 768px) {
    .profile-sections-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* ===== PROFILE SECTION ===== */
.profile-section {
    background: var(--white);
    border-radius: 28px;
    padding: 2rem;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(226, 232, 240, 0.6);
    position: relative;
    overflow: hidden;
    animation: slideInUp 0.5s cubic-bezier(0.23, 1, 0.32, 1) forwards;
    opacity: 0;
    backdrop-filter: blur(10px);
}

.profile-section:nth-child(1) { animation-delay: 0.2s; }
.profile-section:nth-child(2) { animation-delay: 0.3s; }

.profile-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--gradient-primary);
    opacity: 0;
    transition: opacity 0.4s ease, width 0.4s ease;
}

.profile-section:hover {
    transform: translateY(-6px) scale(1.02);
    box-shadow: var(--shadow-elevation-hover);
    border-color: rgba(59, 130, 246, 0.2);
}

.profile-section:hover::before {
    opacity: 1;
    width: 6px;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.75rem;
    padding-bottom: 1.25rem;
    border-bottom: 2px solid rgba(226, 232, 240, 0.6);
    position: relative;
}

.section-header::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 80px;
    height: 2px;
    background: var(--gradient-primary);
    transition: width 0.4s ease;
}

.profile-section:hover .section-header::after {
    width: 120px;
}

.section-icon {
    width: 2.75rem;
    height: 2.75rem;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(16, 185, 129, 0.1));
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--blue-600);
    flex-shrink: 0;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 1.125rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(59, 130, 246, 0.1);
}

.profile-section:hover .section-icon {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(16, 185, 129, 0.15));
    transform: rotate(5deg) scale(1.1);
    border-color: rgba(59, 130, 246, 0.2);
    box-shadow: 0 10px 20px -8px rgba(59, 130, 246, 0.3);
}

.section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--slate-900);
    flex: 1;
    letter-spacing: -0.01em;
}

/* ===== INFO DISPLAY ===== */
.info-display {
    margin-bottom: 1.5rem;
}

.info-display:last-child {
    margin-bottom: 0;
}

.info-label {
    display: block;
    font-size: 0.8125rem;
    font-weight: 600;
    color: var(--slate-600);
    margin-bottom: 0.5rem;
    padding-left: 0.75rem;
    position: relative;
    text-transform: uppercase;
    letter-spacing: 0.03em;
}

.info-label::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 14px;
    background: var(--gradient-primary);
    border-radius: 2px;
    box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
}

.info-value {
    display: block;
    padding: 0.875rem 1.25rem;
    background: rgba(248, 250, 252, 0.7);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(203, 213, 225, 0.4);
    border-radius: 14px;
    font-size: 0.9375rem;
    color: var(--slate-900);
    min-height: 48px;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
    line-height: 1.5;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
}

.info-value:hover {
    background: var(--white);
    border-color: rgba(59, 130, 246, 0.3);
    box-shadow: 0 8px 20px -8px rgba(59, 130, 246, 0.15);
    transform: translateY(-2px);
}

.info-value.empty {
    color: var(--slate-500);
    font-style: italic;
    background: rgba(248, 250, 252, 0.4);
}

textarea.info-value {
    min-height: 100px;
    white-space: pre-wrap;
}

/* ===== SETTINGS SECTION ===== */
.settings-section {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(16, 185, 129, 0.05));
    backdrop-filter: blur(10px);
    border-radius: 28px;
    padding: 2.5rem;
    margin-top: 2rem;
    animation: slideInUp 0.5s 0.4s cubic-bezier(0.23, 1, 0.32, 1) forwards;
    opacity: 0;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(59, 130, 246, 0.2);
    box-shadow: var(--shadow-elevation);
}

.settings-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 0% 100%, rgba(59, 130, 246, 0.1), transparent 70%);
    pointer-events: none;
}

.settings-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.75rem;
    position: relative;
    z-index: 1;
}

@media (min-width: 768px) {
    .settings-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

.setting-item {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-radius: 20px;
    padding: 1.75rem;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    position: relative;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.setting-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--gradient-primary);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.setting-item:hover {
    transform: translateY(-6px) scale(1.02);
    background: var(--white);
    border-color: rgba(59, 130, 246, 0.3);
    box-shadow: var(--shadow-elevation-hover);
}

.setting-item:hover::before {
    opacity: 1;
}

.setting-item-header {
    display: flex;
    align-items: center;
    gap: 0.875rem;
    margin-bottom: 1.25rem;
}

.setting-icon {
    width: 2.75rem;
    height: 2.75rem;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(16, 185, 129, 0.1));
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--blue-600);
    flex-shrink: 0;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 1.125rem;
    border: 1px solid rgba(59, 130, 246, 0.1);
}

.setting-item:hover .setting-icon {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(16, 185, 129, 0.15));
    transform: rotate(5deg) scale(1.1);
    border-color: rgba(59, 130, 246, 0.3);
    box-shadow: 0 10px 20px -8px rgba(59, 130, 246, 0.3);
}

.setting-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--slate-900);
    flex: 1;
}

.setting-description {
    font-size: 0.875rem;
    color: var(--slate-600);
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

/* ===== BUTTON STYLES ===== */
.btn {
    padding: 0.875rem 1.75rem;
    border-radius: 14px;
    font-size: 0.9375rem;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.625rem;
    text-decoration: none;
    position: relative;
    overflow: hidden;
    letter-spacing: 0.01em;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

.btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

.btn:hover::before {
    transform: translateX(100%);
}

.btn-primary {
    background: var(--gradient-dark);
    color: var(--white);
    box-shadow: 0 8px 20px -6px rgba(0, 0, 0, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(135deg, var(--slate-900), #0f172a);
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 15px 30px -8px rgba(0, 0, 0, 0.4);
}

.btn-primary:active {
    transform: translateY(-2px) scale(1.02);
}

.btn-outline {
    background: transparent;
    color: var(--slate-700);
    border: 2px solid rgba(203, 213, 225, 0.8);
    box-shadow: none;
}

.btn-outline:hover {
    border-color: var(--slate-900);
    background: var(--white);
    color: var(--slate-900);
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 12px 25px -8px rgba(0, 0, 0, 0.15);
}

.btn-sm {
    padding: 0.625rem 1.25rem;
    font-size: 0.8125rem;
    border-radius: 12px;
}

.btn-icon {
    width: 40px;
    height: 40px;
    padding: 0;
    border-radius: 12px;
}

/* ===== MODAL STYLES - ULTRA REFINED ===== */
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
    padding: 1.5rem;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(16px) saturate(200%);
    -webkit-backdrop-filter: blur(16px) saturate(200%);
    animation: modalFadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.modal.show {
    display: flex !important;
    opacity: 1;
}

@keyframes modalFadeIn {
    from {
        opacity: 0;
        backdrop-filter: blur(0);
    }
    to {
        opacity: 1;
        backdrop-filter: blur(16px);
    }
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
    border-radius: 32px;
    width: 100%;
    max-width: 540px;
    box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.2) inset,
                0 2px 0 rgba(255, 255, 255, 0.3) inset;
    animation: modalSlideIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    overflow: hidden;
    background: linear-gradient(145deg, #ffffff 0%, #fafcff 100%);
    transform-origin: center;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
}

@keyframes modalSlideIn {
    0% {
        opacity: 0;
        transform: translateY(-60px) scale(0.9) rotateX(-10deg);
    }
    100% {
        opacity: 1;
        transform: translateY(0) scale(1) rotateX(0);
    }
}

.modal-content::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
    background: var(--gradient-primary);
    background-size: 200% 100%;
    z-index: 1;
    animation: gradientShift 3s ease infinite;
}

@keyframes gradientShift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.modal-header {
    padding: 2.25rem 2.25rem 1.5rem;
    border-bottom: 1px solid rgba(226, 232, 240, 0.6);
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.98) 100%);
    position: relative;
    z-index: 2;
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
    background: var(--gradient-primary);
    width: 44px;
    height: 44px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    font-size: 1.25rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.modal-content:hover .modal-title i {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 12px 30px rgba(59, 130, 246, 0.4);
}

.modal-close {
    background: rgba(241, 245, 249, 0.8);
    border: none;
    border-radius: 16px;
    color: var(--slate-600);
    cursor: pointer;
    padding: 0;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 1.75rem;
    font-weight: 300;
    line-height: 1;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(203, 213, 225, 0.3);
}

.modal-close:hover {
    background: #fee2e2;
    color: #dc2626;
    transform: rotate(90deg) scale(1.1);
    border-color: rgba(220, 38, 38, 0.3);
    box-shadow: 0 8px 20px rgba(220, 38, 38, 0.15);
}

.modal-close:active {
    transform: rotate(90deg) scale(0.95);
}

.modal-body {
    padding: 2.25rem;
    max-height: calc(90vh - 200px);
    overflow-y: auto;
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

.modal-footer {
    padding: 1.5rem 2.25rem 2.25rem;
    border-top: 1px solid rgba(226, 232, 240, 0.6);
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    background: linear-gradient(180deg, rgba(248, 250, 252, 0.98) 0%, rgba(255, 255, 255, 0.98) 100%);
    position: relative;
    z-index: 2;
}

/* ===== FORM STYLES ===== */
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
    height: 16px;
    background: var(--gradient-primary);
    border-radius: 2px;
    box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
}

.modal .form-label.required::after {
    content: '*';
    color: #ef4444;
    margin-left: 0.25rem;
    font-weight: 700;
}

.modal .form-control {
    width: 100%;
    padding: 1rem 1.25rem;
    background: var(--white);
    border: 2px solid var(--slate-200);
    border-radius: 16px;
    font-size: 0.9375rem;
    color: var(--slate-900);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    outline: none;
    font-family: inherit;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
}

.modal .form-control:hover {
    border-color: var(--slate-300);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.modal .form-control:focus {
    border-color: var(--blue-500);
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15),
                0 4px 12px rgba(59, 130, 246, 0.1);
    transform: translateY(-1px);
}

.modal .form-control.is-invalid {
    border-color: #ef4444;
    background: rgba(254, 226, 226, 0.1);
}

.modal textarea.form-control {
    min-height: 100px;
    resize: vertical;
    line-height: 1.6;
}

/* ===== IMAGE UPLOAD AREA ===== */
.modal .image-upload-area {
    border: 3px dashed rgba(203, 213, 225, 0.8);
    border-radius: 24px;
    padding: 2.5rem 2rem;
    text-align: center;
    background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 100%);
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    cursor: pointer;
    margin-bottom: 1rem;
    position: relative;
    overflow: hidden;
}

.modal .image-upload-area:hover {
    border-color: var(--blue-500);
    background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
    transform: translateY(-4px) scale(1.02);
    box-shadow: 0 20px 40px -12px rgba(59, 130, 246, 0.3);
}

.modal .current-image-container {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin: 0 auto 1.5rem;
    overflow: hidden;
    border: 4px solid var(--white);
    box-shadow: 0 15px 30px -8px rgba(0, 0, 0, 0.2);
    transition: all 0.4s ease;
}

.modal .image-upload-area:hover .current-image-container {
    transform: scale(1.1);
    box-shadow: 0 20px 40px -8px rgba(59, 130, 246, 0.3);
    border-color: var(--blue-100);
}

.modal .image-placeholder {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: var(--gradient-dark);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 3rem;
    font-weight: 700;
    color: var(--white);
    border: 4px solid var(--white);
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.modal .upload-prompt i {
    font-size: 2.5rem;
    color: var(--blue-600);
    background: linear-gradient(135deg, var(--white), #eff6ff);
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid var(--blue-200);
    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.2);
    margin: 0 auto 1rem;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.modal .image-upload-area:hover .upload-prompt i {
    transform: translateY(-6px) scale(1.1);
    box-shadow: 0 15px 30px rgba(59, 130, 246, 0.3);
    color: var(--blue-700);
    border-color: var(--blue-400);
    background: linear-gradient(135deg, #eff6ff, #ffffff);
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

/* ===== DELETE ACCOUNT MODAL ===== */
#deleteAccountModal .modal-content {
    background: linear-gradient(145deg, #ffffff 0%, #fef2f2 100%);
    max-width: 480px;
}

#deleteAccountModal .modal-content::before {
    background: linear-gradient(90deg, #ef4444, #f59e0b, #ef4444);
}

#deleteAccountModal .modal-title {
    color: #b91c1c;
}

#deleteAccountModal .modal-title i {
    background: linear-gradient(135deg, #ef4444, #f59e0b);
    box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
}

#deleteAccountModal .warning-highlight {
    background: linear-gradient(135deg, #fee2e2 0%, #fff5f5 100%);
    border: 1px solid rgba(239, 68, 68, 0.2);
    border-radius: 20px;
    padding: 1.5rem;
    margin: 1.5rem 0;
    border-left: 6px solid #ef4444;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    box-shadow: 0 10px 25px -8px rgba(239, 68, 68, 0.2);
}

#deleteAccountModal .warning-highlight i {
    color: #ef4444;
    font-size: 1.5rem;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

/* ===== RESPONSIVE STYLES ===== */
@media (max-width: 768px) {
    .main-content {
        padding: 1.5rem 1rem 3rem;
    }

    .profile-header,
    .profile-section,
    .settings-section {
        padding: 1.5rem;
    }

    .profile-name {
        font-size: 1.5rem;
    }

    .profile-name::after {
        width: 60px;
    }

    .profile-email {
        padding: 0.375rem 1rem;
        font-size: 0.875rem;
    }

    .profile-bio {
        padding: 1rem;
        font-size: 0.875rem;
    }

    .stat-number {
        font-size: 1.5rem;
    }

    .modal {
        padding: 1rem;
        backdrop-filter: blur(10px);
    }

    .modal-content {
        border-radius: 24px;
        max-height: 95vh;
    }

    .modal-header {
        padding: 1.5rem 1.5rem 1.25rem;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-footer {
        padding: 1.25rem 1.5rem 1.5rem;
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
        font-size: 1.5rem;
    }

    .modal .current-image-container,
    .modal .image-placeholder {
        width: 100px;
        height: 100px;
    }

    .modal .image-placeholder {
        font-size: 2.5rem;
    }

    .modal .upload-prompt i {
        width: 64px;
        height: 64px;
        font-size: 2rem;
    }

    .settings-grid {
        gap: 1.25rem;
    }

    .setting-item {
        padding: 1.25rem;
    }

    .btn {
        padding: 0.75rem 1.5rem;
    }
}

@media (max-width: 480px) {
    .profile-stats {
        gap: 0.5rem;
    }

    .profile-stat {
        min-width: 100px;
        padding: 0.5rem;
    }

    .stat-number {
        font-size: 1.25rem;
    }

    .stat-label {
        font-size: 0.7rem;
    }

    .profile-header-actions {
        position: relative;
        top: auto;
        right: auto;
        justify-content: center;
        margin-top: 1rem;
    }

    .modal-footer {
        flex-direction: column-reverse;
    }

    .modal-footer .btn {
        width: 100%;
    }

    .modal .image-upload-area {
        padding: 1.5rem;
    }

    .section-header {
        gap: 0.75rem;
    }

    .section-icon {
        width: 2.25rem;
        height: 2.25rem;
        font-size: 1rem;
    }

    .section-title {
        font-size: 1.125rem;
    }
}

/* ===== LOADING STATES ===== */
.btn.loading {
    position: relative;
    color: transparent !important;
    pointer-events: none;
}

.btn.loading::after {
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

/* ===== CUSTOM TOAST ===== */
.custom-toast {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 1rem 1.5rem;
    border-radius: 16px;
    background: var(--white);
    box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.3);
    z-index: 9999;
    transform: translateX(120%);
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    max-width: 350px;
    border-left: 6px solid transparent;
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.95);
}

.custom-toast.show {
    transform: translateX(0);
}

.toast-success {
    border-left-color: #10b981;
    color: #065f46;
}

.toast-error {
    border-left-color: #ef4444;
    color: #b91c1c;
}

.toast-info {
    border-left-color: #3b82f6;
    color: #1e40af;
}

.toast-content {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.toast-content i {
    font-size: 1.25rem;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
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