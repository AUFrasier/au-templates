<?php
/**
 * Partial for displaying Yelp reviews
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2020, Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.0.0
 */


// API key placeholders that must be filled in by users.
// You can find it on
// https://www.yelp.com/developers/v3/manage_app
$API_KEY = "";

// API constants, you shouldn't have to change these.
$API_HOST = "https://api.yelp.com";
$REVIEW_PATH = "/v3/businesses/";
$BUSINESS_ID = "";
$ENDPOINT = "/reviews";
$FINAL_PATH = $API_HOST . $REVIEW_PATH . urlencode($BUSINESS_ID) . $ENDPOINT;

/** 
 * Makes a request to the Yelp API and returns the response
 * 
 * @param    $host    The domain host of the API 
 * @param    $path    The path of the API after the domain.
 * @param    $url_params    Array of query-string parameters.
 * @return   The JSON response from the request      
 */
function request($path, $api) {
    // Send Yelp API Call
    try {
        $curl = curl_init();
        if (FALSE === $curl)
            throw new Exception('Failed to initialize');

        $url = $path;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,  // Capture response.
            CURLOPT_ENCODING => "gzip",  // Accept gzip/deflate/whatever.
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . $api,
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        echo "<script>console.log(" . $response . ");</script>";
        $obj = json_decode($response);
        echo "<div class='swiper-container yelp-container'>"; 
            echo "<div class='swiper-wrapper'>";
                foreach($obj->reviews as $review)
                {
                    echo "<div class='swiper-slide'>";
                        echo "<div class='testimonial-info'>";
                            echo "<span class='testimonial-author'>".$review->user->name."</span>";
                            echo "<p class='testimonial-content'>".$review->text."</p>";
                            echo "<a target='_blank' href='".$review->url."' class='testimonial-content'>Learn More</a>";
                        echo "</div>";
                    echo "</div>";
                }
            echo "</div>";
            echo "<div class='swiper-button-prev'></div>";
            echo "<div class='swiper-button-next'></div>";
        echo "</div>";
        if (FALSE === $response)
            throw new Exception(curl_error($curl), curl_errno($curl));
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (200 != $http_status)
            throw new \Exception($response, $http_status);

        curl_close($curl);
    } catch(Exception $e) {
        trigger_error(sprintf(
            'Curl failed with error #%d: %s',
            $e->getCode(), $e->getMessage()),
            E_USER_ERROR);
    }

    return $response;
}

request($FINAL_PATH, $API_KEY);
?>
