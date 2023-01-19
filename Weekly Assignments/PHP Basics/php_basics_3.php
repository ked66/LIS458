<html>
<body>
  <?php
    $age = 75;

    switch(true)
    {
      case $age < 13:
        echo "child";
        break;

      case $age <= 19;
        echo "teenage";
        break;

      case $age <=29;
        echo "young adult";
        break;

      case $age <=60;
        echo "adult";
        break;

      case $age;
        echo "senior";
        break;
    }
  ?>
</body>
</html>
