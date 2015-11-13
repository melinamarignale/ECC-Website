<?php
/*!
  \class   ezmetatag ezmetatag.php
  \ingroup eZDatatype
  \brief   Structure class to handle datatype metatag.
  \version 1.0
  \date    Vendredi 18 Mai 2007 10:21:22 am
  \author  Alexandre Nion



*/
class eZMetaTag
{
	public	$name			= NULL;
	public	$description	= NULL;
	public	$keywords		= NULL;
	public	$keywords2		= NULL;
	public	$keywordslinks	= array();
	public	$keywords2links	= array();

	function eZMetaTag( $name=false )
	{
		if( $name )
			$this->setName( $name );
	}

    /*function domString( &$domDocument )
    {
        $ini		= eZINI::instance();
        $xmlCharset	= $ini->variable( 'RegionalSettings', 'ContentXMLCharset' );
        if ( $xmlCharset == 'enabled' )
        {
            $charset = eZTextCodec::internalCharset();
        }
        else if ( $xmlCharset == 'disabled' )
            $charset = true;
        else
            $charset = $xmlCharset;
        if ( $charset !== true )
        {
            $charset = eZCharsetInfo::realCharsetCode( $charset );
        }
        print_r( $charset );
        $domString = $domDocument->saveHTML();
        print_r( $domString );
        die();
        return $domString;
    }*/

	function xmlString( )
	{
        $doc = new DOMDocument( '1.0', 'utf-8' );
        $root = $doc->createElement( "ezmetatag" );
        $doc->appendChild($root);

      /*  $Doc = new DOMDocument('1.0');
$Dom = $Doc->appendChild(new domelement('log'));
$Dom->setAttribute('class','something');
$Dom->appendChild($Doc->createTextNode('something'));*/



        $name = $doc->createElement( "name"  );
        $nameValue = $doc->createTextNode( $this->name );
        $name->appendChild( $nameValue );
        $root->appendChild ($name);

       // print_r( $Doc->saveHTML() );
        //die();

        $description = $doc->createElement( "description" );
        $descriptionValue = $doc->createTextNode( $this->description );
        $description->appendChild( $descriptionValue );
		$root->appendChild ($description);

        $keywords = $doc->createElement( "keywords" );
        $keywordValue = $doc->createTextNode( $this->keywords );
        $keywords->appendChild( $keywordValue );
		$root->appendChild ($keywords);

        $keywords2 = $doc->createElement( "keywords2" );
        $keyword2Value = $doc->createTextNode( $this->keywords2 );
        $keywords2->appendChild( $keyword2Value );
		$root->appendChild ($keywords2);

        $keywordslinks = $doc->createElement( "keywordslinks" );
        foreach($this->keywordslinks as $key=>$keywordslinkText){
        	$varName="keywordslink".$key;
        	$varName2="keywordslinkNode".$key;
        	$$varName= $doc->createElement( "keywordslink" );
        	$$varName2= $doc->createTextNode( $keywordslinkText );
        	$keywordslinks->appendChild( $$varName2 );
        }
        $root->appendChild( $keywordslinks );

        $keywords2links = $doc->createElement( "keywords2links" );
        foreach($this->keywords2links as $key=>$keywords2linkText){
        	$varName="keywords2link".$key;
        	$varName2="keywords2linkNode".$key;
        	$$varName= $doc->createElement( "keywords2link" );
        	$$varName2= $doc->createTextNode( $keywords2linkText );
        	$$varName->appendChild( $$varName2 );
        	$keywords2links->appendChild( $$varName );
        }
        $root->appendChild( $keywords2links );

        return $doc->saveXML( );
	}


function decodeXML( $xmlString )
	{
		//$xml = new eZXML();
		$dom = new DOMDocument( '1.0', 'utf-8' );


        if( $xmlString!="" )
        {
         	$success = $dom->loadXML( $xmlString );
            if (!$success) {return false;}
	        $nameArray = $dom->getElementsByTagName ( "name" );
	        $this->setName( $nameArray->item(0)->nodeValue );
	        $descriptionArray = $dom->getElementsByTagName ( "description" );
	        $this->setDescription( $descriptionArray->item(0)->nodeValue );
	        $keywordArray = $dom->getElementsByTagName ( "keywords" );
	        $this->setKeywords( $keywordArray->item(0)->nodeValue );
	        if($keyword2Array = $dom->getElementsByTagName ( "keywords2" ))
	      	  $this->setKeywords2( $keyword2Array->item(0)->nodeValue );
	        if($keywordLinksArray = $dom->getElementsByTagName ( "keywordslink" )){
	        	foreach($keywordLinksArray as $keywordLinksElement){
	        		array_push($this->keywordslinks,$keywordLinksElement->textContent);
	        	}
	        }
	        if($keyword2LinksArray = $dom->getElementsByTagName ( "keywords2link" )){
	        	foreach($keyword2LinksArray as $keyword2LinksElement){
	        		array_push($this->keywords2links,$keyword2LinksElement->textContent);
	        	}
	        }

        }
        unset( $xml );
	}

	function setName( $name )
	{
		$this->name = $name;
	}
	function getName( )
	{
		return $this->name;
	}
	function hasName()
	{
		return !empty( $this->name );
	}
	function setNameFromTextAttribute( $attribute )
	{
		$this->setName( $this->getTextValueOfAttribute( $attribute ) );
	}

	function setDescription( $description )
	{
		$this->description = $description;
	}
	function getDescription()
	{
		return $this->description;
	}
	function hasDescription()
	{
		return !empty( $this->description );
	}
	function setDescriptionFromTextAttribute( $attribute )
	{
		$this->setDescription( $this->getTextValueOfAttribute( $attribute ) );
	}
	function setKeywords( $keywords )
	{
		$this->keywords = $keywords;
	}
	function getKeywords()
	{
		return $this->keywords;
	}
	function hasKeywords()
	{
		return !empty( $this->keywords );
	}
	function setKeywordsFromTextAttribute( $attribute )
	{
		$this->setKeywords( $this->getTextValueOfAttribute( $attribute ) );
	}

		function setKeywords2( $keywords2 )
	{
		$this->keywords2 = $keywords2;
	}
	function getKeywords2()
	{
		return $this->keywords2;
	}
	function setKeywordslinks( $keywordslinks )
	{
		$this->keywordslinks = $keywordslinks;
	}
	function getKeywordslinks()
	{
		return $this->keywordslinks;
	}
	function setKeywords2links( $keywords2links )
	{
		$this->keywords2links = $keywords2links;
	}
	function getKeywords2links()
	{
		return $this->keywords2links;
	}

	static function getTextValueOfAttribute( $attribute )
	{
		switch( $attribute->DataTypeString )
		{
			case 'ezstring':	return $attribute->value();
			case 'ezselection': return implode( " " , $attribute->content() );
			case 'ezkeyword':	$content = $attribute->content();
								return $content->keywordString();
			case 'ezxmltext':	$content = $attribute->content();
								return html_entity_decode( strip_tags( ereg_replace( "(</paragraph>)|(<br/>)|(</header>)","\n",ereg_replace( "\n","",ereg_replace( "[\t ]+<", "<" ,$attribute->DataText ) ) ) ) );
			case 'sckenhancedselection' : return implode( " " , $attribute->content() );
			default:			return NULL;
		}
	}

	static function get( $xmlText )
	{
		$tag = new eZMetaTag();
		$tag->decodeXML( $xmlText );
		return $tag;
	}

}
?>