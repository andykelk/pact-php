<?php

use Pact\MatchGenerator;

class MatchGeneratorTest extends PHPUnit\Framework\TestCase
{
    public function testTermWrongType(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $match = new MatchGenerator();
        $match->term('blah');
    }

    public function testTermNoGenerate(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $match = new MatchGenerator();
        $match->term(['matcher' => '\d']);
    }

    public function testTermNoMatcher(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $match = new MatchGenerator();
        $match->term(['generate' => 30]);
    }

    public function testTerm(): void
    {
        $match = new MatchGenerator();
        $term = $match->term(['matcher' => '\d', 'generate' => 30]);
        $this->assertEquals(['data' => ['matcher' => ['o' => 0, 'json_class' => 'Regexp', 's' => '\d'], 'generate' => 30], 'json_class' => 'Pact::Term'], $term);
    }

    public function testEachLikeNoContent(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $match = new MatchGenerator();
        $match->eachLike(null, ['min' => 1]);
    }

    public function testEachLikeNoMin(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $match = new MatchGenerator();
        $match->eachLike('Sue', []);
    }

    public function testEachLike(): void
    {
        $match = new MatchGenerator();
        $eachLike = $match->eachLike('Sue', ['min' => 2]);
        $this->assertEquals(['contents' => 'Sue', 'min' => 2, 'json_class' => 'Pact::ArrayLike'], $eachLike);
    }

    public function testEachLikeDefaultMin(): void
    {
        $match = new MatchGenerator();
        $eachLike = $match->eachLike('Sue');
        $this->assertEquals(['contents' => 'Sue', 'min' => 1, 'json_class' => 'Pact::ArrayLike'], $eachLike);
    }

    public function testSomethingLikeNoValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $match = new MatchGenerator();
        $match->somethingLike(null);
    }

    public function testSomethingLike(): void
    {
        $match = new MatchGenerator();
        $eachLike = $match->somethingLike('Sue');
        $this->assertEquals(['contents' => 'Sue', 'json_class' => 'Pact::SomethingLike'], $eachLike);
    }
}
