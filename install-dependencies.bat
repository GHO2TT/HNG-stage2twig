@echo off
echo ======================================
echo  Installing Composer Dependencies
echo ======================================
echo.

REM Download Composer
echo Downloading Composer...
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"

REM Install dependencies
echo.
echo Installing dependencies...
php composer.phar install

REM Clean up
del composer.phar

echo.
echo ======================================
echo  Installation Complete!
echo ======================================
echo.
echo You can now run: start-server.bat
echo.
pause
