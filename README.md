# WordPress Common Theme

This is a common starter theme for all WordPress projects with custom theme development. This theme serves as a base template that can be customized for each new project.

## Overview

This theme provides a solid foundation for WordPress theme development with:
- Modern CSS architecture using CSS variables
- Responsive design patterns
- Common WordPress functionality and hooks
- Pre-configured assets (Swiper, Fancybox, etc.)
- Custom form styling
- Header and footer templates
- Blog and archive templates
- SEO-friendly structure

## Setup Instructions

When starting a new project with this theme, you need to perform the following steps:

### 1. Update Theme Information

Replace the following placeholders throughout the entire project:

- **Theme Name**: Replace `Project Name` with your actual project name
- **Text Domain**: Replace `project-name` with your project's text domain (use lowercase, hyphens for spaces)
- **Function Names**: Replace `project_name_*` with your project's function prefix (use lowercase, underscores for spaces)
- **Variable Names**: Replace `$project_name_*` with your project's variable prefix

### 2. Files to Update

The following files contain placeholders that need to be replaced:

- `style.css` - Theme header information
- `readme.txt` - WordPress.org theme readme
- `functions.php` - All function names and text domains
- `inc/customizer.php` - Customizer functions
- `inc/custom-header.php` - Header functions
- `inc/template-functions.php` - Template functions
- `inc/template-tags.php` - Template tag functions
- All template files (`.php` files in root and `template-parts/` directory)
- `languages/project-name.pot` - Translation file (rename and update)

### 3. Search and Replace

Use your code editor's find and replace feature to update:

1. **Theme Name**: `Project Name` → `Your Project Name`
2. **Text Domain**: `project-name` → `your-project-name`
3. **Function Prefix**: `project_name` → `your_project_name`
4. **Variable Prefix**: `$project_name` → `$your_project_name`

### 4. Rename Files

- Rename `languages/project-name.pot` to match your text domain
- Update any asset file references if needed

## Features

- **Responsive Design**: Mobile-first approach with breakpoints
- **Custom CSS Variables**: Easy theming through CSS custom properties
- **Form Styling**: Pre-styled Contact Form 7 integration
- **Slider Support**: Swiper.js integration
- **Modal Support**: Fancybox integration
- **Custom Post Types**: Ready for custom post type integration
- **Widget Areas**: Sidebar and widget support
- **Translation Ready**: Full i18n support

## Requirements

- WordPress 4.5 or higher
- PHP 5.6 or higher
- Modern browser support

## Development

This theme follows WordPress coding standards and best practices. When customizing:

1. Keep the core structure intact
2. Add custom functionality in `functions.php` or create new files in `inc/`
3. Maintain the CSS variable system for easy theming
4. Follow WordPress naming conventions

## License

GNU General Public License v2 or later

## Credits

This theme is designed as a common starter theme for WordPress projects.
