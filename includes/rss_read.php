<?php
/*----------------------------------------------------------------------*\
 * Copyright (C) 2006-2007 Anthony K Rogers roganty@gmail.com		*
 *----------------------------------------------------------------------*
 * CLASS: RSSread - Reads an XML RSS feed and outputs			*
 *  		    the posts formated with HTML			*
 *----------------------------------------------------------------------*
 * LICENSE: This is distributed and intended for free use as per the	*
 *	    GNU Public License. The only stipulation is that this	*
 *	    header must remain intact. For a copy of the GPL, please	*
 *	    go to http://www.gnu.org/licenses/gpl.txt			*
 *----------------------------------------------------------------------*
 * version 1.6								*
 * copyright 2006							*
 *----------------------------------------------------------------------*
 * Bug Fixes:								*
 * 4. Fixed a couple of calls to an array, and removed a call to an	*
 *    obsolete variable							*
 * 3. As in 2, but for the posts (1.5). Discovered by Luis		*
 * 2. Links not parsing correctly if they are not wrapped in		*
 *    <![CDATA[]]> tags in the feed (1.5). Discovered by Luis		*
 * 1. Fixed a typo which prevented new lines being shown in posts (1.4) *
 *----------------------------------------------------------------------*
 * Please note that this class is not ASCII Art safe!			*
 * and that most of the size of this file is comments			*
 * that are either required, or otherwise!				*
\*----------------------------------------------------------------------*/

//Not used. But it could be!
define("VERSION_MAJOR", 1);
define("VERSION_MINOR", 6);

class RSSread{

/* The values for the following variables may be 
 * changed by using the ScriptConfig() function
 */
var $rssFeed = "http://roganty.jubiiblog.co.uk/syndication.php?action=article"; //URL for the RSS feed

var $numPosts = 3; //The number of posts to output. -1 use all posts [default:3]

var $whichOne = "s"; //Which format to use: s = Sentences; w = Words; c = Chars; n = None (use all the post) [default:s]
//No - I don't know why there is three different variables that do the same job
// I think it was so that I could change the type and not the number...
var $numSentences = 3; //The number of Sentences to use [default:3]
var $numWords = 40; //The number of Words to use [default:40]
var $numChars = 200; //The number of Characters to use [default:200]

var $stripLinks = false; //Whether to remove links from posts [default:false]
var $postLinkTarget = "_blank"; /* The target to open the links in posts in, takes the same values as the target attribute in the <a> tag
			        * If set to "" or "_self" the target attribute will be omitted from the <a> tag
				* [default:_blank] */
/* The following are not impletementd in this version
 * But they could be added at a later date
 
 * var $stripHTMLformat = true; //Whether to remove HTML formatting tags, for example <b></b> and <i></i> from posts [default:true]
 * var $stripIMGtags = true; //Whether to remove all IMG tags from posts [default:true]
 * var $stripHTMLtags = true; //Whether to remove all other HTML tags from posts [default:true]
 */
var $outputFormat = "<b>[title]</b>\r\n<p>[post]\r\n<font class=\"LinkReadMore\">[[link,target=_blank]read more[/link]]</font></p>\r\n";

/* Anything in square brackects is replaced with appropriate values
 * Please note that only one "tag" is allowed
 * If more than one "tag" is included, only the first will be used
 * All other text is sent to browser as is
 * [title]: The Title of the post
 * [post]: The Post. This is a required "tag"
 * [link]...[/link]: Link to the post
 * For opening the link in a separate window or frame add ,target=[_blank,_parent,_self,_top,[name of frame]]
 * Defaults to opening in a new window
 * eg
 * [link,target=blank]opens in new window[/link] (default)
 * [link,target=parent]opens the link in parent frame[/link]
 * [link,target=self]opens the link in same frame[/link]
 * [link,target=top]opens the link in top frame[/link]
 * [link,target=mainpain]opens the link in the frame called "mainpain"[/link]
 */

var $joinOutputBy = "<hr width=\"65%\" />"; //HTML code that is attached inbetween posts

/* The values for the following variables can not
 * be changed by using the ScriptConfig() function
 */
//Not entirly sure this is needed,
// but it looks cool!
var $ScriptErrorCodes = array(
//Script Error Codes
1=>"Configuration of script output is unsupported",//
2=>"Variable cannot be set",//
4=>"A [post] tag has not been defined",//
8=>"Unable to load RSS",//
16=>"Not an RSS document",//
32=>"RSS version not Supported",
64=>"RSS document does not contain a &lt;description /&gt; tag",//
128=>"Unforseen option"); //
/*var $httpStatusCodes = array(
//HTTP Status Codes
301=>"Moved Permanently",
307=>"Temporary Redirect",
400=>"Bad Request",
401=>"Unauthorized",
403=>"Forbidden",
404=>"Not Found",
408=>"Request Timeout",
410=>"Gone",
500=>"Internal Server Error",
503=>"Service Unavailable",
504=>"Gateway Timeout");*/

var $errCode = 0; //Good!
//var $httpCode = 0; //Good!

var $RSSparser;

var $rssVersion = 2.0; //The version of the RSS document
var $rssInfo = array(); //The title and link for the rss feed
var $rssData = array(); //The rss data, array of the posts and the posts title and link

//For processing the XML file
var $curID = -1;
var $inChannel = false; //in <channel>?
var $inItem = false; //in <item>?
var $isTitle = false; //is it <title>?
var $isLink = false; //is is <link>?
var $isDesc = false; //is it <description>?

/* The main function
 * Not actually needed!
 */
function RSSread($confOutput=false){
 //Whether configuration is allowed or not
 $this->confOutput = $confOutput;
 //The version number
 $this->RSSreadVersion = VERSION_MAJOR .".". VERSION_MINOR;
}

/* This function could be a security breach waiting to happen....
 * Function for configuring the script on a one-off basis
 * Takes an associative array as argument in format:
 * The variable to change as the key (no $ sign needed)
 * And the value to change it to as the variable
 *
 * If this function is not required, it
 * can either be commented out or deleted
 */
function ScriptConfig($RSSconf){
 if( $this->confOutput ){
  //Following is a list of variables that can be changed
  $changeableVars =  "rssFeed|numPosts|whichOne|numSentences|numWords|numChars|stripLinks|postLinkTarget|outputFormat|joinOutputBy";
  foreach($RSSconf as $key => $val ){
   if( (strpos($changeableVars, $key)) === false ){
    //if unsupported var is found, we have two options:
    //#1 send an error and kill the script
    $this->errError(2);
    //#2 ignore this loop and go to the next loop
    //continue;
   }else $this->$key = stripslashes($val); //Added v1.5 to clean up html
  }
 }
 //notice no else!
 if(! $this->confOutput ){
  $this->confOutput = false;
  //we have two options:
  //#1 send an error and kill the script
  $this->errError(1);
  //#2 ingnore it and continue with the script
  //return false;
 }
}
/* function ScriptConfig() ends here */

function RSSoutput(){
 //we need to check that a [post] tag has been defined
 if( (strpos($this->outputFormat, "[post]")) === false ){
  $this->errError(4);
 }
 
 $gotPosts = $this->getPosts(); //returns array of posts
 if(! $gotPosts ) $this->errError(128); //just incase an error occurs
 $this->formatPosts(); //returns array of formated posts
 $outputPosts = $this->formatOutput($this->rssData); //returns array of posts formated with html code et al
 
 $outputString = implode($this->joinOutputBy ."\r\n", $outputPosts);
 
 return $outputString;
}

/* Function modifies the $this->rssData array
 */
function getPosts(){
 $numPosts = $this->numPosts;
 $this->loadXML(); //loads the XML file into memory
 
 //we need to check for description tags in the required elements
 //error code 64
 
 if( $numPosts == -1 ){
  foreach( $this->rssData as $val )
   if(! isset($val["description"]) ) $this->errError(64);
  return true;
 }else{
  $tmpArr = array();
  for( $i = 0; $i < $numPosts; $i++ ){
   if(! isset($this->rssData[$i]["description"]) ) $this->errError(64);
   $tmpArr[] = $this->rssData[$i];
  }
  
  //There is propably a better way of doing this!
  //unset($this->rssData);
  $this->rssData = array();
  
  foreach( $tmpArr as $val )
   $this->rssData[] = $val;
  
  return true;
 }
 return false; //just incase!! ;)
}

/* Function  modifies the $this->rssData array with proper format applied i.e.
 * Remove links
 * Shorten the post to desired length
 */
function formatPosts(){
 $whichOne = $this->whichOne;
 switch( $whichOne ){
  case "s": $postLength = $this->numSentences; break;
  case "w": $postLength = $this->numWords; break;
  case "c": $postLength = $this->numChars; break;
  case "n": $postLength = -1; break;
 }
 $stripLinks = $this->stripLinks;
 $postLinkTarget = $this->postLinkTarget;
 
 //we only need the posts from the array
 $tmpPosts = array();
 foreach( $this->rssData as $val )
  $tmpPosts[] = $val["description"];
 
 //First we replace all <li> tags with "\r\n* "...
 $tmpPosts = str_replace("<li>", "\r\n* ", $tmpPosts);
 // replace all <br /> tags with "\r\n"...
 $tmpPosts = str_replace(array("<br>", "<br />", "<br/>"), "\r\n", $tmpPosts);
 // and replace all <p> tags with "\r\n\r\n"
 $tmpPosts = str_replace("<p>", "\r\n\r\n", $tmpPosts);
 
 //Then we remove all tags apart from <a> tags (if applicable)
 for( $i = 0; $i < count($tmpPosts); $i++ )
  $tmpPosts[$i] = ( $stripLinks ) ? strip_tags($tmpPosts[$i]) : strip_tags($tmpPosts[$i], "<a>");
 
  //First we remove all <a> tags
 if(! $stripLinks ) $tmpPosts = $this->RemoveLinks($tmpPosts);
 
 //Then we shorten the post
 if( $whichOne != "n" )
  for( $i = 0; $i < count($tmpPosts); $i++ )
   $tmpPosts[$i] = $this->shortenPost($tmpPosts[$i], $whichOne, $postLength);
 
  //Then we put the tags back
 if(! $stripLinks ) $tmpPosts = $this->AddLinks($tmpPosts);
 
 //now we need to update the $rssData array
 for( $i = 0; $i < count($tmpPosts); $i++ )
  $this->rssData[$i]["description"] = $tmpPosts[$i];
 
 return true;
}

/* Function returns the posts in an array with html formatting applied
 */
function formatOutput($arrPosts){
 $outputFormat = $this->outputFormat;
 //$outputFormat = "[title]\r\n<br />[post]\r\n<br /><font class=\"LinkReadMore\">[link]read more[/link]</font>\r\n";
 
 //Need to find the positions of the link "tag",
 // we also need the end "tag" aswell
 
 /* $link_matches with a target "attribute" in the link "tag". ie [link,target=blah]...[/link]
  * $link_matches = array(0=>array(
  * 0=>array(0=>"[link,target=blah]", 1=>0),
  * 1=>array(0=>"link,target=blah", 1=>1),
  * 2=>array(0=>"target=blah", 1=>6)
  * ), 1=>array(
  * 0=>array(0=>"[/link]", 1=21),
  * 1=>array(0=>"/link", 1=>22)
  * ));
  * $link_matches with a "normal" link "tag". ie [link]...[/link]
  * $post_matches =  array(0=>array(
  * 0=>array(0=>"[link]", 1=>0),
  * 1=>array(0=>"link", 1=>1)
  * ), 1=>array(
  * 0=>array(0=>"[/link]", 1=>9),
  * 1=>array(0=>"/link", 1=>10)
  * ));
 */
 preg_match_all("/\[(\/link|link|link\,(.*?))\]/i", $outputFormat, $link_matches, PREG_SET_ORDER|PREG_OFFSET_CAPTURE);
 
 $gotLinkMatches = (! empty($link_matches) ) ? true : false;
 
 $outputPosts = array();
 
 if( $gotLinkMatches ){
  $linkStartTagLength = ( $gotLinkMatches ) ? strlen($link_matches[0][0][0]) : 0;
  $linkStartTagPos = ( $gotLinkMatches ) ? $link_matches[0][0][1] : 0;
  
  $linkEndTagLength = ( $gotLinkMatches ) ? strlen($link_matches[1][0][0]) : 0;
  $linkEndTagPos = ( $gotLinkMatches ) ? $link_matches[1][0][1] : 0;
  
  if( count($link_matches[0]) == 3 ){
   //There must be a target "attribute" then
   list($null, $target) = explode("=", $link_matches[0][2][0]);
   $target = " target=\"" .$target. "\"";
  }
  
 }
 
 foreach( $arrPosts as $val ){
  $numPos2Rem = 0;
  $numPrevPos = 0;
  $tmpStr = $outputFormat;
  $tmpstrLen = strlen($outputFormat);
  
  $val_link = ( isset($val["link"]) ) ? $val["link"] : $this->rssInfo["link"];
  $val_title = ( isset($val["title"]) ) ? $val["title"] : $this->rssInfo["title"];
  
  if( $gotLinkMatches ){
   $strLinkStart = "<a href=\"" .$val_link ."\"";
   $strLinkStart .= ( isset($target) ) ? $target : "";
   $strLinkStart .= ">";
   $numPrevPos = ($linkStartTagPos - $numPos2Rem);
   $numPos2Rem += (strlen($strLinkStart) - $linkStartTagLength);
   $tmpStr = substr_replace($tmpStr, $strLinkStart, $linkStartTagPos, $linkStartTagLength);
   
   $strLinkEnd = "</a>";
   $numPrevPos = ($numPos2Rem + $linkEndTagPos);
   $numPos2Rem += (strlen($strLinkEnd) - $linkEndTagLength);
   $tmpStr = substr_replace($tmpStr, $strLinkEnd, $numPrevPos, $linkEndTagLength);
  }
  if( ($pos = strpos($tmpStr, "[title]")) !== false ){
   $tmpStr = substr_replace($tmpStr, $val_title, $pos, 7);
  }
  if( ($pos = strpos($tmpStr, "[post]")) !== false ){
  $val["description"] = preg_replace("/(\r\n)/", "\\1<br />", $val["description"]);
  $tmpStr = substr_replace($tmpStr, $val["description"], $pos, 6);
  $outputPosts[] = $tmpStr;
  }else{
   //we need to throw an error if a post "tag" is not found
   $this->errError(4);
  }
 }
 
 return $outputPosts;
}

/* Function loads the RSS feed into memory
 */
function loadXML(){
 if( $fp = @fopen($this->rssFeed, "r") ){
  $this->RSSparser = xml_parser_create();
  //xml_parser_set_option($this->RSSparser, XML_OPTION_CASE_FOLDING, 0);
  xml_set_object($this->RSSparser, $this);
  xml_set_element_handler($this->RSSparser, array(&$this, "XMLstartElement"), array(&$this, "XMLendElement"));
  xml_set_character_data_handler($this->RSSparser, array(&$this, "XMLcharacterData"));
  while( $data = fread($fp, 4096))
   if(! xml_parse($this->RSSparser, $data, feof($fp)) )
    die( sprintf("XML error: %s at line %d", xml_error_string(xml_get_error_code($this->RSSparser)), xml_get_current_line_number($this->RSSparser)) );
  
  xml_parser_free($this->RSSparser);
 }else{
  //error code 8
  $this->errError(8);
 }
}

/* Function accepts an array of posts to remove the links from
 * It then returns the modified array
 *
 * The AddLinks() function can be found after the shortenPost() function!
 */
function RemoveLinks($arrPosts){
 //We find all <a> tags and get the start and end positions
 //We then save that into an array
  
 /* Example output:
  * $postLinks[][] = array(
  * 0=>array(0=>"<a href=\"link\">text</a>", 1=>0), //The whole match
  * 1=>array(0=>"<a href=\"link\">", 1=>0), //The opening <a> tag
  * 2=>array(0=>"link", 1=>9), //The href="" match
  * 3=>array(0=>"text", 1=>15), //The text match
  * 4=>array(0=>"</a>", 1=>19)); //The end tag match
  */
 $this->postLinks = array();
 for( $i = 0; $i < count($arrPosts); $i++ ){
  preg_match_all("/(<a.*?href=[\"|\'](.*?)[\"|\'][^>]*>)(.*?)(<\/a>)/i", $arrPosts[$i], $this->postLinks[$i], PREG_SET_ORDER|PREG_OFFSET_CAPTURE);
  $arrPosts[$i] = preg_replace("/<a.*?href=[\"|\'](.*?)[\"|\'][^>]*>(.*?)(<\/a>)/i", "\\2", $arrPosts[$i]);
  //$this->postLinks[$i] = array();
  //$arrPosts[$i] = preg_replace("/<a.*?href=[\"|\'](.*?)[\"|\'][^>]*>(.*?)(<\/a>)/ei", "\$this->saveRemove('\\0', '\\1', '\\2', '\\3', '$i')", $arrPosts[$i]);
 }
 
 //That was easy wasn't it!
 return $arrPosts;
}

/* Function worked brilliantly
 * but i wanted the starting positon of the strings
function saveRemove($matchAll, $matchLink, $matchText, $matchEnd, $i){
 $this->postLinks[$i][] = array($matchAll, $matchLink, $matchText, $matchEnd);
 return $matchText;
}
*/

/* Function accepts a string to be shortened ($strPost)
 * the method to shorthen the post ($shrtnHow)
 * and the length to shorten the post to ($shrtn2) [optional]
 * function then returns the modified post as a string
 */
function shortenPost($strPost, $shrtnHow, $shrtn2=-1){
 if( $shrtn2 == -1 || $shrtnHow == "n" ) return $strPost;
 
 $strPost = trim($strPost);
 
 //We want to keep the new lines!!
 //so we split $strPost by new lines
 $arrPost = preg_split("/\r\n|\n|\r/", $strPost);
 
 
 if( $shrtnHow == "c" ){
  if( strlen($strPost) <= $shrtn2 ) return rtrim($strPost);
  else{
   $arrLength = array();
   $strLength = 0;
   //loop throu getting the length of each element
   for( $i = 0; $i < count($arrPost); $i++ ){
    $arrLength[$i] = strlen($arrPost[$i]); //add the length to the length arr
    $strLength += $arrLength[$i]; //total up the lengths
    //when it reaches a certain length, halt it!
    if( $strLength >= $shrtn2 ) break;
   }
   
   if( $strLength <= $shrtn2 ){ //if the lengths are the same, no processing is needed
    //glue it all back together again
    $strPost = "";
    for( $j = 0; $j <= $i; $j++ )
     if( empty($arrPost[$j]) ) $strPost .= "\r\n";
     else $strPost .= $arrPost[$j] ."\r\n";
    
    //trim, and return it
    return rtrim($strPost) ."...";
   }else
   if( $strLength > $shrtn2 ){
    //otherwise we need to remove a few characters from the last required array element
    //$numDiff = $strLength - $shrtn2;
    //get the length
    $num2Rem = $arrLength[$i] - ($strLength - $shrtn2); //$numDiff;
    //cut it down to size
    $arrPost[$i] = substr($arrPost[$i], 0, $num2Rem);
    $strPost = "";
    //glue it all back together
    for( $j = 0; $j <= $i; $j++ )
     if( empty($arrPost[$j]) ) $strPost .= "\r\n";
     else $strPost .= rtrim($arrPost[$j]) ."\r\n";
    
    //trim, and return it
    return rtrim($strPost) ."...";
   }
  }
 }else
 if( $shrtnHow == "w" ){
  //we need to split the array up by whitespace characters
  $arrLength = array();
  $strLength = 0;
  for( $i = 0; $i < count($arrPost); $i++ ){
   if( empty($arrPost[$i]) ){ //we can skip the empty elements
    $arrLength[$i] = 0;
    continue;
   }
   $arrPost[$i] = preg_split("/\s+/", $arrPost[$i], -1, PREG_SPLIT_NO_EMPTY); //split by whitespace, don't return empty elements
   $arrLength[$i] = count($arrPost[$i]); //get the Length
   $strLength += $arrLength[$i]; //Total up the lengths
   if( $strLength >= $shrtn2 ) break;
  }
  $joinHow = " ";
 }else
 if( $shrtnHow == "s" ){
  //we've already split by new lines
  //so split the array by ".+/s" (a full stop followed by at least one whitespace)
  $arrLength = array();
  $strLength = 0;
  for( $i = 0; $i < count($arrPost); $i++ ){
   if( empty($arrPost[$i]) ){ //we can skip the empty elements
    $arrLength[$i] = 0;
    continue;
   }
   $arrPost[$i] = preg_split("/\.\s+/x", $arrPost[$i]); //split by a fullstop followed by whitespace
   //Just found a bug with this, if you have a list with "1." at the start, what happens?
   //oops!
   $arrLength[$i] = count($arrPost[$i]); //get the Length
   $strLength += $arrLength[$i]; //Total up the lengths
   if( $strLength >= $shrtn2 ) break;
  }
  $joinHow = ". ";
 }
 
 if( $shrtnHow == "w" || $shrtnHow == "s" ){
  //Now we need to glue it back together again
  if( $strLength <= $shrtn2 ){
   //Not much to do here!
   $i = ( $i > (count($arrPost) - 1) ) ? (count($arrPost) - 1) : $i;
   $strPost = "";
   //Loop through joing the elements together
   for( $j = 0; $j <= $i; $j++ )
    if( empty($arrPost[$j]) ) $strPost .= "\r\n";
    else $strPost .= implode($joinHow, $arrPost[$j]) ."\r\n";
   
   //retrun the string
   if( $strLength < $shrtn2 ) return rtrim($strPost);
   return rtrim($strPost) ."...";
  }else
  if( $strLength > $shrtn2 ){
   //Similar to above, just remove a couple of elements from the last array
   $strPost = "";
   for( $j = 0; $j < $i; $j++ ) //we don't loop through the last element
    if( empty($arrPost[$j]) ) $strPost .= "\r\n";
    else $strPost .= implode($joinHow, $arrPost[$j]) ."\r\n";
   
   //now we get the length of elements that we need
   $num2Rem = $arrLength[$i] - ($strLength - $shrtn2);
   //and then add them to the string
   $strPost .= implode($joinHow, array_slice($arrPost[$i], 0, $num2Rem));
   //return the string
   return rtrim($strPost) ."...";
  }
 }
}

/* Function accepts an array of posts to add the links to
 * It then returns the modified array
 */
function AddLinks($arrPosts){
 //We use the array from the RemoveLinks() function
 // to put the links back in the same places
 
 $postLinkTarget = ( $this->postLinkTarget == "" || $this->postLinkTarget == "_self" ) ? "": " target=\"" .$this->postLinkTarget. "\"";
 
 $postLinks = $this->postLinks;
 for( $i = 0; $i < count($arrPosts); $i++ ){
  //If the post has no corresponding links, skip it
  if( empty($postLinks[$i]) ) continue;
  else{
   //Then we get the length of the string
   //If the length is less than the first tag position, we can also skip it!
   if( (strlen($arrPosts[$i]) - 3) < $postLinks[$i][0][0][1] ) continue;
   else{
    //Otherwise we add the tag, do a little maths and add the another tags
    $numPos2Rem = 0;
    for( $j = 0; $j < count($postLinks[$i]); $j++ ){
     $strNewLink = "<a href=\"". $postLinks[$i][$j][2][0] ."\"$postLinkTarget>";// .$postLinks[$i][$j][3][0]. "</a>";
     $numNewLength = strlen($strNewLink); //The length of the new link
     $numOrigLength = strlen($postLinks[$i][$j][1][0]); //The length of the original link
     $numOldStart = $postLinks[$i][$j][1][1]; //The original starting position
     $numNewStart = ($numOldStart - $numPos2Rem); //The new starting position
     //Stop the loop if the new starting position is after the end of the string
     if( (strlen($arrPosts[$i]) - 3) <= $numNewStart ) break;
     $numPos2Rem += ($numOrigLength - $numNewLength); //The number to remove to get the new position of the next link
     //Deep breath!
     $arrPosts[$i] = substr_replace($arrPosts[$i], $strNewLink, $numNewStart, 0);
     //The following is added to solve the "whole link reapearing if cut short" bug
     $numOldStart = $postLinks[$i][$j][4][1]; //The original starting position
     $numNewStart = ($numOldStart - $numPos2Rem); //The new starting position
     if( $numNewStart >= (strlen($arrPosts[$i]) - 3) )
      $arrPosts[$i] = substr_replace($arrPosts[$i], ".</a>", -1); //add .</a> at end of string
     else
      $arrPosts[$i] = substr_replace($arrPosts[$i], "</a>", $numNewStart, 0); //add </a>
    }
   }
  }
 }
 return $arrPosts;
}

/* Function that kills the script if an error happens
 * function accepts an error number
 * the messages that are connected to the error numbers
 * can be found at the top of this class in the variable
 * called $ScriptErrorCodes
 */
function errError($errNum=0){
 if( $errNum == 0 ) return true;
 else{
  die("\r\n<br /><b>Error Code: $errNum</b>\r\n<br />". $this->ScriptErrorCodes[$errNum] ."\r\n<br />\r\n");
 }
}

/* The start tags are passed to this function by the xml parser
 */
function XMLstartElement($parser, $name, $attrs){
//we can check to see if an <rss> tag is present
//error code 16 mabe 32
 if( $name == "rss" || $name == "RSS" ) $this->isRSS = true;
 
 if(! $this->isRSS ) $this->errError(16);//No <RSS> tag found, so it must not be an XML RSS file
 
 switch( $name ){
  case "rss" : $this->rssVersion = $attrs["version"]; break;
  case "RSS" : $this->rssVersion = $attrs["VERSION"]; break;
  case "channel" :
  case "CHANNEL" : $this->inChannel = true; break;
  case "item" :
  case "ITEM" : $this->rssData[] = array(); $this->curID++; $this->inItem = true; break;
  case "title" :
  case "TITLE" : $this->isTitle = true; break;
  case "link" :
  case "LINK" : $this->isLink = true; break;
  case "description" :
  case "DESCRIPTION" : $this->isDesc = true; break;
 }
}

/* The end tags are passed to this function by the xml parser
 */
function XMLendElement($parser, $name){
 switch( $name ){
  case "channel" :
  case "CHANNEL" : $this->inChannel = false; break;
  case "item" :
  case "ITEM" : $this->inItem = false; break;
  case "title" :
  case "TITLE" : $this->isTitle = false; break;
  case "link" :
  case "LINK" : $this->isLink = false; break;
  case "description" :
  case "DESCRIPTION" : $this->isDesc = false; break;
 }
}

/* Any data that is not part of a tag is passed to this function by the xml parser
 */
function XMLcharacterData($parser, $data){
 if( $this->inChannel )
  if(! $this->inItem ){
   if( $this->isTitle ){ /* Changed to fix a possible bug */
    if(! isset($this->rssInfo["title"]) )
     $this->rssInfo["title"] = htmlentities($data); //Add the RSS title to an array
    else
     $this->rssInfo["title"] .= htmlentities($data); //Add the RSS title to an array
   }
   if( $this->isLink ){ /* Changed to fix a possible bug */
    if(! isset($this->rssInfo["link"]) )
     $this->rssInfo["link"] = htmlentities($data); //Add the RSS link to an array
    else
     $this->rssInfo["link"] .= htmlentities($data); //Add the RSS link to an array
   }
  }else
  if( $this->inItem ){
   $curID = $this->curID;
   if( $this->isTitle ){ /* Changed to fix a possible bug */
    if(! isset($this->rssData[$curID]["title"]) )
     $this->rssData[$curID]["title"] = htmlentities($data); //Add the item title to an array
    else
     $this->rssData[$curID]["title"] .= htmlentities($data); //Add the item title to an array
   }
   if( $this->isLink ){ /* Thanks to Luis who spotted this bug - It is due to the way xml_parse() handles special characters like "&" (added the ".") */
    if(! isset($this->rssData[$curID]["link"]) )
     $this->rssData[$curID]["link"] = htmlentities($data); //Add the item link to an array
    else
     $this->rssData[$curID]["link"] .= htmlentities($data); //Add the item link to an array
   }
   if( $this->isDesc ){ /* Thanks to Luis who spotted this bug, and suggested a fix */
    if(! isset($this->rssData[$curID]["description"]) )
     $this->rssData[$curID]["description"] = $data; //Add the item description (post) to an array
    else
     $this->rssData[$curID]["description"] .= $data; //Add the item description (post) to an array
   }
  }
}

//The following two are not needed, but they look good!

/* Function for RSS 0.9x versions
 */
function RSSv0_9(){}
/* Function for RSS 2.0 versions
 */
function RSSv2_0(){}

}

?>