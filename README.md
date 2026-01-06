# Booking System

A Laravel-based hotel booking application featuring hotels in Morocco with user authentication, hotel listings, and reservation management.

## 📚 Documentation

- **[NEXT_STEPS.md](NEXT_STEPS.md)** - ⭐ **START HERE** - What to do now
- **[DEPLOYMENT_GUIDE.md](DEPLOYMENT_GUIDE.md)** - Complete step-by-step deployment guide
- **[DEPLOYMENT_CHECKLIST.md](DEPLOYMENT_CHECKLIST.md)** - Deployment checklist

## Features

- **Authentication**: User registration, login, logout with password hashing (Laravel Breeze)
- **Hotels**: Browse and search hotels in Morocco with filtering by city
- **Reservations**: Create and manage hotel reservations
- **Profile**: User profile management
- **UI**: Modern, responsive design with TailwindCSS

## Requirements

- PHP >= 8.2
- Composer
- Node.js and NPM
- SQLite (or MySQL/PostgreSQL)

## Installation

1. **Clone the repository** (if applicable) or navigate to the project directory

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Install Node dependencies**:
   ```bash
   npm install
   ```

4. **Set up environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**:
   - The project uses SQLite by default (database/database.sqlite)
   - Or update `.env` to use MySQL/PostgreSQL:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```

6. **Run migrations and seeders**:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```
   This will create the database tables and seed 50 Moroccan hotels.

7. **Build assets**:
   ```bash
   npm run build
   ```
   Or for development:
   ```bash
   npm run dev
   ```

8. **Start the development server**:
   ```bash
   php artisan serve
   ```

9. **Access the application**:
   - Open your browser and navigate to `http://localhost:8000`
   - Register a new account or use the test accounts:
     - **Admin Account:**
       - Email: `admin@example.com`
       - Password: `password`
     - **Regular User Account:**
       - Email: `test@example.com`
       - Password: (check the seeder or create a new user)

## Project Structure

- **Models**: `Hotel`, `Reservation`, `User`
- **Controllers**: `HomeController`, `HotelController`, `ReservationController`, `ProfileController`
- **Views**: Blade templates in `resources/views/`
- **Migrations**: Database schema in `database/migrations/`
- **Seeders**: Hotel data seeder with 50 Moroccan hotels

## Routes

- `/` - Home page
- `/hotels` - Hotels listing with filters
- `/hotels/{id}` - Hotel details and booking
- `/my-reservations` - User reservations (authenticated)
- `/profile` - User profile (authenticated)
- `/login` - Login page
- `/register` - Registration page

### Admin Routes (Admin only)
- `/admin/dashboard` - Admin dashboard with statistics
- `/admin/hotels` - Manage hotels (CRUD)
- `/admin/reservations` - Manage reservations

## Features Details

### Hotels
- List all hotels in Morocco
- Search by hotel name
- Filter by city (Marrakech, Casablanca, Rabat, Tangier, Fes, Agadir, etc.)
- View hotel details with amenities
- Pagination support

### Reservations
- Only authenticated users can make reservations
- Automatic price calculation (nights × price per night)
- Date validation (check-in must be today or later, check-out must be after check-in)
- View reservation history

### Authentication
- Laravel Breeze authentication system
- Password hashing
- Session-based authentication
- Profile management

### Admin Dashboard
- Admin user role system
- Dashboard with statistics (hotels, reservations, users, revenue)
- Hotel management (create, edit, delete)
- Reservation management (view, update status, delete)
- Popular hotels analytics

## Database

The application includes:
- **Users table**: User accounts
- **Hotels table**: Hotel information (50 seeded hotels)
- **Reservations table**: User reservations

## Development

To run in development mode with hot reloading:
```bash
npm run dev
php artisan serve
```

## Testing

Run tests with:
```bash
php artisan test
```

## License

This project is open-sourced software licensed under the MIT license.
