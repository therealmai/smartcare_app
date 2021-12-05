
    console.log("hello");
    function validate() {
        var mobile = document.getElementById("mobile").value;
        var pattern = /^(09|\+639)\d{9}$/;
        if (pattern.test(mobile)) {
            alert("Your mobile number : "+mobile);
            return true;
        }
        alert("It is not valid mobile number");
        return false;

    }
