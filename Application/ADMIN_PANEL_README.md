# Admin Panel for CodeIgniter 4

A comprehensive admin panel built for CodeIgniter 4 with modern UI, user management, and role-based access control.

## Features

### 🔐 Authentication & Security
- Secure login system with session management
- Password hashing with PHP's `password_hash()`
- Account lockout after failed login attempts
- Remember me functionality (30 days)
- Role-based access control (Super Admin, Admin, Moderator)
- CSRF protection

### 👥 User Management
- Create, edit, and delete admin users
- Role assignment with permission hierarchy
- User status management (Active, Inactive, Suspended)
- Login attempt tracking and account locking
- Profile management

### 📊 Dashboard
- System statistics and metrics
- Recent activity tracking
- System information display
- Quick action buttons
- Responsive design

### ⚙️ Settings Management
- Site configuration (name, email, description)
- System settings (timezone, date format, pagination)
- Security settings (maintenance mode, registration control)
- Settings backup and restore

### 🎨 Modern UI
- Bootstrap 5 responsive design
- Font Awesome icons
- Gradient color schemes
- Mobile-friendly sidebar
- Flash message system
- Form validation

## Installation

### 1. Database Setup

First, configure your database in the `.env` file:

```env
database.default.hostname = localhost
database.default.database = your_database_name
database.default.username = your_username
database.default.password = your_password
database.default.DBDriver = MySQLi
```

### 2. Run Setup Script

Execute the setup script to create tables and default admin user:

```bash
php setup_admin.php
```

Or manually run the commands:

```bash
# Run migrations
php spark migrate

# Create default admin user
php spark db:seed AdminUserSeeder
```

### 3. Access Admin Panel

Visit: `http://your-domain.com/admin`

**Default Login Credentials:**
- Username: `admin`
- Password: `password123`

**⚠️ Important:** Change the default password immediately after first login!

## File Structure

```
app/
├── Controllers/Admin/
│   ├── BaseAdminController.php    # Base controller with common functionality
│   ├── AuthController.php         # Authentication (login/logout)
│   ├── DashboardController.php    # Dashboard and statistics
│   ├── UsersController.php        # User management
│   └── SettingsController.php     # System settings
├── Models/
│   └── AdminModel.php             # Admin user model
├── Views/admin/
│   ├── layout/
│   │   └── main.php               # Main admin layout
│   ├── auth/
│   │   └── login.php              # Login page
│   ├── dashboard/
│   │   └── index.php              # Dashboard view
│   ├── users/
│   │   ├── index.php              # Users list
│   │   ├── create.php             # Create user form
│   │   └── edit.php               # Edit user form
│   └── settings/
│       └── index.php              # Settings page
├── Filters/
│   └── AdminAuthFilter.php        # Authentication filter
└── Database/
    ├── Migrations/
    │   └── 2024-01-01-000001_CreateAdminUsersTable.php
    └── Seeds/
        └── AdminUserSeeder.php
```

## Usage

### User Roles

1. **Super Admin**
   - Full access to all features
   - Can manage all users including other super admins
   - Can access all settings

2. **Admin**
   - Can manage users (except super admins)
   - Can access most settings
   - Cannot delete super admins

3. **Moderator**
   - Limited access to basic features
   - Cannot manage users or settings
   - Read-only access to dashboard

### Creating Users

1. Navigate to **Admin Users** → **Add New User**
2. Fill in the required information
3. Select appropriate role and status
4. Click **Create User**

### Managing Settings

1. Navigate to **Settings**
2. Configure site information, system settings, and security options
3. Click **Save Settings**

### Security Features

- **Account Lockout**: After 3 failed login attempts, accounts are locked for 30 minutes
- **Session Management**: Secure session handling with activity tracking
- **Password Security**: Strong password requirements and hashing
- **CSRF Protection**: Built-in CSRF protection for all forms

## Customization

### Adding New Admin Routes

Add routes in `app/Config/Routes.php`:

```php
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->group('', ['filter' => 'adminauth'], function($routes) {
        $routes->get('your-feature', 'YourController::index');
    });
});
```

### Creating New Admin Controllers

Extend the `BaseAdminController`:

```php
<?php

namespace App\Controllers\Admin;

class YourController extends BaseAdminController
{
    public function index()
    {
        $this->setPageTitle('Your Feature');
        $this->setBreadcrumbs([
            ['title' => 'Dashboard', 'url' => '/admin/dashboard'],
            ['title' => 'Your Feature', 'url' => '/admin/your-feature', 'active' => true]
        ]);

        return $this->renderView('admin/your-feature/index');
    }
}
```

### Customizing the Layout

Edit `app/Views/admin/layout/main.php` to modify:
- Sidebar menu items
- Color scheme
- Layout structure
- JavaScript functionality

## Security Considerations

1. **Change Default Credentials**: Always change the default admin password
2. **Use HTTPS**: Enable HTTPS in production
3. **Regular Updates**: Keep CodeIgniter and dependencies updated
4. **Database Security**: Use strong database credentials
5. **File Permissions**: Set appropriate file permissions
6. **Backup**: Regular database and file backups

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check database credentials in `.env`
   - Ensure database exists
   - Verify database server is running

2. **Migration Errors**
   - Check database permissions
   - Ensure migrations table exists
   - Run `php spark migrate:status` to check status

3. **Login Issues**
   - Verify admin user exists in database
   - Check session configuration
   - Clear browser cache and cookies

4. **Permission Denied**
   - Check file permissions on writable directories
   - Ensure web server has write access to `writable/` folder

### Debug Mode

Enable debug mode in `.env` for development:

```env
CI_ENVIRONMENT = development
```

## Support

For issues and questions:
1. Check the troubleshooting section
2. Review CodeIgniter 4 documentation
3. Check server error logs
4. Verify file permissions and database connectivity

## License

This admin panel is built for CodeIgniter 4 and follows the same MIT license terms.
