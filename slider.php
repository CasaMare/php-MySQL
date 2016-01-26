<html>
<head>
    <link type="text/css" rel="stylesheet" href="slidertest.css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
      /*  var i=0;
        function slideShow() {
            var posters= new Array("grazhdanin.chetyre.jpg","aloha.jpg","vozduh.jpg");
            if(i>=3) i=0;
            r=document.getElementById('poster');
            r.src=posters[i];
            i++;

        }*/
      function showSlide(){
          $("#slide1").slideToggle(1000);
      }

      $(document).ready(function(){
          $("#slide1").hide();
          $("#slide2").hide();
          $("#slide3").hide();
          $("#slide4").hide();
          $("#showSlide").bind("click", showSlide);
      });



      /*по нажати на кнопку "регистрация" блок формы регистрации открывается*/
     /* function showRegForm(){
          $("#registration").fadeIn(800);
      }
      $(document).ready(function() {
          $("#registration").hide();
          $("#showRegForm").bind("click",showRegForm);
      });*/

    </script>
</head>
<body>

</head>
<body>

<div class="slider">
<h2>Слайд-шоу</h2>
<img src="images/1.jpg" id="slide1"/><br>
<img src="images/2.jpg" id="slide2"/><br>
<img src="images/3.jpg" id="slide3"/><br>
<img src="images/4.jpg" id="slide4"/><br>
<input type="button" value="Показать следующую" id="showSlide"">
</div>

</body>
</html>