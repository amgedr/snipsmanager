<?xml version="1.0" encoding="iso-8859-1"?>
<!--
  @(#) $Id: rss2html.xsl,v 1.9 2006/08/30 02:57:14 mlemos Exp $
  -->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rss="http://purl.org/rss/1.0/" xmlns="http://www.w3.org/1999/xhtml">

<xsl:output method="html"/>

<xsl:template match="/">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
div.channel-title { font-family: sans-serif, arial, helvetica }
</style>
<style type="text/css">
div.image { font-family: sans-serif, arial, helvetica }
</style>
<style type="text/css">
div.image-description { font-family: sans-serif, arial, helvetica }
</style>
<style type="text/css">
div.item-title { font-family: sans-serif, arial, helvetica }
</style>
<style type="text/css">
div.item-description { font-family: sans-serif, arial, helvetica }
</style>
<style type="text/css">
div.textinput-title { font-family: sans-serif, arial, helvetica }
</style>
<style type="text/css">
div.textinput-form { font-family: sans-serif, arial, helvetica }
</style>
<script type="text/javascript">

function decodeEscaped()
{
	if(document.getElementsByName)
	{
		var escaped=document.getElementsByName('escaped')
	
		for(e = 0; e&lt;escaped.length; e++)
			escaped[e].innerHTML= escaped[e].innerHTML.replace(/&amp;lt;/g, '&lt;').replace(/&amp;gt;/g, '&gt;').replace(/&amp;amp;/g, '&amp;').replace(/&amp;quot;/g, '&quot;')
	}
}

</script>
<title>
<xsl:for-each select="rss/channel">
<xsl:value-of select="description"/>
</xsl:for-each>
</title>
</head>
<body onload="decodeEscaped()">

<xsl:for-each select="rss/channel/image">
<center><div class="image">
<xsl:element name="a">
	<xsl:attribute name="href"><xsl:value-of select="link"/></xsl:attribute>
	<xsl:element name="img">
		<xsl:attribute name="src"><xsl:value-of select="url"/></xsl:attribute>
		<xsl:attribute name="alt"><xsl:value-of select="title"/></xsl:attribute>
		<xsl:attribute name="border">0</xsl:attribute>
	</xsl:element>
</xsl:element>
</div></center>
<center><div class="image-description">
<xsl:value-of select="description"/>
</div></center>
</xsl:for-each>

<xsl:for-each select="rss/channel">
<center><div class="channel-title">
<xsl:element name="a">
	<xsl:attribute name="href"><xsl:value-of select="link"/></xsl:attribute>
	<xsl:value-of select="title"/>
	<xsl:text> (</xsl:text>
	<xsl:value-of select="pubDate"/>
	<xsl:text>)</xsl:text>
</xsl:element>
</div></center>
</xsl:for-each>

<ul>
<hr />
<xsl:for-each select="rss/channel/item">
<div class="item-title"><li>
<xsl:element name="a">
	<xsl:attribute name="href"><xsl:value-of select="link"/></xsl:attribute>
	<xsl:value-of select="title"/>
</xsl:element>
<xsl:text> (</xsl:text>
<xsl:value-of select="pubDate"/>
<xsl:text>)</xsl:text>
</li></div>
<div name="escaped" class="item-description"><xsl:value-of select="description" disable-output-escaping="yes"/></div>
<hr />
</xsl:for-each>
</ul>

<xsl:for-each select="rss/channel/textInput">
<center><b><div class="textinput-title"><xsl:value-of select="description"/></div></b></center>
<xsl:element name="form">
	<xsl:attribute name="action"><xsl:value-of select="link"/></xsl:attribute>
	<xsl:attribute name="method">POST</xsl:attribute>
	<center><div class="textinput-form">
	<xsl:element name="input">
		<xsl:attribute name="name"><xsl:value-of select="name"/></xsl:attribute>
		<xsl:attribute name="type">text</xsl:attribute>
	</xsl:element>
	<xsl:text> </xsl:text>
	<xsl:element name="input">
		<xsl:attribute name="value"><xsl:value-of select="title"/></xsl:attribute>
		<xsl:attribute name="type">submit</xsl:attribute>
	</xsl:element>
</div></center>
</xsl:element>
</xsl:for-each>

</body>
</html>
</xsl:template>

</xsl:stylesheet>
