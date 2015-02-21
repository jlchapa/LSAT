<?php

require 'core/init.php';

$user = new User();
$user->checkIsValidUser('teacher');

?>

<!doctype html>
<html class="no-js" lang="en">
<head>
  <title>LSAT | New Question</title>
  <?php include 'includes/templates/headTags.php' ?>
</head>

<body>

  <?php include 'includes/templates/header.php' ?>

  <section class="scroll-container" role="main">

    <div class="row">
      <?php include 'includes/templates/teacherSidebar.php' ?>  
      <div class="large-9 medium-8 columns">
        <h3>Pregunta</h3>
        <h4 class="subheader">Crear nueva pregunta</h4>
        <hr>  

        <form id="newQuestion"> 

          <div class="row"> 
            <div class="large-12 columns">
              <label>Texto de la pregunta 
                <textarea  id="qtext" name="text"></textarea> 
              </label>
            </div>
          </div>

          <div class="row"> 
            <div class="large-12 columns"> 
              <label>Url media
                <input type="text" id="qurl" name="url" placeholder="URL de una imagen o video que ayude a explicar la pregunta" /> 
              </label> 
            </div> 
          </div> 

          <div class="row"> 
            <div class="large-6 columns"> 
              <label>Dificultad
                <select id="qgrade" name="grade"> 
                  <option value="1">Baja</option> 
                  <option value="2">Media</option> 
                  <option value="3">Alta</option> 
                </select> 
              </label>
            </div>

            <div class="large-6 columns"> 
              <label>Tema
                <select id="qtopic" name="topic"> 
                  <option value="1">1</option> 
                  <option value="2">2</option> 
                </select> 
              </label>
            </div>
          </div> 

          <hr>  

          <h4>Respuestas</h4>

          <div class="row correctAns"> 
            <div class="large-6 columns">
              <label>Respuesta 1 - CORRECTA <textarea  name="ans1"></textarea> </label>
            </div>

            <div class="large-6 columns">
              <label>Feedback <textarea  name="feed1"></textarea> </label>
            </div>

            <div class="large-6 columns">
              <label>URL <input type="text" name="urla1" placeholder="URL de una imagen o video que complemente la respuesta" />  </label>
            </div>

            <div class="large-6 columns">
              <label>URL feedback <input type="text" name="urlf1" placeholder="URL de una imagen o video que complemente el feedback" />  </label>
            </div>

          </div>

          <div class="row grey1"> 
            <div class="large-6 columns">
              <label>Respuesta 2 <textarea  name="ans2"></textarea> </label>
            </div>

            <div class="large-6 columns">
              <label>Feedback <textarea  name="feed2"></textarea> </label>
            </div>

            <div class="large-6 columns">
              <label>URL <input type="text" name="urla2"/>  </label>
            </div>

            <div class="large-6 columns">
              <label>URL feedback <input type="text" name="urlf2" />  </label>
            </div>

          </div>


          <div class="row grey2"> 
            <div class="large-6 columns">
              <label>Respuesta 3 <textarea  name="ans3"></textarea> </label>
            </div>

            <div class="large-6 columns">
              <label>Feedback <textarea  name="feed3"></textarea> </label>
            </div>

            <div class="large-6 columns">
              <label>URL <input type="text" name="urla3" />  </label>
            </div>

            <div class="large-6 columns">
              <label>URL feedback <input type="text" name="urlf3" />  </label>
            </div>

          </div>

          <div class="row grey1"> 
            <div class="large-6 columns">
              <label>Respuesta 4 <textarea  name="ans4"></textarea> </label>
            </div>

            <div class="large-6 columns">
              <label>Feedback <textarea  name="feed4"></textarea> </label>
            </div>

            <div class="large-6 columns">
              <label>URL <input type="text" name="urla4" />  </label>
            </div>

            <div class="large-6 columns">
              <label>URL feedback <input type="text" name="urlf4" />  </label>
            </div>

          </div>

          <br/>

          <a href="#" onclick="createQuestion()" class="button round small right">Crear</a>

        </form>

      </div>
    </div>
  </section>


  <?php include 'includes/templates/footer.php' ?>


  <script src="js/vendor/jquery.js"></script>
  <script src="js/foundation.min.js"></script>
  <script>
    $(document).foundation();

    function createQuestion(){

      var fields = $("#newQuestion").serializeArray();
      console.log(fields);
      

      var topic  = $("#qtopic").val();
      var grade  = $("#qgrade").val();
      var url    = $("#qurl").val();
      var text   = $("#qtext").val();

      var len = fields.length,
      dataObj = {};

      for (i=0; i<len; i++) {
        dataObj[fields[i].name] = fields[i].value;
      }
      
      var data = JSON.stringify(dataObj);
      console.log(data);

      $.post( "controls/doAction.php", {  action: "createQuestion", 
        data: data})
      .done(function( data ) {

        data = JSON.parse(data);
        if(data.message == 'success'){
          alert("La pregunta fue creada");
        }else{
          alert("Error: \n\n" + data.message);
        }

      });
    }

  </script>
</body>
</html>
