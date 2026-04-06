<?php

namespace Drupal\capital_azur\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Form\FormStateInterface;

/**
 * Capital Azur Header block.
 *
 * @Block(
 *   id = "capital_azur_header",
 *   admin_label = @Translation("Capital Azur - Header"),
 *   category = @Translation("Capital Azur"),
 * )
 */
class CapitalAzurHeaderBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'menu_id'   => 'main',
      'cta_title' => 'Banque Digitale',
      'cta_url'   => '#',
      'logo_url'  => '',
      'site_name' => 'Capital Azur',
      'tagline'   => 'Votre satisfaction, notre passion',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    $config = $this->getConfiguration();

    $form['logo_url'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Logo URL'),
      '#description'   => $this->t('Absolute or relative URL to the logo image.'),
      '#default_value' => $config['logo_url'],
    ];

    $form['site_name'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Site Name'),
      '#default_value' => $config['site_name'],
    ];

    $form['tagline'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Tagline'),
      '#default_value' => $config['tagline'],
    ];

    $form['menu_id'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Menu machine name'),
      '#description'   => $this->t('Machine name of the navigation menu. Default: main'),
      '#default_value' => $config['menu_id'],
    ];

    $form['cta_title'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('CTA Button Label'),
      '#default_value' => $config['cta_title'],
    ];

    $form['cta_url'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('CTA Button URL'),
      '#default_value' => $config['cta_url'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['logo_url']  = $form_state->getValue('logo_url');
    $this->configuration['site_name'] = $form_state->getValue('site_name');
    $this->configuration['tagline']   = $form_state->getValue('tagline');
    $this->configuration['menu_id']   = $form_state->getValue('menu_id');
    $this->configuration['cta_title'] = $form_state->getValue('cta_title');
    $this->configuration['cta_url']   = $form_state->getValue('cta_url');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();
    $logo_url = $config['logo_url'] ?: theme_get_setting('logo.url');

    return [
      '#theme'     => 'capital_azur_header',
      '#logo_url'  => $logo_url,
      '#site_name' => $config['site_name'],
      '#tagline'   => $config['tagline'],
      '#menu_id'   => $config['menu_id'] ?: 'main',
      '#cta_title' => $config['cta_title'],
      '#cta_url'   => $config['cta_url'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    return Cache::PERMANENT;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags() {
    return Cache::mergeTags(parent::getCacheTags(), ['config:system.menu.' . ($this->getConfiguration()['menu_id'] ?: 'main')]);
  }

}
