<!-- Ticket #11289, IE bug fix: always pad the error page with enough characters such that it is greater than 512 bytes, even after gzip compression abcdefghijklmnopqrstuvwxyz1234567890aabbccddeeffgghhiijjkkllmmnnooppqqrrssttuuvvwwxxyyzz11223344556677889900abacbcbdcdcededfefegfgfhghgihihjijikjkjlklkmlmlnmnmononpopoqpqprqrqsrsrtstsubcbcdcdedefefgfabcadefbghicjkldmnoepqrfstugvwxhyz1i234j567k890laabmbccnddeoeffpgghqhiirjjksklltmmnunoovppqwqrrxsstytuuzvvw0wxx1yyz2z113223434455666777889890091abc2def3ghi4jkl5mno6pqr7stu8vwx9yz11aab2bcc3dd4ee5ff6gg7hh8ii9j0jk1kl2lmm3nnoo4p5pq6qrr7ss8tt9uuvv0wwx1x2yyzz13aba4cbcb5dcdc6dedfef8egf9gfh0ghg1ihi2hji3jik4jkj5lkl6kml7mln8mnm9ono
-->
<html xmlns="http://www.w3.org/1999/xhtml" dir='ltr'>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>HIS &rsaquo; Error</title>

<link rel="stylesheet" href="templates/install.css?ver=0.1.1" type="text/css" />			
</head>
<body id="error-page">
<p>
<h1><?php
echo getTranslation('Error establishing a message queue connection',$_POST);
?></h1>
<p>

<?php
	echo getTranslation('installmsfail',$_POST);
?> <a href='https://humanintelligencesystem.com/forum/' target="_new">HIS Support Forums</a>.

</p>

<p class="step"><a href="?step=5" onclick="javascript:history.go(-1);return false;" class="button"><?php echo getTranslation('Try Again',$_POST); ?></a></p>

</body>
</html>

