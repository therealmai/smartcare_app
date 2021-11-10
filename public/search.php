<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/search.css">
    <link rel="stylesheet" href="../src/css/font-awesome-4.7.0/css/font-awesome.min.css">
    <title>SmartCare - Search</title>
</head>
<body>
    <header>
        <img class="header__logo" src="../src/img/logo-with-heading.png" alt="">
    </header>

    <main>
        <form action="" class="search-form" id="searchForm">
            <h4>Note: Please input a name or select at least 1 filter</h4>

            <div class="search-form__input-cont">
                <i class="fa fa-search fa-2x" aria-hidden="true"></i>
                <input name="docName" type="text" placeholder="Search for a doctor's name" id="docName">
            </div>

            <button id="searchBtn" type="submit">Search</button>

            <div class="search-form__filter-cont">
                <span>Filters:</span>
                <select name="specialty" id="specialty">
                    <option selected value=""> -- select a specialty --</option>
                    <option value="cardio">Cardiologist</option>
                    <option value="pedia">Pediatrician</option>
                </select>

                <span>Sort by:</span>
                <select name="order" id="order">
                    <option selected value="name-asc">Name - ASC</option>
                    <option value="name-dsc">Name - DESC</option>
                    <option value="f2f-price-asc">F2F Price - ASC</option>
                    <option value="f2f-price-dsc">F2F Price - DESC</option>
                    <option value="v-price-asc">Virtual Price - ASC</option>
                    <option value="v-price-dsc">Virtual Price - DESC</option>
                </select>
            </div>
        </form>

        <section id="searchResults" class="search-results">
            <span class="hide">No results found.</span>
            <div class="search-results__result">
                <i class="fa fa-user-md fa-2x" aria-hidden="true"></i>
                <div class="search-results__profile">
                    <h4>Dr. Mylze Mangubat, MD</h4>
                    <a href="" target="">View Profile</a>
                </div>
                <div class="search-results__addi-info">
                    <p>
                        <i class="fa fa-stethoscope" aria-hidden="true"></i>
                        Pediatrics
                    </p>
                    <p>
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        9433514809
                    </p>
                    <p>
                        <i class="fa fa-user" aria-hidden="true"></i>
                        F2F Consultation - P500.00
                    </p>
                    <p>
                        <i class="fa fa-video-camera" aria-hidden="true"></i>
                        Virtual  Consultation - P500.00
                    </p>
                </div>
                <button class="search-results__book-btn">
                    Book Now
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </button>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../src/js/search.js"></script>
</body>
</html>