# Pact-PHP

Define a pact between service consumers and providers, enabling "consumer driven contract" testing.

How to use
----------

1. Install pact mock service:
    1. Install Ruby and Ruby Gems
    2. Write a Gemfile:

        ```ruby
        source 'https://rubygems.org'
        gem 'pact-mock_service', '~> 0.7.0'
        ```
    
    3. Run bundler to get the gems: `gem install bundler && bundle install`
2. Install composer and phpunit
3. Write a phpunit test similar to the following:

    ```php
    public function testMyProvider() {
      // Stay tuned...
    }
    ```

4. Start the mock server: `bundle exec pact-mock-service -p 1234 --pact-specification-version 2.0.0 -l log/pact.logs --pact-dir tmp/pacts`
5. Run phpunit: `./vendor/bin/phpunit`
6. Inspect the pact file in `tmp/pacts`
