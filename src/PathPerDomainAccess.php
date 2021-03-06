<?php

namespace Drupal\pathperdomain;

use Drupal\Core\Access\AccessResult; 
use Drupal\Core\Routing\RouteMatch; 
/**use
 * Custom access control handler for the domain path page.
 */
class PathPerDomainAccess {

	
  /**
   * Check if current path has alias
   *
   * @return \Drupal\Core\Access\AccessResult
   */
  public function access(RouteMatch $routMatcher = null) {
    $domain			= $routMatcher->getParameter('domain');
    $domain_current = \Drupal::service('domain.negotiator')->getActiveDomain();
    $current_path	= \Drupal::service('path.current')->getPath();
    $language		= \Drupal::languageManager()->getCurrentLanguage()->getId();

    $path_alias = \Drupal::service('path.alias_storage')->lookupPathAlias($current_path, $language);
	
    if ($domain === $domain_current->id() && $path_alias) {
      return AccessResult::allowed();
    } 
	
    return AccessResult::forbidden();
  }
}
