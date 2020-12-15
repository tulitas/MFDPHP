<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Live MySQL Database Search</title>
    <style type="text/css">
        body {
            font-family: Arail, sans-serif;
        }

        /* Formatting search box */
        .search-box {
            width: 300px;
            position: relative;
            display: inline-block;
            font-size: 14px;
        }

        .search-box input[type="text"] {
            height: 32px;
            padding: 5px 10px;
            border: 1px solid #bb6363;
            font-size: 14px;
            border-radius: 6px;
        }

        .result {
            position: absolute;
            z-index: 999;
            top: 100%;
            left: 0;
        }

        .search-box input[type="text"], .result {
            width: 100%;
            box-sizing: border-box;
        }

        /* Formatting result items */
        .result p {
            margin: 0;
            padding: 7px 10px;
            border: 1px solid #4e7784;
            border-top: none;
            cursor: pointer;
            border-radius: 6px;
        }

        .result p:hover {
            background: #cdb8a7;
        }

        .bottomleft {
            position: absolute;
            bottom: 8px;
            left: 16px;
            font-size: 18px;
        }

        .button {
            position: absolute;
            left: 310px;
            top: 7px
        }

    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.search-box input[type="text"]').on("keyup input", function () {
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if (inputVal.length) {
                    $.get("backend-search.php", {term: inputVal}).done(function (data) {
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else {
                    resultDropdown.empty();
                }
            });

            // Set search input value on click of result item
            $(document).on("click", ".result p", function () {
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });
    </script>
</head>
<body>

<div class="search-box">
    <form method="post" action="search-by-pk.php">
        <input name="roll_no" type="text" autocomplete="off" placeholder="Ievadiet personas kodu..."/>
        <div class="result" ></div>
        <button type="submit" name="search" class="button">Atvert pacientu</button>
    </form>
</div>
<br>

<a href="/MFDPHP/index.php" class="bottomleft">home</a>
</body>
</html>