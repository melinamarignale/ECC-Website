<?php
$offset = 0;
$limit = 30;
$db = eZDB::instance();

$siteINI = eZINI::instance('site.ini');
$refINI = eZINI::instance('sitemap.ini');

$siteURL = $siteINI->variable('SiteSettings', 'SiteURL');


$ClassFilterArray = $refINI->variable('SitemapSettings' , 'ClassFilterArray');
$ClassFilterType = $refINI->variable('SitemapSettings' , 'ClassFilterType');

print_r($ClassFilterType);


if($ClassFilterType != 'include' && $ClassFilterType != 'exclude')
{
	eZExecution::cleanExit();
}

$params = array(			 'ClassFilterType'          => $ClassFilterType,
                             'ClassFilterArray'         => $ClassFilterArray,
							 //'AsObject'					=> false
                             );

$count = eZContentObjectTreeNode::subTreeCountByNodeID($params , 2);


/* Clean de la base SQL */
$sql_truncate = "TRUNCATE TABLE `do_sitemap` ";
$db->query($sql_truncate);


$params['Limit'] = $limit;
while( $offset < $count)
{
	$params['Offset'] = $offset;
	$elements = eZContentObjectTreeNode::subTreeByNodeID($params , 2);

	foreach ($elements as $element)
	{
		$info = array();
		$info['dosm_loc'] = $siteURL.'/'.$element->url();
		$info['dosm_lastmod'] = date('Y-m-d', $element->object()->attribute('modified'));
		$info['dosm_changefreq'] = 'monthly';
		$info['dosm_priority'] = '1';
		$info['dosm_insertedDate'] = '';
		$info['dosm_updatedDate'] = date('Y-m-d',$element->object()->attribute('published'));

		$sql = doDBUtils::createInsertFromArray($info, 'do_sitemap');
		$db->query($sql);

	}
	eZContentObject::clearCache();
	$offset = $offset +  $limit;
}



/*	Creation d'un sitemap index et fichier sitemap */


$sitemap_index = '<?xml version="1.0" encoding="UTF-8"?>';
$sitemap_index .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

$limit = 40000;
$offset = 0;

$sql_count = "SELECT count(*) FROM do_sitemap ";
$sitemap_number = 1;
while( $offset < $count)
{

	$sitemap_file_name = 'sitemap_'.$sitemap_number.'.xml';
	$sql = "SELECT dosm_loc , dosm_lastmod , dosm_priority , dosm_changefreq FROM do_sitemap LIMIT $offset , $limit ";
	$results = $db->arrayQuery($sql);

	$sm = '<?xml version="1.0" encoding="UTF-8"?>';
	$sm .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	foreach( $results as $result)
	{
		$sm .= '<url>';
		$sm .= '<loc>'.$result['dosm_loc'].'</loc>';
		$sm .= '<lastmod>'.$result['dosm_lastmod'].'</lastmod>';
		$sm .= '<changefreq>'.$result['dosm_changefreq'].'</changefreq>';
		$sm .= '<priority>'.$result['dosm_priority'].'</priority>';
		$sm .= '</url>';
	}
	$sm .= '</urlset>';

	eZFile::create($sitemap_file_name , eZSys::storageDirectory().'/images/do_sitemap/' , $sm);

	$sitemap_index .= '<sitemap>';
	$sitemap_index .= '<loc>'.$siteURL.'/'.eZSys::storageDirectory().'/images/do_sitemap/'.$sitemap_file_name.'</loc>';
	$sitemap_index .= '</sitemap>';


	$offset = $offset +  $limit;
	$sitemap_number++;
}

$sitemap_index .= '</sitemapindex>';
eZFile::create('sitemap.xml' , eZSys::storageDirectory().'/images/do_sitemap/' , $sitemap_index);




?>