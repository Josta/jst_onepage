<?php

namespace Josta\JstOnepage\Hook;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Page\PageRepository;

class OnepageHooks {

	/**
	 * Called by IconFactory. Injects new page icons depending on template.
	 */
	public function getPageIcon(&$params, &$ref) {
		
		// find template class
		$icon = 'apps-pagetree-';
		$pagelayout = $this->getPageLayout($params['row']);
		if ($pagelayout == 'pagets__jst_onepage_section') {
			$icon .= 'jst-onepage-section';
		} else if ($pagelayout == 'pagets__jst_onepage') {
			$icon .= 'jst-onepage';
		} else if ($pagelayout == 'pagets__jst_onepage_page') {
			$icon .= 'jst-onepage-page';
		} else {
			return '';
		}
		
		// find modifiers
		if ((int)$params['row']['nav_hide'] > 0) {
			$icon .= '-hideinmenu';
		}
		
		return $icon;
	}

	/**
	 * Called by RealUrl Encoder. Modifies links to sections to refer to a hash link.
	 */
	public function postProcessLinks(&$params, &$ref) {
		$this->removeTrailingSlash($params);
		$this->convertSectionLinks($params);
	}

	
	
	
	
	private function removeTrailingSlash(&$params) {
		$regex = '~^([^\?\#]+)/((\?|\#).*)?$~';  // path + / + optional query	
		$params['URL'] = preg_replace($regex, '$1$2', $params['URL']);
	}

	private function convertSectionLinks(&$params) {
		$pagelayout = $this->getPageLayout($params['params']['args']['page']);
		if ($pagelayout == 'pagets__jst_onepage_section') {
			$params['URL'] = $this->str_lreplace('/', "#", $params['URL']);
		}
	}
		
	private function str_lreplace($search, $replace, $subject) {
		$pos = strrpos($subject, $search);
		if($pos !== false) {
			$subject = substr_replace($subject, $replace, $pos, strlen($search));
		} else {
			$subject = $replace . $subject;
		}
		return $subject;
	}
	
	/**
	 * Returns the page layout for the given page.
	 * Code copied from ContentObjectRenderer->getData() and slightly modified
	 */
	private function getPageLayout($page_fields) {
		// Check if the current page has a value in the DB field "backend_layout"
		// if empty, check the root line for "backend_layout_next_level"
		// same as
		//   field = backend_layout
		//   ifEmpty.data = levelfield:-2, backend_layout_next_level, slide
		//   ifEmpty.ifEmpty = default
		$retVal = $page_fields['backend_layout'];

		// If it is set to "none" - don't use any
		if ($retVal === '-1') {
			$retVal = 'none';
		} elseif ($retVal === '' || $retVal === '0') {
			// If it not set check the root-line for a layout on next level and use this
			// Remove first element, which is the current page
			// See also \TYPO3\CMS\Backend\View\BackendLayoutView::getSelectedCombinedIdentifier()
			$pageRepository = GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
			$pageRepository->init(FALSE);
			$rootLine = $pageRepository->getRootline($page_fields['uid']);
			array_shift($rootLine);
			foreach ($rootLine as $rootLinePage) {
				$retVal = (string) $rootLinePage['backend_layout_next_level'];
				// If layout for "next level" is set to "none" - don't use any and stop searching
				if ($retVal === '-1') {
					$retVal = 'none';
					break;
				} elseif ($retVal !== '' && $retVal !== '0') {
					// Stop searching if a layout for "next level" is set
					break;
				}
			}
		}
		if ($retVal === '0' || $retVal === '') {
			$retVal = 'default';
		}
		return $retVal;
	}

}
