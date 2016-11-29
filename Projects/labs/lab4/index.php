<?php
    if (isset($_POST['submit'])) {
        echo "success you're in second script.";

        // check if all data entered is correct.
        $fName = "hello";
        if (!empty($_POST['fName']))
            $fName = strip_tags($_POST['fName']);
        else
            echo "first name box is empty!<br>";
        if (!empty($_POST['lName']))
            $lName = strip_tags($_POST['lName']);
        else
            echo "last name box is empty!<br>";

        //$countries = array();
        //$second_handler = fopen("/home/vagrant/Code/Projects/labs/lab3/Countries.txt", "r");
        //while(($buffer = fgets($second_handler)) !== false)
        //{
        //    array_push($countries, $buffer);
        //}

        echo array_diff($interests, $_POST['interests']);
        foreach ($countries as $value) {
            if (!in_array($value, $_POST['countryList']))
                echo "It is not in hte array! $value";
        }
    }
?>
<html>
<head>
</head>
    <body>
        <form method="post" action="">
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
            while (($buffer = fgets($handle)) !== false) {
                echo "<option value='$buffer'>$buffer</option>";
                array_push($countries, $buffer);
            }
            echo "</select><br><br>";
            ?>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>
