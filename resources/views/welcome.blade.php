 <!DOCTYPE html>
 <html>
 <head>
     <title></title>
     <script src="js/angular.min.js"></script>
     <script type="text/javascript" src="js/controller.js"></script>
     <link rel="stylesheet" type="text/css" href="css/style.css">
 </head>
 <body ng-app="RappiApp"  ng-controller="RappiController">

 <form ng-submit="submit();">
 <div class=" terminal ">
  <p class=" terminal--header ">Last login: Sun Sep 15 11:11:50 on ttys000</p>
  <p ng-repeat="(key,log) in logs" ng-class="log.class">@{{log.message}}</p>
<!--   <p class=" terminal--input ">whoami</p>
  <p class=" terminal--output ">Rafael Rinaldi</p>
  <p class=" terminal--input ">find ~ -name secret-of-life</p>
  <p class=" terminal--output ">42</p>
  <p class=" terminal--input ">which planet</p>
  <p class=" terminal--output ">/usr/milky-way/earth</p>
  <p class=" terminal--input ">node</p>
  <p class=" terminal--output is-console ">var sprintf = require('util').format;</p>
  <p class=" terminal--output is-not-defined "></p>
  <p class=" terminal--output is-console ">var msg = "CSS3 is %s!";</p>
  <p class=" terminal--output is-not-defined "></p>
  <p class=" terminal--output is-console ">console.log(sprintf(msg, 'awesome'));</p>
  <p class="terminal--output">CSS3 is awesome!</p>
  <p class=" terminal--output is-not-defined "></p>
  <p class=" terminal--output is-console "></p>
  <p class=" terminal--output ">(^C again to quit)</p> -->
  <p class=" terminal--input "><input type="text" ng-model="input" ng-disabled = "disabled" focus-me="!input"></p>
</div>
</form>
 </body>

 <style type="text/css">


 </style>
 </html>