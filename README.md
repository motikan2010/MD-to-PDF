# MD to PDF

 Convert Markdown files in GitHub to PDF file.

## Usage

![usage1](https://user-images.githubusercontent.com/3177297/87242278-2bdf8a80-c466-11ea-951e-425175ef8053.png)
![usage2](https://user-images.githubusercontent.com/3177297/87238655-6c2c1200-c440-11ea-8f76-947b36d3b6c3.png)

## Install

### Support Japanese

```
// Download IPA font
$ wget https://ipafont.ipa.go.jp/IPAfont/ipag00303.zip
$ unzip ipag00303.zip

// Download util for setting font
$ https://github.com/dompdf/utils/archive/master.zip
$ unzip master.zip

// Setting font
$ php utils-master/load_font.php ipag ipag00303/ipag.ttf

// Clear
$ rm -rf ipag00303.zip master.zip utils-master ipag00303
```

## Memo

### Core third party library

- Markdown to HTML ([michelf/php-markdown](https://github.com/michelf/php-markdown]))
- HTML to PDF ([dompdf/dompdf](https://github.com/dompdf/dompdf))

### Support Japanese in PDF

- Download IPA Font(https://ipafont.ipa.go.jp/old/ipafont/download.html)
- [dompdf/utils: Utility scripts for use with the dompdf library](https://github.com/dompdf/utils)

### Develop

```
$ composer install
$ php artisan key:generate
$ php artisan serve
```

```
$ npm install
$ npm run production
```
