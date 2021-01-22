<?php

namespace Drupal\mollo_calendar\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\mollo_utils\Utility\Helper;
use Drupal\node\Entity\Node;

/**
 * Class PreloadController.
 *
 * Preloading Vocabularies for better Performance
 *
 *
 *  - mollo_calendar_status
 *  - mollo_calendar_category
 *  - mollo_function
 *  - mollo_position
 *  - mollo_speciality
 *  - mollo_country
 */
class PreloadController extends ControllerBase
{

  /**
   * Getvars.
   *
   * @return array
   *   Return Hello string.
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public static function getVars(): array {
    $calendar_status = Helper::getTermsByID('mollo_calendar_status');
    $calendar_category = Helper::getTermsByID('mollo_calendar_category');
    $voice_position = Helper::getTermsByID('mollo_voice_position');
    $function = Helper::getTermsByID('mollo_function');
    $position = Helper::getTermsByID('mollo_position');
    $speciality = Helper::getTermsByID('mollo_speciality');
    $country = Helper::getTermsByID('mollo_country');

    return [
      'calendar_status' => $calendar_status,
      'calendar_category' => $calendar_category,
      'voice_position' => $voice_position,
      'function' => $function,
      'position' => $position,
      'speciality' => $speciality,
      'country' => $country
    ];

  }
}
