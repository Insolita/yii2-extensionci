Advanced Gii extension generator
================================
![Latest Stable Version](https://img.shields.io/packagist/v/insolita/yii2-extensionci.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/insolita/yii2-extensionci.svg)](https://packagist.org/packages/insolita/yii2-extensionci.svg)
![License](https://img.shields.io/packagist/l/insolita/yii2-extensionci.svg)

provide extension with test skeleton adapted for travis-ci
default template - with codeception unit only
functional template also include functional suite and travis configuration

Installation
------------
add

```
"insolita/yii2-extensionci": "~0.0.1"
```

to the require-dev section of your `composer.json` file.

Usage
-----
register in gii configuration

```
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            ...
            'extensionci'=>[
                'class'=>\insolita\extensionci\ExtGenerator::class,
            ]
        ]
    ];
```
After generation - put extension code in directory "src",
modify tests\config files for include needed configuration
Check .travis.yml and comment or uncomment neccessary database and migrations