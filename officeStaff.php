<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <link rel="stylesheet" href="main2.css">
    <style>
        body {
            margin: 0;
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url("background.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            width: 100%;
            background-position: center;
            height: 100%;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .chart-container {
            display: flex;
    flex-direction: row; /* Display side by side */
    justify-content: space-between; /* Adjust as needed */
    align-items: center;
    height: 400px; /* Adjust the height of the container */
    width: 80%; /* Utilize the full width of the container */
    align-self: center;
    color: white;
    margin: 10px; /* Adjust margin as needed */
        }
        .dropbtn {
    padding: 10px;
    text-decoration: none;
    color: WHITE;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color:linear-gradient(to top, rgba(0, 0, 0, 0.8) 50%, rgba(0, 0, 0, 0.8) 50%);
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
}
#barChartOverall {
    border: 4px solid black;
    margin-right: 20px; /* Add right margin to the first canvas */
}

/*.footer {
    background-color: pink; 
    color: black;
    text-align: center;
    padding: 20px;
    position: fixed;
    bottom: 0;
    width: 80%;
    margin: 0; 
}*/

#barChartLoc {
    border: 4px solid black;
    margin-left: 20px; /* Add left margin to the second canvas */
}

.dropbtn {
    padding: 10px;
    text-decoration: none;
    color: WHITE;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: linear-gradient(to top, rgba(0, 0, 0, 0.7) 50%, rgba(0, 0, 0, 0.7) 50%);
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

/* Show the dropdown content when hovering over the dropdown button */
.dropdown:hover .dropdown-content {
    display: block;
}
        /* Style for the profile picture */
        .profile-picture {
            float: right;
            /* padding: 10px; */
        }

        .profile-picture img {
            width: 40px; /* Adjust the width as needed */
            height: 40px; /* Adjust the height as needed */
            border-radius: 50%; /* Make it a circular image */
            
        }
        .chart-container1 {
            display: flex;
    flex-direction: row; /* Display side by side */
    justify-content: space-between; /* Adjust as needed */
    align-items: center;
    height: 20px; /* Adjust the height of the container */
    width: 80%; /* Utilize the full width of the container */
    align-self: center;
    color: white;
    margin: 10px; /* Adjust margin as needed */
        }
        .dropbtn {
    padding: 10px;
    text-decoration: none;
    color: WHITE;
}
.table-container {
        margin-top: 20px;
    }

    .statistics-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .statistics-table th,
    .statistics-table td {
        border: 3px solid white;
        padding: 10px;
        text-align: center;
        color: white;
    }

    .statistics-table th {
        background-color: transparent;
    }

    .statistics-table tr:nth-child(even) {
        background-color: transparent;
    }

    .statistics-table tr:nth-child(odd) {
        background-color: transparent;
    }
    </style>
</head>
<body>
    <div class="container">
    <div class="navbar">
            <div class="icon">
                <h2 class="logo">WHOQOL</h2>
            </div>

            <div class="menu">
            <ul>
        <li><a href="main2.php">HOME</a></li>
        <li class="dropdown">
            <a href="#" class="dropbtn">PERSONAL</a><br>
            <div class="dropdown-content"><br>
                <a href="per.php">YOUR SCORES</a><br><br>
                <a href="stats.php">SCORE VS AVG SCORE</a><br><br>

            </div>
        </li>
        <li class="dropdown">
            <a href="#" class="dropbtn">ANALYSIS</a><br>
            <div class="dropdown-content"><br>
            <a href="overall.php">OVERALL</a><br><br>

                <a href="teaching.php">TEACHING</a><br><br>
                <a href="nonteaching.php">NON-TEACHING</a><br><br>
                <a href="officeStaff.php">OFFICE STAFF</a>
            </div>
        </li>
        <div class="profile-picture">
        <li class="dropdown">
                <img src="user.png" alt="Profile Picture">

                <!-- <a href="#" class="dropbtn">PROFILE</a><br> -->
                <div class="dropdown-content"><br>
                    <a href="edit.php">EDIT PROFILE</a><br><br>
                    <a href="per1.php">RECENT SCORES</a><br><br>

                    <a href="logout.php">LOGOUT</a><br><br>
                </div>
            </li>
    </div>
    </ul>
        <li><a href="logout.php"></a></li>
    </ul>
            </div>
        </div> <br><br>

        <?php
        include "database.php";

        // Check if the user is logged in
        if (isset($_SESSION["emp_id"]) || !isset($_SESSION["emp_id"])) {
            $teachingData = fetchAndCalculateAverageUniversity($conn, 'office-staff');
            $femaleTeachingData = fetchAndCalculateAverageByGenderAndUniversityRole($conn, 'female', 'office-staff');
            $maleTeachingData = fetchAndCalculateAverageByGenderAndUniversityRole($conn, 'male', 'office-staff');
            $age1930Data = fetchAndCalculateAverageByAgeRange($conn, 19, 30,"office-staff");
            $age3140Data = fetchAndCalculateAverageByAgeRange($conn, 31, 40,"office-staff");
            $age4150Data = fetchAndCalculateAverageByAgeRange($conn, 41, 50,"office-staff");
            $age5160Data = fetchAndCalculateAverageByAgeRange($conn, 51, 60,"office-staff");
            $age60plusData = fetchAndCalculateAverageByAgeRange($conn, 61, PHP_INT_MAX,"office-staff");
        
            // Pass the combined data to JavaScript
            echo "<script>let age1930Data = " . json_encode($age1930Data) . ";</script>";
            echo "<script>let age3140Data = " . json_encode($age3140Data) . ";</script>";
            echo "<script>let age4150Data = " . json_encode($age4150Data) . ";</script>";
            echo "<script>let age5160Data = " . json_encode($age5160Data) . ";</script>";
            echo "<script>let age60plusData = " . json_encode($age60plusData) . ";</script>";
            echo "<script>let femaleTeachingData = " . json_encode($femaleTeachingData) . ";</script>";
            echo "<script>let maleTeachingData = " . json_encode($maleTeachingData) . ";</script>";
            echo "<script>let teachingData = " . json_encode($teachingData) . ";</script>";
        }
        function fetchAndCalculateAverageByAgeRange($conn, $minAge, $maxAge, $university_role) {
            $sql = "SELECT u.*, s.*
                    FROM users u
                    LEFT JOIN score s ON u.emp_id = s.emp_id
                    WHERE u.age >= ? AND u.age <= ?
                    AND u.university_role= ?
                    UNION
                    SELECT u.*, s.*
                    FROM users u
                    RIGHT JOIN score s ON u.emp_id = s.emp_id
                    WHERE u.age >= ? AND u.age <= ?
                    AND u.university_role= ?";
        
            return fetchAndCalculateAverage1($conn, $sql, $minAge, $maxAge, $university_role, $minAge, $maxAge, $university_role);
        }
        
        function fetchAndCalculateAverage1($conn, $sql, ...$params) {
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        
            if ($prepareStmt) {
                // Adjust the number of placeholders in the SQL statement
                $paramTypes = str_repeat('s', count($params));
                mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
        
                $combinedData = [
                    'ph' => [],
                    'mh' => [],
                    'sh' => [],
                    'eh' => [],
                    'overall' => [],
                ];
        
                // Fetch data from the result set
                while ($row = mysqli_fetch_assoc($result)) {
                    $combinedData['ph'][] = (float)$row['ph_score'];
                    $combinedData['mh'][] = (float)$row['mh_score'];
                    $combinedData['sh'][] = (float)$row['sh_score'];
                    $combinedData['eh'][] = (float)$row['eh_score'];
                    $combinedData['overall'][] = (float)$row['overall'];
                }
        
                // Calculate averages
                foreach ($combinedData as &$scores) {
                    if (!empty($scores)) {
                        $scores = array_sum($scores) / count($scores);
                    } else {
                        $scores = 0;
                    }
                }
        
                return $combinedData;
            } else {
                echo "Error preparing SQL statement.";
            }
        }
        function fetchAndCalculateAverageUniversity($conn, $university) {
            $sql = "SELECT u.*, s.*
                FROM users u
                LEFT JOIN score s ON u.emp_id = s.emp_id
                WHERE u.university_role = ?
                UNION
                SELECT u.*, s.*
                FROM users u
                RIGHT JOIN score s ON u.emp_id = s.emp_id
                WHERE u.university_role = ?";


            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt, "ss", $university, $university);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                $combinedData = [
                    'ph' => [],
                    'mh' => [],
                    'sh' => [],
                    'eh' => [],
                    'overall' => [],
                ];

                // Fetch data from the result set
                while ($row = mysqli_fetch_assoc($result)) {
                    $combinedData['ph'][] = (float)$row['ph_score'];
                    $combinedData['mh'][] = (float)$row['mh_score'];
                    $combinedData['sh'][] = (float)$row['sh_score'];
                    $combinedData['eh'][] = (float)$row['eh_score'];
                    $combinedData['overall'][] = (float)$row['overall'];
                }
                foreach ($combinedData as &$scores) {
                    if (!empty($scores)) {
                        $scores = array_sum($scores) / count($scores);
                    } else {
                        $scores = 0;
                    }
                }
                return $combinedData;
            } else {
                echo "Error preparing SQL statement.";
            }
        }
        function fetchAndCalculateAverageByGenderAndUniversityRole($conn, $gender, $universityRole) {
            $sql = "SELECT u.*, s.*
                    FROM users u
                    LEFT JOIN score s ON u.emp_id = s.emp_id
                    WHERE u.gender = ? AND u.university_role = ?
                    UNION
                    SELECT u.*, s.*
                    FROM users u
                    RIGHT JOIN score s ON u.emp_id = s.emp_id
                    WHERE u.gender = ? AND u.university_role = ?";

            return fetchAndCalculateAverage($conn, $sql, [$gender, $universityRole, $gender, $universityRole]);
        }
        function fetchAndCalculateAverage($conn, $sql, $params) {
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

            if ($prepareStmt) {
                $paramTypes = str_repeat('s', count($params));
                mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                $combinedData = [
                    'ph' => [],
                    'mh' => [],
                    'sh' => [],
                    'eh' => [],
                    'overall' => [],
                ];

                while ($row = mysqli_fetch_assoc($result)) {
                    $combinedData['ph'][] = (float)$row['ph_score'];
                    $combinedData['mh'][] = (float)$row['mh_score'];
                    $combinedData['sh'][] = (float)$row['sh_score'];
                    $combinedData['eh'][] = (float)$row['eh_score'];
                    $combinedData['overall'][] = (float)$row['overall'];
                }

                foreach ($combinedData as &$scores) {
                    if (is_array($scores) && !empty($scores)) {
                        $scores = array_sum($scores) / count($scores);
                    } else {
                        $scores = 0;
                    }
                }

                return $combinedData;
            } else {
                echo "Error preparing SQL statement: " . mysqli_error($conn);
            }
        }
    ?> 
               <?php echo "<h1 style='color: white; text-align: center;  font-size: 2em; text-decoration: underline;'>Analysis of Office-Staff</h1>"?><br><br>

    <div class="chart-container1">
           <?php echo "<h2 style='color: white; text-align: center; font-size: 1.5em;'>Pie Chart - Health Scores Overall</h2> <h2 style='color: white; text-align: center; white-space: nowrap; font-size: 1.5em;'>Grouped Bar Chart - Health Scores by Gender</h2>"; ?>
    </div>
        <div class="chart-container">
            <canvas id="barChartOverall" height=400 width=800></canvas>
            <canvas id="barChartLoc" height=400 width=800></canvas>
        </div>
        <?php echo "<h2 style='color: white; text-align: center; font-size: 1.5em;'>Health Scores by Age</h2>"?>

        <div class="table-container">
    <table class="statistics-table">
        <thead>
            <tr>
                <th>Age Range</th>
                <th>PH</th>
                <th>MH</th>
                <th>SH</th>
                <th>EH</th>
                <th>Overall</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>19-30</td>
                <td><?php echo number_format($age1930Data['ph'], 2); ?></td>
                <td><?php echo number_format($age1930Data['mh'], 2); ?></td>
                <td><?php echo number_format($age1930Data['sh'], 2); ?></td>
                <td><?php echo number_format($age1930Data['eh'], 2); ?></td>
                <td><?php echo number_format($age1930Data['overall'], 2); ?></td>
            </tr>
            <tr>
                <td>31-40</td>
                <td><?php echo number_format($age3140Data['ph'], 2); ?></td>
                <td><?php echo number_format($age3140Data['mh'], 2); ?></td>
                <td><?php echo number_format($age3140Data['sh'], 2); ?></td>
                <td><?php echo number_format($age3140Data['eh'], 2); ?></td>
                <td><?php echo number_format($age3140Data['overall'], 2); ?></td>
            </tr>
            <tr>
                <td>41-50</td>
                <td><?php echo number_format($age4150Data['ph'], 2); ?></td>
                <td><?php echo number_format($age4150Data['mh'], 2); ?></td>
                <td><?php echo number_format($age4150Data['sh'], 2); ?></td>
                <td><?php echo number_format($age4150Data['eh'], 2); ?></td>
                <td><?php echo number_format($age4150Data['overall'], 2); ?></td>
            </tr>
            <tr>
                <td>51-60</td>
                <td><?php echo number_format($age5160Data['ph'], 2); ?></td>
                <td><?php echo number_format($age5160Data['mh'], 2); ?></td>
                <td><?php echo number_format($age5160Data['sh'], 2); ?></td>
                <td><?php echo number_format($age5160Data['eh'], 2); ?></td>
                <td><?php echo number_format($age5160Data['overall'], 2); ?></td>
            </tr>
            <tr>
                <td>60+</td>
                <td><?php echo number_format($age60plusData['ph'], 2); ?></td>
                <td><?php echo number_format($age60plusData['mh'], 2); ?></td>
                <td><?php echo number_format($age60plusData['sh'], 2); ?></td>
                <td><?php echo number_format($age60plusData['eh'], 2); ?></td>
                <td><?php echo number_format($age60plusData['overall'], 2); ?></td>
            </tr>
        </tbody>
    </table>
</div>
<br><br>
        <footer class="footer">
            <p>&copy; 2023 WHOQOL. All rights reserved.</p>
        </footer >
        <script src="drawoffice.js"></script>
    </body>
    </html>