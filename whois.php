<?php

// WHOIS server definitions and expected result strings
$serverdefs = array(
						"com" => array("whois.crsnic.net", "No match for"),
						"net" => array("whois.crsnic.net", "No match for"),				
						"org" => array("whois.pir.org", "NOT FOUND"),					
						"biz" => array("whois.biz", "Not found"),					
						"info" => array("whois.afilias.net", "NOT FOUND"),					
						"co.uk" => array("whois.nic.uk", "No match"),
						"name" => array("whois.nic.name", "No match"),
						"us" => array("whois.nic.us", "Not Found")
					);

function check_domain($domain, $ext)
{
  global $serverdefs;
	if($serverdefs[$ext]) {
    $server = $serverdefs[$ext][0];
    $nomatch = $serverdefs[$ext][1];
  }
  $output = "";

  if(($sc = fsockopen($server, 43)) == false)
    return 2;

  fputs($sc, "$domain.$ext\n");
  while(!feof($sc)) $output .= fgets($sc, 128);
  fclose($sc);

  // Compare server response to expected string
  if(strpos($output, $nomatch) === false)
    return 1;    // unavailable
  else
    return 0;    // available
}

// Messy checks for invalid inputs
function namecheck($domain)
{
  if($domain == "")
    $layout = "<tr>\n<td>\n<font color=\"red\">\nYou must enter a domain to be checked</font>\n<br>\n";
  else if(strlen($domain) < 3)
    $layout = "<tr>\n<td>\n<font color=\"red\">\nThe domain name $domain is too short</font>\n</td>\n</tr>\n";
  else if(strlen($domain) > 57)
    $layout = "<tr>\n<td>\n<font color=\"red\">\nThe domain name $domain is too long</font>\n</td>\n</tr>\n";
  else if(@preg_match("^-|-$", $domain))
    $layout = "<tr>\n<td>\n<font color=\"red\">\nDomains cannot begin or end with a hyphen</font>\n</td>\n</tr>\n";
  else if(!preg_match("([a-z]|[A-Z]|[0-9]|-){" . strlen($domain) . "}", $domain))
    $layout = "<tr>\n<td>\n<font color=\"red\">\nDomain names cannot contain special characters</font>\n</td>\n</tr>\n";

  print_results($layout);
}

?>