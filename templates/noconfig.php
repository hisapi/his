<!DOCTYPE html>
<!-- Ticket #11289, IE bug fix: always pad the error page with enough characters such that it is greater than 512 bytes, even after gzip compression abcdefghijklmnopqrstuvwxyz1234567890aabbccddeeffgghhiijjkkllmmnnooppqqrrssttuuvvwwxxyyzz11223344556677889900abacbcbdcdcededfefegfgfhghgihihjijikjkjlklkmlmlnmnmononpopoqpqprqrqsrsrtstsubcbcdcdedefefgfabcadefbghicjkldmnoepqrfstugvwxhyz1i234j567k890laabmbccnddeoeffpgghqhiirjjksklltmmnunoovppqwqrrxsstytuuzvvw0wxx1yyz2z113223434455666777889890091abc2def3ghi4jkl5mno6pqr7stu8vwx9yz11aab2bcc3dd4ee5ff6gg7hh8ii9j0jk1kl2lmm3nnoo4p5pq6qrr7ss8tt9uuvv0wwx1x2yyzz13aba4cbcb5dcdc6dedfef8egf9gfh0ghg1ihi2hji3jik4jkj5lkl6kml7mln8mnm9ono
-->
<html xmlns="http://www.w3.org/1999/xhtml" dir='ltr'>
<head>
	<meta charset="utf-8"> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>HIS &rsaquo; Install</title>
	<style type="text/css">
		html {
			background: #f9f9f9;
		}
		body {
			background: #fff;
			color: #333;
			font-family: sans-serif;
			margin: 2em auto;
			padding: 1em 2em;
			-webkit-border-radius: 3px;
			border-radius: 3px;
			border: 1px solid #dfdfdf;
			max-width: 700px;
		}
		h1 {
			border-bottom: 1px solid #dadada;
			clear: both;
			color: #666;
			font: 24px Georgia, "Times New Roman", Times, serif;
			margin: 30px 0 0 0;
			padding: 0;
			padding-bottom: 7px;
		}
		#error-page {
			margin-top: 50px;
		}
		#error-page p {
			font-size: 14px;
			line-height: 1.5;
			margin: 25px 0 20px;
		}
		#error-page code {
			font-family: Consolas, Monaco, monospace;
		}
		ul li {
			margin-bottom: 10px;
			font-size: 14px ;
		}
		a {
			color: #21759B;
			text-decoration: none;
		}
		a:hover {
			color: #D54E21;
		}

		.button {
			font-family: sans-serif;
			text-decoration: none;
			font-size: 14px !important;
			line-height: 16px;
			padding: 6px 12px;
			cursor: pointer;
			border: 1px solid #bbb;
			color: #464646;
			-webkit-border-radius: 15px;
			border-radius: 15px;
			-moz-box-sizing: content-box;
			-webkit-box-sizing: content-box;
			box-sizing: content-box;
			background-color: #f5f5f5;
			background-image: -ms-linear-gradient(top, #ffffff, #f2f2f2);
			background-image: -moz-linear-gradient(top, #ffffff, #f2f2f2);
			background-image: -o-linear-gradient(top, #ffffff, #f2f2f2);
			background-image: -webkit-gradient(linear, left top, left bottom, from(#ffffff), to(#f2f2f2));
			background-image: -webkit-linear-gradient(top, #ffffff, #f2f2f2);
			background-image: linear-gradient(top, #ffffff, #f2f2f2);
		}

		.button:hover {
			color: #000;
			border-color: #666;
		}

		.button:active {
			background-image: -ms-linear-gradient(top, #f2f2f2, #ffffff);
			background-image: -moz-linear-gradient(top, #f2f2f2, #ffffff);
			background-image: -o-linear-gradient(top, #f2f2f2, #ffffff);
			background-image: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#ffffff));
			background-image: -webkit-linear-gradient(top, #f2f2f2, #ffffff);
			background-image: linear-gradient(top, #f2f2f2, #ffffff);
		}

			</style>
</head>
<body id="error-page">


<h1>Option 1: Install HIS Web Interface here.</h1>
<br/>
<img src='images/home.png' align='left' style='padding-right:20px;'/>

<p>There doesn't seem to be a valid <code>his-config.php</code> file. I need this before we can get started.</p>
<p>Need more help?  <a href="https://humanintelligencesystem.com/forum/">Click here</a>.


<br/>
<br/>You can create a <code>his-config.php</code> file through this web interface<!--, but this doesn't work for all server setups. The safest way is-->, or manually create the file if you already have it.</p>

<p>Select Language to continue</p>
<form action='?page=1' method='post'> 
<?php
	echo "<select name='language'>";
	foreach ($STATIC['languages'] as $language_key=>$language_value)
	{
		echo "<option value='$language_key'>$language_value</option>";
	}
	echo "</select>";
?>
<input type='submit' value='Create a Configuration File' class='button'/>
</form>

<br/>

<h1>Option 2: Find a HIS Hosting Provider to host your HIS Services.</h1>
<p>
<img style='padding-right:20px;' src='images/managed.png' align='right'/>HIS is made up of 2 parts; this Web Interface, and your Compute Server cloud.<br/><br/>

If you choose this option, a HIS provider will usually setup and host both of these parts for you, and may offer features related to monitoring these services' health.
<br/>
<br/>

<br/>
Please note that the HIS Development Team is unable to supply a warranty nor guarantee regarding the quality of individual HIS Hosting Providers.

<div align='right'>
<form action='https://humanintelligencesystem.com/hosting/' method='post'> 
<input type='submit' value='View Suggested Hosting Providers' class='button'/>
</form>
</div>



 
</p>

<br/><br/><br/>
<br/><br/><br/>
<br/><br/><br/>

</body>
</html>
