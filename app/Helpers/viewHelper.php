<?php

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\File;

/**
 * @method upload_picture()
 * 
 * @uses used to upload the picture
 *
 * @created BALAJI M
 *
 * @updated VITHYA
 *
 * @param image, destination
 *
 * @return image url
 *
 */
function upload_picture($image, $destination) {

    $extension = $image->getClientOriginalExtension();

    $filename = rand().".".$extension;

    $image->move(public_path().$destination, $filename);

    return url($destination, $filename);     

}

/**
 * @method delete_picture()
 * 
 * @uses To delete the image
 *
 * @created BALAJI M
 *
 * @updated VITHYA
 *
 * @param image and destination
 *
 * @return Null
 *
 */

function delete_picture($image, $destination) {

    $image_name = basename($image);

    $image_path = public_path($destination.'/'.$image_name);
   
    if(File::exists($image_path)) {
            
        File::delete($image_path);
    }

    return null;
}

/**
 * @method formatted_amount()
 *
 * @uses used to format the number
 *
 * @created vidhya R
 *
 * @updated vidhya R
 *
 * @param integer $num
 * 
 * @param string $currency
 *
 * @return string $formatted_amount
 */

function formatted_amount($amount = 0.00, $currency = "") {

    $currency = $currency ?: Setting::get('currency', '$');

    $amount = number_format((float)$amount, 2, '.', '');

    $formatted_amount = $currency."".$amount ?: "0.00";

    return $formatted_amount;
}

/**
 * @method common_date()
 *
 * @uses to formate date with TimeZone
 *
 * @created Vidhya R
 *
 * @updated Anjana H
 *
 * @param integer $num
 * 
 * @param string $currency
 *
 * @return string $formatted_amount
 */
function common_date($date , $timezone = "" , $format = "d M Y h:i A") {

    if($date == "0000-00-00 00:00:00" || $date == "0000-00-00" || !$date) {

        return $date;
    }

    if($timezone) {

        $date = convertTimeToUSERzone($date , $timezone , $format);

    }

    return date($format , strtotime($date));

}

/**
 * Function Name: tr()
 *
 * Description: used to convert the string to language based string
 *
 * @created Vidhya R
 *
 * @updated
 *
 * @param string $key
 *
 * @return string value
 */
function tr($key , $additional_key = "" , $lang_path = "messages.") {

    if (!\Session::has('locale')) {

        $locale = \Session::put('locale', config('app.locale'));

    }else {

        $locale = \Session::get('locale');

    }
        
    return \Lang::choice('messages.'.$key, 0, Array('other_key' => $additional_key), $locale);
}

