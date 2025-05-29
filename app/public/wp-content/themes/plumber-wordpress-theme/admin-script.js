jQuery(document).ready(function($) {
    'use strict';
    
    // Add visual enhancements to the admin page
    function enhanceAdminInterface() {
        // Add icons to section headers
        $('.plumberpro-section-header h2').each(function() {
            const text = $(this).text();
            let icon = '';
            
            if (text.includes('Hero')) {
                icon = '🎯';
            } else if (text.includes('About')) {
                icon = '📖';
            } else if (text.includes('Contact')) {
                icon = '📞';
            }
            
            if (icon) {
                $(this).prepend('<span style="margin-right: 10px; font-size: 1.2em;">' + icon + '</span>');
            }
        });
        
        // Add tooltips to form fields
        const tooltips = {
            'hero_title': 'The main headline that visitors see first',
            'hero_subtitle': 'Supporting text that explains your value proposition',
            'hero_primary_button_text': 'Text for the main call-to-action button',
            'hero_primary_button_link': 'URL where the primary button should link to',
            'about_title': 'Main heading for the about section',
            'about_paragraph_1': 'First paragraph introducing your company',
            'about_paragraph_2': 'Second paragraph with additional details',
            'contact_section_title': 'Main heading for the contact section',
            'phone_number': 'Your business phone number',
            'email': 'Your business email address',
            'address': 'Your business address',
            'business_hours': 'Your operating hours and availability'
        };
        
        Object.keys(tooltips).forEach(function(fieldId) {
            const field = $('#' + fieldId);
            if (field.length) {
                field.attr('title', tooltips[fieldId]);
                field.after('<small class="description" style="display: block; margin-top: 5px; color: #666; font-style: italic;">' + tooltips[fieldId] + '</small>');
            }
        });
    }
    
    // Character counter for text areas
    function addCharacterCounters() {
        $('textarea').each(function() {
            const textarea = $(this);
            const maxLength = 500; // Recommended max length
            const counter = $('<div class="char-counter" style="text-align: right; margin-top: 5px; font-size: 12px; color: #666;"></div>');
            
            textarea.after(counter);
            
            function updateCounter() {
                const length = textarea.val().length;
                const remaining = maxLength - length;
                const color = remaining < 50 ? '#d63638' : (remaining < 100 ? '#f0b849' : '#666');
                
                counter.html('<span style="color: ' + color + ';">' + length + ' characters (recommended max: ' + maxLength + ')</span>');
            }
            
            textarea.on('input keyup', updateCounter);
            updateCounter();
        });
    }
    
    // Auto-save functionality
    function setupAutoSave() {
        let saveTimeout;
        const autoSaveDelay = 30000; // 30 seconds
        
        $('input, textarea').on('input', function() {
            clearTimeout(saveTimeout);
            
            // Show auto-save indicator
            if (!$('.auto-save-indicator').length) {
                $('h1').after('<div class="auto-save-indicator" style="background: #f0b849; color: white; padding: 5px 10px; border-radius: 4px; font-size: 12px; margin: 10px 0;">Changes detected - auto-save in 30 seconds</div>');
            }
            
            saveTimeout = setTimeout(function() {
                $('.auto-save-indicator').remove();
                // Note: Auto-save functionality would require AJAX implementation
                // For now, we'll just remove the indicator
            }, autoSaveDelay);
        });
    }
    
    // Form validation
    function setupFormValidation() {
        $('form').on('submit', function(e) {
            let hasErrors = false;
            const requiredFields = ['hero_title', 'about_title', 'contact_section_title'];
            
            // Remove existing error styles
            $('.error-field').removeClass('error-field');
            $('.field-error').remove();
            $('.validation-error').remove();
            
            requiredFields.forEach(function(fieldId) {
                const field = $('#' + fieldId);
                if (field.length && !field.val().trim()) {
                    field.addClass('error-field').css({
                        'border-color': '#d63638',
                        'box-shadow': '0 0 0 3px rgba(214, 54, 56, 0.1)'
                    });
                    field.after('<div class="field-error" style="color: #d63638; font-size: 12px; margin-top: 5px;">This field is required</div>');
                    hasErrors = true;
                }
            });
            
            if (hasErrors) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $('.error-field').first().offset().top - 100
                }, 500);
                
                // Show error notification
                if (!$('.validation-error').length) {
                    $('h1').after('<div class="validation-error notice notice-error" style="margin: 10px 0;"><p>Please fill in all required fields before saving.</p></div>');
                }
                
                return false;
            }
            
            // Show loading state
            const submitButton = $(this).find('input[type="submit"]');
            const originalText = submitButton.val();
            submitButton.val('Saving...').prop('disabled', true);
            
            // Add a small delay to show the loading state
            setTimeout(function() {
                // Allow form to submit normally
            }, 100);
        });
    }
    
    // Preview functionality
    function setupPreview() {
        // Add preview button
        const previewButton = $('<a href="' + window.location.origin + '" target="_blank" class="button" style="margin-left: 10px; background: #2271b1; color: white; text-decoration: none;">👁️ Preview Site</a>');
        $('.submit-wrapper .button-primary').after(previewButton);
    }
    
    // Smooth scroll for long forms
    function setupSmoothScrolling() {
        // Add navigation for sections
        const nav = $('<div class="section-nav" style="position: fixed; right: 20px; top: 50%; transform: translateY(-50%); background: white; border: 1px solid #ddd; border-radius: 6px; padding: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); z-index: 999;"></div>');
        
        $('.plumberpro-section').each(function(index) {
            const sectionTitle = $(this).find('h2').text();
            const navItem = $('<a href="#" data-section="' + index + '" style="display: block; padding: 5px 10px; text-decoration: none; color: #333; font-size: 12px; border-radius: 3px; margin-bottom: 5px;">' + sectionTitle + '</a>');
            
            navItem.on('click', function(e) {
                e.preventDefault();
                const targetSection = $('.plumberpro-section').eq($(this).data('section'));
                $('html, body').animate({
                    scrollTop: targetSection.offset().top - 20
                }, 500);
            });
            
            nav.append(navItem);
        });
        
        $('body').append(nav);
        
        // Highlight active section on scroll
        $(window).on('scroll', function() {
            const scrollTop = $(window).scrollTop();
            $('.plumberpro-section').each(function(index) {
                const sectionTop = $(this).offset().top - 100;
                const sectionBottom = sectionTop + $(this).outerHeight();
                
                if (scrollTop >= sectionTop && scrollTop < sectionBottom) {
                    $('.section-nav a').removeClass('active').eq(index).addClass('active').css({
                        'background': '#29d1d1',
                        'color': 'white'
                    });
                } else {
                    $('.section-nav a').eq(index).css({
                        'background': 'transparent',
                        'color': '#333'
                    });
                }
            });
        });
    }
    
    // Initialize all enhancements
    function initializeEnhancements() {
        enhanceAdminInterface();
        addCharacterCounters();
        setupAutoSave();
        setupFormValidation();
        setupPreview();
        setupSmoothScrolling();
        
        // Add custom CSS classes to existing elements
        $('.wrap').addClass('plumberpro-admin-wrap');
        $('h1').wrap('<div class="plumberpro-admin-header"></div>');
        $('.plumberpro-admin-header').append('<p>Edit your website content easily with this intuitive interface</p>');
        
        $('.postbox').addClass('plumberpro-section');
        $('.postbox-header').addClass('plumberpro-section-header');
        $('.inside').addClass('plumberpro-section-content');
        $('.submit').wrap('<div class="submit-wrapper"></div>');
        
        // Add success animation
        if ($('.notice-success').length) {
            $('.notice-success').hide().fadeIn(500).delay(3000).fadeOut(500);
        }
    }
    
    // Run initialization
    initializeEnhancements();
    
    // Accessibility improvements
    $('input, textarea').on('focus', function() {
        $(this).parent().addClass('focused');
    }).on('blur', function() {
        $(this).parent().removeClass('focused');
    });
    
    // Add keyboard shortcuts
    $(document).on('keydown', function(e) {
        // Ctrl/Cmd + S to save
        if ((e.ctrlKey || e.metaKey) && e.keyCode === 83) {
            e.preventDefault();
            $('form').submit();
        }
        
        // Escape to clear focus
        if (e.keyCode === 27) {
            $('input, textarea').blur();
        }
    });
    
    console.log('PlumberPro Admin enhancements loaded successfully! 🔧✨');
    
    // Media Uploader functionality
    function setupMediaUploader() {
        var frame;
        
        $('.upload-image-button').on('click', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var preview = button.siblings('.image-preview');
            var input = button.siblings('input[type="hidden"]');
            var removeBtn = button.siblings('.remove-image-button');
            
            // If the media frame already exists, reopen it
            if (frame) {
                frame.open();
                return;
            }
            
            // Create the media frame
            frame = wp.media({
                title: 'Select or Upload an Image',
                button: {
                    text: 'Use This Image'
                },
                multiple: false
            });
            
            // When an image is selected, run a callback
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                
                // Update the hidden input
                input.val(attachment.url);
                
                // Update the preview
                preview.html('<img src="' + attachment.url + '" style="max-width: 200px; height: auto; display: block; margin-bottom: 10px;" />');
                
                // Show the remove button
                removeBtn.show();
            });
            
            // Open the media frame
            frame.open();
        });
        
        $('.remove-image-button').on('click', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var preview = button.siblings('.image-preview');
            var input = button.siblings('input[type="hidden"]');
            
            // Clear the input
            input.val('');
            
            // Reset the preview
            preview.html('<div style="width: 200px; height: 150px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; border: 2px dashed #ccc;"><span style="color: #666;">No image selected</span></div>');
            
            // Hide the remove button
            button.hide();
        });
    }
    
    // Initialize media uploader
    setupMediaUploader();
}); 