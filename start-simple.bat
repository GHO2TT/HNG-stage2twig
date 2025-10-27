@echo off
echo ==========================================
echo  TicketApp - PHP Version (NO DEPENDENCIES!)
echo ==========================================
echo.
echo Starting PHP development server...
echo Server will run at: http://localhost:8000
echo.
echo This version requires NO Composer/Twig!
echo Just plain PHP - works out of the box!
echo.
echo Press Ctrl+C to stop the server
echo ==========================================
echo.

cd php-app-simple\public
php -S localhost:8000
