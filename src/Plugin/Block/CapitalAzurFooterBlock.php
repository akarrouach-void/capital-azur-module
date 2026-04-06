<?php

namespace Drupal\capital_azur\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Form\FormStateInterface;

/**
 * Capital Azur Footer block.
 *
 * @Block(
 *   id = "capital_azur_footer",
 *   admin_label = @Translation("Capital Azur - Footer"),
 *   category = @Translation("Capital Azur"),
 * )
 */
class CapitalAzurFooterBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'menu_id'      => 'footer',
      'copyright'    => '©2019 CAPITAL AZUR',
      'agency_text'  => 'Conception et développement',
      'agency_label' => 'VOID',
      'agency_url'   => '#',
      'linkedin_url'    => 'https://www.linkedin.com',
      'youtube_url'     => 'https://www.youtube.com',
      'twitter_url'     => 'https://twitter.com',
      'agency_logo_url' => '',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    $config = $this->getConfiguration();

    $form['menu_id'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Footer menu machine name'),
      '#description'   => $this->t('Machine name of the footer navigation menu. Default: footer'),
      '#default_value' => $config['menu_id'],
    ];

    $form['social'] = [
      '#type'  => 'details',
      '#title' => $this->t('Social Media Links'),
      '#open'  => TRUE,
    ];

    $form['social']['linkedin_url'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('LinkedIn URL'),
      '#default_value' => $config['linkedin_url'],
    ];

    $form['social']['youtube_url'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('YouTube URL'),
      '#default_value' => $config['youtube_url'],
    ];

    $form['social']['twitter_url'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Twitter / X URL'),
      '#default_value' => $config['twitter_url'],
    ];

    $form['bottom'] = [
      '#type'  => 'details',
      '#title' => $this->t('Bottom Bar'),
      '#open'  => TRUE,
    ];

    $form['bottom']['copyright'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Copyright Text'),
      '#default_value' => $config['copyright'],
    ];

    $form['bottom']['agency_text'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Agency Label'),
      '#default_value' => $config['agency_text'],
    ];

    $form['bottom']['agency_label'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Agency Name'),
      '#default_value' => $config['agency_label'],
    ];

    $form['bottom']['agency_url'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Agency URL'),
      '#default_value' => $config['agency_url'],
    ];

    $form['bottom']['agency_logo_url'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Agency Logo URL'),
      '#description'   => $this->t('URL to the agency logo image (leave empty to show text label instead).'),
      '#default_value' => $config['agency_logo_url'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['menu_id']     = $form_state->getValue('menu_id');
    $this->configuration['linkedin_url'] = $form_state->getValue(['social', 'linkedin_url']);
    $this->configuration['youtube_url']  = $form_state->getValue(['social', 'youtube_url']);
    $this->configuration['twitter_url']  = $form_state->getValue(['social', 'twitter_url']);
    $this->configuration['copyright']    = $form_state->getValue(['bottom', 'copyright']);
    $this->configuration['agency_text']  = $form_state->getValue(['bottom', 'agency_text']);
    $this->configuration['agency_label'] = $form_state->getValue(['bottom', 'agency_label']);
    $this->configuration['agency_url']      = $form_state->getValue(['bottom', 'agency_url']);
    $this->configuration['agency_logo_url'] = $form_state->getValue(['bottom', 'agency_logo_url']);
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();

    return [
      '#theme'        => 'capital_azur_footer',
      '#menu_id'      => $config['menu_id'] ?: 'footer',
      '#copyright'    => $config['copyright'],
      '#agency_text'  => $config['agency_text'],
      '#agency_label' => $config['agency_label'],
      '#agency_url'   => $config['agency_url'],
      '#linkedin_url'    => $config['linkedin_url'],
      '#youtube_url'     => $config['youtube_url'],
      '#twitter_url'     => $config['twitter_url'],
      '#agency_logo_url' => $config['agency_logo_url'],
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
    return Cache::mergeTags(parent::getCacheTags(), ['config:system.menu.' . ($this->getConfiguration()['menu_id'] ?: 'footer')]);
  }

}
