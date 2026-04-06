<?php

namespace Drupal\capital_azur\Plugin\vactory_dynamic_field\Platform;

use Drupal\vactory_dynamic_field\VactoryDynamicFieldPluginBase;

/**
 * Capital Azur platform provider plugin.
 *
 * @PlatformProvider(
 *   id = "capital_azur",
 *   title = @Translation("Capital Azur")
 * )
 */
class CapitalAzur extends VactoryDynamicFieldPluginBase {

  public function __construct(array $configuration, $plugin_id, $plugin_definition, $widgetsPath) {
    parent::__construct(
      $configuration,
      $plugin_id,
      $plugin_definition,
      \Drupal::service('extension.path.resolver')->getPath('module', 'capital_azur') . '/widgets'
    );
  }

}
