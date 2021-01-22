<?php

namespace Drupal\mollo_calendar\Controller;

use Drupal;
use Drupal\Core\Controller\ControllerBase;
use Drupal\mollo_utils\Utility\Helper;

/**
 * Class CalendarDatesController.
 *
 *
 *  Bundle mollo_calendar_date
 * -----------------------------------------
 */
class CalendarDatesController extends ControllerBase
{
  // public  Vars for Twig Var Suggestion.
  // use in Template via:
  // {# @var calendar_date \Drupal\mollo_calendar\Controller\CalendarDatesController #}

  public $calendar;

  public $number;

  public $status;

  public $start;

  public $end;

  public $door_opening;

  public $location;

  public $description;

  public $calendar_start;

  public $calendar_end;

  public $host;

  public $director;

  public $notes;

  /**
   * Getvars
   *
   *    Bundle mollo_calendar_date
   * -----------------------------------------
   *
   *
   *    - field_mollo_calendar
   *    - field_mollo_number
   *    - field_mollo_status   TODO: make own Voc like mollo_calendar_date_status
   *    - field_mollo_start
   *    - field_mollo_end
   *    - field_mollo_door_opening
   *    - field_mollo_locations
   *    - field_mollo_description
   *    - field_mollo_calendar_start
   *    - field_mollo_calendar_end
   *    - field_mollo_host
   *    - field_mollo_director
   *    - field_mollo_notes
   *
   *
   *
   * @param $date_id
   *
   * @return array|string[]
   *   Return Calendar Date Twig Vars
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public static function getVars($date_id, $vocabularies): array
  {
    $node = Drupal::entityTypeManager()
      ->getStorage('node')
      ->load($date_id);

    if (isset($node)) {
      $calendar = Helper::getFieldValue($node, 'field_mollo_calendar');
      $number = Helper::getFieldValue($node, 'field_mollo_number');
      $status = Helper::getFieldValue($node, 'field_mollo_status');
      $location_ids = Helper::getFieldValue($node, 'field_mollo_locations',null,TRUE);
      $description = Helper::getFieldValue($node, 'field_mollo_description');
      $calendar_start = Helper::getFieldValue($node, 'field_mollo_calendar_start');
      $calendar_end = Helper::getFieldValue($node, 'field_mollo_calendar_end');
      $host = Helper::getFieldValue($node, 'field_mollo_host');
      $notes = Helper::getFieldValue($node, 'field_mollo_notes');

      // get Names



      // Build Variables Array
      return [
        'calendar' => $calendar,
        'number' => $number,
        'status' => $status,
        'location_ids' => $location_ids,
        'description' => $description,
        'calendar_start' => $calendar_start,
        'calendar_end' => $calendar_end,
        'host' => $host,
        'notes' => $notes
      ];
    }
    return [];
  }

  /**
   * @param $calendar_id
   * @param $vocabularies
   *
   * @param $locations
   *
   * @return array
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public static function getDatesFromCalendar($calendar_id, $vocabularies, $locations): array
  {
    $dates = [];

    // load all Node IDs from "mollo_calendar_date" with mollo_calendar ID
    $query = Drupal::entityQuery('node')
      //
      // Condition
      ->condition('type', 'mollo_calendar_date')
      ->condition('field_mollo_calendar', $calendar_id)
      // Access
      ->accessCheck(false);

    $date_ids = $query->execute();

    // Nodes found
    if (count($date_ids) !== 0) {
      // Load all Dates
      foreach ($date_ids as $date_id) {
        // Output Array
        $date = self::getVars($date_id, $vocabularies);

        // Add Location
        // TODO get only first Location now
        $location_ids = $date['location_ids'];
        foreach ($locations as $location){
          if($location['id'] === $location_ids[0]){
            $date['location'] = $location;
          }
        }

      $dates[] = $date;
      }
    }

    return $dates;
  }
}
