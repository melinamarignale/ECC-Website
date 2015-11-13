<?php
/*!
  \class   ezmetatagfunctioncollection ezmetatagfunctioncollection.php
  \ingroup eZDatatype
  \brief   Collection of functions used to handle eZMetaTag datatype
  \version 1.0
  \date    Vendredi 18 Mai 2007 10:21:22 am
  \author  Alexandre Nion
  \author  Samuel Grau
*/
class MetatagFunctionCollection
{
	/**
	 * Return the tags for a given node id or null if it fails
	 *
	 * @param integer $nodeID
	 * @return
	 */
	static function fetchTagsByNodeID( $iNodeID , $view_parameters = array())
	{
		return ( ( is_numeric( $iNodeID ) ) ? MetatagFunctionCollection::fetchTagsByContentObject( eZContentObject::fetchByNodeID( $iNodeID ) , $view_parameters ) : null );
	}

	/**
	 * Enter description here...
	 *
	 * @param unknown_type $oObject
	 * @return unknown
	 */
	static function fetchTagsByContentObject( $oObject , $view_parameters )
	{
		// Prevent from request on a non-existent object
		if ( ! ( $oObject instanceof eZContentObject ) )
		{
			return NULL;
		}

		$oIni                   = eZINI::instance( "metatag.ini" );

		$oObjectClassIdentifier	= $oObject->contentClassIdentifier();
		$oObjectDataMap			= $oObject->dataMap();


		/*
		 * 	Recherche des attribute mapping avec parameters
		 */
		$attributesMappings 	= MetatagFunctionCollection::getAttributesMappingWithViewParameters( $oObjectClassIdentifier ,  $view_parameters);


//		$attributesMappings 	= MetatagFunctionCollection::getAttributesMapping( $oObjectClassIdentifier );
        $nameAttributes 		= $attributesMappings['name'];
        $descriptionAttributes	= $attributesMappings['description'];
        $keywordsAttributes		= $attributesMappings['keywords'];
        $metaAttributes			= $attributesMappings['meta'];
        $namePattern			= $attributesMappings['namePattern'];
        $descriptionPattern		= $attributesMappings['descriptionPattern'];
        $keywordsPattern		= $attributesMappings['keywordsPattern'];
        $sizeLimit				= $attributesMappings['sizeLimit'];
        $autowash				= false;
        $metatagOnlyMapping		= false;

        if(isset($view_parameters['offset']) && $view_parameters['offset']  !=0)
        {
        	$namePattern .= ', page '.$view_parameters['offset'];
        }

        $name			= NULL;
		$description	= NULL;
		$keywords		= NULL;
		// We check that the attribute is defined
		if( !$oIni->hasVariable( 'AttributesMapping', 'MetatagAttributeIdentifier' ) )
		{
			eZDebug::writeError( "Configuration is incomplete, MetatagAttributeIdentifier is not defined in metatag.ini" , 'MetatagFunctionCollection::fetchTagsByContentObject' );
			return NULL;
		}

		// Checking preferences
		if( $oIni->hasVariable( 'MetatagSettings', 'Autowash' ) && $oIni->variable( 'MetatagSettings', 'Autowash' ) === 'enabled' )
			$autowash	= true;
		if( $oIni->hasVariable( 'AttributesMapping', "MetatagOnlyMapping") && in_array( $oObjectClassIdentifier, $oIni->variable( 'AttributesMapping', "MetatagOnlyMapping" ) ) )
			$metatagOnlyMapping	= true;


		$metaAttribute		= $oIni->variable( 'AttributesMapping', 'MetatagAttributeIdentifier' );
		$tag				= NULL;
		$tagAttributeExists	= array_key_exists( $metaAttribute, $oObjectDataMap ) && ( $oObjectDataMap[$metaAttribute] instanceof eZContentObjectAttribute );
		if( $tagAttributeExists )
		{
			$attribute	= $oObjectDataMap[$metaAttribute];

			$attributeResult = unserialize($attribute->toString());
			if($attributeResult['name'] != '')
			{
				return array( 'result'=> $attributeResult);
			}
			else
			{
				$tagAttributeExists = false;
			}
		}
		else
		{
			eZDebug::writeNotice( "Tag attribute '".$metaAttribute."' doesn't exist in object ".$oObject->attribute( 'id' ).", mapping is using cascading fallback instead.", "MetatagFunctionCollection::fetchTagsByContentObject" );
		}
		if( $tagAttributeExists === true && $tag->hasName() === true )
		{
			$name = $tag->getName();
		}
		elseif( !$metatagOnlyMapping )
		{
			// We check for a pattern defined
			if( isset( $namePattern ) )
			{
				$name = MetatagFunctionCollection::extractPattern( $namePattern, $oObjectDataMap, $sizeLimit );
			}
			else
			{
				foreach( $nameAttributes as $nameAttribute )
				{
					if( isset( $oObjectDataMap[$nameAttribute] ) && $oObjectDataMap[$nameAttribute]->hasContent() )
					{
						$name = eZMetaTag::getTextValueOfAttribute( $oObjectDataMap[$nameAttribute] );
						break;
					}
				}
			}
		}

		if( $tagAttributeExists === true && $tag->hasDescription() === true )
		{
			$description = $tag->getDescription();
		}
		elseif( !$metatagOnlyMapping )
		{
			if( isset( $descriptionPattern ) )
			{
				$description = MetatagFunctionCollection::extractPattern( $descriptionPattern, $oObjectDataMap, $sizeLimit );
			}
			else
			{
				foreach( $descriptionAttributes as $descriptionAttribute )
				{
					if( isset( $oObjectDataMap[$descriptionAttribute] )  &&  $oObjectDataMap[$descriptionAttribute]->hasContent() )
					{
						$description = eZMetaTag::getTextValueOfAttribute( $oObjectDataMap[$descriptionAttribute] );
						break;
					}
				}
			}
		}

		if( $tagAttributeExists === true && $tag->hasKeywords() === true )
		{
			$keywords = $tag->getKeywords();
		}
		elseif( !$metatagOnlyMapping )
		{
			if( isset( $keywordsPattern ) )
			{
				$keywords = MetatagFunctionCollection::extractPattern( $keywordsPattern, $oObjectDataMap, $sizeLimit );
			}
			else
			{
				foreach( $keywordsAttributes as $keywordsAttribute )
				{
					if( isset( $oObjectDataMap[$keywordsAttribute] ) && $oObjectDataMap[$keywordsAttribute]->hasContent() )
					{
						$keywords = eZMetaTag::getTextValueOfAttribute( $oObjectDataMap[$keywordsAttribute] );
						break;
					}
				}
			}
		}

		if( $autowash === true )
		{
			if( !is_null( $name ) )
				$name			= htmlentities( $name );
			if( !is_null( $description ) )
				$description	= htmlentities( $description );
			if( !is_null( $keywords ) )
				$keywords		= htmlentities( $keywords );
		}


        $description = str_replace("\n", "" , $description );
        $description = substr($description ,0 , 290). ' ... ';

		return array( 'result'=>array( 'name'=>$name, 'description'=>$description, 'keywords'=>$keywords ));
	}

	static function extractPattern( $name, &$oObjectDataMap, $sizeLimit = false )
	{
		preg_match_all( "/\{[^\{]+\}/", $name, $dynamics );
		foreach( $dynamics[0] as $dynamic )
		{
			$patternAttribute	= substr( $dynamic, 1, strlen( $dynamic )-2 );
			if( $delimiterPosition = strpos( $patternAttribute, "." ) )
			{
				list( $relatedObject, $relatedAttribute ) = explode( '.', $patternAttribute );
				$relations			= $oObjectDataMap[$relatedObject]->value();
				$relatedNames		= array();
				foreach( $relations['relation_list'] as $relation )
				{
					$relatedObject = eZContentObject::fetch( $relation['contentobject_id'] );
					switch( $relatedAttribute )
					{
						case 'name':	$relatedNames[]	= & $relatedObject->name();
										break;
						default:		$relatedDataMap	= & $relatedObject->dataMap();
										if( is_object( $relatedDataMap[$relatedAttribute] ) && $relatedDataMap[$relatedAttribute]->hasContent() )
											$relatedNames[]	= eZMetaTag::getTextValueOfAttribute( $relatedDataMap[$relatedAttribute] );
										break;
					}
				}
				$dynamicValue	= implode( ', ', $relatedNames );
			}
			elseif( is_object( $oObjectDataMap[$patternAttribute] ) && $oObjectDataMap[$patternAttribute]->hasContent() )
				$dynamicValue	= eZMetaTag::getTextValueOfAttribute( $oObjectDataMap[$patternAttribute] );
			else
			{
				$siteIni = eZINI::instance();
				$siteMetaData = $siteIni->variable( 'SiteSettings' , 'MetaDataArray' );

				// Special Cases with reserved keywords
				switch( $dynamic )
				{
					case 'SiteMetaName':
					$dynamicValue = $siteMetaData['title'];
					break;

					case 'SiteMetaDescription':
					$dynamicValue = $siteMetaData['description'];
					break;

					case 'SiteMetaKeywords':
					$dynamicValue = $siteMetaData['keywords'];
					break;

					default:
					// Attribute display is disabled to avoid subversious display when attribute doesn't exist
					$dynamicValue	= '';
					break;
				}
			}

			if( $sizeLimit && count( $dynamicValue )>$sizeLimit )
			{
				$dynamicValue	= substr( $dynamicValue, 0, $sizeLimit );
				$pos = strrpos( $dynamicValue, " " );
				if( $pos>0 )
				{
					$dynamicValue	= substr( $dynamicValue, 0, $pos);
				}
				unset( $pos );
			}
			$name = str_replace( $dynamic, $dynamicValue, $name );
		}
		return $name;
	}

	/*	Ajout pour les view parameters */
	static function getAttributesMappingWithViewParameters($oObjectClassIdentifier , $view_parameters)
	{
		$oIni	= eZINI::instance( "metatag.ini" );
        if ( !$oIni->hasGroup( 'AttributesMapping' ) )
        {
            eZDebug::writeNotice( 'metatag.ini AttributesMapping is not defined', 'MetatagFunctionCollection::getAttributesMapping' );
            return array();
        }


        $specialMapping = $oIni->variable( 'AttributesMapping' , 'SpecialMapping' );

        // On cherche les mappings qui peuvent correspondre
		$selected_mapping = $oObjectClassIdentifier;
        foreach($view_parameters as $key => $value)
        {
        	$view_parameters_key = "$key=$value";
        	foreach($specialMapping as $mapping)
        	{
				  if(  strpos($mapping,$view_parameters_key ) !==false && strpos($mapping,$oObjectClassIdentifier )!==false )
				  {
				  	$selected_mapping = $mapping;
				  }
        	}
        }
		return MetatagFunctionCollection::getAttributesMapping( $selected_mapping );

	}

	static function getAttributesMapping( $oObjectClassIdentifier )
	{
		$oIni	= eZINI::instance( "metatag.ini" );
        if ( !$oIni->hasGroup( 'AttributesMapping' ) )
        {
            eZDebug::writeNotice( 'metatag.ini AttributesMapping is not defined', 'MetatagFunctionCollection::getAttributesMapping' );
            return array();
        }

		$nameAttributes 		= NULL;
		$descriptionAttributes	= NULL;
		$keywordsAttributes		= NULL;
		$metaAttributes			= NULL;
		$namePattern			= NULL;
		$descriptionPattern		= NULL;
		$keywordsPattern		= NULL;
		$sizeLimit				= false;
        $disableMapping      = array();
        if ( $oIni->hasVariable( 'AttributesMapping', "DisableMapping" ) )
            $disableMapping     = $oIni->variable( 'AttributesMapping', "DisableMapping" );


		// Checks if mapping has been disabled for this attribute
		if( in_array( $oObjectClassIdentifier, $disableMapping ) )
	        return array();

		if( $oIni->hasVariable( 'AttributesMapping', "SpecialMapping" ) && in_array( $oObjectClassIdentifier, $oIni->variable( 'AttributesMapping', "SpecialMapping" ) ) )
        {
        	// Render the name, pattern is checked before
			if( $oIni->hasVariable( $oObjectClassIdentifier, "NamePattern" ) )
				$namePattern = $oIni->variable( $oObjectClassIdentifier, "NamePattern" );
			if( $oIni->hasVariable( $oObjectClassIdentifier, "Name" ) )
        		$nameAttributes = $oIni->variable( $oObjectClassIdentifier, "Name" );
			else
        		$nameAttributes = $oIni->variable( 'AttributesMapping', "DefaultName" );

			if( $oIni->hasVariable( $oObjectClassIdentifier, "DescriptionPattern" ) )
				$descriptionPattern = $oIni->variable( $oObjectClassIdentifier, "DescriptionPattern" );
        	if( $oIni->hasVariable( $oObjectClassIdentifier, "Description" ) )
        		$descriptionAttributes = $oIni->variable( $oObjectClassIdentifier, "Description" );
        	else
        		$descriptionAttributes = $oIni->variable( 'AttributesMapping', "DefaultDescription" );

        	// Render the keywords mapping
			if( $oIni->hasVariable( $oObjectClassIdentifier, "KeywordsPattern" ) )
				$keywordsPattern = $oIni->variable( $oObjectClassIdentifier, "KeywordsPattern" );
        	if( $oIni->hasVariable( $oObjectClassIdentifier, "Keywords" ) )
        		$keywordsAttributes = $oIni->variable( $oObjectClassIdentifier, "Keywords" );
        	else
        		$keywordsAttributes = $oIni->variable( 'AttributesMapping', "DefaultKeywords" );

        	if( $oIni->hasVariable( $oObjectClassIdentifier, "MetaTagAttributeIdentifier" ) )
				$metaAttributes = $oIni->variable( $oObjectClassIdentifier, "MetaTagAttributeIdentifier" );
			else
				$metaAttributes = $oIni->variable( 'AttributesMapping', "MetatagAttributeIdentifier" );

			if( $oIni->hasVariable( $oObjectClassIdentifier, 'AttributeSizeLimit' ) )
				$sizeLimit	= $oIni->variable( $oObjectClassIdentifier, 'AttributeSizeLimit' );
			elseif( $oIni->hasVariable( 'AttributesMapping', 'AttributeSizeLimit' ) )
				$sizeLimit	= $oIni->variable( 'AttributesMapping', 'AttributeSizeLimit' );
        }
        else
        {
        	$nameAttributes			= $oIni->variable( 'AttributesMapping', "DefaultName" );
        	$descriptionAttributes	= $oIni->variable( 'AttributesMapping', "DefaultDescription" );
        	$keywordsAttributes		= $oIni->variable( 'AttributesMapping', "DefaultKeywords" );
        	$metaAttributes			= $oIni->variable( 'AttributesMapping', "MetatagAttributeIdentifier" );
        	if( $oIni->hasVariable( 'AttributesMapping', 'AttributeSizeLimit' ) )
				$sizeLimit	= $oIni->variable( 'AttributesMapping', 'AttributeSizeLimit' );
        }


        return array( 'name'=>$nameAttributes, 'description'=>$descriptionAttributes, 'keywords'=>$keywordsAttributes, 'meta'=>$metaAttributes,
        				'namePattern'=>$namePattern, 'descriptionPattern'=>$descriptionPattern, 'keywordsPattern'=>$keywordsPattern,
        				'sizeLimit'=>$sizeLimit );
	}
}
?>