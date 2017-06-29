<?php

class SendHTTP {

    public $verbose;
    public $printResults;

    /**
      *
      * @param $verbose - boolean if headers should be echoed out
      * @param $printResults - boolean, if http code and response should be echoed or returned
      */
    public function __construct($verbose = false, $printResults = false) {

        $this->verbose = $verbose;
        $this->printResults = $printResults;
    }

    /**
      * Sends HTTP GET request
      *
      * @param $url - where to send request
      * @param $query - associative array
      */
    public function get(string $url, array $query = []) {

        $ch = curl_init();

        $url .= "?".http_build_query($query);
        return $this->createHTTPRequest($url, $ch);
    }

     /**
      * Sends HTTP PUT request
      *
      * @param $url - where to send request
      * @param $query - associative array
      */
   public function put(string $url, array $query = []) {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));

        return $this->createHTTPRequest($url, $ch);
    }

    /**
      * Sends HTTP POST request
      *
      * @param $url - where to send request
      * @param $query - associative array
      */
   public function post(string $url, array $query = []) {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));

        return $this->createHTTPRequest($url, $ch);
    }

  /**
    * Sends HTTP DELETE request
    *
    * @param $url - where to send request
    * @param $query - associative array
    */
 public function delete(string $url, array $query = []) {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));

        return $this->createHTTPRequest($url, $ch);
    }

    /**
      * Helper method to create http request to api while passing along the jwt
      *
      * $ch - cURL
      * @param $url - where request should be sent
      *
      * @return associative array where keys are "statusCode" and "response"
      */
    private function createHTTPRequest(string $url, $ch) {

        curl_setopt($ch, CURLOPT_VERBOSE, $this->verbose);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // makes response get returned instead of echoing to terminal
        curl_setopt($ch, CURLOPT_HEADER, 1);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // follow redirects (since .htaccess forces all api stuff through /router)
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json", 'Content-type: application/json'));
        $content = trim(curl_exec($ch));
        $res_info = curl_getinfo($ch);

        $api_response_body = substr($content, $res_info['header_size']);

        curl_close($ch);

        $results = [
                "statusCode" => $res_info["http_code"],
                "response" => json_decode($api_response_body)
            ];

        if (!$this->printResults) {
            return $results;
        }
        print_r($results);
    }
}

?>