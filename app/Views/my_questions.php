<?php include 'header.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My questions</title>
    <style>
        .question-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }
        .ask-question-btn {
            order: 1;
            margin-right: 20px;
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
        }

        .ask-question-btn:hover {
            background-color: #45a049;
        }

        .popup-form {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        .popup-form button[type="submit"]{
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .popup-form input[type="text"],
        .popup-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .popup-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        .edit-btn {
            order: 1;
            margin-right: 20px;
            background-color: #FF7F50;
            border: none;
            color: white;
            padding: 7px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="question-header">
        <h1 class="text-capitalize">My Questions</h1>
    </div>
    <hr>
    <?php foreach ($myquestions as $question): ?>
    <div class="question-container">
        <div class="question">
            <h3><?php echo $question['title']; ?></h3>
            <?php
$escapedBody = htmlspecialchars($question['body'], ENT_QUOTES);
?>
            <button class="edit-btn" onclick="togglePopupForm(this)" data-title="<?php echo $question['title']; ?>" data-body="<?php echo $escapedBody; ?>" data-id="<?php echo $question['question_id']; ?>"">Edit</button>
            <p>Answers: 5 | Voted: 10</p>
        </div>
    </div>
    <hr>
    <?php endforeach;?>

    <div class="popup-background" id="popupBackground" style="display: none;" onclick="closePopupForm()"></div>
    <div class="popup-form" id="popupForm" style="display: none;">
        <form action="myquestions" method="POST">
            <input type="hidden" name="question_id" id="question_id">
            <label for="title">Question </label>
            <input type="text" id="title" name="title" required>
            <label for="body">Details of the problem</label>
            <textarea id="body" name="body" rows="4" required></textarea>
            <button type="submit">Update</button>
        </form>
    </div>
    <script>
        function togglePopupForm(button) {
            var form = document.getElementById("popupForm");
            var background = document.getElementById("popupBackground");
            var questiontitle = button.getAttribute('data-title');
            var questionbody = button.getAttribute('data-body');
            var questionid = button.getAttribute('data-id');

            var body = document.getElementById("body");
            var title = document.getElementById("title");
            var question_id = document.getElementById("question_id");
            if (form.style.display === "none") {
                form.style.display = "block";
                background.style.display = "block";
                body.value=questionbody;
                title.value=questiontitle;
                question_id.value=questionid;
            } else {
                form.style.display = "none";
                background.style.display = "none";
            }
        }
        function closePopupForm() {
            var form = document.getElementById("popupForm");
            var background = document.getElementById("popupBackground");
            form.style.display = "none";
            background.style.display = "none";
        }
    </script>
</body>
</html>
