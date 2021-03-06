<?php

namespace Drupal\Tests\pathperdomain\Functional;

use Drupal\Tests\pathperdomain\PathPerDomainTestHelperTrait;

/**
 * Tests the domain path with pathauto patterns for User entity.
 *
 * @group pathperdomain
 */
class PathPerDomainPathautoUserTest extends PathPerDomainTestBase {

  use PathPerDomainTestHelperTrait;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
  }

  /**
   * Test for pathauto pattern generation for each domain
   */
  public function testPathPerDomainPathautoUser() {
    // create default pattern
    $pattern = $this->createPattern('user', '/pathauto/[user:uid]', -1);
    $pattern->save();

    //create patterns for each domain
    foreach ($this->domains as $domain) {
      $pattern = $this->createPattern('user', '/user-' . $domain->id() .'/[user:uid]', -1);

      // add domains settings
      $pattern->setThirdPartySetting(
        'pathperdomain',
        'domains',
        [$domain->id() => $domain->id()]
      );

      $pattern->save();

      // check each pattern for proper settings
      $this->drupalGet('admin/config/search/path/patterns/' . $pattern->id());
      $this->assertSession()->statusCodeEquals(200);
    }

    // check all patterns
    $this->drupalGet('admin/config/search/path/patterns');
    $this->assertSession()->statusCodeEquals(200);

    //create node
    $user1 = $this->drupalCreateUser();

    $edit = [];
    // check for automatic alias
    $edit['path[0][pathauto]'] = 1;
    $this->drupalPostForm('user/' . $user1->id() . '/edit', $edit, 'Save');

    // check aliases for domains was generated
    $this->drupalGet('user/' . $user1->id() . '/edit');
    $this->assertSession()->statusCodeEquals(200);
  }
}