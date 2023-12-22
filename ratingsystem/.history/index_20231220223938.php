<!DOCTYPE html>
<html>
    <head>
        <title>Reviews System</title>
        <link rel="stylesheet" type="text/css" href="style.css">

    </head>
    <body>

        <div class="content home">
            <div class="reviews"></div>
            <script src="reviews.js"></script>

            <script>
                new Reviews(
                    {
                        page_id:1,
                        reviews_per_pagination_page:5,
                        current_pagination_page:1
                    }
                );
            </script>    
        </div>   
    </body>

</html>    
