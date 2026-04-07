<?php

namespace Drupal\capital_azur\Plugin\vactory_dynamic_field\Platform;

use Drupal\vactory_dynamic_field\VactoryDynamicFieldPluginBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Capital Azur platform provider plugin.
 *
 * @PlatformProvider(
 *   id = "capital_azur",
 *   title = @Translation("Capital Azur")
 * )
 */
class CapitalAzur extends VactoryDynamicFieldPluginBase {

  /**
   * Extension path resolver service.
   *
   * @var \Drupal\Core\Extension\ExtensionPathResolver
   */
  protected $extensionPathResolver;

  /**
   * {@inheritDoc }
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance = parent::create($container, $configuration, $plugin_id, $plugin_definition);
    $instance->extensionPathResolver = $container->get('extension.path.resolver');
    $instance->setWidgetsPath($instance->extensionPathResolver->getPath('module', 'capital_azur') . '/widgets');
    return $instance;
  }

}
