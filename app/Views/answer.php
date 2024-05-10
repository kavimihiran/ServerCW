<?php include 'header.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Answer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .question {
            margin-bottom: 50px;
        }
        .problem {
            font-weight: bold;
            margin-bottom: 10px;
            color: royalblue;
        }
        .answers {
            font-weight: bold;
            margin-bottom: 10px;
            color: royalblue;
        }
        .answer-container {
            margin-top: 20px;
        }
        .answer-btn {
            margin-top: 10px;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .line {
            margin-top: 20px;
            border-top: 1px solid #ccc;
        }
        .answer-textarea {
            width: 100%;
            height: 200px;
            margin-top: 20px;
        }
        .answer {
            background-color: gray;
            color: white;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 10px;
        }

        .answer-body {
             width: calc(100% - 20px);
        }

        .no-answer {
            background-color: gray;
            color: white;
            padding: 10px;
        }
        .vote-buttons {
            margin-top: 20px;
        }

        .vote-buttons i {
            font-size: 24px;
            cursor: pointer;
            margin-right: 10px;
        }

        .vote-buttons i:hover {
            color: royalblue;
        }
        .vote-count {
            color: red;
            font-weight: bold;
            display: inline-block;
            padding: 5px 10px;
            border: 2px solid black;
            border-radius: 5px;
            background-color: white;
        }
        .comment-box {
            background-color: white;
            color: black;
            margin-bottom: 5px;
            border-radius: 5px;
            border: 1px solid black;
        }

    </style>
</head>
<body>
    <div class="container">
        <?php
if (isset($_GET['title'])) {
    $questionTitle = urldecode($_GET['title']);
    $questionBody = urldecode($_GET['body']);
    $questionId = urldecode($_GET['question_id']);

    echo "<div class='question'>";
    echo "<h2>$questionTitle</h2>";
    echo "</div>";
    echo "<div class='problem'>";
    echo "<h3>The problem</h3>";
    echo "</div>";
    echo "<p>$questionBody</p>";

    echo "<div class='vote-buttons'>";
    echo "<i class='fas fa-thumbs-up' onclick='questionvote(\"$questionId\", \"up\")'></i>";
    echo "<i class='fas fa-thumbs-down' onclick='questionvote(\"$questionId\", \"down\")'></i>";
    echo "</div>";

    echo "<div class='line'></div>";

    echo "<div class='answers'>";
    echo "<h3>Answers</h3>";
    echo "</div>";
    if (!empty($answers)) {
        foreach ($answers as $answer) {
            echo "<div class='answer'>";
            echo "<div class='answer-body'>";
            echo "<p>{$answer['body']}</p>";
            $answerId = $answer['answer_id'];
            $tickColor = $answer['isAccepted'] == 1 ? 'green' : 'white';
            echo "<div class='vote-buttons'>";
            echo "<i class='fas fa-thumbs-up' onclick='answervote(\"$answerId\", \"up\")'></i>";
            echo "<i class='fas fa-thumbs-down' onclick='answervote(\"$answerId\", \"down\")'></i>";
            echo "<p class='vote-count'>votes : {$answer['votes']}</p>";
            echo "</div>";
            echo "</div>";
            echo "<i id='tick-icon-$answerId' class='fas fa-check' style='color: $tickColor' class='fas fa-check' onclick='selectAnswer(\"$answerId\")'></i>";

            echo "<div>";
            echo "<a href='#' class='add-comments' style='color: black;' onclick='showCommentForm(\"$answerId\")'>+ Add Comments</a>";
            if (!empty($answer['comments'])) {
                foreach ($answer['comments'] as $comment) {
                    echo "<div class='comment-box'>";
                    echo "<p>{$comment['body']}</p>";
                    echo "</div>";
                }
            } else {
                echo "<div class='no-answer'>";
                echo "<p>No comments yet.</p>";
                echo "</div>";
            }

            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<div class='no-answer'>";
        echo "<p>No answers yet.</p>";
        echo "</div>";
    }
    echo "<div class='line'></div>";
    echo "<div class='answer-container'>";
    echo "<h3>Answer this Question</h3>";
    echo "<form action='/answers' method='post'>";
    echo "<textarea class='answer-textarea' name='body' placeholder='Type your answer here'></textarea>";
    echo "<input type='hidden' name='question_Id' value='$questionId'>";
    echo "<button type='submit' class='answer-btn'>Post Answer</button>";
    echo "</form>";
    echo "</div>";
} else {
    echo "<p>Sucessfully Answered.</p>";
}
?>
        <script>
            function questionvote(questionId, action) {
                if(action == 'down'){
                    showModal("Unvote question");
                }else if(action == 'up'){
                    showModal("Vote question");
                }
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            alert("Sucessfull");
                        }
                    }
                };
                xhr.open("POST", "/questionVote", true);
                xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                xhr.send(JSON.stringify({ questionId: questionId, action: action }));
            }
            function answervote(answerId, action) {
                if(action == 'down'){
                    showModal("Unvote answer");
                }else if(action == 'up'){
                    showModal("Vote answer");
                }
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            alert("Sucessfull");
                        }
                    }
                };
                xhr.open("POST", "/answerVote", true);
                xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                xhr.send(JSON.stringify({ answerId: answerId, action: action }));
            }
            function selectAnswer(answerId) {
                showModal("Mark Answer as accepted");
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            alert("Sucessfull");
                        }
                    }
                };
                xhr.open("POST", "/marked", true);
                xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                xhr.send(JSON.stringify({ answerId: answerId}));
            }
            function showModal(message) {
                var modal = document.createElement('div');
                modal.innerHTML = '<div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #4CAF50; padding: 20px; border: 5px solid black;">' +
                      '<p>' + message + '</p>' +
                      '<button onclick="refreshPage()">OK</button>' +
                      '</div>';
                document.body.appendChild(modal);
            }
            function refreshPage() {
                 window.location.reload();
            }
            function showCommentForm(answerId) {
                var modal = document.createElement('div');
                modal.innerHTML =   '<div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f0f0f0; padding: 20px; border: 2px solid black; border-radius: 5px;">' +
                                    '<form action="/comments" method="post">' +
                                    '<textarea name="body" placeholder="Enter your comment" style="width: 100%; height: 100px; margin-bottom: 10px;"></textarea>' +
                                    '<input type="hidden" name="answerId" value="' + answerId + '">' +
                                    '<button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Submit</button>' +
                                    '</form>' +
                                    '</div>';
                document.body.appendChild(modal);
            }
        </script>
    </div>
</body>
</html>
