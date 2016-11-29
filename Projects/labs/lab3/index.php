<html>
<head>
</head>
<body>
    <form action="handler.php" method="post">
        First Name:<br>
        <input type='text' name='fName'><br>
        Last Name:<br>
        <input type='text' name='lName'><br>
        Gender:<br>
        <input type='radio' name='gender' value='male' checked>Male<br>
        <input type='radio' name='gender' value='female' checked>Female<br><br>
        Interests: <br>
        <?php
            //generate 11 checkboxes.
            $interests = [
                'soccer',
                'dancing',
                'hockey',
                'acting',
                'painting/drawing',
                'video games',
                'gym',
                'paintball/airsoft',
                'snowboard/skiing',
                'action figures',
                'none of above'
            ];
            foreach ($interests as $value) {
                echo "<input type='checkbox' name='interests' value='$value'> $value<br>";
            }

        ?>
        Location :<br>

        <?php
            $countries = array();
            $handle = fopen("/home/vagrant/Code/Projects/labs/lab3/Countries.txt", "r");
            echo "<select name='countryList'>";
            while(($buffer = fgets($handle)) !== false)
            {
                echo "<option value='$buffer'>$buffer</option>";
                array_push($countries,$buffer);
            }
             echo "</select><br><br>";
        ?>
        <input type="submit" value="Submit">
    </form>

</body>
</html>
