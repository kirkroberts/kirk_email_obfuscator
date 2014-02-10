<?php  

/*

Version: 0.1
Author: Kirk Roberts

USAGE

*/


// email obfuscator

function kirk_email_obfuscator_callback($buffer)
{
	
	// find mailto: links
	$pattern = "|(<a .*mailto:.+</a>)|";
	preg_match_all($pattern, $buffer, $matches);
	foreach ($matches[0] as $match) {
		$replacement = kirk_email_obfuscator_obfuscate_text($match);
		$buffer = str_replace($match, $replacement, $buffer);
	}
	
	// find bare email addresses
	$pattern = "/\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]+\b(?!([^<]+)?>)/i";
	preg_match_all($pattern, $buffer, $matches);
	foreach ($matches[0] as $match) {
		$replacement = kirk_email_obfuscator_obfuscate_text($match);
		$buffer = str_replace($match, $replacement, $buffer);
	}
	
	return $buffer;
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