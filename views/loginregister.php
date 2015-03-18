<html>
<head>




</head>
<body>


    <div id="login_div">
        <form action="./user/login" method="post" id="login_form">
            <div id="login">
                <h2>Already a member? Log in here!</h2>

                <input type="text" placeholder="E-mail" name="email1" class="input"/>

                <input type="password" placeholder="Password" name="password1" class="input"/>

                <input type="submit" name="login" value="Log In" class="button"/>
            </div>
        </form>
    </div>
    <div id="register_div">
        <form action="./user/register" method="post" id="register_form">
            <div id="register">
                <h1>REGISTER</h1>
                </br>
                <input type="text" placeholder="First name" name="fname" class="input"/>
                </br>
                <input type="text" placeholder="Last name" name="lname" class="input"/>
                </br>
                <input type="text" placeholder="E-mail" name="email2" class="input"/>
                </br>
                <input type="password" placeholder="Password" name="password2" class="input"/>
                </br>
                <input type="password" placeholder="Repeat password" name="password3" class="input"/>
                </br>
                <input type="submit" name="register" value="REGISTER" class="button"/>
            </div>
        </form>
    </div>



</body>
</html>