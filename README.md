# ESDR v2

Source code for [studentsuccess.gov.bc.ca](http://studentsuccess.gov.bc.ca). This website uses [Laravel](https://laravel.com/) version 5.2.

## Requirements

* Apache web server
* PHP ~5.6.26 with these extensions/libraries enabled:
  * php\_oci8\_11g.dll (for Windows, [see below](#oci-installation-aka-oracle-hell) for installation) or oci8.so (for Red Hat)
  * OpenSSL (_if_ you are using HTTPS)
  * Mbstring PHP lib
  * Tokenizer PHP lib
* A connection to the EDUC arcade-scan.educ.gov.bc.ca Oracle database

### Dev Dependencies

* [Composer](https://getcomposer.org/)
* [Node](https://nodejs.org/en/download/)
  * [SASS](http://sass-lang.com/install)
  * NPM w/ [Grunt](https://gruntjs.com/installing-grunt)

## Developer Installation

Make sure you have installed the above requirements on your system and then:

```bash
# Install development dependencies (these compile SASS, minify JS/CSS, etc).
npm install
# Change directory into the php-bin directory.
cd php-bin
# Install PHP dependencies.
composer install
composer dump-autoload
# Switch back to the main project root.
cd ..
# Run Grunt once to compile front-end files. Compiled JS and CSS are not version controlled and are not included in this repository.
grunt
```

### OCI Installation (aka Oracle Hell)

I would have rather eaten 10 spiders in my sleep than figure out the installation of the PHP Oracle drivers for this project.

ESDR2 uses [the laravel-oci8 Oracle driver](https://github.com/yajra/laravel-oci8) for integration with [Eloquent](https://laravel.com/docs/5.2/eloquent)/Laravel.

If you are using Windows for development and PHP version 5.6.x, then you will probably have to do [the following](https://stackoverflow.com/a/30782503/1171790):

1. Download the php_oci8_11g driver/library from: [http://windows.php.net/downloads/pecl/releases/oci8/2.0.8/](http://windows.php.net/downloads/pecl/releases/oci8/2.0.8/) by selecting the `php_oci8-2.0.8-5.6-ts-vc11-x86.zip` file.
1. Extract the archive, and move the `php_oci8_11g.dll` to your extensions folder inside of your PHP install (probably, `.../php/ext/`).
1. Then enable the lib by adding `extension=php_oci8_11g.dll` to your `php.ini`
1. Say a prayer and restart Apache. If you can navigate to pages other than the homepage, you're more than likely hitting the database and everything is working. You can also do `php -m` on the command line and you should see the oci8 library/module listed in the output.

The application is currently (June 2017) untested using the `php_oci8_12c` Oracle Database 12c Instant Client PHP Driver. If you'd like to try and get that running, [here is a link](https://stackoverflow.com/questions/37670354/the-procedure-entry-point-ocistmtgetnextresult-could-not-be-located-in-the-dynam) that I thought might be useful, but [some people](https://stackoverflow.com/a/38354675/1171790) seem to think that the `php_oci8_12c` driver doesn't work with PHP 5.6.x so you can probably just use the `php_oci8_11g` driver and not worry about it.

More information around the driver install, can be found on [Oracel's website](http://www.oracle.com/technetwork/articles/technote-php-instant-084410.html).

### Folder Structure

The site does not follow a classic Laravel folder structure because the people who administer the servers like to keep things the same as other PHP projects on the server, all the time.

Normally, a Laravel application has a `public` sub-folder where one would point Apache's web root to. In our case, this is the `www` folder at the top level of the project. The `php-bin` folder (also at the top level of the project) holds all of the application code.

The `data` folder (at the top level of the project) is set to be used as [Laravel's storage path](https://laracasts.com/discuss/channels/general-discussion/where-do-you-set-public-directory-laravel-5/replies/49083). This will hold things like cache items. See `php-bin/bootstrap/app.php` for more information about the storage path.

#### Uploading Files and Directories to a Remote Server

If you are setting this project up on a EDUC ministry server, you will probably be provided with a space on the server with these directories: `bin`, `cgi-bin`, `data`, `logs`, `php-bin`, `src`, `src-cgi`, `www`

Ask the server admin to setup the same directories on the server as the ones found under the `data` directory in this project and grant PHP/Apache read, write, execute and delete privledges to all sub-folders and files (recursively).

You can then upload all of the files inside `php-bin` to `php-bin` on the server and `www` to `www`, respectively. Remember not to upload source control files such as the `.git` directory OR the `.env` for your local install.

You can now upload a unique `.env` for the specific enviroment to `php-bin/.env` on the remote server.

## Theming and Front-end JavaScript

This website tries to follow the BC Government's suggested look and feel. It also attempts to comply with GCPE's rules.

Running `grunt watch` from the project root will watch JS and Sass files located in `php-bin/resources/assets` and automatically compile them to `style.css` and `bundle.js` located in the `www` folder.

Running `grunt watch` will watch the files for a change and automatically run the compilation (this is a nice feature for when you are theming).

### SASS/CSS

Extra styling files are included inside `php-bin/resources/assets/scss` such as [the BCPS recommended stylesheet](http://www2.gov.bc.ca/gov/content/governments/services-for-government/policies-procedures/web-content-development-guides/developers-guide/css-elements) and [Bootstrap](http://getbootstrap.com/) v3. This website attempts to follow the look and feel mandated by GCPE.

Simply running `grunt` will produce minified JS and CSS files for use in production. The CSS file will **not** have helpful line numbers, useful for debugging. If you would like those, run `grunt watch` or `grunt sass:build`. Do not deploy these CSS files (with line numbers and paths) to production.

### JS

Most JS files are included via `grunt` and compiled to `bundle.js`. However, files that only need to be called on a single view/page are located in `www/js`. These files will not be compiled along with other JavaScripts and may be edited directly. [The Blade templating language](https://laravel.com/docs/5.2/blade) ensures that these special scripts are only included on certain pages (called only when they are needed).

## Routes (`php-bin/app/Http/routes.php`)

The routes file, is where you can declare the routes of the app. A route generally calls a controller.

Example:

```
Route::get('/schools/in/{city}', 'SchoolsController@getAllSchoolsByCity');
```

This calls the `getAllSchoolsByCity()` method on the `SchoolsController` class. After the controller fires, the view is then passed the data from the controller and the page is rendered.

## Custom Methods & [Helper Functions](https://laravel.com/docs/5.2/helpers)

A more complete list of methods and controllers may be found in: `workfiles/MVC_esdr2.docx`

### Helpers (`php-bin/app/Helpers/Helper`)

Helpers are generally called from controllers and are generally used for formatting strings.

* `Helper::formatCityForHuman($str)` - formats a city from the DB to a human readable format.
* `Helper::unSlugifyCity($str)` - formats a city slug string back to the format database format (all capitals).

Example:

```php
...

use Helper;
use App\School;
use DB;

class SchoolsController extends Controller {

  ...

  public function getAllSchoolsByCity($city) {

    $city = Helper::unSlugifyCity($city);

    $schools = School::select('school_name', 'independent', 'mincode', 'phy_city')
      ->where('phy_city', $city)
      ->orderBy('school_name')
      ->get();

    $selected_city = $city;

    return view('pages.directoryresults', compact('schools', 'selected_city'));

  }

  ...

}
```

### Presenters (`php-bin/app/Presenters`)

Presenters help format a string for use in a view and are called inside the view. They format an object's output just before rendering.

Example:

```php
<ul>
@foreach ($items as $item)
  <li>
    <a href="/schools/in/{{ $item->present()->slugifyCity }}">{{ $item->present()->formatCityForHuman }}</a>
  </li>
@endforeach
</ul>
```

#### Presenters vs Helpers - What's the difference?

Presenters take the object returned from a controller while Helpers can take almost any data type as a paramater.

## Translation

Translations are stored in `php-bin/resources/lang/[en|fr]/esdr2.php` as a simple array where the key of the array is used as the pointer in the view template to the translated/localized string. For example, to output the "welcome_heading" of the site in a Laravel Blade template, call the "welcome_heading" traslated string, like this: `{{ trans('esdr2.welcome_heading') }}`

There is no need to edit the translation files directly as they can be exported (for translation) and then re-imported as simple arrays (from CSV files) back into the system. Once exported, the CSV file may be passed to the translation team for translation using a program like MS Excel. We use [the laravel-lang-import-export package](https://github.com/ufirstgroup/laravel-lang-import-export) in order to accomplish all of this.

### Example: Translate the Site from English to Language X

First, export the ESDR2 English file (`php-bin/resources/lang/en/esdr2.php`) like so:

```bash
cd php-bin
php artisan lang-export:csv --output ../workfiles/translation/esdr2_en.csv en esdr2
```

Copy the exported CSV (now located at `workfiles/translation/esdr2_en.csv`) to your desktop and rename it to: `esdr2_fr.csv` (replace "fr" with whatever language you like if you are not translating to French).

Then, give the CSV file to your translation team. Instruct the translation team to NOT change the format of the file when prompted in Excel. Otherwise, you'll have to change the format back to CSV when you get it back from them. Sometimes, when closing/saving a CSV file in Excel, [Excel will prompt the user to save the file again](https://superuser.com/questions/464585/why-does-this-excel-file-keep-asking-to-save). Re-saving the file over the old one seems to do the trick here.

### Import a Freshly Translated CSV

After you get a translated CSV back from the translation team, you can import it:

Move the file to `workfiles/translation` and then run the import:

```bash
# Remember to replace `_fr` with whatever language code you are dealing with.
php artisan lang-import:csv fr esdr2 ../workfiles/translation/esdr2_fr.csv
```

For more information, see the [Larvel localization documentation](https://laravel.com/docs/5.2/localization).

## Caching

Laravel will use the file cache (on disk) by default. No other caching methods have been implemented at the time of release of this site. This is just fine for an app of this size.

In order to cache a query, use the `remember()` method.

Example:

```php
class SchoolsController extends Controller {

  public function getAllSchoolCities() {

    $cities = School::select('phy_city', DB::raw('count(*) as totalschools'))
      ->groupBy('phy_city')
      ->orderBy('phy_city')
      ->remember(60) // cache this query for 60 mins.
      ->get();

    return view('pages.directory', compact('cities'));

  }

}
```

The file cache will be located in `data/framework/cache` but you don't really need to worry about that. Deleting files and folders below this path, clears the application cache. See [the **Rememberable** documentation](https://packalyst.com/packages/package/watson/rememberable) for more information.

### Clearing the Cache

To clear the cache on your development machine change directory to `php-bin` and use:

```bash
php artisan cache:clear
```

## Tableau

To generate the charts on the website, EDUC ARU uses [Tableau](https://www.tableau.com/), passing it URL parameters in order to filter datasets.

A full list of the possible parameters available in the free offering of Tableau is available here: <https://onlinehelp.tableau.com/current/pro/desktop/en-us/embed_list.html#URL_params>

## Database Connection

The data source for the website is an Oracle database server located at: `arcade-scan.educ.gov.bc.ca`.

We use the data views found under `EDW_RESEARCH` on the `ESDR_WEB` schema.

### Tables

* `ESDR_WEB_2M` = school district data (view)
* `ESDR_WEB_1M` = school data (view)
* `ESDR_WEB_GLOS` = glossary data

Have a poke around the tables above with your favorite database admin tool in order to get an idea for some of the data displayed on the front-end of the site.

There are flags that help us know which schools have which reports available to them. For help understanding which DB flags belong with which school's report type, be sure to checkout `workfiles/School Level Chart Matrix.xslx`

## Syncing/Uploading Files to Servers

Be careful that you don't upload `.env` files to the wrong server(s).

Also, the `workfiles` directory and the `node_modules` directory should ignored along with some of the other directories and files listed below:

```json
"ignore_regexes": [
  "\\.sublime-(project|workspace)",
  "sftp-config(-alt\\d?)?\\.json",
  "sftp-settings\\.json",
  "/venv/",
  "\\.svn",
  "\\.git",
  "_darcs",
  "CVS",
  "\\.DS_Store",
  "Thumbs\\.db",
  "desktop\\.ini",
  "\\data",
  "\\node_modules",
  ".gitignore",
  ".gitattributes",
  "gruntfile.js",
  "package.json",
  "README.md",
  "\\workfiles",
  ".env",
  "laravel.log",
  "phpinfo.php"
]
```

I used the codeblock above in my editor (Sublime Text) in order to ignore some of the files and directories that one wouldn't want to upload to the servers. You can use the do the same or use this as a base list for your ignored files.
