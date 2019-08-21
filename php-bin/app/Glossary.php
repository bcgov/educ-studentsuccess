<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Watson\Rememberable\Rememberable;

// https://laravel.com/docs/5.2/eloquent#defining-models
class Glossary extends Model {

  // Views that format strings good. 
  // https://github.com/laracasts/Presenter
  use PresentableTrait;
  protected $presenter = 'App\Presenters\GlossaryPresenter';

  // https://github.com/dwightwatson/rememberable
  use Rememberable;

  // The table associated with the model.
  protected $table = 'EDW_RESEARCH.ESDR_WEB_GLOS';
  protected $connection = 'oracle';

  // We don't really use these (below), because we don't have write access to the DB. 
  public $incrementing = false;
  // Indicates if the model should be timestamped.
  public $timestamps = false;

}
