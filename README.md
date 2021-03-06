# YAUS - Yet Another Url Shortener
[![Build Status](https://travis-ci.org/napolux/YAUS.svg?branch=master)](https://travis-ci.org/napolux/YAUS) [![Code Climate](https://codeclimate.com/github/napolux/YAUS/badges/gpa.svg)](https://codeclimate.com/github/napolux/YAUS) [![Test Coverage](https://codeclimate.com/github/napolux/YAUS/badges/coverage.svg)](https://codeclimate.com/github/napolux/YAUS/coverage)

This is YAUS, (**Y**et **A**nother **U**rl **S**hortener) based on [SlimFramework](http://www.slimframework.com/) 3.x
and [Doctrine](http://www.doctrine-project.org/).

**The project is over-commented** in order to make easier for people to understand what the code is doing.
YAUS was created as a "week-end project", it was made according to the [KISS principle](https://en.wikipedia.org/wiki/KISS_principle):
**keep it in mind when using YAUS in a production environment**.

## TODO

* Improve test coverage
* Add API POST request to create short URLs

## Nice things about YAUS

There's an administration page at the `/admin` address.

YAUS counts your shortened urls visits and can detect duplicated URLs in order to prompt for already created short urls.

YAUS can provide data about the URL you're shortening by just adding `/json` to the address created.

### Example:

`http://localhost:8080/u/y` goes to the shortened address while `http://localhost:8080/u/y/json` provides a JSON object with info about the url.

```
{
    id: 25,
    url: "http://www.nerdnews.it",
    shortUrl: "y",
    visits: 0,
    hash: "2803e714ae8e0c1acb1dd262e6f356ab"
}
```

A little (just read, not write) API is available. Check `src/routes.php`. 

## Requirements

To run YAUS you need:

* PHP 5.5.x
* A MySQL database
* [Composer](https://getcomposer.org/download/) & [PHPUnit](http://phpunit.de)
* [SASS](http://sass-lang.com)

## Setup

* Launch local PHP Server from YAUS folder `php -S 0.0.0.0:8080 -t public public/index.php`
* Launch SASS watcher `sass --watch assets/sass/:public/css --style compressed`
* Create a `.env` file in the root of your project. Take a look at `.env.example`
* Change database connection credentials in `.env`
* Change admin username and password in `.env`
* Launch local PHP Server from YAUS folder `php -S 0.0.0.0:8080 -t public public/index.php`
* Go and visit `http://localhost:8080`
* Enjoy

## How to launch tests locally

* Copy `.env.example` into `.env`
* Change credentials in `.env` according to your setup
* Run `phpunit tests/`

### Legal stuff

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS
BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF
OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

### That's all folks!

That's it! Now go build something cool.
