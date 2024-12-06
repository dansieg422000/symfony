# Symfony Project

## Requirements

- PHP 7.1 or higher
- Composer
- Symfony CLI
- MySQL or another Database

## Clone the project

1. Clone the Project
   ```bash
   git clone dansieg422000/symfony

## Installation - Windows

1. Make sure all requirements installed
   ```bash
   - PHP
   - MySql
   - Apache Webserver
   - Symfony (CLI)

2. Run composer install in the project directory
   ```bash
   PS C:\Users\ronal\Development\symfony> composer install
   
3. To fun bin\console
   ```bash
   PS C:\Users\ronal\Development\symfony> php .\bin\console debug:config api_platform
   
3. Start the Server
   ```bash
   PS C:\Users\ronal\Development\symfony>symfony server:start
   
## Installation - Linux

1. Refer to Symfony website

2. Run Web server in Ubuntu
   ```bash
   sudo /opt/lampp/lampp start
   
3. Run Symfony project
   ```bash
   ~/Desktop$ cd symfony
   ~/Desktop/symfony$ symfony serve start -d
   ~/Desktop/symfony$ symfony serve stop -d
   
4. To run phpstorm
   ```bash
   ~/Desktop$ phpstorm
   
5. To run xampp
   ```bash
   ~/Desktop$ sudo /opt/lampp/manager-linux-x64.run
   
## Symfony Command
1. To create an entity
   ```bash
   PS C:\Users\ronal\Development\symfony> php .\bin\console make:user
   
2. To update an entity
   ```bash
   PS C:\Users\ronal\Development\symfony> php .\bin\console make:entity
   
3. To create a migration
   ```bash
   PS C:\Users\ronal\Development\symfony> symfony console make:migration
   
4. To run migration - will sync to Database
   ```bash
   PS C:\Users\ronal\Development\symfony> symfony console doctrine:migrations:migrate
   
5. To create a fake fixtures
   ```bash
   PS C:\Users\ronal\Development\symfony> php .\bin\console make:factory
   
6. To run fake fixtures and insert in the DB
   ```bash
   PS C:\Users\ronal\Development\symfony> symfony console doctrine:fixtures:load
   
7. To DROP Database
   ```bash
   PS C:\Users\ronal\Development\symfony> symfony console doctrine:database:drop --force
   
8. To CREATE a Database
   ```bash
   PS C:\Users\ronal\Development\symfony> symfony console doctrine:database:create
   

   
   
   
   
