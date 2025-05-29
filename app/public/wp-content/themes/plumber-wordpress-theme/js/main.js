jQuery(document).ready(function($) {
    'use strict';
    
    // Scroll Progress Indicator
    function updateScrollProgress() {
        const scrollTop = $(window).scrollTop();
        const docHeight = $(document).height() - $(window).height();
        const scrollPercent = (scrollTop / docHeight) * 100;
        $('.scroll-progress').css('width', scrollPercent + '%');
    }
    
    // Create scroll progress bar
    $('body').prepend('<div class="scroll-progress"></div>');
    
    // Scroll-triggered animations
    function checkScroll() {
        $('.animate-on-scroll').each(function() {
            const elementTop = $(this).offset().top;
            const elementBottom = elementTop + $(this).outerHeight();
            const viewportTop = $(window).scrollTop();
            const viewportBottom = viewportTop + $(window).height();
            
            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('animated');
            }
        });
    }
    
    // Initialize animations on elements
    function initAnimations() {
        // Services section
        $('.service-card').addClass('animate-on-scroll animate-fadeInUp');
        $('.service-card:nth-child(odd)').removeClass('animate-fadeInUp').addClass('animate-fadeInLeft');
        $('.service-card:nth-child(even)').removeClass('animate-fadeInUp').addClass('animate-fadeInRight');
        
        // About section
        $('.about-text h2').addClass('animate-on-scroll');
        $('.about-text p').addClass('animate-on-scroll animate-fadeInLeft');
        $('.about-image').addClass('animate-on-scroll animate-fadeInRight');
        
        // Contact section
        $('.contact-info').addClass('animate-on-scroll animate-fadeInLeft');
        $('.contact-form').addClass('animate-on-scroll animate-fadeInRight');
        
        // Footer section
        $('.footer-section').addClass('animate-on-scroll animate-fadeInUp');
        $('.footer-logo').removeClass('animate-fadeInUp').addClass('animate-scale');
        $('.footer-hours').addClass('animate-fadeInLeft');
        $('.footer-contact').addClass('animate-fadeInRight');
        $('.footer-bottom').addClass('animate-on-scroll animate-fadeInUp');
        
        // Section dividers
        $('<div class="section-divider animate-on-scroll"></div>').insertAfter('.services');
        $('<div class="section-divider animate-on-scroll"></div>').insertAfter('.about');
    }
    
    // Smooth scrolling for anchor links
    function initSmoothScroll() {
        $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80
                    }, 1000);
                    return false;
                }
            }
        });
    }
    
    // Enhanced button interactions
    function initButtonEffects() {
        $('.btn, .form-submit').on('mouseenter', function() {
            $(this).addClass('loading');
            setTimeout(() => {
                $(this).removeClass('loading');
            }, 800);
        });
        
        // Form submission loading effect
        $('form').on('submit', function() {
            $(this).find('.form-submit').text('Sending...').addClass('loading');
        });
    }
    
    // Parallax effect for hero section
    function initParallax() {
        $(window).scroll(function() {
            const scrolled = $(window).scrollTop();
            const parallax = $('.hero');
            const speed = scrolled * 0.5;
            
            parallax.css('background-position', 'center ' + speed + 'px');
        });
    }
    
    // Animate feature list items on scroll
    function animateFeatureList() {
        const observerOptions = {
            threshold: 0.3,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const listItems = entry.target.querySelectorAll('li');
                    listItems.forEach((item, index) => {
                        setTimeout(() => {
                            item.classList.add('animated');
                        }, index * 100);
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        const aboutList = document.querySelector('.about-text ul');
        if (aboutList) {
            observer.observe(aboutList);
        }
    }
    
    // Service card stagger animation
    function staggerServiceCards() {
        const serviceCards = $('.service-card');
        let delay = 0;
        
        serviceCards.each(function(index) {
            $(this).css('animation-delay', delay + 's');
            delay += 0.2;
        });
    }
    
    // Loading screen with animation
    function initLoadingScreen() {
        const driftwellLogo = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 686.09 382.5" style="max-width: 400px; max-height: 200px; width: 100%; height: auto;">
  <defs>
    <style>
      .logo-cls-1, .logo-cls-2 { fill: #5ac0a6; }
      .logo-cls-3 { font-size: 36.76px; letter-spacing: .08em; }
      .logo-cls-3, .logo-cls-4, .logo-cls-5, .logo-cls-6, .logo-cls-7, .logo-cls-8, .logo-cls-9, .logo-cls-10, .logo-cls-11, .logo-cls-12 { fill: #fff; }
      .logo-cls-3, .logo-cls-13 { font-family: Avenir-Black, Avenir; font-weight: 800; }
      .logo-cls-5, .logo-cls-2, .logo-cls-14, .logo-cls-15 { letter-spacing: .1em; }
      .logo-cls-6 { letter-spacing: .1em; }
      .logo-cls-7 { letter-spacing: .1em; }
      .logo-cls-8 { letter-spacing: .05em; }
      .logo-cls-9 { letter-spacing: .03em; }
      .logo-cls-10 { letter-spacing: 0em; }
      .logo-cls-11 { letter-spacing: 0em; }
      .logo-cls-12 { letter-spacing: 0em; }
      .logo-cls-13 { font-size: 20px; }
      .logo-cls-16 { fill: none; stroke: #fff; stroke-miterlimit: 10; stroke-width: 2px; }
      .logo-cls-15 { fill: #231f20; }
    </style>
  </defs>
  <text class="logo-cls-13" transform="translate(0 373.36)"><tspan class="logo-cls-5" x="0" y="0">PLUMBING </tspan><tspan class="logo-cls-2" x="131.7" y="0">///</tspan><tspan class="logo-cls-15" x="162.12" y="0"> </tspan><tspan class="logo-cls-5" x="170.04" y="0">RENO</tspan><tspan class="logo-cls-8" x="236.54" y="0">V</tspan><tspan class="logo-cls-11" x="251.52" y="0">A</tspan><tspan class="logo-cls-6" x="266.5" y="0">TIONS</tspan><tspan class="logo-cls-14" x="338.32" y="0" xml:space="preserve">  </tspan><tspan class="logo-cls-2" x="354.16" y="0">/// </tspan><tspan class="logo-cls-5" x="392.5" y="0">INS</tspan><tspan class="logo-cls-12" x="432.19" y="0">T</tspan><tspan class="logo-cls-7" x="443.83" y="0">ALL</tspan><tspan class="logo-cls-10" x="486.13" y="0">A</tspan><tspan class="logo-cls-5" x="501.11" y="0">TION</tspan><tspan class="logo-cls-14" x="559.45" y="0"> </tspan><tspan class="logo-cls-2" x="567.37" y="0">///</tspan><tspan class="logo-cls-14" x="597.79" y="0"> </tspan><tspan class="logo-cls-5" x="605.71" y="0">RE</tspan><tspan class="logo-cls-9" x="635.27" y="0">P</tspan><tspan class="logo-cls-7" x="648.39" y="0">AIR</tspan></text>
  <text class="logo-cls-3" transform="translate(68.95 295.1)"><tspan x="0" y="0">DRIFTWELL CONTRACTING</tspan></text>
  <g>
    <path class="logo-cls-4" d="M407.95,157.49c5.11,14.21-8.88,18.21-8.88,18.21l-26.38.53,8.9,9.9h114.7c14.99-5.06,8.06-20,8.06-20l-84.53-104.34h-90.39l78.53,95.7Z"/>
    <path class="logo-cls-4" d="M522.44,157.49c5.11,14.21-8.88,18.21-8.88,18.21l-26.38.53,8.9,9.9h114.7c14.99-5.06,8.06-20,8.06-20l-84.53-104.34h-90.39l78.53,95.7Z"/>
    <path class="logo-cls-4" d="M163.65,90.43c-5.11-14.21,8.88-18.21,8.88-18.21l26.38-.53-8.9-9.9h-114.7c-14.99,5.06-8.06,20-8.06,20l84.53,104.34h90.39l-78.53-95.7Z"/>
    <polygon class="logo-cls-1" points="135.69 0 226.86 .04 421.07 232.69 329.94 232.69 135.69 0"/>
  </g>
  <line class="logo-cls-16" x1=".32" y1="331.45" x2="685.78" y2="331.45"/>
</svg>`;
        
        $('body').append(`
            <div class="loading-screen" style="
                position: fixed; 
                top: 0; 
                left: 0; 
                width: 100%; 
                height: 100%; 
                background: linear-gradient(135deg, #29d1d1 0%, #1a9999 100%); 
                display: flex; 
                flex-direction: column;
                align-items: center; 
                justify-content: center; 
                z-index: 99999;
                transition: opacity 0.5s ease;
            ">
                <div style="
                    text-align: center;
                    animation: pulse 2s infinite;
                    margin-bottom: 50px;
                ">
                    <div style="
                        max-width: 400px; 
                        margin-bottom: 30px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    ">
                        ${driftwellLogo}
                    </div>
                    <div style="
                        color: white; 
                        font-size: 1.2rem; 
                        font-weight: 500;
                        opacity: 0.9;
                        font-family: 'Inter', Arial, sans-serif;
                        margin-bottom: 10px;
                    ">Loading...</div>
                    <div id="loading-percentage" style="
                        color: white; 
                        font-size: 0.9rem; 
                        opacity: 0.7;
                        font-family: 'Inter', Arial, sans-serif;
                    ">0%</div>
                </div>
                
                <!-- Plumber-themed progress bar -->
                <div class="pipe-container" style="
                    width: 350px;
                    height: 40px;
                    position: relative;
                    margin-top: 20px;
                ">
                    <!-- Main pipe -->
                    <div class="pipe" style="
                        width: 100%;
                        height: 30px;
                        background: linear-gradient(to bottom, #444, #666, #444);
                        border-radius: 15px;
                        position: relative;
                        border: 3px solid #333;
                        overflow: hidden;
                        box-shadow: inset 0 3px 10px rgba(0,0,0,0.5), 0 2px 10px rgba(0,0,0,0.3);
                    ">
                        <!-- Water flow -->
                        <div id="water-flow" style="
                            height: 100%;
                            width: 0%;
                            background: linear-gradient(90deg, 
                                #29d1d1 0%, 
                                #4ee1e1 25%, 
                                #29d1d1 50%, 
                                #4ee1e1 75%, 
                                #29d1d1 100%
                            );
                            background-size: 40px 100%;
                            animation: waterFlow 1s linear infinite;
                            border-radius: 12px;
                            transition: width 0.3s ease;
                            position: relative;
                            overflow: hidden;
                        "></div>
                        
                        <!-- Water bubbles -->
                        <div class="bubbles" style="
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            pointer-events: none;
                        ">
                            <div class="bubble" style="
                                position: absolute;
                                width: 6px;
                                height: 6px;
                                background: rgba(255,255,255,0.4);
                                border-radius: 50%;
                                top: 8px;
                                left: 20%;
                                animation: bubble1 2s ease-in-out infinite;
                            "></div>
                            <div class="bubble" style="
                                position: absolute;
                                width: 4px;
                                height: 4px;
                                background: rgba(255,255,255,0.3);
                                border-radius: 50%;
                                top: 12px;
                                left: 60%;
                                animation: bubble2 1.8s ease-in-out infinite 0.5s;
                            "></div>
                            <div class="bubble" style="
                                position: absolute;
                                width: 5px;
                                height: 5px;
                                background: rgba(255,255,255,0.4);
                                border-radius: 50%;
                                top: 6px;
                                left: 80%;
                                animation: bubble3 2.2s ease-in-out infinite 1s;
                            "></div>
                        </div>
                    </div>
                    
                    <!-- Pipe fittings -->
                    <div class="pipe-fitting-left" style="
                        position: absolute;
                        left: -8px;
                        top: 50%;
                        transform: translateY(-50%);
                        width: 16px;
                        height: 36px;
                        background: linear-gradient(to right, #333, #555, #333);
                        border-radius: 8px;
                        border: 2px solid #222;
                    "></div>
                    <div class="pipe-fitting-right" style="
                        position: absolute;
                        right: -8px;
                        top: 50%;
                        transform: translateY(-50%);
                        width: 16px;
                        height: 36px;
                        background: linear-gradient(to left, #333, #555, #333);
                        border-radius: 8px;
                        border: 2px solid #222;
                    "></div>
                </div>
            </div>
            
            <style>
                @keyframes waterFlow {
                    0% { background-position: 0 0; }
                    100% { background-position: 40px 0; }
                }
                
                @keyframes bubble1 {
                    0%, 100% { transform: translateY(0) scale(1); opacity: 0.4; }
                    50% { transform: translateY(-3px) scale(1.2); opacity: 0.7; }
                }
                
                @keyframes bubble2 {
                    0%, 100% { transform: translateY(0) scale(1); opacity: 0.3; }
                    50% { transform: translateY(-4px) scale(1.1); opacity: 0.6; }
                }
                
                @keyframes bubble3 {
                    0%, 100% { transform: translateY(0) scale(1); opacity: 0.4; }
                    50% { transform: translateY(-2px) scale(1.3); opacity: 0.8; }
                }
                
                @keyframes pulse {
                    0%, 100% { transform: scale(1); opacity: 1; }
                    50% { transform: scale(1.02); opacity: 0.95; }
                }
            </style>
        `);
        
        // Progress simulation and better loading detection
        let progress = 0;
        let progressInterval;
        let isPageLoaded = false;
        let forceHideTimeout;
        
        // Function to update progress
        function updateProgress() {
            if (progress < 95 && !isPageLoaded) {
                // Simulate realistic loading progression
                const increment = Math.random() * 3 + 1; // Random 1-4% increments
                progress = Math.min(progress + increment, 95);
                
                $('#water-flow').css('width', progress + '%');
                $('#loading-percentage').text(Math.round(progress) + '%');
            }
        }
        
        // Start progress simulation
        progressInterval = setInterval(updateProgress, 150);
        
        // Function to complete loading
        function completeLoading() {
            if (isPageLoaded) return; // Prevent multiple calls
            isPageLoaded = true;
            
            clearInterval(progressInterval);
            clearTimeout(forceHideTimeout);
            
            // Complete the progress bar
            progress = 100;
            $('#water-flow').css('width', '100%');
            $('#loading-percentage').text('100%');
            
            // Hide after showing 100% briefly
            setTimeout(() => {
                $('.loading-screen').fadeOut(500, function() {
                    $(this).remove();
                });
            }, 300);
        }
        
        // Multiple loading detection methods
        
        // Method 1: Document ready (DOM loaded)
        $(document).ready(function() {
            setTimeout(completeLoading, 500); // Small delay to ensure everything is ready
        });
        
        // Method 2: Window load (all resources loaded)
        $(window).on('load', function() {
            setTimeout(completeLoading, 200);
        });
        
        // Method 3: Force hide after maximum time (fallback)
        forceHideTimeout = setTimeout(function() {
            console.log('Loading screen force-hidden after timeout');
            completeLoading();
        }, 5000); // 5 second maximum
        
        // Method 4: Check if document is already loaded
        if (document.readyState === 'complete') {
            setTimeout(completeLoading, 100);
        }
    }
    
    // Enhanced hover effects for contact items
    function initContactEffects() {
        $('.contact-item').hover(
            function() {
                $(this).find('i').css('transform', 'scale(1.3) rotate(10deg)');
            },
            function() {
                $(this).find('i').css('transform', 'scale(1) rotate(0deg)');
            }
        );
    }
    
    // Initialize all functions
    function init() {
        initLoadingScreen();
        initAnimations();
        initSmoothScroll();
        initButtonEffects();
        initParallax();
        animateFeatureList();
        staggerServiceCards();
        initContactEffects();
        
        // Check scroll on page load and scroll events
        checkScroll();
        $(window).on('scroll', function() {
            updateScrollProgress();
            checkScroll();
        });
        
        // Trigger animations after a short delay
        setTimeout(checkScroll, 500);
    }
    
    // Start everything
    init();
    
    console.log('🎨 Driftwell Contracting animations loaded! Site is now enhanced with beautiful effects.');
});
