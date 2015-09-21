<?php
 
use Pact\MatchGenerator;
 
class MatchGeneratorTest extends PHPUnit_Framework_TestCase {
  /**
   * @expectedException InvalidArgumentException
   */
  public function testTermWrongType () {
    $match = new MatchGenerator();
    $term = $match->term('blah');
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testTermNoGenerate () {
    $match = new MatchGenerator();
    $term = $match->term(['matcher' => '\d']);
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testTermNoMatcher () {
    $match = new MatchGenerator();
    $term = $match->term(['generate' => 30]);
  }

  public function testTerm () {
    $match = new MatchGenerator();
    $term = $match->term(['matcher' => '\d', 'generate' => 30]);
    $this->assertEquals(['data' => ['matcher' => ['o' => 0, 'json_class' => 'Regexp', 's' => '\d'], 'generate' => 30], 'json_class' => 'Pact::Term'], $term);
  }
  
  /**
   * @expectedException InvalidArgumentException
   */
  public function testEachLikeNoContent () {
    $match = new MatchGenerator();
    $eachLike = $match->eachLike(null, ['min' => 1]);
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testEachLikeNoMin () {
    $match = new MatchGenerator();
    $eachLike = $match->eachLike('Sue', []);
  }

  public function testEachLike () {
    $match = new MatchGenerator();
    $eachLike = $match->eachLike('Sue', ['min' => 2]);
    $this->assertEquals(['contents' => 'Sue', 'min' => 2, 'json_class' => 'Pact::ArrayLike'], $eachLike);
  }

  public function testEachLikeDefaultMin () {
    $match = new MatchGenerator();
    $eachLike = $match->eachLike('Sue');
    $this->assertEquals(['contents' => 'Sue', 'min' => 1, 'json_class' => 'Pact::ArrayLike'], $eachLike);
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testSomethingLikeNoValue () {
    $match = new MatchGenerator();
    $somethingLike = $match->somethingLike(null);
  }

  public function testSomethingLike () {
    $match = new MatchGenerator();
    $eachLike = $match->somethingLike('Sue');
    $this->assertEquals(['contents' => 'Sue', 'json_class' => 'Pact::SomethingLike'], $eachLike);
  }
}
