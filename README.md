# http-requester
Allows one to send http GET, PUT, POST, DELETE request and view response

<h3>Information</h3>

<p>
There are 2 instance variables (which can be set from the constructor for simplicity): $verbose, and $printResults. 
See javadoc of the contructor for info about them
</p>

It has 4 public methods: get, put, post, delete. Each makes an http request and (depending on your setting) 
returns or prints the result in the form ["statusCode" => statusNum, "response" => response]
