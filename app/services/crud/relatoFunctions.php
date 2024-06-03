<?php

    $hostname = '162.240.17.101';
    $username = 'projetos_nlessa';
    $password = 'Gc&sgY74PK$}';
    $database = 'projetos_INF2023_G10';

    // Create a database connection
    $conn = mysqli_connect($hostname, $username, $password, $database);

    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";

    if ($conn->query($sql) === TRUE) {
        $id = $conn->insert_id;
        $created_at = date('Y-m-d H:i:s');
        echo "<div id='post_$id'>
                <h2>$title</h2>
                <p>$content</p>
                <small>Posted on $created_at</small>
            </div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "SELECT * FROM posts ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div id='post_{$row['id']}'>
                    <h2>{$row['title']}</h2>
                    <p>{$row['content']}</p>
                    <small>Posted on {$row['created_at']}</small>
                </div>";
        }
    } else {
        echo "No posts found.";
    }

    $conn->close();

