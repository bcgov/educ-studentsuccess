<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class SchoolPresenter extends Presenter {

    public function formatSchoolAddress() {

      $str = '';
      
      $str .= $this->phy_address_line_1 ? ucwords(strtolower($this->phy_address_line_1)) : '';
      $str .= $this->phy_address_line_2 ? $this->phy_address_line_2 : '';
      $str .= $this->phy_city ? ', '.ucwords(strtolower($this->phy_city)) : '';
      // $str .= $this->phy_province ? ', '.$this->phy_province : '';
      $str .= ', BC';
      $str .= $this->phy_postal_code ? ' '.substr_replace($this->phy_postal_code, ' ', 3, 0) : '';

      return $str;

    }

    public function concatPhoneNumber() {

      $str = str_replace('-', '', $this->phone_number);
      $str = str_replace(' ', '', $str);

      return '+1'.$str;

    }

    // Slugify a string for use in a URL. 
    // Also see: https://laravel.com/docs/5.2/helpers#method-str-slug
    public function slugifyCity() {

      $city = $this->phy_city;
      return str_slug($city, '-');

    }

    public function formatCityForHuman() {

      $city = $this->phy_city;
      $city = strtolower($city);
      $city = ucwords($city);
      return $city;

    }

    // EXAMPLE: 
    // public function accountAge() {
    //   return $this->created_at->diffForHumans(); // Use's Laravel's native Carbon Date formatter thing.
    // }

}
