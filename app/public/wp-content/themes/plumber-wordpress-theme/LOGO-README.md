# 🎨 PlumberPro Logo Management Guide

## Quick Start

Your theme now supports multiple logo options including SVG logos! Here's how to set them up:

### Option 1: Use Built-in SVG Logos (Recommended)
1. Replace the placeholder SVG files with your actual logos:
   - Replace `/assets/images/logo-white.svg` with your white/light logo
   - Replace `/assets/images/logo-dark.svg` with your dark logo
2. Go to **WordPress Admin → Site Content → Logo Settings**
3. Select "Built-in White SVG Logo" or "Built-in Dark SVG Logo"
4. Click "Update Logo Settings"

### Option 2: Upload Custom Logos
1. Go to **WordPress Admin → Appearance → Customize → Logo Options**
2. Upload your logos using the image upload controls
3. Go to **Site Content → Logo Settings**
4. Select "Custom Uploaded Logo"

### Option 3: Use WordPress Default
1. Go to **Appearance → Customize → Site Identity → Logo**
2. Upload your logo
3. Go to **Site Content → Logo Settings**
4. Select "Custom Uploaded Logo"

## SVG Requirements

For best results, your SVG logos should:
- Be optimized for web (remove unnecessary code)
- Have a viewBox attribute for proper scaling
- Be approximately 200px wide × 60px tall
- Work well on both dark and light backgrounds

## Current Logo Options

### Built-in White SVG (`logo-white.svg`)
- Perfect for dark backgrounds (like the header)
- Uses white and theme accent colors
- Automatically scales and animates

### Built-in Dark SVG (`logo-dark.svg`)  
- Perfect for light backgrounds
- Uses dark and theme accent colors
- Automatically scales and animates

### Custom Uploaded Logos
- Upload via WordPress Customizer
- Supports PNG, JPG, SVG formats
- Automatic scaling and hover effects

### Text Logo
- Uses your site name as styled text
- Matches theme typography
- Good fallback option

## Managing Your Logos

### Admin Interface
- **Site Content → Logo Settings**: Quick logo type selection
- **Appearance → Customize → Logo Options**: Upload custom logos
- **Appearance → Customize → Site Identity**: WordPress default logo

### File Replacement
To replace the built-in SVG logos:
1. Create your SVG files with the same names
2. Upload them to `/wp-content/themes/plumber-wordpress-theme/assets/images/`
3. Replace `logo-white.svg` and `logo-dark.svg`

## Features

✅ **SVG Support** - Crisp logos at any size  
✅ **Automatic Scaling** - Responsive design  
✅ **Hover Effects** - Subtle animations  
✅ **Multiple Options** - Choose what works best  
✅ **Easy Management** - Simple admin interface  
✅ **Fallback Support** - Always shows something  

## Troubleshooting

**Logo not showing?**
- Check that your SVG file exists in the correct location
- Verify the logo type is set correctly in Logo Settings
- Make sure file permissions allow reading

**SVG not uploading to WordPress?**
- The theme enables SVG uploads automatically
- Try refreshing the media library
- Check with your hosting provider about SVG support

**Logo too big/small?**
- Edit the CSS in style.css
- Look for `.logo-svg svg` and adjust the `height` property
- Default is 50px on desktop, 40px on mobile

## Support

If you need help with your logos:
1. Check the Logo Settings page for file status
2. Use the preview panels to test different options
3. Try the text logo as a fallback
4. Contact your developer for custom modifications

---

Happy branding! 🔧✨ 