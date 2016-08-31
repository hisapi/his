<?php

$searchterm1="";
if ( isset($_POST['search1']) )
{
	$searchterm1=$_POST['search1'];
}
$searchterm2="";
if ( isset($_POST['search2']) )
{
	$searchterm2=$_POST['search2'];
}
$searchterm3="";
if ( isset($_POST['search3']) )
{
	$searchterm3=$_POST['search3'];
}
$searchterm4="";
if ( isset($_POST['search4']) )
{
	$searchterm4=$_POST['search4'];
}

if ( isset($_POST['btnSearch']) )
{
	$fullsearchstr="?s=";
	$tagstr="";
	$db_search_term="";
	$search_term=array();
	if ( strlen($searchterm1)>0 )
	{
		$search_term[]=$searchterm1;
	}
	if ( strlen($searchterm2)>0 )
	{
		$search_term[]=$searchterm2;
	}
	if ( strlen($searchterm3)>0 )
	{
		$search_term[]=$searchterm3;
	}
	if ( strlen($searchterm4)>0 )
	{
		$search_term[]=$searchterm4;
	}


	echo "<h4 style='display:inline;'>";
	echo getTranslation("Search Results",$settings);
	echo "</h4>";
	echo "<br/>";
	echo "<br/>";

	$hfs = new hf_id_user();
	$all_hfs = $hfs->get_from_hashrange($u->id_user);
	$selected_hfs = array();
	if ($all_hfs)
	{
		foreach ($all_hfs as $ahf)
		{
			$found_all=true;
			foreach ($search_term as $search_item)
			{
				if ( strpos( strtolower($ahf['name']), strtolower($search_item) )===false )
				{
					$found_all = false;
					break;
				}
			} // foreach
			/*
			if (!$found_all)
			{
				// check tags
				$tagcheck_hf = new hf_id_user();
				$tagcheck_hf->set($ahf);
				$tagcheck_hf->build();
				$found_all=false;
				foreach ($search_term as $search_item)
				{
					foreach ($tagcheck_hf->obj_hf_tags as $tag)
					{
						$tag_value = $tag->obj_tag->body;
						if ( strpos( strtolower($ahf['name']), strtolower($search_item) )===false )
						{
							$found_all = false;
							break;
						}
					} // foreach
					if (!$found_all)
					{
						break;
					}
				} // foreach
			}
			*/
			if ($found_all)
			{
				$selected_hfs[] = $ahf;
			} // end if
		} // foreach
	}

	$idx=0;
	foreach ($search_term as $a_search_term)
	{
		$div1=",";
		if ($idx==0)
		{
			$div1="";
		}
		$tagstr=$tagstr.$div1.$a_search_term;
		$idx=$idx+1;
	} // foreach


	echo "<ul>";

		echo "<table style='padding-left:40px;' border='0'>";

		echo "<tr>";
		echo "<td>";
		echo "<b>";
		echo getTranslation("Function ID",$settings);
		echo "</b>";
		echo "</td>";
		echo "<td>";
		echo "<b>";
		echo getTranslation("Name",$settings);
		echo "</b>";
		echo "</td>";
		//echo "<td>";
		//echo "<b>Tags</b>";
		//echo "</td>";
		echo "</tr>";


	if ($selected_hfs)
	{
		if ( count($selected_hfs)>0 )
		{
			foreach ($selected_hfs as $shfs)
			{
				echo "<tr>";
				echo "<td style='padding-right:30px;'>";
				echo $shfs['id'];
				echo "</td>";
				echo "<td>";
				//echo "<pre>";
				//print_r($shfs);
				echo $shfs['name'];
				echo "</td>";
				echo "</tr>";
			}
		}
		else
		{
			echo "<tr><td colspan='3'>No tags matched your search terms.</td></tr>";
		}
	}
	else
	{
		echo "<tr><td colspan='3'>No tags matched your search terms.</td></tr>";
	}
	echo "</table>";
	echo "<br/>";
	echo "</ul>";



	$fullsearchstr=$fullsearchstr.$tagstr;

	$tag_url=$this_server_url."/".$fullsearchstr;

	if ( count($selected_hfs)>0)
	{

	echo "<h4 style='display:inline;'>";
	echo getTranslation("Hyperlinks for Integration",$settings);
	echo "</h4>";
	echo "<br/>";

	echo "<ul>";

	echo getTranslation("Use the URLs below to repeat this search.",$settings);
	echo "<br/>";
	echo getTranslation("All variations of these URLs will treat the first result returned as the selected HIS Function.",$settings);
	echo "<br/>";
	echo "<br/>";

	echo "</ul>";

	echo "<h4 style='display:inline;'>";
	echo getTranslation("View HIS Function Edit Interface",$settings);
	echo "</h4>";
	echo "<br/>";
	echo "<ul>";
	echo "<a href='$tag_url'><u>$tag_url</u></a>";
	echo "</ul>";
	echo "<br/>";

	echo "<h4 style='display:inline;'>";
	echo getTranslation("Live Variations returning raw data (Remote resources acquired, live HIS resource collection occurs)",$settings);
	echo "</h4>";
	echo "<br/>";
	echo "<h4 style='display:inline;'>";
	echo getTranslation("Useful for Integration - Returns Raw Data",$settings);
	echo "</h4>";
	echo "<br/>";
	echo "<br/>";

	echo "<ul>";
	echo getTranslation("live his-xml version of this search",$settings);
	echo "<br/>";
	echo "<a target='_new' href='$tag_url&xml&remote'>";
	echo "$tag_url&xml&remote";
	echo "</a>";
	echo "<br/>";
	echo "<br/>";
	
	echo getTranslation("live his-xml short version of this search",$settings);
	echo "<br/>";
	echo "<a target='_new' href='$tag_url&xml&short&remote'>";
	echo "$tag_url&xml&short&remote";
	echo "</a>";
	echo "<br/>";
	echo "<br/>";
	
	echo getTranslation("live download your customized-format output",$settings);
	echo "<br/>";
	echo "<a target='_new' href='$tag_url&cxml&remote'>";
	echo "$tag_url&cxml&remote";
	echo "</a>";
	echo "<br/>";
	echo "<br/>";
	
	echo "<br/>";
	echo "</ul>";
	
	echo "<h4 style='display:inline;'>";
	echo getTranslation("Non-Live Variations returning raw data (Use cached content, no job servers or associated remote content contacted)",$settings);
	echo "</h4>";
	echo "<br/>";
	echo "<h4 style='display:inline;'>";
	echo getTranslation("Useful for Integration - Returns Raw Data",$settings);
	echo "</h4>";
	echo "<br/>";
	echo "<br/>";
	echo "<ul>";
	echo getTranslation("non-live his-xml version of this search",$settings);
	echo "<br/>";
	echo "<a target='_new' href='$tag_url&xml'>";
	echo "$tag_url&xml";
	echo "</a>";
	echo "<br/>";
	echo "<br/>";
	
	echo getTranslation("non-live his-xml short version of this search",$settings);
	echo "<br/>";
	echo "<a target='_new' href='$tag_url&short&xml'>";
	echo "$tag_url&short&xml";
	echo "</a>";
	echo "<br/>";
	echo "<br/>";
	
	echo getTranslation("non-live download your customized-format output",$settings);
	echo "<br/>";
	echo "<a target='_new' href='$tag_url&cxml'>";
	echo "$tag_url&cxml";
	echo "</a>";
	echo "<br/>";
	echo "<br/>";
	
	echo getTranslation("non-live download your customized-format output, but use cached pre-approved input resource data as input",$settings); 
	echo "<br/>";
	echo "<a target='_new' href='$tag_url&cxml&use_approved=yes'>";
	echo "$tag_url&cxml&use_approved=yes";
	echo "</a>";
	echo "<br/>";
	echo "<br/>";
	echo "</ul>";


	echo "<br/>";
	echo "<br/>";

}


} // end if (search done)

echo "</ul>";
echo "</a>";

echo "<a name='tagsearch'></a>";
echo "<h3>";
echo getTranslation("Function Search",$settings);
echo "</h3>";
echo "<ul>";

echo "\n";
echo getTranslation("Search Terms (A and B and C and D):",$settings);
echo "<ul>";
echo "<form action='?v=find-hf' method='post'>";
echo "<input type='text' style='background-color:".rcolor().";display:inline;' name='search1' value='".htmlentities($searchterm1,ENT_NOQUOTES)."'/>";
echo "<input type='text' style='background-color:".rcolor().";display:inline;' name='search2' value='".htmlentities($searchterm2,ENT_NOQUOTES)."'/>";
echo "<br/>";
echo "<input type='text' style='background-color:".rcolor().";display:inline;' name='search3' value='".htmlentities($searchterm3,ENT_NOQUOTES)."'/>";
echo "<input type='text' style='background-color:".rcolor().";display:inline;' name='search4' value='".htmlentities($searchterm4,ENT_NOQUOTES)."'/>";
echo "<br/>";
echo "<input type='submit' name='btnSearch' value='".getTranslation('Search',$settings)."' style='background-color:".rcolor().";display:inline;'>";
echo "</form>";


echo "<br/>";
echo "<br/>";
echo getTranslation("Pure URL-style submission of this search (when called from your mobile app codes, for example), would look like:",$settings);
echo "<br/>";
echo "<br/>";
echo "<ul>";
echo "<a href='$this_server_url/?s=facebook,likes'>$this_server_url/?s=facebook,likes</a>";
echo "</ul>";
echo "<br/>";
echo "<br/>";

echo "</ul>";


echo "<h3>".getTranslation("Tag Cloud",$settings)."</h3>";
echo "<ul>";
echo "<img src='images/tagcloud.png'/>";
echo "</ul>";

echo "</ul>";

?>