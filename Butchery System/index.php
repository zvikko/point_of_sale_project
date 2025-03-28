<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Login</title>
</head>

<body onload="load();">
    <section class="container loginContainer">
        <div class="login">
            <div class="loginForm">
                <form id="form1" accept="" autocomplete="off">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">User Name</label>
                        <input type="text" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" class="form-control" required id="userName">
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" class="form-control" required id="userPassword">
                        <span class="error" id="error"></span>
                    </div>
                    <!-- <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <div style="display: none;" class="keyboard">
                    <div id="VirtualKey">
                        <input id="btn1" type="button" onclick="input(this);" value="q" />
                        <input id="btn2" type="button" onclick="input(this);" value="w" />
                        <input id="btn3" type="button" onclick="input(this);" value="e" />
                        <input id="btn4" type="button" onclick="input(this);" value="r" />
                        <input id="btn5" type="button" onclick="input(this);" value="t" />
                        <input id="btn6" type="button" onclick="input(this);" value="y" />
                        <input id="btn7" type="button" onclick="input(this);" value="u" />
                        <input id="btn8" type="button" onclick="input(this);" value="i" />
                        <input id="btn9" type="button" onclick="input(this);" value="o" />
                        <input id="btn10" type="button" onclick="input(this);" value="p" />

                        <br />
                        <input id="btn11" type="button" onclick="input(this);" value="a" />
                        <input id="btn12" type="button" onclick="input(this);" value="s" />
                        <input id="btn13" type="button" onclick="input(this);" value="d" />
                        <input id="btn14" type="button" onclick="input(this);" value="f" />
                        <input id="btn15" type="button" onclick="input(this);" value="g" />
                        <input id="btn16" type="button" onclick="input(this);" value="h" />
                        <input id="btn17" type="button" onclick="input(this);" value="j" />
                        <input id="btn18" type="button" onclick="input(this);" value="k" />
                        <input id="btn19" type="button" onclick="input(this);" value="l" />

                        <br />
                        <input id="btn20" type="button" onclick="input(this);" value="z" />
                        <input id="btn21" type="button" onclick="input(this);" value="x" />
                        <input id="btn22" type="button" onclick="input(this);" value="c" />
                        <input id="btn23" type="button" onclick="input(this);" value="v" />
                        <input id="btn24" type="button" onclick="input(this);" value="b" />
                        <input id="btn25" type="button" onclick="input(this);" value="n" />
                        <input id="btn26" type="button" onclick="input(this);" value="m" />
                        <br />

                        <input id="btnDel" type="button" value="Backspace" onclick="del();" />
                        <input id="btn0" type="button" onclick="input(this)" value=" " style="width: 100px;" />
                        <br />
                        <input id="btn31" type="button" onclick="input(this);" value="7" />
                        <input id="btn32" type="button" onclick="input(this);" value="8" />
                        <input id="btn33" type="button" onclick="input(this);" value="9" />
                        <br />
                        <input id="btn34" type="button" onclick="input(this);" value="4" />
                        <input id="btn35" type="button" onclick="input(this);" value="5" />
                        <input id="btn36" type="button" onclick="input(this);" value="6" />
                        <br>
                        <input id="btn28" type="button" onclick="input(this);" value="1" />
                        <input id="btn29" type="button" onclick="input(this);" value="2" />
                        <input id="btn30" type="button" onclick="input(this);" value="3" />
                        <br>

                        <input id="btn27" type="button" onclick="input(this);" value="0" style="width: 42px;" />
                        <input id="btn37" type="button" onclick="input(this);" value="." />

                    </div>

                </div>
            </div>
        </div>
        <div class="logos">
            <div class="cover">

            </div>
            <h1 class="logo">

            </h1>
        </div>
    </section>
    <div id="results"></div>
    <div class="background">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <script src="./jquery/jquery-3.5.1.js"></script>
    <script>
        $('input').attr('autocomplete', 'off');
        $(document).on('submit', '#form1', function(event) {
            var userName = $("#userName").val();
            var userPassword = $("#userPassword").val();
            $.ajax({
                url: "./database/process.php",
                type: "post",
                //async: false,
                data: {
                    "login": 1,
                    "userName": userName,
                    "userPassword": userPassword

                },
                beforeSend: function() {
                    $(".background").css("display", "block");
                },
                success: function(data) {
                    $("#results").html(data);
                    $(".background").css("display", "none");

                }
            })
            event.preventDefault();
        })

        function load() {
            document.getElementById("userName").focus();
            var array = new Array();

            while (array.length < 10) {
                var temp = Math.round(Math.random() * 9);
                if (!contain(array, temp)) {
                    array.push(temp);
                }
            }
            for (i = 0; i < 10; i++) {
                var btn = document.getElementById("btn" + i);
                btn.value = array[i];
            }
        }

        function input(e) {
            var tbInput = document.getElementById("userName");
            tbInput.value = tbInput.value + e.value;
        }

        function del() {
            var tbInput = document.getElementById("userName");
            tbInput.value = tbInput.value.substr(0, tbInput.value.length - 1);
        }
    </script>
</body>

</html>