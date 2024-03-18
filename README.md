# shuruup.captable
Shuru new product for captable management only apis and admin in this project

<h4>Steps to check php.ini</h4>
<ol>
    <li>Must need php version <strong>8.3.0</strong></li>
    <li>Modify Below value to php.ini file</li>
    <li>Modify [upload_max_filesize = 50M] to desire value</li>
    <li>Modify [memory_limit = 512M] to desire value</li>
    <li>Modify [max_input_time = -1] to desire value</li>
    <li>Modify [max_execution_time = 0] to desire value</li>
    <li>Modify [post_max_size = 6G] to desire value</li>
</ol>
<h4>Steps to check apache vhost file</h4>
<ol>
    <li>Change apache :80 port to project's public folder</li>
    <li>If we want to use ssl :443 port than check this url to setup ssl <a href="https://docs.google.com/document/d/1M4RE8JUZfDbot3Wrj4GNWL6_rf9C7aRLRltiFG8oQbY/edit?usp=sharing">URL</a></li>
</ol>

<h4>Steps to Laravel</h4>
<ol>
    <li>Must need php version <strong>8.3.0</strong></li>
    <li>Run Command : 'cp .env.example .env' to generate ENV File</li>
    <li>setup envirnment variables at .env file</li>
    <li>Go to `app/Providers/SettingsServiceProvider.php` and comment the code inside boot and register function</li>
    <li>Run 'composer install' to install vendors (third party library)</li>
    <li>Run Command : 'php artisan key:generate' to generate Private key</li>
    <li>Run Command : 'php artisan optimize' to refresh cache files</li>
    <li>
        run 'php artisan migrate' command to create tables in database
    </li>
    <li>Go to `app/Providers/SettingsServiceProvider.php` and remove comment the code inside boot and register function</li>
</ol>

<p>Default superadmin login</p>
<ul>
    <li><strong>Username :</strong> shuruup</li>
    <li><strong>Password :</strong> Shuru@123</li>
</ul>
