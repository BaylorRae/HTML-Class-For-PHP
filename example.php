<?php include 'html.class.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>jQuery HTML Class</title>
<meta charset="utf-8" />

</head>
<body>
  
  <?php
    
    // Create the div
    $div = new html('div');
    
    // Add a few attributes
    $div->attr(array(
        'id' => 'my-div',
        'style' => 'width: 200px; height: 200px; background: red'
      ));
    
    // Build the div
    echo $div
  ?>
  
</body>
</html>