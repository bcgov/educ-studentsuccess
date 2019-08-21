<?php

namespace App\Presenters;
use Laracasts\Presenter\Presenter;

class SchoolDistrictPresenter extends Presenter {

    // EXAMPLE: 
    // public function accountAge() {
    //     return $this->created_at->diffForHumans();
    // }

    public function formatSchoolDistrictAddress() {

      $str = '';
      
      $str .= $this->phy_address_line_1 ? $this->phy_address_line_1 : '';
      $str .= $this->phy_city ? ', '.$this->phy_city : '';
      $str .= $this->phy_province ? ', '.$this->phy_province : '';
      $str .= $this->phy_postal_code ? ' '.strtoupper($this->phy_postal_code) : '';

      return $str;

    }

    public function concatPhoneNumber() {

      $str = str_replace('-', '', $this->contact_phone);
      $str = str_replace(' ', '', $str);

      return '+1'.$str;

    }

    public function humanReadableWebsite() {

      $str = str_replace('http://', '', $this->website);
      $str = str_replace('https://', '', $str);
      $str = str_replace('www.', '', $str);

      return $str;

    }

    public function slugifyString() {

      // Lower case everything.
      return strtolower(preg_replace("/[\s-]+/", " ", preg_replace("/[\s_]/", "-", $this->phy_city)));
      
      // Make alphanumeric (removes all other characters).
      // $this = preg_replace("/[^a-z0-9_\s-]/", "", $this); // Is this dangerous in our case?
      // Clean up multiple dashes or whitespaces.
      // $this = preg_replace("/[\s-]+/", " ", preg_replace("/[\s_]/", "-", $this));
      // // Convert whitespaces and underscore to dash.
      // $this = preg_replace("/[\s_]/", "-", $this);

      // return $this->phy_city;

    }

}
