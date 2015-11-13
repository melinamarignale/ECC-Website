<?php
/*!
  \class   ezmetatagtype ezmetatagtype.php
  \ingroup eZDatatype
  \brief   Handles the datatype metatag. By using metatag you can affect meta tags to objects on a unique attribute
  \version 1.0
  \date    Vendredi 18 Mai 2007 10:21:22 am
  \author  Alexandre Nion

*/

/*
 *   \version 2.0
  \date    2009 
 * *  \author  LIU Bin
 *  Keyword just for the meta keyword
 *  Tag : Keyword + Keyword2
 *  +Articles : Keywordslink1 + Keywordslink2
 */
class ezmetatagtype extends eZDataType
{
	const DATA_TYPE_STRING = "ezmetatag";
/*!
      Constructor
    */
    function ezmetatagtype()
    {
        $this->eZDataType( self::DATA_TYPE_STRING, ezpI18n::tr( 'kernel/classes/datatypes', "Meta-tag", 'Datatype name' ),
                           array( 'serialize_supported' => true,
                                  'object_serialize_map' => array( 'data_text' => 'text' ) ) );
    }

    /*!
     Validates the input and returns true if the input was
     valid for this datatype.
    */
    function validateObjectAttributeHTTPInput( $http, $base, $contentObjectAttribute )
    {
        return eZInputValidator::STATE_ACCEPTED;
    }

    /*!
     Fetches all variables from the object
     \return true if fetching of class attributes are successfull, false if not
    */
    function fetchObjectAttributeHTTPInput( $http, $base, $contentObjectAttribute )
    {
    	if ( $http->hasPostVariable( $base . "_data_text_" . $contentObjectAttribute->attribute( "id" ) . "_name" )
			&& $http->hasPostVariable( $base . "_data_text_" . $contentObjectAttribute->attribute( "id" ) . "_description" )
        	&& $http->hasPostVariable( $base . "_data_text_" . $contentObjectAttribute->attribute( "id" ) . "_keyword" )	 )
        {
            $nameValue = $http->postVariable( $base . "_data_text_" . $contentObjectAttribute->attribute( "id" ) . "_name" );
            $descriptionValue = $http->postVariable( $base . "_data_text_" . $contentObjectAttribute->attribute( "id" ) . "_description" );
            $keywordValue = $http->postVariable( $base . "_data_text_" . $contentObjectAttribute->attribute( "id" ) . "_keyword" );
            
                      $keyword2Value='';            
            if ( $http->hasPostVariable( $base . "_data_text_" . $contentObjectAttribute->attribute( "id" ) . "_keyword2" ) )
            	$keyword2Value = $http->postVariable( $base . "_data_text_" . $contentObjectAttribute->attribute( "id" ) . "_keyword2" );
            

            	//modified by LIU bin begin
            $keywordlinksValues=array();
            if ( $http->hasPostVariable( "keywordslink1" ) )

            {

            	$keywordlinksValues=$http->postVariable("keywordslink1" );

				array_filter($keywordlinksValues, 'is_string');

				$keywordlinksValues = array_unique($keywordlinksValues);
        	}


            $keyword2linksValues=array();

            if ( $http->hasPostVariable( "keywordslink2" ) )

            {

            	$keyword2linksValues=$http->postVariable("keywordslink2" );

				array_filter($keyword2linksValues, 'is_string');

				$keyword2linksValues = array_unique($keyword2linksValues);

        	}
                    //modified by LIU bin end
                    
            $tag = new eZMetaTag( $nameValue );
            $object = $contentObjectAttribute->object();
            
            $objectDataMap = $object->datamap();
            $objectClass = $object->contentClassIdentifier();
            $ini = eZINI::instance( "metatag.ini" );
            
            // We check if filling on publish is enabled in settings
            if( $ini->hasVariable( 'AttributesMapping', "FillOnPublish" ) && $ini->variable( 'AttributesMapping', "FillOnPublish" )=="enabled" )
            	$fillOnPublish = true;
            else
            	$fillOnPublish = false;

			$nameAttributes 		= null;
			$descriptionAttributes	= null;
			$keywordsAttributes		= null;

			$attributesMappings		= MetatagFunctionCollection::getAttributesMapping( $objectClass );
			if( array_key_exists( 'name', $attributesMappings ) )
				$nameAttributes 		= $attributesMappings['name'];
			if( array_key_exists( 'description', $attributesMappings ) )	
				$descriptionAttributes	= $attributesMappings['description'];
			if( array_key_exists( 'keywords', $attributesMappings ) )
				$keywordsAttributes		= $attributesMappings['keywords'];
			unset( $attributesMappings );
            
            if( empty( $nameValue ) && $fillOnPublish )
            {
                foreach( $nameAttributes as $attribute )
            	{
            		if( is_object( $objectDataMap[$attribute] ) && $objectDataMap[$attribute]->hasContent() )
            		{
        		    	$tag->setNameFromTextAttribute( $objectDataMap[$attribute] );
        		    	break;
            		}
            	}
            }            
            
            if( empty( $descriptionValue ) && $fillOnPublish )
            {
                foreach( $descriptionAttributes as $attribute )
            	{
            		if( is_object( $objectDataMap[$attribute] ) && $objectDataMap[$attribute]->hasContent() )
            		{
        		    	$tag->setDescriptionFromTextAttribute( $objectDataMap[$attribute] );
        		    	break;
            		}
            	}
            }
            else
            {
            	$tag->setDescription( $descriptionValue );
            }

            if( empty( $keywordValue ) && $fillOnPublish )
            {
                foreach( $keywordsAttributes as $attribute )
            	{
		            if( is_object( $objectDataMap[$attribute] ) && $objectDataMap[$attribute]->hasContent() )
            		{
		            	$tag->setKeywordsFromTextAttribute( $objectDataMap[$attribute] );
        		    	break;
            		}
            	}
            }
            else
            {
            	$tag->setKeywords( $keywordValue );
            }
              //modified by LIU bin begin
            $tag->setKeywords2( $keyword2Value );
           	$tag->setKeywordslinks( $keywordlinksValues );
           	$tag->setKeywords2links( $keyword2linksValues );
              //modified by LIU bin end
            $contentObjectAttribute->setAttribute( "data_text", $tag->xmlString() );
	        return true;
        }
        return false;
    }

    /*!
     Returns the content.
    */
    function objectAttributeContent( $contentObjectAttribute )
    {
    	$tag       = eZMetaTag::get( $contentObjectAttribute->attribute( 'data_text' ) );
    	//$content   = array( "name"=>$tag->getName(), "description"=>$tag->getDescription(), "keywords"=>$tag->getKeywords() ); 
    	$content   = array( "name"=>$tag->getName(), "description"=>$tag->getDescription(), "keywords"=>$tag->getKeywords(), "keywords2"=>$tag->getKeywords2(), "keywordslinks"=>$tag->getKeywordslinks(), "keywords2links"=>$tag->getKeywords2links() ); 
    	return $content;
    }

    /*!
     Returns the value as it will be shown if this attribute is used in the object name pattern.
    */
    function title( $data_instance, $name = null )
    {
    	$tag = eZMetaTag::get( $data_instance->attribute( 'data_text' ) );
        return $tag->getName();
    }

    /*!
     \return true if the datatype can be indexed
    */
    function isIndexable()
    {
        return false;
    }
    
    function toString( $contentObjectAttribute )
    {//To do
    	return serialize( $this->objectAttributeContent ($contentObjectAttribute) ) ; 
    	//return $content;
    }
    
    function fromString( $contentObjectAttribute, $string )
    {	//To do
        //return $contentObjectAttribute->setAttribute( 'data_int', $string );
    }
}

eZDataType::register( ezmetatagtype::DATA_TYPE_STRING, "ezmetatagtype" );
?>