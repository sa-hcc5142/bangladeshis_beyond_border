# MySQL Database Access Guide

## ✅ Database Successfully Switched from SQLite to MySQL!

### 📊 Database Information
- **Database Name**: `bangladeshis_beyond_border`
- **Host**: `127.0.0.1` (localhost)
- **Port**: `3306`
- **Username**: `root`
- **Password**: *(empty)*
- **Connection**: MySQL

---

## 🔍 Access Methods

### Method 1: phpMyAdmin (GUI) - Easiest!
1. Make sure XAMPP MySQL is running
2. Open browser: **http://localhost/phpmyadmin**
3. Click on database: `bangladeshis_beyond_border`
4. You'll see all 13 tables

**Tables**:
- `universities` (600 records)
- `subjects` (56 records)
- `university_rankings`
- `subject_rankings`
- `subject_university` (pivot table)
- `university_quick_links`
- `users`
- `sessions`
- `cache`, `cache_locks`
- `jobs`, `job_batches`, `failed_jobs`
- `migrations`

---

### Method 2: Laravel Tinker (Command Line)
```bash
# Open tinker
php artisan tinker

# Run queries
University::count()              // Returns 600
Subject::count()                 // Returns 56
University::first()              // First university
University::with('quickLinks')->find(1)  // MIT with quick links
```

---

### Method 3: MySQL Command Line
```bash
# Connect to MySQL
mysql -u root

# Select database
USE bangladeshis_beyond_border;

# Show all tables
SHOW TABLES;

# Query universities
SELECT id, name, country FROM universities LIMIT 10;

# Count records
SELECT COUNT(*) FROM universities;
```

---

## 📝 Configuration Files Updated

### .env file
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bangladeshis_beyond_border
DB_USERNAME=root
DB_PASSWORD=
```

---

## 🚀 Quick Commands

### Check Database Connection
```bash
php artisan tinker --execute="echo 'Connected to: ' . config('database.default');"
```

### View Tables
```bash
php artisan db:show
```

### Check Table Records
```bash
php artisan tinker --execute="
echo 'Universities: ' . \App\Models\University::count() . PHP_EOL;
echo 'Subjects: ' . \App\Models\Subject::count() . PHP_EOL;
echo 'Quick Links: ' . \App\Models\UniversityQuickLink::count() . PHP_EOL;
"
```

### Run Fresh Migration (Careful - drops all data!)
```bash
php artisan migrate:fresh
```

### Run Migrations + Seed
```bash
php artisan migrate:fresh --seed
```

### Seed Specific Data
```bash
php artisan db:seed --class=UniversityWebsitesSeeder
php artisan db:seed --class=UniversityQuickLinksSeeder
```

---

## 🔧 Troubleshooting

### Problem: "Connection refused"
**Solution**: 
1. Open XAMPP Control Panel
2. Start MySQL service
3. Check port 3306 is not blocked

### Problem: "Access denied"
**Solution**: 
1. Check MySQL username/password in `.env`
2. Default XAMPP: username=`root`, password=*(empty)*
3. Update `.env` if needed

### Problem: "Database doesn't exist"
**Solution**: 
```bash
php create_database.php
```

### Problem: "Migration failed"
**Solution**: 
```bash
# Drop all tables and start fresh
php artisan migrate:fresh

# Then seed
php artisan db:seed
```

---

## ✨ Verification Checklist

- [x] MySQL running in XAMPP
- [x] Database `bangladeshis_beyond_border` created
- [x] `.env` configured with MySQL settings
- [x] All 13 migrations ran successfully
- [x] 600 universities seeded
- [x] 56 subjects seeded
- [x] Quick links seeded (MIT, Stanford)
- [x] Can access via phpMyAdmin
- [x] Application connects to MySQL

---

## 📚 For Lab Demonstration

**Show your instructor**:
1. **XAMPP Control Panel** - MySQL running (green status)
2. **phpMyAdmin** - Show the database and tables
3. **Application** - Show data loading from MySQL
4. **Tinker** - Run live queries to show database interaction
5. **Migrations folder** - Show all 13 migration files
6. **.env file** - Show MySQL configuration

**Key Points to Mention**:
- ✅ Using MySQL (not SQLite)
- ✅ Database design with proper relationships
- ✅ Foreign keys and constraints
- ✅ Pivot tables for many-to-many relationships
- ✅ Migrations for schema versioning
- ✅ Seeders for sample data
- ✅ Eloquent ORM for database operations

---

## 🎯 Next Steps

1. **Run the web scraper** to populate quick links for all universities:
   ```bash
   php artisan scrape:university-links --limit=600
   ```

2. **Access phpMyAdmin** to show your instructor the database structure

3. **Test the application** to verify everything works with MySQL:
   ```
   php artisan serve
   ```
   Open: http://127.0.0.1:8000

4. **Implement remaining lab concepts** (see LAB_CONCEPTS_ANALYSIS.md):
   - CRUD operations with forms
   - Middleware (auth, roles)
   - Resource controllers
   - Testing

---

**Last Updated**: October 21, 2025
**Database**: MySQL (XAMPP)
**Laravel Version**: 12.x
**PHP Version**: 8.2
