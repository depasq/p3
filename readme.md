# CSCI E-15 Project 3 - Developer's Best Friend

## Live URL
http://p3.dwa15.jdepasquale.com/

## Description

This is a Laravel application containing a collection of useful tools for web development including a Lorem Ipsum generator, a random user generator, a reconfigured version of the XKCD-style password generator, and a color palette generator.  

## Demo

https://youtu.be/jgXBEj3YcDs

## Details for Teaching Team

This application uses PureCSS with additional custom formatting contained in css/p3.css.

The pages of this application make use of several packages downloaded from packagist.org.

The Lorem Ipsum, Random User, and Color Palette generators all use the fzaninotto/faker package.
The Lorem Ipsum page also makes use of a package called zeroclipboard to provide the "copy to
clipboard functionality". Additionally, the Color Palette generator uses the vitorbari/image-to-color-palette package to
create the color palettes and the drag and drop file upload capability is provided by Dropzone.js
(available on packagist at enyo/dropzone) in conjunction with css/dropzone.css to format the
look of the upload box. Uploaded images are stored in ./tmp in the public folder. 

The XKCD-style Password generator has been completely rewritten to fit into the MVC structure of a Laravel application, utilizing the flexibility of routes, views and controllers. In keeping with the separation of concerns, the view handles all display, just as in P2, while the controller handles all of the logic.  

The Random User Generator includes user profile pics (of lego people) that are pulled from
[randomuser.me](https://randomuser.me/photos)

## Outside Code
* Pure CSS: http://yui.yahooapis.com/pure/0.5.0/pure-min.css
* Pure CSS Side Menu: css/side-menu.css
* [Dropzone.js](https://packagist.org/packages/enyo/dropzone)
* [fzaninotto/faker](https://packagist.org/packages/fzaninotto/faker)
* [vitorbari/image-to-color-palette](https://packagist.org/packages/vitorbari/image-to-color-palette)
* [zeroclipboard/zeroclipboard](https://packagist.org/packages/zeroclipboard/zeroclipboard)
