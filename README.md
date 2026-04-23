# Pact-PHP

Define a pact between service consumers and providers, enabling "consumer driven contract" testing.

[![CI](https://github.com/andykelk/pact-php/actions/workflows/ci.yml/badge.svg)](https://github.com/andykelk/pact-php/actions/workflows/ci.yml)

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
2. Install composer: https://getcomposer.org/download/
3. Install dependencies: `composer install`
4. Write a phpunit test similar to the following:

    ```php
    use Pact\Pact;

    class MyProviderTest extends PHPUnit\Framework\TestCase
    {
        public function testMyProvider(): void
        {
            $client = new ZooClient('http://localhost:1234');

            $alligatorProvider = Pact::mockService([
                'consumer' => 'Alligator Consumer',
                'provider' => 'Alligator Provider',
                'port' => 1234
            ]);

            $alligatorProvider
                ->given("an alligator with the name Mary exists")
                ->uponReceiving("a request for an alligator")
                ->withRequest("get", "/alligators/Mary", [
                    "Accept" => "application/json"
                ])->willRespondWith(200, [
                    "Content-Type" => "application/json"
                ], [
                    "name" => "Mary"
                ]);

            $alligatorProvider->run(function () use ($client) {
                $alligator = $client->getAlligatorByName('Mary');
                $this->assertInstanceOf("Alligator", $alligator);
                $this->assertEquals("Mary", $alligator->getName());
            });
        }
    }
    ```

5. Start the mock server: `bundle exec pact-mock-service -p 1234 --pact-specification-version 2.0.0 -l log/pact.logs --pact-dir tmp/pacts`
6. Run phpunit: `./vendor/bin/phpunit`
7. Inspect the pact file in `tmp/pacts`
