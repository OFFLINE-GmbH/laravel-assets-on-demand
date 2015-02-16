# Asset Manager for Laravel 5

This package makes it easy to add JS files, CSS files and HTML imports to your template. 

## Install it
To install this package include it in your `composer.json` and run `composer update`:

    "require": {
       "offline/laravel-assets-on-demand": "1.0.0"
    }
     
Add the Service Provider to the `provider` array in your `config/app.php`

    'Offline\Asset\AssetServiceProvider'
    
Add an alias for the facade to your `config/app.php`

    'Asset'  => 'Offline\Asset\Facades\Asset',


## Use it

### General
Include an JS asset

    Asset::addJs('build/js/app.js');
    
Include an CSS asset

    Asset::addCss('build/css/app.css');


### Priorities

Assets are sorted by priority (ASC). Define the priority as integer via the second argmuent.

    Asset::addCss('vendor/css/grid.css', -0);           // Is included 1st
    Asset::addCss('build/css/app.css'  ,  0);           // Is included 2nd
    Asset::addCss('build/css/app-overwrites.css', 10);  // Is included 3rd

### Positions

To split your assets into groups, use the third parameter. Default is `head`.

    Asset::addJs('vendor/jquery/jquery.js');
    Asset::addJs('build/js/app.js', 0, 'footer');


## Add your assets to your template

In your template, include the assets via

    {!! Asset::all() !!}  // Includes everything
    {!! Asset::js()  !!}  // Includes js files only
    {!! Asset::css() !!}  // Includes css files only

    {!! Asset::js('footer') !!}  // Includes js files with position `footer`
