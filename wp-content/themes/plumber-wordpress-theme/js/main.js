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
            const speed = scrolled * 0.22;
            
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
  <text class="logo-cls-13" transform="translate(0 373.36)">
  <tspan class="logo-cls-5" x="100" y="0">PLUMBING </tspan>

  <tspan class="logo-cls-5" x="280" y="0">INSTALLATION </tspan>

  <tspan class="logo-cls-5" x="500" y="0">REPAIR</tspan>
  </text>
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
    
    // Ensure service lists are properly displayed
    function enhanceServiceLists() {
        console.log('🔍 Starting service list enhancement...');
        console.log('📊 Initial DOM state:');
        console.log(`   - .service-full-content elements: ${$('.service-full-content').length}`);
        console.log(`   - .service-detail-card elements: ${$('.service-detail-card').length}`);
        console.log(`   - ul elements in service content: ${$('.service-full-content ul').length}`);
        console.log(`   - li elements in service content: ${$('.service-full-content li').length}`);
        
        // Log the actual content of each service
        $('.service-full-content').each(function(index) {
            const $content = $(this);
            const htmlContent = $content.html();
            const textContent = $content.text();
            
            console.log(`🔍 Service ${index + 1} content analysis:`);
            console.log(`   - HTML length: ${htmlContent ? htmlContent.length : 0} characters`);
            console.log(`   - Text length: ${textContent ? textContent.length : 0} characters`);
            console.log(`   - Contains <ul>: ${htmlContent && htmlContent.includes('<ul>')}`);
            console.log(`   - Contains <li>: ${htmlContent && htmlContent.includes('<li>')}`);
            console.log(`   - Existing ul elements: ${$content.find('ul').length}`);
            console.log(`   - Existing li elements: ${$content.find('li').length}`);
            
            if (htmlContent && htmlContent.length > 0) {
                console.log(`   - HTML preview: "${htmlContent.substring(0, 200)}..."`);
            }
            if (textContent && textContent.length > 0) {
                console.log(`   - Text preview: "${textContent.substring(0, 200)}..."`);
            }
        });
        
        // Wait for DOM to be fully loaded
        setTimeout(function() {
            // Method 1: Find existing lists
            let foundLists = 0;
            let foundItems = 0;
            
            $('.service-full-content ul').each(function() {
                const $ul = $(this);
                foundLists++;
                
                console.log(`✅ Found existing list ${foundLists}:`, {
                    classes: $ul.attr('class'),
                    items: $ul.find('li').length,
                    visible: $ul.is(':visible'),
                    display: $ul.css('display'),
                    visibility: $ul.css('visibility'),
                    opacity: $ul.css('opacity')
                });
                
                // Make sure the list is visible
                $ul.css({
                    'display': 'block !important',
                    'visibility': 'visible !important',
                    'opacity': '1 !important'
                });
                
                // Add service-list class if not present
                if (!$ul.hasClass('service-list')) {
                    $ul.addClass('service-list');
                }
                
                // Process list items
                $ul.find('li').each(function() {
                    const $li = $(this);
                    foundItems++;
                    
                    $li.css({
                        'display': 'list-item !important',
                        'visibility': 'visible !important',
                        'opacity': '1 !important',
                        'margin-bottom': '0.8rem',
                        'padding-left': '2rem',
                        'position': 'relative'
                    });
                });
                
                console.log(`✅ Enhanced existing list with ${$ul.find('li').length} items`);
            });
            
            // Method 2: Look for text that could be lists and convert them
            $('.service-full-content').each(function(index) {
                const $content = $(this);
                let textContent = $content.text();
                
                // Skip if already has lists
                if ($content.find('ul').length > 0) {
                    console.log(`⏭️ Service ${index + 1} already has lists, skipping conversion`);
                    return;
                }
                
                console.log(`🔍 Checking service ${index + 1} for convertible text...`);
                console.log(`Text content preview: "${textContent.substring(0, 200)}..."`);
                
                // Look for line-based lists in the text
                const lines = textContent.split('\n');
                const listLines = [];
                const otherLines = [];
                
                lines.forEach(line => {
                    line = line.trim();
                    if (line.match(/^[-*•]\s+/) || line.match(/^\d+\.\s+/)) {
                        listLines.push(line);
                        console.log(`   📝 Found list line: "${line}"`);
                    } else if (line.length > 0) {
                        otherLines.push(line);
                    }
                });
                
                if (listLines.length > 0) {
                    console.log(`🎯 Found ${listLines.length} potential list items in service ${index + 1}`);
                    
                    // Create HTML list
                    let listHtml = '<ul class="service-list js-generated">';
                    listLines.forEach(line => {
                        const cleanLine = line.replace(/^[-*•]\s+/, '').replace(/^\d+\.\s+/, '');
                        listHtml += `<li>${cleanLine}</li>`;
                    });
                    listHtml += '</ul>';
                    
                    // Add the list to content
                    $content.append('<div class="js-converted-list">' + listHtml + '</div>');
                    foundLists++;
                    foundItems += listLines.length;
                    
                    console.log(`✅ Created list with ${listLines.length} items for service ${index + 1}`);
                } else {
                    console.log(`❌ No convertible list patterns found in service ${index + 1}`);
                }
            });
            
            // Method 3: Force create demo lists for services without any content
            $('.service-full-content').each(function(index) {
                const $content = $(this);
                
                // If still no lists found, create a demo list
                if ($content.find('ul').length === 0 && $content.text().trim().length < 50) {
                    console.log(`📝 Creating demo list for service ${index + 1} (insufficient content)`);
                    
                    const demoList = `
                        <div class="demo-content">
                            <p><strong>Service Highlights:</strong></p>
                            <ul class="service-list demo-generated">
                                <li>Expert professional service</li>
                                <li>Quality guaranteed work</li>
                                <li>Competitive pricing</li>
                                <li>Licensed and insured</li>
                                <li>24/7 emergency support</li>
                            </ul>
                            <p><em style="color: #888; font-size: 0.9rem;">Demo content - please edit this service to add your own details and lists.</em></p>
                        </div>
                    `;
                    
                    $content.append(demoList);
                    foundLists++;
                    foundItems += 5;
                    
                    console.log(`✅ Added demo list for service ${index + 1}`);
                }
            });
            
            // Final scan and styling
            $('.service-full-content ul').each(function() {
                const $ul = $(this);
                
                // Ensure visibility
                $ul.show().css({
                    'display': 'block',
                    'visibility': 'visible',
                    'opacity': '1'
                });
                
                // Style list items
                $ul.find('li').css({
                    'display': 'list-item',
                    'visibility': 'visible',
                    'opacity': '1'
                });
                
                // Add visual indicator for different list types
                if ($ul.hasClass('demo-generated')) {
                    $ul.css('border-left', '3px solid #ff9800');
                } else if ($ul.hasClass('js-generated')) {
                    $ul.css('border-left', '3px solid #4caf50');
                } else if ($ul.hasClass('auto-generated')) {
                    $ul.css('border-left', '3px solid #2196f3');
                }
            });
            
            // Report results
            console.log(`🎉 Service List Enhancement Complete!`);
            console.log(`📊 Results: Found/Created ${foundLists} lists with ${foundItems} total items`);
            
            // Additional debugging
            console.log(`🔍 Detailed breakdown:`);
            console.log(`   - Existing lists: ${$('.service-full-content ul:not(.js-generated):not(.demo-generated)').length}`);
            console.log(`   - JS-converted lists: ${$('.service-full-content ul.js-generated').length}`);
            console.log(`   - Demo lists: ${$('.service-full-content ul.demo-generated').length}`);
            console.log(`   - Total services checked: ${$('.service-full-content').length}`);
            
            // Final DOM state
            console.log(`📊 Final DOM state:`);
            console.log(`   - Total ul elements: ${$('ul').length}`);
            console.log(`   - Service ul elements: ${$('.service-full-content ul').length}`);
            console.log(`   - Service li elements: ${$('.service-full-content li').length}`);
            console.log(`   - Visible ul elements: ${$('.service-full-content ul:visible').length}`);
            
            // Force visibility one more time
            setTimeout(function() {
                $('.service-full-content ul, .service-full-content li').css({
                    'display': 'block !important',
                    'visibility': 'visible !important',
                    'opacity': '1 !important'
                });
                console.log(`🔧 Applied final visibility fixes`);
                
                // Final count
                const finalListCount = $('.service-full-content ul').length;
                const finalItemCount = $('.service-full-content li').length;
                console.log(`🏁 FINAL RESULT: ${finalListCount} lists with ${finalItemCount} items`);
                
            }, 500);
            
        }, 100); // Small delay to ensure DOM is ready
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
        
        // Run service list enhancement immediately and multiple times
        console.log('🚀 Initializing service list enhancement...');
        enhanceServiceLists();
        
        // Run again after DOM is fully loaded
        setTimeout(enhanceServiceLists, 250);
        setTimeout(enhanceServiceLists, 500);
        setTimeout(enhanceServiceLists, 1000);
        
        // Check scroll on page load and scroll events
        checkScroll();
        $(window).on('scroll', function() {
            updateScrollProgress();
            checkScroll();
        });
        
        // Trigger animations after a short delay
        setTimeout(checkScroll, 500);
        
        // Add debugging info about page state
        console.log('📊 Page Debug Info:');
        console.log(`   - jQuery version: ${$.fn.jquery}`);
        console.log(`   - Document ready state: ${document.readyState}`);
        console.log(`   - Total .service-full-content elements: ${$('.service-full-content').length}`);
        console.log(`   - Total .service-detail-card elements: ${$('.service-detail-card').length}`);
        console.log(`   - Page URL: ${window.location.href}`);
    }
    
    // Start everything
    init();
    
    console.log('🎨 Driftwell Contracting animations loaded! Site is now enhanced with beautiful effects.');
});
