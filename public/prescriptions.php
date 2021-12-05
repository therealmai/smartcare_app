<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/search.css">
    <link rel="stylesheet" href="../src/css/profile.css">
    <title>SmartCare - Profile</title>
</head>

<body>
    <?php include "./header.php" ?>

    <main class="prof">
        <section class="prof-btn-cont">
            <button id="showPatProfBtn">Profile</button>
            <button id="showPatAppointBtn">Appointments</button>
            <button id="showPatPresBtn">Prescriptions</button>
            <button id="showPatDocBtn">Doctors</button>
        </section>

        <section class="prof-res" id="profRes">
            <div class="hide" id="profResAppCont">
                <div class="prof-res__appoint-cont" id="profResUnApp">
                    <h1>Unfinished Appointments</h1>
                </div>
                <div class="prof-res__appoint-cont" id="profResFinApp">
                    <h1>Finished Appointments</h1>
                </div>
            </div>
        </section>

        <section class="prof-res" id="profRes">
            <div class="hide" id="profPresAppCont">
            <style>
            table, th, td {
            border:1px solid black;
            }
            </style>
                <div>
                    <h1>Prescriptions</h1>
                    <table style="width:100%">
                        <tr>
                            <th>Date</th>
                            <th>Prescription</th>
                            <th>Doctor</th>
                        </tr>
                        <tr>
                            <td>12/15/00</td>
                            <td>safasfdaad</td>
                            <td>John Alex</td>
                        </tr>
                        
                    </table>
                </div>
               
            </div>
        </section>
       
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../src/js/profile.js"></script>
</body>
</html>