<?php
/**
 * Copyright (c) 2010-2011 SnipsManager (http://www.snipsmanager.com/), All Rights Reserved
 * A CodeHill Creation (http://codehill.com/)
 * 
 * IMPORTANT: 
 * - You may not redistribute, sell or otherwise share this software in whole or in part without
 *   the consent of SnipsManager's owners. Please contact the author for more information.
 * 
 * - Link to snipsmanager.com may not be removed from the software pages without permission of SnipsManager's
 *   owners. This copyright notice may not be removed from the source code in any case.
 *
 * - This file can be used, modified and distributed under the terms of the License Agreement. You
 *   may edit this file on a licensed Web site and/or for private development. You must adhere to
 *   the Source License Agreement. The latest copy can be found online at:
 * 
 *   http://www.snipsmanager.com/license/
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR 
 * IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND 
 * FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR 
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, 
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY
 * WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @link        http://www.snipsmanager.com/
 * @copyright   2010-2011 CodeHill LLC (http://codehill.com/)
 * @license     http://www.snipsmanager.com/license/
 * @author      Amgad Suliman, CodeHill LLC <amgadhs@codehill.com>
 * @version     2.2
 *
 * Creates the RSS feed's XML.
 *
 */
 
include_once('../config.php');
include_once('../includes/functions.php');
connect();

require("xmlwriterclass.php");
require("rss_writer_class.php");

$rss_writer_object = new rss_writer_class;

//Choose the version of specification that the generated RSS document should conform.
$rss_writer_object->specification='1.0';

//Specify the URL where the RSS document will be made available.
$rss_writer_object->about='channels.xml';

//Specify the URL of an optional XSL stylesheet. This lets the document be rendered automatically in XML capable browsers.
$rss_writer_object->stylesheet='rss1html.xsl';

//You may declare additional namespaces that enable the use of more property tags defined by extension modules of the RSS specification.
$rss_writer_object->rssnamespaces['dc']='http://purl.org/dc/elements/1.1/';

//Define the properties of the channel.
$properties=array();
$properties['description'] = ch_getsetting('metadescription');
$properties['link'] = $sitename;
$properties['title'] = ch_getsetting('title');
$properties['dc:date'] = date("D, j M Y G:i:s O");
$rss_writer_object->addchannel($properties);

//If your channel has a logo, before adding any channel items, specify the logo details this way.
$properties = array();
$properties['url']='../' . ch_getsetting('logourl');
$properties['link'] = $sitename;
$properties['title'] = ch_getsetting('title');
$properties['description'] = ch_getsetting('metadescription');
$rss_writer_object->addimage($properties);

//Then add your channel items one by one.
$properties = array();
$result = mysql_query("SELECT * FROM `codes` WHERE `password` = '' ORDER BY `submitdate` DESC LIMIT 0,50");

if(mysql_num_rows($result)) {
	while($row = mysql_fetch_array($result)) {
		$formatedCode = ch_formatCodeForDisplaying($row['code']);
		$formatedCode = str_replace("\n", "<br />", $formatedCode);
		
		$properties['title'] = $row['codetitle'];
		$properties['description'] = substr($formatedCode, 0, 100);  //display 100 characters 
		$properties['link'] = $sitename . 'show.php?id=' . 	$row['id'];
		$properties['dc:date'] = $row['submitdate'];
		$rss_writer_object->additem($properties);
	}
} else {   
	//if there are no snippets in the database yes display the following text
	$properties['title'] = 'There are no snippets to show';
	$properties['description'] = '';
	$properties['link'] = $sitename;
	$rss_writer_object->additem($properties);
}

//When you are done with the definition of the channel items, generate RSS document.
if($rss_writer_object->writerss($output)) {		
	//If the document was generated successfully, you may now output it.
	Header('Content-Type: text/xml; charset="'.$rss_writer_object->outputencoding.'"');
	Header('Content-Length: '.strval(strlen($output)));
	echo $output;
} else {		
	//If there was an error, output it as well.
	Header('Content-Type: text/plain');
	echo ('Error: '.$rss_writer_object->error);
}
?>