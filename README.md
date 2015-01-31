# L5-eloquent-tokenable
Allows using tokens (HashIDs) instead of id in Laravel Eloquent models.

# Setup
Add the package to the require section of your composer.json and run `composer update`

    "kduma/eloquent-tokenable": "~1.0"

# Prepare models
In your model add following lines:
    
    use \KDuma\Eloquent\Tokenable;
    protected $appends = array('token');

Optionally you can add also:

- `protected $salt = 'SALT';`  
A salt for making hashes. Default is table name. This salt is added to your `APP_KEY`.

- `protected $length = 10;`  
A salt length. Default is 10.

- `protected $alphabet = 'qwertyuiopasdfghjklzxcvbnm1234567890';`  
A hash alphabet. Default is `abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890`

# Usage
- `$model->token` - Generate tokens
- `Model::whereToken($id)->first()` - Find by token. (`whereToken` is query scope)
   

# Hashids

A special thanks to creators of [hashids](https://github.com/ivanakimov/hashids.php), a PHP class that this package is based.



# Packagist
View this package on Packagist.org: [kduma/eloquent-tokenable](https://packagist.org/packages/kduma/eloquent-tokenable)