<?php

require_once 'ypb.civix.php';

/**
 * Implements hook_civicrm_custom().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_custom
 */
function ypb_civicrm_custom( $op, $groupID, $entityID, &$params ) {
  if ( $op != 'create' && $op != 'edit' ) {
    return;
  }
  // $groupID == 1 is the "Donor Info" custom group.
  if($groupID == 1) {
    foreach($params as $field) {
      // custom field 41 is "YPB contact".
      if($field['custom_field_id'] == 41 && $field['value']) {
        // If it's not blank, check if a relationship exists.
        $result = civicrm_api3('Relationship', 'getcount', array(
          'sequential' => 1,
          'contact_id_a' => $entityID,
          'contact_id_b' => $field['value'],
          'relationship_type_id' => 11,
        ));
        // If not, create the relationship.
        if($result == 0) {
          $result = civicrm_api3('Relationship', 'create', array(
            'sequential' => 1,
            'contact_id_a' => $entityID,
            'contact_id_b' => $field['value'],
            'relationship_type_id' => 11, //Automatically Soft Credit
          ));
        }
      }
    }
  }
}
/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function ypb_civicrm_config(&$config) {
  _ypb_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function ypb_civicrm_xmlMenu(&$files) {
  _ypb_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function ypb_civicrm_install() {
  _ypb_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function ypb_civicrm_uninstall() {
  _ypb_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function ypb_civicrm_enable() {
  _ypb_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function ypb_civicrm_disable() {
  _ypb_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function ypb_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _ypb_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function ypb_civicrm_managed(&$entities) {
  _ypb_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function ypb_civicrm_caseTypes(&$caseTypes) {
  _ypb_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function ypb_civicrm_angularModules(&$angularModules) {
_ypb_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function ypb_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _ypb_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function ypb_civicrm_preProcess($formName, &$form) {

}

*/
