<?php


/************************	SERVER DEFINITIONS	************************************/
$serverdefs= array(
						"com" => array("whois.crsnic.net","No match for"),
						"net" => array("whois.crsnic.net","No match for"),				
						"org" => array("whois.pir.org","NOT FOUND"),					
						"biz" => array("whois.biz","Not found"),					
						"info" => array("whois.afilias.net","NOT FOUND"),					
						"co.uk" => array("whois.nic.uk","No match"),
						"name" => array("whois.nic.name","No match"),
						"us" => array("whois.nic.us","Not Found")
					);
/*********************** 	END SERVER DEFINITIONS	*********************************/

/**	<------------------------------------functions--------------------------------> **/
function check_domain($domain,$ext)
{
  global $serverdefs;
	if ($serverdefs[$ext]){
	    $server = $serverdefs[$ext][0];
	    $nomatch = $serverdefs[$ext][1];
    }
    $output="";
    if(($sc = fsockopen($server,43))==false){return 2;}
    fputs($sc,"$domain.$ext\n");
    while(!feof($sc)){$output.=fgets($sc,128);}
    fclose($sc);
    //compare what has been returned by the server
    if (eregi($nomatch,$output)){
		return 0;
    }else{
        return 1;
    }
}

/******	This checks the name for invaild characters	*******************************/
function namecheck($domain)
{
    if($domain==""){$layout = "<tr>\n<td>\n<font color=\"red\">\nYou must enter a domain to be checked</font>\n<br>\n";
 	 print_results($layout);exit;}
    if(strlen($domain)< 3){$layout = "<tr>\n<td>\n<font color=\"red\">\nThe domain name $domain is too short</font>\n</td>\n</tr>\n"; print_results($layout);exit;}
    if(strlen($domain)>57){$layout = "<tr>\n<td>\n<font color=\"red\">\nThe domain name $domain is too long</font>\n</td>\n</tr>\n"; print_results($layout);exit;}
    if(@ereg("^-|-$",$domain)){$layout = "<tr>\n<td>\n<font color=\"red\">\nDomains cannot begin or end with a hyphen</font>\n</td>\n</tr>\n"; print_results($layout);exit;}
    if(!ereg("([a-z]|[A-Z]|[0-9]|-){".strlen($domain)."}",$domain))
    {$layout = "<tr>\n<td>\n<font color=\"red\">\nDomain names cannot contain special characters</font>\n</td>\n</tr>\n"; print_results($layout);exit;}

}
/***<--------------------------------end functions------------------------------------>***/

?>