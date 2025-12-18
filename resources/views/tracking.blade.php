<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Tracking - {{ config('app.name', 'Zeb Tailors & Fabrics') }}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/ZEB-TAILORS-Icon.png') }}">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">

    <style>
        /* ===================================
           ZEB TAILORS ORDER TRACKING STYLES
           All classes prefixed with zebtrack-
           =================================== */

        :root {
            --zebtrack-gold: #C28A23;
            --zebtrack-dark-bg: #0a0a0a;
            --zebtrack-card-bg: #1a1a1a;
            --zebtrack-border: #2a2a2a;
            --zebtrack-text-primary: #ffffff;
            --zebtrack-text-secondary: #a0a0a0;
            --zebtrack-success: #22c55e;
            --zebtrack-warning: #f59e0b;
            --zebtrack-info: #3b82f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .zebtrack-body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, var(--zebtrack-dark-bg) 0%, #1a1410 100%);
            color: var(--zebtrack-text-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .zebtrack-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Logo Section */
        .zebtrack-logo-section {
            text-align: center;
            margin-bottom: 48px;
            animation: zebtrack-fade-in 0.6s ease-out;
        }

        .zebtrack-logo {
            max-width: 180px;
            height: auto;
            filter: drop-shadow(0 4px 12px rgba(194, 138, 35, 0.3));
            transition: transform 0.3s ease;
        }

        .zebtrack-logo:hover {
            transform: scale(1.05);
        }

        /* Header Section */
        .zebtrack-header {
            text-align: center;
            margin-bottom: 40px;
            animation: zebtrack-fade-in 0.8s ease-out;
        }

        .zebtrack-heading {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--zebtrack-gold);
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .zebtrack-subtitle {
            font-size: 1rem;
            color: var(--zebtrack-text-secondary);
            font-weight: 400;
            letter-spacing: 0.2px;
        }

        /* Search Section */
        .zebtrack-search-section {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 32px;
            animation: zebtrack-fade-in 1s ease-out;
        }

        .zebtrack-input-wrapper {
            width: 100%;
        }

        .zebtrack-input {
            width: 100%;
            padding: 18px 24px;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            background: var(--zebtrack-card-bg);
            border: 2px solid var(--zebtrack-border);
            border-radius: 16px;
            color: var(--zebtrack-text-primary);
            transition: all 0.3s ease;
            outline: none;
        }

        .zebtrack-input::placeholder {
            color: var(--zebtrack-text-secondary);
        }

        .zebtrack-input:focus {
            border-color: var(--zebtrack-gold);
            box-shadow: 0 0 0 4px rgba(194, 138, 35, 0.1);
        }

        .zebtrack-input:hover {
            border-color: rgba(194, 138, 35, 0.5);
        }

        .zebtrack-button {
            width: 100%;
            padding: 18px 24px;
            font-size: 1.1rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--zebtrack-gold) 0%, #d4a043 100%);
            color: var(--zebtrack-dark-bg);
            border: none;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 16px rgba(194, 138, 35, 0.3);
        }

        .zebtrack-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(194, 138, 35, 0.4);
        }

        .zebtrack-button:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(194, 138, 35, 0.3);
        }

        .zebtrack-button-text {
            letter-spacing: 0.5px;
        }

        .zebtrack-button-icon {
            transition: transform 0.3s ease;
        }

        .zebtrack-button:hover .zebtrack-button-icon {
            transform: scale(1.1);
        }

        /* Results Container */
        .zebtrack-results-container {
            background: var(--zebtrack-card-bg);
            border: 2px solid var(--zebtrack-border);
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            animation: zebtrack-slide-up 0.5s ease-out;
        }

        .zebtrack-hidden {
            display: none;
        }

        .zebtrack-results-header {
            margin-bottom: 24px;
            display: flex;
            justify-content: flex-end;
        }

        .zebtrack-status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 24px;
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        .zebtrack-status-in-progress {
            background: rgba(251, 146, 60, 0.15);
            color: var(--zebtrack-warning);
            border: 1px solid rgba(251, 146, 60, 0.3);
        }

        .zebtrack-status-ready {
            background: rgba(34, 197, 94, 0.15);
            color: var(--zebtrack-success);
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .zebtrack-status-pending {
            background: rgba(59, 130, 246, 0.15);
            color: var(--zebtrack-info);
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        /* Results Content */
        .zebtrack-results-content {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .zebtrack-detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--zebtrack-border);
        }

        .zebtrack-detail-row:last-of-type {
            border-bottom: none;
        }

        .zebtrack-detail-label {
            font-size: clamp(12px, 1vw, 16px);
            color: var(--zebtrack-text-secondary);
            font-weight: 500;
        }

        .zebtrack-detail-value {
            font-size: clamp(12px, 1.2vw, 1.25rem);
            color: var(--zebtrack-text-primary);
            font-weight: 600;
        }

        /* Progress Section */
        .zebtrack-progress-section {
            margin-top: 12px;
            padding-top: 24px;
            border-top: 2px solid var(--zebtrack-border);
        }

        .zebtrack-progress-label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .zebtrack-progress-label {
            font-size: 0.875rem;
            color: var(--zebtrack-text-secondary);
            font-weight: 500;
        }

        .zebtrack-progress-percent {
            font-size: 1.25rem;
            color: var(--zebtrack-gold);
            font-weight: 700;
        }

        .zebtrack-progress-bar {
            width: 100%;
            height: 12px;
            background: var(--zebtrack-border);
            border-radius: 24px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .zebtrack-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--zebtrack-gold) 0%, #d4a043 100%);
            border-radius: 24px;
            transition: width 0.8s ease;
            box-shadow: 0 0 12px rgba(194, 138, 35, 0.5);
        }

        .zebtrack-progress-stages {
            display: flex;
            justify-content: space-between;
            gap: 8px;
            flex-wrap: wrap;
        }

        .zebtrack-stage {
            font-size: 0.75rem;
            padding: 6px 12px;
            border-radius: 8px;
            background: var(--zebtrack-border);
            color: var(--zebtrack-text-secondary);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .zebtrack-stage-complete {
            background: rgba(34, 197, 94, 0.15);
            color: var(--zebtrack-success);
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .zebtrack-stage-active {
            background: rgba(194, 138, 35, 0.15);
            color: var(--zebtrack-gold);
            border: 1px solid var(--zebtrack-gold);
            font-weight: 600;
        }

        /* Animations */
        @keyframes zebtrack-fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes zebtrack-slide-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 640px) {
            .zebtrack-heading {
                font-size: 2rem;
            }

            .zebtrack-subtitle {
                font-size: 0.9rem;
            }

            .zebtrack-results-container {
                padding: 24px;
            }

            .zebtrack-logo {
                max-width: 140px;
            }

            .zebtrack-progress-stages {
                gap: 6px;
            }

            .zebtrack-stage {
                font-size: 0.7rem;
                padding: 5px 10px;
            }

            /* .zebtrack-detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 6px;
            } */

            .zebtrack-input,
            .zebtrack-button {
                padding: 16px 20px;
            }
        }

        @media (max-width: 400px) {
            .zebtrack-heading {
                font-size: 1.75rem;
            }

            .zebtrack-results-container {
                padding: 20px;
            }

            .zebtrack-logo {
                max-width: 120px;
            }
        }

        /* Branded radio buttons (replace default select look) */
        .zebtrack-radio-group {
            gap: 12px;
        }

        .zebtrack-radio {
            flex:1;
            display: inline-flex;
            align-items: center;
        }

        .zebtrack-radio input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .zebtrack-radio-label {
            width: 100%;
            display:flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 12px;
            background: var(--zebtrack-card-bg);
            border: 2px solid var(--zebtrack-border);
            color: var(--zebtrack-text-secondary);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.18s ease;
            font-size: clamp(10px, 1vw, 1rem);
        }

        .zebtrack-radio-label:hover {
            border-color: rgba(194, 138, 35, 0.5);
            color: var(--zebtrack-text-primary);
            box-shadow: 0 6px 18px rgba(0,0,0,0.4);
        }

        .zebtrack-radio input[type="radio"]:checked + .zebtrack-radio-label {
            background: linear-gradient(135deg, var(--zebtrack-gold) 0%, #d4a043 100%);
            color: var(--zebtrack-dark-bg);
            border-color: var(--zebtrack-gold);
            box-shadow: 0 10px 30px rgba(194, 138, 35, 0.25);
            transform: translateY(-2px);
        }

        .zebtrack-radio input[type="radio"]:focus + .zebtrack-radio-label {
            outline: 3px solid rgba(194,138,35,0.12);
            /* outline-offset: 2px; */
        }

        /* Button spinner */
        .zebtrack-button-spinner {
            display: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 3px solid rgba(194,138,35,0.9);
            border-top-color: var(--zebtrack-dark-bg);
            box-sizing: border-box;
            margin-left: 8px;
            vertical-align: middle;
            animation: zebtrack-spin 0.9s linear infinite;
        }

        @keyframes zebtrack-spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .zebtrack-button.loading {
            cursor: default;
            opacity: 0.98;
        }

        .zebtrack-button.loading .zebtrack-button-text { opacity: 0; display: none; }
        .zebtrack-button.loading .zebtrack-button-icon { display: none; }

        /* Show spinner only when parent button is loading */
        .zebtrack-button.loading .zebtrack-button-spinner { display: inline-block; }
    </style>
</head>

<body class="zebtrack-body">
    <div class="zebtrack-container">
        <!-- Logo Section -->
        <div class="zebtrack-logo-section">
            <img src="{{ asset('assets/images/ZEB-TAILORS-FABRICS-logo.png') }}" class="zebtrack-logo" alt="Zeb Tailors & Fabrics">
        </div>

        <!-- Header Section -->
        <div class="zebtrack-header">
            <h1 class="zebtrack-heading">Track Your Order</h1>
            <p class="zebtrack-subtitle">Enter your phone/order number to check your order status</p>
        </div>

        <!-- Input Section -->
        <div class="zebtrack-search-section">
                <div class="zebtrack-input-wrapper" style="margin-bottom: 8px;">
                <div class="zebtrack-radio-group" style="display:flex; gap:12px; align-items:center; margin-bottom:8px;">
                    
                    <label class="zebtrack-radio">
                        <input type="radio" name="zebtrackType" value="order" checked>
                        <span class="zebtrack-radio-label">Track by Order Number</span>
                    </label>
                    <label class="zebtrack-radio">
                        <input type="radio" name="zebtrackType" value="phone" >
                        <span class="zebtrack-radio-label">Track by Phone Number</span>
                    </label>
                </div>
                <input type="tel" id="zebtrackPhoneInput" class="zebtrack-input" placeholder="03XX XXXXXXX" maxlength="11" autocomplete="off" style="display: none;">
                <input type="text" id="zebtrackOrderInput" class="zebtrack-input" placeholder="Order Number (e.g. SEW-000123)" autocomplete="off">
            </div>
            <button id="zebtrackSearchBtn" class="zebtrack-button" aria-busy="false" aria-live="polite">
                <span class="zebtrack-button-text">Track Order</span>
                <span id="zebtrackSpinner" class="zebtrack-button-spinner zebtrack-hidden" aria-hidden="true"></span>
                <svg class="zebtrack-button-icon" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path
                        d="M19 19L14.65 14.65M17 9C17 13.4183 13.4183 17 9 17C4.58172 17 1 13.4183 1 9C1 4.58172 4.58172 1 9 1C13.4183 1 17 4.58172 17 9Z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>
        </div>

        <!-- Results Section (Hidden by default) -->
        <div id="zebtrackResults" class="zebtrack-results-container zebtrack-hidden">
            <div class="zebtrack-results-header">
                <span id="zebtrackStatusBadge" class="zebtrack-status-badge zebtrack-status-in-progress">In
                    Progress</span>
            </div>

            <div class="zebtrack-results-content">
                <div class="zebtrack-detail-row">
                    <span class="zebtrack-detail-label">Order Number</span>
                    <span id="zebtrackOrderNumber" class="zebtrack-detail-value">#ZEB-2024-1234</span>
                </div>

                <div class="zebtrack-detail-row">
                    <span class="zebtrack-detail-label">Customer Name</span>
                    <span id="zebtrackCustomerName" class="zebtrack-detail-value">Muhammad Ahmed</span>
                </div>

                <div class="zebtrack-detail-row">
                    <span class="zebtrack-detail-label">Item Type</span>
                    <span id="zebtrackItemType" class="zebtrack-detail-value text-capitalize" style="text-transform: capitalize">Three Piece Suit</span>
                </div>

                <div class="zebtrack-detail-row">
                    <span class="zebtrack-detail-label">Delivery Date</span>
                    <span id="zebtrackDueDate" class="zebtrack-detail-value">December 15, 2025</span>
                </div>

                <!-- Progress Bar -->
                <div class="zebtrack-progress-section">
                    <div class="zebtrack-progress-label-row">
                        <span class="zebtrack-progress-label">Order Progress</span>
                        <span id="zebtrackProgressPercent" class="zebtrack-progress-percent">65%</span>
                    </div>
                    <div class="zebtrack-progress-bar">
                        <div id="zebtrackProgressFill" class="zebtrack-progress-fill" style="width: 65%;"></div>
                    </div>
                    <div class="zebtrack-progress-stages">
                        <span class="zebtrack-stage zebtrack-stage-complete">Measurement</span>
                        <span class="zebtrack-stage zebtrack-stage-complete">Cutting</span>
                        <span class="zebtrack-stage zebtrack-stage-active">Stitching</span>
                        <span class="zebtrack-stage">Finishing</span>
                        <span class="zebtrack-stage">Ready</span>
                    </div>
                </div>
            </div>
        </div>


        <footer class="zebtrack-footer" style=" margin-top: 32px; padding: 28px 0 8px 0; text-align: center; color: var(--zebtrack-text-secondary, #a0a0a0); font-size: 14px;">
            <div style="margin-bottom: 4px;">
                &copy; {{ date('Y') }}
                <span style="color: var(--zebtrack-gold, #C28A23); font-weight: 600; font-family: 'Playfair Display', serif;">
                    Zeb Tailors &amp; Fabrics
                </span>
            </div>
            <div style="font-size: 12px;">
                Made with
                <svg width="16" height="14" viewBox="0 0 16 14" fill="none" style="vertical-align: middle; margin: 0 2px -2px 2px;" xmlns="http://www.w3.org/2000/svg">
                  <path d="M8 13s5.3-4.006 7.326-6.254A4.08 4.08 0 0 0 8 2.07 4.08 4.08 0 0 0 .674 6.746C2.7 8.994 8 13 8 13z" fill="#EF4444"/>
                </svg>
                by
                <a href="https://webspires.com.pk/?utm_source=zeb"
                   style="color: var(--zebtrack-gold, #C28A23); text-decoration: none; font-weight: 600;"
                   target="_blank" rel="noopener">
                   Webspires.com.pk
                </a>
            </div>
        </footer>
    </div>

    

    <script>
        /**
         * ZEB TAILORS ORDER TRACKING
         * Minimal JavaScript with zebtrack- namespace
         */

        (function () {
            'use strict';

            // DOM Elements
            const zebtrackTypeRadios = document.querySelectorAll('input[name="zebtrackType"]');
            const zebtrackPhoneInput = document.getElementById('zebtrackPhoneInput');
            const zebtrackOrderInput = document.getElementById('zebtrackOrderInput');
            const zebtrackSearchBtn = document.getElementById('zebtrackSearchBtn');
            const zebtrackResults = document.getElementById('zebtrackResults');

            // --- FETCH REAL DATA FROM API ---
            // Remove dummy data usage, use fetch below.

            // Helper to get selected type from radios
            function getSelectedType() {
                const checked = Array.from(zebtrackTypeRadios).find(r => r.checked);
                return checked ? checked.value : 'order';
            }

            // Event Listeners for radio change
            zebtrackTypeRadios.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (getSelectedType() === 'phone') {
                        zebtrackPhoneInput.style.display = '';
                        zebtrackOrderInput.style.display = 'none';
                        zebtrackOrderInput.value = '';
                        zebtrackPhoneInput.focus();
                    } else {
                        zebtrackPhoneInput.style.display = 'none';
                        zebtrackOrderInput.style.display = '';
                        zebtrackPhoneInput.value = '';
                        zebtrackOrderInput.focus();
                    }
                });
            });

            // Ensure inputs match selected radio on initial load (avoid flicker)
            (function initVisibility() {
                if (getSelectedType() === 'phone') {
                    zebtrackPhoneInput.style.display = '';
                    zebtrackOrderInput.style.display = 'none';
                } else {
                    zebtrackPhoneInput.style.display = 'none';
                    zebtrackOrderInput.style.display = '';
                }
            })();

            function setLoading(on) {
                if (!zebtrackSearchBtn) return;
                if (on) {
                    zebtrackSearchBtn.classList.add('loading');
                    zebtrackSearchBtn.disabled = true;
                    zebtrackSearchBtn.setAttribute('aria-busy','true');
                } else {
                    zebtrackSearchBtn.classList.remove('loading');
                    zebtrackSearchBtn.disabled = false;
                    zebtrackSearchBtn.setAttribute('aria-busy','false');
                }
            }

            if (zebtrackSearchBtn) {
                zebtrackSearchBtn.addEventListener('click', zebtrackHandleSearch);
            }

            if (zebtrackPhoneInput) {
                zebtrackPhoneInput.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter' && getSelectedType() === 'phone') {
                        zebtrackHandleSearch();
                    }
                });
                zebtrackPhoneInput.addEventListener('input', function (e) {
                    // Remove non-numeric characters
                    let value = e.target.value.replace(/\D/g, '');
                    e.target.value = value;
                });
            }

            if (zebtrackOrderInput) {
                zebtrackOrderInput.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter' && getSelectedType() === 'order') {
                        zebtrackHandleSearch();
                    }
                });
            }

            /**
             * Handle search button click
             */
            function zebtrackHandleSearch() {
                

                let type = getSelectedType();
                let apiUrl;
                if (type === 'phone') {
                    const phoneNumber = zebtrackPhoneInput.value.trim();
                    if (!phoneNumber) {
                        alert('Please enter your phone number');
                        zebtrackPhoneInput.focus();
                        return;
                    }
                    if (phoneNumber.length < 11) {
                        alert('Please enter a valid 11-digit phone number');
                        zebtrackPhoneInput.focus();
                        return;
                    }
                    apiUrl = `/api/track-sewing-order?phone=${encodeURIComponent(phoneNumber)}`;
                } else if (type === 'order') {
                    const orderNumber = zebtrackOrderInput.value.trim();
                    if (!orderNumber) {
                        alert('Please enter your order number');
                        zebtrackOrderInput.focus();
                        return;
                    }
                    apiUrl = `/api/track-sewing-order?sewing_order_number=${encodeURIComponent(orderNumber)}`;
                } else {
                    alert('Please select a tracking type');
                    return;
                }

                setLoading(true);
                fetch(apiUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success || !data.order) {
                            alert(data.message || 'Order not found.');
                            return;
                        }
                        zebtrackDisplayApiResults(data.order);
                    })
                    .catch(() => {
                        alert('Failed to fetch order. Please try again.');
                    })
                    .finally(() => {
                        setLoading(false);
                    });
            }

            /**
             * Display API order results
             * @param {object} order - Response order object from API
             */
            function zebtrackDisplayApiResults(order) {
                document.getElementById('zebtrackOrderNumber').textContent = order.sewing_order_number;
                document.getElementById('zebtrackCustomerName').textContent = order.customer_name;
                document.getElementById('zebtrackDueDate').textContent = order.delivery_date;
                // For multiple items, display first item (or customize as needed)
                let item = order.items[0] || {};
                document.getElementById('zebtrackItemType').textContent = item.name || '-';
                // Progress and stages for first item (customize for item selector if you want)
                document.getElementById('zebtrackProgressPercent').textContent = item.progress_percent + '%';
                document.getElementById('zebtrackProgressFill').style.width = item.progress_percent + '%';

                // Update status badge for order
                const statusBadge = document.getElementById('zebtrackStatusBadge');
                statusBadge.className = 'zebtrack-status-badge';

                let status = (order.order_status || '').toLowerCase();
                // You can map more statuses as needed
                if (status == 'in progress') {
                    statusBadge.classList.add('zebtrack-status-in-progress');
                    statusBadge.textContent = order.statusBadge;
                } else if (status == 'delivered') {
                    statusBadge.classList.add('zebtrack-status-ready');
                    statusBadge.textContent = order.statusBadge;
                } else if (status == 'completed') {
                    statusBadge.classList.add('zebtrack-status-ready');
                    statusBadge.textContent = order.statusBadge;
                } else {
                    statusBadge.classList.add('zebtrack-status-pending');
                    statusBadge.textContent = order.statusBadge;
                }

                // Progress stages (customize as per your item workflow and design)
                const stageLabels = ['Pending', 'In Progress', 'Completed', 'Delivered'];
                const stagesContainer = document.querySelector('.zebtrack-progress-stages');
                if (stagesContainer && item.status) {
                    stagesContainer.innerHTML = '';
                    let statusIndex = stageLabels.map(x=>x.toLowerCase()).indexOf((item.status || '').toLowerCase());
                    stageLabels.forEach((stage, idx) => {
                        const stageEl = document.createElement('span');
                        stageEl.classList.add('zebtrack-stage');
                        if (idx < statusIndex) {
                            stageEl.classList.add('zebtrack-stage-complete');
                        } else if (idx === statusIndex) {
                            // If statusIndex is the last stage, mark as complete instead of active
                            if (idx === stageLabels.length - 1) {
                                stageEl.classList.add('zebtrack-stage-complete');
                            } else {
                                stageEl.classList.add('zebtrack-stage-active');
                            }
                        }
                        stageEl.textContent = stage;
                        stagesContainer.appendChild(stageEl);
                    });
                }

                // Show results container
                zebtrackResults.classList.remove('zebtrack-hidden');

                setTimeout(() => {
                    zebtrackResults.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }, 100);
            }

        })();
    </script>
</body>

</html>