<?php

namespace App\Imports;

use App\Models\BusinessListing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class businessListingImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row){
        //dd($row);
        if(isset($row) && !empty($row) && $row['business_name'] != ''){
            return new BusinessListing([
                'bus_multiple_excel_status' => 1,
                'bus_name' => $row['business_name'],
                'bus_contact_no' => $row['business_contact_number'],
                'bus_alt_contact_no' => $row['business_whatsapp_number'],
                'bus_email' => $row['business_email_address'],
                'bus_country' => $row['business_location_country'],
                'bus_state' => $row['business_location_state'],
                'bus_city' => $row['business_location_city'],
                'bus_pin_code' => $row['business_area_pin_code_zip_code'],
                'bus_address1' => $row['business_address_physical_location'],
                'bus_address2' => $row['business_address_area_name'],
                'bus_start_year' => $row['business_start_opening_year'],
                'bus_main_cat' => $row['business_category'],
                'bus_sub_cat' => $row['sub_category'],
                'bus_desc' => $row['business_description'],
                'bus_product_service' => $row['all_of_the_products_services_provided_in_details'],
                'bus_facebook_url' => $row['business_facebook_url'],
                'bus_instagram_url' => $row['business_instagram_url'],
                'bus_twitter_url' => $row['business_twitter_url'],
                'bus_video_url' => $row['business_video_url'],
                'bus_website_url' => $row['business_website_url'],
                'bus_payment_mode' => $row['payment_mode'],
                'bus_avg_price_range' => $row['average_price_range_fee'],
                'bus_punnaka_discount' => $row['discounts_offers'],
                'bus_tags' => $row['business_tags'],
                'bus_location_tags' => $row['location_tags'],
                'bus_meta_title' => $row['meta_title'],
                'bus_meta_keyword' => $row['meta_keyword'],
                'bus_meta_description' => $row['meta_description'],
                'bus_payment_que_ans' => $row['how_did_you_hear_punnakacom'],
                'bus_added_time' => CURRENT_DATE_TIME
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
