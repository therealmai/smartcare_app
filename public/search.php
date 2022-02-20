<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/search.css">
    <link rel="stylesheet" href="../src/css/appointment.css">
    <link rel="stylesheet" href="../src/css/font-awesome-4.7.0/css/font-awesome.min.css">
    <script defer src="../src/js/script.js"></script>
    <!-- <link rel="stylesheet" href="../src/css/profile.css"> -->
    <title>SmartCare - Search</title>
</head>
<body>
    <!-- <?php include('session_check.php') ?> -->
    <?php include "./header.php" ?>
    <main>
        <form action="" class="search-form" id="searchForm">
            <h4>Note: Please input a name or select at least 1 filter</h4>

            <div class="search-form__input-cont">
                <i class="fa fa-search fa-2x" aria-hidden="true"></i>
                <input name="docName" type="text" placeholder="Search for a doctor's name" id="searchName">
            </div>

            <button id="searchBtn" type="submit">Search</button>

            <div class="search-form__filter-cont">
                <span>Filters:</span>
                <select name="specialty" id="searchSpecialty">
                    <option selected value=""> -- select a specialty --</option>
                    <option value="cardio">Cardiologist</option>
                    <option value="pedia">Pediatrician</option>
                </select>

                <span>Sort by:</span>
                <select name="order" id="searchOrder">
                    <option selected value="lastname-asc">Name - ASC</option>
                    <option value="lastname-desc">Name - DESC</option>
                </select>
            </div>
        </form>

        <section id="searchResults" class="search-results">
            <span id="searchNoResMsg" class="hide">No results found.</span>
        </section>

        <section class="hide right-sec" id="appointmentForm">
            <i class="fa fa-times-circle fa-2x" aria-hidden="true" id="closeBtn"></i>

            <div class="right-sec--top-bg"></div>
    
            <div class="right-sec__doctor-cont">
                <h5 class="a">BOOK APPOINTMENT</h5>
                <img class="right-sec__img b" id="docImg" src="" alt="Profile Image">
                <h4 class="right-sec__name c" id="docName"></h4>
                <h4 class="right-sec__spec d" id="docSpec"></h4>
                <i class="fa fa-phone fa-3x e" aria-hidden="true"></i>
                <h4 class="right-sec__contact f" id="docCont"></h4>
                <h4 class="right-sec__contact-label g">CONTACT NUMBER</h5>
            </div>

            <!-- <div class="right-sec__page">
                <p class="right-sec__page--1">1</p>
                <div class="line"></div>
                <p class="right-sec__page--2">2</p>

                <p class="right-sec__page--ad">Appointment Details</p>
                <p class="right-sec__page--s">Summary</p>
            </div> -->

            <div class="right-sec__form-cont">
                <h4>Appointment Information</h4>

                <form action="" id="appointForm">
                    <div class="form-cont__div">
                        <label title="Please schedule a day earlier." for="date">
                            Date of Appointment &nbsp;
                            <i class="fa fa-exclamation-circle" aria-hidden="true" style="color:orange;"></i>
                        </label>
                        <input name="date" id="date" type="date" required>
                    </div>
                    <div class="form-cont__div">
                        <label for="time">Time of Appointment</label>
                        <select name="time" id="time" required>
                            <option id="default" disabled selected value="default"> -- select an option -- </option>
                        </select>
                    </div>
                    <div class="form-cont__div">
                        <label for="appoint-type">Appointment Type</label>
                        <select name="appoint-type" id="appoint-type" required>
                            <option hidden disabled selected value> -- select an option -- </option>
                            <option value="f2f">Face-to-face</option>
                            <option value="online">Online Appointment</option>
                        </select>
                    </div>
                    <div class="legend">
                        <h6 class="legend__text">Legend:</h6>
                        <div class="box clr-conflict"></div>
                        <span class="legend--mright"> - Conflict</span>
                        <div class="box clr-reserved"></div>
                        <span> - Reserved</span>
                    </div>

                    <!-- <div>
                        <label for="clinic">Select Clinic</label>
                        <select name="clinic" id="clinic">
                            <option hidden disabled selected value> -- select an option -- </option>
                            <option value="f2f">Face-to-face</option>
                            <option value="vir-appoint">Virtual Appointment</option>
                        </select>
                    </div> -->

                    <button type="submit">
                        Submit <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </section>
    </main>
</body>

</html>