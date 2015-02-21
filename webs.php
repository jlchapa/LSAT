<?php

require 'core/init.php';

$user = new User();
$user->checkIsValidUser('teacher');
$teacherId = $user->data()->id;
$groups = new Groups();
$teacherGroups = $groups->getGroupsForTeacher($teacherId);
//var_dump($teacherGroups);

?>

<!doctype html>
<html class="no-js" lang="en">
<head>
  <title>LSAT | Webs</title>
  <?php include 'includes/templates/headTags.php' ?>
</head>

<body>

  <?php include 'includes/templates/header.php' ?>

  <section class="scroll-container" role="main">

    <div class="row">
    <?php include 'includes/templates/teacherSidebar.php' ?>  
      <div class="large-9 medium-8 columns">
        <h3>Redes</h3>
        <h4 class="subheader">Mis redes de aprendizaje</h4>
        <hr>  

        <table> 
         <thead> 
           <tr> 
             <th width="300">Red</th> 
             <th width="200">Fecha de creacion</th> 
             <th width="300">Edit</th> 
           </tr> 
         </thead>

         <tbody> 
           <?php
           foreach ($teacherGroups as $group) {

              echo "<tr id='$group->id'> 
                    <td> $group->name </td>
                    <td> $group->term </td>
                    <td> <a onclick=\"editGroup($group->id);\" class='tiny button secondary'>Editar</a> </td> 
                    </tr>";
         }

         ?>

       </tbody>
     </table>
        
     </div>
   </div>
 </section>


<?php include 'includes/templates/footer.php' ?>


<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
  $(document).foundation();

</script>
</body>
</html>
