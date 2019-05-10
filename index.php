<?php
/* if started from commandline, wrap parameters to $_POST and $_GET */
if (!isset($_SERVER["HTTP_HOST"])) {
  parse_str($argv[1], $_GET);
  parse_str($argv[1], $_POST);
}
?>
<?php include("whois.php") ?>

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
  if($_POST['domain'] && $_POST['ext']) {
	  $_POST['domain'] = str_replace(' ', '', $_POST['domain']);
    $availability = check_domain($_POST['domain'], $_POST['ext']);
    if($availability == 0)
      echo "<font color=\"green\" face=\"Arial\"><b>" . $_POST['domain'] . "." . $_POST['ext'] . "</b> is available!</font>";
    else if ($availability == 1)
      echo "<font color=\"red\" face=\"Arial\"><a href=\"http://" . $_POST['domain'] . "." . $_POST['ext'] . "\" target=\"_blank\"><b>" . $_POST['domain'] . "." . $_POST['ext'] . "</b></a> is not available.</font>";
    else
      echo "<font face=\"Arial\">Sorry, an error has occurred. Please try again later.</font>";
    echo "<br /><br />";
  }
?>

<form method="post" action="/">
  <input type="text" name="domain" value="<?= $_POST['domain'] ?>" size="20">
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

<script type="text/javascript">
  var _gaq = [['_setAccount', 'UA-1563964-28'], ['_setDomainName', 'dmnsrch.mobi'], ['_trackPageview']];
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

</body>
</html>
