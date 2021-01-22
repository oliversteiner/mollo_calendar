<?php

namespace Drupal\mollo_calendar\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the mollo_calendar module.
 */
class WorkControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return [
      'name' => "mollo_calendar WorkController's controller functionality",
      'description' => 'Test Unit for module mollo_calendar and controller WorkController.',
      'group' => 'Other',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests mollo_calendar functionality.
   */
  public function testWorkController() {
    // Check that the basic functions of module mollo_calendar.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
