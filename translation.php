<?php
$translation=array();
global $translation;
function getTranslation($key,$lang)
{
	global $translation;
	global $u;
	
	$default_language="english";
	if ( is_array($lang) )
	{
		if ( isset($lang['language']['@attributes']['value']) )
		{
			$lang=$lang['language']['@attributes']['value'];
		}
		else
		{
			if ( isset($lang['language']) )
			{
				$lang=$lang['language'];
				if ( is_array($lang) )
				{
					$lang=$lang['@attributes']['value'];
				}
			}
			else
			{
				$lang=$default_language;
			}
		}
	}
	if ( isset($u) )
	{
		if ( isset($u->lang) )
		{
			if ($u->lang!="undefined")
			{
				$lang=$u->lang;
			}
		}
	}
	if ( isset($translation[$key]) )
	{
		if ( isset($translation[$key][$lang.""]) )
		{
			return $translation[$key][$lang];
		}
		else
		{
			if ( isset($translation[$key][$default_language]) )
			{
				return $translation[$key][$default_language];
			}
			else
			{
				return "$key **";
			}
		}
	}
	else
	{
		return "$key **";
	}
}

$STATIC['languages']=array(
	'english'=>'English',
	'german'=>'Deutsch (German)',
	'afrikaans'=>'Afrikaans',
	'albanian'=>'Shqiptar (Albanian)',
	'arabic'=>'العربية (Arabic)',
	'armenian'=>'հայերեն (Armenian)',
	'azerbaijani'=>'Azərbaycan (Azerbaijani)',
	'basque'=>'Euskal (Basque)',
	'belarusian'=>'Беларускія (Belarusian)',
	'bengali'=>'বাঙ্গালী (Bengali)',
	'bulgarian'=>'Български (Bulgarian)',
	'catalan'=>'Català (Catalan)',
	'chinesesimplified'=>'中国简体中文 (Chinese Simplified)',
	'chinesetraditional'=>'中国传统文化 (Chinese Traditional)',
	'croatian'=>'Hrvatski (Croatian)',
	'czech'=>'Český (Czech)',
	'danish'=>'Dansk (Danish)',
	'dutch'=>'Nederlands (Dutch)',
	'esperanto'=>'Esperanto',
	'estonian'=>'Eesti (Estonian)',
	'filipino'=>'Pilipino (Filipino)',
	'finnish'=>'Suomi (Finnish)',
	'french'=>'Français (French)',
	'galician'=>'Galicia (Galician)',
	'georgian'=>'საქართველოს (Georgian)',
	'greek'=>'ελληνικά (Greek)',
	'gujarati'=>'ગુજરાતી (Gujarati)',
	'hatiancreole'=>'Kreyòl Ayisyen (Haitian Creole)',
	'hebrew'=>'עברית (Hebrew)',
	'hindi'=>'हिंदी (Hindi)',
	'hungarian'=>'Magyar (Hungarian)',
	'icelandic'=>'Icelandic',
	'indonesian'=>'Indonesian',
	'irish'=>'Gaeilge (Irish)',
	'italian'=>'Italiano (Italian)',
	'japanese'=>'日本人 (Japanese)',
	'kannada'=>'ಕನ್ನಡ (Kannada)',
	'korean'=>'한국의 (Korean)',
	'lao'=>'ລາວ (Lao)',
	'latin'=>'Latine (Latin)',
	'latvian'=>'Latvijas (Latvian)',
	'lithuanian'=>'Lietuvos (Lithuanian)',
	'macedonian'=>'македонски (Macedonian)',
	'malay'=>'Melayu (Malay)',
	'maltese'=>'Malti (Maltese)',
	'norwegian'=>'Norsk (Norwegian)',
	'persian'=>'فارسی (Persian)',
	'polish'=>'Polski (Polish)',
	'portuguese'=>'Português (Portuguese)',
	'romanian'=>'Român (Romanian)',
	'russian'=>'Pусский (Russian)',
	'serbian'=>'српски (Serbian)',
	'slovak'=>'Slovenčina (Slovak)',
	'slovenian'=>'Slovenski Jezik (Slovenian)',
	'spanish'=>'Español (Spanish)',
	'swahili'=>'Kiswahili (Swahili)',
	'swedish'=>'Svenska (Swedish)',
	'tamil'=>'தமிழ் (Tamil)',
	'telugu'=>'తెలుగు (Telugu)',
	'thai'=>'ภาษาไทย (Thai)',
	'turkish'=>'Türk (Turkish)',
	'ukrainian'=>'Український (Ukrainian)',
	'urdu'=>'اردو (Urdu)',
	'vietnamese'=>'Việt (Vietnamese)',
	'welsh'=>'Cymraeg (Welsh)',
	'yiddish'=>'ייִדיש (Yiddish)'
);

$translation['installpage2']['english']="HIS supports several types of database technologies.<br/><br/>

Any grayed-out entries below are not compatible with your current system configuration.";
$translation['installpage2']['german']="HIS unterstützt verschiedene Arten von Datenbank-Technologien.<br/><br/>

Jede graue Einträge beliw sind nicht kompatibel mit der aktuellen systemkonfiguration.";
$translation['installpage2']['bulgarian']="HIS поддържа няколко вида технологии за бази данни.<br/><br/>

Всички сиво Записите по-долу не са съвместими със сегашната си конфигурация на системата.";
$translation['installpage2']['chinesesimplified']="其支持多种类型的数据库技术。时<br/><br/>

任何灰色的条目下面是与你当前的系统配置不兼容。";
$translation['installpage2']['chinesetraditional']="其支持多種類型的數據庫技術。時<br/><br/>

任何灰色的條目下面是與你當前的系統配置不兼容。";



$translation['Human Intelligence System']['english']="Human Intelligence System";
$translation['Human Intelligence System']['german']="Human Intelligence System";
$translation['Human Intelligence System']['bulgarian']="Система за човешкия интелект";
$translation['Human Intelligence System']['chinesesimplified']="人类智能系统";
$translation['Human Intelligence System']['chinesetraditional']="人類智能系統";
$translation['Human Intelligence System']['afrikaans']="Menslike Intelligensie System";
$translation['Human Intelligence System']['albanian']="Sistemi Njerëzore Inteligjencës";
$translation['Human Intelligence System']['arabic']="الإنسان الاستخبارات نظام";
$translation['Human Intelligence System']['armenian']="Human Intelligence System";
$translation['Human Intelligence System']['azerbaijani']="İnsan Intelligence sistemi";
$translation['Human Intelligence System']['basque']="Giza Adimen Sistema";
$translation['Human Intelligence System']['belarusian']="Сістэмы чалавека Intelligence";
$translation['Human Intelligence System']['bengali']="হিউম্যান ইন্টেলিজেন্স সিস্টেম";
$translation['Human Intelligence System']['catalan']="Sistema d'Intel · ligència Humana";
$translation['Human Intelligence System']['croatian']="Ljudski Obavještajni Sustav";
$translation['Human Intelligence System']['czech']="Human Intelligence System";
$translation['Human Intelligence System']['danish']="Human Intelligence System";
$translation['Human Intelligence System']['dutch']="Human Intelligence System";
$translation['Human Intelligence System']['esperanto']="Homaj Inteligenteco Sistemo";
$translation['Human Intelligence System']['estonian']="Human Intelligence System";
$translation['Human Intelligence System']['filipino']="Human Intelligence System";
$translation['Human Intelligence System']['finnish']="Human Intelligence System";
$translation['Human Intelligence System']['french']="Système de Renseignement Humain";
$translation['Human Intelligence System']['galician']="Sistema de Intelixencia Humana";
$translation['Human Intelligence System']['georgian']="ადამიანის დაზვერვის სისტემის";
$translation['Human Intelligence System']['greek']="Ανθρώπινο Σύστημα Πληροφοριών";
$translation['Human Intelligence System']['gujarati']="હ્યુમન ઇન્ટેલીજન્સ સિસ્ટમ";
$translation['Human Intelligence System']['hatiancreole']="Imèn Entèlijans Sistèm";
$translation['Human Intelligence System']['hebrew']="מערכת אינטליגנציה אנושית";
$translation['Human Intelligence System']['hindi']="मानव खुफिया प्रणाली";
$translation['Human Intelligence System']['hungarian']="Az Emberi Intelligencia Rendszer";
$translation['Human Intelligence System']['icelandic']="Human Intelligence System";
$translation['Human Intelligence System']['indonesian']="Manusia Sistem Intelijen";
$translation['Human Intelligence System']['irish']="Córas Faisnéise Daonna";
$translation['Human Intelligence System']['italian']="L'intelligenza del sistema umano";
$translation['Human Intelligence System']['japanese']="人間の知能システム";
$translation['Human Intelligence System']['kannada']="ಹ್ಯೂಮನ್ ಇಂಟೆಲಿಜೆನ್ಸ್ ವ್ಯವಸ್ಥೆ";
$translation['Human Intelligence System']['korean']="인간 지능 시스템";
$translation['Human Intelligence System']['lao']="ລະບົບທາງຂອງມະນຸດ";
$translation['Human Intelligence System']['latin']="Humanum Intelligentia System";
$translation['Human Intelligence System']['latvian']="Cilvēka Intelligence System";
$translation['Human Intelligence System']['lithuanian']="Žmogaus Intelektas Sistema";
$translation['Human Intelligence System']['macedonian']="Човечки разузнавачки систем";
$translation['Human Intelligence System']['malay']="Sistem Risikan Manusia";
$translation['Human Intelligence System']['maltese']="Sistema tal-Bniedem Intelligence";
$translation['Human Intelligence System']['norwegian']="Menneskelig Intelligence System";
$translation['Human Intelligence System']['persian']="سیستم هوش انسانی";
$translation['Human Intelligence System']['polish']="Human Intelligence Systemu";
$translation['Human Intelligence System']['portuguese']="Sistema de Inteligência Humana";
$translation['Human Intelligence System']['romanian']="Human Intelligence System";
$translation['Human Intelligence System']['russian']="Системы человека Intelligence";
$translation['Human Intelligence System']['serbian']="Људска интелигенција система";
$translation['Human Intelligence System']['slovak']="Human Intelligence System";
$translation['Human Intelligence System']['slovenian']="Human Intelligence System";
$translation['Human Intelligence System']['spanish']="Sistema de Inteligencia Humana";
$translation['Human Intelligence System']['swahili']="Binadamu Intelligence System";
$translation['Human Intelligence System']['swedish']="Mänsklig intelligens System";
$translation['Human Intelligence System']['tamil']="மனித புலனாய்வு அமைப்பு";
$translation['Human Intelligence System']['telugu']="మానవ మేధస్సు వ్యవస్థ";
$translation['Human Intelligence System']['thai']="ระบบความฉลาดของมนุษย์";
$translation['Human Intelligence System']['turkish']="İnsan İstihbarat Sistemi";
$translation['Human Intelligence System']['ukrainian']="Системи людини Intelligence";
$translation['Human Intelligence System']['urdu']="انسانی انٹیلی جنس کے نظام";
$translation['Human Intelligence System']['vietnamese']="Hệ thống Human Intelligence";
$translation['Human Intelligence System']['welsh']="System Cudd-wybodaeth Ddynol";
$translation['Human Intelligence System']['yiddish']="מענטש ינטעלליגענסע סיסטעם";

$translation['HIS']['english']="HIS";
$translation['HIS']['german']="HIS";
$translation['HIS']['bulgarian']="СЧИ";
$translation['HIS']['chinesesimplified']="HIS";
$translation['HIS']['chinesetraditional']="HIS";
$translation['HIS']['afrikaans']="MISystem";
$translation['HIS']['albanian']="SNI";
$translation['HIS']['arabic']="HIS";
$translation['HIS']['armenian']="HIS";
$translation['HIS']['azerbaijani']="İIS";
$translation['HIS']['basque']="GAS";
$translation['HIS']['belarusian']="СЧI";
$translation['HIS']['bengali']="HIS";
$translation['HIS']['catalan']="SIH";
$translation['HIS']['croatian']="LOS";
$translation['HIS']['czech']="HIS";
$translation['HIS']['danish']="HIS";
$translation['HIS']['dutch']="HIS";
$translation['HIS']['esperanto']="HIS";
$translation['HIS']['estonian']="HIS";
$translation['HIS']['filipino']="HIS";
$translation['HIS']['finnish']="HIS";
$translation['HIS']['french']="SRH";
$translation['HIS']['galician']="SIH";
$translation['HIS']['georgian']="HIS";
$translation['HIS']['greek']="ΑΣΠ";
$translation['HIS']['gujarati']="HIS";
$translation['HIS']['hatiancreole']="IES";
$translation['HIS']['hebrew']="HIS";
$translation['HIS']['hindi']="मखप";
$translation['HIS']['hungarian']="EIR";
$translation['HIS']['icelandic']="HIS";
$translation['HIS']['indonesian']="MSI";
$translation['HIS']['irish']="CFD";
$translation['HIS']['italian']="ISU";
$translation['HIS']['japanese']="HIS";
$translation['HIS']['kannada']="HIS";
$translation['HIS']['korean']="HIS";
$translation['HIS']['lao']="HIS";
$translation['HIS']['latin']="HIS";
$translation['HIS']['latvian']="CIS";
$translation['HIS']['lithuanian']="ŽIS";
$translation['HIS']['macedonian']="ЧРС";
$translation['HIS']['malay']="SRM";
$translation['HIS']['maltese']="SBI";
$translation['HIS']['norwegian']="MIS";
$translation['HIS']['persian']="HIS";
$translation['HIS']['polish']="HIS";
$translation['HIS']['portuguese']="SIH";
$translation['HIS']['romanian']="HIS";
$translation['HIS']['russian']="СЧI";
$translation['HIS']['serbian']="ЉИС";
$translation['HIS']['slovak']="HIS";
$translation['HIS']['slovenian']="HIS";
$translation['HIS']['spanish']="SIH";
$translation['HIS']['swahili']="BIS";
$translation['HIS']['swedish']="MIS";
$translation['HIS']['tamil']="மபஅ";
$translation['HIS']['telugu']="HIS";
$translation['HIS']['thai']="HIS";
$translation['HIS']['turkish']="İİS";
$translation['HIS']['ukrainian']="СЛI";
$translation['HIS']['urdu']="HIS";
$translation['HIS']['vietnamese']="THI";
$translation['HIS']['welsh']="SWD";
$translation['HIS']['yiddish']="HIS";


$translation['iso639']['english']="en";
$translation['iso639']['german']="de";
$translation['iso639']['bulgarian']="bg";
$translation['iso639']['chinesesimplified']="zh";
$translation['iso639']['chinesetraditional']="zh";
$translation['iso639']['afrikaans']="af";
$translation['iso639']['albanian']="sq";
$translation['iso639']['arabic']="ar";
$translation['iso639']['armenian']="hy";
$translation['iso639']['azerbaijani']="az";
$translation['iso639']['basque']="eu";
$translation['iso639']['belarusian']="bl";
$translation['iso639']['bengali']="bn";
$translation['iso639']['catalan']="ca";
$translation['iso639']['croatian']="hr";
$translation['iso639']['czech']="cs";
$translation['iso639']['danish']="da";
$translation['iso639']['dutch']="nl";
$translation['iso639']['esperanto']="eo";
$translation['iso639']['estonian']="et";
$translation['iso639']['filipino']="fp";
$translation['iso639']['finnish']="fi";
$translation['iso639']['french']="fr";
$translation['iso639']['galician']="gl";
$translation['iso639']['georgian']="ka";
$translation['iso639']['greek']="el";
$translation['iso639']['gujarati']="gu";
$translation['iso639']['hatiancreole']="ht";
$translation['iso639']['hebrew']="he";
$translation['iso639']['hindi']="hi";
$translation['iso639']['hungarian']="hu";
$translation['iso639']['icelandic']="is";
$translation['iso639']['indonesian']="id";
$translation['iso639']['irish']="ga";
$translation['iso639']['italian']="it";
$translation['iso639']['japanese']="ja";
$translation['iso639']['kannada']="kn";
$translation['iso639']['korean']="ko";
$translation['iso639']['lao']="";
$translation['iso639']['latin']="la";
$translation['iso639']['latvian']="lv";
$translation['iso639']['lithuanian']="lt";
$translation['iso639']['macedonian']="mk";
$translation['iso639']['malay']="ms";
$translation['iso639']['maltese']="mt";
$translation['iso639']['norwegian']="no";
$translation['iso639']['persian']="";
$translation['iso639']['polish']="pl";
$translation['iso639']['portuguese']="pt";
$translation['iso639']['romanian']="ro";
$translation['iso639']['russian']="ru";
$translation['iso639']['serbian']="sr";
$translation['iso639']['slovak']="sk";
$translation['iso639']['slovenian']="sl";
$translation['iso639']['spanish']="es";
$translation['iso639']['swahili']="sw";
$translation['iso639']['swedish']="sv";
$translation['iso639']['tamil']="ta";
$translation['iso639']['telugu']="te";
$translation['iso639']['thai']="th";
$translation['iso639']['turkish']="tr";
$translation['iso639']['ukrainian']="uk";
$translation['iso639']['urdu']="ur";
$translation['iso639']['vietnamese']="vi";
$translation['iso639']['welsh']="cy";
$translation['iso639']['yiddish']="yi";


$translation['view problems']['english']="view problems";
$translation['view problems']['german']="sehen probleme";
$translation['view problems']['bulgarian']="видите проблеми";
$translation['view problems']['chinesesimplified']="查看问题";
$translation['view problems']['chinesetraditional']="查看問題";


$translation['go back']['english']="Go Back";
$translation['go back']['german']="Zuruckgehen";
$translation['go back']['bulgarian']="Върни се назад";
$translation['go back']['chinesesimplified']="返回";
$translation['go back']['chinesetraditional']="返回";
$translation['go back']['telugu']="తిరిగి వెళ్ళు";


$translation['submit']['english']="Submit";
$translation['submit']['german']="Einreichen";
$translation['submit']['bulgarian']="Подаване";
$translation['submit']['chinesesimplified']="提交";
$translation['submit']['chinesetraditional']="提交";
$translation['submit']['telugu']="Submit";

$translation['Submit']['english']="Submit";
$translation['Submit']['german']="Einreichen";
$translation['Submit']['bulgarian']="Подаване";
$translation['Submit']['chinesesimplified']="提交";
$translation['Submit']['chinesetraditional']="提交";
$translation['Submit']['telugu']="Submit";


$translation['installpage3']['english']="HIS supports several types of file storage technologies.<br/><br/>

Any grayed-out entries below are not compatible with your current system configuration.";
$translation['installpage3']['german']="HIS unterstützt mehrere Arten von Datei-Storage-Technologien.<br/><br/>

Alle ausgegrauten Einträge unterhalb sind nicht kompatibel mit der aktuellen Systemkonfiguration.";
$translation['installpage3']['bulgarian']="Поддържа няколко вида технологии за съхранение на файлове. <br/> <br/>

Всички сиво Записите по-долу не са съвместими със сегашната си конфигурация на системата.";
$translation['installpage3']['chinesesimplified']="HIS支持多种类型的文件存储技术。<br/><br/>

任何灰色的条目下面是与你当前的系统配置不兼容。";
$translation['installpage3']['chinesetraditional']="HIS支持多種類型的文件存儲技術。<br/><br/>

任何灰色的條目下面是與你當前的系統配置不兼容。";


$translation['installpage4']['english']="HIS supports several types of file storage technologies.<br/><br/>

Any grayed-out entries below are not compatible with your current system configuration.";
$translation['installpage4']['german']="HIS unterstützt verschiedene Arten von Datei-Storage-Technologien.<br/><br/>

Alle ausgegrauten Einträge unten sind nicht kompatibel mit der aktuellen Systemkonfiguration.";
$translation['installpage4']['bulgarian']="HIS подкрепя няколко типа технологии за съхранение на файлове.<br/><br/>

Всички в сив цвят вписванията по-долу не са съвместими със сегашната си конфигурация на системата.";
$translation['installpage4']['chinesesimplified']="HIS支持几种类型的文件存储技术。<br/><br/>

任何变灰条目下面与您当前的系统配置不兼容。";
$translation['installpage4']['chinesetraditional']="HIS支持幾種類型的文件存儲技術。<br/><br/>

任何變灰條目下面與您當前的系統配置不兼容。";



$translation['enter database details']['english']="Below you should enter your database connection details. If you're not sure about these, contact your host.";
$translation['enter database details']['german']="Im Folgenden finden Sie sollten geben Sie Ihre Datenbank Details. Wenn Sie nicht sicher über diese sind, wenden Sie Ihrem Gastgeber.";
$translation['enter database details']['bulgarian']="Долу трябва да въведете своите данни за връзка с база данни. Ако не сте сигурни за тези, свържете се с вашия хост.";
$translation['enter database details']['chinesesimplified']="你应该在下面输入数据库连接的详细信息。如果你不知道关于这些，请联系您的主机。";
$translation['enter database details']['chinesetraditional']="你應該在下面輸入數據庫連接的詳細信息。如果你不知道關於這些，請聯繫您的主機。";



$translation['Database Type']['english']="Database Type";
$translation['Database Type']['german']="Database Type";
$translation['Database Type']['bulgarian']="Вид база данни";
$translation['Database Type']['chinesesimplified']="数据库类型";
$translation['Database Type']['chinesetraditional']="數據庫類型";

$translation['Database Host']['english']="Database Host";
$translation['Database Host']['german']="Datenbank-Host";
$translation['Database Host']['bulgarian']="хост базата данни";
$translation['Database Host']['chinesesimplified']="数据库主机";
$translation['Database Host']['chinesetraditional']="數據庫主機";

$translation['User Name']['english']="User Name";
$translation['User Name']['german']="User Name";
$translation['User Name']['bulgarian']="потребителско име";
$translation['User Name']['chinesesimplified']="用户名";
$translation['User Name']['chinesetraditional']="用戶名";

$translation['Password']['english']="Password";
$translation['Password']['german']="Kennwort";
$translation['Password']['bulgarian']="парола";
$translation['Password']['chinesesimplified']="密码";
$translation['Password']['chinesetraditional']="密碼";


$translation['Database Name']['english']="Database Name";
$translation['Database Name']['german']="Database Name";
$translation['Database Name']['bulgarian']="Име на базата данни";
$translation['Database Name']['chinesesimplified']="数据库名称";
$translation['Database Name']['chinesetraditional']="數據庫名稱";

$translation['Table Prefix']['english']="Table Prefix";
$translation['Table Prefix']['german']="Table Prefix";
$translation['Table Prefix']['bulgarian']="Таблица префикс";
$translation['Table Prefix']['chinesesimplified']="表前缀";
$translation['Table Prefix']['chinesetraditional']="表前綴";

$translation['Your database type.']['english']="Your database type.";
$translation['Your database type.']['german']="Ihre Datenbank-Typ.";
$translation['Your database type.']['bulgarian']="Вашата база данни тип.";
$translation['Your database type.']['chinesesimplified']="您的数据库类型。";
$translation['Your database type.']['chinesetraditional']="您的數據庫類型。";


$translation['You should be able to get this info from your web host, if localhost does not work.']['english']="You should be able to get this info from your web host, if localhost does not work.";
$translation['You should be able to get this info from your web host, if localhost does not work.']['german']="Sie sollten in der Lage sein, diese Informationen von Ihrem Webhoster bekommen, wenn localhost nicht funktioniert.";
$translation['You should be able to get this info from your web host, if localhost does not work.']['bulgarian']="Вие трябва да бъдете в състояние да получи тази информация от вашия уеб-домакин, ако Localhost не работи.";
$translation['You should be able to get this info from your web host, if localhost does not work.']['chinesesimplified']="你应该能够得到这个信息从您的虚拟主机'localhost'的，如果不工作。";
$translation['You should be able to get this info from your web host, if localhost does not work.']['chinesetraditional']="你應該能夠得到這個信息從您的虛擬主機'localhost'的，如果不工作。";

$translation['Your database username']['english']="Your database username";
$translation['Your database username']['german']="Ihre Datenbank-Benutzernamen";
$translation['Your database username']['bulgarian']="Вашата база данни име";
$translation['Your database username']['chinesesimplified']="你的数据库用户名";
$translation['Your database username']['chinesetraditional']="你的數據庫用戶名";

$translation['...and your database password.']['english']="...and your database password.";
$translation['...and your database password.']['german']="... und Ihre Datenbank-Passwort.";
$translation['...and your database password.']['bulgarian']="... и парола за базата данни.";
$translation['...and your database password.']['chinesesimplified']="和你的数据库密码。";
$translation['...and your database password.']['chinesetraditional']="和你的數據庫密碼。";

$translation['The name of the database you want to run HIS in. Database needs to exist already.']['english']="The name of the database you want to run HIS in. Database needs to exist already.";
$translation['The name of the database you want to run HIS in. Database needs to exist already.']['german']="Der Name der Datenbank, die Sie HIS in. Database ausführen muss bereits vorhanden sein.";
$translation['The name of the database you want to run HIS in. Database needs to exist already.']['bulgarian']="Името на базата данни, която искате да стартирате инча база данни трябва да съществува вече.";
$translation['The name of the database you want to run HIS in. Database needs to exist already.']['chinesesimplified']="你想运行HIS英寸数据库的数据库的名称必须已经存在。";
$translation['The name of the database you want to run HIS in. Database needs to exist already.']['chinesetraditional']="你想運行HIS英寸數據庫的數據庫的名稱必須已經存在。";


$translation['If you want to run multiple HIS installations in a single database, change this.']['english']="If you want to run multiple HIS installations in a single database, change this.";
$translation['If you want to run multiple HIS installations in a single database, change this.']['german']="Wenn Sie mehrere seiner Installationen in einer einzigen Datenbank ausführen möchten, ändern.";
$translation['If you want to run multiple HIS installations in a single database, change this.']['bulgarian']="Ако искате да стартирате няколко инсталации в единна база данни, да промените това.";
$translation['If you want to run multiple HIS installations in a single database, change this.']['chinesesimplified']="如果你想在一个数据库中运行多个HIS安装，改变这种状况。";
$translation['If you want to run multiple HIS installations in a single database, change this.']['chinesetraditional']="如果你想在一個數據庫中運行多個HIS安裝，改變這種狀況。";


$translation['AWS Access Key']['english']="AWS Access Key";
$translation['AWS Access Key']['german']="AWS Access Key";
$translation['AWS Access Key']['bulgarian']="AWS клавиш за достъп";
$translation['AWS Access Key']['chinesesimplified']="AWS访问密钥";
$translation['AWS Access Key']['chinesetraditional']="AWS訪問密鑰";

$translation['AWS Secret Key']['english']="AWS Access Key";
$translation['AWS Secret Key']['german']="AWS Secret Key";
$translation['AWS Secret Key']['chinesesimplified']="AWS密钥";
$translation['AWS Secret Key']['chinesetraditional']="AWS密鑰";
$translation['AWS Secret Key']['bulgarian']="AWS Secret Key";

$translation['Your AWS Access Key. Never share with anyone.']['english']="Your AWS Access Key. Never share with anyone.";
$translation['Your AWS Access Key. Never share with anyone.']['german']="Ihre AWS Access Key. Nie mit jemandem zu teilen.";
$translation['Your AWS Access Key. Never share with anyone.']['bulgarian']="Вашият AWS ключ за достъп. Никога не споделяйте с никого.";
$translation['Your AWS Access Key. Never share with anyone.']['chinesesimplified']="您的AWS访问密钥。不要与任何人共享。";
$translation['Your AWS Access Key. Never share with anyone.']['chinesetraditional']="您的AWS訪問密鑰。不要與任何人共享。";

$translation['Your AWS Secret Key.  Never share with anyone.']['english']="Your AWS Secret Key.  Never share with anyone.";
$translation['Your AWS Secret Key.  Never share with anyone.']['german']="Ihre AWS Secret Key. Nie mit jemandem zu teilen.";
$translation['Your AWS Secret Key.  Never share with anyone.']['bulgarian']="Вашият AWS таен ключ. Никога не споделяйте с никого.";
$translation['Your AWS Secret Key.  Never share with anyone.']['chinesesimplified']="您的AWS密钥。不要与任何人共享。";
$translation['Your AWS Secret Key.  Never share with anyone.']['chinesetraditional']="您的AWS密鑰。不要與任何人共享。";


$translation['installpage1']['english']="Welcome to Human Intelligence System.<br/><br/>

Let's create a his-config.php text file for you!<br/><br/>

Before getting started, we need some information on the database. You will need to know the following items before proceeding.<br/>

<table width='100%'><tr>
<td valign='top' width='50%'><p>
1. Database name<br/>
2. Database type<br/>
3. Database username<br/>
4. Database password<br/>
5. Database host<br/>
6. Table prefix
</p></td>
<td valign='top'><p>
1. Storage provider (your hard drive, S3, Rackspace?)<br/>
2. Storage address (folder name, bucket name?)<br/>
3. Storage username<br/>
4. Storage password
</p>
</td>
</tr></table>
<p>

If for any reason this automatic file creation doesn't work, don't worry. All this does is fill in the database information to a configuration file. You may also simply open his-config-sample.php in a text editor, fill in your information, and save it as his-config.php.<br/><br/>

In all likelihood, these items were supplied to you by your Web Host. If you do not have this information, then you will need to contact them before you can continue. If you’re all ready...";
$translation['installpage1']['german']="Welcome to Human Intelligence System.<br/><br/>

Lassen Sie uns eine his-config.php Textdatei für Sie!<br/><br/>

Bevor Sie beginnen, benötigen wir einige Angaben in der Datenbank. Sie müssen die folgenden Punkte, bevor Sie fortfahren kennen.<br/><br/>

<table width='100%'><tr>
<td valign='top' width='50%'><p>
1. Name der Datenbank<br/>
2. Datenbank-Typ<br/>
3. Database username<br/>
4. Datenbank-Passwort<br/>
5. Datenbank-Host<br/>
6. Tabellenpräfix
</p></td>
<td valign='top'><p>
1. Storage Provider (Festplatte, S3, Rackspace?)<br/>
2. Storage-Adresse (Ordnernamen, Eimer Namen?)<br/>
3. Lagerung username<br/>
4. Lagerung vergessen
</p>
</td>
</tr></table>
<p>

Wenn aus irgendeinem Grund diese automatische Erstellung der Datei nicht funktioniert, mach dir keine Sorgen. All dies wird in der Datenbank Informationen zu einer Konfigurationsdatei zu füllen. Sie können auch einfach öffnen his-config-sample.php in einem Text-Editor, füllen Sie Ihre Daten, und speichern Sie es als seine-config.php.<br/><br/>

Aller Wahrscheinlichkeit nach wurden diese Artikel die Ihnen von Ihrem Web-Host geliefert. Wenn Sie nicht über diese Informationen verfügen, dann werden Sie brauchen, um sie zu kontaktieren, bevor Sie fortfahren können. Wenn Sie alles fertig ...";
$translation['installpage1']['bulgarian']="Добре дошли в системата за човешкия интелект.<br/><br/>

Нека създадем си config.php текстов файл за вас!<br/><br/>

Преди да започнете, имаме нужда от някаква информация в базата данни. Вие ще трябва да знаете следните елементи, преди да продължите.<br/><br/>

<table width='100%'><tr>
<td valign='top' width='50%'><p>
1. име на базата данни<br/>
2. тип на базата данни<br/>
3. Database потребителско име<br/>
4. Database парола<br/>
5. хост базата данни<br/>
6. Таблица префикс
</p></td>
<td valign='top'><p>
1. Съхранение на доставчика (вашия твърд диск, S3, Rackspace?)<br/>
2. За съхранение адрес (името на папката, името на кофата?)<br/>
3. за съхранение потребителско име<br/>
4. съхранение на парола
</p>
</td>
</tr></table>
<p>

Ако по някаква причина това автоматично създаване на файла не работи, не се притеснявайте. Всичко това не е да попълните в базата данни информация за конфигурационен файл. Можете също така просто да си отвори-довереник sample.php в текстов редактор, попълнете данните си и да го запишете като си-config.php.<br/><br/>

По всяка вероятност, тези елементи са предоставени от вашия уеб-домакин. Ако не разполагате с тази информация, тогава ще трябва да се свържете с тях, преди да можете да продължите. Ако сте готови ...";
$translation['installpage1']['chinesesimplified']="欢迎对人类智慧的系统。<br/><br/>

让我们创建一个他的config.php文件的文本文件，你！<br/><br/>

在开始之前，我们需要对数据库的一些信息。您需要知道以下项目，然后再继续。<br/>

<table width='100%'><tr>
<td valign='top' width='50%'><p>
1。数据库名称<br/>
2。数据库类型<br/>
3。数据库用户名<br/>
4。数据库密码<br/>
5。数据库主机
6。表前缀
</p></td>
<td valign='top'><p>
1。存储供应商（你的硬盘，S3，Rackspace公司？）<br/>
2。存储地址（文件夹名称，桶的名字吗？）<br/>
3。存储的用户名<br/>
4。存储密码
</p>
</td>
</tr></table>
<p>

如果出于任何原因，这个文件自动创建不工作，也不用担心。这一切并填写在资料库中的配置文件。您也可以简单地在文本编辑器打开他的config-sample.php文件，填写您的信息，并保存它的config.php文件。<br/>

在所有的可能性，这些项目提供给您，您的虚拟主机。如果你没有这样的信息，那么您将需要与他们联络，然后才可以继续。如果你都准备好了......";
$translation['installpage1']['chinesetraditional']="歡迎對人類智慧的系統。<br/><br/>

讓我們創建一個他his-config.php文件的文本文件，你！<br/><br/>

在開始之前，我們需要對數據庫的一些信息。您需要知道以下項目，然後再繼續。<br/><br/>

<table width='100%'><tr>
<td valign='top' width='50%'><p>
1。數據庫名稱<br/>
2。數據庫類型<br/>
3。數據庫用戶名<br/>
4。數據庫密碼<br/>
5。數據庫主機<br/>
6。表前綴
</p></td>
<td valign='top'><p>
1。存儲供應商（你的硬盤，S3，Rackspace公司？）<br/>
2。存儲地址（文件夾名稱，桶的名字嗎？）<br/>
3。存儲的用戶名<br/>
4。存儲密碼
</p>
</td>
</tr></table>
<p>

如果出於任何原因，這個文件自動創建不工作，也不用擔心。這一切並填寫在資料庫中的配置文件。您也可以簡單地在文本編輯器打開他的config-sample.php文件，填寫您的信息，並保存它的config.php文件。<br/><br/>

在所有的可能性，這些項目提供給您，您的虛擬主機。如果你沒有這樣的信息，那麼您將需要與他們聯絡，然後才可以繼續。如果你都準備好了......";
$translation['installpage1']['telugu']="మానవ మేధస్సు వ్యవస్థ స్వాగతం.<br/><br/>

యొక్క మీకు his-config.php టెక్స్ట్ ఫైల్ సృష్టించడానికి తెలపండి!<br/><br/>

ప్రారంభించే ముందు, మేము డేటాబేస్ లో కొంత సమాచారం కావాలి. మీరు కొనసాగే ముందు ఈ క్రింది అంశాలను తెలుసు ఉంటుంది.<br/><br/>

<table width='100%'><tr>
<td valign='top' width='50%'><p>
1. డేటాబేస్ పేరు<br/>
2. డేటాబేస్ రకం<br/>
3. డేటాబేస్ యూజర్పేరు<br/>
4. డేటాబేస్ పాస్వర్డ్ను<br/>
5. డేటాబేస్ హోస్ట్<br/>
6. టేబుల్ ఉపసర్గ
</p></td>
<td valign='top'><p>
1. నిల్వ ప్రొవైడర్ (మీ హార్డు డ్రైవు, S3, రాక్స్పేస్?)<br/>
2. నిల్వ చిరునామా (ఫోల్డర్ పేరు, బకెట్ పేరు?)<br/>
3. నిల్వ యూజర్పేరు<br/>
4. నిల్వ పాస్వర్డ్ను
</p>
</td>
</tr></table>
<p>

ఏ కారణం ఈ ఆటోమేటిక్ ఫైలు సృష్టి పని చెయ్యకపోతే, ఆందోళన చెందకండి. ఈ ఆకృతీకరణ ఫైలును డేటాబేస్ సమాచారాన్ని పూరించండి ఉంది లేదు. మీరు కూడా మీ సమాచారాన్ని పూరించండి, ఒక టెక్స్ట్ ఎడిటర్ లో తన-config-sample.php తెరిచి, his-config.php, సేవ్ చేయవచ్చు.<br/><br/>

అన్ని సంభావ్యత లో, ఈ అంశాలు మీ వెబ్ హోస్ట్ ద్వారా మీరు సరఫరా చేయబడ్డాయి. మీరు ఈ సమాచారం లేకపోతే మీరు కొనసాగించడానికి ముందు, మీరు వారిని సంప్రదించండి ఉంటుంది. మీరు అన్ని సిద్ధంగా ఉంటే ...";



$translation['installdbfail']['english']="This either means that the username and password information in your his-config.php file is incorrect or we can't contact the database server. This could mean your host's database server is down.<br/><br/>

- Are you sure you have the correct username and password?<br/>
- Are you sure that you have typed the correct hostname?<br/>
- Are you sure that the database server is running?<br/><br/><br/>

If you're unsure what these terms mean you should probably contact your host. If you still need help you can always visit the";
$translation['installdbfail']['german']="Das bedeutet entweder, dass der Benutzername und das Kennwort in Ihrem his-config.php falsch sind oder wir können nicht an den Datenbank-Server. Dies könnte bedeuten, dass Ihre Host-Datenbank-Server ausgefallen ist.<br/><br/>

- Sind Sie sicher, dass Sie den richtigen Benutzernamen und Passwort?<br/>
- Sind Sie sicher, dass Sie den richtigen Hostnamen eingegeben?<br/>
- Sind Sie sicher, dass der Datenbankserver läuft?<br/><br/>

Wenn Sie unsicher sind, was diese Begriffe bedeuten, sollten Sie vielleicht bei Ihrem Gastgeber. Wenn Sie weitere Hilfe benötigen können Sie jederzeit besuchen die";
$translation['installdbfail']['bulgarian']="Това означава или, че потребителското име и паролата в си-config.php файл е неточна или не можем да се свърже със сървъра на базата данни. Това може да означава на вашия хост сървъра на базата данни е надолу.<br/><br/>

- Сигурни ли сте, имате правилното потребителско име и парола?<br/>
- Сигурен ли сте, че сте въвели правилно името на хоста?<br/>
- Сигурен ли сте, че сървъра на базата данни работи?<br/><br/>

Ако не сте сигурни какво означават тези термини, вероятно ще трябва да се свържете с вашия хост. Ако все още се нуждаят от помощ, винаги можете да посетите";
$translation['installdbfail']['chinesesimplified']="这意味着两种情况，要么his-config.php文件中的用户名和密码信息是不正确的，否则我们无法联系数据库服务器。这可能意味着您的主机的数据库服务器。<br/><br/>

- 你确定你有正确的用户名和密码？<br/>
- 你确定你输入了正确的主机名？<br/>
- 你是确保数据库服务器正在运行时<br/><br/>

如果你不确定这些条款是什么意思，你应该联系你的主机。如果你还需要帮助，你可以随时访问";






$translation['installfsfail']['english']="This either means that the username and password information in your his-config.php file is incorrect or we can't connect to the file storage server. This could mean the file storage server is down.<br/><br/>

- Are you sure you have the correct username and password (if applicable)?<br/>
- Are you sure that you have typed the correct hostname?<br/>
- Are you sure that the file storage server is running?<br/><br/><br/>

If you're unsure what these terms mean you should probably contact your host. If you still need help you can always visit the";
$translation['installfsfail']['german']="Das bedeutet entweder, dass der Benutzername und das Kennwort in Ihrem his-config.php falsch sind oder wir können nicht in die Datei Storage-Server zu verbinden. Dies könnte bedeuten, dass die Speicherung von Dateien Server heruntergefahren ist. <br/>

- Sind Sie sicher, dass Sie den richtigen Benutzernamen und das Kennwort ein (falls zutreffend) <br/>?
- Sind Sie sicher, dass Sie den richtigen Hostnamen eingegeben <br/>?
- Sind Sie sicher, dass die Datei Storage Server läuft <br/> <br/>

Wenn Sie unsicher sind, was diese Begriffe bedeuten, sollten Sie vielleicht bei Ihrem Gastgeber. Wenn Sie weitere Hilfe benötigen können Sie jederzeit besuchen die";
$translation['installfsfail']['bulgarian']="Това означава или, че потребителското име и паролата в his-config.php файл е неточна или не може да се свърже към сървъра за съхранение на файлове.Това може да означава файлов сървър за съхранение. <br/> <br/>

- Сигурни ли сте, имате правилното потребителско име и парола (ако е приложимо) <br/>?
- Сигурен ли сте, че сте въвели правилно името на хоста <br/>?
- Сигурни ли сте, файлов сървър за съхранение работи <br/> <br/> <br/>

Ако не сте сигурни какво означават тези термини, вероятно ще трябва да се свържете с вашия хост. Ако все още се нуждаят от помощ, винаги можете да посетите";
$translation['installfsfail']['chinesesimplified']="这意味着两种情况，要么his-config.php文件中的用户名和密码信息是不正确的，否则我们无法连接到文件存储服务器。这可能意味着文件存储服务器已关闭。<br/> <br/>

- 你确定你有正确的用户名和密码（如果适用的话）？<br/>
- 你确定你输入了正确的主机名？<br/>
- 你确定该文件存储服务器正在运行？时<br/><br/>

如果你不确定这些条款是什么意思，你应该联系你的主机。如果你还需要帮助，你可以随时访问";








$translation['installmsfail']['english']="This either means that the username and password information in your his-config.php file is incorrect or we can't connect to the message queue server. This could mean the message queue server is down.<br/><br/>

- Are you sure you have the correct username and password (if applicable)?<br/>
- Are you sure that you have typed the correct hostname?<br/>
- Are you sure that the message queue server is running?<br/><br/><br/>

If you're unsure what these terms mean you should probably contact your host. If you still need help you can always visit the";
$translation['installmsfail']['german']="Dies bedeutet, dass entweder der Benutzername und das Passwort in der Datei his-config.php falsch ist, oder wir können nicht auf die Message-Queue-Server herstellen. Dies könnte bedeuten, dass die Message Queue Server heruntergefahren ist.<br/><br/>

- Sind Sie sicher, dass Sie den richtigen Benutzernamen und das Kennwort ein (falls zutreffend)?<br/>
- Sind Sie sicher, dass Sie den richtigen Hostnamen eingegeben?<br/>
- Sind Sie sicher, dass die Message-Queue-Server läuft?<br/><br/>

Wenn Sie unsicher sind, was diese Begriffe bedeuten, sollten Sie vielleicht bei Ihrem Gastgeber. Wenn Sie weitere Hilfe benötigen können Sie jederzeit besuchen die";
$translation['installmsfail']['bulgarian']="Това или означава, че потребителското име и парола във файла his-config.php е неточна или не можем да се свърже към сървъра съобщение опашката. Това би могло да означава, че сървърът съобщение опашката е надолу.<br/> <br/>

- Сигурни ли сте, имате правилното потребителско име и парола (ако е приложимо) <br/>?
- Сигурен ли сте, че сте въвели правилно името на хоста <br/>
- Сигурни ли сте, че сървърът съобщение опашка работи?<br/><br/>

Ако не сте сигурни какво означават тези термини, вероятно ще трябва да се свържете с вашия хост. Ако все още се нуждаят от помощ, винаги можете да посетите";
$translation['installmsfail']['chinesesimplified']="这意味着两种情况，要么his-config.php文件中的用户名和密码信息是不正确的，或者我们不能连接到消息队列服务器。这可能意味着，消息队列服务器。<br/><br/>

- 你确定你有正确的用户名和密码（如果适用的话）？<br/>
- 你确定你输入了正确的主机名？<br/>
- 您确定该消息队列服务器正在运行？<br/><br/>

如果你不确定这些条款是什么意思，你应该联系你的主机。如果你还需要帮助，你可以随时访问";



$translation['Error establishing a database connection']['english']="Error establishing a database connection";
$translation['Error establishing a database connection']['german']="Fehler beim Aufbau einer Datenbankverbindung";
$translation['Error establishing a database connection']['chinesesimplified']="建立数据库连接时出错";
$translation['Error establishing a database connection']['bulgarian']="Грешка при установяване на връзка с базата данни";

$translation['Try Again']['english']="Try Again";
$translation['Try Again']['german']="Try Again";
$translation['Try Again']['bulgarian']="Опитайте отново";
$translation['Try Again']['chinesesimplified']="再试一次";

$translation['Error establishing a file storage connection']['english']="Error establishing a file storage connection";
$translation['Error establishing a file storage connection']['german']="Fehler beim Aufbau einer Datei Storage-Verbindung";
$translation['Error establishing a file storage connection']['bulgarian']="Грешка при установяване на връзка за съхранение на файлове";
$translation['Error establishing a file storage connection']['chinesesimplified']="建立一个文件存储连接时出错";


$translation['file storage details']['english']="Below you should enter your file storage connection details. If you're not sure about these, contact our forums.";
$translation['file storage details']['german']="Im Folgenden finden Sie sollten geben Sie Ihre Dateiablage Anschlussdetails. Wenn Sie nicht sicher über diese sind, wenden unserem Forum.";
$translation['file storage details']['chinesesimplified']="你应该在下面输入您的文件存储连接的详细信息。如果你不知道关于这些，请联系我们的论坛。";
$translation['file storage details']['bulgarian']="По-долу можете да въведете вашите файлови връзка съхранение. Ако не сте сигурни за тези, свържете се с нашите форуми.";

$translation['message queue details']['english']="Below you should enter your message queue connection details. If you're not sure about these, contact our forums.";
$translation['message queue details']['german']="Im Folgenden finden Sie sollten geben Sie Ihre Message Queue Verbindung Details. Wenn Sie nicht sicher über diese sind, wenden unserem Forum.";
$translation['message queue details']['chinesesimplified']="你应该在下面输入您的消息队列连接的详细信息。如果你不知道这些，请联系我们的论坛。";
$translation['message queue details']['bulgarian']="По-долу следва Вашето съобщение детайли връзка опашката. Ако не сте сигурни за това, свържете се с нашите форуми.";


$translation['File Storage Type']['english']="File Storage Type";
$translation['File Storage Type']['german']="Dateispeichertyps";
$translation['File Storage Type']['chinesesimplified']="文件存储类型";
$translation['File Storage Type']['bulgarian']="Вид на файла за съхранение";


$translation['Your file storage system.']['english']="Your file storage system";
$translation['Your file storage system.']['german']="Ihre Dateiablage";
$translation['Your file storage system.']['chinesesimplified']="您的文件存储系统";
$translation['Your file storage system.']['bulgarian']="Вашата система за съхранение на файлове";

$translation['S3 Bucket Name']['english']="S3 Bucket Name";
$translation['S3 Bucket Name']['german']="S3 Bucket Namen";
$translation['S3 Bucket Name']['chinesesimplified']="S3存储桶名称";
$translation['S3 Bucket Name']['bulgarian']="Име на S3 Bucket";

$translation['S3 Input Path']['english']="S3 Input Path";
$translation['S3 Input Path']['german']="S3 Eingang Pfad";
$translation['S3 Input Path']['chinesesimplified']="S3输入路径";
$translation['S3 Input Path']['english']="S3 Input Path";
$translation['S3 Input Path']['bulgarian']="Път на S3 Input";

$translation['S3 Output Path']['english']="S3 Output Path";
$translation['S3 Output Path']['german']="S3 Output Path";
$translation['S3 Output Path']['chinesesimplified']="S3输出路径";
$translation['S3 Output Path']['bulgarian']="Път на S3 изход";

$translation['S3 Saved Strings Path']['english']="S3 Saved Strings Path";
$translation['S3 Saved Strings Path']['german']="S3 gespeichert Strings Pfad";
$translation['S3 Saved Strings Path']['chinesesimplified']="S3保存的字符串路径";
$translation['S3 Saved Strings Path']['bulgarian']="S3 Запазени Strings Path";

$translation['Folder Path']['english']="Folder Path";
$translation['Folder Path']['german']="Folder Path";
$translation['Folder Path']['chinesesimplified']="文件夹路径";
$translation['Folder Path']['bulgarian']="Folder Path";

$translation['Folder on local Hard Disk. Needs to exist already. Make sure apache can write to this folder.']['english']="Folder on local Hard Disk. Needs to exist already. Make sure apache can write to this folder.";
$translation['Folder on local Hard Disk. Needs to exist already. Make sure apache can write to this folder.']['german']="Ordner auf der lokalen Festplatte. Muss bereits vorhanden sein. Stellen Sie sicher, dass Apache kann in diesem Ordner zu schreiben.";
$translation['Folder on local Hard Disk. Needs to exist already. Make sure apache can write to this folder.']['chinesesimplified']="在本地硬盘上的文件夹。需要已经存在。请确保Apache可以写入这个文件夹。";
$translation['Folder on local Hard Disk. Needs to exist already. Make sure apache can write to this folder.']['bulgarian']="Папка на локалния твърд диск. Трябва да съществува вече. Уверете се, че Apache да пишете в тази папка.";



$translation['Input Path']['english']="Input Path";
$translation['Input Path']['german']="Eingang Pfad";
$translation['Input Path']['chinesesimplified']="输入路径";
$translation['Input Path']['bulgarian']="Input Path";

$translation['Output Path']['english']="Output Path";
$translation['Output Path']['german']="Output Path";
$translation['Output Path']['chinesesimplified']="输出路径";
$translation['Output Path']['bulgarian']="Output Path";

$translation['Saved Outputs Path']['english']="Saved Outputs Path";
$translation['Saved Outputs Path']['german']="Gespeichert Ausgänge Pfad";
$translation['Saved Outputs Path']['chinesesimplified']="保存的输出路径";
$translation['Saved Outputs Path']['bulgarian']="Запазени Изходи Path";

$translation['Saved Strings Path']['english']="Saved Strings Path";
$translation['Saved Strings Path']['german']="Gespeichert Strings Pfad";
$translation['Saved Strings Path']['chinesesimplified']="保存的字符串路径";
$translation['Saved Strings Path']['bulgarian']="Запазени Strings Path";


$translation['This does not have to be changed']['english']='This does not have to be changed';
$translation['This does not have to be changed']['german']='Dies muss nicht geändert werden';
$translation['This does not have to be changed']['chinesesimplified']='以被改变，这不具有';
$translation['This does not have to be changed']['bulgarian']='Това не трябва да се промени';

$translation['S3 Saved Outputs Path']['english']="S3 Saved Outputs Path";
$translation['S3 Saved Outputs Path']['german']="S3 gespeichert Ausgänge Pfad";
$translation['S3 Saved Outputs Path']['chinesesimplified']="S3保存的输出路径";
$translation['S3 Saved Outputs Path']['bulgarian']="S3 Запазени Изходи Path";

$translation['S3 Bucket Name to store files in. Needs to exist already.']['english']="S3 Bucket Name to store files in. Needs to exist already.";
$translation['S3 Bucket Name to store files in. Needs to exist already.']['german']="S3 Bucket Namen von Dateien in. Geschäft muss bereits vorhanden sein.";
$translation['S3 Bucket Name to store files in. Needs to exist already.']['chinesesimplified']="S3存储桶的名字来存储文件。需要已经存在。";
$translation['S3 Bucket Name to store files in. Needs to exist already.']['bulgarian']="S3 Име Кофа за съхранение на файлове. Трябва да съществува вече.";

$translation['Welcome']['english']="Welcome";
$translation['Welcome']['german']="Willkommen";
$translation['Welcome']['chinesesimplified']="欢迎";
$translation['Welcome']['bulgarian']="добре дошъл";

$translation['Information needed']['english']="Information needed";
$translation['Information needed']['german']="Benötigte Informationen";
$translation['Information needed']['chinesesimplified']="需要的信息";
$translation['Information needed']['bulgarian']="Необходима Информацията";

$translation['Please provide the following information.']['english']="Please provide the following information. Do not worry, you can always change these settings later.";
$translation['Please provide the following information.']['german']="Bitte geben Sie die folgenden Informationen. Mach dir keine Sorgen, können Sie immer diese Einstellungen später.";
$translation['Please provide the following information.']['chinesesimplified']="请提供以下信息。不要担心，你可以随时更改这些设置。";
$translation['Please provide the following information.']['bulgarian']="Моля, представете следната информация. Не се притеснявайте, винаги можете да промените тези настройки по-късно.";


$translation['Welcome to the instantaneous HIS installation process']['english']="Welcome to the instantaneous HIS installation process! You may want to browse the ReadMe documentation at your leisure. Otherwise, just fill in the information below and you’ll be on your way to using the most extendable and powerful personal API platform in the world.";
$translation['Welcome to the instantaneous HIS installation process']['german']="Willkommen in der momentanen HIS Installation! Vielleicht möchten Sie in der Readme-Dokumentation in Ihrer Freizeit zu durchsuchen. Ansonsten einfach in den Informationen unten ausfüllen und Sie werden auf Ihrem Weg zur Verwendung der meisten erweiterbare und leistungsstarke persönliche API-Plattform in der Welt sein.";
$translation['Welcome to the instantaneous HIS installation process']['chinesesimplified']="欢迎来到瞬间他的安装过程！您要浏览的自述文件在您的休闲。否则，只需填写下面的信息，你就可以用自己的方式在世界上最有弹性和强大的个人API平台。";
$translation['Welcome to the instantaneous HIS installation process']['bulgarian']="Добре дошли в моментната си инсталационния процес! Вие може да искате да разглеждате документацията ReadMe в свободното си време. В противен случай, просто попълнете информацията по-долу, и вие ще бъдете по пътя си към използване на най-разтегателна и мощен лично API платформа в света.";

$translation['cantwrite']['english']="Sorry, but I can't write the his-config.php file.<br/><br/>

You can create the his-config.php manually and paste the following text into it.<br/><br/>

When you create this new his-config.php file, make sure to create it at the following location:";
$translation['cantwrite']['german']="Sorry, aber ich kann nicht schreiben, die his-config.php Datei.<br/><br/>

Sie können die his-config.php manuell erstellen und fügen Sie den folgenden Text hinein.<br/><br/>

Wenn Sie diese neue his-config.php-Datei zu erstellen, stellen Sie sicher, es unter folgender Adresse zu erstellen:";
$translation['cantwrite']['chinesesimplified']="很抱歉，但我不能写他的config.php文件。<br/><br/>

您可以创建自己his-config.php文件手动，并把它粘贴下面的文本。<br/><br/>

当你创建这个新的他his-config.php文件，一定要建立在以下位置：";
$translation['cantwrite']['chinesetraditional']="很抱歉，但我不能寫他的config.php文件。<br/><br/>

您可以創建自己his-config.php文件手動，並把它粘貼下面的文本。<br/><br/>

當你創建這個新的他his-config.php文件，一定要建立在以下位置：";
$translation['cantwrite']['bulgarian']="Съжалявам, но не могат да пишат на си-config.php файл. <br/> <br/>

Можете да създадете му-config.php ръчно и поставете следния текст в него. <br/> <br/>

Когато се създаде тази нова си-config.php файл, уверете се, да го създаде на следния адрес:";




$translation['Username']['english']="Username";
$translation['Username']['german']="Benutzername";
$translation['Username']['chinesesimplified']="用户名";
$translation['Username']['bulgarian']="Потребителско име";

$translation['Password']['english']="Password";
$translation['Password']['german']="Kennwort";
$translation['Password']['chinesesimplified']="密码";
$translation['Password']['bulgarian']="парола";

$translation['Remember Me']['english']="Remember Me";
$translation['Remember Me']['german']="Angemeldet bleiben";
$translation['Remember Me']['chinesesimplified']="记住我";
$translation['Remember Me']['bulgarian']="Запомни ме";

$translation['Log In']['english']="Log In";
$translation['Log In']['german']="Login";
$translation['Log In']['chinesesimplified']="登录";
$translation['Log In']['bulgarian']="Логване";

$translation['Password, twice']['english']="Password, twice";
$translation['Password, twice']['german']="Kennwort zweimal";
$translation['Password, twice']['chinesesimplified']="密码，两次";
$translation['Password, twice']['bulgarian']="Парола, два пъти";

$translation['password creation hint']['english']="Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! \" ? $ % ^ & ).";
$translation['password creation hint']['german']="Hinweis: Das Passwort sollte mindestens sieben Zeichen lang sein. Sie stärker zu machen, verwenden Sie Ober-und Kleinbuchstaben, Zahlen und Symbole wie ! \" ? $ % ^ & )";
$translation['password creation hint']['chinesesimplified']="提示：密码长度应该至少有7个字符长。为了使之更强大，使用大写和小写字母，数字和符号，如 ! \" ? $ % ^ & )";
$translation['password creation hint']['bulgarian']="Съвет: Паролата трябва да бъде най-малко седем знака. Да направи я по-силна, се използват главни и малки букви, цифри и символи, като ! \" ? $ % ^ & ).";

$translation['double check email']['english']="Double-check your email address before continuing.";
$translation['double check email']['german']="Überprüfen Sie Ihre E-Mail-Adresse, bevor Sie fortfahren.";
$translation['double check email']['chinesesimplified']="仔细检查你的电子邮件地址，然后再继续。";
$translation['double check email']['bulgarian']="Два пъти проверявате електронната си поща адрес преди да продължите.";

$translation['Your E-mail']['english']="Your E-mail";
$translation['Your E-mail']['german']="Ihre E-Mail";
$translation['Your E-mail']['chinesesimplified']="您的E-mail";
$translation['Your E-mail']['bulgarian']="Вашият Е-мейл";

$translation['user name guidelines']['english']="Usernames can have only alphanumeric characters, spaces, underscores, hyphens, periods and the @ symbol.";
$translation['user name guidelines']['german']="Benutzernamen können nur alphanumerische Zeichen, Leerzeichen, Unterstriche, Bindestriche, Punkte und das @-Symbol.";
$translation['user name guidelines']['chinesesimplified']="用户名可以只包含字母数字字符，空格，下划线，连字符，句号和@符号。";
$translation['user name guidelines']['bulgarian']="Потребителските имена могат да имат само букви и цифри, интервали, долни черти, тирета, интервали и символа @.";

$translation['Invalid data entered for first user account.']['english']="Invalid data entered for first user account.<br/><br/>

Press the Back button to return to previous page.";
$translation['Invalid data entered for first user account.']['german']="Ungültige Daten eingegeben für den ersten Benutzer-Account. <br/><br/>

Drücken Sie die Zurück-Taste, um zur vorherigen Seite zurückzukehren.";
$translation['Invalid data entered for first user account.']['chinesesimplified']="无效的数据进入第一个用户帐户。<br/> <br/>

按“返回”按钮，返回到前一页。";
$translation['Invalid data entered for first user account.']['bulgarian']='Невалидни данни, въведени за първия потребителски акаунт. <br/> <br/>

Натиснете бутона "Назад", за да се върнете към предишната страница.';



$translation['Click here']['english']="Click here";
$translation['Click here']['german']="Klicken Sie hier";
$translation['Click here']['chinesesimplified']="点击这里";
$translation['Click here']['bulgarian']="Кликнете тук,";

$translation['to go back to previous page.']['english']="to go back to previous page.";
$translation['to go back to previous page.']['german']="gehen zurück zur vorherigen Seite.";
$translation['to go back to previous page.']['chinesesimplified']="回到前一页。";
$translation['to go back to previous page.']['bulgarian']="за да се върнете към предишната страница.";

$translation['Passwords need to match.']['english']="Passwords need to match.";
$translation['Passwords need to match.']['german']="Passwörter müssen übereinstimmen.";
$translation['Passwords need to match.']['chinesesimplified']="密码必须匹配。";
$translation['Passwords need to match.']['bulgarian']="Паролите трябва да съвпадат.";

$translation['The following tables were not created.  Contact support.']['english']="The following tables were not created.  Contact support.";
$translation['The following tables were not created.  Contact support.']['german']="Die folgenden Tabellen wurden nicht erstellt. Kontaktieren Sie den Support.";
$translation['The following tables were not created.  Contact support.']['chinesesimplified']="下表未创建。联系技术支持。";
$translation['The following tables were not created.  Contact support.']['bulgarian']="В таблиците по-долу не са били създадени. Свържете се с подкрепа.";

$translation['Database Log']['english']="Database Log";
$translation['Database Log']['german']="Database Log";
$translation['Database Log']['chinesesimplified']="数据库日志";
$translation['Database Log']['bulgarian']="Database Вход";

$translation['Database tables already exist.']['english']="Database tables already exist. Setup can not continue.<br/><br/>

Press the Back button to return to previous page.<br/><br/>

Delete the existing HIS database tables from the database before proceeding.";
$translation['Database tables already exist.']['german']="Datenbanktabellen bereits existieren. Setup kann nicht fortgesetzt werden.<br/><br/>

Drücken Sie die Zurück-Taste, um zur vorherigen Seite zurückzukehren.<br/><br/>

Löschen Sie die vorhandenen HIS-Datenbank Tabellen aus der Datenbank, bevor Sie fortfahren.";
$translation['Database tables already exist.']['chinesesimplified']="数据库表已经存在。安装程序无法继续。<br/> <br/>

按“返回”按钮，返回到前一页。<br/> <br/>

删除现有的HIS数据库表从数据库中，然后再继续。";
$translation['Database tables already exist.']['bulgarian']='Таблиците на базата данни вече съществуват. Инсталаторът не може да продължи. <br/> <br/>

Натиснете бутона "Назад", за да се върнете към предишната страница. <br/> <br/>

Изтриване на съществуващите таблиците в базата данни от базата данни, преди да продължите.';




$translation['Installation failed']['english']="Installation failed";
$translation['Installation failed']['german']="Die Installation ist fehlgeschlagen";
$translation['Installation failed']['chinesesimplified']="安装失败";
$translation['Installation failed']['bulgarian']="Неуспешна инсталация";

$translation['Installation successful']['english']="Installation successful";
$translation['Installation successful']['german']="Installation erfolgreich";
$translation['Installation successful']['chinesesimplified']="安装成功";
$translation['Installation successful']['bulgarian']="Монтаж успешно";

$translation['The following tables were created.  Click Submit at the bottom of the page to continue.']['english']="The following tables were created.  Click Submit at the bottom of the page to continue.";
$translation['The following tables were created.  Click Submit at the bottom of the page to continue.']['german']="Die folgenden Tabellen erstellt wurden. Klicken Sie auf Senden am unteren Rand der Seite, um fortzufahren.";
$translation['The following tables were created.  Click Submit at the bottom of the page to continue.']['chinesesimplified']="创建表。单击“提交”，页面底部的继续。";
$translation['The following tables were created.  Click Submit at the bottom of the page to continue.']['bulgarian']="В таблиците по-долу са били създадени. Кликнете върху Изпращане в долната част на страницата, за да продължите.";

$translation['Overview']['english']="Overview";
$translation['Overview']['german']="Überblick";
$translation['Overview']['chinesesimplified']="概观";
$translation['Overview']['bulgarian']="Преглед";

$translation['Function List']['english']="Function List";
$translation['Function List']['german']="Funktionsliste";
$translation['Function List']['chinesesimplified']="功能列表";
$translation['Function List']['bulgarian']="Функция Списък";

$translation['Add Function or Add User']['english']="Create a new HIS Function";
$translation['Add Function or Add User']['german']="Erstellen Sie eine neue HIS-Funktion";
$translation['Add Function or Add User']['chinesesimplified']="创建一个新的HIS功能";
$translation['Add Function or Add User']['bulgarian']="Създаване на нов Неговата функция";

$translation['Job Cluster']['english']="Job Cluster";
$translation['Job Cluster']['german']="Job Cluster";
$translation['Job Cluster']['chinesesimplified']="招聘集群";
$translation['Job Cluster']['bulgarian']="работа Cluster";

$translation['Search Tags']['english']="Search Tags";
$translation['Search Tags']['german']="Search Tags";
$translation['Search Tags']['chinesesimplified']="搜索标签";
$translation['Search Tags']['bulgarian']="Търсене Етикети";

$translation['Information']['english']="Information";
$translation['Information']['german']="Information";
$translation['Information']['chinesesimplified']="信息";
$translation['Information']['bulgarian']="информация";

$translation['Settings']['english']="Settings";
$translation['Settings']['german']="Einstellungen";
$translation['Settings']['chinesesimplified']="设置";
$translation['Settings']['bulgarian']="Настройки";

$translation['Confirm Logout?']['english']="Confirm Logout?";
$translation['Confirm Logout?']['german']="Bestätigen Logout?";
$translation['Confirm Logout?']['chinesesimplified']="确认登出？";
$translation['Confirm Logout?']['bulgarian']="Потвърдете Изход?";

$translation['overview1']['english']="Welcome to HIS, where data collection and visual text processing is made easy. Call your automation over HTTP GET and POST.<br/><br/>

HIS's purpose is to empower existing automation, and facilitate new automation creation. HIS uses the following techniques to assist you in data and logic design.";
$translation['overview1']['german']="Willkommen bei HIS, wo Datenerfassung und visuelle Texte leicht gemacht wird. Rufen Sie Ihre Automatisierungslösung über HTTP GET und POST.<br/><br/>

HIS Zweck ist zu ermächtigen vorhandenen Automatisierungs-und erleichtern neue Automatisierungs-Schöpfung. HIS verwendet die folgenden Techniken, um Sie in Daten und Logik-Design zu unterstützen.";
$translation['overview1']['chinesesimplified']="欢迎HIS，数据收集和可视化的文本处理变得容易。打电话给你的自动化，HTTP GET和POST。<br/> <br/>

HIS的目的是为了使现有的自动化，并促进建立新的自动化。使用下面的技术来帮助你的数据和逻辑设计。";
$translation['overview1']['bulgarian']="Добре дошли в HIS, където се извършва събиране на данни и визуална обработка на текст лесно. Обадете се на вашия автоматизация HTTP GET и POST. <br/> <br/>

HIS цел е да даде възможност на съществуващата автоматизация, и да се улесни създаването на нови работни автоматизация. HIS използва следните техники, за да ви помогне в данни и логика дизайн.";



$translation['overview2']['english']="Your existing scripts can be pasted into this HIS web interface. HIS is suited for launching and parameterizing shell scripts, batch commands, and any other automation via GET and POST requests over HTTP.<br/><br/>

Exportability, open source principles, data liberation, code generation, API creation and new infrastructure minimization are the principles that will help you to maintain ALL of your current scripting, application logic, and infrastructure that HIS becomes involved with in with your use case. Existing infrastructure, heterogenous architectures, and avoiding vendor lock-in are principles that guide HIS' ongoing improvement.<br/><br/>

This web interface allows you to create & edit HIS Functions.
&nbsp;&nbsp;&nbsp;HIS Functions are simple atomic data collection or data creation tasks.";
$translation['overview2']['german']="Ihre vorhandenen Skripte können in diesem HIS Web-Interface eingefügt werden. HIS ist für das Starten und Parametrierung Shell-Skripte, Batch-Befehle, und andere Automatisierung über GET-und POST-Anfragen über HTTP geeignet.<br/><br/>

Exportfähigkeit, sind Open-Source-Prinzipien, Daten Befreiung, Codegenerierung, API Erstellung und neue Infrastruktur Minimierung die Prinzipien, die Ihnen helfen, alle Ihre aktuellen Scripting, Anwendungslogik und Infrastruktur, die HIS verwickelt wird mit sich mit Ihren Anwendungsfall aufrechterhalten wird. Vorhandene Infrastruktur, heterogene Architekturen und die Vermeidung von Vendor Lock-in sind Grundsätze, die HIS 'kontinuierliche Verbesserung führen.<br/><br/>

Das Web-Interface ermöglicht Ihnen das Erstellen und Bearbeiten von seinen Funktionen.<br/>
Seine Funktionen sind einfach atomaren Datenerfassung oder Daten Erstellung Aufgaben.";
$translation['overview2']['chinesesimplified']="这是他的网络接口，可以粘贴到您现有的脚本。 HIS是适合发射和参数的shell脚本，批处理命令，并通过HTTP的GET和POST请求的任何其他自动化通过。<br/><br/>

出口能力，开源的原则，解放，代码生成API创建新的基础设施最小化的原则，这将有助于你保持所有您当前的脚本，应用程序逻辑和基础设施，他成为涉及您的使用情况。现有基础设施的异构体系结构，避免厂商锁定的是他的“持续改进的原则，指导。<br/><br/>

Web界面允许您创建和编辑的职能。<br/>
其职能是简单的的原子数据收集或数据的创建任务。";
$translation['overview2']['bulgarian']='Вашите съществуващи скриптове, може да бъде поставен в този уеб интерфейс. Му е подходящ за стартиране и задаване на параметри на шел скриптове, набор от команди, както и всяка друга автоматизация чрез GET и POST заявки над HTTP.<br/><br/>

Прехвърляемост, принципите на отворения код, за освобождение на данни, генериране на кода, API за създаване и изграждане на нова инфраструктура за минимизиране са принципите, които ще ви помогнат да се запазят всички на текущата си скриптове, логиката на приложението, и инфраструктура, която се ангажира с използването случай. Съществуващата инфраструктура, хетерогенни архитектури и избягване на продавача заключване са принципи, които ръководят Неговата "непрекъснато подобряване.<br/><br/>

Този уеб интерфейс ви позволява да създавате и редактирате своите функции.<br/>
Неговите функции са прости атомната събиране на данни или данни за задачите за създаване.';




$translation['default input resource']['english']='Input Resource entered, but job not run yet. Goto "Input Resource" and click "Re-gather" button';
$translation['default input resource']['german']='Input-Ressource eingegeben, aber Auftrag noch nicht ausgeführt werden. Goto "Input Resource" und klicken Sie auf "Re-Gather"-Taste';
$translation['default input resource']['chinesesimplified']='输入资源进入，但工作尚未运行。转到输入资源，然后单击“重新聚首按钮';
$translation['default input resource']['bulgarian']='Input ресурси влезе, но работата все още не работи. Иди на "Input ресурси" и кликнете бутона "отново се събират"';

$translation['functionlist1']['english']='Functions are the fundamental units of HIS.  A function consists of an Input Resource (input) and a Filtering Expression (logic).  After the resource is gathered and optionally filtered, an output (text, image, audio, or video) is produced.';
$translation['functionlist1']['german']='Funktionen sind die grundlegenden Einheiten von HIS. Eine Funktion besteht aus einem Eingang Resource (Eingang) und eine Filterung Expression (Logik). Nachdem der Ressource wird gesammelt und gegebenenfalls filtriert, einen Ausgang (Text, Bild-, Audio oder Video) erzeugt wird.';
$translation['functionlist1']['chinesesimplified']='功能是他的基本单位。一个函数包含一个输入资源（输入）和一个过滤表达式（逻辑）。资源的收集和选择性过滤，输出后（文本，图像，音频，视频）。';
$translation['functionlist1']['bulgarian']='Функциите са основните звена на МУ функция се състои от входен ресурс (вход) и Филтриране израз (логика). След ресурс се събира и по желание филтрира, изход (текст, изображения, аудио или видео).';

$translation['sklist1']['english']='The HIS Functions above can run on the following types of operating systems.  You can setup HIS job servers on the following types of operating systems:';
$translation['sklist1']['german']='Die HIS oben beschriebenen Funktionen können auf die folgenden Arten von Betriebssystemen laufen. Sie können HIS Job Server auf folgende Arten von Betriebssystemen einrichten:';
$translation['sklist1']['chinesesimplified']='上述HIS功能可以运行在以下类型的操作系统。您可以设置HIS工作的以下类型的服务器上的操作系统：';
$translation['sklist1']['bulgarian']='На HIS посочените по-горе функции може да работи на следните видове операционни системи. Можете да настроите HIS сървъри на работа следните видове операционни системи:';


$translation['no queries']['english']="No queries created yet.  A function can be created";
$translation['no queries']['german']="Keine Abfragen erstellt. Eine Abfrage kann erstellt werden";
$translation['no queries']['chinesesimplified']="尚未创建的查询。可以创建一个查询";
$translation['no queries']['bulgarian']="Не запитвания създадени още. Заявка може да бъде създаден";

$translation['Input Resource']['english']="Input Resource";
$translation['Input Resource']['german']="Input-Ressource";
$translation['Input Resource']['chinesesimplified']="输入资源";
$translation['Input Resource']['bulgarian']="Input ресурси";

$translation['Filtering Expression']['english']="Filtering Expression";
$translation['Filtering Expression']['german']="Filterung Expression";
$translation['Filtering Expression']['chinesesimplified']="筛选表达式";
$translation['Filtering Expression']['bulgarian']="Филтриране Изразяване";

$translation['Function Parameters']['english']="Function Parameters";
$translation['Function Parameters']['german']="Funktionsparameter";
$translation['Function Parameters']['chinesesimplified']="功能参数";
$translation['Function Parameters']['bulgarian']="функционални параметри";

$translation['Server Filters']['english']="Server Filters";
$translation['Server Filters']['german']="Server-Filters";
$translation['Server Filters']['chinesesimplified']="服务器过滤器";
$translation['Server Filters']['bulgarian']="сървър филтри";

$translation['MIME Output Type']['english']="MIME Output Type";
$translation['MIME Output Type']['german']="MIME Art der Ausgabe";
$translation['MIME Output Type']['chinesesimplified']="MIME输出类型";
$translation['MIME Output Type']['bulgarian']="MIME изход Тип";

$translation['Time Behavior']['english']="Time Behavior";
$translation['Time Behavior']['german']="Zeitverhalten";
$translation['Time Behavior']['chinesesimplified']="时行为";
$translation['Time Behavior']['bulgarian']="Време поведение";

$translation['Output Expression']['english']="Output Expression";
$translation['Output Expression']['german']="Output Expression";
$translation['Output Expression']['chinesesimplified']="输出表达式";
$translation['Output Expression']['bulgarian']="Изход Изразяване";

$translation['Techniques']['english']="Techniques";
$translation['Techniques']['german']="Techniques";
$translation['Techniques']['chinesesimplified']="技术";
$translation['Techniques']['bulgarian']="техники";

$translation['Shortcuts']['english']="Shortcuts";
$translation['Shortcuts']['german']="Shortcuts";
$translation['Shortcuts']['chinesesimplified']="快捷键";
$translation['Shortcuts']['bulgarian']="Бързи";

$translation['Resource Gathering']['english']="Resource Gathering";
$translation['Resource Gathering']['german']="Sammeln von Ressourcen";
$translation['Resource Gathering']['chinesesimplified']="资源采集";
$translation['Resource Gathering']['bulgarian']="събиране на ресурси";

$translation['Back']['english']="Back";
$translation['Back']['german']="Zurück";
$translation['Back']['chinesesimplified']="背面";
$translation['Back']['bulgarian']="назад";

$translation['Resource Type']['english']="Resource Type";
$translation['Resource Type']['german']="Ressourcentyp";
$translation['Resource Type']['chinesesimplified']="资源类型";
$translation['Resource Type']['bulgarian']="ресурси Тип";

$translation['Job Queue/List of Jobs']['english']="Job Queue/List of Jobs";
$translation['Job Queue/List of Jobs']['german']="Job Queue / Liste der Jobs";
$translation['Job Queue/List of Jobs']['chinesesimplified']="作业队列/职位列表";
$translation['Job Queue/List of Jobs']['bulgarian']="Job Queue / Списък на работни места";

$translation['View Server Logs']['english']="View Server Logs";
$translation['View Server Logs']['german']="Sehen Server Logs";
$translation['View Server Logs']['chinesesimplified']="查看服务器日志";
$translation['View Server Logs']['bulgarian']="Вижте сървърни логове";

$translation['List of Job Processing Servers (for Remote Jobs):']['english']="List of Job Processing Servers (for Remote Jobs):";
$translation['List of Job Processing Servers (for Remote Jobs):']['german']="Liste der Job-Verarbeitung Servers (für Remote Jobs):";
$translation['List of Job Processing Servers (for Remote Jobs):']['chinesesimplified']="作业处理服务器列表（远程作业）：";
$translation['List of Job Processing Servers (for Remote Jobs):']['bulgarian']="Списък на сървъри за обработка на работа (за отдалечени работни места):";

$translation['Want to add a job server?']['english']="Want to add a job server?";
$translation['Want to add a job server?']['german']="Möchten Sie einen Job Server hinzufügen?";
$translation['Want to add a job server?']['chinesesimplified']="要添加一个作业服务器？";
$translation['Want to add a job server?']['bulgarian']="Искате ли да добавите сървъра работа?";

$translation['to generate a his-config.php file for your server.']['english']="to generate a his-config.php file for your server.";
$translation['to generate a his-config.php file for your server.']['german']="eine his-config.php für Ihren Server zu generieren.";
$translation['to generate a his-config.php file for your server.']['chinesesimplified']="来生成一个his-config.php文件为您的服务器。";
$translation['to generate a his-config.php file for your server.']['bulgarian']="за генериране на си-config.php файл на вашия сървър.";

$translation['Search Terms (A and B and C and D):']['english']="Search Terms (A and B and C and D):";
$translation['Search Terms (A and B and C and D):']['german']="Suchbegriffe (A und B sowie C und D):";
$translation['Search Terms (A and B and C and D):']['chinesesimplified']="搜索关键字（A，B，C和D）：";
$translation['Search Terms (A and B and C and D):']['bulgarian']="Условия за търсене (А и Б, В и Г):";

$translation['Search']['english']="Search";
$translation['Search']['german']="Suchen";
$translation['Search']['chinesesimplified']="搜索";
$translation['Search']['bulgarian']="намирам";

$translation['Tag Cloud']['english']="Tag Cloud";
$translation['Tag Cloud']['german']="Tag Cloud";
$translation['Tag Cloud']['chinesesimplified']="标签 泱";
$translation['Tag Cloud']['bulgarian']="облак на етикет";

$translation['user key summary']['english']="Your User Key is your personal secret login for ONLY YOU. Your User Key (UID + Secret Key combination) allows you to securely submit HTTP requests to this HIS Interface from the outside world.";
$translation['user key summary']['german']="Ihre User Key ist Ihr persönliches Geheimnis Login für ONLY YOU. Ihre User Key (UID + Secret Key-Kombination) können Sie sicher übermitteln HTTP-Anfragen an diese HIS-Schnittstelle von der Außenwelt.";
$translation['user key summary']['chinesesimplified']="你的用户密钥是你个人的秘密登录，只有你。用户识别码（UID+秘密组合键），您可以安全地提交HTTP请求的HIS接口从外面的世界。";
$translation['user key summary']['bulgarian']="Вашето потребителско ключ е вашата лична тайна вход за само за вас. Вашето потребителско Key (UID + секретен ключ комбинация) ви позволява сигурно да представят HTTP заявки за това му интерфейс от външния свят.";


$translation['Never give your Secret Key to anyone.']['english']="Never give your Secret Key to anyone.";
$translation['Never give your Secret Key to anyone.']['german']="Geben Sie niemals Ihre Secret Key to anyone.";
$translation['Never give your Secret Key to anyone.']['chinesesimplified']="千万不要把你的秘密钥匙给任何人。";
$translation['Never give your Secret Key to anyone.']['bulgarian']="Никога не давайте таен ключ на никого.";

$translation['make new secret key']['english']="Make a new Secret Key";
$translation['make new secret key']['german']="Machen Sie einen neuen Secret Key";
$translation['make new secret key']['chinesesimplified']="创建一个新的密钥，";
$translation['make new secret key']['bulgarian']="Направете нов секретен ключ";

$translation['Cleanup Database']['english']="Cleanup Database";
$translation['Cleanup Database']['german']="Cleanup Database";
$translation['Cleanup Database']['chinesesimplified']="清理数据库";
$translation['Cleanup Database']['bulgarian']="почистване на база данни";

$translation['URLEncode/URLDecode Tester']['english']="URLEncode/URLDecode Tester";
$translation['URLEncode/URLDecode Tester']['german']="URLEncode / urldecode-Test";
$translation['URLEncode/URLDecode Tester']['chinesesimplified']="与URLEncode/ URLDecode测试仪";
$translation['URLEncode/URLDecode Tester']['bulgarian']="URL кодер / декодер на URL тестер";

$translation['Go to']['english']="Go to";
$translation['Go to']['german']="Zum";
$translation['Go to']['chinesesimplified']="到";
$translation['Go to']['bulgarian']="Отиди на";

$translation['Encode Text']['english']="Encode Text";
$translation['Encode Text']['german']="Encode Text";
$translation['Encode Text']['chinesesimplified']="编码文本";
$translation['Encode Text']['bulgarian']="Възхвала Текст";

$translation['Decode Text']['english']="Decode Text";
$translation['Decode Text']['german']="Decode Text";
$translation['Decode Text']['chinesesimplified']="解码文本";
$translation['Decode Text']['bulgarian']="Decode Текст";

$translation['Encoded Text']['english']="Encoded Text";
$translation['Encoded Text']['german']="Encoded Text";
$translation['Encoded Text']['chinesesimplified']="编码的文本";
$translation['Encoded Text']['bulgarian']="кодиран текст";

$translation['Decoded Text']['english']="Decoded Text";
$translation['Decoded Text']['german']="Decoded Text";
$translation['Decoded Text']['chinesesimplified']="解码的文本";
$translation['Decoded Text']['bulgarian']="Декодирано Текст";

$translation['edit overview']['english']="A Function is the fundamental unit of HIS. A Function consists of an <a href='?q=qn&v=input-resource'>Input Resource (input)</a> and a <a href='?q=qn&v=filtering-expression'>Filtering Expression (logic)</a>. After the resource is gathered and optionally filtered, an output (text, image, audio, or video) is produced.<br/><br/>

To ensure scalability, Functions (that is to say, <a href='?q=qn&v=input-resource'>Input Resource</a> acquisition and <a href='?q=qn&v=filtering-expression'>Filtering Expression</a> execution) are executed on remote job servers that YOU setup on existing compute resources. You can use the Server Filters page to ensure that your Function runs on the correct remote compute server.<br/><br/>

Launching a remote job server is as easy as executing ONE shell command on your compute node, to start the job server.";
$translation['edit overview']['german']="Eine Funktion ist die grundlegende Einheit der HIS. Eine Funktion besteht aus einem <a href='?q=qn&v=input-resource'>Eingang Resource (Eingang)</a> und <a href='?q=qn&v=filtering-expression'>Filtering Expression (Logik)</a>. Nachdem der Ressource wird gesammelt und gegebenenfalls filtriert, einen Ausgang (Text, Bild-, Audio oder Video) erzeugt wird. <br/><br/>

Um die Skalierbarkeit, Funktionen zu gewährleisten (dh, <a href='?q=qn&v=input-resource'>Input-Ressource</a> Erwerb und <a href='?q=qn&v=filtering-expression'>Filtering Expression</a> Ausführen) auf Remote-Job-Servern ausgeführt, dass Sie das Setup auf bestehende IT-Ressourcen. Sie können die Server-Filter, um sicherzustellen, dass Ihre Funktion auf dem richtigen Remote-Compute-Server läuft.<br/><br/>

Starten eines Remote-Job-Server ist so einfach wie die Ausführung ONE Shell-Befehl auf Ihrem Rechenknoten, um den Job-Server zu starten.";
$translation['edit overview']['chinesesimplified']="一个功能是他的基本单位。一个函数包含的的<a href='?q=qn&v=input-resource'>输入资源（输入）</a>和<a href='?q=qn&v=filtering-expression'>过滤表达式（逻辑）</a>。在资源的收集和选择性过滤，输出（文本，图像，音频，视频）。时<br/><br/>

为确保可扩展性，功能（也就是说，<a href='?q=qn&v=input-resource'>输入资源</a>的收购和<a href='?q=qn&v=filtering-expression'>筛选表达式</a>执行）上执行远程作业的服务器，你安装在现有的计算资源。您可以使用服务器过滤器页面，以确保你的函数运行在正确的远程计算机服务器。<br/><br/>

开展远程作业服务器作为计算节点上执行一个shell命令，开始作业服务器一样简单。";
$translation['edit overview']['bulgarian']="Функция, която е основна единица на HIS. Функция се състои от <a ресурси href='?q=qn&v=input-resource'>вход (вход)</a> и <a href='?q=qn&v=filtering-expression'>Филтриране израз (логика)</a>. След ресурс се събира и по желание филтрира, изход (текст, изображения, аудио или видео) се произвежда.<br/><br/>

За да се гарантира мащабируемост, функции (тоест, <a href='?q=qn&v=input-resource'>Input ресурси</a> придобиване и <a href='?q=qn&v=filtering-expression'>Филтриране Изразяване </a> изпълнение) се извършват на отдалечени сървъри на работни места, че ВИЕ настройка на съществуващите ресурси изчислителни. Можете да използвате сървъра Филтри страница, за да се гарантира, че вашата функция работи на правилното отдалечен сървър изчислителни.<br/><br/>

Започване на отдалечен сървър работа е толкова лесно, колкото при стартиране на една команда на обвивката на вашата локална изчислителна, за да започнете заданието на сървъра.";

$translation['Cache Activity']['english']="Cache Activity";
$translation['Cache Activity']['german']="Cache Aktivität";
$translation['Cache Activity']['chinesesimplified']="高速缓存活动";
$translation['Cache Activity']['bulgarian']="Cache активност";

$translation['Name']['english']="Name";
$translation['Name']['german']="Name";
$translation['Name']['chinesesimplified']="名义";
$translation['Name']['bulgarian']="име";

$translation['Update']['english']="Update";
$translation['Update']['german']="Aktualisieren";
$translation['Update']['chinesesimplified']="更新";
$translation['Update']['bulgarian']="Актуализация";

$translation['Delete']['english']="Delete";
$translation['Delete']['german']="Löschen";
$translation['Delete']['chinesesimplified']="删除";
$translation['Delete']['bulgarian']="Изтриване";

$translation['Save']['english']="Save";
$translation['Save']['german']="Sparen";
$translation['Save']['chinesesimplified']="保存";
$translation['Save']['bulgarian']="Запиши";

$translation['processing']['english']="processing";
$translation['processing']['german']="verarbeitung";
$translation['processing']['chinesesimplified']="处理";
$translation['processing']['bulgarian']="обработване";

$translation['operation']['english']="operation";
$translation['operation']['german']="betrieb";
$translation['operation']['chinesesimplified']="作业";
$translation['operation']['bulgarian']="експлоатация";

$translation['action']['english']="action";
$translation['action']['german']="aktion";
$translation['action']['chinesesimplified']="行动";
$translation['action']['bulgarian']="действие";

$translation['output']['english']="output";
$translation['output']['german']="ausgang";
$translation['output']['chinesesimplified']="产量";
$translation['action']['bulgarian']="продукция";

$translation['PROCESSING']['english']=strtoupper("processing");
$translation['PROCESSING']['german']=strtoupper("verarbeitung");
$translation['PROCESSING']['chinesesimplified']=strtoupper("处理");
$translation['PROCESSING']['bulgarian']=strtoupper("обработване");

$translation['OPERATION']['english']=strtoupper("OPERATION");
$translation['OPERATION']['german']=strtoupper("betrieb");
$translation['OPERATION']['chinesesimplified']=strtoupper("作业");
$translation['OPERATION']['bulgarian']=strtoupper("експлоатация");

$translation['ACTION']['english']=strtoupper("ACTION");
$translation['ACTION']['german']=strtoupper("aktion");
$translation['ACTION']['chinesesimplified']=strtoupper("行动");
$translation['ACTION']['bulgarian']=strtoupper("действие");

$translation['OUTPUT']['english']=strtoupper("OUTPUT");
$translation['OUTPUT']['german']=strtoupper("ausgang");
$translation['OUTPUT']['chinesesimplified']=strtoupper("产量");
$translation['OUTPUT']['bulgarian']=strtoupper("продукция");


$translation['allow alphanumeric characters']['english']="allow alphanumeric characters";
$translation['allow alphanumeric characters']['german']="ermöglichen alphanumerische zeichen";
$translation['allow alphanumeric characters']['chinesesimplified']="允许字母数字字符";
$translation['allow alphanumeric characters']['bulgarian']="позволи буквено-цифрови знаци";

$translation['allow spaces']['english']="allow spaces";
$translation['allow spaces']['german']="ermöglichen räume";
$translation['allow spaces']['chinesesimplified']="让空间";
$translation['allow spaces']['bulgarian']="позволи пространства";

$translation['allow numbers']['english']="allow numbers";
$translation['allow numbers']['german']="ermöglichen zahlen";
$translation['allow numbers']['chinesesimplified']="允许数字";
$translation['allow numbers']['bulgarian']="позволи номера";

$translation['allow alphabetic characters']['english']="allow alphabetic characters";
$translation['allow alphabetic characters']['german']="ermöglichen alphabetischen zeichen";
$translation['allow alphabetic characters']['chinesesimplified']="允许字母字符";
$translation['allow alphabetic characters']['bulgarian']="позволи буквени знаци";

$translation['allow the following special characters:']['english']="allow the following special characters:";
$translation['allow the following special characters:']['german']="ermöglichen die folgenden sonderzeichen:";
$translation['allow the following special characters:']['chinesesimplified']="允许使用下列特殊字符：";
$translation['allow the following special characters:']['bulgarian']="позволил на следните специални знаци:";

$translation['disallowed string']['english']="disallowed string";
$translation['disallowed string']['german']="aberkannt string";
$translation['disallowed string']['chinesesimplified']="不允许串";
$translation['disallowed string']['bulgarian']="забранени низ";

$translation['must match regular expression']['english']="must match regular expression";
$translation['must match regular expression']['german']="müssen übereinstimmen regular expression";
$translation['must match regular expression']['chinesesimplified']="必须匹配正则表达式";
$translation['must match regular expression']['bulgarian']="трябва да съвпада с регулярен израз";

$translation['HIS Function + postback printed output to here']['english']="HIS Function + postback printed output to here";
$translation['HIS Function + postback printed output to here']['german']="Seine Funktion + Postback Druckausgabe hier";
$translation['HIS Function + postback printed output to here']['chinesesimplified']="他的功能+回传打印输出在这里";
$translation['HIS Function + postback printed output to here']['bulgarian']="Неговата функция + postback печатна продукция тук";

$translation['use current value as adjacent dictionary key']['english']="use current value as adjacent dictionary key";
$translation['use current value as adjacent dictionary key']['german']="verwende aktuelle Werte als benachbarte Wörterbuch Schlüssel";
$translation['use current value as adjacent dictionary key']['chinesesimplified']="使用相邻的字典键的当前值";
$translation['use current value as adjacent dictionary key']['bulgarian']="използва сегашната стойност, както е в непосредствена близост речник ключ";

$translation['use current value as adjacent dictionary value']['english']="use current value as adjacent dictionary value";
$translation['use current value as adjacent dictionary value']['german']="verwende aktuelle Werte als benachbarte Wörterbuch Wert";
$translation['use current value as adjacent dictionary value']['chinesesimplified']="使用相邻的字典值的电流值";
$translation['use current value as adjacent dictionary value']['bulgarian']="използва сегашната стойност, както е в непосредствена близост стойността на речник";

$translation['set adjacent dictionary key and value']['english']="set adjacent dictionary key and value";
$translation['set adjacent dictionary key and value']['german']="gesetzt angrenzenden Wörterbuch Schlüssel und Wert";
$translation['set adjacent dictionary key and value']['chinesesimplified']="设置相邻的字典键和值";
$translation['set adjacent dictionary key and value']['bulgarian']="настроите в непосредствена близост речник ключ и стойност";

$translation['set adjacent dictionary key "[BUFFER]"s value equal to preceding sub-processings outputs']['english']='set adjacent dictionary key "[BUFFER]"s value equal to preceding sub-processings outputs';
$translation['set adjacent dictionary key "[BUFFER]"s value equal to preceding sub-processings outputs']['german']='gesetzt angrenzenden Wörterbuch Schlüssel "[BUFFER]" s-Wert gleich vor sub-Bearbeitungen Ausgänge';
$translation['set adjacent dictionary key "[BUFFER]"s value equal to preceding sub-processings outputs']['chinesesimplified']='设置相邻的字典键“[BUFFER]”的价值等于前加工输出';
$translation['set adjacent dictionary key "[BUFFER]"s value equal to preceding sub-processings outputs']['bulgarian']='определя в непосредствена близост речник ключ "[BUFFER]" и стойност, равна на предходните под-обработка изходи';

$translation['Run PHP Code (Variable \$STR gets or sets current value)']['english']='Run PHP Code (Variable \$STR gets or sets current value)';
$translation['Run PHP Code (Variable \$STR gets or sets current value)']['german']='Ausführen von PHP-Code (Variable $STR ab oder legt Stromwert)';
$translation['Run PHP Code (Variable \$STR gets or sets current value)']['chinesesimplified']='运行PHP代码（变量\$STR获取或设置当前值）';
$translation['Run PHP Code (Variable \$STR gets or sets current value)']['bulgarian']='Run PHP код (Variable $STR получава или определя текуща стойност)';

$translation['Print value (default if none is selected)']['english']="Print value (default if none is selected)";
$translation['Print value (default if none is selected)']['german']="Print Wert (Standard, wenn keiner ausgewählt ist)";
$translation['Print value (default if none is selected)']['chinesesimplified']="打印值（默认情况下，如果没有被选中）";
$translation['Print value (default if none is selected)']['bulgarian']="Печат стойност (по подразбиране, ако не е избрано)";

$translation['POSTBACK: Send value via GET to URL']['english']="POSTBACK: Send value via GET to URL";
$translation['POSTBACK: Send value via GET to URL']['german']="POSTBACK: Wert senden via GET URL";
$translation['POSTBACK: Send value via GET to URL']['chinesesimplified']="回发：通过GET的URL值";
$translation['POSTBACK: Send value via GET to URL']['bulgarian']="Postback: Изпратете стойност на URL чрез GET";

$translation['POSTBACK: Send value via POST to URL']['english']="POSTBACK: Send value via POST to URL";
$translation['POSTBACK: Send value via POST to URL']['german']="POSTBACK: Wert senden via POST an URL";
$translation['POSTBACK: Send value via POST to URL']['chinesesimplified']="回发：通过POST发送到URL";
$translation['POSTBACK: Send value via POST to URL']['bulgarian']="Postback: Изпратете стойност на URL чрез POST";

$translation['POSTBACK: Database function']['english']="POSTBACK: Database function";
$translation['POSTBACK: Database function']['german']="POSTBACK: Datenbankabfrage";
$translation['POSTBACK: Database function']['chinesesimplified']="回发：数据库查询";
$translation['POSTBACK: Database function']['bulgarian']="POSTBACK: заявка Database";

$translation['POSTBACK: Send E-Mail']['english']="POSTBACK: Send E-Mail";
$translation['POSTBACK: Send E-Mail']['german']="POSTBACK: Senden Sie E-Mail";
$translation['POSTBACK: Send E-Mail']['chinesesimplified']="回发：发送电子邮件";
$translation['POSTBACK: Send E-Mail']['bulgarian']="POSTBACK: Изпрати E-Mail";

$translation['needs further filtering - use regular expression']['english']="needs further filtering - use regular expression";
$translation['needs further filtering - use regular expression']['german']="muss eine weitere filterung - regular expression";
$translation['needs further filtering - use regular expression']['chinesesimplified']="需要进一步筛选 - 使用正则表达式";
$translation['needs further filtering - use regular expression']['bulgarian']="се нуждае от по-нататъшно филтриране използвате регулярен израз";

$translation['needs further filtering - split using string delimiter']['english']="needs further filtering - split using string delimiter";
$translation['needs further filtering - split using string delimiter']['german']="muss eine weitere filterung - split mit stringtrennzeichen";
$translation['needs further filtering - split using string delimiter']['chinesesimplified']="需要进一步筛选 - 使用字符串分隔符分割";
$translation['needs further filtering - split using string delimiter']['bulgarian']="се нуждае от по-нататъшно филтриране - сплит с низ разделител";

$translation['needs further filtering - split using regular expression']['english']="needs further filtering - split using regular expression";
$translation['needs further filtering - split using regular expression']['german']="muss eine weitere filterung - split mit regular expression";
$translation['needs further filtering - split using regular expression']['chinesesimplified']="需要进一步过滤 - 分割使用正则表达式";
$translation['needs further filtering - split using regular expression']['bulgarian']="се нуждае от по-нататъшно филтриране разделят с регулярен израз";

$translation['needs further filtering - use xpath expression']['english']="needs further filtering - use xpath expression";
$translation['needs further filtering - use xpath expression']['german']="muss eine weitere filterung -xpath ausdruck";
$translation['needs further filtering - use xpath expression']['chinesesimplified']="需要进一步筛选 - 使用XPath表达式";
$translation['needs further filtering - use xpath expression']['bulgarian']="се нуждае от по-нататъшно филтриране разделят с регулярен израз";

$translation['needs further filtering - use string format specifier']['english']="needs further filtering - use string format specifier";
$translation['needs further filtering - use string format specifier']['german']="muss eine weitere filterung - use string format specifier";
$translation['needs further filtering - use string format specifier']['chinesesimplified']="需要进一步筛选 - 使用字符串格式说明符";
$translation['needs further filtering - use string format specifier']['bulgarian']="се нуждае от по-нататъшно филтриране употреба низ формат спецификатор";

$translation['working perfectly']['english']="working perfectly";
$translation['working perfectly']['german']="einwandfrei";
$translation['working perfectly']['chinesesimplified']="工作完美";
$translation['working perfectly']['bulgarian']="работи перфектно";

$translation['data is still partially raw (contains HTML), needs further adjustment']['english']="data is still partially raw (contains HTML), needs further adjustment";
$translation['data is still partially raw (contains HTML), needs further adjustment']['german']="daten teilweise noch roh (enthält HTML), weitere Anpassungen erforderlich";
$translation['data is still partially raw (contains HTML), needs further adjustment']['chinesesimplified']="数据仍然是部分原料（包含HTML），需要进一步调整";
$translation['data is still partially raw (contains HTML), needs further adjustment']['bulgarian']="данни все още частично сурово (HTML), се нуждае от допълнително регулиране";

$translation['reported as not working']['english']="reported as not working";
$translation['reported as not working']['german']="berichtet, wie funktioniert nicht";
$translation['reported as not working']['chinesesimplified']="不工作报告";
$translation['reported as not working']['bulgarian']="отчитат като не работи";

$translation['might not be working']['english']="might not be working";
$translation['might not be working']['german']="möglicherweise nicht einwandfrei";
$translation['might not be working']['chinesesimplified']="可能无法正常工作";
$translation['might not be working']['bulgarian']="може да не работи";

$translation['not working']['english']="not working";
$translation['not working']['german']="funktioniert nicht";
$translation['not working']['chinesesimplified']="不工作";
$translation['not working']['bulgarian']="не работи";

$translation['being worked on']['english']="being worked on";
$translation['being worked on']['german']="gearbeitet";
$translation['being worked on']['chinesesimplified']="正在处理";
$translation['being worked on']['bulgarian']="да се работи";

$translation['not being worked on']['english']="not being worked on";
$translation['not being worked on']['german']="nicht bearbeitet";
$translation['not being worked on']['chinesesimplified']="不工作";
$translation['not being worked on']['bulgarian']="не се работи";

$translation['too difficult to fix']['english']="too difficult to fix";
$translation['too difficult to fix']['german']="auch schwer zu beheben";
$translation['too difficult to fix']['chinesesimplified']="太难以固定";
$translation['too difficult to fix']['bulgarian']="твърде трудно да се определи";

$translation['target is using obfuscation']['english']="target is using obfuscation";
$translation['target is using obfuscation']['german']="ziel mit verschleierung";
$translation['target is using obfuscation']['chinesesimplified']="目标是使用模糊处理";
$translation['target is using obfuscation']['bulgarian']="целта се използва нарочно са направени неясни";

$translation['no resources available']['english']="no resources available";
$translation['no resources available']['german']="keine ressourcen verfügbar";
$translation['no resources available']['chinesesimplified']="没有可用的资源";
$translation['no resources available']['bulgarian']="не наличните ресурси";

$translation['needs to be checked by QA']['english']="needs to be checked by QA";
$translation['needs to be checked by QA']['german']="Bedürfnisse von QA überprüft werden";
$translation['needs to be checked by QA']['chinesesimplified']="需要检查由QA";
$translation['needs to be checked by QA']['bulgarian']="трябва да бъдат проверени от QA";

$translation['just an idea - dont do yet']['english']="just an idea - do not do yet";
$translation['just an idea - dont do yet']['german']="nur eine Idee - noch nicht zu tun";
$translation['just an idea - dont do yet']['chinesesimplified']="只是一个想法 - 不这样做还";
$translation['just an idea - dont do yet']['bulgarian']="само една идея - не правя още";

$translation['Automatic Function Failure Detection - Broken Functions']['english']="Automatic Function Failure Detection - Broken Functions";
$translation['Automatic Function Failure Detection - Broken Functions']['german']="Automatische Funktion Failure Detection - Broken Funktionen";
$translation['Automatic Function Failure Detection - Broken Functions']['chinesesimplified']="自动功能故障检测 - 残破的功能";
$translation['Automatic Function Failure Detection - Broken Functions']['bulgarian']="Автоматично откриване недостатъчност - счупени функции";

$translation['read as text, non-html']['english']="read as text, non-html";
$translation['read as text, non-html']['german']="Lesen als Text, nicht-html";
$translation['read as text, non-html']['chinesesimplified']="作为文本阅读，非html";
$translation['read as text, non-html']['bulgarian']="се чете като текст, без HTML";

$translation['urlencode']['english']="urlencode";
$translation['urlencode']['german']="urlencode";
$translation['urlencode']['chinesesimplified']="urlencode";
$translation['urlencode']['bulgarian']="URL кодират (urlencode)";

$translation['double urlencode']['english']="double urlencode";
$translation['double urlencode']['german']="verdoppeln urlencode (urlencode urlencode)";
$translation['double urlencode']['chinesesimplified']="双重 urlencode (urlencode urlencode)";
$translation['double urlencode']['bulgarian']="двойно URL кодират (urlencode urlencode)";

$translation['urldecode']['english']="urldecode";
$translation['urldecode']['german']="urldecode";
$translation['urldecode']['chinesesimplified']="urldecode";
$translation['urldecode']['bulgarian']="URL декодирания";

$translation['double urldecode']['english']="double urldecode";
$translation['double urldecode']['german']="verdoppeln urldecode (urldecode urldecode)";
$translation['double urldecode']['chinesesimplified']="双重 urldecode (urldecode urldecode)";
$translation['double urldecode']['bulgarian']="двойно URL декодирания (urldecode urldecode)";

$translation['prepend and append']['english']="prepend and append";
$translation['prepend and append']['german']="voranstellen und anhängen";
$translation['prepend and append']['chinesesimplified']="前置和后置";
$translation['prepend and append']['bulgarian']="Добавя и добавяне";

$translation['erase (set equal to "")']['english']='erase (set equal to "")';
$translation['erase (set equal to "")']['german']='erase (gleich "")';
$translation['erase (set equal to "")']['chinesesimplified']='擦除（设置等于“”）';
$translation['erase (set equal to "")']['bulgarian']='изтриване (задава равно на "")';

$translation['prepend and append file contents']['english']="prepend and append file contents";
$translation['prepend and append file contents']['german']="voranstellen und anhängen dateiinhalte";
$translation['prepend and append file contents']['chinesesimplified']="前置和后置文件的内容";
$translation['prepend and append file contents']['bulgarian']="сложете и добавяне на съдържанието на файла";

$translation['replace using regular expression']['english']="replace using regular expression";
$translation['replace using regular expression']['german']="ersetzen mit regular expression";
$translation['replace using regular expression']['chinesesimplified']="替换使用正则表达式";
$translation['replace using regular expression']['bulgarian']="замени с регулярен израз";

$translation['format with string specifier']['english']="format with string specifier";
$translation['format with string specifier']['german']="format mit string specifier";
$translation['format with string specifier']['chinesesimplified']="格式字符串说明";
$translation['format with string specifier']['bulgarian']="формат с низ спецификатор";


$translation['html_entities']['english']="html_entities";
$translation['html_entities']['german']="html_entities (konvertieren html Zeichen)";
$translation['html_entities']['chinesesimplified']="html_entities (转换为HTML字符)";
$translation['html_entities']['bulgarian']="html_entities (конвертирате HTML символи)";

$translation['trim']['english']="trim";
$translation['trim']['german']="trimmen (trim)";
$translation['trim']['chinesesimplified']="修剪 (trim)";
$translation['trim']['bulgarian']="подреждам (trim)";

$translation['htmlspecialchars']['english']="htmlspecialchars";
$translation['htmlspecialchars']['german']="htmlspecialchars";
$translation['htmlspecialchars']['chinesesimplified']="htmlspecialchars";
$translation['htmlspecialchars']['bulgarian']="htmlspecialchars";

$translation['strtoupper']['english']="strtoupper";
$translation['strtoupper']['german']="strtoupper";
$translation['strtoupper']['chinesesimplified']="为大写 (strtoupper)";
$translation['strtoupper']['bulgarian']="в главни букви (strtoupper)";

$translation['strtolower']['english']="strtolower";
$translation['strtolower']['german']="strtolower";
$translation['strtolower']['chinesesimplified']="为小写 (strtolower)";
$translation['strtolower']['bulgarian']="в малки (strtolower)";

$translation['Add Function Parameter Value Constraint']['english']="Add Function Parameter Value Constraint";
$translation['Add Function Parameter Value Constraint']['german']="Funktion hinzufügen Parameter Wert Constraint";
$translation['Add Function Parameter Value Constraint']['chinesesimplified']="功能参数值约束";
$translation['Add Function Parameter Value Constraint']['bulgarian']="Добави Функция Ограничение стойността на параметъра";

$translation['Constraint Type']['english']="Constraint Type";
$translation['Constraint Type']['german']="Constraint-Typ";
$translation['Constraint Type']['chinesesimplified']="约束类型";
$translation['Constraint Type']['bulgarian']="Ограничение Тип";

$translation['Characters/Expression']['english']="Characters/Expression";
$translation['Characters/Expression']['german']="Charaktere / Expression";
$translation['Characters/Expression']['chinesesimplified']="字符/表达式";
$translation['Characters/Expression']['bulgarian']="Герои / изрази";

$translation['Expression']['english']="Expression";
$translation['Expression']['german']="Expression";
$translation['Expression']['chinesesimplified']="表达式";
$translation['Expression']['bulgarian']="изразяване";

$translation['Add Job Server Filter']['english']="Add Job Server Filter";
$translation['Add Job Server Filter']['german']="Fügen Job Server Filter";
$translation['Add Job Server Filter']['chinesesimplified']="作业服务器过滤器";
$translation['Add Job Server Filter']['bulgarian']="Добавяне на филтър сървър за работа";

$translation['Create Database Tables & Install HIS']['english']="Create Database Tables & Install HIS";
$translation['Create Database Tables & Install HIS']['german']="Erstellen von Datenbanktabellen und installieren HIS";
$translation['Create Database Tables & Install HIS']['chinesesimplified']="创建数据库表和安装HIS";
$translation['Create Database Tables & Install HIS']['bulgarian']="Създаване на таблиците в базата данни и инсталира своята";

$translation['Input THIS, Output THAT']['english']="Input THIS, Output THAT";
$translation['Input THIS, Output THAT']['german']="Eingang THIS, Ausgang THAT";
$translation['Input THIS, Output THAT']['chinesesimplified']="输入信息，输出的东西";
$translation['Input THIS, Output THAT']['bulgarian']="Въведете този изход, който";

$translation['Scalable Storage']['english']="Scalable Storage";
$translation['Scalable Storage']['german']="Scalable Storage-";
$translation['Scalable Storage']['chinesesimplified']="可扩展的存储";
$translation['Scalable Storage']['bulgarian']="Scalable за съхранение";

$translation['Any language']['english']="Any language";
$translation['Any language']['german']="Jede Sprache";
$translation['Any language']['chinesesimplified']="任何语言";
$translation['Any language']['bulgarian']="Всички езици";

$translation['Job Submission']['english']="Job Submission";
$translation['Job Submission']['german']="Job Submission";
$translation['Job Submission']['chinesesimplified']="作业提交";
$translation['Job Submission']['bulgarian']="за подаване на заявките";

$translation['Apolitical logic repository']['english']="Apolitical logic repository";
$translation['Apolitical logic repository']['german']="Unpolitische Logik Repository";
$translation['Apolitical logic repository']['chinesesimplified']="中性逻辑库";
$translation['Apolitical logic repository']['bulgarian']="Аполитични логика хранилище";

$translation['Code if you want']['english']="Code if you want";
$translation['Code if you want']['german']="Code, wenn Sie wollen";
$translation['Code if you want']['chinesesimplified']="代码如果你想";
$translation['Code if you want']['bulgarian']="Аполитични логика хранилище";

$translation['Any infrastructure']['english']="Any infrastructure";
$translation['Any infrastructure']['german']="Jede Infrastruktur";
$translation['Any infrastructure']['chinesesimplified']="任何基础设施";
$translation['Any infrastructure']['bulgarian']="Всяко инфраструктура";

$translation['API for APIs']['english']="API for APIs";
$translation['API for APIs']['german']="API für APIs";
$translation['API for APIs']['chinesesimplified']="API得到的原料药";
$translation['API for APIs']['bulgarian']="API за APIs";

$translation['Nested String Processing']['english']="Nested String Processing";
$translation['Nested String Processing']['german']="Verschachtelte String-Verarbeitung";
$translation['Nested String Processing']['chinesesimplified']="嵌套的字符串处理";
$translation['Nested String Processing']['bulgarian']="Вложени String обработка";

$translation['Focus on Action']['english']="Focus on Action";
$translation['Focus on Action']['german']="Konzentrieren Sie sich auf Aktion";
$translation['Focus on Action']['chinesesimplified']="着眼于行动";
$translation['Focus on Action']['bulgarian']="Съсредоточете се върху действие";

$translation['Collect data from anywhere']['english']="Collect data from anywhere";
$translation['Collect data from anywhere']['german']="Sammeln von daten von überall";
$translation['Collect data from anywhere']['chinesesimplified']="从任何地方收集数据";
$translation['Collect data from anywhere']['bulgarian']="Събиране на данни от всяко място";

$translation['Automate anything']['english']="Automate anything";
$translation['Automate anything']['german']="automatisieren sie nichts";
$translation['Automate anything']['chinesesimplified']="实现自动化任何东西";
$translation['Automate anything']['bulgarian']="Автоматизирайте нищо";


$translation['HIS Filter Expression Results and Recursive Sub-Processing Follows']['english']="HIS Filter Expression Results and Recursive Sub-Processing Follows";
$translation['HIS Filter Expression Results and Recursive Sub-Processing Follows']['german']="HIS Filter Expression Ergebnisse und Recursive Sub-Processing Folgt";
$translation['HIS Filter Expression Results and Recursive Sub-Processing Follows']['chinesesimplified']="他的过滤器表达式结果和递归处理如下";
$translation['HIS Filter Expression Results and Recursive Sub-Processing Follows']['bulgarian']="Филтрирай резултатите изразяване и Recursive обработка на следва";

$translation['Custom Header']['english']="Custom Header";
$translation['Custom Header']['german']="Benutzerdefinierte Kopfzeile";
$translation['Custom Header']['chinesesimplified']="自定义页眉";
$translation['Custom Header']['bulgarian']="Митническо Header";

$translation['Custom Footer']['english']="Custom Footer";
$translation['Custom Footer']['german']="Benutzerdefinierte Fußzeile";
$translation['Custom Footer']['chinesesimplified']="自定义页脚";
$translation['Custom Footer']['bulgarian']="Митническо Footer";

$translation['ADD']['english']="ADD";
$translation['ADD']['german']="ERGANZEN";
$translation['ADD']['chinesesimplified']="地址";
$translation['ADD']['bulgarian']="пристроявам";

$translation['Output this value']['english']="Output this value";
$translation['Output this value']['german']="Ausgabe dieser Wert";
$translation['Output this value']['chinesesimplified']="输出该值";
$translation['Output this value']['bulgarian']="Изходна тази стойност";

$translation['The text above']['english']="The text above";
$translation['The text above']['german']="Der obige Text";
$translation['The text above']['chinesesimplified']="上面的文字";
$translation['The text above']['bulgarian']="Текстът по-горе";

$translation['In-place modify']['english']="In-place modify";
$translation['In-place modify']['german']="In-place ändern";
$translation['In-place modify']['chinesesimplified']="在修改";
$translation['In-place modify']['bulgarian']="На място промени";

$translation['FILTER RESULT VALUE']['english']="FILTER RESULT VALUE";
$translation['FILTER RESULT VALUE']['german']="FILTER ERGEBNISWERT";
$translation['FILTER RESULT VALUE']['chinesesimplified']="滤波结果值";
$translation['FILTER RESULT VALUE']['bulgarian']="ФИЛТЪР РЕЗУЛТАТ стойност";

$translation['Length']['english']="Length";
$translation['Length']['german']="Länge";
$translation['Length']['chinesesimplified']="长度";
$translation['Length']['bulgarian']="дължина";

$translation['Move Up']['english']="Move Up";
$translation['Move Up']['german']="Nach Oben";
$translation['Move Up']['chinesesimplified']="升级";
$translation['Move Up']['bulgarian']="Премести нагоре";

$translation['Move Down']['english']="Move Down";
$translation['Move Down']['german']="Nach unten";
$translation['Move Down']['chinesesimplified']="下移";
$translation['Move Down']['bulgarian']="Премести надолу";

$translation['Regather Latest Cache']['english']="Regather Latest Cache";
$translation['Regather Latest Cache']['german']="Sammle Neueste Cache";
$translation['Regather Latest Cache']['chinesesimplified']="收集最新的高速缓存";
$translation['Regather Latest Cache']['bulgarian']="Съберете Последни актуални Cache";

$translation['Filtering Interface on this Page']['english']="Filtering Interface on this Page";
$translation['Filtering Interface on this Page']['german']="Filtering-Schnittstelle auf dieser Seite";
$translation['Filtering Interface on this Page']['chinesesimplified']="在此页面上的过滤接口";
$translation['Filtering Interface on this Page']['bulgarian']="Филтриране интерфейс на тази страница";

$translation['Show']['english']="Show";
$translation['Show']['german']="Zeigen";
$translation['Show']['chinesesimplified']="显示";
$translation['Show']['bulgarian']="показване";

$translation['E-mail Addresses (one per line)']['english']="E-mail Addresses<br/>(one per line)";
$translation['E-mail Addresses (one per line)']['german']="E-Mail-Adressen<br/>(eine pro Zeile)";
$translation['E-mail Addresses (one per line)']['chinesesimplified']="E-mail地址（每行一个）";
$translation['E-mail Addresses (one per line)']['bulgarian']="Е-мейл адреси<br/>(по един на ред)";

$translation['Cluster Map']['english']="Cluster Map";
$translation['Cluster Map']['german']="Cluster Map";
$translation['Cluster Map']['chinesesimplified']="集群地图";
$translation['Cluster Map']['bulgarian']="Клъстер Карта";

$translation['Add Server']['english']="Add Server";
$translation['Add Server']['german']="Server Hinzufügen";
$translation['Add Server']['chinesesimplified']="添加服务器";
$translation['Add Server']['bulgarian']="Добави сървър";

$translation['You, Searching for Data']['english']="You, Searching for Data";
$translation['You, Searching for Data']['german']="Sie, Suchen nach Daten";
$translation['You, Searching for Data']['chinesesimplified']="您搜索数据";
$translation['You, Searching for Data']['bulgarian']="Вие Търсене за данни";

$translation['This HIS Web Interface (you are here)']['english']="This HIS Web Interface (you are here)";
$translation['This HIS Web Interface (you are here)']['german']="Das HIS Web Interface (sie sind hier)";
$translation['This HIS Web Interface (you are here)']['chinesesimplified']="这是他的Web界面（在这里）";
$translation['This HIS Web Interface (you are here)']['bulgarian']="Тази уеб интерфейс (вие сте тук)";

$translation['HIS Database']['english']="HIS Database";
$translation['HIS Database']['german']="HIS-Datenbank";
$translation['HIS Database']['chinesesimplified']="他的数据库";
$translation['HIS Database']['bulgarian']="неговата база данни";

$translation['input resource 1']['english']='"Input Resource" is the INPUT to your HIS Function! What data do you want to use as input? What shell scripting do you want to run? What windows programs do you want to call from the CMD.exe batch command line? Will you be giving raw static text as input, and generating MP3 output? Will you be giving a URL as input, and gathering the URLs content as output?<br/><br/>

A function consists of an <a href=\'?q=qn&v=input-resource\'>Input Resource (input)</a> and a <a href=\'?q=qn&v=filtering-expression\'>Filtering Expression (logic)</a>. After the resource is gathered and optionally filtered, an output (text, image, audio, or video) is produced.<br/><br/>

HIS will usually try to execute the file run.bat via batch execution (if Windows) or ./run.bat (if not Windows).  Make sure a script named run.bat exists in these input resources.';
$translation['input resource 1']['german']='"Input Resource" ist der Eingang zu Ihrem HIS Funktion! Welche Daten wollen Sie als Eingabe verwenden? Was Shell Scripting wollen Sie laufen? Was Windows-Programme wollen Sie aus dem CMD.exe Batch-Befehlszeile nennen? Werden Sie geben raw statischen Text als Eingabe und erzeugt MP3-Ausgabe? Werden Sie geben eine URL als Input und Sammeln der URLs Inhalt als Ausgabe?<br/><br/>

A funktion besteht aus einem <a href=\'?q=qn&v=input-resource\'>Eingang Resource (Eingang)</a> und a <a href=\'?q=qn&v=filtering-expression\'>Filterung Expression (Logik)</a>. Nachdem der Ressource wird gesammelt und gegebenenfalls filtriert, einen Ausgang (Text, Bild-, Audio oder Video) erzeugt wird.<br/><br/>

HIS wird in der Regel versuchen, die Datei run.bat via Batch-Ausführung (falls Windows) oder ./run.bat (wenn nicht Windows) ausführen. Stellen Sie sicher, dass ein Skript namens run.bat existiert in diesen Eingang Ressourcen.';
$translation['input resource 1']['chinesesimplified']='“输入资源”的输入您的HIS功能！作为输入你要使用什么样的数据？什么shell脚本，你还想跑？你想什么程序调用Cmd.exe批处理命令行？是否给原始的静态文本作为输入，并生成MP3输出吗？你将被赋予一个URL作为输入，并收集输出的URL的内容吗？<br/><br/>

一个函数包含一个<a href=\'?q=qn&v=input-resource\'>输入资源（输入）</a>和<a href=\'?q=qn&v=filtering-expression\'>过滤表达式（逻辑）</a>。资源的收集和选择性过滤，输出后（文本，图像，音频，视频）。<br/><br/>

HIS通常会尝试执行该文件run.bat，通过批处理执行（如果Windows）或./run.bat的（如果不是Windows）。确保这些输入资源脚本名为run.bat存在。';
$translation['input resource 1']['bulgarian']='"Input ресурси" е ВХОД към вашия Неговата функция! Какви данни искате да използвате като вход? Кои шел скриптове искаш да бягаш? Какво прозорци програми искаш да се обадя от cmd.exe линия партида команда? Ще се дава суров статичен текст като вход и генериране на MP3 изход? Ще се дава URL като вход и събиране на съдържанието на URL адреси, като продукция? <br/><br/>

Функцията се състои от <a href=\'?q=qn&v=input-resource\'>ресурсивход (вход)</a> и <a href=\'?q=qn&v=filtering-expression\'> Филтриране израз (логика)</a>. След ресурс се събира и по желание филтрира, изход (текст, изображения, аудио или видео) се произвежда.<br/><br/>

HIS обикновено ще се опита да изпълни run.bat файл чрез пакетно изпълнение (ако Windows) или ./run.bat (ако не и Windows). Уверете се, че по сценарий на име run.bat съществува в тези входни ресурси.';

$translation['filtering expression 1']['english']="Filtering expressions are regular expressions used to filter and refine text gathered from the Input Resource given.";
$translation['filtering expression 1']['german']="Filterung Ausdrücke sind reguläre Ausdrücke verwendet zu filtern und zu verfeinern Text gesammelt aus dem Input-Ressource gegeben.";
$translation['filtering expression 1']['chinesesimplified']="过滤表达式是正则表达式，用于过滤和完善聚集从<a href='?v=input-resource'>的输入资源</a>给定的文本。";
$translation['filtering expression 1']['bulgarian']="Филтриране изрази са регулярни изрази, използвани за филтриране и прецизира текста, събрани от <a href='?q=3&v=input-resource'> Input ресурс</a> дава.";

$translation['Filtering Pattern']['english']="Filtering Pattern";
$translation['Filtering Pattern']['german']="Filter Pattern";
$translation['Filtering Pattern']['chinesesimplified']="过滤模式";
$translation['Filtering Pattern']['bulgarian']="Филтриране Pattern";

$translation['Invite User']['english']="Invite User";
$translation['Invite User']['german']="Benutzer einladen";
$translation['Invite User']['chinesesimplified']="邀请用户";
$translation['Invite User']['bulgarian']="Поканете потребителя";

$translation['Click here to view Sample']['english']="Click here to view Sample";
$translation['Click here to view Sample']['german']="Klicken Sie hier, um Probe zu sehen";
$translation['Click here to view Sample']['chinesesimplified']="点击这里查看样品";
$translation['Click here to view Sample']['bulgarian']="Щракнете тук, за да видите примерни";

$translation['Input Resource example value']['english']="Input Resource example value";
$translation['Input Resource example value']['german']="Input-Ressource beispielsweise Wert";
$translation['Input Resource example value']['chinesesimplified']="输入资源的例子值";
$translation['Input Resource example value']['bulgarian']="Въведената стойност на ресурсите например";

$translation['Modify Current Input Resource']['english']="Modify Current Input Resource";
$translation['Modify Current Input Resource']['german']="Ändern Stromeingang Ressourcen";
$translation['Modify Current Input Resource']['chinesesimplified']="修改电流输入资源“";
$translation['Modify Current Input Resource']['bulgarian']="Промяна на текущата ресурс за въвеждане";

$translation['Update Input Resource Type']['english']="Update Input Resource Type";
$translation['Update Input Resource Type']['german']="Aktualisieren Eingang Ressourcentyp";
$translation['Update Input Resource Type']['chinesesimplified']="更新输入资源类型";
$translation['Update Input Resource Type']['bulgarian']="Вид на ресурсите на актуализацията за въвеждане";

$translation['Modify']['english']="Modify";
$translation['Modify']['german']="Ändern";
$translation['Modify']['chinesesimplified']="修改";
$translation['Modify']['bulgarian']="Промяна";

$translation['Files to be downloaded to the remote job folder']['english']="Files to be downloaded to the remote job folder";
$translation['Files to be downloaded to the remote job folder']['german']="Dateien, die auf dem Remote-Job-Ordner heruntergeladen werden";
$translation['Files to be downloaded to the remote job folder']['chinesesimplified']="要下载的文件到远程工作文件夹";
$translation['Files to be downloaded to the remote job folder']['bulgarian']="Да бъдат изтеглени файлове с отдалечената папка работа";

$translation['upload files message']['english']="For some use cases, having a set of static files sitting around in the local folder is a requirement.  Upload those files here.";
$translation['upload files message']['german']="Für einige Anwendungsfälle, die einen Satz von statischen Dateien sitzen in den lokalen Ordner ist eine Voraussetzung. Fotogalerie diese Dateien hier.";
$translation['upload files message']['chinesesimplified']="对于某些使用情况下，有一组围坐在本地文件夹的静态文件是必需的。上传这些文件。";
$translation['upload files message']['bulgarian']="За някои случаи на употреба, като набор от статични файлове, които седят около в локална папка е изискване. Качи тези файлове тук.";

$translation['Currently Uploaded Files']['english']="Currently Uploaded Files";
$translation['Currently Uploaded Files']['german']="Derzeit Uploads";
$translation['Currently Uploaded Files']['chinesesimplified']="目前已上传的文件";
$translation['Currently Uploaded Files']['bulgarian']="В момента качените файлове";

$translation['No files have been uploaded yet.']['english']="No files have been uploaded yet.";
$translation['No files have been uploaded yet.']['german']="Keine Dateien wurden noch keine Dateien hochgeladen.";
$translation['No files have been uploaded yet.']['chinesesimplified']="目前没有任何文件已上载。";
$translation['No files have been uploaded yet.']['bulgarian']="Няма файлове са качени още.";

$translation['File Upload']['english']="File Upload";
$translation['File Upload']['german']="Datei-Upload";
$translation['File Upload']['chinesesimplified']="文件上传";
$translation['File Upload']['bulgarian']="Качване на файлове";

$translation['Current file storage selection']['english']="Current file storage selection";
$translation['Current file storage selection']['german']="Aktuelle Dateiablage Auswahl";
$translation['Current file storage selection']['chinesesimplified']="选择当前文件存储";
$translation['Current file storage selection']['bulgarian']="Текущата селекция съхранение на файлове";

$translation['does not allow direct file upload.']['english']="does not allow direct file upload.";
$translation['does not allow direct file upload.']['german']="lässt keine direkte Datei hochzuladen.";
$translation['does not allow direct file upload.']['chinesesimplified']="不允许直接文件上传。";
$translation['does not allow direct file upload.']['bulgarian']="не позволява директно качване на файлове.";


$translation['node filters 1']['english']="Functions are the fundamental unit of HIS, and remote job server nodes are the environments where Functions are executed.  Since you may have different types of server compute nodes (Windows 2008 vs Win 7, CentOS vs RHEL), you might want to run certain jobs on certain compute nodes.<br/><br/>

Each job server instance has a certain name.  Create name filters below to ensure that your function is run on the correct job server instance.";
$translation['node filters 1']['german']="Funktionen sind die grundlegende Einheit der HIS und Remote-Job-Server-Knoten sind die Umgebungen, in denen Funktionen ausgeführt werden. Da Sie verschiedene Arten von Server-Rechenknoten (Windows 2008 vs Win 7, CentOS vs RHEL) haben können, möchten Sie vielleicht bestimmte Jobs auf bestimmten Rechenknoten laufen.<br/><br/>

Jeder Job Server-Instanz hat einen bestimmten Namen. Neues Namen Filter, um sicherzustellen, dass Ihre Funktion auf dem richtigen Job Server-Instanz ausgeführt wird.";
$translation['node filters 1']['chinesesimplified']="函数是他的基本单位，与远程的作业服务器节点的环境中，功能被执行。因为你可能有不同类型的服务器计算节点（Windows 2008中的运7与RHEL，CentOS的），你可能需要一定的计算节点上运行某些工作。<br/><br/>

每个作业服务器实例都有一个特定的域名。创建名称过滤器，以确保你的函数是正确的作业服务器实例上运行。";
$translation['node filters 1']['bulgarian']="Функциите са основна единица на HIS и отдалечени възли за работа сървърни среди, където се изпълняват Функции, тъй като може да имате различни видове на сървъра изчислителни възли (Windows 2008 - Win 7, CentOS срещу RHEL), може да искате да изпълните определени работни местана определени възли изчислителни.<br/><br/>

Всяка инстанция работа сървърът има определено име. Създаване на филтри Наименование по-долу, за да се гарантира, че вашата функция се изпълнява на правилния модел на работа на сървъра.";

$translation['ago']['english']="ago";
$translation['ago']['german']="in der Vergangenheit";
$translation['ago']['chinesesimplified']="以往";
$translation['ago']['bulgarian']="в миналото";

$translation['Query Parameters are &custom=arguments given inside the HIS URL that result in {keyword} entries in your Input Resource being substituted for the <b>arguments</b> value given.']['english']="Query Parameters are &custom=arguments given inside the HIS URL that result in {keyword} entries in your Input Resource being substituted for the <b>arguments</b> value given.";
$translation['Query Parameters are &custom=arguments given inside the HIS URL that result in {keyword} entries in your Input Resource being substituted for the <b>arguments</b> value given.']['german']="Abfrageparameter sind & custom = Argumente innerhalb der HIS URL angegeben, die sich in {Keyword} Einträge in Ihrem Eingang Ressource für die <b> Argumente </ b>-Wert angegeben ersetzt.";
$translation['from now']['chinesesimplified']="查询参数是的&自定义=参数内的HIS URL给出{关键词}项中输入资源被取代的<b>值</ b>的值给定的参数。";
$translation['Query Parameters are &custom=arguments given inside the HIS URL that result in {keyword} entries in your Input Resource being substituted for the <b>arguments</b> value given.']['bulgarian']="Параметрите на заявката са &потребителски=аргументи дадени във вътрешността на URL, които водят в {ключова дума} вписвания в Вашият принос ресурс заменят за <b> аргументи </ B> стойност, като се има предвид.";

$translation['from now']['english']="from now";
$translation['from now']['german']="in der Zukunft";
$translation['from now']['chinesesimplified']="在未来";
$translation['from now']['bulgarian']="в бъдеще";

$translation['function parameters 1']['english']="Query Parameters are &custom=arguments given inside the HIS URL that result in {keyword} entries in your Input Resource being substituted for the <b>arguments</b> value given.";
$translation['function parameters 1']['german']="Abfrageparameter sind & custom = Argumente innerhalb der HIS URL angegeben, die sich in {Keyword} Einträge in Ihrem Eingang Ressource für die <b> Argumente </b>-Wert angegeben ersetzt.";
$translation['function parameters 1']['chinesesimplified']="查询参数是的&自定义=参数内的HIS URL给出{关键词}项中输入资源被取代的<b>值</ b>的值给定的参数。";
$translation['function parameters 1']['bulgarian']="Параметрите на заявката са &потребителски=аргументи дадени във вътрешността на URL, които водят в {ключова дума} вписвания в Вашият принос ресурс заменят за <b> аргументи </b> стойност, като се има предвид.";

$translation['function parameters 2']['english']="In the HIS URL above, <b>arg1</b> and <b>arg2</b> could be the GET parameters for 2 separate function parameters created. The {keywords} specified inside of the Input Resource %can be% any text whatsoever, but it [[usually]] helps to delimit your keywords inside of your text with some kind of :readable: specifiers that shows that they are @keywords.";
$translation['function parameters 2']['german']="In der HIS URL oben <b> arg1 </b> und <b> arg2 </b> könnte die GET-Parameter für 2 getrennte Abfrage-Parameter erstellt. Die {keywords} Innenseite der Eingang Ressource% angegeben werden% betragen beliebiger Text auch immer, aber es [[Regel]] hilft, um Ihre Keywords innerhalb Ihres Textes abzugrenzen mit irgendeiner Art von: lesbar: Spezifizierer, dass sie @ Schlüsselwörter sind zeigt.";
$translation['function parameters 2']['chinesesimplified']="在他的网址上面，<b>的ARG1</b>和<b> ARG2</b>可以是GET参数为2个独立的查询参数创建。 {关键词}内指定的输入资源％％因任何文字，但[[内分隔]]您的关键字，您的文字与某种可读：符，表明他们是@关键字。";
$translation['function parameters 2']['bulgarian']="В URL-горе, <b>arg1</b> и <b>arg2</b> може да бъде GET параметри за две отделни заявки, създадени параметри. {Ключови думи}, определени в рамките на Ресурсен% принос може да бъде% какъвто и да е всеки текст, но това [обикновено]] помага да се очертае своите ключови думи вътре в текста си с някакъв вид: четене: спецификатори, които показват, че те са @ ключови думи.";

$translation['blank filtering expression 1']['english']="Since your <a href='?q=qn&v=filtering-expression'>Filtering Expression</a> is currently blank, the raw output file created by your Input Resource execution is the output of your HIS Query.  What type of file is your Input Resource execution producing?<br/><br/>

- Are you giving raw text as input (using your Input Resource given), specifying in Input Resource Type of (Text to Speech [Festival TTS Linux]), and producing MP3 output?  You would pick audio/mpeg3 as the Output MIME type.";
$translation['blank filtering expression 1']['german']="Da Ihr <a href='?q=qn&v=filtering-expression'>Filtering Expression</a> ist derzeit leer, ist der Roh-Ausgabedatei von Ihrem Input-Ressource Ausführung erstellt die Ausgabe des HIS-Abfrage. Welche Art von Datei wird Ihren Input-Ressource Ausführung produziert? <br/><br/>

- Gibst du Rohtext als Eingang (mit Ihrem Input-Ressource angegeben), und geben Sie im Input Ressourcentyp von (Text-to-Speech [Festival TTS Linux]) und Erzeugen MP3-Ausgabe? Sie würden audio/mpeg3 als Output MIME-Typ zu wählen.";
$translation['blank filtering expression 1']['chinesesimplified']="由于您的的<a href='?q=qn&v=filtering-expression'>过滤表达式</a>目前是空白的，您的输入资源执行的原始创建的输出文件是您的HIS查询的输出。什么类型的文件输入资源执行<BR/> <BR/>生产？

- 你给原始文本输入（使用输入资源），并指定在输入资源的类型（文本到语音[TTS Linux的节]），和MP3输出？你会选择audio/mpeg3作为输出的MIME类型。";
$translation['blank filtering expression 1']['bulgarian']="От <a href='?q=qn&v=filtering-expression'> Филтриране Изразяване </a> в момента е празно, суров изходен файл, създаден от изпълнение Input ресурси е изхода на вашия HIS Запитване. Какъв тип файл изпълнение Input ресурси за производство на <br/> <br/>

- Възможно ли е да дава суров текст като вход (с използване на дава Input ресурси), като посочва Тип на ресурса на въвеждане (текст на речта фестивал TTS Linux]), както и производство на MP3 изход? Вие ще вземете audio/mpeg3 като изход MIME тип.";

$translation['nonblank filtering expression 1']['english']="Since your <a href='?q=qn&v=filtering-expression'>Filtering Expression</a> is not blank, your Filter Expression Regular Expressions and string processing settings will process the file collected by your Input Resource execution.  What type of final output data is produced by your Filtering Expressions?<br/><br/>

- Are you collecting HTML data (using your Input Resource given), filtering (using Filtering Expressions), and producing XML output?  You would pick text/xml as the Output MIME type.<br/><br/>

In other circumstances, if your Input Resource given results in binary data being generated (such as giving text as input, and outputing a MP3 file using Festival TTS on Linux), you could delete your Filtering Expression, at which point the Output MIME type specified here would apply to the binary file generated by your Input Resource.";


$translation['nonblank filtering expression 1']['german']="Da Ihr <a href='?q=qn&v=filtering-expression'>Filtering Expression</a> ist nicht leer, wird Ihr Filter Expression Reguläre Ausdrücke und String-Verarbeitung Einstellungen bearbeiten Sie die Datei von Ihrem Input-Ressource Ausführung gesammelt. Welche Art der endgültigen Ausgabe erfolgt durch Ihre Filter Expressions hergestellt? <br/><br/>

- Sind Sie sammeln HTML-Daten (mit Ihrem Input-Ressource angegeben), Filterung (mit Filter Expressions), und produziert XML-Ausgabe? Sie würden text/xml als Output MIME-Typ zu wählen. <br/><br/>

In anderen Fällen, wenn Ihr Input-Ressource Ergebnisse in binäre Daten erzeugt (wie z. B. den Text als Eingabe und Ausgabe eines MP3-Datei mit Festival TTS auf Linux) gegeben, könnten Sie löschen Filtering Expression, an welchem ​​Punkt der Output MIME-Typ angegeben hier würde die binär-Datei von Ihrem Input-Ressource erzeugt gelten.";
$translation['nonblank filtering expression 1']['chinesesimplified']="由于您的的<a href='?q=qn&v=filtering-expression'>过滤表达式</a>不为空，你的过滤器表达式正则表达式和字符串处理设置处理文件的方式收集您的输入资源执行。什么类型的最终输出数据是由您的过滤表达式时<br/><br/>

- 你收集的HTML数据（使用输入资源），过滤（使用过滤表达式），并生成XML输出​​？你会选择文本/ xml作为输出MIME类型<BR/> <BR/>的

在其他情况下，如果你的输入资源的结果所产生的二进制数据（如文本作为输入，并允许输出MP3文件在Linux上使用节TTS），你可以删除您的筛选表达式，在这一点上，输出指定的MIME类型这里将适用于您的输入资源生成的二进制文件。";
$translation['nonblank filtering expression 1']['bulgarian']="От <a href='?q=qn&v=filtering-expression'> Филтриране Изразяване </a> не е празно, вашия филтър израз регулярни изрази и настройки струнни ще обработва на файл, събрани от изпълнението Input ресурси. Какъв тип на крайната продукция данни се произвежда от вашите Филтриране на изразяване? <br/> <br/>

- Събиране на HTML данни (използвайки Input ресурси), филтриране (Филтриране на изразяване), и производство на XML изход? Вие ще вземете текст / XML изход MIME тип. <br/> <br/>

При други обстоятелства, ако Вашият принос ресурси резултати в двоични данни, генерирани (като например даване на текст като вход и изведе MP3 файл, използвайки фестивал TTS на Linux), можете да изтриете Филтриране Изразяване, в която точка на изхода MIME определен тип тук ще се прилага за двоичен файл, генериран от вашия вход ресурси.";

$translation['Select output file MIME type']['english']="Select output file MIME type";
$translation['Select output file MIME type']['german']="Wählen Sie Ausgabedatei MIME-Typ";
$translation['Select output file MIME type']['chinesesimplified']="选择输出文件的MIME类型";
$translation['Select output file MIME type']['bulgarian']="Изберете изходния файл MIME тип";

$translation['Current Job Server Filters']['english']="Current Job Server Filters";
$translation['Current Job Server Filters']['german']="Aktuelle Job Server Filter";
$translation['Current Job Server Filters']['chinesesimplified']="目前的工作服务器过滤器";
$translation['Current Job Server Filters']['bulgarian']="Текущи Работа сървър Филтри";

$translation['No filters found.']['english']="No filters found.";
$translation['No filters found.']['german']="Keine Filter gefunden.";
$translation['No filters found.']['chinesesimplified']="没有过滤器。";
$translation['No filters found.']['bulgarian']="Няма филтри.";

$translation['Only run THIS function/job on a node/server whose "-node" name matches this pattern']['english']='Only run THIS function/job on a node/server whose "-node" name matches this pattern';
$translation['Only run THIS function/job on a node/server whose "-node" name matches this pattern']['german']='Nur diese Abfrage / job auf einem Knoten / Server, dessen "Knoten" name passt dieses Muster';
$translation['Only run THIS function/job on a node/server whose "-node" name matches this pattern']['chinesesimplified']='只有运行此查询/工作/服务器的节点上的“节点”的名称与此模式匹配';
$translation['Only run THIS function/job on a node/server whose "-node" name matches this pattern']['bulgarian']='Само стартирате тази заявка / работа на възел / сървър, чиито "възел" име съвпада с този модел';

$translation['List of Server Nodes for Job Processing']['english']="List of Server Nodes for Job Processing";
$translation['List of Server Nodes for Job Processing']['german']="Liste der Server Nodes für Auftragsbearbeitung";
$translation['List of Server Nodes for Job Processing']['chinesesimplified']="作业处理的服务器节点列表";
$translation['List of Server Nodes for Job Processing']['bulgarian']="Списък на сървъра възли за обработка на работа";

$translation['No job servers have been added yet.']['english']="No job servers have been added yet.";
$translation['No job servers have been added yet.']['german']="Keine Job Servern wurden noch aufgenommen.";
$translation['No job servers have been added yet.']['chinesesimplified']="目前没有工作的服务器已被添加。";
$translation['No job servers have been added yet.']['bulgarian']="Сървърите без работа са били добавени още.";

$translation['After you have done that, click "Run the install".']['english']='After you have done that, click "Run the install".';
$translation['After you have done that, click "Run the install".']['german']='Nachdem Sie das getan haben, klicken Sie auf "Führen Sie das Installationsprogramm".';
$translation['After you have done that, click "Run the install".']['chinesesimplified']='你这样做之后，单击“运行安装”。';
$translation['After you have done that, click "Run the install".']['bulgarian']='След като сте направили това, щракнете върху "Run инсталацията".';

$translation['Run the Install']['english']="Run the Install";
$translation['Run the Install']['german']="Führen Sie die Installation";
$translation['from']['chinesesimplified']="運行安裝";
$translation['from']['bulgarian']="Стартирайте Install";

$translation['here']['english']="here";
$translation['here']['german']="hier";
$translation['here']['chinesesimplified']="这里";
$translation['here']['bulgarian']="тук";

$translation['Modify Current Filtering Expression']['english']="Modify Current Filtering Expression";
$translation['Modify Current Filtering Expression']['german']="Ändern Aktuelle Filtering Expression";
$translation['Modify Current Filtering Expression']['chinesesimplified']="修改当前的筛选表达式";
$translation['Modify Current Filtering Expression']['bulgarian']="Промяна на съвременни филтриращи Изразяване";


$translation['Contact support.']['english']="Contact support.";
$translation['Contact support.']['german']="Kontaktieren Sie den Support.";
$translation['Contact support.']['chinesesimplified']="联系技术支持。";
$translation['Contact support.']['bulgarian']="Свържете се с подкрепа.";


$translation['If a blank regular expression is given']['english']="If a <b>blank</b> regular expression is given";
$translation['If a blank regular expression is given']['german']="Wenn ein <b>blank</b> regulären Ausdruck gegeben wird";
$translation['If a blank regular expression is given']['chinesesimplified']="如果一个<b>的空白</ B>正则表达式";
$translation['If a blank regular expression is given']['bulgarian']="Ако <b>празно</b> е даден регулярен израз";


$translation['then raw byte data gathered']['english']="then raw byte data gathered from the Input Resource is returned/displayed/POSTBACK'd onward (see <a href='?q=qn&v=output-expression'>Output Expressions</a>) without further processing.";
$translation['then raw byte data gathered']['german']="dann raw Byte Daten aus dem Input-Ressource gesammelt wird zurückgegeben / angezeigt / Postback 'd Weitertransport (siehe <a href='?q=qn&v=output-expression'>Output Expressions</a>) ohne weitere Verarbeitung.";
$translation['then raw byte data gathered']['chinesesimplified']="然后将返回原始字节数据输入资源的收集/显示/回发的“起（看到<a href='?q=qn&v=output-expression'>的输出表达式</a>）未经进一步加工。";
$translation['then raw byte data gathered']['bulgarian']="сурови байт данни, събрани от входните ресурси се връща / показва г-нататъшното / POSTBACK (виж <a href='?q=qn&v=output-expression'>Изходни изразяване</a>), без по-нататъшна преработка.";

$translation['No Output Expressions specified yet.']['english']="No Output Expressions specified yet.";
$translation['No Output Expressions specified yet.']['german']="Keine Output Methoden spezifiziert noch";
$translation['No Output Expressions specified yet.']['chinesesimplified']="尚未指定任何输出方法";
$translation['No Output Expressions specified yet.']['bulgarian']="Методите, посочени все още няма изход";

$translation['Keyword']['english']="Keyword";
$translation['Keyword']['german']="Stichwort";
$translation['Keyword']['chinesesimplified']="关键词";
$translation['Keyword']['bulgarian']="Ключова дума";

$translation['GET Parameter']['english']="GET Parameter";
$translation['GET Parameter']['german']="GET Parameter";
$translation['GET Parameter']['chinesesimplified']="获取参数";
$translation['GET Parameter']['bulgarian']="GET параметър";

$translation['Default Value']['english']="Default Value";
$translation['Default Value']['german']="Default Value";
$translation['Default Value']['chinesesimplified']="默认值";
$translation['Default Value']['bulgarian']="стойност по подразбиране";


$translation['Current Value']['english']="Current Value";
$translation['Current Value']['german']="Aktueller Wert";
$translation['Current Value']['chinesesimplified']="当前值";
$translation['Current Value']['bulgarian']="стойност";


$translation['Preserve UrlEncode']['english']="Preserve UrlEncode";
$translation['Preserve UrlEncode']['german']="Bewahren URL Encode";
$translation['Preserve UrlEncode']['chinesesimplified']="保留URL编码";
$translation['Preserve UrlEncode']['bulgarian']="резерват URL кодиране";


$translation['Action']['english']="Action";
$translation['Action']['german']="Aktion";
$translation['Action']['chinesesimplified']="行动";
$translation['Action']['bulgarian']="действие";

$translation['No function parameters yet provided.']['english']="No function parameters yet provided.";
$translation['No function parameters yet provided.']['german']="Keine Abfrageparameter noch vorgesehen.";
$translation['No function parameters yet provided.']['chinesesimplified']="没有查询参数。";
$translation['No function parameters yet provided.']['bulgarian']="Параметрите на заявката не още.";

$translation['Add a New Parameter']['english']="Add a New Parameter";
$translation['Add a New Parameter']['german']="Hinzufügen eines neuen Parameter";
$translation['Add a New Parameter']['chinesesimplified']="添加一个新参数";
$translation['Add a New Parameter']['bulgarian']="Добавяне на нов параметър";

$translation['time behavior 1']['english']="You can call THIS_SERVER and wait for final HIS content synchronously, but if data collection or processing takes more than 30 seconds, it is likely that Apache will time out. In that cirucumstance, it makes more sense to use \"POSTBACK\"-style functionality.<br/><br/>

Are you collecting large amounts of data, processing large amounts of text, scraping many web pages, or nesting HIS queries in other HIS queries? If yes, then POSTBACK may be for you.<br/><br/>

POSTBACK is more appropriate for regularly-scheduled data-mining style circumstances. Create a small database table somewhere else, and setup a page to collect GET/POST data that HIS will ping data to. Set \"Wait Behaviour\" here equal to \"POSTBACK\", and specify a POSTBACK url in Output Expressions section that HIS to send your result/filtered data to.";
$translation['time behavior 1']['german']="Sie können THIS_SERVER und warten für die endgültige HIS Inhalte synchron, aber wenn die Daten gesammelt oder verarbeitet dauert mehr als 30 Sekunden, ist es wahrscheinlich, dass der Apache Zeitüberschreitung. In diesem cirucumstance, macht es mehr Sinn, mit \"Postback\"-Stil Funktionalität.<br/><br/>

Sind Sie sammeln große Mengen von Daten, die Verarbeitung großer Mengen von Text, Schaben viele Web-Seiten oder nisten HIS Abfragen in anderen HIS Fragen? Wenn ja, dann Postback für Sie sein.<br/><br/>

Postback ist besser geeignet für regulär geplanten Data-Mining-Stil Umständen. Erstellen Sie eine kleine Datenbank-Tabelle irgendwo anders, und das Setup eine Seite zu sammeln GET / POST-Daten, dass seine Daten zu pingen wird. Set \"Warten Behaviour\" hier gleich \"Postback\", und geben Sie einen Postback url in Output Expressions Abschnitt, HIS, um Ihr Ergebnis / gefilterten Daten zu senden.";
$translation['time behavior 1']['chinesesimplified']="您可以打电话THIS_SERVER，并等待最后他的内容同步，但如果数据收集或处理的时间超过30秒，它很可能是Apache会超时。在这种cirucumstance，它使更多的意义上使用\“\”式的回发功能。<br/><br/>

你收集的大量数据，处理大量的文字，刮许多网页，或嵌套HIS的查询，其查询？如果是的话，然后回发可能会适合你。<br/><br/>

回发定期调度数据挖掘风格的情况下，是比较合适的。其他地方创建一个小的数据库表，并设置一个页面来收集GET/POST数据，他将ping的数据。设置\“等待行为\”\\“回发”，和输出表达式“一节中，他把你的结果/过滤数据，以指定的回传网址。";
$translation['time behavior 1']['bulgarian']="Можете да се обадите THIS_SERVER и изчакайте за окончателното му съдържание синхронно, но ако събирането и обработката на данни отнема повече от 30 секунди, това е вероятно, че Apache ще Time Out. В този cirucumstance, че има повече смисъл да се използва \"POSTBACK\" стил, функционалност.<br/><br/>

Възможно ли е събирането на големи обеми от данни, обработка на големи количества текст, остъргване много уеб страници, или гнездене своите заявки в други негови запитвания? Ако отговорът \"да\", тогава POSTBACK може да бъде за вас.<br/><br/>

POSTBACK е по-подходящ за редовно разписание данни минни стил обстоятелства. Създайте малка масичка база данни някъде другаде, и настроите страница, за да събере GET / POST данни, които ще пинг данни. Set \"Изчакайте поведение\" тук равна на \"POSTBACK\" и укажете URL адреса POSTBACK в Output изразяване раздел, че HIS, за да изпратите резултат / филтрирани данни на.";

$translation['Respond instantly to GET/POST requests (see "Output Expressions" page)']['english']='Respond instantly to GET/POST requests (see "Output Expressions" page)';
$translation['Respond instantly to GET/POST requests (see "Output Expressions" page)']['german']='Reagieren Sie sofort auf GET / POST-Requests (siehe "Output Expressions"-Seite)';
$translation['Respond instantly to GET/POST requests (see "Output Expressions" page)']['chinesesimplified']='即时响应GET / POST请求（请参阅“输出表达式”页面）';
$translation['Respond instantly to GET/POST requests (see "Output Expressions" page)']['bulgarian']='Отговорим незабавно за GET / POST заявки (виж "Изходни изразяване" страница)';

$translation['Respond to GET/POST requests when HIS Function finishes processing']['english']="Respond to GET/POST requests when HIS Function finishes processing";
$translation['Respond to GET/POST requests when HIS Function finishes processing']['german']="Reagieren Sie auf GET / POST-Anfragen, wenn seine Funktion beendet die Verarbeitung";
$translation['Respond to GET/POST requests when HIS Function finishes processing']['chinesesimplified']="响应GET / POST请求时，他的功能处理完毕";
$translation['Respond to GET/POST requests when HIS Function finishes processing']['bulgarian']="Отговорим GET / POST заявки, когато Неговата функция завършва обработка";

$translation['Select wait behavior']['english']="Select wait behavior";
$translation['Select wait behavior']['german']="Wählen Sie warten Verhalten";
$translation['Select wait behavior']['chinesesimplified']="选择等待的行为";
$translation['Select wait behavior']['bulgarian']="Изберете изчакайте поведение";

$translation['Whitespace Sensitivity']['english']="Whitespace Sensitivity";
$translation['Whitespace Sensitivity']['german']="празно Чувствителност";
$translation['Whitespace Sensitivity']['chinesesimplified']="的空白灵敏度";
$translation['Whitespace Sensitivity']['bulgarian']="празно Чувствителност";

$translation['Sensitive to whitespace?']['english']="Sensitive to whitespace?";
$translation['Sensitive to whitespace?']['german']="Empfindlich gegen Leerzeichen?";
$translation['Sensitive to whitespace?']['chinesesimplified']="敏感的空白？";
$translation['Sensitive to whitespace?']['bulgarian']="Чувствителен към празно пространство?";

$translation['Replace this [keyword]']['english']="Replace this [keyword], found inside of output values)";
$translation['Replace this [keyword]']['german']="Ersetzen Sie diese [keyword], gefunden Innenseite Ausgangswerte)";
$translation['Replace this [keyword]']['chinesesimplified']="更换[关键词]发现里面的输出值）";
$translation['Replace this [keyword]']['bulgarian']="Замени от този [ключова дума], намерени във вътрешността на изходните стойности)";

$translation['With the value of this POST Parameter']['english']="With the value of this POST Parameter";
$translation['With the value of this POST Parameter']['german']="Mit dem Wert dieser POST Parameter";
$translation['With the value of this POST Parameter']['chinesesimplified']="随着这POST参数值";
$translation['With the value of this POST Parameter']['bulgarian']="Със стойността <br/> на този POST параметър";

$translation['Preserve POST params']['english']="Preserve POST params in their<br/>natural urlencoded value?";
$translation['Preserve POST params']['german']="Preserve POST params in ihrer <br/> natürlichen urlencoded Wert?";
$translation['Preserve POST params']['chinesesimplified']="保留POST参数<BR/>自然进行了urlencoded值的吗？";
$translation['Preserve POST params']['bulgarian']="Запазване POST params в тяхната <br/> естествен urlencoded стойност?";

$translation['keyword secret description']['english']='{Keyword_secret} KEYWORD entries (above) whose {name} contains "hidden", "secret", "pass", or "pw", will have their values ****** in this interface.';
$translation['keyword secret description']['german']='{Keyword_secret} STICHWORT Einträge (oben), deren {name} enthält "versteckt", "geheim", "pass" oder "pw", haben ihre Werte ****** in diese Schnittstelle.';
$translation['keyword secret description']['chinesesimplified']="关键字条目的{Keyword_secret}（以上）的{名}包含“隐藏”，“秘密”，“通行证”，或“PW”，将其值******在此界面中。";
$translation['keyword secret description']['bulgarian']='{Keyword_secret} ключови думи записи (по-горе), чиято {име} съдържа "скрит", "таен", "пас", или "PW", ще има своите ценности ****** в този интерфейс.';

$translation['Add Parameter']['english']="Add Parameter";
$translation['Add Parameter']['german']="Parameter Hinzufügen";
$translation['Add Parameter']['chinesesimplified']="添加参数";
$translation['Add Parameter']['bulgarian']="Добави Параметър";

$translation['please']['english']="please";
$translation['please']['german']="gefallen";
$translation['please']['chinesesimplified']="请";
$translation['please']['bulgarian']="моля";

$translation['function parameter default value help']['english']="Passed in via POST<br/>
Example: <b>Atlanta%2C+GA</b><br/>
Final value will be <b>Atlanta, GA</b><br/><br/>

The value entered here will<br/>be used for {cityname}, if &cityname=VALUE<br/>
is not found in POST";
$translation['function parameter default value help']['german']="Bestanden in via POST <br/>
Beispiel: <b>Atlanta% 2C + GA </b> <br/>
Endwert wird <b>Atlanta, GA </b> <br/> sein

Der hier eingegebene Wert wird <br/> verwendet werden {cityname} if & cityname = VALUE <br/>
nicht in POST gefunden";
$translation['function parameter default value help']['chinesesimplified']="通过在通过POST<br/>
例如：<b>的亚特兰大％2C+ GA</b> <br/>
最终的值将是<b>的亚特兰大，GA</b>时

此处输入的值将<br/>
用于{，如果和城市名城市名}= VALUE<br/>
还没有发现在POST";
$translation['function parameter default value help']['bulgarian']="Приет през POST <br/>
Пример: <b>Атланта% 2C + GA </b> <br/>
Крайната стойност ще бъде <b>Атланта, щата Джорджия </b> <br/> <br/>

Въведената стойност тук ще <br/>
се използва за {cityname}, ако и cityname = стойност <br/>
не се намира във POST";

$translation['mime message 1']['english']="There are nearly 100 mime types below to choose from. The final output files generated by HIS will be given the mime type you select when final CXML output is written.";
$translation['mime message 1']['german']="Es gibt fast 100 MIME-Typen unter zur Auswahl. Die endgültige Ausgabe Dateien, die von HIS generiert werden den MIME-Typ Sie auswählen, wenn endgültige CXML Ausgabe geschrieben wird gegeben werden.";
$translation['mime message 1']['chinesesimplified']="有近100个以下的MIME类型选择。将最终生成的输出文件由他定的MIME类型时选择最终的的CXML输出的书面。";
$translation['mime message 1']['bulgarian']="Има близо 100 MIME видове-долу, за да избирате. Окончателните изходните файлове, генерирани от HIS ще бъде дадена мим тип да избереш кога окончателно CXML изход е писано.";

$translation['current process list']['english']="Current List of Processes to Terminate if Maximum Run Time is reached";
$translation['current process list']['german']="Aktuelle Liste der Prozesse zu beenden, wenn Maximale Laufzeit erreicht";
$translation['current process list']['chinesesimplified']="当前的进程列表，终止，如果达到最大运行时间";
$translation['current process list']['bulgarian']="Актуален списък на процесите, за да се прекратява, ако се достигне Максимална Run Time";


$translation['add new process']['english']="Add a New Process Name to Terminate if Maximum Run Time is reached";
$translation['add new process']['german']="Hinzufügen eines neuen Process Name zu kündigen, wenn Maximale Laufzeit erreicht";
$translation['add new process']['chinesesimplified']="添加新的进程名来终止，如果达到最大运行时间，";
$translation['add new process']['bulgarian']="Добави ново име на процес, за да се прекратява, ако се достигне Максимална Run Time";


$translation['No Process Names specified yet.']['english']="No Process Names specified yet.";
$translation['No Process Names specified yet.']['german']="Kein Prozess Names festgelegt.";
$translation['No Process Names specified yet.']['chinesesimplified']="没有指定的进程名称还。";
$translation['No Process Names specified yet.']['bulgarian']="Никой процес наименованията, уточнени още.";


$translation['max function run time seconds']['english']="Most of the times, things go well, but sometimes Input Resources might contain logic errors, or might try to process more information than they should, tying up valuable compute nodes. In order to prevent hanging or frozen jobs, a maximum run time for this function can be specified.<br/><br/>

Maximum Run time for this function (in seconds)";
$translation['max function run time seconds']['german']="Die meisten der Zeit, gehen die Dinge gut, aber manchmal Eingang Ressourcen könnten logische Fehler enthalten, oder vielleicht versuchen, mehr Informationen, als sie verarbeiten soll, binden wertvolle Rechenknoten. Um zu hängen oder gefroren Arbeitsplätze, eine maximale Laufzeit für diese Abfrage verhindern kann angegeben werden. <br/><br/>

Maximale Laufzeit für diese Abfrage (in Sekunden)";
$translation['max function run time seconds']['chinesesimplified']="大部分的时候，事情顺利，但有时投入资源可能包含逻辑错误，或可能会尝试比他们要处理更多的信息，占用宝贵的计算节点。为了防止悬挂或冻结的就业机会，这个查询的最长运行时间可指定时<br/><br/>

此查询的最长运行时间（以秒为单位）";
$translation['max function run time seconds']['bulgarian']="Повечето от времето, нещата вървят добре, но понякога входящи ресурси може да съдържа логически грешки, или да се опита да обработва повече информация, отколкото трябва, обвързването на ценни възли изчислителни. За да се предотврати обесване или замразени работни места, максимално работно време за тази заявка може да бъде определен. <br/> <br/>

Максимална Run време за тази заявка (в секунди)";

$translation['if max processes']['english']="If the maxmium run time is encountered, the following processes should be terminated";
$translation['if max processes']['german']="Wenn die Maxmium Laufzeit angetroffen wird, sollten die folgenden Prozesse beendet werden";
$translation['if max processes']['chinesesimplified']="如果遇到的最大运行时间，下面的过程应该被终止";
$translation['if max processes']['bulgarian']="Ако времето maxmium план се срещат следните процеси трябва да бъде прекратена";

$translation['slow response']['english']="Also known as 'Slow Response'.<br/><br/>

GET or POST requests against HIS Query URL <u>will finish as soon as HIS Query completes processing</u>, actual HIS results CXML content produced with Filtering Expressions <u>will</u> be contained within result content.<br/><br/>

This means that if your HIS Query takes 10 seconds, 10 minutes, 10 hours, or 10 days to finish, the GET or POST request will attempt to be kept alive until your <a href='?q=qn&v=input-resource'>Input Resource</a> is gathered, and your <a href='?q=qn&v=input-resource'>Filtering Expression</a> processes the gathered data.  The final output processed result will be returned.<br/><br/>

Note: Apache may timeout after a relatively short period of time.  Feel free to adjust your web server settings, but keep in mind increasing general systemwide keep-alive times may result in severe web server preformance degradation.";
$translation['slow response']['german']="Auch als 'Slow Response' bekannt. <br/><br/>

GET-oder POST-Anfragen gegen seine Abfrage URL <u> wird so bald wie HIS Abfrageverarbeitung </u>, aktuelle HIS Ergebnisse CXML Inhalte mit Filtern Expressions hergestellt <u>Willen </u> innerhalb Ergebnis Inhalte enthalten sein. <br/><br/>

Dies bedeutet, dass, wenn Ihr seine Abfrage dauert 10 Sekunden, 10 Minuten, 10 Stunden oder 10 Tage bis zum Ende der GET-oder POST-Anfrage wird versuchen, am Leben gehalten werden, bis die <a href = '?q=qn&v=input-resource'>Input Ressource</a> gesammelt und Ihre <a href='?q=qn&v=filtering-expression'>Filtering Expression</a> verarbeitet die gesammelten Daten. Die endgültige Ausgabe verarbeitet Ergebnis wird zurückgegeben. <br/><br/>

Hinweis: Apache kann Timeout nach einer relativ kurzen Zeit. Fühlen Sie sich frei, um Ihre Web-Server-Einstellungen anzupassen, aber bedenken Sie, Steigerung der allgemeinen systemweite Keep-Alive-Zeiten können in schweren Webserver preformance Abbau führen.";
$translation['slow response']['chinesesimplified']="也被称为“慢反应”。<br/><br/>

GET或POST请求对他的查询URL<u>的完成，尽快完成他的查询处理</u>，实际他的研究结果CXML内容过滤表达式<u>意志</u>被包含在结果内容。...... /><br/>

这意味着，如果你的HIS查询需要10秒，10分钟，10小时，或10天完成，在GET或POST请求的会试图到被保持活着，直到您的<a href='?q=qn&v=input-resource'>输入资源</a>聚集，的<a href='?q=qn&v=filtering-expression'>过滤表达</a>收集到的数据进行处理。最终的输出处理结果将被返回。<br/><br/>

注：Apache可能在相对较短的时间内超时。随意调整您的Web服务器的设置，但要记住，一般整个系统的保活时间增加，可能会导致严重的网络服务器性能与降解。";
$translation['slow response']['bulgarian']="Също известен като \"бавна реакция\". <br/> <br/>

GET или POST искания срещу Запитване URL <u>ще приключи веднага щом Запитване му завършва обработка </u>, действително резултатите си CXML съдържание, произведено с филтриране на изразяване <u>воля</u> се съдържат в резултат съдържание. <br/> <br/>

Това означава, че ако си HIS Запитване отнема 10 секунди, на 10 минути, 10 часа, или 10 дни да завърши, на GET или POST искане ще се опитат да се държат жив, докато си <а href='?q=qn&v=input-resource'>Input Ресурс </a> се събира, и <a href='?q=qn&v=filtering-expression'> Филтриране Изразяване </a> обработва събраните данни. Крайната продукция, преработено резултат на това ще бъдат върнати. <br/> <br/>

Забележка: Apache може паузата, след сравнително кратък период от време. Чувствайте се свободни да коригирате настройките си уеб сървър, но имайте предвид, увеличаване на общата systemwide запази живи пъти може да доведе до тежка деградация на уеб сървъра на експлоатационните показатели.";

$translation['Function Maximum Run Time']['english']="Function Maximum Run Time";
$translation['Function Maximum Run Time']['german']="Funktion Maximale Laufzeit";
$translation['Function Maximum Run Time']['chinesesimplified']="功能最大运行时间";
$translation['Function Maximum Run Time']['bulgarian']="Function Maximum Run Time";

$translation['output expression 1']['english']="When your Query finishes collecting its <a href='?q=qn&v=input-resource'>input content</a> & running its <a href='?q=qn&v=filtering-expression'>filtering expressions</a>, output is generated. The output might be XML data, CSV data, or any other file type.<br/><br/>

You have to decide about what to do with that data. If your function takes less than 30 seconds to finish, printing the data directly (i.e., no Output Expression) is possible. Howver, if your function takes several minutes to run, or you are in engaging in systematic, continued data collection or have external databases and servers waiting to collect response data, POSTBACK (final result data transmitted to location you specify)-style functionalities are best.";
$translation['output expression 1']['german']="Wenn Ihre Abfrage beendet Sammeln ihrer <a href='?q=qn&v=input-resource'>Eingangs-Content</a> & Laufen seinen <a href='?q=qn&v=filtering-expression'>Filterung Ausdrücke</a>, wird der Ausgang erzeugt. Die Ausgabe könnte XML-Daten, CSV-Daten, oder jede andere Datei-Typ sein. <br/><br/>

Sie haben zu entscheiden, was mit diesen Daten tun. Wenn Ihre Abfrage dauert weniger als 30 Sekunden zu beenden, drucken Sie die Daten direkt (dh ohne Ausgabe Expression) ist möglich. Howver, wenn Ihre Abfrage dauert einige Minuten zu laufen, oder Sie sind, sich in eine systematische, kontinuierliche Datenerfassung oder externen Datenbanken und Server wartet auf Antwort Daten Postback-style-Funktionalitäten (Endergebnis Daten von Ihnen angegebenen Speicherort übertragen) sammeln sich am besten .";
$translation['output expression 1']['chinesesimplified']="当您的查询完成收集它的的<a href='?q=qn&v=input-resource'>输入的内容</a>＆运行<a href='?q=qn&v=filtering-expression'>的过滤表达式</a>，生成输出。输出可能是XML，CSV数据，或任何其他文件类型。<br/> <br/>

你必须决定做什么与数据。如果您的查询只需不到30秒完成，直接打印数据（即，没有输出表达式）是可能的。然而，如果您的查询需要几分钟的时间来运行，或者你是在从事系统的，持续的数据收集，或有外部的数据库和服务器，等待响应数据收集，回传（最终结果数据发送到您指定的位置）风格的功能是最好的。";
$translation['output expression 1']['bulgarian']="Когато вашата заявка приключи събирането на <a съдържание href='?q=qn&v=input-resource'> вход </a> и работи <a href='?q=qn&v=filtering-expression'> филтриране изрази </>, продукцията се генерира. Изходът може да бъде XML данни, CSV данни, или всеки друг тип файл. <br/> <br/>

Вие трябва да решите за какво да правим с тези данни. Ако вашата заявка отнема по-малко от 30 секунди, за да завърши, данните се разпечатват директно (т.е. няма изход израз) е възможно. Howver, ако вашата заявка отнема няколко минути да тичам, или сте в ангажирането на по-систематичен, продължаване на събирането на данни или външни бази данни и сървъри, които чакат да се съберат данни за отговора, POSTBACK (окончателните данни за резултатите, които се предават на местоположението укажете) стил функционалности са най-добрите .";

$translation['Current Output Expressions']['english']="Current Output Expressions";
$translation['Current Output Expressions']['german']="Stromausgang Expressions";
$translation['Current Output Expressions']['chinesesimplified']="电流输出表达式";
$translation['Current Output Expressions']['bulgarian']="Текущи изразяване Изходни";

$translation['Add Output Expression']['english']="Add Output Expression";
$translation['Add Output Expression']['german']="Ausgang hinzufügen Expression";
$translation['Add Output Expression']['chinesesimplified']="输出表达式";
$translation['Add Output Expression']['bulgarian']="Добави Изразяване Изход";

$translation['Output Type']['english']="Output Type";
$translation['Output Type']['german']="Art der Ausgabe";
$translation['Output Type']['chinesesimplified']="输出类型";
$translation['Output Type']['bulgarian']="Тип Мощност";

$translation['No Output Expressions specified yet.']['english']="No Output Expressions specified yet.";
$translation['No Output Expressions specified yet.']['german']="Keine Ausgabe Ausdrücke festgelegt.";
$translation['No Output Expressions specified yet.']['chinesesimplified']="没有指定的输出表达式还。";
$translation['No Output Expressions specified yet.']['bulgarian']="Изразяване, посочени все още няма изход.";




$translation['fast response']['english']='Also known as "Fast Response".<br/><br/>

GET or POST requests against HIS Query URL will finish instantly, no actual HIS results or processing will be contained within result content.<br/><br/>

Use HIS <a href="q=qn&v=output-expression">Output Expressions</a> to specify which URLS or servers that HIS should SEND final HIS function data to.';
$translation['fast response']['german']='Auch als "Fast Response" bekannt. <br/><br/>

GET-oder POST-Anfragen gegen seine Abfrage URL wird sofort beendet werden keine tatsächlichen HIS Ergebnisse oder Verarbeitung innerhalb Ergebnis Inhalte enthalten sein. <br/><br/>

Verwenden HIS <a href="q=qn&v=output-expression"> Output Ausdrücke </a>, um festzulegen, welche URLs oder Server, dass seine letzte HIS-Abfrage Daten senden soll.';
$translation['fast response']['chinesesimplified']='也被称为“快速反应”。<br/> <br/>

对他的查询URL的GET或POST请求将瞬间完成，没有任何实际的结果或处理将包含在结果内容。<br/> <br/>

他的的<a href="q=qn&v=output-expression">输出表达式</a>到指定的URL或服务器，他应该发送最后的查询数据。';
$translation['fast response']['bulgarian']='Също известен като "бърз отговор". <br/> <br/>

GET или POST искания срещу Запитване си URL ще завърши незабавно, без неговото действително резултатите или преработка ще се съдържат в резултат съдържание. <br/> <br/>

Неговата употреба <a изразяване Изходни href="q=qn&v=output-expression"> </a> да се уточни кои URL адреси или сървъри, които трябва да изпрати последната си заявка за данни, за да.';

$translation['Function Techniques Checklist']['english']="Function Techniques Checklist";
$translation['Function Techniques Checklist']['german']="Function Techniques Checkliste";
$translation['Function Techniques Checklist']['chinesesimplified']="功能技术清单";
$translation['Function Techniques Checklist']['bulgarian']="Функция Техники Чеклист";

$translation['techniques checklist']['english']="
<li>Enter Input Resource Type & Specification.</li>
<li>Enter Filterings Expression, if applicable.</li>
<li>Run your function on our job/compute cluster to collect content.</li>
<li>Enter sub-filtering expressions, if applicable.</li>
<li>Enter operations, if applicable.</li>
<li>Enter your own 'Output Method' POSTBACK url to receive job results at your own remote server.</li>
<li>Enter compute cluster node filter so that your job is run on the correct OS/configuration node.</li>
<li>Some compute nodes require passwords.  Give your Query a set of passwords so it can authenticate.</li>
<li>Enter Query Parameters for your Query so that you can pass in ?args=on&the=address bar for maximal re-usability.</li>
<li>Careful! Entering Query Parameters (user input) is dangerous! Add function parameter constraints to allow only certain inputs.</li>
<li>Tag your Query so that you can <a target='_new' href='this_server_url/?s=facebook,likes'>this_server_url/?s=facebook,likes</a> use a more readable URL</li>
<li>Give your function a MIME type so that it returns a certain Content-Type HTTP header.</li>
<li>View the Cache Activity to understand whether or not pre-cached content is being served (seen in Edit mode only)</li>
<li>Approve and Re-Approve source content collected from remote servers.  Allows function source content caching and massively<br/>increases performance!  Your function will load by default with this cached (pre-approved) content!</li>
<li>Source content 'Approval' also allows <a target='_new' href='this_server_url/?q=qn&use_approved=yes'>this_server_url/?q=qn&use_approved=yes</a> valid links.  Adantages from previous<br/>item, plus enhances debugability, allows for static/library-style queries, and is fully compatible with Query Parameters!</li>
<li>View your default XML-MODE output: <a target='_new' href='this_server_url/?q=qn&remote&xml'>this_server_url/?q=qn&remote&xml</a></li>
<li>XML-MODE output is boring and too long!  Enter 'Custom Headers' and 'Custom Footers' above and below the value entries<br/>at every step of your recursive regular expression specification!  Write out data in your own XML, CSV or (Insert Here) text schema<br/>using these headers and footers.</li>
<li>Once your 'Custom Headers/Footers' are defined, view your hf's CXML-MODE: <a target='_new' href='this_server_url/?q=qn&remote&cxml'>this_server_url/?q=qn&remote&cxml</a></li>
<li>Once your function is outputing exactly what you want, bookmark this output so that if your function breaks in the future, you have<br/>a record of your hf's filtered output formatting!  Hit the 'Store XML/CXML' Output button!</li>
";
$translation['techniques checklist']['german']="
<li> Eingang Ressourcentyp & Spezifikation. </li>
<li> Filterungen Expression, falls zutreffend. </li>
<li> Führen Sie Ihre Abfrage über unsere Jobbörse / Compute Cluster zum Inhalt zu sammeln. </li>
<li> sub-Filterung Ausdrücke, falls zutreffend. </li>
<li> Operationen, falls zutreffend. </li>
<li> Geben Sie Ihren eigenen 'Output Method' Postback url Stellenangebote Ergebnisse auf eigene Remote-Server zu erhalten. </li>
<li> Compute Cluster-Knoten Filter, so dass Ihre Arbeit auf dem richtigen OS / Konfiguration Knoten ausgeführt wird. </li>
<li> Einige Rechenknoten benötigen ein Passwort. Geben Sie Ihre Abfrage eine Reihe von Passwörtern so authentifizieren kann. </li>
<li> Abfrageparameter für Ihre Abfrage, so dass Sie in passieren kann? args = on & the = Adressleiste für maximale Wiederverwendbarkeit. </li>
<li> Vorsicht! Eingabe von Query-Parameter (Eingabe) ist gefährlich! Fügen Sie Abfrageparameter Einschränkungen nur für bestimmte Eingänge ermöglichen. </li>
<li> Tag Ihrer Abfrage, so dass Sie <a target='_new' href='this_server_url/?s=facebook,likes'>this_server_url/?s=facebook,likes</a> verwenden, eine besser lesbare URL </li>
<li> Geben Sie Ihre Anfrage einen MIME-Typ, so dass es eine bestimmte Content-Type HTTP-Header zurückgibt. </li>
<li> anzeigen Cache Aktivität zu verstehen, ob oder nicht pre-cached Inhalte serviert wird (zu sehen im Edit-Modus) </li>
<li> Genehmigen und erneut zu genehmigen Source Content von Remote-Servern gesammelt. Ermöglicht Abfrage-Source Content-Caching und massiv <br/> erhöht die Leistung! Ihre Anfrage wird standardmäßig mit diesem Cache (pre-approved) Inhalt zu laden! </li>
<li> Quelle content 'Genehmigung' ermöglicht auch <a target='_new' href='this_server_url/?q=qn&use_approved=yes'>this_server_url/?q=qn&use_approved=yes</a> gültige Links. Adantages aus früheren <br/> Stück, zzgl. verbessert debugability, ermöglicht static / library-style Abfragen und ist voll kompatibel mit Abfrage-Parameter! </li>
<li> anzeigen Ihr Standard-XML-MODE-Ausgang: <a target='_new' href='this_server_url/?q=qn&remote&xml'>this_server_url/?q=qn&remote&xml</a> </li>
<li> XML-MODE-Ausgang ist langweilig und zu lang! Geben Sie 'Custom Headers' und 'Custom Fußzeilen' oberhalb und unterhalb der Wert-Einträge <br/> bei jedem Schritt Ihrer rekursiven regulären Ausdruck Spezifikation! Schreiben von Daten in Ihrer eigenen XML, CSV oder (Legen Sie hier) Textschema Verwendung dieser Kopf-und Fußzeilen. <br/></li>
<li> Sobald Ihr 'Custom Kopfzeilen / Fußzeilen' definiert sind, Ihre Abfrage CXML-MODE: <a target='_new' href='this_server_url/?q=qn&remote&cxml'>this_server_url/?q=qn&remote&cxml</a> </li>
<li> Sobald Ihre Frage outputing genau das, was Sie wollen, bookmarken Ausgang, so dass, wenn Ihre Abfrage Pausen in der Zukunft, haben Sie <br/> eine Aufzeichnung Ihrer Abfrage gefiltert Ausgabeformatierung! Drücken Sie die 'Store XML / CXML' Output-Taste </li>
";
$translation['techniques checklist']['chinesesimplified']="
<li>输入资源的类型和规格。</li>
<li>输入的滤波表达（如适用）。</li>
我们的工作<li>运行您的查询/计算集群收集内容。</ li>
<li>输入过滤表达式，如适用。</li>
<li>输入操作，如果适用。</li>
<li>输入自己的“输出方式”回发的url在自己的远程服务器接收作业的结果。</li>
<li>输入计算集群节点过滤器，使你的工作是正确的OS /配置节点上运行。</li>
<li>一些计算节点需要密码。给您的查询密码一组，因此它可以进行身份​​验证。</li>
<li>输入您的查询的查询参数，使您可以通过在ARGS = - =地址栏，以获得最大的重用性。</li>
<li>小心！输入查询参数（用户输入）是危险的！添加查询参数的限制，只允许特定的输入。</li>
<li>标记您的查询，使您可以<a target='_new' href='this_server_url/?s=facebook,likes'>this_server_url/?s=facebook,likes</a>使用一个更可读的URL </li>
<li>给您的查询，它返回一个特定的内容类型HTTP标头的MIME类型。</li>
<li>查看高速缓存活动，以了解是否预缓存的内容是被服务（仅在编辑模式下）</li>
<li>批准并再次批准从远程服务器上收集的内容源。允许查询的源内容高速缓存和大量<BR/>提高了性能！您的查询将加载默认情况下这个缓存（预核准）的内容！</li>
也可以让<li>源内容'批准'<a target='_new' href='this_server_url/?q=qn&use_approved=yes'>this_server_url/?q=qn&use_approved=yes</a>的有效链接。从以前的Adantages <BR/>项目，再加上增强了可调试可以静态/图书馆式查询，查询参数，并完全兼容！</li>
<li>查看您的默认XML模式输出：<a target='_new' href='this_server_url/?q=qn&remote&xml'>this_server_url/?q=qn&remote&xml</a> </li>
<li> XML模式输出是枯燥的，太长了！输入“自定义页眉”和“自定义页脚”上面和下面的值项<BR/>的递归正则表达式规范的每一步！写在自己的XML，CSV或（在这里插入）文本的架构<BR/>使用这些页眉和页脚。</li>
您的“自定义页眉/页脚”<li>在被定义，查看您的查询的CXML-MODE：<a target='_new' href='this_server_url/?q=qn&remote&cxml'>this_server_url/?q=qn&remote&cxml</a > </li>
正是你想要的，你的查询<li>在被允许输出，因此，如果您的查询休息，在未来，你有<BR/>的记录，查询的过滤输出格式输出书签！命中“的存储XML /的CXML”输出按钮！</li>
";
$translation['techniques checklist']['bulgarian']="
<li> Въведете типа на входното ресурси и спецификация. </li>
<li> Въведете Filterings изразяване, ако е приложимо. </li>
<li> Пусни си заявка за нашата работа / изчисляване на клъстера с цел събиране на съдържание. </li>
<li> Въведете изрази под-филтриране, ако е приложимо. </li>
<li> Въведете операции, ако е приложимо. </li>
<li> Въведете POSTBACK URL свой собствен 'изход метод', за да получи резултатите за работа в отдалечен сървър. </li>
<li> Въведете изчислителен клъстер възел филтъра така, че вашата работа е свършила за правилното OS / конфигурация възел. </li>
<li> Някои изчислителни възли изискват пароли. Дайте вашата заявка набор от пароли, така че може да удостовери самоличността си. </li>
<li> Въведете параметрите на заявката за вашата заявка, така че да може да премине в опцията = & лентата за адреса = максимална използваемост. </li>
<li> Внимавай! Въвеждане на параметрите на заявката (въвеждане от потребителя) е опасна! Добавите заявка ограничения параметър, за да се даде възможност само определени суровини. </li>
<li> Tag вашата заявка, така че можете да <a target='_new' href='this_server_url/?s=facebook,likes'>  this_server_url /? = Facebook, харесва </a> по-разбираеми URL < / LI>
<li> Дайте вашата заявка MIME тип, така че тя се връща определен Content-Type HTTP хедър. </li>
<li> Виж дейността кеша да се разбере дали не се сервира предварително кеширани съдържание (само в режим на редактиране) </li>
<li> Одобряване и повторно одобряване на източник на съдържание, събрани от отдалечени сървъри. Позволява заявка кеширане източник на съдържание и масово <br/> увеличава производителността! Вашето запитване ще се зареди по подразбиране с тази кеширана съдържание (предварително одобрен) </li>
'одобрение' <li> Източник съдържание позволява <a target='_new' href='this_server_url/?q=qn&use_approved=yes'> this_server_url / ? = QN и use_approved = Да </a> валидни връзки. , Adantages от миналия <br/> позиция, плюс подобрява debugability, дава възможност за статични / библиотека стил запитвания и е напълно съвместим с параметрите на заявката! </li>
<li> подразбиране XML-MODE изход: <a target='_new' href='this_server_url/?q=qn&remote&xml'>  this_server_url / р = QN и дистанционно и XML </a> </li>
<li> XML-MODE изход е скучна и твърде дълго! На всяка крачка на рекурсивни редовно спецификация израз Enter 'по поръчка заглавия' и 'Потребителски колонтитули' над и под стойността вписванията <br/>! Напишете данни в собствената си XML, CSV или (попълнете тук) текстови схема <br/>, използващи тези горни и долни колонтитули. </li>
на <li> След 'Персонализирани Headers / долен колонтитул' са определени видите вашата заявка CXML MODE: <a target='_new' href='this_server_url/?q=qn&remote&cxml'>  this_server_url / Q = QN и дистанционно и cxml </a > </li>
се изведе <li> След вашата заявка точно какво искате Запомнете тази продукция, така че ако заявката си за почивки в бъдеще, вие сте <br/> рекорд на филтриран изход форматиране заявката си! Хит 'се съхранява XML / CXML' бутона Output </li>
";

$translation['To have the latest live content, a remote job needs to be submitted. Jobs usually finish within a minute or so.']['english']="To have the latest live content, a remote job needs to be submitted.<br/><br/>

Jobs usually finish within a minute or so.";
$translation['To have the latest live content, a remote job needs to be submitted. Jobs usually finish within a minute or so.']['german']="Um die letzte Live-Inhalte haben, muss ein Remote-Job eingereicht.<br/><br/>

Jobs der Regel innerhalb einer Minute oder so beenden.";
$translation['To have the latest live content, a remote job needs to be submitted. Jobs usually finish within a minute or so.']['chinesesimplified']="若要将最新的直播内容，远程工作需要被提交。<br/> <br/>

工作通常在一分钟左右完成。";
$translation['To have the latest live content, a remote job needs to be submitted. Jobs usually finish within a minute or so.']['bulgarian']="За да имате най-новите съдържание в реално време, отдалечена работа трябва да се представи<br/><br/>Jobs обикновено се завърши в рамките на една минута или така.";

$translation['Resource Actions']['english']="Resource Actions";
$translation['Resource Actions']['german']="Ressourcen-Aktionen";
$translation['Resource Actions']['chinesesimplified']="资源操作";
$translation['Resource Actions']['bulgarian']="Ресурсни Действия";

$translation['This remote job has been run before. Using latest contents.']['english']="This remote job has been run before. Using latest contents.";
$translation['This remote job has been run before. Using latest contents.']['german']="Diese Remote-Job wurde zuvor. Mit neuesten Inhalte.";
$translation['This remote job has been run before. Using latest contents.']['chinesesimplified']="这个远程作业已运行之前。使用最新的内容。";
$translation['This remote job has been run before. Using latest contents.']['bulgarian']="Това дистанционно работа е работил преди. Използване на новите съдържание.";


$translation['Resource Content Approval']['english']="Resource Content Approval";
$translation['Resource Content Approval']['german']="Resource Inhaltsgenehmigung";
$translation['Resource Content Approval']['chinesesimplified']="资源内容审批";
$translation['Resource Content Approval']['bulgarian']="Одобрение ресурси съдържание";

$translation['This function already has pre-existing, approved resource content that has been marked as usable.']['english']="This function already has pre-existing, approved resource content that has been marked as usable.";
$translation['This function already has pre-existing, approved resource content that has been marked as usable.']['german']="Diese Abfrage hat bereits vorbestehenden, zugelassenen Ressource Inhalte, die als nutzbare markiert wurde.";
$translation['This function already has pre-existing, approved resource content that has been marked as usable.']['chinesesimplified']="这个查询已经有预先存在的，批准的内容已被标记为可用资源。";
$translation['This function already has pre-existing, approved resource content that has been marked as usable.']['bulgarian']="Тази заявка вече има предшестваща, одобрен източник на съдържание, което е маркирано за използваем.";

$translation['gather 1']['english']="
You can re-gather latest cache content here - a live, remote, <a href='?q=qn&v=input-resource'>Input-Resource</a> acquiring job will be submitted on a remote compute node.  If you like the \"latest\" content collected (it is stable, correct, and works with your current filtering expressions, you can \"Approve\" the content - the content is marked as stable and usable.  You can press the hyperlink at the bottom of the page to view your <a href='?q=qn&v=filtering-expression'>filtering expressions's</a> processings when the Approved Input Resource (cached, of course) is used as input.
";
$translation['gather 1']['german']="Sie können wieder zu sammeln neuesten Cache-Inhalte - ein Live, Fernbedienung, <a href='?q=qn&v=input-resource'>Input-Ressource</a> Erwerb Job wird auf einem Remote-Rechenknoten eingereicht werden. Wenn Sie wie die \"latest\" content gesammelt (es ist stabil, richtig, und arbeitet mit Ihrer aktuellen Filterung Ausdrücke, die Sie \"Approve\" den Inhalt -. Der Inhalt wird als stabil und benutzbar markiert können Sie den Hyperlink drücken am unteren Rand der Seite, um Ihre <a href='?q=qn&v=filtering-expression'>anzuzeigen Filterausdrücke die</a> Bearbeitungen, wenn das Genehmigte Eingang Resource (zwischengespeichert, natürlich) als Eingabe verwendet wird.";
$translation['gather 1']['chinesesimplified']="您可以重新收集最新的缓存内容 - 现场，遥控器，<a href='?q=qn&v=input-resource'>输入资源</a>的收购工作将提交在远程计算节点。如果你喜欢\“最近\”的内容收集（它是稳定的，正确的，并与您现有的过滤表达式的作品，你可以\“批准\”的内容 - 内容被标记为稳定和可用，您可以按超链接在底部的页面查看您的的<a href='?q=qn&v=filtering-expression'>过滤表达式</a>处理时核准的输入资源（缓存，当然）作为输入。";
$translation['gather 1']['bulgarian']="бъдеще";

$translation['Re-gather Latest Cache']['english']="Re-gather Latest Cache";
$translation['Re-gather Latest Cache']['german']="Re-gather Neueste Cache";
$translation['Re-gather Latest Cache']['chinesesimplified']="重新收集最新的高速缓存";
$translation['Re-gather Latest Cache']['bulgarian']="Re събере кеш";


$translation['by submitting a live, remote, content-gathering job']['english']="by submitting a live, remote, content-gathering job";
$translation['by submitting a live, remote, content-gathering job']['german']="durch Vorlage eines Live, Fernbedienung, Content-Versammlung Job";
$translation['by submitting a live, remote, content-gathering job']['chinesesimplified']="提交一个实时，远程，内容收集工作";
$translation['by submitting a live, remote, content-gathering job']['bulgarian']="чрез подаване на живо, дистанционно управление, събиране на съдържанието работа";

$translation['Force live remote content gather (no cache storage)']['english']="Force live remote content gather (no cache storage)";
$translation['Force live remote content gather (no cache storage)']['german']="Zwingen zu leben Remote-Inhalte gather (kein Cache-Speicher)";
$translation['Force live remote content gather (no cache storage)']['chinesesimplified']="强制实时远程内容聚集（未缓存的存储）";
$translation['Force live remote content gather (no cache storage)']['bulgarian']="Принудително живеят дистанционно събират информация за съдържанието (без кеш памет)";

$translation['True Resource (safe)']['english']="True Resource (safe)";
$translation['True Resource (safe)']['german']="Wahre Resource (safe)";
$translation['True Resource (safe)']['chinesesimplified']="真正的资源（安全）";
$translation['True Resource (safe)']['bulgarian']="True ресурси (безопасно)";

$translation['Safe Link to view output content of job']['english']="Safe Link to view output content of job";
$translation['Safe Link to view output content of job']['german']="Sicherer Link zur Ausgabe von Inhalten der Auftrag anzuzeigen";
$translation['Safe Link to view output content of job']['chinesesimplified']="安全链接查看输出的工作内容";
$translation['Safe Link to view output content of job']['bulgarian']="Сейф Link, за да видите съдържанието на изхода работа";

$translation['previously approved']['english']="If PREVIOUSLY APPROVED content works perfectly with your CURRENT regex's, it merely means that your Input Resource/target website has CHANGED THEIR CONTENT OR FORMATTING.<br/><br/>

You would need to update your regular expressions/string formattings/XPaths to accomodate the latest formatting of the target resource/website.";
$translation['previously approved']['german']="Wenn zuvor genehmigten Inhalten arbeitet perfekt mit Ihrer aktuellen regex ist, es bedeutet lediglich, dass Ihre Eingabe Resource / Ziel-Website hat ihren Inhalt oder Formatierung geändert. <br/><br/>

Sie müssten Ihren regulären Ausdrücken / string Formatierungen / XPaths aktualisieren, um die neuesten Formatierung des Zielressource / Webseite unterzubringen.";
$translation['previously approved']['chinesesimplified']="如果以前批准的内容可以完美地与您当前的正则表达式的，它只是意味着你的输入的资源/目标网站已经改变了他们的内容或格式。时

你需要更新你的正则表达式/的字符串打印格式/ XPath的资源/网站的目标，以适应最新的格式。";
$translation['previously approved']['bulgarian']="Ако работи перфектно със сегашната си регулярен израз на предварително одобрени съдържание, това просто означава, че Вашият принос на ресурсите / целева сайт е променило тяхното съдържание или форматиране. <br/> <br/>

Може би трябва да актуализирате регулярни изрази / струнни форматиране / XPaths да се настанят най-новите форматиране на целевия ресурс / сайт.";

$translation['If your filtering expression becomes suddenly broken, click here to use PREVIOUSLY APPROVED content.']['english']="If your filtering expression becomes suddenly broken, click here to use PREVIOUSLY APPROVED content.";
$translation['If your filtering expression becomes suddenly broken, click here to use PREVIOUSLY APPROVED content.']['german']="Wenn Ihr Filterausdruck wird plötzlich unterbrochen, klicken Sie hier, um bereits genehmigte Inhalte zu verwenden.";
$translation['If your filtering expression becomes suddenly broken, click here to use PREVIOUSLY APPROVED content.']['chinesesimplified']="如果您的筛选表达式变得突然被打破，点击这里使用以前批准的内容。";
$translation['If your filtering expression becomes suddenly broken, click here to use PREVIOUSLY APPROVED content.']['bulgarian']="Ако вашият филтриране израз става изведнъж разбити, щракнете тук, за да използвате предварително одобрени съдържание.";

$translation['approved button']['english']="Click here to RE APPROVE the current original source content. Approved content is known to work perfectly with your current regexes.";
$translation['approved button']['german']="Klicken Sie hier, um die aktuelle ursprünglichen Inhalte zu genehmigen. Genehmigt Inhalt bekannt ist, dass sie perfekt mit Ihrer aktuellen reguläre Ausdrücke.";
$translation['approved button']['chinesesimplified']="点击此处批准目前的原始源的内容。批准的内容是众所周知的完美配合您当前的正则表达式。";
$translation['approved button']['bulgarian']="Щракнете тук, за да одобри оригиналния източник на съдържание. Одобрен съдържанието му е известно да работи перфектно с настоящите regexes.";

$translation['reapproved button']['english']="Click here to RE-APPROVE the current original source content. Approved content is known to work perfectly with your current regexes.";
$translation['reapproved button']['german']="Klicken Sie hier, um erneut zu genehmigen die aktuelle ursprünglichen Inhalte. Genehmigt Inhalt bekannt ist, dass sie perfekt mit Ihrer aktuellen reguläre Ausdrücke.";
$translation['reapproved button']['chinesesimplified']="点击这里重新批准和原始源的内容。批准的内容是众所周知的完美配合您当前的正则表达式。";
$translation['reapproved button']['bulgarian']="Щракнете тук, за да повторно одобрява оригиналния източник на съдържание. Одобрен съдържанието му е известно да работи перфектно с настоящите regexes.";

$translation['Collecting HIS data can be done using many common tools']['english']="Collecting HIS data can be done using many common tools";
$translation['Collecting HIS data can be done using many common tools']['german']="Sammeln HIS-Daten kann mit vielen gängigen Werkzeugen werden";
$translation['Collecting HIS data can be done using many common tools']['chinesesimplified']="收集他的数据可以通过使用许多常用的工具";
$translation['Collecting HIS data can be done using many common tools']['bulgarian']="Събиране на неговите данни може да се извършва с помощта на много общи инструменти";

$translation['Wget Call']['english']="Wget Call";
$translation['Wget Call']['german']="Wget Aufruf";
$translation['Wget Call']['chinesesimplified']="Wget呼叫";
$translation['Wget Call']['bulgarian']="Wget Обадете";

$translation['Use these Shortcut URLs to launch/execute HIS functions']['english']='Use these Shortcut URLs to launch/execute HIS functions';
$translation['Use these Shortcut URLs to launch/execute HIS functions']['german']='Verwenden Sie diese Shortcut URLs zu starten / Ausführen seiner Aufgaben';
$translation['Use these Shortcut URLs to launch/execute HIS functions']['chinesesimplified']='使用这些URL的快捷方式，启动/执行其职能';
$translation['Use these Shortcut URLs to launch/execute HIS functions']['bulgarian']='Използвайте тези URL адреси Shortcut да започне / изпълнява функциите си';

$translation['Cleanup Cache']['english']="Cleanup Cache";
$translation['Cleanup Cache']['german']="Cleanup Cache";
$translation['Cleanup Cache']['chinesesimplified']="清除缓存";
$translation['Cleanup Cache']['bulgarian']="почистване на кеша";

$translation['Cleanup Jobs']['english']="Cleanup Jobs";
$translation['Cleanup Jobs']['german']="Cleanup Jobs";
$translation['Cleanup Jobs']['chinesesimplified']="清理作业";
$translation['Cleanup Jobs']['bulgarian']="почистване на работни места";

$translation['User Language']['english']="User Language";
$translation['User Language']['german']="Benutzersprache";
$translation['User Language']['chinesesimplified']="用户语言";
$translation['User Language']['bulgarian']="Потребителят Език";

$translation['User Keys']['english']="User Keys";
$translation['User Keys']['german']="Benutzer Keys";
$translation['User Keys']['chinesesimplified']="用户密钥";
$translation['User Keys']['bulgarian']="Потребителски Keys";

$translation['Hide']['english']="Hide";
$translation['Hide']['german']="Verbergen";
$translation['Hide']['chinesesimplified']="隐藏";
$translation['Hide']['bulgarian']="крия";

$translation['replace']['english']="replace";
$translation['replace']['german']="ersetzen";
$translation['replace']['chinesesimplified']="更换";
$translation['replace']['bulgarian']="замени";

$translation['filter-regex tip']['english']="Tip: Use (\w+) parenthesized subpatterns to collect desired outputs.<br/>Non-parenthesized parts of the regular expression will be matched but not returned.";
$translation['filter-regex tip']['german']="Tipp: Verwenden Sie (\w +) Klammern Untermustern gewünschte Ausgänge zu sammeln.<br/>Non-Klammern Teile des regulären Ausdrucks wird abgestimmt, aber nicht zurückgegeben.";
$translation['filter-regex tip']['chinesesimplified']="提示：使用（\w+）括号内的子模式，以收集所需的输出。<br/>非括号部分的正则表达式将匹配，但没有回来。";
$translation['filter-regex tip']['bulgarian']="Съвет: Използвайте (\w +) скоби subpatterns за събиране на желаните резултати.<br/>Non-скоби части на регулярен израз ще бъдат съчетани, но не се върна.";

$translation['Compatability and Features']['english']="Compatability and Features";
$translation['Compatability and Features']['german']="Kompatibilität und Funktionen";
$translation['Compatability and Features']['chinesesimplified']="兼容性和功能";
$translation['Compatability and Features']['bulgarian']="Съвместимост и характеристики";

$translation['Refresh']['english']="Refresh";
$translation['Refresh']['german']="Erfrischen";
$translation['Refresh']['chinesesimplified']="刷新";
$translation['Refresh']['bulgarian']="Обнови";

$translation['ALL']['english']="ALL";
$translation['ALL']['german']="ALLE";
$translation['ALL']['chinesesimplified']="所有";
$translation['ALL']['bulgarian']="всички";

$translation['Job Node']['english']="Job Node";
$translation['Job Node']['german']="Job Node";
$translation['Job Node']['chinesesimplified']="工作节点";
$translation['Job Node']['bulgarian']="работа Node";

$translation['Last Seen']['english']="Last Seen";
$translation['Last Seen']['german']="Zuletzt gesehen";
$translation['Last Seen']['chinesesimplified']="最后上线";
$translation['Last Seen']['bulgarian']="Последно";

$translation['Query Search']['english']="Query Search";
$translation['Query Search']['german']="Frage Suchen";
$translation['Query Search']['chinesesimplified']="查询搜索";
$translation['Query Search']['bulgarian']="заявка за търсене";

$translation['Memory (database)']['english']="Memory (database)";
$translation['Memory (database)']['german']="Memory (Datenbank)";
$translation['Memory (database)']['chinesesimplified']="内存（数据库）";
$translation['Memory (database)']['bulgarian']="Памет (база данни)";

$translation['Type']['english']="Type";
$translation['Type']['german']="Typ";
$translation['Type']['chinesesimplified']="类型";
$translation['Type']['bulgarian']="тип";

$translation['Address']['english']="Address";
$translation['Address']['german']="Adresse";
$translation['Address']['chinesesimplified']="地址";
$translation['Address']['bulgarian']="адрес";

$translation['Storage (files)']['english']="Storage (files)";
$translation['Storage (files)']['german']="Storage (Dateien)";
$translation['Storage (files)']['chinesesimplified']="存储（文件）";
$translation['Storage (files)']['bulgarian']="Storage (файлове)";

$translation['Server']['english']="Server";
$translation['Server']['german']="Server";
$translation['Server']['chinesesimplified']="服务器";
$translation['Server']['bulgarian']="Сървър";

$translation['Server Name']['english']="Server Name";
$translation['Server Name']['german']="Server Name";
$translation['Server Name']['chinesesimplified']="服务器名称";
$translation['Server Name']['bulgarian']="Server Name";

$translation['Delete Function']['english']="Delete Function";
$translation['Delete Function']['german']="Löschfunktion";
$translation['Delete Function']['chinesesimplified']="删除功能";
$translation['Delete Function']['bulgarian']="Функция за изтриване";

$translation['Clone Function']['english']="Clone Function";
$translation['Clone Function']['german']="Clone-Funktion";
$translation['Clone Function']['chinesesimplified']="克隆功能";
$translation['Clone Function']['bulgarian']="Clone Функция";

$translation['Direct file upload for storage selection']['english']="Direct file upload for storage selection";
$translation['Direct file upload for storage selection']['german']="Direkte Datei zur Speicherung Auswahl laden";
$translation['Direct file upload for storage selection']['chinesesimplified']="直接文件上传存储选择";
$translation['Direct file upload for storage selection']['bulgarian']="Директен качване на файлове за съхранение избор";

$translation['is currently under development.']['english']="is currently under development.";
$translation['is currently under development.']['german']="ist derzeit in Entwicklung.";
$translation['is currently under development.']['chinesesimplified']="目前正在开发中。";
$translation['is currently under development.']['bulgarian']="в момента е в процес на разработка.";

$translation['use']['english']="use";
$translation['use']['german']="verwenden";
$translation['use']['chinesesimplified']="使用";
$translation['use']['bulgarian']="употреба";

$translation['using']['english']="using";
$translation['using']['german']="verwendung";
$translation['using']['chinesesimplified']="运用";
$translation['using']['bulgarian']="използване на";

$translation['Existing Parameters']['english']="Existing Parameters";
$translation['Existing Parameters']['german']="съществуващи параметри";
$translation['Existing Parameters']['chinesesimplified']="现有的参数";
$translation['Existing Parameters']['bulgarian']="Vorhandene Parameter";

$translation['Select MIME type of function CXML output (text/plain is default)']['english']="Select MIME type of function CXML output (text/plain is default)";
$translation['Select MIME type of function CXML output (text/plain is default)']['german']="Wählen Sie den MIME-Typ der Abfrage CXML Ausgang (text/plain ist Standard)";
$translation['Select MIME type of function CXML output (text/plain is default)']['chinesesimplified']="XML输出的MIME类型（text/plain的是默认值）";
$translation['Select MIME type of function CXML output (text/plain is default)']['bulgarian']="Изберете MIME тип заявка CXML производство (текст/обикновен е по подразбиране)";

$translation['Function Synchronous/Wait Behaviour']['english']="Function Synchronous/Wait Behaviour";
$translation['Function Synchronous/Wait Behaviour']['german']="Funktion Synchron / Wait Behaviour";
$translation['Function Synchronous/Wait Behaviour']['chinesesimplified']="功能同步/等待行为";
$translation['Function Synchronous/Wait Behaviour']['bulgarian']="Функция синхронен / Чакай поведение";

$translation['select one']['english']="select one";
$translation['select one']['german']="wählen Sie ein";
$translation['select one']['chinesesimplified']="选择一个";
$translation['select one']['bulgarian']="изберете един";

$translation['Click to Show']['english']="Click to Show";
$translation['Click to Show']['german']="Klicken Sie auf Show";
$translation['Click to Show']['chinesesimplified']="点击“显示”";
$translation['Click to Show']['bulgarian']="Кликнете, за да се покаже";

$translation['Secret Key']['english']="Secret Key";
$translation['Secret Key']['german']="Secret Key";
$translation['Secret Key']['chinesesimplified']="秘密钥匙";
$translation['Secret Key']['bulgarian']="секретен ключ";

$translation['function tags 1']['english']="Query Tags are an human name you can call your function by.<br/><br/>

In other words, instead of calling this function with following URL:<br/>
<a href='URL1'>URL1</a><br/><br/>

Your function can be called with this URL:<br/>
<a href='THIS_URL/?s=facebook,likes'>THIS_URL/?s=facebook,likes</a><br/><br/>

Easier to look at, correct?";
$translation['function tags 1']['german']="Abfrage Tags sind eine menschliche Namen Sie Ihre Abfrage aufrufen können.<br/><br/>

In anderen Worten, statt diese Abfrage mit folgenden URL:<br/>
<a href='URL1'>URL1</a><br/><br/>

Ihre Abfrage kann mit dieser URL aufgerufen werden:<br/><br/>
<a href='THIS_URL/?s=facebook,likes'>THIS_URL/?s=facebook,likes</a><br/><br/>

Einfacher zu sehen, richtig?";
$translation['function tags 1']['chinesesimplified']="查询标签是一个人的名字，你可以打电话给你的查询。<br/><br/>

换句话说，而不是调用此查询以下网址：<br/>
<a href='URL1'>URL1</a><br/><br/>

你的查询可以调用这个URL：<br/>
<a href='THIS_URL/?s=facebook,likes'>THIS_URL/?s=facebook,likes</a><br/><br/>

更容易看，对不对？";
$translation['function tags 1']['bulgarian']="Заявките Маркерите са човешки име, можете да се обадите на вашата заявка от.<br/><br/>

С други думи, вместо да се обадите на тази заявка с следния адрес:<br/>
<a href='URL1'>URL1</a><br/><br/>

Вашето запитване може да се нарече с този адрес:<br/>
<a href='THIS_URL/?s=facebook,likes'>THIS_URL/?s=facebook,likes</a><br/><br/>

Лесно да видите, нали?";

$translation['Current Function Tags']['english']="Current Function Tags";
$translation['Current Function Tags']['german']="Derzeitige Funktion Schlagworte";
$translation['Current Function Tags']['chinesesimplified']="目前的功能标签";
$translation['Current Function Tags']['bulgarian']="Текущи Tags функция";

$translation['About Function Tags']['english']="About Function Tags";
$translation['About Function Tags']['german']="Über Funktion Schlagworte";
$translation['About Function Tags']['chinesesimplified']="关于功能标签";
$translation['About Function Tags']['bulgarian']="За Функция Етикети";

$translation['Tag Value']['english']="Tag Value";
$translation['Tag Value']['german']="Tag Wert";
$translation['Tag Value']['chinesesimplified']="标记值";
$translation['Tag Value']['bulgarian']="стойността на маркера";

$translation['No function tags have been created yet']['english']="No function tags have been created yet";
$translation['No function tags have been created yet']['german']="Keine Abfrage-Tags wurden noch nicht erstellt";
$translation['No function tags have been created yet']['chinesesimplified']="尚未建立无查询标签";
$translation['No function tags have been created yet']['bulgarian']="Не заявка тагове са създадени още";

$translation['Add Tag']['english']="Add Tag";
$translation['Add Tag']['german']="Tag Hinzufügen";
$translation['Add Tag']['chinesesimplified']="添加标签";
$translation['Add Tag']['bulgarian']="Добавяне на маркер";

$translation['Universal Function Tags - Public Access']['english']="Universal Function Tags - Public Access";
$translation['Universal Function Tags - Public Access']['german']="Universal-Funktion Tags - Public Access";
$translation['Universal Function Tags - Public Access']['chinesesimplified']="通用功能 - 公共";
$translation['Universal Function Tags - Public Access']['bulgarian']="Универсални Tags функция - публичен достъп";

$translation['Expose this function for usage as a public/globally accessible API?']['english']="Expose this function for usage as a public/globally accessible API?";
$translation['Expose this function for usage as a public/globally accessible API?']['german']="Setzen Sie diese Abfrage für die Nutzung als öffentliche / global zugänglichen API?";
$translation['Expose this function for usage as a public/globally accessible API?']['chinesesimplified']="公开查询作为一个公共/全局可访问的API的使用？";
$translation['Expose this function for usage as a public/globally accessible API?']['bulgarian']="публикувам тази заявка за използване като обществена / глобално достъпна API?";

$translation['universal tag warning']['english']="Any ********'d Query Parameter values will remain hidden in this interface.<br/>
However, other users of this system will be able to see your full function text.<br/><br/>
Additionally, OTHER USERS CAN VERY EASILY SEE YOUR SECRET {keyword_pass} ACTUAL VALUES BY OVERRIDING THE QUERY'S 'RESOURCE', TO POINT AT THEIR OWN PERSON PERSONAL GET/POST 'ECHO-STYLE SCRIPT. THIS IS VERY EASY FOR THEM TO DO, SO BE WISE ABOUT THIS.
";
$translation['universal tag warning']['german']="Any ******** 'd Abfrageparameterwerte bleibt verborgen in dieser Schnittstelle. <br/>
Allerdings werden andere Benutzer dieses Systems in der Lage sein, um Ihre vollständige Abfrage Text zu sehen. <br/>
Darüber hinaus können andere Benutzer sehr leicht erkennen IHRE SECRET {keyword_pass} ISTWERTE durch Überschreiben der Abfrage 'Ressource', auf eigene person persönlich GET / POST 'ECHO-STYLE SCRIPT Punkt. Dies ist sehr einfach für sie zu tun, SO BE WISE darüber.";
$translation['universal tag warning']['chinesesimplified']="任何********“查询参数的值将保持在此界面中隐藏。<br/>
然而，该系统的其他用户将能够看到完整的查询文本。<br/> <br/>
此外，其他用户可以很容易地看到你的秘密的{keyword_pass}实际值通过重写查询的“资源”，以点带在自己的人的个人GET / POST'ECHO风格的脚本。这是很容易的，给他们做，所以关于本是明智的。";
$translation['universal tag warning']['bulgarian']="Всяко ******** стойности на параметрите на заявката ще останат скрити в този интерфейс. <br/>
Въпреки това, други потребители на системата ще бъде в състояние да видите пълния текст заявка. <br/> <br/>
Освен това, други потребители може много лесно да видите тайната си {keyword_pass} действителните стойности от наложителни 'ресурс' заявка, да посочи тяхната личност ЛИЧНА GET / POST ECHO стил SCRIPT. Това е много лесно за тях да направят, така че да бъдем мъдри за това.";

$translation['Start File Upload']['english']="Start File Upload";
$translation['Start File Upload']['german']="Starten Datei hochladen";
$translation['Start File Upload']['chinesesimplified']="开始文件上传";
$translation['Start File Upload']['bulgarian']="Започнете качване на файлове";

$translation['Service Name']['english']="Service Name";
$translation['Service Name']['german']="Service Name";
$translation['Service Name']['chinesesimplified']="服务名称";
$translation['Service Name']['bulgarian']="Service Name";

$translation['Purpose']['english']="Purpose";
$translation['Purpose']['german']="Zweck";
$translation['Purpose']['chinesesimplified']="目的";
$translation['Purpose']['bulgarian']="цел";

$translation['Infrastructure']['english']="Infrastructure";
$translation['Infrastructure']['german']="Infrastructure";
$translation['Infrastructure']['chinesesimplified']="基础设施";
$translation['Infrastructure']['bulgarian']="инфраструктура";

$translation['Features']['english']="Features";
$translation['Features']['german']="Features";
$translation['Features']['chinesesimplified']="特点";
$translation['Features']['bulgarian']="Характеристики";

$translation['Install']['english']="Install";
$translation['Install']['german']="Installieren";
$translation['Install']['chinesesimplified']="安装";
$translation['Install']['bulgarian']="инсталирам";

$translation['Login']['english']="Login";
$translation['Login']['german']="Login";
$translation['Login']['chinesesimplified']="注册";
$translation['Login']['bulgarian']="Влез";

$translation['Database Choices']['english']="Database Choices";
$translation['Database Choices']['german']="Database Choices";
$translation['Database Choices']['chinesesimplified']="数据库的选择";
$translation['Database Choices']['bulgarian']="бази данни избор";

$translation['The idea is simple']['english']="The idea is simple";
$translation['The idea is simple']['german']="Die Idee ist einfach";
$translation['The idea is simple']['chinesesimplified']="这个想法很简单";
$translation['The idea is simple']['bulgarian']="Идеята е проста";

$translation['Write a simple Function, using a simple Language']['english']="Write a simple Function, using a simple Language";
$translation['Write a simple Function, using a simple Language']['german']="Schreiben Sie eine einfache Funktion, mit Hilfe eines einfachen Sprache";
$translation['Write a simple Function, using a simple Language']['chinesesimplified']="写一个简单的功能，使用简单的语言";
$translation['Write a simple Function, using a simple Language']['bulgarian']="Напиши проста функция, с помощта на прост език";

$translation['Initiate from HTTP, runs on [your?] servers']['english']="Initiate from HTTP, runs on [your?] servers";
$translation['Initiate from HTTP, runs on [your?] servers']['german']="Initiieren von HTTP, läuft auf [Ihr?] Server";
$translation['Initiate from HTTP, runs on [your?] servers']['chinesesimplified']="启动HTTP[您的？]服务器上运行";
$translation['Initiate from HTTP, runs on [your?] servers']['bulgarian']="Иницииране от HTTP, работи на [си?] Сървъри";

$translation['Produce structured output']['english']="Produce structured output";
$translation['Produce structured output']['german']="Produzieren strukturierte Ausgabe";
$translation['Produce structured output']['chinesesimplified']="生产结构的输出";
$translation['Produce structured output']['bulgarian']="Изработване структуриран изход";

$translation['Simple. Elegant. Human.']['english']="Simple. Elegant. Human.";
$translation['Simple. Elegant. Human.']['german']="Simple. Elegant. Human.";
$translation['Simple. Elegant. Human.']['chinesesimplified']="简单。优雅的。人类。";
$translation['Simple. Elegant. Human.']['bulgarian']="Simple. Елегантна. Човек.";

$translation['Welcome to the Human Intelligence System.']['english']="Welcome to the Human Intelligence System.";
$translation['Welcome to the Human Intelligence System.']['german']="Willkommen in der Human Intelligence System.";
$translation['Welcome to the Human Intelligence System.']['chinesesimplified']="欢迎来到人类的智慧系统。";
$translation['Welcome to the Human Intelligence System.']['bulgarian']="Добре дошли в разузнавателна система на човека.";

$translation['HIS Functions written inside HIS Web Interface']['english']="HIS Functions written<br/>inside HIS Web Interface";
$translation['HIS Functions written inside HIS Web Interface']['german']="Seine Aufgaben in seinem<br/>Web Interface geschrieben";
$translation['HIS Functions written inside HIS Web Interface']['chinesesimplified']="他写的函数内HIS互联网接口";
$translation['HIS Functions written inside HIS Web Interface']['bulgarian']="Неговите функции, написани<br/>вътре своя уеб интерфейс";

$translation['Database is communications hub']['english']="Database is<br/>communications hub";
$translation['Database is communications hub']['german']="Die Datenbank<br/>ist Kommunikationszentrale";
$translation['Database is communications hub']['chinesesimplified']="数据库是通信枢纽";
$translation['Database is communications hub']['bulgarian']="База данни е<br/>комуникационен център";

$translation['Compute Servers Execute your HIS Functions']['english']="Compute Servers Execute<br/>your HIS Functions";
$translation['Compute Servers Execute your HIS Functions']['german']="Compute-Servern Führen<br/>Sie Ihre HIS Funktionen";
$translation['Compute Servers Execute your HIS Functions']['chinesesimplified']="计算服务器执行HIS功能的";
$translation['Compute Servers Execute your HIS Functions']['bulgarian']="Изчисляват Сървъри Изпълнение<br/>вашите HIS Функции";

$translation['Database Choices']['english']="Database Choices";
$translation['Database Choices']['german']="Database Choices";
$translation['Database Choices']['chinesesimplified']="数据库的选择";
$translation['Database Choices']['bulgarian']="бази данни избор";

$translation['File Storage Choices']['english']="File Storage Choices";
$translation['File Storage Choices']['german']="File Storage Choices";
$translation['File Storage Choices']['chinesesimplified']="文件存储选择";
$translation['File Storage Choices']['bulgarian']="Изборът съхранение на файлове";

$translation['Language Choices']['english']="Language Choices";
$translation['Language Choices']['german']="Sprache Choices";
$translation['Language Choices']['chinesesimplified']="语言选择";
$translation['Language Choices']['bulgarian']="Езикови избор";

$translation['Operating System Choices']['english']="Operating System Choices";
$translation['Operating System Choices']['german']="Betriebssystem Choices";
$translation['Operating System Choices']['chinesesimplified']="操作系统选择";
$translation['Operating System Choices']['bulgarian']="Операционни Изборът система";

$translation['Hardware Choices']['english']="Hardware Choices";
$translation['Hardware Choices']['german']="Hardware Choices";
$translation['Hardware Choices']['chinesesimplified']="硬件选择";
$translation['Hardware Choices']['bulgarian']="хардуер избор";

$translation['HIS Function Input Resource Types']['english']="HIS Function Input Resource Types";
$translation['HIS Function Input Resource Types']['german']="HIS Function Input Resource Typen";
$translation['HIS Function Input Resource Types']['chinesesimplified']="HIS功能输入资源类型";
$translation['HIS Function Input Resource Types']['bulgarian']="HIS за въвеждане на функция Видове ресурсни";

$translation['Download']['english']="Download";
$translation['Download']['german']="Herunterladen";
$translation['Download']['chinesesimplified']="下载";
$translation['Download']['bulgarian']="Изтегляне";

$translation['Latest Release']['english']="Latest Release";
$translation['Latest Release']['german']="Latest Release";
$translation['Latest Release']['chinesesimplified']="最新发布";
$translation['Latest Release']['bulgarian']="Последна версия";

$translation['Add Linux Job Server']['english']="Add Linux Job Server";
$translation['Add Linux Job Server']['german']="Fügen Linux Job Server";
$translation['Add Linux Job Server']['chinesesimplified']="添加Linux的招聘服务器";
$translation['Add Linux Job Server']['bulgarian']="Добави Linux Server работа";

$translation['Add Windows Job Server']['english']="Add Windows Job Server";
$translation['Add Windows Job Server']['german']="Hinzufügen von Windows Job Server";
$translation['Add Windows Job Server']['chinesesimplified']="添加Windows作业服务器";
$translation['Add Windows Job Server']['bulgarian']="Добави Windows Server работа";

$translation['News']['english']="News";
$translation['News']['german']="Nachrichten";
$translation['News']['chinesesimplified']="新闻";
$translation['News']['bulgarian']="новини";

$translation['File Storage']['english']="File Storage";
$translation['File Storage']['german']="File Storage";
$translation['File Storage']['chinesesimplified']="文件存储";
$translation['File Storage']['bulgarian']="съхранение на файлове";

$translation['Function Name']['english']="Function Name";
$translation['Function Name']['german']="Funktion Name";
$translation['Function Name']['chinesesimplified']="功能名称";
$translation['Function Name']['bulgarian']="Името на функцията";

$translation['Source Code']['english']="Source Code";
$translation['Source Code']['german']="Source Code";
$translation['Source Code']['chinesesimplified']="源代码";
$translation['Source Code']['bulgarian']="на изходния код";

$translation['Language']['english']="Language";
$translation['Language']['german']="Sprache";
$translation['Language']['chinesesimplified']="语";
$translation['Language']['bulgarian']="език";

$translation['Add Function']['english']="Add Function";
$translation['Add Function']['german']="Funktion Hinzufügen";
$translation['Add Function']['chinesesimplified']="新增功能";
$translation['Add Function']['bulgarian']="Добави Функция";

$translation['Automation Type']['english']="Automation Type";
$translation['Automation Type']['german']="Automation Typ";
$translation['Automation Type']['chinesesimplified']="自动化类型";
$translation['Automation Type']['bulgarian']="Автоматизация Тип";

$translation['Run On']['english']="Run On";
$translation['Run On']['german']="Ausführen am";
$translation['Run On']['chinesesimplified']="运行在";
$translation['Run On']['bulgarian']="се движат по";

$translation['Function Search']['english']="Function Search";
$translation['Function Search']['german']="Funktion Suche";
$translation['Function Search']['chinesesimplified']="功能搜索";
$translation['Function Search']['bulgarian']="функция за търсене";

$translation['STEP 1: HIS Web Interface - Source']['english']="STEP 1: HIS Web Interface - Source";
$translation['STEP 1: HIS Web Interface - Source']['german']="SCHRITT 1: HIS Web Interface - Quelle";
$translation['STEP 1: HIS Web Interface - Source']['chinesesimplified']="STEP1：Web界面 - 源";
$translation['STEP 1: HIS Web Interface - Source']['bulgarian']="Стъпка 1: Web Interface - Източник";

$translation['STEP 2: HIS Server - Windows Server Install Script']['english']="STEP 2: HIS Server - Windows Server Install Script";
$translation['STEP 2: HIS Server - Windows Server Install Script']['german']="SCHRITT 2: HIS Server - Windows Server Install Script";
$translation['STEP 2: HIS Server - Windows Server Install Script']['chinesesimplified']="STEP2：HIS服务器 - Windows服务器的安装脚本";
$translation['STEP 2: HIS Server - Windows Server Install Script']['bulgarian']="Стъпка 2: Server - Windows Server Install Script";

$translation['STEP 2: HIS Server - Linux Server Install Script']['english']="STEP 2: HIS Server - Linux Server Install Script";
$translation['STEP 2: HIS Server - Linux Server Install Script']['german']="SCHRITT 2: HIS Server - Linux Server Install Script";
$translation['STEP 2: HIS Server - Linux Server Install Script']['chinesesimplified']="STEP2：HIS服务器 - Linux服务器的安装脚本";
$translation['STEP 2: HIS Server - Linux Server Install Script']['bulgarian']="Стъпка 2: Server - Linux Server Install Script";

$translation['Extract to your www/ folder, and browse to index.php']['english']="Extract to your www/ folder, and browse to <b>index.php</b>";
$translation['Extract to your www/ folder, and browse to index.php']['german']="Auszug Ihrer www/ Ordner, und navigieren Sie zu <b>index.php</b>";
$translation['Extract to your www/ folder, and browse to index.php']['chinesesimplified']="解压缩到你的www/文件夹，浏览到<b>index.php</b>";
$translation['Extract to your www/ folder, and browse to index.php']['bulgarian']="Извадка www/ папка, и намерете <b>index.php</b>";

$translation['Double-click install-win-his-server.vbs']['english']="Double-click <b>install-win-his-server.vbs</b>";
$translation['Double-click install-win-his-server.vbs']['german']="Doppelklicken Sie auf <b>install-win-his-server.vbs</b>";
$translation['Double-click install-win-his-server.vbs']['chinesesimplified']="双击 <b>install-win-his-server.vbs</b>";
$translation['Double-click install-win-his-server.vbs']['bulgarian']="Кликнете два пъти върху <b>install-win-his-server.vbs</b>";

$translation['Run ./install-linux-his-server.sh']['english']="Run <b>./install-linux-his-server.sh</b>";
$translation['Run ./install-linux-his-server.sh']['german']="Laufen <b>./install-linux-his-server.sh</b>";
$translation['Run ./install-linux-his-server.sh']['chinesesimplified']="运行 <b>./install-linux-his-server.sh</b>";
$translation['Run ./install-linux-his-server.sh']['bulgarian']="Стартирайте <b>./install-linux-his-server.sh</b>";

$translation['Click here to show all Download options']['english']="Click here to show all Download options";
$translation['Click here to show all Download options']['german']="Klicken Sie hier, um alle Optionen zum Herunterladen zeigen";
$translation['Click here to show all Download options']['chinesesimplified']="点击此处显示所有的下载选项";
$translation['Click here to show all Download options']['bulgarian']="Щракнете тук, за да се покажат всички Опции за изтегляне";

$translation['Click here to show normal Download options']['english']="Click here to show normal Download options";
$translation['Click here to show normal Download options']['german']="Klicken Sie hier, um normale Download-Optionen zeigen";
$translation['Click here to show normal Download options']['chinesesimplified']="点击这里显示正常下载选项";
$translation['Click here to show normal Download options']['bulgarian']="Щракнете тук, за да бъдат показани нормални опции за изтегляне";

$translation['View Install Instructions Here']['english']="View Install Instructions Here";
$translation['View Install Instructions Here']['german']="Anzeigen Installationsanweisungen Hier";
$translation['View Install Instructions Here']['chinesesimplified']="这里查看安装说明";
$translation['View Install Instructions Here']['bulgarian']="Вижте Инсталиране на инструкциите тук";

$translation['Input']['english']="Input";
$translation['Input']['german']="Eingabe";
$translation['Input']['chinesesimplified']="输入";
$translation['Input']['bulgarian']="вход";

$translation['Function']['english']="Function";
$translation['Function']['german']="Funktion";
$translation['Function']['chinesesimplified']="功能";
$translation['Function']['bulgarian']="функция";

$translation['Inherit from existing HIS Function']['english']="Inherit from existing HIS Function";
$translation['Inherit from existing HIS Function']['german']="Erben von vorhandenen KIS-Funktion";
$translation['Inherit from existing HIS Function']['chinesesimplified']="从现有的HIS功能继承";
$translation['Inherit from existing HIS Function']['bulgarian']="Наследи от съществуващата функция HIS";

$translation['Allow other HIS Functions to Inherit this Function\'s data']['english']="Allow other HIS Functions to Inherit this Function's data";
$translation['Allow other HIS Functions to Inherit this Function\'s data']['german']="Lassen Sie andere HIS Funktionen, um diese Funktion die Daten übernehmen";
$translation['Allow other HIS Functions to Inherit this Function\'s data']['chinesesimplified']="允许其他HIS功能继承该功能的数据";
$translation['Allow other HIS Functions to Inherit this Function\'s data']['bulgarian']="Позволете на други Неговите функции, за да наследи тази функция данни";

$translation['Run This Function on']['english']="Run This Function on";
$translation['Run This Function on']['german']="Führen Sie diese Funktion auf";
$translation['Run This Function on']['chinesesimplified']="运行此功能";
$translation['Run This Function on']['bulgarian']="Стартирайте тази функция";

$translation['Status of this Function']['english']="Status of this Function";
$translation['Status of this Function']['german']="Status dieser Funktion";
$translation['Status of this Function']['chinesesimplified']="此功能的状态";
$translation['Status of this Function']['bulgarian']="Статус на тази функция";

$translation['HIS Implementation Language (Web Interface & HIS Server)']['english']="HIS Implementation Language (Web Interface & HIS Server)";
$translation['HIS Implementation Language (Web Interface & HIS Server)']['german']="HIS Implementation Language (Web Interface & HIS Server)";
$translation['HIS Implementation Language (Web Interface & HIS Server)']['chinesesimplified']="HIS实现语言（Web界面与他的服务器）";
$translation['HIS Implementation Language (Web Interface & HIS Server)']['bulgarian']="HIS Изпълнение Език (Web интерфейс и своя сървър)";

$translation['Hosting Choices']['english']="Hosting Choices";
$translation['Hosting Choices']['german']="Hosting Choices";
$translation['Hosting Choices']['chinesesimplified']="主机的选择";
$translation['Hosting Choices']['bulgarian']="Хостинг избор";

$translation['HIS Software Function Inheritable Samples']['english']="HIS Software Function Inheritable Samples";
$translation['HIS Software Function Inheritable Samples']['german']="HIS Software Funktion Inheritable Proben";
$translation['HIS Software Function Inheritable Samples']['chinesesimplified']="HIS软件功能可继承的样品";
$translation['HIS Software Function Inheritable Samples']['bulgarian']="Унаследяеми Проби HIS Софтуер Функция";

$translation['Compute Node (HIS Server) - Operating System Choices']['english']="Compute Node (HIS Server) - Operating System Choices";
$translation['Compute Node (HIS Server) - Operating System Choices']['german']="Compute Node (HIS Server) - Betriebssystem Choices";
$translation['Compute Node (HIS Server) - Operating System Choices']['chinesesimplified']="计算，节点（HIS服务器） - 作业系统选择";
$translation['Compute Node (HIS Server) - Operating System Choices']['bulgarian']="Compute Node (HIS Server) - операционна система избор";

$translation['coming soon']['english']="coming soon";
$translation['coming soon']['german']="demnächst";
$translation['coming soon']['chinesesimplified']="即将推出";
$translation['coming soon']['bulgarian']="очаквайте скоро";

$translation['Your Machines']['english']="Your Machines";
$translation['Your Machines']['german']="Ihre Maschinen";
$translation['Your Machines']['chinesesimplified']="你的机器";
$translation['Your Machines']['bulgarian']="Вашите машини";

$translation['In-House']['english']="In-House";
$translation['In-House']['german']="In-House";
$translation['In-House']['chinesesimplified']="在内务";
$translation['In-House']['bulgarian']="В къща";

$translation['Remote<br/>Machines']['english']="Remote<br/>Machines";
$translation['Remote<br/>Machines']['german']="Remote<br/>Rechner";
$translation['Remote<br/>Machines']['chinesesimplified']="远程机器";
$translation['Remote<br/>Machines']['bulgarian']="отдалечени<br/>машини";

$translation['Your Cloud']['english']="Your Cloud";
$translation['Your Cloud']['german']="Ihre Cloud";
$translation['Your Cloud']['chinesesimplified']="您的云";
$translation['Your Cloud']['bulgarian']="Вашият Облак";

$translation['FREE']['english']="FREE";
$translation['FREE']['german']="KOSTENLOS";
$translation['FREE']['chinesesimplified']="免费";
$translation['FREE']['bulgarian']="БЕЗПЛАТНО";

$translation['$$']['english']='$$';
$translation['$$']['german']="€€";
$translation['$$']['chinesesimplified']="元元";
$translation['$$']['bulgarian']="€€";

$translation['Go Back to HIS']['english']="Go Back to HIS";
$translation['Go Back to HIS']['german']="Zurück zur HIS";
$translation['Go Back to HIS']['chinesesimplified']="返回HIS";
$translation['Go Back to HIS']['bulgarian']="Върни се HIS";

$translation['Managed']['english']="Managed";
$translation['Managed']['german']="Managed";
$translation['Managed']['chinesesimplified']="管理";
$translation['Managed']['bulgarian']="Сайтът се";

$translation['Hosted by Us']['english']="Hosted by Us";
$translation['Hosted by Us']['german']="Hosted by Us";
$translation['Hosted by Us']['chinesesimplified']="由我们主办";
$translation['Hosted by Us']['bulgarian']="Хоствано от нас";

$translation['Write Instructions (or not)']['english']="Write Instructions (or not)";
$translation['Write Instructions (or not)']['german']="Schreiben Instructions (oder auch nicht)";
$translation['Write Instructions (or not)']['chinesesimplified']="写指令（或没有）";
$translation['Write Instructions (or not)']['bulgarian']="Напиши инструкции (или не)";

$translation['In Any Language (or plain english)']['english']="In Any Language (or plain english)";
$translation['In Any Language (or plain english)']['german']="In jeder Sprache (oder schlicht Deutsch)";
$translation['In Any Language (or plain english)']['chinesesimplified']="在任何语言（或纯中国）";
$translation['In Any Language (or plain english)']['bulgarian']="На всеки език (или обикновен български)";

$translation['Initiate from HTTP']['english']="Initiate from HTTP";
$translation['Initiate from HTTP']['german']="Initiieren von HTTP";
$translation['Initiate from HTTP']['chinesesimplified']="启动从HTTP";
$translation['Initiate from HTTP']['bulgarian']="Иницииране от HTTP";

$translation['Run on your servers (or not)']['english']="Run on your servers (or not)";
$translation['Run on your servers (or not)']['german']="Führen Sie auf Ihren Servern (oder auch nicht)";
$translation['Run on your servers (or not)']['chinesesimplified']="运行在你的服务器（或不）";
$translation['Run on your servers (or not)']['bulgarian']="Стартирайте на вашите сървъри (или не)";

$translation['System Kind List']['english']="Recognized Operating Systems";
$translation['System Kind List']['german']="Anerkannt Betriebssysteme";
$translation['System Kind List']['chinesesimplified']="经认可的运营系统";
$translation['System Kind List']['bulgarian']="Признати операционни системи";

$translation['Function']['english']="Function";
$translation['Function']['german']="Funktion";
$translation['Function']['chinesesimplified']="功能";
$translation['Function']['bulgarian']="функция";

$translation['1. Run these bash commands']['english']="1. Run these bash commands";
$translation['1. Run these bash commands']['german']="Ein. Führen Sie diese bash-Befehle";
$translation['1. Run these bash commands']['chinesesimplified']="1。运行bash命令";
$translation['1. Run these bash commands']['bulgarian']="1. Стартирайте тези Баш команди";

$translation["2. Copy the text below & paste into new file \"his-config.php\" in your server folder"]['english']="2. Copy the text below & paste into new file \"his-config.php\" in your server folder";
$translation["2. Copy the text below & paste into new file \"his-config.php\" in your server folder"]['german']="2. Kopieren Sie den Text & Paste in neue Datei \"his-config.php\" in Ihrem Server-Ordner";
$translation["2. Copy the text below & paste into new file \"his-config.php\" in your server folder"]['chinesesimplified']="2。下面的文字复制，粘贴到新的文件\"his-config.php\"文件在您的服务器上的文件夹";
$translation["2. Copy the text below & paste into new file \"his-config.php\" in your server folder"]['bulgarian']="2. Копирайте текста по-долу, и поставете в нов файл \"his-config.php\" в папка на вашия сървър";

$translation['Linux Job Server Setup Instructions']['english']="Linux Job Server Setup Instructions";
$translation['Linux Job Server Setup Instructions']['german']="Linux Job Server Setup Instructions";
$translation['Linux Job Server Setup Instructions']['chinesesimplified']="Linux作业服务器的安装说明";
$translation['Linux Job Server Setup Instructions']['bulgarian']="Linux инструкции за работа настройка на сървъра";

$translation['Back to Cluster Map']['english']="Back to Cluster Map";
$translation['Back to Cluster Map']['german']="Zurück zu Cluster Map";
$translation['Back to Cluster Map']['chinesesimplified']="回到群集地图的";
$translation['Back to Cluster Map']['bulgarian']="Обратно към Сайта Cluster";

$translation["3. Copy the text below & paste into \"launch_job_cluster.sh\" in your server folder, on your job server"]['english']="3. Copy the text below & paste into \"launch_job_cluster.sh\" in your server folder, on your job server";
$translation["3. Copy the text below & paste into \"launch_job_cluster.sh\" in your server folder, on your job server"]['german']="3. Kopieren Sie den Text & Paste in \"launch_job_cluster.sh\" in Ihrem Ordner auf dem Server, auf dem Job Server";
$translation["3. Copy the text below & paste into \"launch_job_cluster.sh\" in your server folder, on your job server"]['chinesesimplified']="3。下面的文字复制和粘贴到\"launch_job_cluster.sh\"在您的服务器文件夹中，在作业服务器";
$translation["3. Copy the text below & paste into \"launch_job_cluster.sh\" in your server folder, on your job server"]['bulgarian']="3. Копирайте текста по-долу, и поставете в \"launch_job_cluster.sh\" в папка на вашия сървър, на вашия сървър за работа";

$translation["4. Copy the text below & paste into \"auth.xml\" in your server folder, on your job server"]['english']="4. Copy the text below & paste into \"auth.xml\" in your server folder, on your job server";
$translation["4. Copy the text below & paste into \"auth.xml\" in your server folder, on your job server"]['german']="4. Kopieren Sie den Text & paste in \"auth.xml\" in Ihrem Ordner auf dem Server, auf dem Job Server";
$translation["4. Copy the text below & paste into \"auth.xml\" in your server folder, on your job server"]['chinesesimplified']="4。下面的文字复制粘贴到\"auth.xml\"在您的服务器文件夹中，您的工作服务器";
$translation["4. Copy the text below & paste into \"auth.xml\" in your server folder, on your job server"]['bulgarian']="4. Копирайте текста по-долу и го поставете в \"auth.xml\" в папката на вашия сървър, на вашия сървър за работа";

$translation['5. Run these bash commands']['english']="5. Run these bash commands";
$translation['5. Run these bash commands']['german']="5. Führen Sie diese bash Befehle";
$translation['5. Run these bash commands']['chinesesimplified']="5。运行这些bash命令";
$translation['5. Run these bash commands']['bulgarian']="5.Изпълнете тези команди на bash";

$translation['page automatically refreshes every 30 seconds']['english']="page automatically refreshes every 30 seconds";
$translation['page automatically refreshes every 30 seconds']['german']="Seite wird automatisch aktualisiert alle 30 Sekunden";
$translation['page automatically refreshes every 30 seconds']['chinesesimplified']="自动刷新页面每隔30秒";
$translation['page automatically refreshes every 30 seconds']['bulgarian']="страница автоматично се опреснява на всеки 30 секунди";

$translation["Be sure to check the \"Cluster Map\" after setting up your server.<br/>Your new server instances will show up on the map instantly once they are running."]['english']="Be sure to check the \"Cluster Map\" after setting up your server.<br/>Your new server instances will show up on the map instantly once they are running.";
$translation["Be sure to check the \"Cluster Map\" after setting up your server.<br/>Your new server instances will show up on the map instantly once they are running."]['german']="Seien Sie sicher, dass die check \"Cluster Map\" nach dem Einrichten Ihres Servers. <br/> Ihr neuer Server-Instanzen erscheint auf der Karte sofort, wenn sie ausgeführt werden.";
$translation["Be sure to check the \"Cluster Map\" after setting up your server.<br/>Your new server instances will show up on the map instantly once they are running."]['chinesesimplified']="一定要检查\"群集地图\"，设置完成后，您的服务器。<br/>你的新服务器实例会显示在地图上立即一旦被运行。";
$translation["Be sure to check the \"Cluster Map\" after setting up your server.<br/>Your new server instances will show up on the map instantly once they are running."]['bulgarian']="Не забравяйте да проверите \"Клъстер Карта\" след създаването на вашия сървър. <br/> Нови случаи на сървъра ще се появи на картата незабавно след като те се изпълняват.";

$translation['After completing above steps, your server is now running.']['english']="After completing above steps, your server is now running.";
$translation['After completing above steps, your server is now running.']['german']="Nach Abschluss oben genannten Schritte wird Ihr Server läuft jetzt.";
$translation['After completing above steps, your server is now running.']['chinesesimplified']="完成上述步骤后，您的服务器正在运行。";
$translation['After completing above steps, your server is now running.']['bulgarian']="След завършване на горните стъпки, вашият сървър вече е стартирал.";

$translation['But here are some extra tips for starting & shutting down your server.']['english']="But here are some extra tips for starting & shutting down your server.";
$translation['But here are some extra tips for starting & shutting down your server.']['german']="Aber hier sind einige zusätzliche Tipps für den Start & Herunterfahren Ihres Servers.";
$translation['But here are some extra tips for starting & shutting down your server.']['chinesesimplified']="但这里有一些额外的技巧，用于启动和关闭服务器。";
$translation['But here are some extra tips for starting & shutting down your server.']['bulgarian']="Но ето и някои допълнителни съвети за започване и спиране на вашия сървър.";

$translation["6. Launch \"./launch_job_cluster.sh\" to launch your job cluster."]['english']="6. Launch \"./launch_job_cluster.sh\" to launch your job cluster.";
$translation["6. Launch \"./launch_job_cluster.sh\" to launch your job cluster."]['german']="6. Starten Sie \"./ launch_job_cluster.sh\", um Ihren Job Cluster starten.";
$translation["6. Launch \"./launch_job_cluster.sh\" to launch your job cluster."]['chinesesimplified']="6。启动\"./ launch_job_cluster.sh\"来启动你的工作集群。";
$translation["6. Launch \"./launch_job_cluster.sh\" to launch your job cluster."]['bulgarian']="6.Стартиране \"./ launch_job_cluster.sh\", за да започне работа Вашия клъстър.";

$translation["7. Launch \"./kill-linux-his-server.sh\" to kill your job cluster."]['english']="7. Launch \"./kill-linux-his-server.sh\" to kill your job cluster.";
$translation["7. Launch \"./kill-linux-his-server.sh\" to kill your job cluster."]['german']="7. Launch \"./kill-linux-his-server.sh\" zu töten Ihren Job Cluster.";
$translation["7. Launch \"./kill-linux-his-server.sh\" to kill your job cluster."]['chinesesimplified']="7. 启动\"./kill-linux-his-server.sh\"杀了你的工作集群。";
$translation["7. Launch \"./kill-linux-his-server.sh\" to kill your job cluster."]['bulgarian']="7. Launch \"./kill-linux-his-server.sh\", за да убие Вашия клъстър на работа.";

$translation['Current Function Tags']['english']="Current Function Tags";
$translation['Current Function Tags']['german']="Derzeitige Funktion Schlagworte";
$translation['Current Function Tags']['chinesesimplified']="目前的功能标签";
$translation['Current Function Tags']['bulgarian']="Текущи Tags функция";

$translation['Add a new Function Tag']['english']="Add a new Function Tag";
$translation['Add a new Function Tag']['german']="Fügen Sie eine neue Funktion Tag";
$translation['Add a new Function Tag']['chinesesimplified']="添加一个新的功能标签";
$translation['Add a new Function Tag']['bulgarian']="Добавяне на нов Tag Функция";

$translation['you are here']['english']="you are here";
$translation['you are here']['german']="sie sind hier";
$translation['you are here']['chinesesimplified']="您现在的位置";
$translation['you are here']['bulgarian']="Вие сте тук";

$translation['your data is here']['english']="your data is here";
$translation['your data is here']['german']="ihre Daten sind hier";
$translation['your data is here']['chinesesimplified']="你的数据在这里";
$translation['your data is here']['bulgarian']="вашите данни тук";

$translation['What is this, and Why?']['english']="What is this, and Why?";
$translation['What is this, and Why?']['german']="Was ist das und warum?";
$translation['What is this, and Why?']['chinesesimplified']="这是什么，为什么呢？";
$translation['What is this, and Why?']['bulgarian']="Какво е това, и защо?";

$translation['Your HTTP request hits your HIS Web Interface, and is forwarded to your job server cluster.']['english']="Your HTTP request hits your HIS Web Interface, and is forwarded to your job server cluster.";
$translation['Your HTTP request hits your HIS Web Interface, and is forwarded to your job server cluster.']['german']="Ihre HTTP-Anforderung trifft Ihrem HIS Web Interface, und um Ihren Job Server-Cluster weitergeleitet.";
$translation['Your HTTP request hits your HIS Web Interface, and is forwarded to your job server cluster.']['chinesesimplified']="您的HTTP请求到达您的Web界面，并转发到作业服务器集群。";
$translation['Your HTTP request hits your HIS Web Interface, and is forwarded to your job server cluster.']['bulgarian']="Вашият HTTP заявка удари своя уеб интерфейс, и се изпраща на Вашия клъстър работа сървър.";

$translation['This allows you to:']['english']="This allows you to:";
$translation['This allows you to:']['german']="Dies ermöglicht Ihnen:";
$translation['This allows you to:']['chinesesimplified']="这使您可以：";
$translation['This allows you to:']['bulgarian']="Това ви позволява да:";

$translation['HIS is a HTTP API Generator/Job Cluster for your automation.']['english']="HIS is a HTTP API Generator/Job Cluster for your automation.";
$translation['HIS is a HTTP API Generator/Job Cluster for your automation.']['german']="HIS ist ein HTTP API Generator / Job Cluster für Ihre Automatisierungsaufgaben.";
$translation['HIS is a HTTP API Generator/Job Cluster for your automation.']['chinesesimplified']="他是一个，HTTP API发电机/求职群集为您的自动化。";
$translation['HIS is a HTTP API Generator/Job Cluster for your automation.']['bulgarian']="Му е HTTP API Generator / Работа Клъстер за вашия автоматизация.";

$translation['HIS was created because other systems make it too complicated.']['english']="HIS was created because other systems make it too complicated.";
$translation['HIS was created because other systems make it too complicated.']['german']="HIS wurde geschaffen, weil andere Systeme es zu kompliziert zu machen.";
$translation['HIS was created because other systems make it too complicated.']['chinesesimplified']="HIS的形成是因为其他系统太复杂。";
$translation['HIS was created because other systems make it too complicated.']['bulgarian']="Той беше създаден, защото други системи го правят твърде сложно.";

$translation['month']['english']="month";
$translation['month']['german']="monat";
$translation['month']['chinesesimplified']="月";
$translation['month']['bulgarian']="месец";

$translation['Hosted Elsewhere']['english']="Hosted Elsewhere";
$translation['Hosted Elsewhere']['german']="Hosted Elsewhere";
$translation['Hosted Elsewhere']['chinesesimplified']="托管在别处";
$translation['Hosted Elsewhere']['bulgarian']="Домакин Другаде";

$translation['Windows Job Server Setup Instructions']['english']="Windows Job Server Setup Instructions";
$translation['Windows Job Server Setup Instructions']['german']="Windows Job Server Setup Instructions";
$translation['Windows Job Server Setup Instructions']['chinesesimplified']="Windows作业服务器安装说明";
$translation['Windows Job Server Setup Instructions']['bulgarian']="Инструкциите за настройка на сървъра на Windows за работа";

$translation['Extract the zip file, folder "his-server-installer-win-wget" is created']['english']="Extract the zip file, folder \"his-server-installer-win-wget\" is created";
$translation['Extract the zip file, folder "his-server-installer-win-wget" is created']['german']="Entpacken Sie die ZIP-Datei, einen Ordner \"his-server-installer-win-wget\" wird erstellt";
$translation['Extract the zip file, folder "his-server-installer-win-wget" is created']['chinesesimplified']="zip文件解压，\"his-server-installer-win-wget\"创建的文件夹的";
$translation['Extract the zip file, folder "his-server-installer-win-wget" is created']['bulgarian']="Извличане на компресирания файл, папка \"his-server-installer-win-wget\" е създаден";

$translation['Open the folder']['english']="Open the folder";
$translation['Open the folder']['german']="Öffnen Sie den Ordner";
$translation['Open the folder']['chinesesimplified']="打开文件夹";
$translation['Open the folder']['bulgarian']="Отворете папката";

$translation['Copy the text below & paste into new file "his-config.php" in your server folder']['english']='Copy the text below & paste into new file "his-config.php" in your server folder';
$translation['Copy the text below & paste into new file "his-config.php" in your server folder']['german']='Kopieren Sie den Text & paste in neue Datei "his-config.php" in Ihrem Ordner auf dem Server';
$translation['Copy the text below & paste into new file "his-config.php" in your server folder']['chinesesimplified']='下面的文字复制和粘贴到新文件“his-config.php文件”在您的服务器文件夹';
$translation['Copy the text below & paste into new file "his-config.php" in your server folder']['bulgarian']='Копирайте текста по-долу, и поставете в новия файл "his-config.php" в папка на вашия сървър';

$translation['Copy the text below & paste into "launch_job_cluster.vbs" in your server folder, on your job server']['english']='Copy the text below & paste into "launch_job_cluster.vbs" in your server folder, on your job server';
$translation['Copy the text below & paste into "launch_job_cluster.vbs" in your server folder, on your job server']['german']='Kopieren Sie den Text & Paste in "launch_job_cluster.vbs" in Ihrem Ordner auf dem Server, auf dem Job Server';
$translation['Copy the text below & paste into "launch_job_cluster.vbs" in your server folder, on your job server']['chinesesimplified']='下面的文字复制粘贴到你的服务器文件夹的的“launch_job_cluster.vbs”，你的工作服务器';
$translation['Copy the text below & paste into "launch_job_cluster.vbs" in your server folder, on your job server']['bulgarian']='Копирайте текста по-долу и го поставете в "launch_job_cluster.vbs" в папка на вашия сървър, на вашия сървър за работа';

$translation['Copy the text below & paste into "auth.xml" in your server folder, on your job server']['english']='Copy the text below & paste into "auth.xml" in your server folder, on your job server';
$translation['Copy the text below & paste into "auth.xml" in your server folder, on your job server']['german']='Kopieren Sie den Text & Paste in "auth.xml" in Ihrem Ordner auf dem Server, auf dem Job Server';
$translation['Copy the text below & paste into "auth.xml" in your server folder, on your job server']['chinesesimplified']='下面的文字复制和粘贴到你的服务器文件夹的的“auth.xml”，你的工作服务器';
$translation['Copy the text below & paste into "auth.xml" in your server folder, on your job server']['bulgarian']='Копирайте текста по-долу, и поставете в "auth.xml" в папка на вашия сървър, на вашия сървър за работа';

$translation['Double-Click "install-win-his-server.vbs"']['english']='Double-Click "install-win-his-server.vbs"';
$translation['Double-Click "install-win-his-server.vbs"']['german']='Double-Click "install-win-his-server.vbs"';
$translation['Double-Click "install-win-his-server.vbs"']['chinesesimplified']='双击“install-win-his-server.vbs”';
$translation['Double-Click "install-win-his-server.vbs"']['bulgarian']='Double-Click "install-win-his-server.vbs"';

$translation['Double-Click "launch_job_cluster.vbs" to launch your job cluster.']['english']='Double-Click "launch_job_cluster.vbs" to launch your job cluster.';
$translation['Double-Click "launch_job_cluster.vbs" to launch your job cluster.']['german']='Double-Click "launch_job_cluster.vbs", um Ihren Job Cluster starten.';
$translation['Double-Click "launch_job_cluster.vbs" to launch your job cluster.']['chinesesimplified']='双点击“launch_job_cluster.vbs，”启动你的工作集群。';
$translation['Double-Click "launch_job_cluster.vbs" to launch your job cluster.']['bulgarian']='Щракнете двукратно върху "launch_job_cluster.vbs" за стартиране на Вашия клъстър работа.';

$translation['Double-Click "kill-win-his-server.bat" to kill your job cluster.']['english']='Double-Click "kill-win-his-server.bat" to kill your job cluster.';
$translation['Double-Click "kill-win-his-server.bat" to kill your job cluster.']['german']='Double-Click "kill-win-his-server.bat" zu töten Ihren Job Cluster.';
$translation['Double-Click "kill-win-his-server.bat" to kill your job cluster.']['chinesesimplified']='双击“杀双赢的server.bat”杀死你的工作集群。';
$translation['Double-Click "kill-win-his-server.bat" to kill your job cluster.']['bulgarian']='Double-Click "убие-печелиш му server.bat", за да убие Вашия клъстър работа.';

$translation['User Agent']['english']='User Agent';
$translation['User Agent']['german']='User Agent';
$translation['User Agent']['chinesesimplified']='用户代理';
$translation['User Agent']['bulgarian']='User Agent';

$translation['System']['english']='System';
$translation['System']['german']='System';
$translation['System']['chinesesimplified']='系统';
$translation['System']['bulgarian']='Система';

$translation['Function Tags']['english']='Function Tags';
$translation['Function Tags']['german']='Funktion Schlagworte';
$translation['Function Tags']['chinesesimplified']='功能标签';
$translation['Function Tags']['bulgarian']='Функция Етикети';

$translation['A single Open-Source software package with 2 primary functions']['english']='A single Open-Source software package with 2 primary functions';
$translation['A single Open-Source software package with 2 primary functions']['german']='Eine Open-Source-Software-Paket mit 2 Hauptfunktionen';
$translation['A single Open-Source software package with 2 primary functions']['chinesesimplified']='一个单一的开放源码软件有2个主要功能包';
$translation['A single Open-Source software package with 2 primary functions']['bulgarian']='Open-Source софтуерен пакет с две основни функции';

$translation['HTTP API Generator']['english']='HTTP API Generator';
$translation['HTTP API Generator']['german']='HTTP API Generator';
$translation['HTTP API Generator']['chinesesimplified']='HTTP API发电机的';
$translation['HTTP API Generator']['bulgarian']='HTTP API Generator';

$translation['Job Server']['english']='Job Server';
$translation['Job Server']['german']='Job Server';
$translation['Job Server']['chinesesimplified']='作业服务器';
$translation['Job Server']['bulgarian']='работа на сървъра';

$translation['(Job server takes action based on your HIS HTTP API Requests)']['english']='(Job server executes scripts & binaries based on HIS HTTP API Requests received)';
$translation['(Job server takes action based on your HIS HTTP API Requests)']['german']='(Job Server führt Script & Binärdateien basierend auf HIS HTTP API Anträge,)';
$translation['(Job server takes action based on your HIS HTTP API Requests)']['chinesesimplified']='（作业服务器执行脚本和二进制文件的基础上HIS HTTP API请求）';
$translation['(Job server takes action based on your HIS HTTP API Requests)']['bulgarian']='(Работа сървъра изпълнява скриптове и бинарни файлове, въз основа на HIS HTTP API Заявки получени)';

$translation['What is it?']['english']='What is it?';
$translation['What is it?']['german']='Was ist das?';
$translation['What is it?']['chinesesimplified']='这是什么？';
$translation['What is it?']['bulgarian']='Какво е това?';

$translation['You connect to in-house or third party automation infrastructure through HTTP calls to HIS.']['english']='You connect to your in-house or third party automation infrastructure through HTTP calls to HIS.';
$translation['You connect to in-house or third party automation infrastructure through HTTP calls to HIS.']['german']='Sie verbinden Ihre in-house oder Dritten Automatisierungs-Infrastruktur über HTTP ruft HIS.';
$translation['You connect to in-house or third party automation infrastructure through HTTP calls to HIS.']['chinesesimplified']='您连接到您的内部或第三方的自动化基础设施，通过HTTP调用HIS。';
$translation['You connect to in-house or third party automation infrastructure through HTTP calls to HIS.']['bulgarian']='Свържете с вашата къща или трета страна автоматизация инфраструктура чрез HTTP повиквания към МУ.';

$translation['many job servers']['english']='Job servers are generally not aware of one another.  Unless you employ <a href="?q=qn&v=node-filters">node filters</a>, there is a risk that multiple job servers will accept the same job at the exact same time.  In that circumstance, your job will be <u>run on multiple servers simultaneously</u>.  Most of the time you do not want that to happen.<br/><br/>

Entering a Execution Delay is like having a "sync time" that allows the servers to wait for each other to catch up and decide which one of them should process the job.';
$translation['many job servers']['german']='Jobservern sind im allgemeinen nicht bekannt, zueinander. Sofern Sie <a href="?q=qn&v=node-filters">Knoten-Filter</a> beschäftigen, besteht die Gefahr, dass mehrere Job Server wird die gleiche Arbeit an der exakt gleichen Zeit zu akzeptieren. In diesem Umstand wird der Job <u>auf mehreren Servern gleichzeitig ausgeführt werden </u>. Die meisten der Zeit, die Sie nicht wollen, dass dies geschieht.<br/><br/>

Die Eingabe eines Execution Verzögerung ist wie ein "sync Zeit", die Server aufeinander warten, um aufzuholen und entscheiden, welche von ihnen sollte den Job zu verarbeiten.';
$translation['many job servers']['chinesesimplified']='作业服务器一般都不会知道彼此。除非你采用<a href="?q=qn&v=node-filters">节点过滤器</a>，有一种风险，即多个作业服务器将接受同样的工作在相同的时间。在这种情况下，你的工作将<u>运行在多台服务器上同时​​</u>。在大多数情况下，你不希望这种情况发生。<br/><br/>

输入执行延迟，就像是有一个“同步时间”，允许服务器，以等待对方追上并决定哪一个应该处理工作。';
$translation['many job servers']['bulgarian']='Работа сървъри като цяло не са наясно един от друг. Освен ако не се използва <a href="?q=qn&v=node-filters">възел филтри</a>, има риск, че множество сървъри на работни места ще приемат една и съща работа на едно и също време. В това обстоятелство, вашата работа ще бъде <u>работи на множество сървъри едновременно </u>. Голямата част от времето не искате това да се случи.<br/><br/>

Въвеждане на изпълнението на изчакване е нещо като "синхронизиране на времето", която позволява на сървърите да се изчака един за друг, за да наваксат и да решат кой от тях трябва да обработва работа.';

$translation['Default HIS Function library settings']['english']='Default HIS Function library settings';
$translation['Default HIS Function library settings']['german']='Standardmäßig HIS Funktionsbibliothek Einstellungen';
$translation['Default HIS Function library settings']['chinesesimplified']='默认他的功能库设置。';
$translation['Default HIS Function library settings']['bulgarian']='Подразбиране неговите настройки библиотека функция';

$translation['Function Execution Delay']['english']='Function Execution Delay';
$translation['Function Execution Delay']['german']='Function Execution Verzögerung';
$translation['Function Execution Delay']['chinesesimplified']='功能执行延迟';
$translation['Function Execution Delay']['bulgarian']='Функция за закъснение на изпълнението';

$translation['Add Input']['english']='Add Input';
$translation['Add Input']['german']='Eingang hinzufügen';
$translation['Add Input']['chinesesimplified']='添加输入';
$translation['Add Input']['bulgarian']='Добави Input';

$translation['Current Inheritance for this Function']['english']='Current Inheritance for this Function';
$translation['Current Inheritance for this Function']['german']='Aktuelle Vererbung für diese Funktion';
$translation['Current Inheritance for this Function']['chinesesimplified']='目前此功能的继承';
$translation['Current Inheritance for this Function']['bulgarian']='Текуща наследство на тази функция';

$translation['Add Inheritance to this Function']['english']='Add Inheritance to this Function';
$translation['Add Inheritance to this Function']['german']='Fügen Vererbung dieser Funktion';
$translation['Add Inheritance to this Function']['chinesesimplified']='此功能的添加继承';
$translation['Add Inheritance to this Function']['bulgarian']='Добави наследство на тази функция';

$translation['No Inheritance defined yet.']['english']='No Inheritance defined yet.';
$translation['No Inheritance defined yet.']['german']='Keine Vererbung definiert haben.';
$translation['No Inheritance defined yet.']['chinesesimplified']='没有继承定义。';
$translation['No Inheritance defined yet.']['bulgarian']='Все още няма наследство, определено.';

$translation['inheritance should']['english']='Inheritance should be used when a HIS Function contains Software automation calls (e.g., wget).<br/>
Other Data-centric HIS Functions can then instantiate software-centric HIS Functions.';
$translation['inheritance should']['german']='Vererbung sollte verwendet werden, wenn eine seiner Funktion enthält Software Automation-Aufrufe (zB wget) werden.<br/>
Andere Data-centric HIS Funktionen können dann instanziieren Software-centric HIS Funktionen.';
$translation['inheritance should']['chinesesimplified']='继承时，应使用一个HIS的功能包含软件自动调用（例如，WGET）。<br/>
其他数据中心的职能可以实例化软件为中心的职责。';
$translation['inheritance should']['bulgarian']='То трябва да се използва, когато Неговата функция съдържа разговори на софтуер за автоматизация (напр. Wget).<br/>
Други данни, с фокус върху функциите му могат да инстанциира софтуер ориентиран неговите функции.';

$translation['Turn Inheritance on for this function']['english']='Turn Inheritance on for this function';
$translation['Turn Inheritance on for this function']['german']='Schalten Vererbung auf diese Funktion';
$translation['Turn Inheritance on for this function']['chinesesimplified']='此功能将继承上';
$translation['Turn Inheritance on for this function']['bulgarian']='Включете наследството за тази функция';

$translation['Turn Inheritance off for this function']['english']='Turn Inheritance off for this function';
$translation['Turn Inheritance off for this function']['german']='Schalten Vererbung off für diese Funktion';
$translation['Turn Inheritance off for this function']['chinesesimplified']='关闭继承关闭该功能';
$translation['Turn Inheritance off for this function']['bulgarian']='Включете Наследяване за тази функция';

$translation['on']['english']='on';
$translation['on']['german']='auf';
$translation['on']['chinesesimplified']='上';
$translation['on']['bulgarian']='на';

$translation['off']['english']='off';
$translation['off']['german']='ab';
$translation['off']['chinesesimplified']='离';
$translation['off']['bulgarian']='от';

$translation['Inheritance is turned']['english']='Inheritance is turned';
$translation['Inheritance is turned']['german']='Vererbung ist eingeschaltet';
$translation['Inheritance is turned']['chinesesimplified']='继承开启';
$translation['Inheritance is turned']['bulgarian']='Наследяването се обърна';

$translation['for this function currently.']['english']='for this function currently.';
$translation['for this function currently.']['german']='für diese Funktion derzeit.';
$translation['for this function currently.']['chinesesimplified']='目前此功能。';
$translation['for this function currently.']['bulgarian']='за тази функция.';

$translation['Save to File']['english']='Save to File';
$translation['Save to File']['german']='Datei speichern';
$translation['Save to File']['chinesesimplified']='保存到文件';
$translation['Save to File']['bulgarian']='Запис във файл';

$translation['Text']['english']='Text';
$translation['Text']['german']='Text';
$translation['Text']['chinesesimplified']='文本';
$translation['Text']['bulgarian']='текст';

$translation['just an idea - do not do yet']['english']='just an idea - do not do yet';
$translation['just an idea - do not do yet']['german']='nur eine Idee - noch nicht zu tun';
$translation['just an idea - do not do yet']['chinesesimplified']='只是一个想法 - 不这样做还';
$translation['just an idea - do not do yet']['bulgarian']='само една идея - не правя още';

$translation['Ephemeral Remote']['english']='Ephemeral Remote';
$translation['Ephemeral Remote']['german']='Ephemeral Fernbedienung';
$translation['Ephemeral Remote']['chinesesimplified']='短暂的遥控器';
$translation['Ephemeral Remote']['bulgarian']='ефимерни дистанционно';

$translation['']['english']='';
$translation['']['german']='';
$translation['']['chinesesimplified']='';
$translation['']['bulgarian']='';

$translation['Function Parameters Given']['english']='Function Parameters Given';
$translation['Function Parameters Given']['german']='Funktionsparameter Angesichts';
$translation['Function Parameters Given']['chinesesimplified']='功能参数';
$translation['Function Parameters Given']['bulgarian']='Функционални параметри Предвид';

$translation['Refresh Cache']['english']='Refresh Cache';
$translation['Refresh Cache']['german']='Refresh Cache';
$translation['Refresh Cache']['chinesesimplified']='刷新缓存';
$translation['Refresh Cache']['bulgarian']='Обнови Cache';

$translation['Use Approved']['english']='Use Approved';
$translation['Use Approved']['german']='Verwenden Sie nur zugelassene';
$translation['Use Approved']['chinesesimplified']='使用经过批准的';
$translation['Use Approved']['bulgarian']='Използвайте Одобрен';

$translation['Cache content used']['english']='Cache content used';
$translation['Cache content used']['german']='Cache-Inhalt verwendet';
$translation['Cache content used']['chinesesimplified']='所使用的缓存内容';
$translation['Cache content used']['bulgarian']='Cache използвано съдържание';

$translation['Cache content is being used']['english']='Cache content is being used';
$translation['Cache content is being used']['german']='Cache-Inhalt verwendet wird';
$translation['Cache content is being used']['chinesesimplified']='正在被使用的高速缓存内容';
$translation['Cache content is being used']['bulgarian']='Cache съдържание се използва';

$translation['FULL PATH to folder on local hard drive. Needs to exist already.']['english']='FULL PATH to folder on local hard drive. Needs to exist already.';
$translation['FULL PATH to folder on local hard drive. Needs to exist already.']['german']='Vollständigen Pfad zum Ordner auf der lokalen Festplatte. Muss bereits existieren.';
$translation['FULL PATH to folder on local hard drive. Needs to exist already.']['chinesesimplified']='在本地硬盘驱动器上的文件夹的完整路径。需要已经存在。';
$translation['FULL PATH to folder on local hard drive. Needs to exist already.']['bulgarian']='Пълния път до папка на локалния твърд диск. Трябва да съществува вече.';

$translation['Base Folder Path']['english']='Base Folder Path';
$translation['Base Folder Path']['german']='Basis Folder Path';
$translation['Base Folder Path']['chinesesimplified']='基本文件夹路径';
$translation['Base Folder Path']['bulgarian']='Път на Base Папка';

$translation['(as it currently is)']['english']='(as it currently is)';
$translation['(as it currently is)']['german']='(wie es derzeit ist)';
$translation['(as it currently is)']['chinesesimplified']='（目前是）';
$translation['(as it currently is)']['bulgarian']='(Както е в момента)';

$translation['Replace']['english']='Replace';
$translation['Replace']['german']='Ersetzen';
$translation['Replace']['chinesesimplified']='更换';
$translation['Replace']['bulgarian']='Сменете';

$translation['With']['english']='With';
$translation['With']['german']='Mit';
$translation['With']['chinesesimplified']='同';
$translation['With']['bulgarian']='С';

$translation['VALUE AFTER OPERATION']['english']='VALUE AFTER OPERATION';
$translation['VALUE AFTER OPERATION']['german']='VALUE NACH DEM BETRIEB';
$translation['VALUE AFTER OPERATION']['chinesesimplified']='操作后的值';
$translation['VALUE AFTER OPERATION']['bulgarian']='СТОЙНОСТТА СЛЕД ОПЕРАЦИЯТА';

$translation['Other']['english']='Other';
$translation['Other']['german']='Andere';
$translation['Other']['chinesesimplified']='其他';
$translation['Other']['bulgarian']='Друг';

$translation['Supporters']['english']='Supporters';
$translation['Supporters']['german']='Supporters';
$translation['Supporters']['chinesesimplified']='支持者';
$translation['Supporters']['bulgarian']='Поддръжниците';

$translation['Hosted']['english']='Hosted';
$translation['Hosted']['german']='Hosted';
$translation['Hosted']['chinesesimplified']='托管';
$translation['Hosted']['bulgarian']='Домакин';

$translation['Your Rackspace user name.']['english']='Your Rackspace user name.';
$translation['Your Rackspace user name.']['german']='Ihre Rackspace Benutzernamen.';
$translation['Your Rackspace user name.']['chinesesimplified']='您的Rackspace公司的用户名。';
$translation['Your Rackspace user name.']['bulgarian']='Вашият Rackspace потребителско име.';

$translation['Your API Key. Never share with anyone.']['english']='Your API Key. Never share with anyone.';
$translation['Your API Key. Never share with anyone.']['german']='Ihre API Key. Nie mit jemandem zu teilen.';
$translation['Your API Key. Never share with anyone.']['chinesesimplified']='您的API密钥。不要与任何人共享。';
$translation['Your API Key. Never share with anyone.']['bulgarian']='API ключ. Никога не споделяй с никого.';

$translation['Container Name to store files in. Needs to exist already.']['english']='Container Name to store files in. Needs to exist already.';
$translation['Container Name to store files in. Needs to exist already.']['german']='Container Namen von Dateien in. Geschäft muss bereits vorhanden sein.';
$translation['Container Name to store files in. Needs to exist already.']['chinesesimplified']='集装箱名来存储文件。需要已经存在。';
$translation['Container Name to store files in. Needs to exist already.']['bulgarian']='Име Контейнер за съхранение на файлове. Трябва да съществува вече.';

$translation['Cloud Files Input Path']['english']='Cloud Files Input Path';
$translation['Cloud Files Input Path']['german']='Cloud Files Eingang Pfad';
$translation['Cloud Files Input Path']['chinesesimplified']='云文件输入路径';
$translation['Cloud Files Input Path']['bulgarian']='Cloud входни файлове Path';

$translation['Cloud Files Output Path']['english']='Cloud Files Output Path';
$translation['Cloud Files Output Path']['german']='Cloud Files Output Path';
$translation['Cloud Files Output Path']['chinesesimplified']='云文件输出路径';
$translation['Cloud Files Output Path']['bulgarian']='Cloud Files Output Path';

$translation['Cloud Files Saved Outputs Path']['english']='Cloud Files Saved Outputs Path';
$translation['Cloud Files Saved Outputs Path']['german']='Cloud Files gespeichert Ausgänge Pfad';
$translation['Cloud Files Saved Outputs Path']['chinesesimplified']='云保存的文件输出路径';
$translation['Cloud Files Saved Outputs Path']['bulgarian']='Cloud файлове, записани изходи Path';

$translation['Cloud Files Saved Strings Path']['english']='Cloud Files Saved Strings Path';
$translation['Cloud Files Saved Strings Path']['german']='Cloud Files gespeichert Strings Pfad';
$translation['Cloud Files Saved Strings Path']['chinesesimplified']='Cloud Files Запазени Strings Path';
$translation['Cloud Files Saved Strings Path']['bulgarian']='云保存的文件的字符串路径';

$translation['Cloud Files Container Name']['english']='Cloud Files Container Name';
$translation['Cloud Files Container Name']['german']='Cloud Files Container Namen';
$translation['Cloud Files Container Name']['chinesesimplified']='云文件容器名称';
$translation['Cloud Files Container Name']['bulgarian']='Cloud Files контейнер име';

$translation['Rackspace API Key']['english']='Rackspace API Key';
$translation['Rackspace API Key']['german']='Rackspace API Key';
$translation['Rackspace API Key']['chinesesimplified']='Rackspace的API密钥';
$translation['Rackspace API Key']['bulgarian']='Rackspace API ключ';

$translation['Rackspace User Name']['english']='Rackspace User Name';
$translation['Rackspace User Name']['german']='Rackspace User Name';
$translation['Rackspace User Name']['chinesesimplified']='Rackspace公司名';
$translation['Rackspace User Name']['bulgarian']='Rackspace име';

$translation['HIS Function XML Export']['english']='HIS Function XML Export';
$translation['HIS Function XML Export']['german']='HIS Funktion XML Export';
$translation['HIS Function XML Export']['chinesesimplified']='HIS功能的XML导出';
$translation['HIS Function XML Export']['bulgarian']='Неговата функция XML износ';

$translation['dbexist1']['english']='The setup process has been able to successfully create his-config.php.  If you want to continue the setup process and do a fresh install of HIS, you will need to <b>delete all existing HIS database tables first before continuing the setup process.</b><br/><br/>

Once you have deleted your existing database tables, refresh this page to continue setup.';
$translation['dbexist1']['german']='Der Setup-Prozess ist es gelungen, erfolgreich zu erstellen his-config.php. Wenn Sie den Setup-Prozess fortsetzen und f�hren Sie eine Neuinstallation von HIS wollen, m�ssen Sie <b> l�schen Sie alle vorhandenen HIS Datenbanktabellen erste vor dem Fortsetzen des Setup-Prozess. </b><br/><br/>

Sobald Sie Ihre vorhandenen Datenbanktabellen gel�scht, aktualisieren Sie diese Seite, um fortzufahren.';
$translation['dbexist1']['chinesesimplified']='安装过程中已经能够成功地创建his-config.php文件。如果你想继续安装过程，并做他的全新安装，您将需要<b>删除所有现有HIS，数据库表的第一个，然后再继续安装过程。</b><br/><br/>

一旦你已经删除了您现有的数据库表，请刷新本页面继续安装。';
$translation['dbexist1']['bulgarian']='Инсталационният процес е в състояние успешно да създаде his-config.php.Ако искате да продължите процеса на настройка и да се направи нова инсталация на HIS, вие ще трябва да <b> изтриете всички съществуващи таблици HIS първото, преди да продължите процеса на инсталиране.</b><br/><br/>

След като сте изтрили съществуващите таблици, да обновите тази страница, за да продължи настройка.';

$translation['dbexist2']['english']='If re-creating his-config.php was all you were hoping to do, that is also fine.  You can now visit the login page (icon below) to continue using HIS now.  <b>Please note that until you manually restore your old SALT values in his-config.php, you will not be able to log in though the web interface.</b>';
$translation['dbexist2']['german']='Wenn Neuerstellen his-config.php war alles Hoffen Sie zu tun wurden, ist das auch in Ordnung. Sie können nun besuchen Sie die Login-Seite (Symbol unten) weiterhin mit HIS jetzt. <b> Bitte beachten Sie, dass bis Sie manuell wiederherstellen Ihre alten SALT Werte in his-config.php, werden Sie nicht in der Lage, in wenn die Web-Schnittstelle.</b> Anmeldung';
$translation['dbexist2']['chinesesimplified']='如果重新创建的his-config.php文件，你希望做的，也就好了。现在，您可以访问登录页面（下面的图标），他现在继续使用。 <b>请注意，直到你手动恢复旧的盐值的config.php文件中，您将不能够登录，虽然网络接口。</b>';
$translation['dbexist2']['bulgarian']='Ако повторно създаване his-config.php е всичко, което се надявам да направя, това е добре. Сега можете да посетите страницата за вход (иконата по-долу), за да продължите да използвате HIS сега. <b> Моля, обърнете внимание, че докато не ръчно да възстановите предишните си стойности на сол в си-config.php, не ще бъде в състояние да влезете в макар и уеб интерфейс. </b>';

$translation['No job servers currently exist.  Go to the Cluster Map page and add some!']['english']='No job servers currently exist.  Go to the <a href="index.php?v=map">Cluster Map</a> page and add some!';
$translation['No job servers currently exist.  Go to the Cluster Map page and add some!']['german']='Keine Job Servern derzeit existieren. Zum <a href="index.php?v=map">Cluster Map</a> Seite und fügen Sie einige!';
$translation['No job servers currently exist.  Go to the Cluster Map page and add some!']['chinesesimplified']='没有工作的服务器目前存在。转到中<a href="index.php?v=map">集群地图</a>页和添加一些！';
$translation['No job servers currently exist.  Go to the Cluster Map page and add some!']['bulgarian']='Сървъри без работа в момента съществува. Отиди на <a href="index.php?v=map">Клъстер Карта на страница</a> и добавете малко!';

$translation['View Job Server Logs']['english']='View Job Server Logs';
$translation['View Job Server Logs']['german']='Anzeigen Job Server Logs';
$translation['View Job Server Logs']['chinesesimplified']='查看作业服务器日志';
$translation['View Job Server Logs']['bulgarian']='Дневник на сървър Работа';

$translation['Go Back to Cluster Map']['english']='Go Back to Cluster Map';
$translation['Go Back to Cluster Map']['german']='Zurück zum Cluster Map';
$translation['Go Back to Cluster Map']['chinesesimplified']='返回到群集地图去';
$translation['Go Back to Cluster Map']['bulgarian']='Обратно към Клъстер Карта';



$translation['EDIT page version: Job was not able to be submitted; no eligible job servers were available.']['english']='Job was not able to be submitted; no eligible job servers were available. Visit the <a href="?v=map" style="color:white;">Cluster Map</a> Page to add a job server.';
$translation['EDIT page version: Job was not able to be submitted; no eligible job servers were available.']['german']='Job konnte nicht vorgelegt werden; keine geeigneten Job Servern zur Verfügung standen. Besuchen Sie die <a href="?v=map" style="color:white;">Cluster Map</a> Seite, um einen Job Server hinzuzufügen.';
$translation['EDIT page version: Job was not able to be submitted; no eligible job servers were available.']['chinesesimplified']='作业是不能够被提交，没有符合条件的作业服务器是可用的。<a href="?v=map" style="color:white;">集群地图的</a>页到添加任务服务器。';
$translation['EDIT page version: Job was not able to be submitted; no eligible job servers were available.']['bulgarian']='Йов не е в състояние да се представят; не допустими сървъри на работни места са на разположение.Посетете <a href="?v=map" style="color:white;">Клъстер Карта</a> Page, за да добавите сървъра за работа.';


$translation['Job was not able to be submitted; no eligible job servers were available.']['english']='Job was not able to be submitted; no eligible job servers were available.';
$translation['Job was not able to be submitted; no eligible job servers were available.']['german']='Job konnte nicht vorgelegt werden; keine geeigneten Job Servern zur Verfügung standen.';
$translation['Job was not able to be submitted; no eligible job servers were available.']['chinesesimplified']='作业是不能够被提交，没有符合条件的作业服务器是可用的。';
$translation['Job was not able to be submitted; no eligible job servers were available.']['bulgarian']='Йов не е в състояние да се представят; не допустими сървъри на работни места са на разположение.';

$translation['Unable to submit job.  Add a Job Server first.']['english']='Unable to submit job. Add a <a href="?{THE_Q}v=map" style="color:white;">Job Server</a> first.';
$translation['Unable to submit job.  Add a Job Server first.']['german']='Unable to submit job. Add a <a href="?{THE_Q}v=map" style="color:white;">Job Server</a> first.';
$translation['Unable to submit job.  Add a Job Server first.']['chinesesimplified']='无法提交作业。添加一个<a href="?{THE_Q}v=map" style="color:white;">的作业服务器BBBBBBB第一。</a>';
$translation['Unable to submit job.  Add a Job Server first.']['bulgarian']='Не може да представи работа. Добавяне на работа <a href="?{THE_Q}v=map" style="color:white;">първото Server</a>.';

$translation['GUI']['english']='GUI';
$translation['GUI']['german']='User Interface';
$translation['GUI']['chinesesimplified']='用户界面';
$translation['GUI']['bulgarian']='Потребителски интерфейс';

$translation['Page automatically refreshes every']['english']='Page automatically refreshes every';
$translation['Page automatically refreshes every']['german']='Seite automatisch aktualisiert jeden';
$translation['Page automatically refreshes every']['chinesesimplified']='页面自动刷新每';
$translation['Page automatically refreshes every']['bulgarian']='Страница автоматично се опреснява на всеки';

$translation['minutes']['english']='minutes';
$translation['minutes']['german']='minuten';
$translation['minutes']['chinesesimplified']='分钟';
$translation['minutes']['bulgarian']='протокол';

$translation['Refresh Log Page Now']['english']='Refresh Log Page Now';
$translation['Refresh Log Page Now']['german']='Aktualisieren Log Page Jetzt';
$translation['Refresh Log Page Now']['chinesesimplified']='刷新日志现在';
$translation['Refresh Log Page Now']['bulgarian']='Обнови Вход Сега';

$translation['Update Server to latest version']['english']='Update Server to latest version';
$translation['Update Server to latest version']['german']='Update-Server auf die neueste Version';
$translation['Update Server to latest version']['chinesesimplified']='服务器更新到最新版本';
$translation['Update Server to latest version']['bulgarian']='Сървър за актуализация до последната версия';

$translation['last check-in was']['english']='last check-in was';
$translation['last check-in was']['german']='letzten check-in war';
$translation['last check-in was']['chinesesimplified']='最后检查是';
$translation['last check-in was']['bulgarian']='последна проверка е';

$translation['FULL PATH to folder above as HTTP path. Needs to exist already.']['english']='FULL PATH to folder above as HTTP path. Needs to exist already.';
$translation['FULL PATH to folder above as HTTP path. Needs to exist already.']['german']='FULL PATH oben Ordner als HTTP-Pfad. Muss bereits vorhanden sein.';
$translation['FULL PATH to folder above as HTTP path. Needs to exist already.']['chinesesimplified']='以上的HTTP路径文件夹的完整路径。需要已经存在。';
$translation['FULL PATH to folder above as HTTP path. Needs to exist already.']['bulgarian']='Пълния път до папката по-горе като HTTP път. Трябва да съществува вече.';

$translation['Base Web Folder Path']['english']='Base Web Folder Path';
$translation['Base Web Folder Path']['german']='Basis Web Folder Path';
$translation['Base Web Folder Path']['chinesesimplified']='基本的Web文件夹路径';
$translation['Base Web Folder Path']['bulgarian']='Base Path уеб Папка';

$translation['Inherited from Parent']['english']='Inherited from Parent';
$translation['Inherited from Parent']['german']='Geerbt von Eltern';
$translation['Inherited from Parent']['chinesesimplified']='继承自父';
$translation['Inherited from Parent']['bulgarian']='Наследени от майка';

$translation['PHP Call']['english']='PHP Call';
$translation['PHP Call']['german']='PHP Anruf';
$translation['PHP Call']['chinesesimplified']='PHP调用';
$translation['PHP Call']['bulgarian']='PHP Call';

$translation['Function Parameter Value Constraints']['english']='Function Parameter Value Constraints';
$translation['Function Parameter Value Constraints']['german']='Funktion Parameter Wert Constraints';
$translation['Function Parameter Value Constraints']['chinesesimplified']='功能参数值约束';
$translation['Function Parameter Value Constraints']['bulgarian']='Функция Ограничения стойността на параметъра';

$translation['POST Parameter']['english']='POST Parameter';
$translation['POST Parameter']['german']='POST Parameter';
$translation['POST Parameter']['chinesesimplified']='POST参数';
$translation['POST Parameter']['bulgarian']='POST параметър';

$translation['Delete Filter']['english']='Delete Filter';
$translation['Delete Filter']['german']='Filter Löschen';
$translation['Delete Filter']['chinesesimplified']='删除过滤器';
$translation['Delete Filter']['bulgarian']='Изтриване на филтър';

$translation['Message Queue Type']['english']='Message Queue Type';
$translation['Message Queue Type']['german']='Message Queue Type';
$translation['Message Queue Type']['chinesesimplified']='消息队列类型';
$translation['Message Queue Type']['bulgarian']='Тип съобщение Queue';

$translation['Your message queue system.']['english']='Your message queue system.';
$translation['Your message queue system.']['german']='Ihre Nachricht Queue-System.';
$translation['Your message queue system.']['chinesesimplified']='你的消息队列系统。';
$translation['Your message queue system.']['bulgarian']='Системата ви съобщение опашката.';


$translation['Choices are REGION_US_E1, REGION_US_W1, REGION_US_W2, REGION_EU_W1, REGION_APAC_SE1, REGION_APAC_SE2, REGION_APAC_NE1, REGION_SA_E1, REGION_US_GOV1']['english']='Choices are REGION_US_E1, REGION_US_W1, REGION_US_W2, REGION_EU_W1, REGION_APAC_SE1, REGION_APAC_SE2, REGION_APAC_NE1, REGION_SA_E1, REGION_US_GOV1';
$translation['Choices are REGION_US_E1, REGION_US_W1, REGION_US_W2, REGION_EU_W1, REGION_APAC_SE1, REGION_APAC_SE2, REGION_APAC_NE1, REGION_SA_E1, REGION_US_GOV1']['german']='Zur Auswahl stehen REGION_US_E1, REGION_US_W1, REGION_US_W2, REGION_EU_W1, REGION_APAC_SE1, REGION_APAC_SE2, REGION_APAC_NE1, REGION_SA_E1, REGION_US_GOV1';
$translation['Choices are REGION_US_E1, REGION_US_W1, REGION_US_W2, REGION_EU_W1, REGION_APAC_SE1, REGION_APAC_SE2, REGION_APAC_NE1, REGION_SA_E1, REGION_US_GOV1']['chinesesimplified']='选择REGION_US_E1, REGION_US_W1, REGION_US_W2, REGION_EU_W1, REGION_APAC_SE1, REGION_APAC_SE2, REGION_APAC_NE1, REGION_SA_E1, REGION_US_GOV1';
$translation['Choices are REGION_US_E1, REGION_US_W1, REGION_US_W2, REGION_EU_W1, REGION_APAC_SE1, REGION_APAC_SE2, REGION_APAC_NE1, REGION_SA_E1, REGION_US_GOV1']['bulgarian']='Възможности за избор са REGION_US_E1, REGION_US_W1, REGION_US_W2, REGION_EU_W1, REGION_APAC_SE1, REGION_APAC_SE2, REGION_APAC_NE1, REGION_SA_E1, REGION_US_GOV1';

$translation['Region']['english']='Region';
$translation['Region']['german']='Region';
$translation['Region']['chinesesimplified']='地区';
$translation['Region']['bulgarian']='област';


$translation['RabbitMQ Server']['english']='RabbitMQ Server';
$translation['RabbitMQ Server']['german']='RabbitMQ Server';
$translation['RabbitMQ Server']['chinesesimplified']='RabbitMQ 服务器';
$translation['RabbitMQ Server']['bulgarian']='RabbitMQ Сървър';

$translation['Virtual Host']['english']='Virtual Host';
$translation['Virtual Host']['german']='Virtual Host';
$translation['Virtual Host']['chinesesimplified']='虚拟主机';
$translation['Virtual Host']['bulgarian']='виртуален хост';


$translation['Queue Prefix']['english']='Queue Prefix';
$translation['Queue Prefix']['german']='Queue Präfix';
$translation['Queue Prefix']['chinesesimplified']='队列前缀';
$translation['Queue Prefix']['bulgarian']='Queue Prefix';

$translation['RabbitMQ Port']['english']='RabbitMQ Port';
$translation['RabbitMQ Port']['german']='RabbitMQ Hafen';
$translation['RabbitMQ Port']['chinesesimplified']='RabbitMQ 端口';
$translation['RabbitMQ Port']['bulgarian']='RabbitMQ отвор';


$translation['library field description']['english']='HIS will pre-populate the database with a library of software-centeric HIS functions, such as GCC, G++, VB.NET, Java, PHP, Python, and other software HIS Functions.  Your HIS Use Cases (collecting real estate addresses with wget, running your C++ program by calling it over HTTP using HIS) can <i>inherit the structure of these software-centric HIS Functions</i>.<br/><br/>

This allows you unlimited extendability (integrate any <i>software</i>), and saves you from building your software platform inside of HIS manually.<br/><br/>

Several popular Web Service API integrations are included in the function library.<br/><br/>

Web Services usually require login credentials, as they connect to external service provider systems that require authentication.  If any of the Services below interest you, register an account with them now and enter your API keys or passwords below.<br/><br/>

You can leave these entries blank, and they can be changed later from within your HIS Functions, inside of the "Function Parameters" section (the A= B= C= icon).';
$translation['library field description']['german']='Seinen Willen vorab bevölkern die Datenbank mit einer Bibliothek von Software-centeric HIS Funktionen wie GCC, G+ +, VB.NET, Java, PHP, Python und andere Software HIS Funktionen. Ihre HIS Use Cases (Sammeln von Immobilien-Adressen mit wget, läuft Ihr C + +-Programm, indem er sie über HTTP mit HIS) erben können die Struktur dieser Software-centric HIS Funktionen.<br/><br/>

Dies ermöglicht Ihnen unbegrenzte Erweiterbarkeit (Integration von beliebigen <i>Software</i>) und erspart Ihnen den Aufbau Ihrer Software-Plattform innerhalb von HIS manuell.<br/><br/>

Mehrere beliebte Web Service API-Integrationen sind in der Funktionsbibliothek enthalten..<br/><br/>

Web Services in der Regel erfordern Anmeldeinformationen, wie sie an externe Dienstleister Systeme, die eine Authentifizierung erfordern verbinden. Wenn eine der Dienstleistungen unter die Sie interessieren, registrieren Sie einen Account mit ihnen jetzt und geben Sie Ihren API-Schlüssel oder Kennwörter unten.<br/><br/>

Sie können lassen Sie diese Felder leer, und sie können später aus Ihrem HIS Funktionen, innerhalb der "Function-Parameter" (das A = B = C = Symbol) geändert werden.';
$translation['library field description']['chinesesimplified']='他的意志预先填充数据库的图书馆软件centeric的他的功能，如GCC，G++，VB.NET，Java，PHP和Python的软件和其他软件，其职能。你的他的用例（用wget，运行C + +程序通过调用它通过HTTP使用他收集房地产地址）可以继承这些软件为中心的职能结构。<br/><br/>

这可以让你无限的扩展性（集成任何软件），并节省您的软件平台建设里面他手动。<br/><br/>

几种流行的Web服务API函数库中的集成。<br/><br/>

Web服务通常需要登录凭据，当他们连接到外部服务提供商需要身份验证系统。如果你感兴趣下面的任何服务，注册一个帐户与他们现在在下面输入您的API密钥或密码。<br/><br/>

您可以留下这些项目的空白，他们可以在以后改变其职能，里面的“函数参数”一节（A = B = C =图标）内。';
$translation['library field description']['bulgarian']='Неговата воля попълните предварително на базата данни с библиотека на софтуер-centeric своите функции, като GCC, G+ +, VB.NET, Java, PHP, Python, и друг софтуер на своите функции. Вашите собствени нужди случаи (събиране на недвижими имоти с адреси Wget, пускането на вашите C + + програма, като я звъниш по HTTP използва HIS) може да наследи структурата на тези софтуер-централен неговите функции.<br/><br/>

Това ви позволява неограничен extendability (интегриране на <i>софтуер</i>), и ви спестява изграждането на вашата софтуерна платформа вътрешността на HIS ръчно.<br/><br/>

Няколко популярни уеб услуги API интеграции са включени във функцията библиотеката.<br/><br/>

Web Services обикновено изискват вход пълномощията, като те се свързват към външни системи на доставчиците на услуги, които изискват удостоверяване. Ако някоя от долупосочените услуги от интерес за Вас, регистрирайте си сметка с тях сега и въведете API ключове или пароли долу.<br/><br/>

Можете да оставите тези записи празно, и те могат да се променят по-късно от рамките си, функциите му във вътрешността на функцията "Параметри" раздел (на A = B = C = иконата).';

$translation['Messaging (message queue)']['english']='Messaging (message queue)';
$translation['Messaging (message queue)']['german']='Nachrichten (Message Queue)';
$translation['Messaging (message queue)']['chinesesimplified']='消息（消息队列）';
$translation['Messaging (message queue)']['bulgarian']='Съобщения (съобщение опашката)';

$translation['Message Queue Choices']['english']='Message Queue Choices';
$translation['Message Queue Choices']['german']='Message Queue Choices';
$translation['Message Queue Choices']['chinesesimplified']='消息队列的选择';
$translation['Message Queue Choices']['bulgarian']='Изборът опашката на съобщенията';

$translation['Live Remote Content Gather (no cache storage) - Manual Value Testing Submission']['english']='Live Remote Content Gather (no cache storage) - Manual Value Testing Submission';
$translation['Live Remote Content Gather (no cache storage) - Manual Value Testing Submission']['german']='ive-Remote-Inhalts Gather (kein Cache-Speicher) - Manuelle Wert Testing Submission';
$translation['Live Remote Content Gather (no cache storage) - Manual Value Testing Submission']['chinesesimplified']='实时远程内容聚拢（没有缓存存储） - 手动值测试提交';
$translation['Live Remote Content Gather (no cache storage) - Manual Value Testing Submission']['bulgarian']='На живо Remote Content Gather (без кеш памет) - Ръчна Стойност Подаване извършваща';

$translation['Text Filtering Wizard']['english']='Text Filtering Wizard';
$translation['Text Filtering Wizard']['german']='Text Filtering Wizard';
$translation['Text Filtering Wizard']['chinesesimplified']='文本过滤向导';
$translation['Text Filtering Wizard']['bulgarian']='Текст Filtering Wizard';

$translation['Add Constraint']['english']='Add Constraint';
$translation['Add Constraint']['german']='In Constraint';
$translation['Add Constraint']['chinesesimplified']='添加约束';
$translation['Add Constraint']['bulgarian']='Добави Ограничение';

$translation['Prepend']['english']='Prepend';
$translation['Prepend']['german']='Voranstellen';
$translation['Prepend']['chinesesimplified']='前置';
$translation['Prepend']['bulgarian']='прикрепяне';

$translation['Append']['english']='Append';
$translation['Append']['german']='Anhängen';
$translation['Append']['chinesesimplified']='附加';
$translation['Append']['bulgarian']='Прибавям';

$translation['There are no constraints on this function parameter.']['english']='There are no constraints on this function parameter.';
$translation['There are no constraints on this function parameter.']['german']='Es gibt keine Einschränkungen bezüglich dieser Funktion Parameter.';
$translation['There are no constraints on this function parameter.']['chinesesimplified']='这个函数的参数上没有任何限制。';
$translation['There are no constraints on this function parameter.']['bulgarian']='Не са открити ограничения за тази функция параметър.';

$translation['Overridden']['english']='Overridden';
$translation['Overridden']['german']='Überschrieben';
$translation['Overridden']['chinesesimplified']='重写';
$translation['Overridden']['bulgarian']='Заменена';

$translation['Example']['english']='Example';
$translation['Example']['german']='Beispiel';
$translation['Example']['chinesesimplified']='例子';
$translation['Example']['bulgarian']='Пример';

$translation['After Function Parameter/Adjacent Dictionary Value Replacement']['english']='After Function Parameter/Adjacent Dictionary Value Replacement';
$translation['After Function Parameter/Adjacent Dictionary Value Replacement']['german']='Nach Funktion Parameter / Angrenzende Wörterbuch Wertersatz';
$translation['After Function Parameter/Adjacent Dictionary Value Replacement']['chinesesimplified']='在函数参数/邻字典值替换';
$translation['After Function Parameter/Adjacent Dictionary Value Replacement']['bulgarian']='След Функция параметър / Непосредствено заместване на стойността на речник';

$translation['pattern']['english']='pattern';
$translation['pattern']['german']='muster';
$translation['pattern']['chinesesimplified']='模式';
$translation['pattern']['bulgarian']='модел';

$translation['split delimiter']['english']='split delimiter';
$translation['split delimiter']['german']='split trennzeichen';
$translation['split delimiter']['chinesesimplified']='拆分分隔符';
$translation['split delimiter']['bulgarian']='сплит разделител';

$translation['XPath']['english']='XPath';
$translation['XPath']['german']='XPath';
$translation['XPath']['chinesesimplified']='XPath';
$translation['XPath']['bulgarian']='XPath';

$translation['split regex']['english']='split regex';
$translation['split regex']['german']='aufgeteilt regex';
$translation['split regex']['chinesesimplified']='分裂regex';
$translation['split regex']['bulgarian']='разделят regex';

$translation['Current Adjacent Dictionary Contents']['english']='Current Adjacent Dictionary Contents';
$translation['Current Adjacent Dictionary Contents']['german']='Aktuelle Angrenzend Wörterbuch Inhaltsverzeichnis';
$translation['Current Adjacent Dictionary Contents']['chinesesimplified']='当前相邻词典内容';
$translation['Current Adjacent Dictionary Contents']['bulgarian']='Текущи Съседните Съдържание Речник';

$translation['Job']['english']='Job';
$translation['Job']['german']='Job';
$translation['Job']['chinesesimplified']='工作';
$translation['Job']['bulgarian']='работа';

$translation['has been submitted']['english']='has been submitted';
$translation['has been submitted']['german']='vorgelegt worden';
$translation['has been submitted']['chinesesimplified']='已经提交';
$translation['has been submitted']['bulgarian']='е подадено';

$translation['was cancelled']['english']='was cancelled';
$translation['was cancelled']['german']='wurde abgesagt';
$translation['was cancelled']['chinesesimplified']='被取消';
$translation['was cancelled']['bulgarian']='беше отменена';

$translation['The job cluster was too busy or not responsive.']['english']='The job cluster was too busy or not responsive.';
$translation['The job cluster was too busy or not responsive.']['german']='Der Job Cluster war zu beschäftigt oder nicht reagiert.';
$translation['The job cluster was too busy or not responsive.']['chinesesimplified']='作业集群太忙或不响应。';
$translation['The job cluster was too busy or not responsive.']['bulgarian']='Работата клъстер е твърде зает или не отговаря.';

$translation['cannot wait for results']['english']='Cannot wait any longer for a direct output response from the cluster.  This is not necessarily an error, it just means that the data set is large, processing is taking a long time, or the cluster is busy.  Output expressions may still be evaluated if the job was started before this cancel signal reaches the cluster, however.';
$translation['cannot wait for results']['german']='Kann nicht länger warten für eine direkte Reaktion am Ausgang aus dem Cluster. Dies ist nicht unbedingt ein Fehler, es bedeutet nur, dass der Datensatz groß ist, wird die Bearbeitung zu lange dauert, oder der Cluster ist besetzt. Output Ausdrücke können noch ausgewertet, wenn der Job gestartet wurde, bevor diese abbrechen Signal erreicht den Cluster jedoch werden.';
$translation['cannot wait for results']['chinesesimplified']='不能再等下去从集群中的直接输出响应。这不一定是一个错误，它只是意味着大的数据集，处理花费很长的时间，或集群是忙的。输出表达式仍可能进行评估，如果作业已经开始，在此之前取消信号达到集群，但是。';
$translation['cannot wait for results']['bulgarian']='Не мога да чакам повече за пряк отговор изход от клъстера. Това не е задължително за грешка, това просто означава, че посочените данни е голям, обработката се отнема много време, или на клъстера е зает. Изходни изрази, все още могат да бъдат оценени, ако работата е започнала преди този сигнал Cancel достигне клъстер, обаче.';

$translation['After POST Parameter replacement']['english']='After POST Parameter replacement';
$translation['After POST Parameter replacement']['german']='Nach POST Parameter Ersatz';
$translation['After POST Parameter replacement']['chinesesimplified']='POST参数后更换';
$translation['After POST Parameter replacement']['bulgarian']='След подмяна POST параметър';

$translation['Value Given']['english']='Value Given';
$translation['Value Given']['german']='Wert angegeben';
$translation['Value Given']['chinesesimplified']='鉴于价值';
$translation['Value Given']['bulgarian']='дадена стойност';

$translation['Decoded To']['english']='Decoded To';
$translation['Decoded To']['german']='decodiert, um';
$translation['Decoded To']['chinesesimplified']='解码要';
$translation['Decoded To']['bulgarian']='декодира';

$translation['NOT']['english']='NOT';
$translation['NOT']['german']='NICHT';
$translation['NOT']['chinesesimplified']='不';
$translation['NOT']['bulgarian']='НЕ';

$translation['Live and Default Values']['english']='Live and Default Values';
$translation['Live and Default Values']['german']='Live-und Standardwerte';
$translation['Live and Default Values']['chinesesimplified']='生活和默认值';
$translation['Live and Default Values']['bulgarian']='На живо и приети стойности';

$translation['Live and Fully Described']['english']='Live and Fully Described';
$translation['Live and Fully Described']['german']='Leben und vollständig beschrieben';
$translation['Live and Fully Described']['chinesesimplified']='生活和全面的描述';
$translation['Live and Fully Described']['bulgarian']='На живо и напълно описан';

$translation['Non-Live']['english']='Non-Live';
$translation['Non-Live']['german']='Non-Live';
$translation['Non-Live']['chinesesimplified']='非现场';
$translation['Non-Live']['bulgarian']='Non-Live';

$translation['Commit Live XML/CXML output as stored output']['english']='Commit Live XML/CXML output as stored output';
$translation['Commit Live XML/CXML output as stored output']['german']='Commit Live-XML / CXML Ausgang als Ausgang gespeichert';
$translation['Commit Live XML/CXML output as stored output']['chinesesimplified']='Поемане на ангажимент живо XML / CXML изход, както се съхраняват продукцията';
$translation['Commit Live XML/CXML output as stored output']['bulgarian']='Поемане на ангажимент живо XML / CXML изход, както се съхраняват продукцията';

$translation['Commit CXML Output']['english']='Commit CXML Output';
$translation['Commit CXML Output']['german']='Commit CXML Output';
$translation['Commit CXML Output']['chinesesimplified']='提交CXML输出';
$translation['Commit CXML Output']['bulgarian']='Поемане на ангажимент CXML Output';

$translation['Commit XML Output']['english']='Commit XML Output';
$translation['Commit XML Output']['german']='Commit XML-Ausgabe';
$translation['Commit XML Output']['chinesesimplified']='提交XML输出';
$translation['Commit XML Output']['bulgarian']='Поемане на ангажимент XML изход';

$translation['stored cxml output sample']['english']='stored cxml output sample';
$translation['stored cxml output sample']['german']='gespeichert CXML Ausgang Probe';
$translation['stored cxml output sample']['chinesesimplified']='存储CXML输出采样';
$translation['stored cxml output sample']['bulgarian']='съхраняват CXML примерен резултат';

$translation['stored xml output sample']['english']='stored xml output sample';
$translation['stored xml output sample']['german']='gespeicherten XML-Ausgabe Probe';
$translation['stored xml output sample']['chinesesimplified']='存储的XML输出采样';
$translation['stored xml output sample']['bulgarian']='съхраняват XML примерен резултат';

$translation['live his-xml version of this page']['english']='live his-xml version of this page';
$translation['live his-xml version of this page']['german']='leben seine xml-Version dieser Seite';
$translation['live his-xml version of this page']['chinesesimplified']='住他的这个页面的XML版本';
$translation['live his-xml version of this page']['bulgarian']='живеят си-XML версия на тази страница';

$translation['live his-xml short version of this page']['english']='live his-xml short version of this page';
$translation['live his-xml short version of this page']['german']='leben seine kurz-xml-Version dieser Seite';
$translation['live his-xml short version of this page']['chinesesimplified']='住他的XML短版本页';
$translation['live his-xml short version of this page']['bulgarian']='живеят си-XML кратка версия на тази страница';

$translation['live download your']['english']='live download your';
$translation['live download your']['german']='leben laden Sie Ihre';
$translation['live download your']['chinesesimplified']='生活下载';
$translation['live download your']['bulgarian']='живеят изтеглите';

$translation['job\'s raw']['english']='job\'s raw';
$translation['job\'s raw']['german']='Hiobs raw';
$translation['job\'s raw']['chinesesimplified']='作业的原料';
$translation['job\'s raw']['bulgarian']='Работа сурова';

$translation['custom-formatted']['english']='custom-formatted';
$translation['custom-formatted']['german']='custom-formatierte';
$translation['custom-formatted']['chinesesimplified']='自定义格式';
$translation['custom-formatted']['bulgarian']='поръчка форматиран';

$translation['output, but use cached pre-approved input resource data as input']['english']='output, but use cached pre-approved input resource data as input';
$translation['output, but use cached pre-approved input resource data as input']['german']='Ausgang, sondern verwenden zwischengespeichert pre-approved Eingang Ressource Daten als Input';
$translation['output, but use cached pre-approved input resource data as input']['chinesesimplified']='输出，但使用缓存的预先核准输入的数据作为输入资源';
$translation['output, but use cached pre-approved input resource data as input']['bulgarian']='изход, а да използват кеширани предварително одобрени входни данни ресурс, вход';

$translation['non-live his-xml version of this page']['english']='non-live his-xml version of this page';
$translation['non-live his-xml version of this page']['german']='Nicht-Live-his-xml-Version dieser Seite';
$translation['non-live his-xml version of this page']['chinesesimplified']='非现场他这个页面的XML版本';
$translation['non-live his-xml version of this page']['bulgarian']='не-живо си-XML версия на тази страница';

$translation['non-live his-xml short version of this page']['english']='non-live his-xml short version of this page';
$translation['non-live his-xml short version of this page']['german']='Nicht-Live-xml seiner kurzen Version dieser Seite';
$translation['non-live his-xml short version of this page']['chinesesimplified']='非现场的XML短版本页';
$translation['non-live his-xml short version of this page']['bulgarian']='не-живо си-XML кратка версия на тази страница';

$translation['non-live download your']['english']='non-live download your';
$translation['non-live download your']['german']='Nicht-Live-Download-';
$translation['non-live download your']['chinesesimplified']='非实时下载';
$translation['non-live download your']['bulgarian']='не-на живо изтеглите';

$translation['Long Running Jobs']['english']='Long Running Jobs';
$translation['Long Running Jobs']['german']='Lange Laufzeit Jobs';
$translation['Long Running Jobs']['chinesesimplified']='长期任务';
$translation['Long Running Jobs']['bulgarian']='Дълго тичане Работа';

$translation['POSTBACK Enabled']['english']='POSTBACK Enabled';
$translation['POSTBACK Enabled']['german']='POSTBACK Aktiviert';
$translation['POSTBACK Enabled']['chinesesimplified']='启用 POSTBACK';
$translation['POSTBACK Enabled']['bulgarian']='POSTBACK Enabled';

$translation['HIS Functions are Exportable']['english']='HIS Functions are Exportable';
$translation['HIS Functions are Exportable']['german']='HIS Funktionen sind exportierbar';
$translation['HIS Functions are Exportable']['chinesesimplified']='HIS 导出的功能';
$translation['HIS Functions are Exportable']['bulgarian']='HIS Функциите могат да се изнасят';

$translation['HIS XML Exports = Open Format']['english']='HIS XML Exports = Open Format';
$translation['HIS XML Exports = Open Format']['german']='HIS XML Exporte = Offen Format';
$translation['HIS XML Exports = Open Format']['chinesesimplified']='HIS XML导出=开放格式';
$translation['HIS XML Exports = Open Format']['bulgarian']='XML Exports = Open Format';

$translation['Import Function']['english']='Import Function';
$translation['Import Function']['german']='Import Funktion';
$translation['Import Function']['chinesesimplified']='导入功能';
$translation['Import Function']['bulgarian']='Внос Function';

$translation['Select a HF XML file to import into your HIS Library.']['english']='Select a HF XML file to import into your HIS Library.';
$translation['Select a HF XML file to import into your HIS Library.']['german']='Wählen Sie ein HF-XML-Datei in Ihr HIS-Bibliothek zu importieren.';
$translation['Select a HF XML file to import into your HIS Library.']['chinesesimplified']='选择一个HF XML文件导入到您的他的图书馆。';
$translation['Select a HF XML file to import into your HIS Library.']['bulgarian']='Изберете HF XML файл, за да импортирате във вашия библиотеката му.';

$translation['Function Library installation']['english']='Function Library installation';
$translation['Function Library installation']['german']='Function Library Installation';
$translation['Function Library installation']['chinesesimplified']='函数库安装';
$translation['Function Library installation']['bulgarian']='Инсталация Function Library';

$translation['These steps will be done Automatically.  Stepping through function library installation...']['english']='These steps will be done Automatically.  Stepping through function library installation...';
$translation['These steps will be done Automatically.  Stepping through function library installation...']['german']='Diese Schritte werden automatisch durchgeführt werden.  Stepping durch Funktionsbibliothek Installation ...';
$translation['These steps will be done Automatically.  Stepping through function library installation...']['chinesesimplified']='这些步骤将自动完成。步进通过函数库安装...';
$translation['These steps will be done Automatically.  Stepping through function library installation...']['bulgarian']='Тези стъпки ще се извършва автоматично. Засилване чрез инсталиране функция библиотека ...';

$translation['Setup complete.']['english']='Setup complete.';
$translation['Setup complete.']['german']='Setup abzuschließen.';
$translation['Setup complete.']['chinesesimplified']='设置完成。';
$translation['Setup complete.']['bulgarian']='Настройката е завършена.';

$translation['Setup was successful.  Click ']['english']='Setup was successful.  Click ';
$translation['Setup was successful.  Click ']['german']='Setup erfolgreich war. Klicken';
$translation['Setup was successful.  Click ']['chinesesimplified']='安装成功。点击';
$translation['Setup was successful.  Click ']['bulgarian']='Настройка е успешна. Натиснете тук';

$translation[' to login to HIS.']['english']=' to login to HIS.';
$translation[' to login to HIS.']['german']=' um sich an HIS.';
$translation[' to login to HIS.']['chinesesimplified']='登录到HIS.';
$translation[' to login to HIS.']['bulgarian']='за да влезете в HIS.';

$translation['Continue and Import Functions into Library']['english']='Continue and Import Functions into Library';
$translation['Continue and Import Functions into Library']['german']='Weiter Importieren Funktionen in Bibliothek';
$translation['Continue and Import Functions into Library']['chinesesimplified']='继续导入到图书馆的功能';
$translation['Continue and Import Functions into Library']['bulgarian']='Продължаване на импортирането Функции в библиотека';

$translation['Search Results']['english']='Search Results';
$translation['Search Results']['german']='Search Results';
$translation['Search Results']['chinesesimplified']='搜索结果';
$translation['Search Results']['bulgarian']='Резултати от търсенето';

$translation['Server Cleanup']['english']='Server Cleanup';
$translation['Server Cleanup']['german']='Server Cleanup';
$translation['Server Cleanup']['chinesesimplified']='服务器清理';
$translation['Server Cleanup']['bulgarian']='почистване на сървъра';

$translation['Cleanup all job files after job completion?']['english']='Cleanup all job files after job completion?';
$translation['Cleanup all job files after job completion?']['german']='Cleanup alle Job-Dateien nach Beendigung des Jobs?';
$translation['Cleanup all job files after job completion?']['chinesesimplified']='清理工作完成后，所有的工作文件？';
$translation['Cleanup all job files after job completion?']['bulgarian']='Почистване на всички работни файлове, след завършване на заданията?';

$translation['Pure URL-style submission of this search (when called from your mobile app codes, for example), would look like:']['english']='Pure URL-style submission of this search (when called from your mobile app codes, for example), would look like:';
$translation['Pure URL-style submission of this search (when called from your mobile app codes, for example), would look like:']['german']='Reines URL-Stil Einreichung dieser Suche (wenn von Ihrem mobilen App-Codes genannt, zum Beispiel), würde so aussehen:';
$translation['Pure URL-style submission of this search (when called from your mobile app codes, for example), would look like:']['chinesesimplified']='纯URL样式提交这个搜索（调用时，从您的移动应用程序代码，例如），看起来像这样：';
$translation['Pure URL-style submission of this search (when called from your mobile app codes, for example), would look like:']['bulgarian']='Pure URL стил представяне на това търсене (когато се обади от мобилния си кодове за приложения, например), ще изглежда така:';

$translation['Function ID']['english']='Function ID';
$translation['Function ID']['german']='Funktion ID';
$translation['Function ID']['chinesesimplified']='功能ID';
$translation['Function ID']['bulgarian']='Функция ID';

$translation['Hyperlinks for Integration']['english']='Hyperlinks for Integration';
$translation['Hyperlinks for Integration']['german']='Hyperlinks für Integration';
$translation['Hyperlinks for Integration']['chinesesimplified']='一体化的超链接';
$translation['Hyperlinks for Integration']['bulgarian']='Хипервръзки за интеграция';

$translation['View HIS Function Edit Interface']['english']='View HIS Function Edit Interface';
$translation['View HIS Function Edit Interface']['german']='Schauen Sie seine Funktion Interface bearbeiten';
$translation['View HIS Function Edit Interface']['chinesesimplified']='查看他的功能编辑界面';
$translation['View HIS Function Edit Interface']['bulgarian']='Вижте неговата функционална Edit Interface';

$translation['Live Variations returning raw data (Remote resources acquired, live HIS resource collection occurs)']['english']='Live Variations returning raw data (Remote resources acquired, live HIS resource collection occurs)';
$translation['Live Variations returning raw data (Remote resources acquired, live HIS resource collection occurs)']['german']='Live-Variationen wiederkehrende Rohdaten (Remote Ressourcen erworben, leben HIS Wertstoffsammlung auftritt)';
$translation['Live Variations returning raw data (Remote resources acquired, live HIS resource collection occurs)']['chinesesimplified']='返回原始数据的实时变化（遥控资源收购，住他的资源收集发生）';
$translation['Live Variations returning raw data (Remote resources acquired, live HIS resource collection occurs)']['bulgarian']='Живи Вариации завръщащи суровите данни (Remote ресурси придобити, живеят HIS ресурс събиране случва)';

$translation['Useful for Integration - Returns Raw Data']['english']='Useful for Integration - Returns Raw Data';
$translation['Useful for Integration - Returns Raw Data']['german']='Nützlich für Integration - Gibt Rohdaten';
$translation['Useful for Integration - Returns Raw Data']['chinesesimplified']='有用的整合 - 返回原始数据';
$translation['Useful for Integration - Returns Raw Data']['bulgarian']='Полезно за интеграция - Връща Raw Data';

$translation['Non-Live Variations returning raw data (Use cached content, no job servers or associated remote content contacted)']['english']='Non-Live Variations returning raw data (Use cached content, no job servers or associated remote content contacted)';
$translation['Non-Live Variations returning raw data (Use cached content, no job servers or associated remote content contacted)']['german']='Non-Live Variationen wiederkehrende Rohdaten (Verwenden zwischengespeicherten Inhalt, keine Job-Server oder Remote zugehörigen content kontaktiert)';
$translation['Non-Live Variations returning raw data (Use cached content, no job servers or associated remote content contacted)']['chinesesimplified']='非现场变化返回原始数据（使用高速缓存的内容，没有工作的服务器或联络相关的远程内容）';
$translation['Non-Live Variations returning raw data (Use cached content, no job servers or associated remote content contacted)']['bulgarian']='Non-Live Вариации завръщащи суровите данни (Използвайте кеширана съдържание, без работа сървъри или свързаното с дистанционно контакт съдържание)';

$translation['live his-xml version of this search']['english']='live his-xml version of this search';
$translation['live his-xml version of this search']['german']='leben his-xml version dieser suche';
$translation['live his-xml version of this search']['chinesesimplified']='住此搜索 his-xml 版';
$translation['live his-xml version of this search']['bulgarian']='живеят his-xml версия на това търсене';

$translation['live his-xml short version of this search']['english']='live his-xml short version of this search';
$translation['live his-xml short version of this search']['german']='leben his-xml kurze version dieser suche';
$translation['live his-xml short version of this search']['chinesesimplified']='住 his-xml 短版搜索';
$translation['live his-xml short version of this search']['bulgarian']='живеят his-xml кратка версия на това търсене';

$translation['live download your customized-format output']['english']='live download your customized-format output';
$translation['live download your customized-format output']['german']='leben laden sie ihre customized-ausgabeformat';
$translation['live download your customized-format output']['chinesesimplified']='生活下载您的自定义格式输出';
$translation['live download your customized-format output']['bulgarian']='живеят изтеглите потребителски-изходен формат';

$translation['non-live his-xml version of this search']['english']='non-live his-xml version of this search';
$translation['non-live his-xml version of this search']['german']='nicht-live his-xml Version dieser Suche';
$translation['non-live his-xml version of this search']['chinesesimplified']='此搜索非现场 his-xml 版本';
$translation['non-live his-xml version of this search']['bulgarian']='не-на живо his-xml версия на това търсене';

$translation['non-live his-xml short version of this search']['english']='non-live his-xml short version of this search';
$translation['non-live his-xml short version of this search']['german']='nicht-live his-xml kurze version dieser suche';
$translation['non-live his-xml short version of this search']['chinesesimplified']='非实时的短版 his-xml 此搜索';
$translation['non-live his-xml short version of this search']['bulgarian']='не-на живо his-xml кратка версия на това търсене';

$translation['non-live download your customized-format output']['english']='non-live download your customized-format output';
$translation['non-live download your customized-format output']['german']='nicht-live-download-customized-ausgabeformat';
$translation['non-live download your customized-format output']['chinesesimplified']='非实时下载您的自定义格式输出';
$translation['non-live download your customized-format output']['bulgarian']='не-на живо изтеглите потребителски-изходен формат';

$translation['non-live download your customized-format output, but use cached pre-approved input resource data as input']['english']='non-live download your customized-format output, but use cached pre-approved input resource data as input';
$translation['non-live download your customized-format output, but use cached pre-approved input resource data as input']['german']='nicht-live-download-customized-format ausgegeben, sondern verwenden zwischengespeichert pre-approved eingang ressource daten als input
';
$translation['non-live download your customized-format output, but use cached pre-approved input resource data as input']['chinesesimplified']='非实时下载您定制的格式输出，但使用缓存预先核准的输入数据作为输入资源';
$translation['non-live download your customized-format output, but use cached pre-approved input resource data as input']['bulgarian']='не-на живо изтеглите потребителски-изходен формат, но използват кеширани предварително одобрени входни данни ресурс, вход';

$translation['Use the URLs below to repeat this search.']['english']='Use the URLs below to repeat this search.';
$translation['Use the URLs below to repeat this search.']['german']='Verwenden Sie die folgenden URLs, um diese Suche zu wiederholen.';
$translation['Use the URLs below to repeat this search.']['chinesesimplified']='请使用以下的网址，重复此搜索。';
$translation['Use the URLs below to repeat this search.']['bulgarian']='Използвайте URL-долу, за да повторите това търсене.';

$translation['All variations of these URLs will treat the first result returned as the selected HIS Function.']['english']='All variations of these URLs will treat the first result returned as the selected HIS Function.';
$translation['All variations of these URLs will treat the first result returned as the selected HIS Function.']['german']='Alle Varianten dieser URLs behandeln das erste Ergebnis als ausgewählt seiner Funktion zurückgegeben.';
$translation['All variations of these URLs will treat the first result returned as the selected HIS Function.']['chinesesimplified']='所有这些URL的变化，将治疗选择他的功能为返回的第一个结果。';
$translation['All variations of these URLs will treat the first result returned as the selected HIS Function.']['bulgarian']='Всички варианти на тези адреси ще третира първия резултат връща като избран функциите си.';

$translation['HIS System Information']['english']='HIS System Information';
$translation['HIS System Information']['german']='HIS System Information';
$translation['HIS System Information']['chinesesimplified']='HIS 系统信息';
$translation['HIS System Information']['bulgarian']='HIS система за информация';

$translation['Software Version']['english']='Software Version';
$translation['Software Version']['german']='Software Version';
$translation['Software Version']['chinesesimplified']='软件版本';
$translation['Software Version']['bulgarian']='Software Version';

$translation['Click here to show older downloads']['english']='Click here to show older downloads';
$translation['Click here to show older downloads']['german']='Klicken Sie hier, um ältere Downloads zeigen';
$translation['Click here to show older downloads']['chinesesimplified']='点击此处显示年长的下载';
$translation['Click here to show older downloads']['bulgarian']='Кликнете тук, за да покажат големи сваляния';

$translation['Integration']['english']='Integration';
$translation['Integration']['german']='Integration';
$translation['Integration']['chinesesimplified']='积分';
$translation['Integration']['bulgarian']='интеграция';

$translation['How to execute HIS Functions and integrate them into your applications']['english']='How to execute HIS Functions and integrate them into your applications';
$translation['How to execute HIS Functions and integrate them into your applications']['german']='So führen seine Aufgaben und integrieren sie in Ihre Anwendungen';
$translation['How to execute HIS Functions and integrate them into your applications']['chinesesimplified']='如何执行其职能，并将它们整合到您的应用程序';
$translation['How to execute HIS Functions and integrate them into your applications']['bulgarian']='Как да изпълни своите функции и да ги интегрират в своите приложения';

$translation['HTTP GET/POST calls can be executed using any the following tools']['english']='HTTP GET/POST calls can be executed using any the following tools';
$translation['HTTP GET/POST calls can be executed using any the following tools']['german']='HTTP GET/POST Anrufe ausgeführt werden kann mit einem beliebigen der folgenden Tools';
$translation['HTTP GET/POST calls can be executed using any the following tools']['chinesesimplified']='HTTP GET/POST调用可以使用以下任何工具执行';
$translation['HTTP GET/POST calls can be executed using any the following tools']['bulgarian']='HTTP GET/POST разговори могат да бъдат изпълнени с използване на следните инструменти';

$translation['Code Samples for this Function']['english']='Code Samples for this Function';
$translation['Code Samples for this Function']['german']='Code-Beispiele für diese Funktion';
$translation['Code Samples for this Function']['chinesesimplified']='此功能的代码示例';
$translation['Code Samples for this Function']['bulgarian']='Примери с код за тази функция';

$translation['Not sure what to type in the [HIS_SECRET_KEY] entry in the sample codes?']['english']='Not sure what to type in the [HIS_SECRET_KEY] entry in the sample codes?';
$translation['Not sure what to type in the [HIS_SECRET_KEY] entry in the sample codes?']['german']='Nicht sicher, was Sie in der [HIS_SECRET_KEY] Eintrag in den Probe-Codes eingeben?';
$translation['Not sure what to type in the [HIS_SECRET_KEY] entry in the sample codes?']['chinesesimplified']='不知道什么类型[HIS_SECRET_KEY]条目中的示例代码？';
$translation['Not sure what to type in the [HIS_SECRET_KEY] entry in the sample codes?']['bulgarian']='Не съм сигурен какво да въведете в [HIS_SECRET_KEY] влизането в проба кодове?';

$translation['Looking to call this HIS Function via HTTP GET and provide customized inputs to this function?']['english']='Looking to call this HIS Function via HTTP GET and provide customized inputs to this function?';
$translation['Looking to call this HIS Function via HTTP GET and provide customized inputs to this function?']['german']='Mit Blick auf dieses seiner Funktion rufen via HTTP GET und bieten maßgeschneiderte Eingänge dieser Funktion?';
$translation['Looking to call this HIS Function via HTTP GET and provide customized inputs to this function?']['chinesesimplified']='希望这是他的功能调用，通过HTTP GET和提供定制化的投入这个函数吗？';
$translation['Looking to call this HIS Function via HTTP GET and provide customized inputs to this function?']['bulgarian']='Търся да наричаме това функцията му чрез HTTP GET и предоставят персонализирани входове за тази функция?';

$translation['The code snippets below require your HIS Secret Key.']['english']='The code snippets below require your HIS Secret Key.';
$translation['The code snippets below require your HIS Secret Key.']['german']='Die Code-Schnipsel unten benötigen Ihre seinem geheimen Schlüssel.';
$translation['The code snippets below require your HIS Secret Key.']['chinesesimplified']='下面的代码片段需要他的秘密的关键。';
$translation['The code snippets below require your HIS Secret Key.']['bulgarian']='Откъсите с кода по-долу изискват вашата HIS Secret Key.';

$translation[' to find your HIS Secret Key.']['english']=' to find your HIS Secret Key.';
$translation[' to find your HIS Secret Key.']['german']=' ihre HIS geheimen Schlüssel zu finden.';
$translation[' to find your HIS Secret Key.']['chinesesimplified']=' 找到您的HIS秘密密钥。';
$translation[' to find your HIS Secret Key.']['bulgarian']=' да намери своя HIS Secret Key.';

$translation['for future reference as an example of this functions [C]XML output']['english']='for future reference as an example of this function\'s [C]XML output';
$translation['for future reference as an example of this functions [C]XML output']['german']='für die Zukunft als ein Beispiel für diese Funktion ist [C] XML-Ausgabe';
$translation['for future reference as an example of this functions [C]XML output']['chinesesimplified']='此函数的[C] XML输出​​作为一个例子以供日后参考';
$translation['for future reference as an example of this functions [C]XML output']['bulgarian']='за справка в бъдеще, като пример за тази функция е [C] изход XML';

$translation['HTTP GET/POST calls to ']['english']='HTTP GET/POST calls to ';
$translation['HTTP GET/POST calls to ']['german']='HTTP GET / POST Anrufe an';
$translation['HTTP GET/POST calls to ']['chinesesimplified']='HTTP GET / POST调用';
$translation['HTTP GET/POST calls to ']['bulgarian']='HTTP GET / POST разговори към';

$translation[' will return raw HIS data and/or filtered texts.']['english']=' will return raw HIS data and/or filtered texts.';
$translation[' will return raw HIS data and/or filtered texts.']['german']=' wird roh HIS-Daten und / oder gefiltert Texte zurück.';
$translation[' will return raw HIS data and/or filtered texts.']['chinesesimplified']='将返回原始他的数据和/或过滤的文本。';
$translation[' will return raw HIS data and/or filtered texts.']['bulgarian']=' ще се върне сурова неговите данни и / или филтрирана текстове.';

$translation['Function name cannot be empty.']['english']='Function name cannot be empty.';
$translation['Function name cannot be empty.']['german']='Name der Funktion darf nicht leer sein.';
$translation['Function name cannot be empty.']['chinesesimplified']='函数名不能为空。';
$translation['Function name cannot be empty.']['bulgarian']='Име на функция не може да бъде празно.';

$translation['A Function with that name already exists.']['english']='A Function with that name already exists.';
$translation['A Function with that name already exists.']['german']='Eine Funktion mit diesem Namen existiert bereits.';
$translation['A Function with that name already exists.']['chinesesimplified']='A功能与该名称已经存在。';
$translation['A Function with that name already exists.']['bulgarian']='Функция с това име вече съществува.';

$translation['Function added.']['english']='Function added.';
$translation['Function added.']['german']='Diese Funktion wurde hinzugefügt.';
$translation['Function added.']['chinesesimplified']='功能。';
$translation['Function added.']['bulgarian']='Функция добавя.';

$translation['POST Variables']['english']='POST Variables';
$translation['POST Variables']['german']='POST Variablen';
$translation['POST Variables']['chinesesimplified']='POST 变量';
$translation['POST Variables']['bulgarian']='POST Променливи';

$translation['POST Variable']['english']='POST Variable';
$translation['POST Variable']['german']='POST Variable';
$translation['POST Variable']['chinesesimplified']='POST 变量';
$translation['POST Variable']['bulgarian']='POST променлив';

$translation['VALUE AFTER REPLACEMENT']['english']='VALUE AFTER REPLACEMENT';
$translation['VALUE AFTER REPLACEMENT']['german']='VALUE NACH DEM AUSTAUSCH';
$translation['VALUE AFTER REPLACEMENT']['chinesesimplified']='更换后的值';
$translation['VALUE AFTER REPLACEMENT']['bulgarian']='VALUE СЛЕД ПРОТЕЗИРАНЕ';

$translation['Add a new POST variable named']['english']='Add a new POST variable named';
$translation['Add a new POST variable named']['german']='Fügen Sie eine neue Variable namens POST';
$translation['Add a new POST variable named']['chinesesimplified']='添加一个新的POST变量命名';
$translation['Add a new POST variable named']['bulgarian']='Добавяне на нов пост именувана променлива';

$translation['Add Variable']['english']='Add Variable';
$translation['Add Variable']['german']='Variable hinzufügen';
$translation['Add Variable']['chinesesimplified']='添加变量';
$translation['Add Variable']['bulgarian']='Добави Variable';

$translation['Send data to URL']['english']='Send data to URL';
$translation['Send data to URL']['german']='Senden von Daten an URL';
$translation['Send data to URL']['chinesesimplified']='将数据发送到网址';
$translation['Send data to URL']['bulgarian']='Изпращане на данни за URL';

$translation['VALUE AFTER PARAMETER/ADJACENT DICTIONARY REPLACEMENT']['english']='VALUE AFTER PARAMETER/ADJACENT DICTIONARY REPLACEMENT';
$translation['VALUE AFTER PARAMETER/ADJACENT DICTIONARY REPLACEMENT']['german']='WERT NACH PARAMETER / ANGRENZENDE WÖRTERBUCH ERSATZ';
$translation['VALUE AFTER PARAMETER/ADJACENT DICTIONARY REPLACEMENT']['chinesesimplified']='参数值后/相邻的词典置换';
$translation['VALUE AFTER PARAMETER/ADJACENT DICTIONARY REPLACEMENT']['bulgarian']='СТОЙНОСТ, СЛЕД КАТО ПОКАЗАТЕЛ / ПРИЛЕЖАЩ DICTIONARY ЗАМЯНА';

$translation['Execute this HTTP connection while in edit mode?']['english']='Execute this HTTP connection while in edit mode?';
$translation['Execute this HTTP connection while in edit mode?']['german']='Führen Sie diesen HTTP-Verbindung im Bearbeitungsmodus?';
$translation['Execute this HTTP connection while in edit mode?']['chinesesimplified']='执行此HTTP连接，同时在编辑模式？';
$translation['Execute this HTTP connection while in edit mode?']['bulgarian']='Изпълнете тази HTTP връзка, докато в режим на редактиране?';

$translation['True']['english']='True';
$translation['True']['german']='Wahre';
$translation['True']['chinesesimplified']='真';
$translation['True']['bulgarian']='вярно';

$translation['False']['english']='False';
$translation['False']['german']='Falsch';
$translation['False']['chinesesimplified']='假';
$translation['False']['bulgarian']='фалшив';

$translation['Add a new database action for table']['english']='Add a new database action for table';
$translation['Add a new database action for table']['german']='Fügen Sie eine neue Datenbank Aktion für Tisch';
$translation['Add a new database action for table']['chinesesimplified']='添加一个新的数据库表行动';
$translation['Add a new database action for table']['bulgarian']='Добави ново действие базата данни за масата';

$translation['Add Database action']['english']='Add Database action';
$translation['Add Database action']['german']='In Database Aktion';
$translation['Add Database action']['chinesesimplified']='添加数据库行动';
$translation['Add Database action']['bulgarian']='Добави действие Database';

$translation['Execute this Database connection while in edit mode?']['english']='Execute this Database connection while in edit mode?';
$translation['Execute this Database connection while in edit mode?']['german']='Führen Sie diese Verbindung zur Datenbank im Bearbeitungsmodus?';
$translation['Execute this Database connection while in edit mode?']['chinesesimplified']='在编辑模式下，执行该数据库连接？';
$translation['Execute this Database connection while in edit mode?']['bulgarian']='Изпълнете тази база данни връзка, докато в режим на редактиране?';

$translation['Database Username']['english']='Database Username';
$translation['Database Username']['german']='Database Benutzername';
$translation['Database Username']['chinesesimplified']='数据库用户名';
$translation['Database Username']['bulgarian']='Database Потребителско име';

$translation['Database Password']['english']='Database Password';
$translation['Database Password']['german']='Database Password';
$translation['Database Password']['chinesesimplified']='数据库密码';
$translation['Database Password']['bulgarian']='Database Password';

$translation['Database Actions']['english']='Database Actions';
$translation['Database Actions']['german']='Database Aktionen';
$translation['Database Actions']['chinesesimplified']='数据库操作';
$translation['Database Actions']['bulgarian']='База данни Действия';

$translation['Database Action']['english']='Database Action';
$translation['Database Action']['german']='Database Aktion';
$translation['Database Action']['chinesesimplified']='数据库操作';
$translation['Database Action']['bulgarian']='Database действие';

$translation['TABLE']['english']='TABLE';
$translation['TABLE']['german']='TABELLE';
$translation['TABLE']['chinesesimplified']='表';
$translation['TABLE']['bulgarian']='TABLE';

$translation['Delete Action']['english']='Delete Action';
$translation['Delete Action']['german']='Aktion Löschen';
$translation['Delete Action']['chinesesimplified']='删除动作';
$translation['Delete Action']['bulgarian']='Изтриване на действие';

$translation['Delete Set']['english']='Delete Set';
$translation['Delete Set']['german']='Löschen Set';
$translation['Delete Set']['chinesesimplified']='删除设置';
$translation['Delete Set']['bulgarian']='Изтриване Комплект';

$translation['Add Set']['english']='Add Set';
$translation['Add Set']['german']='In Set';
$translation['Add Set']['chinesesimplified']='添加设置';
$translation['Add Set']['bulgarian']='Добави Определете';

$translation['AFTER REPLACEMENT']['english']='AFTER REPLACEMENT';
$translation['AFTER REPLACEMENT']['german']='NACH DEM AUSTAUSCH';
$translation['AFTER REPLACEMENT']['chinesesimplified']='更换后';
$translation['AFTER REPLACEMENT']['bulgarian']='СЛЕД СМЯНАТА';

$translation['Post data externally, do not print: HTTP connection']['english']='Post data externally, do not print: HTTP connection';
$translation['Post data externally, do not print: HTTP connection']['german']='外部数据发布，不打印：HTTP连接';
$translation['Post data externally, do not print: HTTP connection']['chinesesimplified']='Sende Daten extern, nicht gedruckt: HTTP-Verbindung';
$translation['Post data externally, do not print: HTTP connection']['bulgarian']='Публикувай данни във външен план, не се отпечатват: HTTP връзка';

$translation['Post data externally, do not print: Database connection']['english']='Post data externally, do not print: Database connection';
$translation['Post data externally, do not print: Database connection']['german']='Sende Daten extern, nicht gedruckt: Datenbank-Verbindung';
$translation['Post data externally, do not print: Database connection']['chinesesimplified']='外部数据发布，不打印：数据库连接';
$translation['Post data externally, do not print: Database connection']['bulgarian']='Публикувай данни във външен план, не се отпечатват: свързването към базата данни';

$translation['Post data externally, do not print: File storage connection']['english']='Post data externally, do not print: File storage connection';
$translation['Post data externally, do not print: File storage connection']['german']='Beitrag Daten extern, nicht gedruckt: Datei-Storage-Verbindung';
$translation['Post data externally, do not print: File storage connection']['chinesesimplified']='发表外部数据，不打印：文件存储连接';
$translation['Post data externally, do not print: File storage connection']['bulgarian']='Публикувайте данни във външен план, не се отпечатват: връзка съхраняване на файлове';

$translation['Post data externally, do not print: Message Queue connection']['english']='Post data externally, do not print: Message Queue connection';
$translation['Post data externally, do not print: Message Queue connection']['german']='Sende Daten extern, nicht gedruckt: Message Queue Verbindung';
$translation['Post data externally, do not print: Message Queue connection']['chinesesimplified']='外部数据发布，不打印：Message Queue连接';
$translation['Post data externally, do not print: Message Queue connection']['bulgarian']='Публикувай данни във външен план, не се отпечатват: връзка Queue съобщение';

$translation['Post data externally, do not print: Send E-Mail']['english']='Post data externally, do not print: Send E-Mail';
$translation['Post data externally, do not print: Send E-Mail']['german']='Sende Daten extern, nicht gedruckt: E-Mail senden';
$translation['Post data externally, do not print: Send E-Mail']['chinesesimplified']='外部数据发布，不打印：发送E-MAIL';
$translation['Post data externally, do not print: Send E-Mail']['bulgarian']='Публикувай данни във външен план, не се отпечатват: Изпрати E-Mail';

$translation['Server Address/URL']['english']='Server Address/URL';
$translation['Server Address/URL']['german']='Server Adresse/URL';
$translation['Server Address/URL']['chinesesimplified']='服务器地址/URL';
$translation['Server Address/URL']['bulgarian']='Сървър Адрес/URL';

$translation['Show only these parameters']['english']='Show only these parameters';
$translation['Show only these parameters']['german']='Nur diese Parameter';
$translation['Show only these parameters']['chinesesimplified']='只显示这些参数';
$translation['Show only these parameters']['bulgarian']='Покажи само тези параметри';

$translation['Database Version']['english']='Database Version';
$translation['Database Version']['german']='Database Version';
$translation['Database Version']['chinesesimplified']='数据库版本';
$translation['Database Version']['bulgarian']='Database Version';

$translation['Software Version']['english']='Software Version';
$translation['Software Version']['german']='Software Version';
$translation['Software Version']['chinesesimplified']='软件版本';
$translation['Software Version']['bulgarian']='Software Version';

$translation['downgrade attempt']['english']='Your database schema is more recent than the source code.  You may have overwrote the HIS core files with an older version of the software in an attempt to downgrade to an earlier version of HIS.  HIS does not support downgrading at this time.  <br/><br/> Overwrite your HIS core files with a more recent version of this HIS software, perhaps by using FTP.  <a href="https://humanintelligencesystem.com/forum/">Contact support for assistance.</a>';
$translation['downgrade attempt']['german']='Ihre Datenbank-Schema ist jüngeren Datums als der Quellcode. Möglicherweise haben Sie überschrieb die HIS Core-Dateien mit einer älteren Version der Software in einem Versuch, ein Downgrade auf eine frühere Version von HIS. HIS unterstützt keine Herabstufung zu diesem Zeitpunkt. <br/><br/> überschreiben Ihre HIS Core-Dateien mit einer neueren Version dieser HIS-Software, vielleicht mithilfe von FTP. <a href="https://humanintelligencesystem.com/forum/">Kontakt für Unterstützung.</a>';
$translation['downgrade attempt']['chinesesimplified']='你的数据库架构是比源代码更近。您可能已经覆盖了他的核心文件的旧版本的软件降级到他的早期版本的企图。他不支持在这个时候降级。您好：<br/><br/>覆盖他的核心文件，这是他的软件的较新版本，也许通过FTP。 <a href="https://humanintelligencesystem.com/forum/">联系的支持协助。</a>';
$translation['downgrade attempt']['bulgarian']='Вашата схема на база данни е по-нова от изходния код. Може да сте презаписано на основната си файлове с по-стара версия на софтуера, в опит да се върнете към по-стара версия на HIS. HIS не поддържа понижаване в този момент. <br/><br/>Презапише основната си файлове с по-нова версия на този софтуер, HIS, може би с помощта на FTP. <a href="https://humanintelligencesystem.com/forum/">Свържи подкрепа за помощ.</a>';

$translation['Database is using a future schema version']['english']='Database is using a future schema version<br/><br/>Extract the contents of the latest <a href="https://humanintelligencesystem.com/download/" target="_new">his.zip</a> over top of your existing files to fix.';
$translation['Database is using a future schema version']['german']='Die Datenbank ist mit einer Zukunft Schemaversion<br/><br/>Extrahieren Sie den Inhalt der neuesten <a href="https://humanintelligencesystem.com/download/" target="_new">his.zip</a> über Oberseite Ihres vorhandenen Dateien zu beheben.';
$translation['Database is using a future schema version']['chinesesimplified']='数据库使用的是一个未来的架构版本<br/><br/>提取内容的最新<a href="https://humanintelligencesystem.com/download/" target="_new">his.zip</a>上方现有的文件来修复。';
$translation['Database is using a future schema version']['bulgarian']='Database използва бъдеща версия схема<br/><br/>Разархивирайте съдържанието на последната <a href="https://humanintelligencesystem.com/download/" target="_new">his.zip</a> над горната част на съществуващи файлове да се определи.';

$translation['Click here to use your new & improved HIS Web Interface']['english']='Click here to use your new & improved HIS Web Interface';
$translation['Click here to use your new & improved HIS Web Interface']['german']='Klicken Sie hier, um Ihre neue & verbesserte seine Webinterface';
$translation['Click here to use your new & improved HIS Web Interface']['chinesesimplified']='点击这里使用您的新的和改进了他的Web界面';
$translation['Click here to use your new & improved HIS Web Interface']['bulgarian']='Кликнете тук, за да използвате вашия нов и подобрен HIS Web Interface';

$translation['Updates Successful']['english']='Updates Successful';
$translation['Updates Successful']['german']='Erfolgreiche Updates';
$translation['Updates Successful']['chinesesimplified']='更新成功';
$translation['Updates Successful']['bulgarian']='Updates Успешните';

$translation['Click Submit to execute the next update.']['english']='Click Submit to execute the next update.';
$translation['Click Submit to execute the next update.']['german']='Klicken Sie auf Senden, um das nächste Update auszuführen.';
$translation['Click Submit to execute the next update.']['chinesesimplified']='点击提交执行下一次更新。';
$translation['Click Submit to execute the next update.']['bulgarian']='Кликнете върху Изпращане за изпълнение на следващата актуализация.';

$translation['Click Submit to execute the update.']['english']='Click Submit to execute the update.';
$translation['Click Submit to execute the update.']['german']='Klicken Sie auf Senden, um das Update auszuführen.';
$translation['Click Submit to execute the update.']['chinesesimplified']='点击提交执行更新。';
$translation['Click Submit to execute the update.']['bulgarian']='Кликнете върху Изпращане за изпълнение на актуализация.';

$translation['successful']['english']='successful';
$translation['successful']['german']='erfolgreich';
$translation['successful']['chinesesimplified']='成功';
$translation['successful']['bulgarian']='успешно';

$translation['to']['english']='to';
$translation['to']['german']='zu';
$translation['to']['chinesesimplified']='至';
$translation['to']['bulgarian']='към';

$translation['Database update']['english']='Database update';
$translation['Database update']['german']='Datenbank-Update';
$translation['Database update']['chinesesimplified']='数据库更新';
$translation['Database update']['bulgarian']='актуализация на базата данни';

$translation['Update from version']['english']='Update from version';
$translation['Update from version']['german']='Update von Version';
$translation['Update from version']['chinesesimplified']='从版本更新';
$translation['Update from version']['bulgarian']='Актуализиране от версия';

$translation['Update Notes for version']['english']='Update Notes for version';
$translation['Update Notes for version']['german']='Update Notes für Version';
$translation['Update Notes for version']['chinesesimplified']='更新版本的注意事项';
$translation['Update Notes for version']['bulgarian']='Обновете Бележки за версията';

$translation['to version']['english']='to version';
$translation['to version']['german']='auf Version';
$translation['to version']['chinesesimplified']='版本';
$translation['to version']['bulgarian']='до версия';

$translation['Installation']['english']='Installation';
$translation['Installation']['german']='Montage';
$translation['Installation']['chinesesimplified']='安装';
$translation['Installation']['bulgarian']='Монтаж';

$translation['job server update reminder']['english']='Make sure to log into your Job Server compute nodes and double-click the <b>update-win-his-server.vbs</b> script (if Windows) or launch <b>./update-linux-his-server.sh</b> (if other).  They will download the latest HIS software available.';
$translation['job server update reminder']['german']='Achten Sie darauf, in Ihrem Job Server einloggen Rechenknoten und doppelklicken Sie auf die <b>update-win-his-server.vbs</b> Skript (falls Windows) oder Start <b>./update-linux-his-server.sh</b> (falls abweichend). Sie werden die neueste HIS-Software zur Verfügung.';
$translation['job server update reminder']['chinesesimplified']='确保作业服务器登录到计算节点，然后双击的<b>update-win-his-server.vbs</b>脚本（如果Windows）或推出<b>./update-linux-his-server.sh</b>（其他）。他们将下载最新的HIS软件。';
$translation['job server update reminder']['bulgarian']='Уверете се, че да влезете във вашия Job Сървър изчисли възли и кликнете два пъти върху <b>update-win-his-server.vbs</b> скрипт (ако Windows) или стартирането <b>./update-linux-his-server.sh</b> (ако е различен). Те ще изтегли последния HIS софтуер.';

$translation['Not available in demo']['english']='Not available in demo';
$translation['Not available in demo']['german']='Nicht verfügbar in Demo';
$translation['Not available in demo']['chinesesimplified']='不适用于演示';
$translation['Not available in demo']['bulgarian']='Не се предлага в демо';

$translation['HF XML File Format Version']['english']='HF XML File Format Version';
$translation['HF XML File Format Version']['german']='HF XML File Format Version';
$translation['HF XML File Format Version']['chinesesimplified']='HF XML 文件格式版本';
$translation['HF XML File Format Version']['bulgarian']='HF XML Версия File Format';

$translation['Change function name']['english']='Change function name';
$translation['Change function name']['german']='Ändern Funktionsnamen';
$translation['Change function name']['chinesesimplified']='更改函数名';
$translation['Change function name']['bulgarian']='Промяна на име на функция';

$translation['Import']['english']='Import';
$translation['Import']['german']='Importieren';
$translation['Import']['chinesesimplified']='进口';
$translation['Import']['bulgarian']='Внос';

$translation['Inherits From']['english']='Inherits From';
$translation['Inherits From']['german']='Erbt von';
$translation['Inherits From']['chinesesimplified']='继承自';
$translation['Inherits From']['bulgarian']='Наследява';

$translation['Import Behavior']['english']='Import Behavior';
$translation['Import Behavior']['german']='Import Behavior';
$translation['Import Behavior']['chinesesimplified']='进口行为';
$translation['Import Behavior']['bulgarian']='Внос Behavior';

$translation['from library']['english']='from library';
$translation['from library']['german']='aus der Bibliothek';
$translation['from library']['chinesesimplified']='从库';
$translation['from library']['bulgarian']='от библиотеката';

$translation['from import']['english']='from import';
$translation['from import']['german']='import von';
$translation['from import']['chinesesimplified']='从进口';
$translation['from import']['bulgarian']='от внос';

$translation['Overwrite/replace existing function']['english']='Overwrite/replace existing function';
$translation['Overwrite/replace existing function']['german']='Überschreiben / ersetzen vorhandene Funktion';
$translation['Overwrite/replace existing function']['chinesesimplified']='覆盖/替换现有的功能';
$translation['Overwrite/replace existing function']['bulgarian']='Презаписване / замени съществуващата функция';

$translation['Skip importing this function']['english']='Skip importing this function';
$translation['Skip importing this function']['german']='Weiter Importieren dieser Funktion';
$translation['Skip importing this function']['chinesesimplified']='跳过导入此功能';
$translation['Skip importing this function']['bulgarian']='Напред вносител тази функция';

$translation['None']['english']='None';
$translation['None']['german']='Keine';
$translation['None']['chinesesimplified']='无';
$translation['None']['bulgarian']='никой';

$translation['No']['english']='No';
$translation['No']['german']='Nicht';
$translation['No']['chinesesimplified']='不';
$translation['No']['bulgarian']='Не';

$translation['Yes']['english']='Yes';
$translation['Yes']['german']='Ja';
$translation['Yes']['chinesesimplified']='是';
$translation['Yes']['bulgarian']='да';

$translation['Update current library functions who inherit from this function,']['english']='Update current library functions who inherit from this function,';
$translation['Update current library functions who inherit from this function,']['german']='Aktualisieren Sie aktuelle Bibliothek Funktionen, die von dieser Funktion übernehmen,';
$translation['Update current library functions who inherit from this function,']['chinesesimplified']='更新当前库功能谁继承此功能，';
$translation['Update current library functions who inherit from this function,']['bulgarian']='Обновете текущи библиотечни функции, които наследяват от тази функция,';

$translation['to have their inheritances point to this newly imported function?']['english']='to have their inheritances point to this newly imported function?';
$translation['to have their inheritances point to this newly imported function?']['german']='ihre Erbschaften Punkt zu diesem neu eingeführten Funktion haben?';
$translation['to have their inheritances point to this newly imported function?']['chinesesimplified']='有自己的遗产点，这个新导入的功能';
$translation['to have their inheritances point to this newly imported function?']['bulgarian']='да имат наследствата точка за този наскоро внесени функция?';

$translation['(change function name)']['english']='(change function name)';
$translation['(change function name)']['german']='(Ändern Funktion name)';
$translation['(change function name)']['chinesesimplified']='（变化的函数名）';
$translation['(change function name)']['bulgarian']='(промяна на името функция)';

$translation['No functions are selected for import. Select an \'Import Behavior\' other than \'Skip importing this function\'']['english']='No functions are selected for import. Select an \'Import Behavior\' other than \'Skip importing this function\'';
$translation['No functions are selected for import. Select an \'Import Behavior\' other than \'Skip importing this function\'']['german']='Es sind keine Funktionen für den Import ausgewählt. Wählen Sie eine \'Import Verhalten\' außer \'Skip importieren diese Funktion\'';
$translation['No functions are selected for import. Select an \'Import Behavior\' other than \'Skip importing this function\'']['chinesesimplified']='选择要导入的无功能。选择“导入行为以外的”跳过导入此功能的';
$translation['No functions are selected for import. Select an \'Import Behavior\' other than \'Skip importing this function\'']['bulgarian']='Не функции са избрани за внос. Изберете друга дума за "внос Behavior", отколкото "Напред вносител тази функция"';

$translation['No database actions added yet.']['english']='No database actions added yet.';
$translation['No database actions added yet.']['german']='Keine Datenbank Aktionen hinzugefügt.';
$translation['No database actions added yet.']['chinesesimplified']='尚未添加任何数据库操作。';
$translation['No database actions added yet.']['bulgarian']='Не бази действия добавя още.';

$translation['Table name']['english']='Table name';
$translation['Table name']['german']='Name der Tabelle';
$translation['Table name']['chinesesimplified']='表名';
$translation['Table name']['bulgarian']='Таблица име';

$translation['Execute this File Storage connection while in edit mode?']['english']='Execute this File Storage connection while in edit mode?';
$translation['Execute this File Storage connection while in edit mode?']['german']='Führen Sie diese Datei Storage-Verbindung im Bearbeitungsmodus?';
$translation['Execute this File Storage connection while in edit mode?']['chinesesimplified']='在编辑模式下执行该文件存储连接？';
$translation['Execute this File Storage connection while in edit mode?']['bulgarian']='Изпълнете тази връзка съхраняване на файлове, докато в режим на редактиране?';

$translation['Content']['english']='Content';
$translation['Content']['german']='Inhalt';
$translation['Content']['chinesesimplified']='内容';
$translation['Content']['bulgarian']='Съдържание';

$translation['File path']['english']='File path';
$translation['File path']['german']='Datei-Pfad';
$translation['File path']['chinesesimplified']='文件路径';
$translation['File path']['bulgarian']='File пътя';

$translation['Action Type']['english']='Action Type';
$translation['Action Type']['german']='Action Typ';
$translation['Action Type']['chinesesimplified']='动作类型';
$translation['Action Type']['bulgarian']='Тип действие';

$translation['File Storage Action']['english']='File Storage Action';
$translation['File Storage Action']['german']='File Storage Aktion';
$translation['File Storage Action']['chinesesimplified']='文件存储操作';
$translation['File Storage Action']['bulgarian']='Действие съхранение на файлове';

$translation['Choices are REGION_US_STANDARD, REGION_US_E1, REGION_US_W1, REGION_US_W2, REGION_VIRGINIA, REGION_US_GOV1, REGION_US_GOV1_FIPS, REGION_APAC_NE1, REGION_APAC_SE1, REGION_APAC_SE2, REGION_EU_W1, REGION_SA_E1, REGION_SINGAPORE, REGION_SYDNEY, REGION_TOKYO, REGION_CALIFORNIA, REGION_IRELAND, REGION_OREGON, REGION_SAO_PAULO']['english']='';
$translation['Choices are REGION_US_STANDARD, REGION_US_E1, REGION_US_W1, REGION_US_W2, REGION_VIRGINIA, REGION_US_GOV1, REGION_US_GOV1_FIPS, REGION_APAC_NE1, REGION_APAC_SE1, REGION_APAC_SE2, REGION_EU_W1, REGION_SA_E1, REGION_SINGAPORE, REGION_SYDNEY, REGION_TOKYO, REGION_CALIFORNIA, REGION_IRELAND, REGION_OREGON, REGION_SAO_PAULO']['german']='Zur Auswahl stehen REGION_US_STANDARD, REGION_US_E1, REGION_US_W1, REGION_US_W2, REGION_VIRGINIA, REGION_US_GOV1, REGION_US_GOV1_FIPS, REGION_APAC_NE1, REGION_APAC_SE1, REGION_APAC_SE2, REGION_EU_W1, REGION_SA_E1, REGION_SINGAPORE, REGION_SYDNEY, REGION_TOKYO, REGION_CALIFORNIA, REGION_IRELAND, REGION_OREGON, REGION_SAO_PAULO';
$translation['Choices are REGION_US_STANDARD, REGION_US_E1, REGION_US_W1, REGION_US_W2, REGION_VIRGINIA, REGION_US_GOV1, REGION_US_GOV1_FIPS, REGION_APAC_NE1, REGION_APAC_SE1, REGION_APAC_SE2, REGION_EU_W1, REGION_SA_E1, REGION_SINGAPORE, REGION_SYDNEY, REGION_TOKYO, REGION_CALIFORNIA, REGION_IRELAND, REGION_OREGON, REGION_SAO_PAULO']['chinesesimplified']='选择 REGION_US_STANDARD, REGION_US_E1, REGION_US_W1, REGION_US_W2, REGION_VIRGINIA, REGION_US_GOV1, REGION_US_GOV1_FIPS, REGION_APAC_NE1, REGION_APAC_SE1, REGION_APAC_SE2, REGION_EU_W1, REGION_SA_E1, REGION_SINGAPORE, REGION_SYDNEY, REGION_TOKYO, REGION_CALIFORNIA, REGION_IRELAND, REGION_OREGON, REGION_SAO_PAULO';
$translation['Choices are REGION_US_STANDARD, REGION_US_E1, REGION_US_W1, REGION_US_W2, REGION_VIRGINIA, REGION_US_GOV1, REGION_US_GOV1_FIPS, REGION_APAC_NE1, REGION_APAC_SE1, REGION_APAC_SE2, REGION_EU_W1, REGION_SA_E1, REGION_SINGAPORE, REGION_SYDNEY, REGION_TOKYO, REGION_CALIFORNIA, REGION_IRELAND, REGION_OREGON, REGION_SAO_PAULO']['bulgarian']='Възможности за избор са REGION_US_STANDARD, REGION_US_E1, REGION_US_W1, REGION_US_W2, REGION_VIRGINIA, REGION_US_GOV1, REGION_US_GOV1_FIPS, REGION_APAC_NE1, REGION_APAC_SE1, REGION_APAC_SE2, REGION_EU_W1, REGION_SA_E1, REGION_SINGAPORE, REGION_SYDNEY, REGION_TOKYO, REGION_CALIFORNIA, REGION_IRELAND, REGION_OREGON, REGION_SAO_PAULO';

$translation['MIME Type']['english']='MIME Type';
$translation['MIME Type']['german']='MIME-Typ';
$translation['MIME Type']['chinesesimplified']='MIME类型';
$translation['MIME Type']['bulgarian']='MIME Type';

$translation['Raw response from File Storage Server']['english']='Raw response from File Storage Server';
$translation['Raw response from File Storage Server']['german']='Antwort von Raw File Storage Server';
$translation['Raw response from File Storage Server']['chinesesimplified']='原料响应文件存储服务器';
$translation['Raw response from File Storage Server']['bulgarian']='Raw отговор от файлов сървър за съхранение на багаж';

$translation['Resulting File Stored']['english']='Resulting File Stored';
$translation['Resulting File Stored']['german']='Resultierende Datei gespeicherte';
$translation['Resulting File Stored']['chinesesimplified']='生成的文件存储';
$translation['Resulting File Stored']['bulgarian']='В резултат съхранявана File';

$translation['Unable to connect to file store.']['english']='Unable to connect to file store.';
$translation['Unable to connect to file store.']['german']='Verbindung nicht möglich zu speichern einzureichen.';
$translation['Unable to connect to file store.']['chinesesimplified']='无法连接到文件存储。';
$translation['Unable to connect to file store.']['bulgarian']='Не може да се свърже с подаде магазин.';

$translation['Raw response from Database']['english']='Raw response from Database';
$translation['Raw response from Database']['german']='Raw Antwort von Database';
$translation['Raw response from Database']['chinesesimplified']='从数据库的原始响应';
$translation['Raw response from Database']['bulgarian']='Raw отговор от Database';

$translation['Oops! Unable to get news.  Unable to establish secure connection to news server.']['english']='Oops! Unable to get news.  Unable to establish secure connection to news server.';
$translation['Oops! Unable to get news.  Unable to establish secure connection to news server.']['german']='Oops! Kann Nachrichten zu erhalten. Kann sichere Verbindung zum News-Server aufzubauen.';
$translation['Oops! Unable to get news.  Unable to establish secure connection to news server.']['chinesesimplified']='糟糕！无法获得新闻。无法建立安全连接到新闻服务器。';
$translation['Oops! Unable to get news.  Unable to establish secure connection to news server.']['bulgarian']='Ами сега! Не може да получите новини. Не може да се установи защитена връзка към сървъра за новини.';

$translation['Click Here']['english']='Click Here';
$translation['Click Here']['german']='Klicken Sie hier';
$translation['Click Here']['chinesesimplified']='点击这里';
$translation['Click Here']['bulgarian']='Кликнете тук';

$translation['to begin the installation process.']['english']='to begin the installation process.';
$translation['to begin the installation process.']['german']='um die Installation zu starten.';
$translation['to begin the installation process.']['chinesesimplified']='开始安装过程。';
$translation['to begin the installation process.']['bulgarian']='за да започне процеса на инсталация.';

$translation['Fax Thru Email']['english']='Fax Thru Email';
$translation['Fax Thru Email']['german']='Fax Durch Email';
$translation['Fax Thru Email']['chinesesimplified']='Fax 通过 Email';
$translation['Fax Thru Email']['bulgarian']='Fax През Email';

$translation['iMacros Player License Key']['english']='iMacros Player License Key';
$translation['iMacros Player License Key']['german']='iMacros Player License Key';
$translation['iMacros Player License Key']['chinesesimplified']='iMacros Player 许可证密钥';
$translation['iMacros Player License Key']['bulgarian']='iMacros Player Лиценз ключ';

$translation['Online Fax Send/Receive']['english']='Online Fax Send/Receive';
$translation['Online Fax Send/Receive']['german']='Online Fax Senden / Empfangen';
$translation['Online Fax Send/Receive']['chinesesimplified']='在线传真发送/接收';
$translation['Online Fax Send/Receive']['bulgarian']='Online Fax изпращане / получаване';

$translation['Web-to-Post Service']['english']='Web-to-Post Service';
$translation['Web-to-Post Service']['german']='Web-to-Post Service';
$translation['Web-to-Post Service']['chinesesimplified']='网络邮政服务';
$translation['Web-to-Post Service']['bulgarian']='Web-да-Post Service';

$translation['Record & Play Macros']['english']='Record & Play Macros';
$translation['Record & Play Macros']['german']='Record & Play-Makros';
$translation['Record & Play Macros']['chinesesimplified']='记录和播放宏';
$translation['Record & Play Macros']['bulgarian']='Запис и възпроизвеждане на макроси';

$translation['Phone and SMS Service']['english']='Phone and SMS Service';
$translation['Phone and SMS Service']['german']='Telefon-und SMS-Service';
$translation['Phone and SMS Service']['chinesesimplified']='电话和短信服务';
$translation['Phone and SMS Service']['bulgarian']='Телефон и SMS услуга';

$translation['Read and Send E-Mail']['english']='Read and Send E-Mail';
$translation['Read and Send E-Mail']['german']='Lesen und Senden von E-Mail';
$translation['Read and Send E-Mail']['chinesesimplified']='阅读和发送电子邮件';
$translation['Read and Send E-Mail']['bulgarian']='Четене и изпращане на E-Mail';

$translation['Human Intelligence Tasks']['english']='Human Intelligence Tasks';
$translation['Human Intelligence Tasks']['german']='Human Intelligence Tasks';
$translation['Human Intelligence Tasks']['chinesesimplified']='人类智能任务';
$translation['Human Intelligence Tasks']['bulgarian']='Човека Задачи разузнаване';

$translation['Do things machines cannot']['english']='Do things machines cannot';
$translation['Do things machines cannot']['german']='Tun Sie Dinge Maschinen können nicht';
$translation['Do things machines cannot']['chinesesimplified']='做事机器不能';
$translation['Do things machines cannot']['bulgarian']='Правете неща, машини, които не могат да';

$translation['Simple E-Mail Service']['english']='Simple E-Mail Service';
$translation['Simple E-Mail Service']['german']='Einfach E-Mail-Dienst';
$translation['Simple E-Mail Service']['chinesesimplified']='简单电子邮件服务';
$translation['Simple E-Mail Service']['bulgarian']='Simple E-Mail Service';

$translation['Send E-Mail']['english']='Send E-Mail';
$translation['Send E-Mail']['german']='E-Mail Senden';
$translation['Send E-Mail']['chinesesimplified']='发送E-MAIL';
$translation['Send E-Mail']['bulgarian']='Изпрати E-Mail';

$translation['Send/Receive Phone/SMS']['english']='Send/Receive Phone/SMS';
$translation['Send/Receive Phone/SMS']['german']='Senden / Empfangen Telefon / SMS';
$translation['Send/Receive Phone/SMS']['chinesesimplified']='发送/接收电话/短信';
$translation['Send/Receive Phone/SMS']['bulgarian']='Изпращане / получаване Телефон / SMS';

$translation['GoDaddy Username']['english']='GoDaddy Username';
$translation['GoDaddy Username']['german']='GoDaddy Benutzername';
$translation['GoDaddy Username']['chinesesimplified']='GoDaddy 用户名';
$translation['GoDaddy Username']['bulgarian']='GoDaddy Потребителско име';

$translation['GoDaddy Password']['english']='GoDaddy Password';
$translation['GoDaddy Password']['german']='GoDaddy Passwort';
$translation['GoDaddy Password']['chinesesimplified']='GoDaddy 的密码 ';
$translation['GoDaddy Password']['bulgarian']='GoDaddy парола';

$translation['PostalMethods Username']['english']='PostalMethods Username';
$translation['PostalMethods Username']['german']='PostalMethods Benutzername';
$translation['PostalMethods Username']['chinesesimplified']='PostalMethods 用户名';
$translation['PostalMethods Username']['bulgarian']='PostalMethods Потребителско име';

$translation['PostalMethods Password']['english']='PostalMethods Password';
$translation['PostalMethods Password']['german']='PostalMethods Passwort';
$translation['PostalMethods Password']['chinesesimplified']='PostalMethods 的密码 ';
$translation['PostalMethods Password']['bulgarian']='PostalMethods парола';

$translation['Language Processing Analysis']['english']='Language Processing Analysis';
$translation['Language Processing Analysis']['german']='Language Processing Analyse';
$translation['Language Processing Analysis']['chinesesimplified']='语言处理分析';
$translation['Language Processing Analysis']['bulgarian']='Анализ езикова обработка';

$translation['Natural Language Processing']['english']='Natural Language Processing';
$translation['Natural Language Processing']['german']='Natural Language Processing';
$translation['Natural Language Processing']['chinesesimplified']='自然语言处理';
$translation['Natural Language Processing']['bulgarian']='Обработка на естествен език';

$translation['Send and Recieve Money']['english']='Send and Recieve Money';
$translation['Send and Recieve Money']['german']='Senden und erhalten Geld';
$translation['Send and Recieve Money']['chinesesimplified']='发送和免费获赠金钱';
$translation['Send and Recieve Money']['bulgarian']='Изпращане и Получихте пари';

$translation['Online Payment Processor']['english']='Online Payment Processor';
$translation['Online Payment Processor']['german']='Online Payment Processor';
$translation['Online Payment Processor']['chinesesimplified']='在线支付处理器';
$translation['Online Payment Processor']['bulgarian']='Онлайн плащане процесор';

$translation['Browser Automation']['english']='Browser Automation';
$translation['Browser Automation']['german']='Browser Automation';
$translation['Browser Automation']['chinesesimplified']='浏览器自动化';
$translation['Browser Automation']['bulgarian']='Browser Automation';

$translation['Send Snail Mail']['english']='Send Snail Mail';
$translation['Send Snail Mail']['german']='Senden Immobilien-Mail';
$translation['Send Snail Mail']['chinesesimplified']='实时发送邮件';
$translation['Send Snail Mail']['bulgarian']='Изпрати Real Mail';

$translation['Default "To" Phone # (your cell):']['english']='Default "To" Phone # (your cell):';
$translation['Default "To" Phone # (your cell):']['german']='Default "To" Phone # (Ihr Handy):';
$translation['Default "To" Phone # (your cell):']['chinesesimplified']='默认“，”电话号码（您的手机）：';
$translation['Default "To" Phone # (your cell):']['bulgarian']='Default "Да" Phone # (мобилния):';

$translation['press submit button no javascript']['english']='Press the "submit" button to continue to the next step (you do not hava JavaScript enabled and steps will not be automatically stepped through for you).';
$translation['press submit button no javascript']['german']='Drücken Sie die Schaltfläche "Senden", um mit dem nächsten Schritt (Sie müssen nicht hava JavaScript aktiviert und die Schritte werden nicht automatisch für Sie durch verstärkt werden) fortsetzen.';
$translation['press submit button no javascript']['chinesesimplified']='按“提交”按钮继续下一步（你不哈瓦启用JavaScript和步骤不会自动通过你加强）。';
$translation['press submit button no javascript']['bulgarian']='Натиснете бутона "Изпрати" за да продължите към следващата стъпка (не Hava JavaScript поддръжка и мерки няма да бъдат автоматично прекрачи за вас).';

$translation['Function Names']['english']='Function Names';
$translation['Function Names']['german']='Function Names';
$translation['Function Names']['chinesesimplified']='功能名称';
$translation['Function Names']['bulgarian']='Имената на функциите';

$translation['Recognized Job Server System Environment Kinds']['english']='Recognized Job Server System Environment Kinds';
$translation['Recognized Job Server System Environment Kinds']['german']='Anerkannt Job Server System Environment Kinds';
$translation['Recognized Job Server System Environment Kinds']['chinesesimplified']='认可工作服务器系统环境种的';
$translation['Recognized Job Server System Environment Kinds']['bulgarian']='Признати Работа сървър Видове среда на системата';

$translation['Create new function']['english']='Create new function';
$translation['Create new function']['german']='Erstellen Sie neue Funktion';
$translation['Create new function']['chinesesimplified']='创建新的功能';
$translation['Create new function']['bulgarian']='Създаване на нова функция';

$translation['PHP Code']['english']='PHP Code';
$translation['PHP Code']['german']='PHP Code';
$translation['PHP Code']['chinesesimplified']='PHP 代码';
$translation['PHP Code']['bulgarian']='PHP код';

$translation['Buffered Content added to Adjacent Dictionary Key [BUFFER]']['english']='Buffered Content added to Adjacent Dictionary Key [BUFFER]';
$translation['Buffered Content added to Adjacent Dictionary Key [BUFFER]']['german']='Buffered Inhalt hinzugefügt Adjacent Key Wörterbuch [BUFFER]';
$translation['Buffered Content added to Adjacent Dictionary Key [BUFFER]']['chinesesimplified']='邻词典主要缓冲的内容添加到[BUFFER]';
$translation['Buffered Content added to Adjacent Dictionary Key [BUFFER]']['bulgarian']='Буферен Content добавен в непосредствена близост Dictionary Key [BUFFER]';

$translation['encode &lt; HTML characters into applicable HTML characters (&amp;lt;)']['english']='encode &lt; HTML characters into applicable HTML characters (&amp;lt;)';
$translation['encode &lt; HTML characters into applicable HTML characters (&amp;lt;)']['german']='Kodieren &lt; HTML-Zeichen in HTML-Zeichen erhoben (&amp;lt;)';
$translation['encode &lt; HTML characters into applicable HTML characters (&amp;lt;)']['chinesesimplified']='&lt; HTML字符编码成适用的HTML字符（&amp;lt;)';
$translation['encode &lt; HTML characters into applicable HTML characters (&amp;lt;)']['bulgarian']='Кодират &lt; HTML символи в приложимите HTML символи (&amp;lt;)';

$translation['decode &amp;lt; characters into applicable HTML characters (&lt;)']['english']='decode &amp;lt; characters into applicable HTML characters (&lt;)';
$translation['decode &amp;lt; characters into applicable HTML characters (&lt;)']['german']='decodieren &amp;lt; Zeichen in HTML-Zeichen erhoben (&lt;)';
$translation['decode &amp;lt; characters into applicable HTML characters (&lt;)']['chinesesimplified']='解码&amp;lt;字符转换成适用的HTML字符（&lt;)';
$translation['decode &amp;lt; characters into applicable HTML characters (&lt;)']['bulgarian']='декодиране &amp;lt; герои в приложимите HTML символи (&lt;)';

$translation['Raw response from Output Target URL']['english']='Raw response from Output Target URL';
$translation['Raw response from Output Target URL']['german']='Raw Antwort von Output-Ziel-URL';
$translation['Raw response from Output Target URL']['chinesesimplified']='原料响应输出目标URL';
$translation['Raw response from Output Target URL']['bulgarian']='Raw отговор от URL Индикатор';

$translation['No Post variables added yet.']['english']='No Post variables added yet.';
$translation['No Post variables added yet.']['german']='Keine POST-Variablen hinzugefügt.';
$translation['No Post variables added yet.']['chinesesimplified']='没有发表变量。';
$translation['No Post variables added yet.']['bulgarian']='Не Публикувайте променливи добавя още.';

$translation['Output Expressions']['english']='Output Expressions';
$translation['Output Expressions']['german']='Output Expressions';
$translation['Output Expressions']['chinesesimplified']='输出表达式';
$translation['Output Expressions']['bulgarian']='Изходни изразяване';

$translation['Post data externally, do not print']['english']='Post data externally, do not print';
$translation['Post data externally, do not print']['german']='Sende Daten extern, nicht gedruckt';
$translation['Post data externally, do not print']['chinesesimplified']='外部数据发布，不打印';
$translation['Post data externally, do not print']['bulgarian']='Публикувай данни във външен план, не се отпечатват';

$translation['HTTP connection']['english']='HTTP connection';
$translation['HTTP connection']['german']='HTTP-Verbindung';
$translation['HTTP connection']['chinesesimplified']='HTTP连接';
$translation['HTTP connection']['bulgarian']='HTTP връзка';

$translation['Database connection']['english']='Database connection';
$translation['Database connection']['german']='Datenbankanbindung';
$translation['Database connection']['chinesesimplified']='数据库连接';
$translation['Database connection']['bulgarian']='Database връзка';

$translation['File storage connection']['english']='File storage connection';
$translation['File storage connection']['german']='Datei-Storage-Verbindung';
$translation['File storage connection']['chinesesimplified']='文件存储连接';
$translation['File storage connection']['bulgarian']='Връзка съхранение на файлове';

$translation['Message Queue connection']['english']='Message Queue connection';
$translation['Message Queue connection']['german']='Message Queue-Verbindung';
$translation['Message Queue connection']['chinesesimplified']='Message Queue连接';
$translation['Message Queue connection']['bulgarian']='Връзката ми Queue';

$translation['Send E-Mail']['english']='Send E-Mail';
$translation['Send E-Mail']['german']='E-Mail Senden';
$translation['Send E-Mail']['chinesesimplified']='发送E-MAIL';
$translation['Send E-Mail']['bulgarian']='Изпрати E-Mail';

$translation['time behavior fast']['english']='Time Behavior for this function is set to "fast response" - that means that the remotely gathered content displayed here will update only after the job finishes processing on the remote server.  Re-click on the Filtering Expression symbol (upside down "Y") in the top menu above, to refresh the page after the job has completed to see the real remote content displayed here.';
$translation['time behavior fast']['german']='Das bedeutet, dass die Ferne versammelt Inhalt angezeigt wird hier nur aktualisieren, nachdem der Job beendet die Verarbeitung auf dem Remote-Server - Zeit-Verhalten für diese Funktion ist die "schnelle Reaktion" eingestellt. Auf dem Filter Expression Symbol (upside down "Y") in der oberen Menüleiste oben Re-klicken, um die Seite zu aktualisieren, nachdem der Auftrag abgeschlossen hat, um die reale Remote-Inhalte angezeigt finden Sie hier.';
$translation['time behavior fast']['chinesesimplified']='此功能时行为设置为“快速反应” - 这意味着，远程收集的内容显示在这里将只更新作业完成后，在远程服务器上的处理。再点击过滤表情（倒挂“Y”）在顶部菜单上面，完成作业后，看到真正的远程内容显示在这里刷新页面。';
$translation['time behavior fast']['bulgarian']='Време Behavior за тази функция е зададена на "бърз отговор" - това означава, че дистанционно събраха показваното тук ще се актуализира само след работа завършва обработката на отдалечения сървър. Re-клик върху Филтриране Expression символ (с главата надолу "Y") в най-горното меню-горе, за да опресните страницата след работа е завършена трябва да видя истинското дистанционно показваното тук.';

$translation['output expression description']['english']='Output expressions are events that happen at the end of job processing, when a XML-mode(<a href="this_server_url/?q=qn&remote&xml" target="_new">this_server_url/?q=qn&remote&xml</a>) or CXML-mode(<a href="this_server_url/?q=qn&remote&cxml"  target="_new">this_server_url/?q=qn&remote&cxml</a>) job completes.  All raw data or texts processed by the <a href="?q=qn&v=filtering-expression">Recursive Filtering interface</a> is available inside of the Adjacent Dictionary key [RAW_OUTPUT].<br/><br/>

After clicking Regather Latest Cache, wait until the remote job finishes processing, then view this Output Expressions page again to see updated Adjacent Dictionary values.';
$translation['output expression description']['german']='Output Ausdrücke sind Ereignisse, die am Ende der Job-Verarbeitung geschehen, wenn ein XML-mode (<a href="this_server_url/?q=qn&remote&xml" target="_new">this_server_url/?q=qn&remote&xml</a>) oder CXML-mode (<a href="this_server_url/?q=qn&remote&cxml" target="_new">this_server_url/?q=qn&remote&cxml</a>) Auftrag abgeschlossen ist. Alle Rohdaten oder Texte des <a href="?q=qn&v=filtering-expression"> Rekursivfilterung Schnittstelle </a> ist in der benachbarten Wörterbuch Taste [raw_output] verarbeitet.<br/><br/>

Nach einem Klick regather Neueste Cache, warten, bis die Remote-Jobs beendet die Verarbeitung, dann sehen Sie diese Ausgabe Expressions Seite wieder aktualisiert Angrenzend Dictionary Werte anzuzeigen.';
$translation['output expression description']['chinesesimplified']='输出表达式是事件发生的作业处理结束时，当一个XML模式（<a href="this_server_url/?q=qn&remote&xml" target="_new">this_server_url/?q=qn&remote&xml</a>）的：CXML模式（<a href="this_server_url/?q=qn&remote&cxml" target="_new">this_server_url/?q=qn&remote&cxml</a>）工作完成。所有的原始数据或文字处理的<a href="?q=qn&v=filtering-expression">的递归滤波接口</a>是可用内部相邻词典键[RAW_OUTPUT].<br/><br/>

单击“固本培元”最新的高速缓存后，等待，直到远程作业处理完毕，然后查看输出表达式页面再次看到更新的相邻字典值。';
$translation['output expression description']['bulgarian']='Изходни изрази са събития, които се случват в края на работата обработка, когато XML-режим (<a href="this_server_url/?q=qn&remote&xml" target="_new">this_server_url/?q=qn&remote&xml</a>) или CXML-режим (<a href="this_server_url/?q=qn&remote&cxml" target="_new">this_server_url/?q=qn&remote&cxml</a>) работа завършва. Всички сурови данни или текстове, обработвани от <a href="?q=qn&v=filtering-expression"> Рекурсивно Филтриране интерфейс</a> е достъпно вътрешността на съседен клавиш Dictionary [RAW_OUTPUT].<br/><br/>

След като кликнете върху Regather Последна Cache, изчакайте, докато дистанционното работа завършва обработка, след това виждате тази Output изразяване страницата отново, за да видите Актуализация Съседни стойности речника.';

$translation['This Buffering action will prevent printing of preceeding sub-processings\' data outputs unless a "Print Value" OUTPUT entry is made below.']['english']='This Buffering action will prevent printing of preceeding sub-processings\' data outputs unless a "Print Value" OUTPUT entry is made below.';
$translation['This Buffering action will prevent printing of preceeding sub-processings\' data outputs unless a "Print Value" OUTPUT entry is made below.']['german']='Diese Aktion wird Buffering verhindern Druck vorausgeht sub-Verarbeitungen Daten Ausgänge sei denn, ein "Print Value" OUTPUT Eintrag unten gemacht wird.';
$translation['This Buffering action will prevent printing of preceeding sub-processings\' data outputs unless a "Print Value" OUTPUT entry is made below.']['chinesesimplified']='这种缓冲作用会阻止打印“打印价值”输出项子处理，数据输出之前，除非以下。';
$translation['This Buffering action will prevent printing of preceeding sub-processings\' data outputs unless a "Print Value" OUTPUT entry is made below.']['bulgarian']='Това действие на буфери ще попречи на отпечатването на предхождаща под-обработки на данни изходи, освен ако "Print Value" OUTPUT се извършва по-долу.';

$translation['Current Parameter Values']['english']='Current Parameter Values';
$translation['Current Parameter Values']['german']='Diese Parameter Werte';
$translation['Current Parameter Values']['chinesesimplified']='当前参数值';
$translation['Current Parameter Values']['bulgarian']='Текущите стойности на параметрите';

$translation['no hfs']['english']='There are no HIS Functions in the Function Library.<br/><br/>Add a function ';
$translation['no hfs']['german']='Es sind keine Funktionen in der HIS Function Library.<br/><br/>Fügen Sie eine Funktion ';
$translation['no hfs']['chinesesimplified']='有没有他的函数库中的功能。新增功能';
$translation['no hfs']['bulgarian']='Не са открити неговите функции във функцията Library.<br/><br/>Добавяне на функция ';

$translation['no sks']['english']='No system kinds have been defined.  You may need to reinstall HIS.';
$translation['no sks']['german']='Keine System Arten definiert wurden. Möglicherweise müssen Sie HIS neu installieren.';
$translation['no sks']['chinesesimplified']='没有系统种已经确定。您可能需要重新安装HIS。';
$translation['no sks']['bulgarian']='Нито една система видове са определени. Може да се наложи да преинсталирате HIS.';

$translation['No inheritable functions.']['english']='No inheritable functions.';
$translation['No inheritable functions.']['german']='Keine vererbbaren Funktionen.';
$translation['No inheritable functions.']['chinesesimplified']='没有可继承功能。';
$translation['No inheritable functions.']['bulgarian']='Не наследствени функции.';

$translation['db-trouble']['english']='If you are having trouble with your database, you should delete your <code>his-config.php</code> file from your web server folder and refresh this page to continue.<br/><br/>

No data will be lost when you delete the <code>his-config.php</code> file, you will just need to re-enter your database and file storage connection information.<br/><br/>

If you do not want to completely re-install HIS, make a copy of the salt1 and salt2 values found in your current <code>his-config.php</code> file.  You will have the opportunity to restore these old salts and re-create your <code>his-config.php</code> file.';
$translation['db-trouble']['german']='Wenn Sie Probleme mit Ihrer Datenbank sind, sollten Sie löschen <code> his-config.php </ code>-Datei von Ihrem Web-Server-Ordner und aktualisieren Sie diese Seite, um fortzufahren. <br/><br/>

Es werden keine Daten verloren, wenn Sie den <code> his-config.php </code>-Datei, die Sie gerade benötigen, um wieder in Ihre Datenbank und Dateiablage Verbindungsinformationen löschen.<br/><br/>

Wenn Sie nicht wollen, komplett neu installieren HIS, machen Sie eine Kopie der salt1 und Salz 2 Werte in Ihrem aktuellen <code> his-config.php </code>-Datei gefunden. Sie werden die Gelegenheit haben, diese alten Salze wiederherzustellen und neu zu erstellen <code> his-config.php </code>-Datei.';
$translation['db-trouble']['chinesesimplified']='如果您遇到问题与您的数据库，你应该删除您的<code>他的config.php</code>文件从你的Web服务器文件夹，并继续刷新此页面。新闻时<br/><br/>

没有任何数据都将丢失时，，删除在<code>他的config.php</code>文件，你将只需要重新输入您的数据库和文件存储的连接信息。<br/><br/>

如果你不想完全重新安装他，在你当前的<code>他的config.php</code>文件的salt1和salt2值的副本。您将有机会恢复这些老盐并重新创建你的<code>他的config.php</code>文件。';
$translation['db-trouble']['bulgarian']='Ако имате проблеми с вашата база данни, трябва да изтриете вашия <code> си-config.php </code> файл от папката на уеб сървъра и да обновите тази страница, за да продължите. <br/> <br/><br/><br/>

Няма данни ще бъдат загубени, когато изтриете <code> си-config.php </code> файл, просто ще трябва да въведете отново вашата база данни и информация, съхраняване на файлове връзка.<br/><br/>

Ако не искате да преинсталирате напълно HIS, направете копие на salt1 и salt2 стойности намерени в текущата <code> си-config.php </code> файл. Вие ще имате възможност да възстанови тези стари соли и пресъздадете <code> си-config.php </code> файл.';

$translation['Never mind - Take me back to the Login page']['english']='Never mind - Take me back to the Login page';
$translation['Never mind - Take me back to the Login page']['german']='Never mind - Nimm mich zurück auf die Login-Seite';
$translation['Never mind - Take me back to the Login page']['chinesesimplified']='没关系 - 我返回到登录页面';
$translation['Never mind - Take me back to the Login page']['bulgarian']='Никога не забравяйте - Вземи ме обратно към страницата за вход';

$translation['Okay, I will go delete my his-config.php file now, then I\'ll come back and press this button to reinstall!']['english']='Okay, I will go delete my his-config.php file now, then I\'ll come back and press this button to reinstall!';
$translation['Okay, I will go delete my his-config.php file now, then I\'ll come back and press this button to reinstall!']['german']='Okay, ich werde gehen, lösche ich die his-config.php jetzt, dann komme ich zurück und drücken Sie diese Taste, um neu zu installieren!';
$translation['Okay, I will go delete my his-config.php file now, then I\'ll come back and press this button to reinstall!']['chinesesimplified']='好吧，我会去现在删除我他的config.php文件，然后我会回来，然后按下这个按钮，重新安装！';
$translation['Okay, I will go delete my his-config.php file now, then I\'ll come back and press this button to reinstall!']['bulgarian']='Добре, аз ще отида изтрия му-config.php файл сега, след това ще се върна и натиснете този бутон, за да преинсталирате!';

$translation['Database table creation']['english']='Database table creation';
$translation['Database table creation']['german']='Database Tabellenerstellung';
$translation['Database table creation']['chinesesimplified']='创建数据库表';
$translation['Database table creation']['bulgarian']='Създаване на база данни таблица';

$translation['These steps will be done Automatically. Stepping through database table creation...']['english']='These steps will be done Automatically. Stepping through database table creation...';
$translation['These steps will be done Automatically. Stepping through database table creation...']['german']='Diese Schritte werden automatisch durchgeführt werden. Stepping durch Datenbank-Tabelle Schöpfung ...';
$translation['These steps will be done Automatically. Stepping through database table creation...']['chinesesimplified']='这些步骤将自动完成。步进通过创建数据库表...';
$translation['These steps will be done Automatically. Stepping through database table creation...']['bulgarian']='Тези стъпки ще се извършва автоматично. Засилване чрез създаване таблица от база данни ...';

$translation['Job Servers']['english']='Job Servers';
$translation['Job Servers']['german']='Job Server';
$translation['Job Servers']['chinesesimplified']='作业服务器';
$translation['Job Servers']['bulgarian']='работа Servers';

$translation['Job Server Platforms']['english']='Job Server Platforms';
$translation['Job Server Platforms']['german']='Job Server Platforms';
$translation['Job Server Platforms']['chinesesimplified']='招聘服务器平台';
$translation['Job Server Platforms']['bulgarian']='Платформи за работа сървър';

$translation['Services']['english']='Services';
$translation['Services']['german']='Dienstleistungen';
$translation['Services']['chinesesimplified']='服务';
$translation['Services']['bulgarian']='Услуги';

$translation['(This Web Interface)']['english']='(This Web Interface)';
$translation['(This Web Interface)']['german']='(Das Web-Interface)';
$translation['(This Web Interface)']['chinesesimplified']='(这个Web界面)';
$translation['(This Web Interface)']['bulgarian']='(Този Web Interface)';

$translation['Database']['english']='Database';
$translation['Database']['german']='Database';
$translation['Database']['chinesesimplified']='数据库';
$translation['Database']['bulgarian']='база данни';

$translation['Message Queue']['english']='Message Queue';
$translation['Message Queue']['german']='Message Queue';
$translation['Message Queue']['chinesesimplified']='消息队列';
$translation['Message Queue']['bulgarian']='Съобщение Queue';

$translation['New Jobs']['english']='New Jobs';
$translation['New Jobs']['german']='Neue Jobs';
$translation['New Jobs']['chinesesimplified']='新职位';
$translation['New Jobs']['bulgarian']='нови работни места';

$translation['No waiting jobs found.']['english']='No waiting jobs found.';
$translation['No waiting jobs found.']['german']='Keine Wartezeiten Arbeitsplätze gefunden.';
$translation['No waiting jobs found.']['chinesesimplified']='没有等待处理的作业。';
$translation['No waiting jobs found.']['bulgarian']='Не чакащи задания намерен.';

$translation['Unfinished Jobs']['english']='Unfinished Jobs';
$translation['Unfinished Jobs']['german']='Unfinished Jobs';
$translation['Unfinished Jobs']['chinesesimplified']='未完成的任务';
$translation['Unfinished Jobs']['bulgarian']='недовършени Работа';

$translation['No unfinished jobs found.']['english']='No unfinished jobs found.';
$translation['No unfinished jobs found.']['german']='Keine unvollendet Arbeitsplätze gefunden.';
$translation['No unfinished jobs found.']['chinesesimplified']='没有发现未完成的工作。';
$translation['No unfinished jobs found.']['bulgarian']='Не незавършени работни места открити.';

$translation['Job ID']['english']='Job ID';
$translation['Job ID']['german']='Job-ID';
$translation['Job ID']['chinesesimplified']='作业ID';
$translation['Job ID']['bulgarian']='Job ID';

$translation['Status']['english']='Status';
$translation['Status']['german']='Status';
$translation['Status']['chinesesimplified']='状态';
$translation['Status']['bulgarian']='Статус';

$translation['Date Created']['english']='Date Created';
$translation['Date Created']['german']='Erstellungsdatum';
$translation['Date Created']['chinesesimplified']='创建日期';
$translation['Date Created']['bulgarian']='Дата на Създаване';

$translation['Fast Response Job Submission Printout']['english']='Fast Response Job Submission Printout';
$translation['Fast Response Job Submission Printout']['german']='Fast Response Job Submission Ausdruck';
$translation['Fast Response Job Submission Printout']['chinesesimplified']='快速响应作业提交打印';
$translation['Fast Response Job Submission Printout']['bulgarian']='Fast Response Разпечатка за подаване на заявките';

$translation['fast response submission printout']['english']='A common way to submit a job is to call a function in CXML mode, with the "remote" flag turned on:
<br/><a href="this_server_url/?q=qn&cxml&remote" target="_new">this_server_url/?q=qn&cxml&remote</a><br/><br/>

When "Fast Response" mode is turned on, when Apache submits a job, it will not wait for the job to complete before responding with the following text:';
$translation['fast response submission printout']['german']='Ein üblicher Weg, um einen Job zu übergeben ist, um eine Funktion in CXML Modus aufrufen, mit der "Remote"-Flag eingeschaltet:
<br/><a href="this_server_url/?q=qn&cxml&remote" target="_new">this_server_url/?q=qn&cxml&remote</a><br/><br/>

Wenn "Fast Response"-Modus eingeschaltet wird, wenn Apache einen Job macht, wird es nicht für den Job zu warten, bevor reagiert mit dem folgenden Text zu vervollständigen:';
$translation['fast response submission printout']['chinesesimplified']='提交作业的一种常见方法是调用一个在CXML模式功能，打开“远程”标志：
<br/><a href="this_server_url/?q=qn&cxml&remote" target="_new">this_server_url/?q=qn&cxml&remote</a><br/><br/>

当“快速响应”的模式开启时，Apache时提交的作业，它不会等待作业完成后再响应与下面的文字：';
$translation['fast response submission printout']['bulgarian']='A-разпространеният начин за представяне на работата е да се обадя на функция в CXML режим, с "дистанционно" флаг включено:
<br/><a href="this_server_url/?q=qn&cxml&remote" target="_new">this_server_url/?q=qn&cxml&remote</a><br/><br/>

Когато "Fast Response" режим е включен, когато Apache представи работата, няма да чакам за работа, за да завърши, преди да отговори със следния текст:';

$translation['fast response submission printout2']['english']='You can collect the returned Job ID from your calling script, and repeatedly check the status by querying <a href="this_server_url/get.php?job=INSERT-JOB-ID-HERE&return=status" target="_new">this_server_url/get.php?job=INSERT-JOB-ID-HERE&return=status</a>.  When querying this Status-checking URL, you may be required to provide the UID and Secret credentials from your <a href="?q=qn&v=settings" target="_new">Settings</a> page.';
$translation['fast response submission printout2']['german']='Du darfst das zurückgebrachte Job-ID von Ihrem aufrufende Skript, und immer wieder den Status von Abfragen <a href="this_server_url/get.php?job=INSERT-JOB-ID-HERE&return=status" target="_new">this_server_url/get.php?job=INSERT-JOB-ID-HERE&return=status</a>. Bei der Abfrage dieser Status-Überprüfung URL kann es erforderlich, die UID und geheime Zugangsdaten von Ihrem <a href="?q=qn&v=settings" target="_new">Settings</a> Seite bereitzustellen.';
$translation['fast response submission printout2']['chinesesimplified']='你可以收集你调用脚本返回的作业ID，并多次检查状态查询<a href="this_server_url/get.php?job=INSERT-JOB-ID-HERE&return=status" target="_new">this_server_url/get.php?job=INSERT-JOB-ID-HERE&return=status</a>。查询状态检查URL时，您可能会被要求提供从您的<a href="?q=qn&v=settings" target="_new">Settings</a>页面的UID和秘密的凭据。';
$translation['fast response submission printout2']['bulgarian']='Можете да събирате върнатата Job ID от обажда скрипт, и многократно проверите състоянието чрез запитване <a href="this_server_url/get.php?job=INSERT-JOB-ID-HERE&return=status" target="_new">this_server_url/get.php?job=INSERT-JOB-ID-HERE&return=status</a>. Когато заявки тази Статус проверка URL, може да се изисква да предоставят на UID и Тайните <a href="?q=qn&v=settings" target="_new">Settings</a> от вашия сайт.';

$translation['Enter a new Fast Response below']['english']='Enter a new Fast Response below';
$translation['Enter a new Fast Response below']['german']='Geben Sie einen neuen Fast Response unten';
$translation['Enter a new Fast Response below']['chinesesimplified']='进入一个新的快速响应低于';
$translation['Enter a new Fast Response below']['bulgarian']='Въведете нов Fast Response долу';

$translation['Under construction']['english']='Under construction';
$translation['Under construction']['german']='Under construction';
$translation['Under construction']['chinesesimplified']='正在建设中';
$translation['Under construction']['bulgarian']='В процес на изграждане';

$translation['Looking to call this HIS Function via HTTP GET and provide customized inputs to this function?']['english']='Looking to call this HIS Function via HTTP GET and provide customized inputs to this function?';
$translation['Looking to call this HIS Function via HTTP GET and provide customized inputs to this function?']['german']='Mit Blick auf dieses seiner Funktion rufen via HTTP GET und bieten maßgeschneiderte Eingänge dieser Funktion?';
$translation['Looking to call this HIS Function via HTTP GET and provide customized inputs to this function?']['chinesesimplified']='希望这是他的功能调用，通过HTTP GET和提供定制化的投入这个函数吗？';
$translation['Looking to call this HIS Function via HTTP GET and provide customized inputs to this function?']['bulgarian']='Търся да наричаме това функцията му чрез HTTP GET и предоставят персонализирани входове за тази функция?';

$translation['Want to monitor job status or collect job outputs on your own?']['english']='Want to monitor job status or collect job outputs on your own?';
$translation['Want to monitor job status or collect job outputs on your own?']['german']='Möchten Sie Auftragsstatus überwachen oder Job Ausgänge auf eigene Faust?';
$translation['Want to monitor job status or collect job outputs on your own?']['chinesesimplified']='要监视工作状态或收集输出你自己的工作吗？';
$translation['Want to monitor job status or collect job outputs on your own?']['bulgarian']='Искате ли да се следи състоянието на задачата, или да събират работа изходи на собствения си?';

$translation['return job status']['english']='return job status';
$translation['return job status']['german']='zurück auftragsstatus';
$translation['return job status']['chinesesimplified']='返回工作状态';
$translation['return job status']['bulgarian']='върнете състоянието на задачата';

$translation['return job output']['english']='return job output';
$translation['return job output']['german']='zurück Jobausgabe';
$translation['return job output']['chinesesimplified']='返回作业输出';
$translation['return job output']['bulgarian']='върнете изход работа';

$translation['Use these Shortcut URLs to collect job data']['english']='Use these Shortcut URLs to collect job data';
$translation['Use these Shortcut URLs to collect job data']['german']='Verwenden Sie diese Tastenkombination, um URLs Job-Daten sammeln';
$translation['Use these Shortcut URLs to collect job data']['chinesesimplified']='使用这些快捷网址收集作业数据';
$translation['Use these Shortcut URLs to collect job data']['bulgarian']='Използвайте тези URL адреси Shortcut за събиране на данни работа';

$translation['version']['english']='version';
$translation['version']['german']='version';
$translation['version']['chinesesimplified']='版本';
$translation['version']['bulgarian']='версия';

$translation['Error establishing a message queue connection']['english']='Error establishing a message queue connection';
$translation['Error establishing a message queue connection']['german']='Fehler über eine Message-Queue-Verbindung';
$translation['Error establishing a message queue connection']['chinesesimplified']='建立一个消息队列连接错误';
$translation['Error establishing a message queue connection']['bulgarian']='Грешка при установяване на връзка опашката на съобщенията';

$translation['No Servers have been added to the cluster yet.']['english']='No Servers have been added to the cluster yet.';
$translation['No Servers have been added to the cluster yet.']['german']='Keine Server wurden dem Cluster wurde bisher noch.';
$translation['No Servers have been added to the cluster yet.']['chinesesimplified']='没有服务器已被添加到集群。';
$translation['No Servers have been added to the cluster yet.']['bulgarian']='Не Servers са били добавени към клъстера, все още.';

$translation['outdated']['english']='outdated';
$translation['outdated']['german']='überholt';
$translation['outdated']['chinesesimplified']='过时的';
$translation['outdated']['bulgarian']='остарял';

$translation['Error, unable to import HF XML file.']['english']='Error, unable to import HF XML file.';
$translation['Error, unable to import HF XML file.']['german']='Fehler, keine HF XML-Datei importieren.';
$translation['Error, unable to import HF XML file.']['chinesesimplified']='错误，无法导入HF XML文件。';
$translation['Error, unable to import HF XML file.']['bulgarian']='Грешка, не могат да внасят HF XML файл.';

$translation['URL']['english']='URL';
$translation['URL']['german']='URL';
$translation['URL']['chinesesimplified']='网址';
$translation['URL']['bulgarian']='URL';

$translation['Default Adjacent Dictionary Contents']['english']='Default Adjacent Dictionary Contents';
$translation['Default Adjacent Dictionary Contents']['german']='Standard Angrenzend Wörterbuch Inhaltsverzeichnis';
$translation['Default Adjacent Dictionary Contents']['chinesesimplified']='默认相邻词典内容';
$translation['Default Adjacent Dictionary Contents']['bulgarian']='По подразбиране Съседните Съдържание Речник';

$translation['Version']['english']='Version';
$translation['Version']['german']='Version';
$translation['Version']['chinesesimplified']='版本';
$translation['Version']['bulgarian']='Версия';

$translation['Extensions']['english']='Extensions';
$translation['Extensions']['german']='Extensions';
$translation['Extensions']['chinesesimplified']='扩展';
$translation['Extensions']['bulgarian']='Разширения';

$translation['function was imported.']['english']='function was imported.';
$translation['function was imported.']['german']='Funktion importiert wurde.';
$translation['function was imported.']['chinesesimplified']='进口功能。';
$translation['function was imported.']['bulgarian']='Функцията е бил внесен.';

$translation['Use']['english']='Use';
$translation['Use']['german']='Verwenden';
$translation['Use']['chinesesimplified']='使用';
$translation['Use']['bulgarian']='Употреба';

$translation['Suggested Local HIS Functions based on current parameters and dictionary values']['english']='Suggested Local HIS Functions based on current parameters and dictionary values';
$translation['Suggested Local HIS Functions based on current parameters and dictionary values']['german']='Empfohlene Lokale HIS Funktionen auf aktuellen Parametern und Werten basiert Wörterbuch';
$translation['Suggested Local HIS Functions based on current parameters and dictionary values']['chinesesimplified']='建议地方基于其职能电流参数和词典值';
$translation['Suggested Local HIS Functions based on current parameters and dictionary values']['bulgarian']='Предложените местни функциите си на базата на текущите параметри и речник ценности';

$translation['Date Modified']['english']='Date Modified';
$translation['Date Modified']['german']='Änderungsdatum';
$translation['Date Modified']['chinesesimplified']='修改日期';
$translation['Date Modified']['bulgarian']='Дата на Промяна';

$translation['Stream Wrappers']['english']='Stream Wrappers';
$translation['Stream Wrappers']['german']='Stream-Wrapper';
$translation['Stream Wrappers']['chinesesimplified']='流包装';
$translation['Stream Wrappers']['bulgarian']='Поток Опаковчици';

$translation['Local Software Version']['english']='Local Software Version';
$translation['Local Software Version']['german']='Lokale Software Version';
$translation['Local Software Version']['chinesesimplified']='本地软件版本';
$translation['Local Software Version']['bulgarian']='Локално Software Version';

$translation['Latest Software Version']['english']='Latest Software Version';
$translation['Latest Software Version']['german']='Neueste Software-Version';
$translation['Latest Software Version']['chinesesimplified']='最新的软件版本';
$translation['Latest Software Version']['bulgarian']='Последна Software Version';

$translation['Unable to create secure HTTPS connection.  Do you have the php_openssl extension enabled?']['english']='Unable to create secure HTTPS connection.  Do you have the php_openssl extension enabled?';
$translation['Unable to create secure HTTPS connection.  Do you have the php_openssl extension enabled?']['german']='Kann sichere HTTPS-Verbindung zu erstellen. Haben Sie die php_openssl Erweiterung aktiviert?';
$translation['Unable to create secure HTTPS connection.  Do you have the php_openssl extension enabled?']['chinesesimplified']='无法创建安全的HTTPS连接。不要启用的php_openssl扩展？';
$translation['Unable to create secure HTTPS connection.  Do you have the php_openssl extension enabled?']['bulgarian']='Не може да се създаде защитен HTTPS връзка. Имате ли разширяването php_openssl включен?';

$translation['Unable to connect to']['english']='Unable to connect to';
$translation['Unable to connect to']['german']='Keine Verbindung';
$translation['Unable to connect to']['chinesesimplified']='无法连接到';
$translation['Unable to connect to']['bulgarian']='Не може да се свърже с';

$translation['Available Software Versions']['english']='Available Software Versions';
$translation['Available Software Versions']['german']='Verfügbare Software-Versionen';
$translation['Available Software Versions']['chinesesimplified']='可用的软件版本';
$translation['Available Software Versions']['bulgarian']='Налични версии на софтуера';

$translation['For more information about available software versions, see']['english']='For more information about available software versions, see';
$translation['For more information about available software versions, see']['german']='Für weitere Informationen zu verfügbaren Software-Versionen finden Sie unter';
$translation['For more information about available software versions, see']['chinesesimplified']='有关可用的软件版本的更多信息，请参阅';
$translation['For more information about available software versions, see']['bulgarian']='За повече информация за наличните версии на софтуера, вижте';

$translation['Update Available']['english']='Update Available';
$translation['Update Available']['german']='Update Verfügbar';
$translation['Update Available']['chinesesimplified']='更新可用';
$translation['Update Available']['bulgarian']='Обновете Свободен';

$translation['Up-to-date']['english']='Up-to-date';
$translation['Up-to-date']['german']='Auf dem Neusten Stand';
$translation['Up-to-date']['chinesesimplified']='跟上时代的';
$translation['Up-to-date']['bulgarian']='В крак с Времето';

$translation['HIS Directory Path']['english']='HIS Directory Path';
$translation['HIS Directory Path']['german']='HIS Verzeichnispfad';
$translation['HIS Directory Path']['chinesesimplified']='HIS 目录路径';
$translation['HIS Directory Path']['bulgarian']='HIS Directory Path';

$translation['Server Address']['english']='Server Address';
$translation['Server Address']['german']='Server-Adresse';
$translation['Server Address']['chinesesimplified']='服务器地址';
$translation['Server Address']['bulgarian']='Адрес на сървъра';

$translation['Server Software']['english']='Server Software';
$translation['Server Software']['german']='Server Software';
$translation['Server Software']['chinesesimplified']='服务器软件';
$translation['Server Software']['bulgarian']='сървърния софтуер';

$translation['Update Now']['english']='Update Now';
$translation['Update Now']['german']='Jetzt Aktualisieren';
$translation['Update Now']['chinesesimplified']='现在更新';
$translation['Update Now']['bulgarian']='Обновяване Сега';

$translation['Successfully installed']['english']='Successfully installed';
$translation['Successfully installed']['german']='Erfolgreich installiert';
$translation['Successfully installed']['chinesesimplified']='成功安装';
$translation['Successfully installed']['bulgarian']='Инсталиран успешно';

$translation['update package']['english']='update package';
$translation['update package']['german']='Update-Paket';
$translation['update package']['chinesesimplified']='更新包';
$translation['update package']['bulgarian']='пакет за актуализиране';

$translation['Update package was downloaded, extracted, and installed successfully.']['english']='Update package was downloaded, extracted, and installed successfully.';
$translation['Update package was downloaded, extracted, and installed successfully.']['german']='Update-Paket heruntergeladen wurde, extrahiert und erfolgreich installiert.';
$translation['Update package was downloaded, extracted, and installed successfully.']['chinesesimplified']='下载更新包，提取，并安装成功。';
$translation['Update package was downloaded, extracted, and installed successfully.']['bulgarian']='Актуализация пакет е свален, извлечени, и инсталиран успешно.';

$translation['Error while installing']['english']='Error while installing';
$translation['Error while installing']['german']='Fehler während der Installation';
$translation['Error while installing']['chinesesimplified']='安装时发生错误';
$translation['Error while installing']['bulgarian']='Грешка при инсталиране';

$translation['Might be a permissions problem.']['english']='Might be a permissions problem.';
$translation['Might be a permissions problem.']['german']='Könnte eine Berechtigungen Problem sein.';
$translation['Might be a permissions problem.']['chinesesimplified']='可能是一个权限问题。';
$translation['Might be a permissions problem.']['bulgarian']='Може да е разрешения проблем.';

$translation['Unable to move extracted file from']['english']='Unable to move extracted file from';
$translation['Unable to move extracted file from']['german']='Kann extrahierte Datei aus bewegen';
$translation['Unable to move extracted file from']['chinesesimplified']='提取的文件无法移动';
$translation['Unable to move extracted file from']['bulgarian']='Не може да се движи екстрахира файл от';

$translation['php_zip extension is not enabled.  Enable php_zip extension to proceed with version update.']['english']='php_zip extension is not enabled.  Enable php_zip extension to proceed with version update.';
$translation['php_zip extension is not enabled.  Enable php_zip extension to proceed with version update.']['german']='php_zip Erweiterung ist nicht aktiviert. Aktivieren php_zip Erweiterung mit Versions-Update fortzufahren.';
$translation['php_zip extension is not enabled.  Enable php_zip extension to proceed with version update.']['chinesesimplified']='未启用php_zip扩展。启用扩展php_zip进行版本的更新。';
$translation['php_zip extension is not enabled.  Enable php_zip extension to proceed with version update.']['bulgarian']='php_zip разширение не е активиран. Дават възможност за разширяване php_zip да се пристъпи към актуализация версия.';

$translation['Permissions may need to be adjusted to allow Apache to create a new file at']['english']='Permissions may need to be adjusted to allow Apache to create a new file at';
$translation['Permissions may need to be adjusted to allow Apache to create a new file at']['german']='Berechtigungen müssen unter Umständen angepasst, damit Apache eine neue Datei erstellen zu werden';
$translation['Permissions may need to be adjusted to allow Apache to create a new file at']['chinesesimplified']='权限可能需要进行调整，以让Apache创建一个新文件在';
$translation['Permissions may need to be adjusted to allow Apache to create a new file at']['bulgarian']='Разрешения могат да бъдат коригирани, за да Apache за създаване на нов файл';

$translation['Unable to create file']['english']='Unable to create file';
$translation['Unable to create file']['german']='Kann Datei erstellen';
$translation['Unable to create file']['chinesesimplified']='无法创建文件';
$translation['Unable to create file']['bulgarian']='Не може да създадете файл';

$translation['Failed to clean up tmp/ folder.  Possibly caused by permissions issue.']['english']='Failed to clean up tmp/ folder.  Possibly caused by permissions issue.';
$translation['Failed to clean up tmp/ folder.  Possibly caused by permissions issue.']['german']='Fehler zu bereinigen tmp/ ordner. Möglicherweise durch Berechtigungen Problem verursacht.';
$translation['Failed to clean up tmp/ folder.  Possibly caused by permissions issue.']['chinesesimplified']='无法清理tmp/文件夹中。可能引起的权限问题。';
$translation['Failed to clean up tmp/ folder.  Possibly caused by permissions issue.']['bulgarian']='Не може да се почисти tmp/ папка. Вероятно са свързани с разрешения въпрос.';

$translation['Apache user may be']['english']='Apache user may be';
$translation['Apache user may be']['german']='Apache Benutzer kann';
$translation['Apache user may be']['chinesesimplified']='Apache用户可能';
$translation['Apache user may be']['bulgarian']='Apache потребител може да бъде';

$translation['Unknown']['english']='Unknown';
$translation['Unknown']['german']='Unbekannt';
$translation['Unknown']['chinesesimplified']='未知';
$translation['Unknown']['bulgarian']='Неизвестен';

$translation['Permissions may need to be adjusted to allow Apache to create a new folder at']['english']='Permissions may need to be adjusted to allow Apache to create a new folder at';
$translation['Permissions may need to be adjusted to allow Apache to create a new folder at']['german']='Berechtigungen müssen unter Umständen angepasst, damit Apache um einen neuen Ordner zu erstellen';
$translation['Permissions may need to be adjusted to allow Apache to create a new folder at']['chinesesimplified']='可能需要进行调整，以让Apache创建一个新的文件夹权限';
$translation['Permissions may need to be adjusted to allow Apache to create a new folder at']['bulgarian']='Разрешения могат да бъдат коригирани, за да Apache за да създадете нова папка';

$translation['Unable to create folder']['english']='Unable to create folder';
$translation['Unable to create folder']['german']='Kann ordner erstellen';
$translation['Unable to create folder']['chinesesimplified']='无法创建文件夹';
$translation['Unable to create folder']['bulgarian']='Не може да се създаде папка';

$translation['Unable to connect to']['english']='Unable to connect to';
$translation['Unable to connect to']['german']='Keine Verbindung';
$translation['Unable to connect to']['chinesesimplified']='无法连接到';
$translation['Unable to connect to']['bulgarian']='Не може да се свърже с';

$translation['JavaScript must be enabled for cluster map to display properly.']['english']='JavaScript must be enabled for cluster map to display properly.';
$translation['JavaScript must be enabled for cluster map to display properly.']['german']='JavaScript muss für die Cluster-Karte korrekt angezeigt aktiviert sein.';
$translation['JavaScript must be enabled for cluster map to display properly.']['chinesesimplified']='必须启用JavaScript集群地图，以显示正确。';
$translation['JavaScript must be enabled for cluster map to display properly.']['bulgarian']='JavaScript трябва да бъде включен за карта клъстер да се показват правилно.';

$translation['Content in your run.bat']['english']='(Content in<br/>your run.bat)';
$translation['Content in your run.bat']['german']='(Inhalt in<br/>Ihrem run.bat)';
$translation['Content in your run.bat']['chinesesimplified']='(在你的内容 run.bat)';
$translation['Content in your run.bat']['bulgarian']='(Съдържание<br/>в run.bat)';

$translation['Use by Name']['english']='Use by Name';
$translation['Use by Name']['german']='Verwenden Sie nach Namen';
$translation['Use by Name']['chinesesimplified']='使用名称';
$translation['Use by Name']['bulgarian']='Използвайте по име';

$translation['Update ALL Servers to latest version?']['english']='Update ALL Servers to latest version?';
$translation['Update ALL Servers to latest version?']['german']='Aktualisieren Sie alle Server auf die neueste Version?';
$translation['Update ALL Servers to latest version?']['chinesesimplified']='所有服务器更新到最新版本？';
$translation['Update ALL Servers to latest version?']['bulgarian']='Обнови всички сървъри за най-новата версия?';

$translation['uses']['english']='uses';
$translation['uses']['german']='verwendet';
$translation['uses']['chinesesimplified']='使用';
$translation['uses']['bulgarian']='използва';

$translation['as an input']['english']='as an input';
$translation['as an input']['german']='als Eingang';
$translation['as an input']['chinesesimplified']='作为输入';
$translation['as an input']['bulgarian']='като вход';

$translation['Shortcut to Settings page']['english']='Shortcut to Settings page';
$translation['Shortcut to Settings page']['german']='Shortcut to Settings';
$translation['Shortcut to Settings page']['chinesesimplified']='设置页面的快捷方式';
$translation['Shortcut to Settings page']['bulgarian']='Къс към страницата Настройки';

$translation['Desktop']['english']='Desktop';
$translation['Desktop']['german']='Desktop';
$translation['Desktop']['chinesesimplified']='桌面';
$translation['Desktop']['bulgarian']='Desktop';

$translation['List of Server Instances']['english']='List of Server Instances';
$translation['List of Server Instances']['german']='Liste der Server-Instanzen';
$translation['List of Server Instances']['chinesesimplified']='服务器实例列表';
$translation['List of Server Instances']['bulgarian']='Списък на потребителските модели на сървъра';

$translation['encode ALL possible &lt; HTML characters into applicable HTML entities (&amp;lt;)']['english']='encode ALL possible &lt; HTML characters into applicable HTML entities (&amp;lt;)';
$translation['encode ALL possible &lt; HTML characters into applicable HTML entities (&amp;lt;)']['german']='kodieren ALLE möglichen &lt; HTML-Zeichen in HTML-Entities anwendbar (&amp;lt;)';
$translation['encode ALL possible &lt; HTML characters into applicable HTML entities (&amp;lt;)']['chinesesimplified']='所有可能的&lt;HTML字符编码成适用的HTML实体（&amp;lt;）';
$translation['encode ALL possible &lt; HTML characters into applicable HTML entities (&amp;lt;)']['bulgarian']='кодират всички възможни &lt;HTML символи в HTML, приложими лица (&amp;lt;)';

$translation['decode ALL possible &amp;lt; characters into applicable HTML characters (&lt;)']['english']='decode ALL possible &amp;lt; characters into applicable HTML characters (&lt;)';
$translation['decode ALL possible &amp;lt; characters into applicable HTML characters (&lt;)']['german']='decodieren ALLE möglichen &amp;lt; Zeichen in HTML-Zeichen erhoben (&lt;)';
$translation['decode ALL possible &amp;lt; characters into applicable HTML characters (&lt;)']['chinesesimplified']='解码所有可能&amp;lt;字符转换成适用的HTML字符（<）';
$translation['decode ALL possible &amp;lt; characters into applicable HTML characters (&lt;)']['bulgarian']='декодира всички възможни &amp;lt; знаци в приложимите HTML символи (&lt;)';

$translation['htmlspecialchars (UTF-8 encoded, XML+Quotes, &lt; converts to &amp;lt;)']['english']='htmlspecialchars (UTF-8 encoded, XML+Quotes, &lt; converts to &amp;lt;)';
$translation['htmlspecialchars (UTF-8 encoded, XML+Quotes, &lt; converts to &amp;lt;)']['german']='htmlspecialchars (UTF-8-kodierte, wandelt XML+Kurse, &lt; um &amp;lt;)';
$translation['htmlspecialchars (UTF-8 encoded, XML+Quotes, &lt; converts to &amp;lt;)']['chinesesimplified']='用htmlspecialchars（UTF-8编码，XML+行情，&lt;转换为&amp;lt;）';
$translation['htmlspecialchars (UTF-8 encoded, XML+Quotes, &lt; converts to &amp;lt;)']['bulgarian']='htmlspecialchars (UTF-8 кодиране, XML + Цитати, &lt; превръща в &amp;lt;)';

$translation['htmlspecialchars-decode (XML+Quotes, &amp;lt; converts to &lt;)']['english']='htmlspecialchars-decode (XML+Quotes, &amp;lt; converts to &lt;)';
$translation['htmlspecialchars-decode (XML+Quotes, &amp;lt; converts to &lt;)']['german']='htmlspecialchars-Dekodierung (XML + Kurse, &amp;lt; Konvertiten &lt;)';
$translation['htmlspecialchars-decode (XML+Quotes, &amp;lt; converts to &lt;)']['chinesesimplified']='用htmlspecialchars解码（XML+报价，&amp;lt;皈依&lt;)';
$translation['htmlspecialchars-decode (XML+Quotes, &amp;lt; converts to &lt;)']['bulgarian']='htmlspecialchars-декодиране (XML + Цитати, &amp;lt; преобразува в &lt;)';

$translation['Convert to upper case']['english']='Convert to upper case';
$translation['Convert to upper case']['german']='Umwandlung in Großbuchstaben';
$translation['Convert to upper case']['chinesesimplified']='转换为大写';
$translation['Convert to upper case']['bulgarian']='Конвертиране до горния случай';

$translation['Convert to lower case']['english']='Convert to lower case';
$translation['Convert to lower case']['german']='Konvertieren in Kleinbuchstaben';
$translation['Convert to lower case']['chinesesimplified']='转换为小写';
$translation['Convert to lower case']['bulgarian']='Конвертиране в малки букви';

$translation['Encode as base64']['english']='Encode as base64';
$translation['Encode as base64']['german']='Encode als base64';
$translation['Encode as base64']['chinesesimplified']='为base64编码';
$translation['Encode as base64']['bulgarian']='Възхвала като base64';

$translation['Decode base64']['english']='Decode base64';
$translation['Decode base64']['german']='Decode base64';
$translation['Decode base64']['chinesesimplified']='解码的base64';
$translation['Decode base64']['bulgarian']='декодиране base64';

$translation['Function Execution Retry']['english']='Function Execution Retry';
$translation['Function Execution Retry']['german']='Funktion Execution Wiederholen';
$translation['Function Execution Retry']['chinesesimplified']='函数执行重试';
$translation['Function Execution Retry']['bulgarian']='Изпълнение Function Retry';

$translation['If function execution fails or exceeds max execution time limit, how many times should execution be re-tried?']['english']='If function execution fails or exceeds max execution time limit, how many times should execution be re-tried?';
$translation['If function execution fails or exceeds max execution time limit, how many times should execution be re-tried?']['german']='Wenn Funktion Ausführung fehlschlägt oder überschreitet max maximalen Ausführungszeit, sollte, wie oft die Ausführung erneut versucht werden?';
$translation['If function execution fails or exceeds max execution time limit, how many times should execution be re-tried?']['chinesesimplified']='如果函数执行失败或超过最大执行时间限制，多少次执行重新尝试过吗？';
$translation['If function execution fails or exceeds max execution time limit, how many times should execution be re-tried?']['bulgarian']='Ако функцията за изпълнение не се осъществи или надвишава макс лимит на времето за изпълнение, колко пъти трябва да бъде изпълнението отново се опита?';

$translation['Enter a negative number to have the function execution retried until success (could cause function to retry forever).']['english']='Enter a negative number to have the function execution retried until success (could cause function to retry forever).';
$translation['Enter a negative number to have the function execution retried until success (could cause function to retry forever).']['german']='Enter a negative number to have the function execution retried until success (could cause function to retry forever).';
$translation['Enter a negative number to have the function execution retried until success (could cause function to retry forever).']['chinesesimplified']='函数执行成功试，直到输入负数（可能会导致功能永远重试）.';
$translation['Enter a negative number to have the function execution retried until success (could cause function to retry forever).']['bulgarian']='Въведете отрицателно число да имат функцията изпълнение повтаря до успех (може да причини функция да опитате отново завинаги).';

$translation['Number of Tries Attempted']['english']='Number of Tries Attempted';
$translation['Number of Tries Attempted']['german']='Anzahl Versuche Versuchter';
$translation['Number of Tries Attempted']['chinesesimplified']='尝试次数的尝试';
$translation['Number of Tries Attempted']['bulgarian']='Брой опитва направени';

$translation['Put Online']['english']='Put Online';
$translation['Put Online']['german']='Legen Online';
$translation['Put Online']['chinesesimplified']='放到网上';
$translation['Put Online']['bulgarian']='Сложете Online';

$translation['Put Offline']['english']='Put Offline';
$translation['Put Offline']['german']='Setzen Sie offline';
$translation['Put Offline']['chinesesimplified']='将离线';
$translation['Put Offline']['bulgarian']='Сложете Offline';

$translation['If']['english']='If';
$translation['If']['german']='Wenn';
$translation['If']['chinesesimplified']='如果';
$translation['If']['bulgarian']='Ако';

$translation['Mod is 0']['english']='Mod is 0';
$translation['Mod is 0']['german']='Mod 0 ist';
$translation['Mod is 0']['chinesesimplified']='Mod是0';
$translation['Mod is 0']['bulgarian']='Mod е 0';

$translation['Not']['english']='Not';
$translation['Not']['german']='Nicht';
$translation['Not']['chinesesimplified']='不';
$translation['Not']['bulgarian']='не';

$translation['cause function to fail with status']['english']='cause function to fail with status';
$translation['cause function to fail with status']['german']='verursachen funktion mit status scheitern';
$translation['cause function to fail with status']['chinesesimplified']='导致函数失败，状态';
$translation['cause function to fail with status']['bulgarian']='предизвика функция, за да се провали със статут';

$translation['If # of Matches/Occurrences']['english']='If # of Matches/Occurrences';
$translation['If # of Matches/Occurrences']['german']='Wenn # der Spiele/Vorkommen';
$translation['If # of Matches/Occurrences']['chinesesimplified']='如果＃赛/纪录';
$translation['If # of Matches/Occurrences']['bulgarian']='Ако за брой мачове/събития';

$translation['Mod by N = 0']['english']='Mod by N = 0';
$translation['Mod by N = 0']['german']='Mod by N = 0';
$translation['Mod by N = 0']['chinesesimplified']='MOD由 N = 0';
$translation['Mod by N = 0']['bulgarian']='Mod от';

$translation['Mod by N not 0']['english']='Mod by N not 0';
$translation['Mod by N not 0']['german']='Mod von N nicht 0';
$translation['Mod by N not 0']['chinesesimplified']='国防部由N不为0';
$translation['Mod by N not 0']['bulgarian']='Mod от N не 0';

$translation['If this function were run, it would fail because there are']['english']='If this function were run, it would fail because there are';
$translation['If this function were run, it would fail because there are']['german']='Wenn diese Funktion ausgeführt wurden, wäre es nicht, weil es';
$translation['If this function were run, it would fail because there are']['chinesesimplified']='如果这个函数被执行，它将会失败，因为有';
$translation['If this function were run, it would fail because there are']['bulgarian']='Ако тази функция се пропускат, че ще се провалят, защото има';

$translation['matches.']['english']='matches.';
$translation['matches.']['german']='spiele.';
$translation['matches.']['chinesesimplified']='匹配。';
$translation['matches.']['bulgarian']='съвпадения.';

$translation['pick new status']['english']='pick new status';
$translation['pick new status']['german']='pick neuen status';
$translation['pick new status']['chinesesimplified']='挑选新的状态';
$translation['pick new status']['bulgarian']='вземете нов статут';

$translation['Restart Server']['english']='Restart Server';
$translation['Restart Server']['german']='Server neu Starten';
$translation['Restart Server']['chinesesimplified']='重新启动服务器';
$translation['Restart Server']['bulgarian']='Рестартирайте Сървъра';

$translation['Restart ALL Servers']['english']='Restart ALL Servers';
$translation['Restart ALL Servers']['german']='Starten Sie alle Server';
$translation['Restart ALL Servers']['chinesesimplified']='重新启动所有服务器';
$translation['Restart ALL Servers']['bulgarian']='Рестартирайте всички сървъри';

$translation['OFFLINE']['english']='OFFLINE';
$translation['OFFLINE']['german']='OFFLINE';
$translation['OFFLINE']['chinesesimplified']='离线';
$translation['OFFLINE']['bulgarian']='OFFLINE';

$translation['Unable to submit remote jobs in demo mode.']['english']='Unable to submit remote jobs in demo mode.';
$translation['Unable to submit remote jobs in demo mode.']['german']='Kann Remote-Jobs im Demo-Modus vor.';
$translation['Unable to submit remote jobs in demo mode.']['chinesesimplified']='在演示模式下无法提交远程作业。';
$translation['Unable to submit remote jobs in demo mode.']['bulgarian']='Не може да се представи отдалечени работни места в демо режим.';

$translation['Unfinished Job Hierarchy']['english']='Unfinished Job Hierarchy';
$translation['Unfinished Job Hierarchy']['german']='Unfinished Job Hierarchie';
$translation['Unfinished Job Hierarchy']['chinesesimplified']='未完成作业层次';
$translation['Unfinished Job Hierarchy']['bulgarian']='Unfinished Йерархия Job';

$translation['Unable to open downloaded zip file.  Is extension php_zip enabled?']['english']='Unable to open downloaded zip file.  Is extension php_zip enabled?';
$translation['Unable to open downloaded zip file.  Is extension php_zip enabled?']['german']='Kann heruntergeladene ZIP-Datei zu öffnen. Ist Erweiterung php_zip aktiviert?';
$translation['Unable to open downloaded zip file.  Is extension php_zip enabled?']['chinesesimplified']='无法打开下载的zip文件。是启用扩展php_zip？';
$translation['Unable to open downloaded zip file.  Is extension php_zip enabled?']['bulgarian']='Не може да се отвори изтегления файл цип. Изразява разширение php_zip включен?';

$translation['If a function goes over above time limit, consider job as \'failed\' and do not try to parse collected remote content']['english']='If a function goes over above time limit, consider job as \'failed\' and do not try to parse collected remote content';
$translation['If a function goes over above time limit, consider job as \'failed\' and do not try to parse collected remote content']['german']='Wenn eine Funktion geht über vorgenannten Frist, betrachten Arbeit als "nicht bestanden" und versuchen Sie nicht, gesammelt Remote-Inhalte zu analysieren';
$translation['If a function goes over above time limit, consider job as \'failed\' and do not try to parse collected remote content']['chinesesimplified']='如果一个函数超过上述时间限制，可以考虑工作作为\'失败\'，不要试图去解析远程收集内容';
$translation['If a function goes over above time limit, consider job as \'failed\' and do not try to parse collected remote content']['bulgarian']='Ако една функция преминава по-горе срок, помисли за работа като "не е" и не се опитвай да се направи разбор събрани дистанционно съдържание';

$translation['functions were imported.']['english']='functions were imported.';
$translation['functions were imported.']['german']='funktionen importiert wurden.';
$translation['functions were imported.']['chinesesimplified']='进口功能。';
$translation['functions were imported.']['bulgarian']='функции са били внесени.';

$translation['view']['english']='view';
$translation['view']['german']='blick';
$translation['view']['chinesesimplified']='视图';
$translation['view']['bulgarian']='изглед';

$translation['Immutable/Unchangeable']['english']='Immutable/Unchangeable';
$translation['Immutable/Unchangeable']['german']='Unveränderliche';
$translation['Immutable/Unchangeable']['chinesesimplified']='一成不变/不变的';
$translation['Immutable/Unchangeable']['bulgarian']='Непоклатимото/Непроменяемите';

$translation['Mandatory/Required']['english']='Mandatory/Required';
$translation['Mandatory/Required']['german']='Obligatorisch/Pflicht';
$translation['Mandatory/Required']['chinesesimplified']='强制性/必需';
$translation['Mandatory/Required']['bulgarian']='Задължително/Задължителни';

$translation['Adjacent dictionary is empty.']['english']='Adjacent dictionary is empty.';
$translation['Adjacent dictionary is empty.']['german']='Angrenzend Wörterbuch ist leer.';
$translation['Adjacent dictionary is empty.']['chinesesimplified']='相邻的字典是空的。';
$translation['Adjacent dictionary is empty.']['bulgarian']='Непосредствено речник е празна.';

$translation['clear adjacent dictionary']['english']='clear adjacent dictionary';
$translation['clear adjacent dictionary']['german']='neben klaren wörterbuch';
$translation['clear adjacent dictionary']['chinesesimplified']='相邻明确词典';
$translation['clear adjacent dictionary']['bulgarian']='съседен ясно речник';

$translation['Adjacent dictionary has been cleared.']['english']='Adjacent dictionary has been cleared.';
$translation['Adjacent dictionary has been cleared.']['german']='Angrenzend Wörterbuch hat-wurde gelöscht.';
$translation['Adjacent dictionary has been cleared.']['chinesesimplified']='相邻的字典已经 - 被清除。';
$translation['Adjacent dictionary has been cleared.']['bulgarian']='Непосредствено речник е-е изчистен.';

$translation['When your function is executed (as a "job" on a remote server), this content will first be written into a text file created in a FRESH new folder created specifically for the job.']['english']='When your function is executed (as a "job" on a remote server), this content will first be written into a text file created in a FRESH new folder created specifically for the job.';
$translation['When your function is executed (as a "job" on a remote server), this content will first be written into a text file created in a FRESH new folder created specifically for the job.']['german']='Wenn Ihre Funktion ist (als ein "Job" auf einem Remote-Server) ausgeführt wird, wird dieser Inhalt zunächst in eine Text-Datei in einem neuen Ordner erstellt FRESH específicamente für den Job geschaffen geschrieben werden.';
$translation['When your function is executed (as a "job" on a remote server), this content will first be written into a text file created in a FRESH new folder created specifically for the job.']['chinesesimplified']='当你的函数执行（作为一个远程服务器上的“工作”），此内容将首先被写入在为作业创建新鲜específicamente一个新的文件夹中创建一个文本文件。';
$translation['When your function is executed (as a "job" on a remote server), this content will first be written into a text file created in a FRESH new folder created specifically for the job.']['bulgarian']='Когато си функция се изпълнява (като "работа" на отдалечен сървър), това съдържание първо ще бъдат написани в текстов файл, създаден в нова папка, създадена FRESH específicamente за тази работа.';

$translation['Inherit files, parameters, and logic from existing HIS Functions.']['english']='Inherit files, parameters, and logic from existing HIS Functions.';
$translation['Inherit files, parameters, and logic from existing HIS Functions.']['german']='Erben Dateien, Parameter und Logik aus vorhandenen HIS-Funktionen.';
$translation['Inherit files, parameters, and logic from existing HIS Functions.']['chinesesimplified']='从现有职务继承文件，参数和逻辑。';
$translation['Inherit files, parameters, and logic from existing HIS Functions.']['bulgarian']='Наследи файлове, параметри и логика от неговите съществуващи функции.';

$translation['Optional']['english']='Optional';
$translation['Optional']['german']='Fakultativ';
$translation['Optional']['chinesesimplified']='Незадължителен';
$translation['Optional']['bulgarian']='可选';

$translation['Upload Error']['english']='Upload Error';
$translation['Upload Error']['german']='Fehler Galerie';
$translation['Upload Error']['chinesesimplified']='上传错误';
$translation['Upload Error']['bulgarian']='Качване грешка';

$translation['Check your php.ini for the following entries']['english']='Check your php.ini for the following entries';
$translation['Check your php.ini for the following entries']['german']='Überprüfen Sie Ihre php.ini für die folgenden Einträge';
$translation['Check your php.ini for the following entries']['chinesesimplified']='检查你的php.ini以下条目';
$translation['Check your php.ini for the following entries']['bulgarian']='Проверете вашия php.ini за вписване на следните';

$translation['Hit the back button to continue']['english']='Hit the back button to continue';
$translation['Hit the back button to continue']['german']='Drücken Sie die Zurück-Taste, um fortzufahren';
$translation['Hit the back button to continue']['chinesesimplified']='点击后退按钮继续';
$translation['Hit the back button to continue']['bulgarian']='Хит на бутона за връщане назад, за да продължи';

$translation['Max File Upload Size']['english']='Max File Upload Size';
$translation['Max File Upload Size']['german']='Max Datei-Upload-Größe';
$translation['Max File Upload Size']['chinesesimplified']='最大文件上传大小';
$translation['Max File Upload Size']['bulgarian']='Максимална File Upload Size';

$translation['Describe everything in the outer area covered by']['english']='Describe everything in the outer area covered by';
$translation['Describe everything in the outer area covered by']['german']='Beschreiben Sie alles, was im äußeren Bereich abgedeckt durch';
$translation['Describe everything in the outer area covered by']['chinesesimplified']='在覆盖的区域外的一切描述';
$translation['Describe everything in the outer area covered by']['bulgarian']='Опишете всичко във външната зона, обхваната от';

$translation['this color']['english']='this color';
$translation['this color']['german']='diese farbe';
$translation['this color']['chinesesimplified']='这个颜色';
$translation['this color']['bulgarian']='този цвят';

$translation['- what does it take as input, and what does it give as output?']['english']='- what does it take as input, and what does it give as output?';
$translation['- what does it take as input, and what does it give as output?']['german']='- was bedeutet es als Eingabe, und was bedeutet es als Ausgabe geben?';
$translation['- what does it take as input, and what does it give as output?']['chinesesimplified']='- 这是什么作为输入，它有什么给作为输出？';
$translation['- what does it take as input, and what does it give as output?']['bulgarian']='- какво е необходимо като вход, и какво прави той даде като изход?';

$translation['keyword replacement pass']['english']='keyword replacement pass';
$translation['keyword replacement pass']['german']='stichwort ersatz pass';
$translation['keyword replacement pass']['chinesesimplified']='关键字补领通行证';
$translation['keyword replacement pass']['bulgarian']='дума замяна пас';

$translation['Reassign']['english']='Reassign';
$translation['Reassign']['german']='Neu zuweisen';
$translation['Reassign']['chinesesimplified']='重新分配';
$translation['Reassign']['bulgarian']='Преопредели';

$translation['Parameter Value Immutable (cannot be changed by GET parameter value provided at time of submission)?']['english']='Parameter Value Immutable (cannot be changed by GET parameter value provided at time of submission)?';
$translation['Parameter Value Immutable (cannot be changed by GET parameter value provided at time of submission)?']['german']='Parameter Wert Unveränderliche (kann nicht von GET Parameterwert zum Zeitpunkt der Vorlage vorgesehen geändert werden)?';
$translation['Parameter Value Immutable (cannot be changed by GET parameter value provided at time of submission)?']['chinesesimplified']='参数值不可变的（不能在提交时提供的GET参数值而改变）？';
$translation['Parameter Value Immutable (cannot be changed by GET parameter value provided at time of submission)?']['bulgarian']='Параметър Стойност Непоклатимото (не може да се променя чрез GET стойност параметър, предоставена в момента на подаване)?';

$translation['Should providing a value for this parameter during job submission be mandatory (required)?']['english']='Should providing a value for this parameter during job submission be mandatory (required)?';
$translation['Should providing a value for this parameter during job submission be mandatory (required)?']['german']='Sollten für die Bereitstellung eines für diesen Parameter während der Job-Einreichung obligatorisch (erforderlich)?';
$translation['Should providing a value for this parameter during job submission be mandatory (required)?']['chinesesimplified']='如果作业提交过程中此参数提供一个值是强制性的（要求）？';
$translation['Should providing a value for this parameter during job submission be mandatory (required)?']['bulgarian']='Трябва предоставяне на стойност за този параметър по време на подаване на работа да бъде задължително (задължително)?';

$translation['Flat hierarchy (all jobs are parent jobs), see job list above.']['english']='Flat hierarchy (all jobs are parent jobs), see job list above.';
$translation['Flat hierarchy (all jobs are parent jobs), see job list above.']['german']='Flache Hierarchie (alle Arbeitsplätze Mutter Jobs) finden Jobliste oben.';
$translation['Flat hierarchy (all jobs are parent jobs), see job list above.']['chinesesimplified']='平面层次结构（所有的工作都是父母的工作），见上面作业列表。';
$translation['Flat hierarchy (all jobs are parent jobs), see job list above.']['bulgarian']='Flat йерархия (всички работни места са майки работни места), вижте списъка на работни места по-горе.';

$translation['List of Current Input Resources/Files']['english']='List of Current Input Resources/Files';
$translation['List of Current Input Resources/Files']['german']='Liste der Stromeingang Ressourcen/Dateien';
$translation['List of Current Input Resources/Files']['chinesesimplified']='电流输入资源列表/文件';
$translation['List of Current Input Resources/Files']['bulgarian']='Списък на настоящия вход Resources/Files';

$translation['Edited Copy']['english']='Edited Copy';
$translation['Edited Copy']['german']='Bearbeitete Kopie';
$translation['Edited Copy']['chinesesimplified']='编辑副本';
$translation['Edited Copy']['bulgarian']='Променено Copy';

$translation['List of Current Parameters']['english']='List of Current Parameters';
$translation['List of Current Parameters']['german']='Liste der Aktuellen Parameter';
$translation['List of Current Parameters']['chinesesimplified']='当前参数列表';
$translation['List of Current Parameters']['bulgarian']='Списък на Текущи Параметри';

$translation['treat as integer']['english']='treat as integer';
$translation['treat as integer']['german']='behandeln, als ganze Zahl';
$translation['treat as integer']['chinesesimplified']='当作整数';
$translation['treat as integer']['bulgarian']='третира като цяло число';

$translation['treat as floating point number']['english']='treat as floating point number';
$translation['treat as floating point number']['german']='behandeln, als Gleitkommazahl';
$translation['treat as floating point number']['chinesesimplified']='当作浮点数';
$translation['treat as floating point number']['bulgarian']='третират като плаващ брой точка';

$translation['']['english']='';
$translation['']['german']='';
$translation['']['chinesesimplified']='';
$translation['']['bulgarian']='';

$translation['']['english']='';
$translation['']['german']='';
$translation['']['chinesesimplified']='';
$translation['']['bulgarian']='';

$translation['']['english']='';
$translation['']['german']='';
$translation['']['chinesesimplified']='';
$translation['']['bulgarian']='';





?>
