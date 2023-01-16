# Setup

## Setup json-server

``` sh
docker run --rm --interactive --tty --volume $PWD:/app -w /app node:18.13 npm install
```

## Setup phpunit_guzzle

``` sh
(cd phpunit_guzzle/ && docker run --rm --interactive --tty --volume $PWD:/app -w /app composer install)
```

## Setup frisby

``` sh
(cd frisby/ && docker run --rm --interactive --tty --volume $PWD:/app -w /app node:18.13 npm install)
```

## Setup codeception

``` sh
(cd codeception/ && docker run --rm --interactive --tty --volume $PWD:/app -w /app composer install)
```

# Run tests

## Run phpunit_guzzle

``` sh
docker run --rm --interactive --tty --volume "$(pwd)"/phpunit_guzzle:/app -w /app --network api-testing-tools_default composer phpunit
```

## Run frisby

``` sh
docker run --rm --interactive --tty --volume "$(pwd)"/frisby:/app -w /app --network api-testing-tools_default node:18.13 npm run test
```

## Run codeception

``` sh
docker run --rm --interactive --tty --volume "$(pwd)"/codeception:/app -w /app --network api-testing-tools_default composer codecept
```

# References

- PHPUnit (https://phpunit.de/)
- Frisby (https://docs.frisbyjs.com/)
- Codeception (https://codeception.com/)