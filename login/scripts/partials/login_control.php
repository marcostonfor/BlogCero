<?php

class Login_control
{

    public function control()
    {
        ?>
        <div class="dropdown">
            <a href="javascript:void(0)" onclick="myFunction()" class="dropbtn">
            panel login <!-- <img src="../login/scripts/partials/image/avatar.jpg" alt="avatar"> -->
            </a>
            <div id="myDropdown" class="dropdown-content">
                <a href="../admin/adminPanel.php">Dashboard</a>
                <a href="#">About</a>
                <a href="#">Contact</a>
                <a href="../login/scripts/logout.php">Logout</a>
            </div>
        </div>
        <script>
            /* When the user clicks on the button, 
            toggle between hiding and showing the dropdown content */
            function myFunction() {
                document.getElementById("myDropdown").classList.toggle("show");
            }

            // Close the dropdown if the user clicks outside of it
            window.onclick = function (event) {
                if (!event.target.matches('.dropbtn')) {
                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    var i;
                    for (i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                    }
                }
            }
        </script>
        <?php
    }
}
