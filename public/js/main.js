require.config({
baseUrl:"js",
paths:{
    "jquery":["https://cdn.bootcss.com/jquery/3.3.1/jquery.min","jquery-3.3.1.min"],
    "bootstrap":["https://cdn.bootcss.com/twitter-bootstrap/4.2.1/js/bootstrap.bundle","bootstrap.bundle"],
   },
"shim" : {
    "bootstrap": ["jquery"]
  }

});
require(['bootstrap'],function(){ 

 
   
 });
