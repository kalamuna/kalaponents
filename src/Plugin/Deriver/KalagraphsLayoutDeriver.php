<?php

namespace Drupal\kalagraphs\Plugin\Deriver;

use Drupal\Component\Plugin\Derivative\DeriverBase;
use Drupal\Core\Layout\LayoutDefinition;

/**
 * Registers each of our custom layouts with Drupal's Layout API.
 */
class KalagraphsLayoutDeriver extends DeriverBase {

  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {

    // Pretend we parsed this data from JohnO's fancy JSON discoverer.
    $layouts['twocol'] = [
      'class' => 'Drupal\kalagraphs\Plugin\Layout\KalagraphsLayout',
      'label' => 'My Two column',
      'path' => drupal_get_path('module', 'kalagraphs'),
      'template' => 'layouts/kalagraphs--twocol',
      'library' => 'layout_discovery/twocol',
      'regions' => [
        'top' => ['label' => 'Top'],
        'first' => ['label' => 'Left'],
        'second' => ['label' => 'Right'],
        'bottom' => ['label' => 'Bottom'],
      ],
    ];

    // @see https://www.drupal.org/docs/8/api/layout-api/how-to-register-layouts#using-derivatives
    foreach ($layouts as $name => $info) {
      if (empty($info['category'])) {
        $info['category'] = 'Kalagraphs';
      }
      $this->derivatives[$name] = new LayoutDefinition($info);
    }
    return $this->derivatives;
  }

}