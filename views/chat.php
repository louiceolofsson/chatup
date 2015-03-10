<?php
session_start();
?>

<html>

<head>

</head>
<body>
    <p>DU ÄR NU INLOGGAD!!!</p>


    <div id="entire_logout">
        <form action="/PHP_171114/chatup/user/logout" method="post">
            <input type="submit" value="Log out" name="submit_logout" id="logout_button"/>
        </form>
    </div>
</body>
</html>