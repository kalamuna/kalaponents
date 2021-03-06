<?php

namespace Drupal\kalagraphs\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemInterface;

/**
 * Base class for Kalagraphs image field formatter plugin implementations.
 *
 * @ingroup field_formatter
 */
abstract class KalagraphsImageFormatter extends KalagraphsFieldFormatter {

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    return [t('Kalagraphs Image Field Formatter')];
  }

  /**
   * {@inheritdoc}
   */
  protected function viewValue(FieldItemInterface $item) {

    // Fill in some default values for sub-classes.
    $value = [
      // @todo Making this a URL was a mistake; it should remain a URI until the
      // last possible moment and only changed for the specific items that need
      // a URL. Fix this in the next major version change.
      '#uri' => file_create_url($item->entity->getFileUri()),
      '#attributes' => [
        'alt'    => $item->alt,
        'title'  => $item->title,
        'class'  => [],
        'width'  => $item->width,
        'height' => $item->height,
      ],
    ];

    // Pass by reference to retain compatibility with older versions.
    $value['#alt'] = &$value['#attributes']['alt'];
    $value['#title'] = &$value['#attributes']['title'];
    $value['#class'] = &$value['#attributes']['class'];
    $value['#width'] = &$value['#attributes']['width'];
    $value['#height'] = &$value['#attributes']['height'];

    return $value;
  }

}
