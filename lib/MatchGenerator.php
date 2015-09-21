<?php namespace Pact;

class MatchGenerator {
  public function term ($term) {
    if (!$term || !is_array($term) || !array_key_exists('generate', $term) || !array_key_exists('matcher', $term)) {
      throw new \InvalidArgumentException('Error creating a Pact Term. Please provide an object containing \'generate\' and \'matcher\' properties');
    }
    return [
      'json_class' => 'Pact::Term',
      'data' => [
        'generate' => $term['generate'],
        'matcher' => [
          'json_class' => 'Regexp',
          'o' => 0,
          's' => $term['matcher']
        ]
      ]
    ];
  }

  public function eachLike ($content, $options = null) {
    if (!$content) {
      throw new \InvalidArgumentException('Error creating a Pact eachLike. Please provide a content argument');
    }
    if (is_array($options) && !array_key_exists('min', $options)) {
      throw new \InvalidArgumentException('Error creating a Pact eachLike. Please provide options.min that is > 1');
    }
    return [
      'json_class' => 'Pact::ArrayLike',
      'contents' => $content,
      'min' => (!is_array($options)) ? 1 : $options['min']
    ];
  }

  public function somethingLike ($value) {
    if (!$value) {
      throw new \InvalidArgumentException('Error creating a Pact somethingLike Match. Value must be defined');
    }
    return [
      'json_class' => 'Pact::SomethingLike',
      'contents' => $value
    ];
  }
}
