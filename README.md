# Creative Shop - E-Commerce System

A modern e-commerce management system built with Laravel 12 and Tailwind CSS for managing products and categories with a responsive, user-friendly interface.

## Features

- **Product Management**: Complete CRUD operations for products
- **Category Management**: Full category management with status control
- **Many-to-Many Relationships**: Products can belong to multiple categories
- **Responsive Design**: Works perfectly on mobile, tablet, and desktop
- **Modern UI**: Clean interface built with Tailwind CSS
- **Form Validation**: Comprehensive server-side validation
- **Success Notifications**: User feedback with dismissible alerts

## Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates + Tailwind CSS
- **Database**: MySQL
- **Build Tool**: Vite
- **Styling**: Tailwind CSS 4.x

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js 16+ and npm
- MySQL 5.7+ or 8.0+
- Git

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Kasfat/creative-tech-park.git
   cd creative-tech-park
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   Edit `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=creative_tech
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

8. **Build assets**
   ```bash
   npm run build
   # For development with hot reload:
   npm run dev
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to access the application.


## Key Features

### Responsive Design
- Mobile-first approach
- Hamburger menu for mobile devices
- Collapsible sidebar navigation
- Touch-friendly interface
- Optimized for all screen sizes

### Product Management
- Create products with multiple categories
- Edit existing products
- Delete products (with cascade category removal)
- List all products with pagination
- Form validation and error handling

### Category Management
- Create categories with status control
- Edit category information
- Delete categories
- View category list
- Active/Inactive status management

### Form Validation
- Server-side validation for all forms
- Required field validation
- Unique constraints (SKU, category names)
- User-friendly error messages


## Development

### Building Assets
```bash
# Development build with watch
npm run dev

# Production build
npm run build
```

### Database Operations
```bash
# Fresh migration
php artisan migrate:fresh





### Cache Clearing
```bash
# Clear all caches
php artisan optimize:clear

# Clear specific caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
```
