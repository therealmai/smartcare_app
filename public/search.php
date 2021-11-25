<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/search.css">
    <link rel="stylesheet" href="../src/css/appointment.css">
    <link rel="stylesheet" href="../src/css/font-awesome-4.7.0/css/font-awesome.min.css">
    <title>SmartCare - Search</title>
</head>
<body>
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
                    <option selected value="name-asc">Name - ASC</option>
                    <option value="name-desc">Name - DESC</option>
                    <option value="f2f-price-asc">F2F Price - ASC</option>
                    <option value="f2f-price-desc">F2F Price - DESC</option>
                    <option value="v-price-asc">Virtual Price - ASC</option>
                    <option value="v-price-desc">Virtual Price - DESC</option>
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
                <h5>BOOK APPOINTMENT</h5>
                <div class="right-sec__doctor-cont--left">
                    <i class="fa fa-user-md fa-2x" aria-hidden="true"></i>
                    <div>
                        <h4 id="docName"></h4>
                        <h4 id="docSpec"></h5>
                    </div>
                </div>

                <div class="right-sec__doctor-cont--right">
                    <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
                    <div>
                        <h4 id="docCont"></h4>
                        <h4>CONTACT NUMBER</h5>
                    </div>
                </div>
            </div>

            <div class="right-sec__page"> 
                <p class="right-sec__page--1">1</p>
                <div class="line"></div>
                <p class="right-sec__page--2">2</p>

                <p class="right-sec__page--ad">Appointment Details</p>
                <p class="right-sec__page--s">Summary</p>
            </div>

            <div class="right-sec__form-cont">
                <h4>Appointment Information</h4>

                <form action="" id="appointForm">
                    <div>
                        <label for="appoint-type">Appointment Type</label>
                        <select name="appoint-type" id="appoint-type">
                            <option hidden disabled selected value> -- select an option -- </option>
                            <option value="f2f">Face-to-face</option>
                            <option value="online">Online Appointment</option>
                        </select>
                    </div>

                    <div>
                        <label for="clinic">Select Clinic</label>
                        <select name="clinic" id="clinic">
                            <option hidden disabled selected value> -- select an option -- </option>
                            <option value="f2f">Face-to-face</option>
                            <option value="vir-appoint">Virtual Appointment</option>
                        </select>
                    </div>

                    <div>
                        <label for="date">Date of Appointment</label>
                        <input name="date" id="date" type="date">
                    </div>

                    <div>
                        <label for="time">Time of Appointment</label>
                        <input name="time" id="time" type="time">
                    </div>

                    <button type="submit">
                        Continue <i class="fa fa-arrow-right" aria-hidden="true"></i>                
                    </button>
                </form>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../src/js/script.js"></script>
</body>
</html>