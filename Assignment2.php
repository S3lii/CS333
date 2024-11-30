<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB Students by Nationality</title>
    <style>
        body {
            background-color: #f4f4f9;
            color: #333;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #0056b3;
            color: #fff;
            text-align: center;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        header h1 {
            font-size: 2.5rem;
            margin: 0;
        }

        
        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        table th, table td {
            padding: 1.2rem;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: white;
            font-size: 1.1rem;
        }

        table tbody tr {
            transition: background-color 0.3s ease;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #e0f7fa;
        }

        footer {
            text-align: center;
            padding: 1rem;
            background-color: #0056b3;
            color: white;
            font-size: 0.9rem;
        }

        footer a {
            color: #ffd700;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table {
                width: 100%;
                font-size: 0.9rem;
            }

            table th, table td {
                padding: 0.8rem;
            }
        }

        .empty {
            text-align: center;
            color: red;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

<header>
    <h1>UOB - Students by Nationality</h1>
</header>

<div class="container">
    <?php
    // API URL
    $apiUrl = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

    // Fetch and decode the API data
    $response = file_get_contents($apiUrl);

    // Check if the API call was successful
    if ($response === FALSE) {
        echo "<p>Unable to fetch data from the API. Please try again later.</p>";
    } else {
        // Decode the JSON response
        $result = json_decode($response, true);

        // Check if data is available
        if (isset($result['results']) && count($result['results']) > 0) {
            echo "<table>";
            echo "<thead>
                    <tr>
                        <th>Year</th>
                        <th>Semester</th>
                        <th>Program</th>
                        <th>Nationality</th>
                        <th>Colleges</th>
                        <th>Number of Students</th>
                    </tr>
                  </thead>";
            echo "<tbody>";

            foreach ($result['results'] as $item) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($item['year'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($item['semester'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($item['the_programs'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($item['nationality'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($item['colleges'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($item['number_of_students'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p class='empty'>No data found</p>";
        }
    }
    ?>
</div>

<footer>
    <p>By <a href="https://data.gov.bh" target="_blank">Bahrain Open Data Portal</a> </p>
</footer>

</body>
</html>
