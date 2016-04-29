SeclSocialButtonsBundle
=========================

This bundle provides a simple way to integrate a bar of social buttons to share your pages on Facebook, Twitter, Google Plus and Linkdein.
You also have a social links bar to networks.

## Introduction

I have not found any Symfony2 bundle to respond to this common need: display "share", "like"... buttons with an easy integration into templates.
It is intended to evolve :
- manage more networks 
- use custom icons
- compatibility with php templates
- suggestions are welcome

Yann

## Requirements

* Symfony 2.1 +

## Installation

### Add this line to require section of your composer.json

``` js
{
    //...
    "require": {
        //...
        "h-sn/socials-bundle": "dev-master"
    }
}
```

### Install the bundle

``` bash
$ curl -s http://getcomposer.org/installer | php
$ php composer.phar update h-sn/socials-bundle
```

Composer will install the bundle to your project's `vendor/secl` directory.

### Enable the bundle via the kernel

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Secl\SocialsBundle\SeclSocialsBundle(),
    );
}
```

## Configuration

add to your config.yml file the parameters:

// app/config/config.yml

``` yaml
//...
secl_socials:
    buttons:
        facebook:
            url:            null
            locale:         "en_EN"
            send:           false
            width:          300
            showFaces:      false
            layout:         "button_count"
        twitter:
            url:            null
            locale:         "en"
            message:        "Twitter message"
            text:           "Tweet"
            via:            "Via secl.com.ua"
            tag:            "secl"
        googleplus:
            url:            null
            locale :        "en"
            size :          "medium"
            annotation :    "bubble"
            width :         300
        linkedin:            
            url:            null
            locale:         "en_EN"
            counter:        "right"
        pinterest:
            url:            null
    links: 
        facebook:           "http://www.facebook.com/secl"
        googleplus:         "https://plus.google.com/15638525598389032981"
    theme:                  'default' # optional
```

Get the options details : 
- https://developers.facebook.com/docs/plugins/like-button
- https://developers.google.com/+/web/+1button/
- https://about.twitter.com/resources/buttons
- https://developer.linkedin.com/plugins/share-plugin-generator
- ...



## Twig extension

The bundle provides a Twig extension for quickly generating the buttons.

``` twig
// buttons

// Insert the whole bar
"{{ socialButtons() }}"

// Insert only one button
"{{ twitterButton() }}"
// or
"{{ socialButtons( {'googleplus':false, 'facebook':false, 'linkedin':false} ) }}"

// insert the google+ button with custom parameters
"{{ googlePlusButton( {'locale':'fr', 'url':'http://google.fr' }) }}"

// insert the bar with specific values for Facebook
"{{ socialButtons( { 'facebook': {'locale':'fr_FR', 'send':true}} ) }}"

// links

// insert the whole links defined in config
"{{ sociallinks() }}"

// insert one link, no option
"{{ socialLink('facebook') }}"

// insert one link, specifying the url
"{{ socialLink('linkedin',{'url': 'http://www.secl.net'}) }}"

// insert custom bar with 2 links, not showing googleplus
"{{ socialLinks({'linkedin',{'url': 'http://www.secl.net'}, 'facebook':{'url': 'http://www.facebook.com'}, 'googleplus': false}) }}"
```
## Notes

Pull requests a very welcome to integrate more buttons to this extension.

Thanks to Gregquat for his article: http://obtao.com/blog/2012/11/social-buttons-bar-for-facebook-twitter-google-with-symfony/ which did most of the work.

## License

This bundle is under the MIT license. See the complete license in the bundle:

    Resources/meta/LICENSE
