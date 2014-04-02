# Kirk Email Obfuscator (for Perch)

## What It Does

Finds email addresses and links on any Perch-enabled page and changes them to Javascript (with a "noscript" notice) to help hide them from spambots.

## Why It Helps

Lets you use real, live, clickable, copyable email addresses and sleep a bit better knowing there is at least SOME spam protection. And even better, it works automatically on every email address on the page.

## Requirements

Should work with any Perch 2.x site.

## License & Disclaimers

- Use and abuse this at your own risk. 
- This app may completely break your site because it uses PHP's output buffer and some regex voodoo. If things go haywire (or shockingly blank), just comment out the app runtime in /perch/config/apps.php and yell at me here.

## Installation

1. Add the kirk_email_obfuscator folder to your /perch/addons/apps folder.
2. Include the runtime.php in your /perch/config/apps.php file: `include(PERCH_PATH.'/addons/apps/kirk_email_obfuscator/runtime.php');`
3. Add emails to your site content with carefree bliss.


## Change Log

### Version 0.3

- added check to make sure the delimiter is present

### Version 0.2

- now only replaces emails after the closing </head> tag

### Version 0.1

- initial version
