<?php include('session_check.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SmartCare - Homepage</title>
  <!-- Bootstrap CSS Link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../src/css/index.css">

  <!-- Font Links -->
  <!-- Roboto -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
  <!-- Varela Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
</head>

<body>


  <?php include('header.php') ?>

  <div class="container-nav1">

    <main>
      <section class="main-sectinon-1">
        <!-- start of Card -->
        <img src="../src/img/doctor1.png" class="rounded float-end" style="margin-right: 30%; position: relative">
        <div class="container py-3"></div>
        <div class="container py-5">
          <div class="col-md-5">

            <div class="h-100 p-5 border bg-light rounded-3 medical-services">
              <img src="../src/img/medical_services.png" alt="" width="400">

              <div style="text-align: justify;">
                <h4>Empowering<b> Well-Being</b> </h4>
                <p>We approach well-being in a conscientious manner. Our strategic partnerships, services, and solutions enable businesses to develop a well-rounded program providing employees with the individualized tools and resources they need to achieve genuine results.</p>
              </div>
              <div class="d-grid gap-4 d-md-flex" >
                <button class="btn btn-md btn-outline-info" type="button" onclick="document.location='search.php'">MAKE AN APPOINTMENT</button>
              </div>
            </div>
          </div>
        </div><br><br><br><br>
        <!-- End of Card -->
  </div>
  <!--Dont delete this div because it holds the whole image, main div for navbar and section 1-->

  <!-- <div class="album py-5 bg-light">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
              <title>Placeholder</title>
              <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
            </svg>

            <div class="card-body">
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
              <title>Placeholder</title>
              <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
            </svg>

            <div class="card-body">
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
              <title>Placeholder</title>
              <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
            </svg>

            <div class="card-body">
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <div class="container px-4 py-5" id="custom-cards">
            <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
                <div class="col">
                  <div class="card card-cover h-100 overflow-hidden text-white bg-primary rounded-5 shadow-lg">
                    <div class="d-flex flex-column h-75 p-3 pb-1 text-shadow-1">
                      <img class="main-section-2__feature--img" src="../src/img/icon1.png" alt="" width=30%;>
                      <h4 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Expertise</h4>
                      <h6>Every year, more than thousands people come to SmartCare for care. Our highly specialized experts are deeply experienced in treating rare and complex conditions.</h6>
                      <ul class="d-flex list-unstyled mt-auto">
                        <li class="me-auto">
                        </li>
                        <li class="d-flex align-items-center me-3">
                          <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"/></svg>
                        </li>
                        <li class="d-flex align-items-center">
                          <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"/></svg>
                          <h1>01</h1>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
          

              <div class="col">
                <div class="card card-cover h-100 overflow-hidden text-white bg-primary rounded-5 shadow-lg">
                  <div class="d-flex flex-column h-50 p-3 pb-1 text-shadow-1">
                    <img class="main-section-2__feature--img" src="../src/img/icon2.png" alt="" width=30%;>
                    <h4 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Accessible</h4>
                    <h6>Consult with your doctor and access your medical records anytime and anywhere.</h6>
                    <ul class="d-flex list-unstyled mt-auto">
                      <li class="me-auto">
                      </li>
                      <li class="d-flex align-items-center me-3">
                        <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"/></svg>
                      </li>
                      <li class="d-flex align-items-center">
                        <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"/></svg>
                        <h1>02</h1>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col">
                <div class="card card-cover h-100 overflow-hidden text-white bg-primary rounded-5 shadow-lg">
                  <div class="d-flex flex-column h-50 p-3 pb-1 text-shadow-1">
                    <img class="main-section-2__feature--img" src="../src/img/icon3.png" alt="" width=30%;>
                    <h4 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">HIPAA</h4>
                    <h6>Keep your patient data safe and your business HIPAA compliant. The HIPAA feature restricts access to your system to you and the people to whom allocate privileges.</h6>
                    <ul class="d-flex list-unstyled mt-auto">
                      <li class="me-auto">
                      </li>
                      <li class="d-flex align-items-center me-3">
                        <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"/></svg>
                      </li>
                      <li class="d-flex align-items-center">
                        <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"/></svg>
                        <h1>03</h1>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>



  <br><br>
  <section class="main-section-3">
    <div class="main-section-3__abt-us-cont">
      <h4 class="main-section-3__abt-us">About Us</h4>
      <h3 class="main-section-3__title">Clinic with <span class="main-section-3__title--innovative">innovative</span> approach to treatment</h3>
      <p class="main-section-3__p">We have doctors from various medical fields ready to heed to your inquiries and issues.</p>
      <ul class="main-section-3__list">
        <li class="main-section-3__list-item"><img class="main-section-3__checkmark" src="../src/img/blue-checkmark.png" alt="">Neurologist</li>
        <li class="main-section-3__list-item"><img class="main-section-3__checkmark" src="../src/img/blue-checkmark.png" alt="">Pediatrician</li>
        <li class="main-section-3__list-item"><img class="main-section-3__checkmark" src="../src/img/blue-checkmark.png" alt="">Orthopedics</li>
        <li class="main-section-3__list-item"><img class="main-section-3__checkmark" src="../src/img/blue-checkmark.png" alt="">Dentist</li>
        <li class="main-section-3__list-item"><img class="main-section-3__checkmark" src="../src/img/blue-checkmark.png" alt="">Nephrologist</li>
        <li class="main-section-3__list-item"><img class="main-section-3__checkmark" src="../src/img/blue-checkmark.png" alt="">Cardiologist</li>
        <li class="main-section-3__list-item"><img class="main-section-3__checkmark" src="../src/img/blue-checkmark.png" alt="">Dermatologist</li>
      </ul>
      <a class="main-section-3__read-more" href="">Read More</a>
    </div>

    <div class="main-section-3__img-cont">
      <img class="main-section-3__img" src="../src/img/doctor2.png" alt="">
    </div>
  </section>

  <section class="above-footer">
    <div class="container px-3" id="icon-grid">

      <div class="row row-cols g-2 py-4">
        <div class="col d-flex align-items-center">
          <h1 class="section4head">7</h1>
          <div>
            <h5 class="section4">DIFFERENT<br>MEDICAL FIELDS</h5>
          </div>
        </div>

        <div class="col d-flex align-items-center">
          <h1 class="section4head">8-11</h1>
          <div>
            <h5 class="section4">YEARS OF<br>EXPERIENCE</h5>
          </div>
        </div>

        <div class="col d-flex align-items-center">
          <h1 class="section4head">20+</h1>
          <div>
            <h5 class="section4">QUALIFIED<br>DOCTORS</h5>
          </div>
        </div>

      </div>
    </div>
  </section>

  </main>

  <footer>
    <section class="footer-main">
      <!-- <div class="container">
        <img src="../src/img/logo.jpg" alt="" width="150">
        <footer class="row row-cols-7 py-5">
            <p class="footer-description"><center>SmartCare 2022&copy;</center></p>

          <div class="col">

          </div>
        </footer>
      </div> -->
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col">
            <img src="../src/img/logo.jpg" alt="" width="150">
          </div>
          <div class="col-md-auto">
            <p class="footer-description">SmartCare 2022&copy;</p>
          </div>
          <div class="col">
          </div>
        </div>
    </section>
  </footer>
</body>

</html>