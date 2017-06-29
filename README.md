# http-requester
Allows one to send http GET, PUT, POST, DELETE request and view response

<h3>Information</h3>

<p>
There are 2 instance variables (which can be set from the constructor for simplicity): $verbose, and $printResults. 
See javadoc of the contructor for info about them
</p>

It has 4 public methods: get, put, post, delete. Each makes an http request and (depending on your setting) 
returns or prints the result in the form ["statusCode" => statusNum, "response" => response]

<h3>Examples</h3>

<p>
Note: In the following examples, http result = ["statusCode" => statusNum, "response" => response]
and http info is http headers and such.
Can substitute get for put, post, delete. All work the same way 
</p>


<code>$http = new SendHTTP(); // optional two params, verbose and printResults described below</code>

<p>To only return http results without fluff of printing any other info
    <br>
    <code>
      $http->get('http://example/com', ['key1' => 'value1', 'key2' => 'value2']);
    </code>
</p>

<p>To print http info to screen, but return http results
    <br>
    <code>$http->verbose = true;</code>
    <br>
    <code>$http->get('http://example/com', ['key1' => 'value1', 'key2' => 'value2']);</code>
</p>

<p>To print http info and http results
    <br>
    <code>$http->verbose = true;</code>
      <br>
      <code>$http->printResults = true;</code>
      <br>
      <code>$http->get('http://example/com', ['key1' => 'value1', 'key2' => 'value2']);</code>
</p>

<p>The 2nd parameter is optional, so one can also do
<br>
<code>$http->get('http://example/com');</code>
