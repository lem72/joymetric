<!DOCTYPE>
<html>
  <head>
    <title>Hello Google Analytics API</title>
  </head>
  <body>
    <!-- The 2 Buttons for the user to interact with -->
    <button id="authorize-button" style="visibility: hidden">Authorize</button><br/>
    <button id="make-api-call-button" style="visibility: hidden">Get Visits</button>

    <!-- These JavaScript files will be created later on in the tutorial -->
    <script src="auth.js"></script>
    <script src="analytics.js"></script>

    <!-- Load the Client Library. Use the onload parameter to specify a callback function -->
    <script src="https://apis.google.com/js/client.js?onload=handleClientLoad"></script>
  </body>
</html>