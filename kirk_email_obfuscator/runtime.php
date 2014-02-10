<?php  

/*

Version: 0.2
Author: Kirk Roberts

USAGE: just add the runtime.php to /config/apps.php
That's it.


## Change Log

Version 0.2

- now only replaces emails after the closing </head> tag

Version 0.1

- initial version

*/


// email obfuscator

function kirk_email_obfuscator_callback($buffer)
{
	
	$delimiter = '</head>';
	$markupParts = explode($delimiter, $buffer);
	$str = $markupParts[1];

	// find mailto: links
	$pattern = "|(<a .*mailto:.+</a>)|";
	preg_match_all($pattern, $str, $matches);
	foreach ($matches[0] as $match) {
		$replacement = kirk_email_obfuscator_obfuscate_text($match);
		$str = str_replace($match, $replacement, $str);
	}
	
	// find bare email addresses
	$pattern = "/\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]+\b(?!([^<]+)?>)/i";
	preg_match_all($pattern, $str, $matches);
	foreach ($matches[0] as $match) {
		$replacement = kirk_email_obfuscator_obfuscate_text($match);
		$str = str_replace($match, $replacement, $str);
	}
	
	$markupParts[1] = $str;

	return implode($delimiter, $markupParts);

}

function kirk_email_obfuscator_obfuscate_text($text) {
	// use rot13
	$text = addslashes(str_rot13($text));
	$text = str_replace('@','\100', $text);
	return '<script type="text/javascript">document.write("' . $text . '".replace(/[a-zA-Z]/g, function(c){return String.fromCharCode((c<="Z"?90:122)>=(c=c.charCodeAt(0)+13)?c:c-26);}));</script><noscript>Hidden email: requires Javascript</noscript>';
}

ob_start("kirk_email_obfuscator_callback");

// end email obfuscator


?>