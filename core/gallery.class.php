<?php


/*
* Project:		EQdkp-Plus
* License:		Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
* Link:			http://creativecommons.org/licenses/by-nc-sa/3.0/
* -----------------------------------------------------------------------
* Began:		2010
* Date:			$Date: 2013-01-29 17:35:08 +0100 (Di, 29 Jan 2013) $
* -----------------------------------------------------------------------
* @author		$Author: wallenium $
* @copyright	2006-2011 EQdkp-Plus Developer Team
* @link			http://eqdkp-plus.com
* @package		eqdkpplus
* @version		$Rev: 12937 $
*
* $Id: page_generic.class.php 12937 2013-01-29 16:35:08Z wallenium $
*/

if(!defined('EQDKP_INC')){
	die('Do not access this file directly.');
}

if(!class_exists('gallery')){
	class gallery extends gen_class {		
		public static $shortcuts = array('core', 'config', 'pdh', 'user', 'pfh', 'tpl', 'in');
		
		private $_cache = array();
		
		public function create($strFolder, $intSortation, $strPath, $intPageNumber  = 0){
			$strFolder = str_replace("*+*+*", "/", $strFolder);
			$strOrigFolder = $strFolder;
			//Subfolder navigation
			if ($this->in->get('gf') != "" && $this->in->get('gsf') != ""){
				if (base64_decode($this->in->get('gf')) == $strOrigFolder) $strFolder = base64_decode($this->in->get('gsf'));
			}
			
			
			$contentFolder = $this->pfh->FolderPath($strFolder, 'files');
			$contentFolderSP = $this->pfh->FolderPath($strFolder, 'files', 'serverpath');

			$dataFolder = $this->pfh->FolderPath('system', 'files', 'plain');
			$blnIsSafe = isFilelinkInFolder($contentFolder, $dataFolder);
			if (!$blnIsSafe) return "";
			
			$arrFiles = sdir($contentFolder);
			$arrDirs = $arrImages = $arrImagesDate = array();
			foreach($arrFiles as $key => $val){
				if (is_dir($contentFolder.$val)){
					$arrDirs[] = $val;
				} else {
					$extension = strtolower(pathinfo($val, PATHINFO_EXTENSION));
					if (in_array($extension, array('jpg', 'png', 'gif', 'jpeg'))){
						$arrImages[$val] = pathinfo($val, PATHINFO_FILENAME);
						$arrImageDimensions[$val] = getimagesize($contentFolder.$val);
						if ($intSortation == 2 || $intSortation == 3) $arrImagesDate[$val] = filemtime($contentFolder.$val);
					}
				}
			}

			switch($intSortation){
				case 1: natcasesort($arrImages);
						$arrImages = array_reverse($arrImages);
				
				break;
				case 2: asort($arrImagesDate); $arrImages = $arrImagesDate;
				break;
				
				case 3: arsort($arrImagesDate); $arrImages = $arrImagesDate;
				break;
				
				default: natcasesort($arrImages);
			}
			
			$strOut = '<ul class="image-gallery">';
			$strLink = $strPath.(($intPageNumber > 1) ? '&page='.$intPageNumber : '');
			
			if($this->in->exists('gsf') && $this->in->get('gsf') != ''){
				$arrPath = array_filter(explode('/', $strFolder));
				array_pop($arrPath);
				$strFolderUp = implode('/', $arrPath);
				if ($strFolderUp == $strOrigFolder) {
					$strFolderUp = '';
				} else {
					$strFolderUp = base64_encode($strFolderUp);
				}
				$strOut .='<li class="folderup"><a href="'.$strLink.'&gf='.base64_encode($strOrigFolder).'&gsf='.$strFolderUp.'"><i class="icon-level-up icon-flip-horizontal"></i><br>'.$this->user->lang('back').'</a></li>';
			}
			
			natcasesort($arrDirs);
			foreach($arrDirs as $foldername){				
				$strOut .= '<li class="folder"><a href="'.$strLink.'&gf='.base64_encode($strOrigFolder).'&gsf='.base64_encode($strFolder.'/'.$foldername).'">'.sanitize($foldername).'</a></li>';
			}
			
			$strThumbFolder = $this->pfh->FolderPath('system/thumbs', 'files');
			$strThumbFolderSP = $this->pfh->FolderPath('system/thumbs', 'files', 'serverpath');
			
			foreach($arrImages as $key => $val){
				//Check for thumbnail
				$strThumbname = "thumb_".pathinfo($key, PATHINFO_FILENAME)."-150x150.".pathinfo($key, PATHINFO_EXTENSION);
				$strThumbnail = "";
				if (is_file($strThumbFolder.$strThumbname)){
					$strThumbnail = $strThumbFolderSP.$strThumbname;
				} else {
					//Create thumbnail
					$this->pfh->thumbnail($contentFolder.$key, $strThumbFolder, $strThumbname, 150);
					if (is_file($strThumbFolder.$strThumbname)){
						$strThumbnail = $strThumbFolderSP.$strThumbname;
					}
				}
								
				if($strThumbnail != ""){
					$strOut .= '<li class="image"><a href="'.$contentFolderSP.$key.'" class="lightbox_'.md5($strFolder).'" rel="'.md5($strFolder).'" title="'.sanitize($key).'; '.$arrImageDimensions[$key][0].'x'.$arrImageDimensions[$key][1].' px"><img src="'.$strThumbnail.'" alt="Image" /></a></li>';
				}
				
			}

			$strOut .= "</ul><div class=\"clear\"></div>";
			
			$this->tpl->add_js(
				'$(".lightbox_'.md5($strFolder).'").colorbox({rel:"'.md5($strFolder).'", width:"90%", height:"90%", slideshow: true, slideshowAuto:false, transition:"fade", slideshowSpeed:4500});', 'docready'
			);
			
			return $strOut;
		}
		
		public function raidloot($intRaidID){
			//Get Raid-Infos:
			$intEventID = $this->pdh->get('raid', 'event', array($intRaidID));
			if ($intEventID){
				$strOut = '<div class="raidloot"><h3>'.$this->user->lang('loot').' '.$this->pdh->get('event', 'html_icon', array($intEventID)).$this->pdh->get('raid', 'html_raidlink', array($intRaidID, 'viewraid.php', ''));
				$strRaidNote = $this->pdh->get('raid', 'html_note', array($intRaidID));
				if ($strRaidNote != "") $strOut .= ' ('.$strRaidNote.')';
				$strOut .= ', '.$this->pdh->get('raid', 'html_date', array($intRaidID)).'</h3>';
				
				//Get Items from the Raid
				$arrItemlist = $this->pdh->get('item', 'itemsofraid', array($intRaidID));
				infotooltip_js();
				
				if (count($arrItemlist)){
					foreach($arrItemlist as $item){
						$buyer = $this->pdh->get('item', 'buyer', array($item));
						$strOut .=  $this->pdh->get('item', 'link_itt', array($item, 'viewitem.php')). ' - 
						<a href="'.$this->root_path.'viewcharacter.php'.$this->SID.'&amp;member_id='.$buyer.'">'.$this->pdh->get('member', 'html_name', array($buyer)).'</a>,
						'.round($this->pdh->get('item', 'value', array($item))).' '.$this->config->get('dkp_name').'<br />';
					}
					
				} else {
					return '';
				}
				
				
				return $strOut.'</div>';
			}
			return '';
		}

	}
}
?>