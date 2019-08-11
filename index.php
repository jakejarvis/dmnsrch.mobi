<?php require("whois.php") ?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
  <title>Mobile Domain Search</title>	
  <meta name="description" content="Check domain name availability from your mobile device.">
  <meta name="keywords" content="domain,domains,wap,mobile,jake jarvis,jakejarvis">
</head>
<body>

<font face="Arial"><b>Mobile Domain Search</b></font>

<br><br>

<?php
  if(isset($_POST['domain']) && isset($_POST['ext'])) {
	$domain = filter_var($_POST['domain'], FILTER_SANITIZE_STRING);
	$ext = filter_var($_POST['ext'], FILTER_SANITIZE_STRING);
	$domain = str_replace(' ', '', $domain);
    $availability = check_domain($domain, $ext);
    if($availability == 0)
      echo "<font color=\"green\" face=\"Arial\"><b>" . $domain . "." . $ext . "</b> is available!</font>";
    else if($availability == 1)
      echo "<font color=\"red\" face=\"Arial\"><a href=\"http://" . $domain . "." . $ext . "\" target=\"_blank\"><b>" . $domain . "." . $ext . "</b></a> is not available.</font>";
    else
      echo "<font face=\"Arial\">Sorry, an error has occurred. Please try again later.</font>";
    echo "<br /><br />";
  }
?>

<form method="post" action="/">
  <input type="text" name="domain" value="<? if(isset($_POST['domain'])) echo $domain; ?>" size="20">
  <br>
  <select size="1" name="ext">
    <option selected value="com">.com</option>
    <option value="net">.net</option>
    <option value="org">.org</option>
    <option value="biz">.biz</option>
    <option value="info">.info</option>
    <option value="co.uk">.co.uk</option>
    <option value="name">.name</option>
    <option value="us">.us</option>
  </select>
  <br>
  <input type="submit" value="Continue">
</form>

<br>

<font size="-2" face="Arial">A <a href="https://jarv.is/">Jake Jarvis</a> Production</font>

<script>
  var _paq = _paq || [];
  _paq.push(['setRequestMethod', 'POST']);
  _paq.push(['setSecureCookie', true]);
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  _paq.push(['enableHeartBeatTimer']);
  (function() {
    var u='https://stats.jarv.is/';
    _paq.push(['setTrackerUrl', u+'send']);
    _paq.push(['setSiteId', '8']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.async=true; g.defer=true; g.src=u+'stats.js'; s.parentNode.insertBefore(g,s);
  })();
</script>

</body>
</html>
