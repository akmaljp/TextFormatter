<?php

/**
* @package   s9e\TextFormatter
* @copyright Copyright (c) 2010-2016 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\TextFormatter\Bundles;

abstract class Forum extends \s9e\TextFormatter\Bundle
{
	/**
	* @var s9e\TextFormatter\Parser Singleton instance used by parse()
	*/
	protected static $parser;

	/**
	* @var s9e\TextFormatter\Renderer Singleton instance used by render()
	*/
	protected static $renderer;

	/**
	* Return a new instance of s9e\TextFormatter\Parser
	*
	* @return s9e\TextFormatter\Parser
	*/
	public static function getParser()
	{
		return unserialize('O:24:"s9e\\TextFormatter\\Parser":4:{s:16:"' . "\0" . '*' . "\0" . 'pluginsConfig";a:5:{s:9:"Autoemail";a:5:{s:8:"attrName";s:5:"email";s:10:"quickMatch";s:1:"@";s:6:"regexp";s:39:"/\\b[-a-z0-9_+.]+@[-a-z0-9.]*[a-z0-9]/Si";s:7:"tagName";s:5:"EMAIL";s:11:"regexpLimit";i:10000;}s:8:"Autolink";a:5:{s:8:"attrName";s:3:"url";s:6:"regexp";s:43:"#https?://\\S(?>[^\\s\\[\\]]*(?>\\[\\w*\\])?)++#iS";s:7:"tagName";s:3:"URL";s:10:"quickMatch";s:3:"://";s:11:"regexpLimit";i:10000;}s:7:"BBCodes";a:4:{s:7:"bbcodes";a:32:{s:1:"*";a:1:{s:7:"tagName";s:2:"LI";}s:1:"B";a:0:{}s:8:"BANDCAMP";a:2:{s:17:"contentAttributes";a:1:{i:0;s:3:"url";}s:16:"defaultAttribute";s:3:"url";}s:6:"CENTER";R:19;s:4:"CODE";a:1:{s:16:"defaultAttribute";s:4:"lang";}s:5:"COLOR";R:19;s:11:"DAILYMOTION";R:20;s:5:"EMAIL";a:1:{s:17:"contentAttributes";a:1:{i:0;s:5:"email";}}s:8:"FACEBOOK";R:20;s:4:"FONT";R:19;s:1:"I";R:19;s:3:"IMG";a:2:{s:17:"contentAttributes";a:1:{i:0;s:3:"src";}s:16:"defaultAttribute";s:3:"src";}s:9:"INDIEGOGO";R:20;s:9:"INSTAGRAM";R:20;s:11:"KICKSTARTER";R:20;s:2:"LI";R:19;s:4:"LIST";a:1:{s:16:"defaultAttribute";s:4:"type";}s:8:"LIVELEAK";R:20;s:5:"MEDIA";a:1:{s:17:"contentAttributes";R:21;}s:5:"QUOTE";a:1:{s:16:"defaultAttribute";s:6:"author";}s:1:"S";R:19;s:4:"SIZE";R:19;s:10:"SOUNDCLOUD";R:20;s:7:"SPOILER";a:1:{s:16:"defaultAttribute";s:5:"title";}s:6:"TWITCH";R:20;s:7:"TWITTER";R:20;s:1:"U";R:19;s:3:"URL";R:35;s:5:"VIMEO";R:20;s:4:"VINE";R:20;s:4:"WSHH";R:20;s:7:"YOUTUBE";R:20;}s:10:"quickMatch";s:1:"[";s:6:"regexp";s:30:"#\\[/?(\\*|[-\\w]+)(?=[\\]\\s=:/])#";s:11:"regexpLimit";i:10000;}s:9:"Emoticons";a:3:{s:6:"regexp";s:45:"/(?>:(?>[()?DPop|]|-[()*?DPp|]|lol:)|;-?\\))/S";s:7:"tagName";s:1:"E";s:11:"regexpLimit";i:10000;}s:10:"MediaEmbed";a:3:{s:10:"quickMatch";s:3:"://";s:6:"regexp";s:25:"/\\bhttps?:\\/\\/[^["\'\\s]+/S";s:11:"regexpLimit";i:10000;}}s:14:"registeredVars";a:2:{s:9:"urlConfig";a:1:{s:14:"allowedSchemes";s:12:"/^https?$/Di";}s:10:"mediasites";a:15:{s:12:"bandcamp.com";s:8:"bandcamp";s:15:"dailymotion.com";s:11:"dailymotion";s:12:"facebook.com";s:8:"facebook";s:13:"indiegogo.com";s:9:"indiegogo";s:13:"instagram.com";s:9:"instagram";s:15:"kickstarter.com";s:11:"kickstarter";s:12:"liveleak.com";s:8:"liveleak";s:14:"soundcloud.com";s:10:"soundcloud";s:9:"twitch.tv";s:6:"twitch";s:11:"twitter.com";s:7:"twitter";s:9:"vimeo.com";s:5:"vimeo";s:7:"vine.co";s:4:"vine";s:19:"worldstarhiphop.com";s:4:"wshh";s:11:"youtube.com";s:7:"youtube";s:8:"youtu.be";s:7:"youtube";}}s:14:"' . "\0" . '*' . "\0" . 'rootContext";a:2:{s:7:"allowed";a:1:{i:0;i:16183;}s:5:"flags";i:32;}s:13:"' . "\0" . '*' . "\0" . 'tagsConfig";a:32:{s:1:"B";a:6:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:42:"s9e\\TextFormatter\\Parser::filterAttributes";s:6:"params";a:4:{s:3:"tag";N;s:9:"tagConfig";N;s:14:"registeredVars";N;s:6:"logger";N;}}}s:12:"nestingLimit";i:10;s:5:"rules";a:1:{s:5:"flags";i:2;}s:8:"tagLimit";i:1000;s:9:"bitNumber";i:0;s:7:"allowed";a:1:{i:0;i:16165;}}s:8:"BANDCAMP";a:7:{s:10:"attributes";a:4:{s:8:"album_id";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:53:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp";s:6:"params";a:2:{s:9:"attrValue";N;i:0;s:8:"!^\\d+$!D";}}}s:8:"required";b:0;}s:8:"track_id";R:93;s:9:"track_num";R:93;s:3:"url";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:50:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterUrl";s:6:"params";a:3:{s:9:"attrValue";N;s:9:"urlConfig";N;s:6:"logger";N;}}}s:8:"required";b:0;}}s:11:"filterChain";a:3:{i:0;a:2:{s:8:"callback";s:51:"s9e\\TextFormatter\\Plugins\\MediaEmbed\\Parser::scrape";s:6:"params";a:3:{s:3:"tag";N;i:0;a:2:{i:0;a:3:{i:0;s:23:"!bandcamp\\.com/album/.!";i:1;s:25:"!/album=(?\'album_id\'\\d+)!";i:2;a:1:{i:0;s:8:"album_id";}}i:1;a:3:{i:0;s:23:"!bandcamp\\.com/track/.!";i:1;a:3:{i:0;s:29:"!"album_id":(?\'album_id\'\\d+)!";i:1;s:31:"!"track_num":(?\'track_num\'\\d+)!";i:2;s:25:"!/track=(?\'track_id\'\\d+)!";}i:2;a:3:{i:0;s:8:"album_id";i:1;s:8:"track_id";i:2;s:9:"track_num";}}}s:8:"cacheDir";N;}}i:1;R:77;i:2;a:2:{s:8:"callback";s:67:"s9e\\TextFormatter\\Plugins\\MediaEmbed\\Parser::hasNonDefaultAttribute";s:6:"params";a:1:{s:3:"tag";N;}}}s:12:"nestingLimit";i:10;s:5:"rules";a:2:{s:12:"fosterParent";a:9:{s:1:"B";i:1;s:5:"COLOR";i:1;s:5:"EMAIL";i:1;s:4:"FONT";i:1;s:1:"I";i:1;s:1:"S";i:1;s:4:"SIZE";i:1;s:1:"U";i:1;s:3:"URL";i:1;}s:5:"flags";i:3393;}s:8:"tagLimit";i:1000;s:9:"bitNumber";i:4;s:7:"allowed";a:1:{i:0;i:0;}}s:6:"CENTER";a:6:{s:11:"filterChain";R:76;s:12:"nestingLimit";i:10;s:5:"rules";a:2:{s:12:"fosterParent";R:138;s:5:"flags";i:256;}s:8:"tagLimit";i:1000;s:9:"bitNumber";i:1;s:7:"allowed";R:71;}s:4:"CODE";a:7:{s:10:"attributes";a:1:{s:4:"lang";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:57:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterIdentifier";s:6:"params";a:1:{s:9:"attrValue";N;}}}s:8:"required";b:0;}}s:11:"filterChain";R:76;s:12:"nestingLimit";i:10;s:5:"rules";a:2:{s:12:"fosterParent";R:138;s:5:"flags";i:4432;}s:8:"tagLimit";i:1000;s:9:"bitNumber";i:1;s:7:"allowed";R:151;}s:5:"COLOR";a:7:{s:10:"attributes";a:1:{s:5:"color";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:52:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterColor";s:6:"params";R:165;}}s:8:"required";b:1;}}s:11:"filterChain";R:76;s:12:"nestingLimit";i:10;s:5:"rules";R:85;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:0;s:7:"allowed";R:89;}s:11:"DAILYMOTION";a:8:{s:10:"attributes";a:2:{s:2:"id";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:53:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp";s:6:"params";a:2:{s:9:"attrValue";N;i:0;s:17:"!^[A-Za-z0-9]+$!D";}}}s:8:"required";b:1;}s:3:"url";R:101;}s:22:"attributePreprocessors";a:2:{i:0;a:3:{i:0;s:3:"url";i:1;s:72:"!dailymotion\\.com/(?:live/|user/[^#]+#video=|video/)(?\'id\'[A-Za-z0-9]+)!";i:2;a:2:{i:0;s:0:"";i:1;s:2:"id";}}i:1;a:3:{i:0;s:3:"url";i:1;s:24:"!^(?\'id\'[A-Za-z0-9]+)$!D";i:2;R:197;}}s:11:"filterChain";a:2:{i:0;a:2:{s:8:"callback";s:55:"s9e\\TextFormatter\\Parser::executeAttributePreprocessors";s:6:"params";a:2:{s:3:"tag";N;s:9:"tagConfig";N;}}i:1;R:77;}s:12:"nestingLimit";i:10;s:5:"rules";R:137;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:4;s:7:"allowed";R:151;}s:1:"E";a:6:{s:11:"filterChain";R:76;s:12:"nestingLimit";i:10;s:5:"rules";a:1:{s:5:"flags";i:3073;}s:8:"tagLimit";i:1000;s:9:"bitNumber";i:0;s:7:"allowed";a:1:{i:0;i:16160;}}s:5:"EMAIL";a:7:{s:10:"attributes";a:1:{s:5:"email";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:52:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterEmail";s:6:"params";R:165;}}s:8:"required";b:1;}}s:11:"filterChain";R:76;s:12:"nestingLimit";i:10;s:5:"rules";a:1:{s:5:"flags";i:514;}s:8:"tagLimit";i:1000;s:9:"bitNumber";i:2;s:7:"allowed";a:1:{i:0;i:11043;}}s:8:"FACEBOOK";a:8:{s:10:"attributes";a:2:{s:2:"id";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:53:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp";s:6:"params";a:2:{s:9:"attrValue";N;i:0;s:8:"@^\\d+$@D";}}}s:8:"required";b:1;}s:3:"url";R:101;}s:22:"attributePreprocessors";a:2:{i:0;a:3:{i:0;s:3:"url";i:1;s:135:"@/(?!(?:apps|developers|graph)\\.)[-\\w.]*facebook\\.com/(?:[/\\w]+/permalink|(?!pages/|groups/).*?)(?:/|fbid=|\\?v=)(?\'id\'\\d+)(?=$|[/?&#])@";i:2;R:197;}i:1;a:3:{i:0;s:3:"url";i:1;s:15:"@^(?\'id\'\\d+)$@D";i:2;R:197;}}s:11:"filterChain";R:203;s:12:"nestingLimit";i:10;s:5:"rules";a:1:{s:5:"flags";i:3137;}s:8:"tagLimit";i:1000;s:9:"bitNumber";i:2;s:7:"allowed";R:151;}s:4:"FONT";a:7:{s:10:"attributes";a:1:{s:4:"font";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:57:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterSimpletext";s:6:"params";R:165;}}s:8:"required";b:1;}}s:11:"filterChain";R:76;s:12:"nestingLimit";i:10;s:5:"rules";R:85;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:0;s:7:"allowed";R:89;}s:1:"I";R:75;s:3:"IMG";a:7:{s:10:"attributes";a:3:{s:3:"alt";a:1:{s:8:"required";b:0;}s:3:"src";a:2:{s:11:"filterChain";R:102;s:8:"required";b:1;}s:5:"title";R:268;}s:11:"filterChain";R:76;s:12:"nestingLimit";i:10;s:5:"rules";R:214;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:0;s:7:"allowed";R:218;}s:9:"INDIEGOGO";a:8:{s:10:"attributes";a:2:{s:2:"id";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:53:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp";s:6:"params";a:2:{s:9:"attrValue";N;i:0;s:11:"!^[-\\w]+$!D";}}}s:8:"required";b:1;}s:3:"url";R:101;}s:22:"attributePreprocessors";a:2:{i:0;a:3:{i:0;s:3:"url";i:1;s:39:"!indiegogo\\.com/projects/(?\'id\'[-\\w]+)!";i:2;R:197;}i:1;a:3:{i:0;s:3:"url";i:1;s:18:"!^(?\'id\'[-\\w]+)$!D";i:2;R:197;}}s:11:"filterChain";R:203;s:12:"nestingLimit";i:10;s:5:"rules";R:137;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:4;s:7:"allowed";R:151;}s:9:"INSTAGRAM";a:8:{s:10:"attributes";R:276;s:22:"attributePreprocessors";a:2:{i:0;a:3:{i:0;s:3:"url";i:1;s:32:"!instagram\\.com/p/(?\'id\'[-\\w]+)!";i:2;R:197;}i:1;R:289;}s:11:"filterChain";R:203;s:12:"nestingLimit";i:10;s:5:"rules";R:252;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:2;s:7:"allowed";R:151;}s:11:"KICKSTARTER";a:8:{s:10:"attributes";a:4:{s:4:"card";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:53:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp";s:6:"params";a:2:{s:9:"attrValue";N;i:0;s:9:"!^card$!D";}}}s:8:"required";b:0;}s:2:"id";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:53:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp";s:6:"params";a:2:{s:9:"attrValue";N;i:0;s:17:"!^[^/]+/[^/?]+$!D";}}}s:8:"required";b:1;}s:3:"url";R:101;s:5:"video";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:53:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp";s:6:"params";a:2:{s:9:"attrValue";N;i:0;s:10:"!^video$!D";}}}s:8:"required";b:0;}}s:22:"attributePreprocessors";a:2:{i:0;a:3:{i:0;s:3:"url";i:1;s:93:"!kickstarter\\.com/projects/(?\'id\'[^/]+/[^/?]+)(?:/widget/(?:(?\'card\'card)|(?\'video\'video)))?!";i:2;a:4:{i:0;s:0:"";i:1;s:2:"id";i:2;s:4:"card";i:3;s:5:"video";}}i:1;a:3:{i:0;s:3:"url";i:1;s:24:"!^(?\'id\'[^/]+/[^/?]+)$!D";i:2;R:197;}}s:11:"filterChain";R:203;s:12:"nestingLimit";i:10;s:5:"rules";R:137;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:4;s:7:"allowed";R:151;}s:2:"LI";a:6:{s:11:"filterChain";R:76;s:12:"nestingLimit";i:10;s:5:"rules";a:3:{s:12:"fosterParent";R:138;s:11:"closeParent";a:1:{s:2:"LI";i:1;}s:5:"flags";i:256;}s:8:"tagLimit";i:1000;s:9:"bitNumber";i:3;s:7:"allowed";R:71;}s:4:"LIST";a:7:{s:10:"attributes";a:2:{s:5:"start";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:51:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterUint";s:6:"params";R:165;}}s:8:"required";b:0;}s:4:"type";a:2:{s:11:"filterChain";a:2:{i:0;a:2:{s:8:"callback";s:54:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterHashmap";s:6:"params";a:3:{s:9:"attrValue";N;i:0;a:5:{s:1:"A";s:11:"upper-alpha";s:1:"I";s:11:"upper-roman";s:1:"a";s:11:"lower-alpha";s:1:"i";s:11:"lower-roman";i:1;s:7:"decimal";}i:1;b:0;}}i:1;R:260;}s:8:"required";b:0;}}s:11:"filterChain";R:76;s:12:"nestingLimit";i:10;s:5:"rules";a:2:{s:12:"fosterParent";R:138;s:5:"flags";i:3456;}s:8:"tagLimit";i:1000;s:9:"bitNumber";i:1;s:7:"allowed";a:1:{i:0;i:16168;}}s:8:"LIVELEAK";a:8:{s:10:"attributes";a:2:{s:2:"id";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:53:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp";s:6:"params";a:2:{s:9:"attrValue";N;i:0;s:15:"!^[a-f_0-9]+$!D";}}}s:8:"required";b:1;}s:3:"url";R:101;}s:22:"attributePreprocessors";a:2:{i:0;a:3:{i:0;s:3:"url";i:1;s:41:"!liveleak\\.com/view\\?i=(?\'id\'[a-f_0-9]+)!";i:2;R:197;}i:1;a:3:{i:0;s:3:"url";i:1;s:22:"!^(?\'id\'[a-f_0-9]+)$!D";i:2;R:197;}}s:11:"filterChain";R:203;s:12:"nestingLimit";i:10;s:5:"rules";R:137;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:4;s:7:"allowed";R:151;}s:5:"MEDIA";a:6:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:54:"s9e\\TextFormatter\\Plugins\\MediaEmbed\\Parser::filterTag";s:6:"params";a:3:{s:3:"tag";N;s:6:"parser";N;s:10:"mediasites";N;}}}s:12:"nestingLimit";i:10;s:5:"rules";a:1:{s:5:"flags";i:577;}s:8:"tagLimit";i:1000;s:9:"bitNumber";i:5;s:7:"allowed";R:151;}s:5:"QUOTE";a:7:{s:10:"attributes";a:1:{s:6:"author";R:268;}s:11:"filterChain";R:76;s:12:"nestingLimit";i:10;s:5:"rules";R:155;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:1;s:7:"allowed";R:71;}s:1:"S";R:75;s:4:"SIZE";a:7:{s:10:"attributes";a:1:{s:4:"size";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:52:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRange";s:6:"params";a:4:{s:9:"attrValue";N;i:0;i:8;i:1;i:36;s:6:"logger";N;}}}s:8:"required";b:1;}}s:11:"filterChain";R:76;s:12:"nestingLimit";i:10;s:5:"rules";R:85;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:0;s:7:"allowed";R:89;}s:10:"SOUNDCLOUD";a:8:{s:10:"attributes";a:5:{s:2:"id";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:53:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp";s:6:"params";a:2:{s:9:"attrValue";N;i:0;s:83:"@^(?:https?://(?:api\\.)?soundcloud\\.com/(?!pages/)[-/\\w]+/[-/\\w]+|^[^/]+/[^/]+$)$@D";}}}s:8:"required";b:1;}s:11:"playlist_id";a:2:{s:11:"filterChain";R:237;s:8:"required";b:0;}s:12:"secret_token";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:53:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp";s:6:"params";a:2:{s:9:"attrValue";N;i:0;s:11:"@^[-\\w]+$@D";}}}s:8:"required";b:0;}s:8:"track_id";R:443;s:3:"url";R:101;}s:22:"attributePreprocessors";a:5:{i:0;a:3:{i:0;s:3:"url";i:1;s:83:"@(?\'id\'https?://(?:api\\.)?soundcloud\\.com/(?!pages/)[-/\\w]+/[-/\\w]+|^[^/]+/[^/]+$)@";i:2;R:197;}i:1;a:3:{i:0;s:3:"url";i:1;s:50:"@api.soundcloud.com/playlists/(?\'playlist_id\'\\d+)@";i:2;a:2:{i:0;s:0:"";i:1;s:11:"playlist_id";}}i:2;a:3:{i:0;s:3:"url";i:1;s:87:"@api.soundcloud.com/tracks/(?\'track_id\'\\d+)(?:\\?secret_token=(?\'secret_token\'[-\\w]+))?@";i:2;a:3:{i:0;s:0:"";i:1;s:8:"track_id";i:2;s:12:"secret_token";}}i:3;a:3:{i:0;s:3:"url";i:1;s:81:"@soundcloud\\.com/(?!playlists|tracks)[-\\w]+/[-\\w]+/(?=s-)(?\'secret_token\'[-\\w]+)@";i:2;a:2:{i:0;s:0:"";i:1;s:12:"secret_token";}}i:4;a:3:{i:0;s:3:"url";i:1;s:90:"@^(?\'id\'(?:https?://(?:api\\.)?soundcloud\\.com/(?!pages/)[-/\\w]+/[-/\\w]+|^[^/]+/[^/]+$))$@D";i:2;R:197;}}s:11:"filterChain";a:3:{i:0;R:204;i:1;a:2:{s:8:"callback";s:51:"s9e\\TextFormatter\\Plugins\\MediaEmbed\\Parser::scrape";s:6:"params";a:3:{s:3:"tag";N;i:0;a:1:{i:0;a:3:{i:0;s:54:"@soundcloud\\.com/(?!playlists|tracks)[-\\w]+/[-\\w]+/s-@";i:1;s:36:"@soundcloud:tracks:(?\'track_id\'\\d+)@";i:2;a:1:{i:0;s:8:"track_id";}}}s:8:"cacheDir";N;}}i:2;R:77;}s:12:"nestingLimit";i:10;s:5:"rules";R:252;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:2;s:7:"allowed";R:151;}s:7:"SPOILER";a:7:{s:10:"attributes";a:1:{s:5:"title";R:268;}s:11:"filterChain";R:76;s:12:"nestingLimit";i:10;s:5:"rules";R:155;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:4;s:7:"allowed";R:71;}s:6:"TWITCH";a:8:{s:10:"attributes";a:6:{s:10:"archive_id";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:53:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp";s:6:"params";a:2:{s:9:"attrValue";N;i:0;s:8:"#^\\d+$#D";}}}s:8:"required";b:0;}s:7:"channel";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:53:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp";s:6:"params";a:2:{s:9:"attrValue";N;i:0;s:8:"#^\\w+$#D";}}}s:8:"required";b:0;}s:10:"chapter_id";R:501;s:1:"t";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:53:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp";s:6:"params";a:2:{s:9:"attrValue";N;i:0;s:27:"#^(?:(?:\\d+h)?\\d+m)?\\d+s$#D";}}}s:8:"required";b:0;}s:3:"url";R:101;s:8:"video_id";R:501;}s:22:"attributePreprocessors";a:2:{i:0;a:3:{i:0;s:3:"url";i:1;s:96:"#twitch\\.tv/(?\'channel\'\\w+)(?:/b/(?\'archive_id\'\\d+)|/c/(?\'chapter_id\'\\d+)|/v/(?\'video_id\'\\d+))?#";i:2;a:5:{i:0;s:0:"";i:1;s:7:"channel";i:2;s:10:"archive_id";i:3;s:10:"chapter_id";i:4;s:8:"video_id";}}i:1;a:3:{i:0;s:3:"url";i:1;s:32:"#t=(?\'t\'(?:(?:\\d+h)?\\d+m)?\\d+s)#";i:2;a:2:{i:0;s:0:"";i:1;s:1:"t";}}}s:11:"filterChain";a:3:{i:0;R:204;i:1;R:77;i:2;R:132;}s:12:"nestingLimit";i:10;s:5:"rules";R:137;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:4;s:7:"allowed";R:151;}s:7:"TWITTER";a:8:{s:10:"attributes";R:235;s:22:"attributePreprocessors";a:2:{i:0;a:3:{i:0;s:3:"url";i:1;s:51:"@twitter\\.com/(?:#!/)?\\w+/status(?:es)?/(?\'id\'\\d+)@";i:2;R:197;}i:1;R:248;}s:11:"filterChain";R:203;s:12:"nestingLimit";i:10;s:5:"rules";R:252;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:2;s:7:"allowed";R:151;}s:1:"U";R:75;s:3:"URL";a:7:{s:10:"attributes";a:2:{s:5:"title";R:268;s:3:"url";R:270;}s:11:"filterChain";R:76;s:12:"nestingLimit";i:10;s:5:"rules";R:228;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:2;s:7:"allowed";R:232;}s:5:"VIMEO";a:8:{s:10:"attributes";a:2:{s:2:"id";a:2:{s:11:"filterChain";R:94;s:8:"required";b:1;}s:3:"url";R:101;}s:22:"attributePreprocessors";a:2:{i:0;a:3:{i:0;s:3:"url";i:1;s:50:"!vimeo\\.com/(?:channels/[^/]+/|video/)?(?\'id\'\\d+)!";i:2;R:197;}i:1;a:3:{i:0;s:3:"url";i:1;s:15:"!^(?\'id\'\\d+)$!D";i:2;R:197;}}s:11:"filterChain";R:203;s:12:"nestingLimit";i:10;s:5:"rules";R:137;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:4;s:7:"allowed";R:151;}s:4:"VINE";a:8:{s:10:"attributes";a:2:{s:2:"id";a:2:{s:11:"filterChain";a:1:{i:0;a:2:{s:8:"callback";s:53:"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp";s:6:"params";a:2:{s:9:"attrValue";N;i:0;s:10:"!^[^/]+$!D";}}}s:8:"required";b:1;}s:3:"url";R:101;}s:22:"attributePreprocessors";a:2:{i:0;a:3:{i:0;s:3:"url";i:1;s:25:"!vine\\.co/v/(?\'id\'[^/]+)!";i:2;R:197;}i:1;a:3:{i:0;s:3:"url";i:1;s:17:"!^(?\'id\'[^/]+)$!D";i:2;R:197;}}s:11:"filterChain";R:203;s:12:"nestingLimit";i:10;s:5:"rules";R:137;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:4;s:7:"allowed";R:151;}s:4:"WSHH";a:8:{s:10:"attributes";R:559;s:22:"attributePreprocessors";a:2:{i:0;a:3:{i:0;s:3:"url";i:1;s:42:"!worldstarhiphop\\.com/featured/(?\'id\'\\d+)!";i:2;R:197;}i:1;R:566;}s:11:"filterChain";a:3:{i:0;R:204;i:1;a:2:{s:8:"callback";s:51:"s9e\\TextFormatter\\Plugins\\MediaEmbed\\Parser::scrape";s:6:"params";a:3:{s:3:"tag";N;i:0;a:1:{i:0;a:3:{i:0;s:49:"!worldstarhiphop\\.com/(?:\\w+/)?video\\.php\\?v=\\w+!";i:1;s:35:"!disqus_identifier[ =\']+(?\'id\'\\d+)!";i:2;a:1:{i:0;s:2:"id";}}}s:8:"cacheDir";N;}}i:2;R:77;}s:12:"nestingLimit";i:10;s:5:"rules";R:137;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:4;s:7:"allowed";R:151;}s:7:"YOUTUBE";a:8:{s:10:"attributes";a:7:{s:1:"h";R:93;s:2:"id";R:277;s:4:"list";a:2:{s:11:"filterChain";R:278;s:8:"required";b:0;}s:1:"m";R:93;s:1:"s";R:93;s:1:"t";R:93;s:3:"url";R:101;}s:22:"attributePreprocessors";a:5:{i:0;a:3:{i:0;s:3:"url";i:1;s:45:"!youtube\\.com/(?:watch.*?v=|v/)(?\'id\'[-\\w]+)!";i:2;R:197;}i:1;a:3:{i:0;s:3:"url";i:1;s:25:"!youtu\\.be/(?\'id\'[-\\w]+)!";i:2;R:197;}i:2;a:3:{i:0;s:3:"url";i:1;s:57:"![#&?]t=(?:(?:(?\'h\'\\d+)h)?(?\'m\'\\d+)m(?\'s\'\\d+)|(?\'t\'\\d+))!";i:2;a:5:{i:0;s:0:"";i:1;s:1:"h";i:2;s:1:"m";i:3;s:1:"s";i:4;s:1:"t";}}i:3;a:3:{i:0;s:3:"url";i:1;s:23:"!&list=(?\'list\'[-\\w]+)!";i:2;a:2:{i:0;s:0:"";i:1;s:4:"list";}}i:4;R:289;}s:11:"filterChain";R:203;s:12:"nestingLimit";i:10;s:5:"rules";R:137;s:8:"tagLimit";i:1000;s:9:"bitNumber";i:4;s:7:"allowed";R:151;}}}');
	}

	/**
	* Return a new instance of s9e\TextFormatter\Renderer
	*
	* @return s9e\TextFormatter\Renderer
	*/
	public static function getRenderer()
	{
		return unserialize('O:40:"s9e\\TextFormatter\\Bundles\\Forum\\Renderer":2:{s:9:"' . "\0" . '*' . "\0" . 'params";a:5:{s:14:"EMOTICONS_PATH";s:0:"";s:6:"L_HIDE";s:4:"Hide";s:6:"L_SHOW";s:4:"Show";s:9:"L_SPOILER";s:7:"Spoiler";s:7:"L_WROTE";s:6:"wrote:";}s:18:"metaElementsRegexp";s:22:"(<[eis]>[^<]*</[eis]>)";}');
	}
}