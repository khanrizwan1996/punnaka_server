<?php

namespace App\Exports;

use App\Models\BusinessListing;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class businessListingExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // $allBusinessListingArray = BusinessListing::join('users', 'users.id', '=', 'business_listing.bus_user_id')
        // ->orderBy('bus_id', 'desc')
        // ->get(['users.name','users.email','users.contact_no','business_listing.bus_name',
        // 'business_listing.bus_email','business_listing.bus_contact_no','business_listing.bus_alt_contact_no',
        // 'business_listing.bus_state','business_listing.bus_country','business_listing.bus_city',
        // 'business_listing.bus_pin_code','business_listing.bus_address1','business_listing.bus_address2',
        // 'business_listing.bus_start_year','business_listing.bus_main_cat',
        // 'business_listing.bus_sub_cat','business_listing.bus_product_service','business_listing.bus_avg_price_range',
        // 'business_listing.bus_payment_mode','business_listing.bus_punnaka_discount',
        // 'business_listing.bus_added_time', ]);
        
        $allBusinessListingArray = BusinessListing::select('bus_main_cat'
        ,'bus_sub_cat','bus_name','bus_email','bus_contact_no','bus_alt_contact_no'
        ,'bus_country'
        ,'bus_state'
        ,'bus_city'
        ,'bus_pin_code'
        ,'bus_address1'
        ,'bus_address2'
        ,'bus_start_year'
        ,'bus_product_service'
        ,'bus_avg_price_range'
        ,'bus_payment_mode'
        ,'bus_punnaka_discount'
        ,'bus_added_time'
        )->orderBy('bus_id', 'desc')->get();
        return $allBusinessListingArray;
    }
    public function headings(): array
    {
        return [
            // 'User Name','User Email' ,'User Contact No',
            'Business Category',
            'Sub Category','Business Name','Business Email' ,'Business Contact Number',
            'Business Whatsapp Number','Business Location (Country)','Business Location (State)',
            'Business Location (City)','PIN Code / Zip Code' ,'Business Address (Physical Location)',
            'Business Address (Area Name)','Business Start / Opening Year' ,'All of the products & services provided in details' ,'Average price range / fee',
            'Payment Mode','Discounts / Offers','Business Register Date & Time'
        ];
    }
}
