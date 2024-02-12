<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="reviews.css">
    <style>
        .popup {
            width: 400px;
            background:white;
            border-radius: 6px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.1);
            padding: 0 30px 30px;
            visibility: hidden;
            transition: transform 0.4s, top 0.4s;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .popupnew {
            width: 400px;
            background: white;
            border-radius: 6px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.1);
            text-align: center;
            padding: 0 30px 30px;
            visibility: hidden;
            transition: transform 0.4s, top 0.4s;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .popup img, .popupnew img {
            width: 100px;
            margin-top: -50px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .popup h2, .popupnew h2 {
            font-size: 24px;
            font-weight: 500;
            margin: 20px 0 10px;
        }

        .popup p, .popupnew p {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
        }

        .popup button, .popupnew button {
            width: 100%;
            margin-top: 20px;
            padding: 10px 0;
            color: white;
            border: 0;
            outline: none;
            font-size: 18px;
            background-color: green;
            border-radius: 4px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .open-popup {
            visibility: visible;
            top: 50%;
            transform: translate(-50%, -50%) scale(1);
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Reviews and Ratings</h2>
    <button type="button" class="btn" onclick="openPopup()">Add Review</button>
    <div class="popup" id="popup">
        <div class="submit_review">
            <form id="reviewForm" action="review.php" method="post" onsubmit="showPopupNew()">
                <h2>Add Review</h2>
                <label for="name">Name:</label>
                <br>
                <input type="text" name="name" required>
                <br>
                <label for="rating">Rating:</label>
                <br>
                <input type="number" name="rating" min="1" max="5" required>
                <br>
                <label class="write_review_textarea" for="content">Review:</label>
                <br>
                <textarea name="content" rows="10" cols="50"></textarea>
                <button type="submit" class="btn" onclick="closePopup()">Submit</button>
            </form>
        </div>
    </div>
    <div class="popupnew" id="popupnew">
        <img src="tick.png" alt="tick picture">
        <h2>Thank You!</h2>
        <p>Your review has been successfully submitted.</p>
        <button type="button" onclick="closePopupnew()">OK</button>
    </div>
</div>

<div class="content home">
    <div class="reviews"></div>
    <script src="reviews.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const reviewForm = document.getElementById("reviewForm");
            new Reviews({
                page_id: 1,
                reviews_per_pagination_page: 5,
                current_pagination_page: 1,
                reviewForm: reviewForm,
            });
        });
    </script>
</div>

<script>
    let popup = document.getElementById("popup");
    let popupnew = document.getElementById("popupnew");
    //let reviewForm = document.getElementById("reviewForm");

    function openPopup() {
        popup.classList.add("open-popup");
    }

    function closePopup() {
        popup.classList.remove("open-popup");


    }

    function closePopupnew() {
        popupnew.classList.remove("open-popup");

    }

    function showPopupNew() {
        popupnew.classList.add("open-popup");
    }


</script>
</body>
</html>
