<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/search.css">
    <link rel="stylesheet" href="../src/css/profile.css">
    <title>SmartCare - Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php include "./header.php" ?>

    <main class="prof">
        <section class="prof-btn-cont">
            <button id="showDocProfBtn">Profile</button>
            <button id="showDocPatBtn">Patients</button>
            <button id="showDocAppointBtn">Appointments</button>
        </section>
  
    <section class="prof-res" id="Docprof">
        <div class="container rounded bg-white">
            <div class="row">
                <div class="col-md border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">Edogaru</span><span class="text-black-50">edogaru@mail.com.my</span><span> </span></div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Name</label><input type="text" class="form-control" placeholder="first name" value=""></div>
                            <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" value="" placeholder="surname"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="enter phone number" value=""></div>
                            <div class="col-md-12"><label class="labels">Address Line 1</label><input type="text" class="form-control" placeholder="enter address line 1" value=""></div>
                            <div class="col-md-12"><label class="labels">Address Line 2</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                            <div class="col-md-12"><label class="labels">Postcode</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                            <div class="col-md-12"><label class="labels">State</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                            <div class="col-md-12"><label class="labels">Area</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                            <div class="col-md-12"><label class="labels">Email ID</label><input type="text" class="form-control" placeholder="enter email id" value=""></div>
                            <div class="col-md-12"><label class="labels">Education</label><input type="text" class="form-control" placeholder="education" value=""></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value=""></div>
                            <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>
                        </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                        <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                        <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    <section class="prof-res" id="DocPatients">
        <h1>
            REPLACE THIS DOCTORPATIENTS DUMMY CODE WITH THE CORRECT ONE. Hello
        </h1>
        <p>
            Must be included:
            firstname
            lastname
            middle initial
            age [year month day]
            patient id
            height
            weight
            blood pressure
            heart rate

            view person's appointments and 
        </p>
    </section>
    <section class="prof-res" id="DocAppoint">
        <h1>
            REPLACE THIS DOCTORAPPOINT DUMMY CODE WITH THE CORRECT ONE. Hello
        </h1>
        <p>
            Must be included:
            tanan appointments in the table plus patient Name
            and button that "finishes" the appointment
        </p>
    </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../src/js/profile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>