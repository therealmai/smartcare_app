let searchForm = "#searchForm";
let searchResults = "#searchResults";

let docName = "#docName";
let order = "#order";
let specialty = "#specialty";

let specialties = {
    "cardio" : "Cardiologist",
    "pedia" : "Pediatrician",
    "radio" : "Radiologist"
}

function addEventGlobalListener(action, selector, callback) {
    document.addEventListener(action, (e) => {
        if(e.target.matches(selector)) 
            callback(e);
    })
}

function createSearchResult(name, specialty, contact, id) {
    return `
        <div data-doc-id=${id} class="search-results__result">
            <i class="fa fa-user-md fa-2x" aria-hidden="true"></i>
            <div class="search-results__profile">
                <h4>Dr. ${name}, MD</h4>
                <a href="" target="">View Profile</a>
            </div>
            <div class="search-results__addi-info">
                <p>
                    <i class="fa fa-stethoscope" aria-hidden="true"></i>
                    ${specialty}
                </p>
                <p>
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    ${contact}
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
    `;
}

addEventGlobalListener('submit', searchForm, (e) => {
    let data = $(searchForm).serialize();
    let url = "../src/php/search_act.php";
    let res, doctors;
    $.ajax({
        url: url,
        data : data,
        type : 'GET',
        success : function(response) {
            res = JSON.parse(response);
            if(res["isFound"] > 0) {
                doctors = res["data"];
                console.log(doctors);
                doctors.forEach((elem) => {
                    $(searchResults).append(createSearchResult(elem["name"], elem["specialization"], elem["contact"], elem["id"]));
                })
            }
            console.log(res);
        }
    })
    e.preventDefault();
})