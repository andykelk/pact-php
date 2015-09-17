<?php
 
use Pact\Match;
 
class MatchTest extends PHPUnit_Framework_TestCase {
  /**
   * @expectedException InvalidArgumentException
   */
  public function testTermWrongType () {
    $term = Match::term('blah');
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testTermNoGenerate () {
    $term = Match::term(['matcher' => '\d']);
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testTermNoMatcher () {
    $term = Match::term(['generate' => 30]);
  }

  public function testTerm () {
    $term = Match::term(['matcher' => '\d', 'generate' => 30]);
    $this->assertEquals(['data' => ['matcher' => ['o' => 0, 'json_class' => 'Regexp', 's' => '\d'], 'generate' => 30], 'json_class' => 'Pact::Term'], $term);
  }
  
  /**
   * @expectedException InvalidArgumentException
   */
  public function testEachLikeNoContent () {
    $eachLike = Match::eachLike(null, ['min' => 1]);
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testEachLikeNoMin () {
    $eachLike = Match::eachLike('Sue', []);
  }

  public function testEachLike () {
    $eachLike = Match::eachLike('Sue', ['min' => 2]);
    $this->assertEquals(['contents' => 'Sue', 'min' => 2, 'json_class' => 'Pact::ArrayLike'], $eachLike);
  }

  public function testEachLikeDefaultMin () {
    $eachLike = Match::eachLike('Sue');
    $this->assertEquals(['contents' => 'Sue', 'min' => 1, 'json_class' => 'Pact::ArrayLike'], $eachLike);
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testSomethingLikeNoValue () {
    $somethingLike = Match::somethingLike(null);
  }

  public function testSomethingLike () {
    $eachLike = Match::somethingLike('Sue');
    $this->assertEquals(['contents' => 'Sue', 'json_class' => 'Pact::SomethingLike'], $eachLike);
  }
}
