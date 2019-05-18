function setMinDate() {

    var today = new Date(),

        dd = today.getDate(),

        mm = today.getMonth() + 1, //January is 0

        yyyy = today.getFullYear();



    if (dd < 10) { //dd formatting e.g: 1 -> 01

        dd = '0' + dd

    }

    if (mm < 10) { //mm formatting e.g: 1 -> 01

        mm = '0' + mm

    }



    today = yyyy + '-' + mm + '-' + dd;



    document.getElementById('wedding_date').setAttribute("min", today);



};





function phone_number_validation(phone_number) {

    var phoneno = /^\d{10,15}$/;

    if (phone_number.value.match(phoneno))

    {

        document.getElementsByClassName("err_msg")[0].style.display = "none";

        document.getElementsByClassName("btn-order")[0].style.pointerEvents = "all";

        document.getElementsByClassName("btn-order")[0].style.opacity = "1";

        return true;

    }

        else

    {

        document.getElementsByClassName("err_msg")[0].style.display = "block";

        document.getElementsByClassName("btn-order")[0].style.pointerEvents = "none";

        document.getElementsByClassName("btn-order")[0].style.opacity = "0.5";

        return false;

    }



};



function dp_validation(dp) {

    var downpayment = /^[1-9][0-9]{6,20}$/;

    if (dp.value.match(downpayment)) {

        document.getElementsByClassName("err_msg")[0].style.display = "none";

        document.getElementsByClassName("btn-order")[0].style.pointerEvents = "all";

        document.getElementsByClassName("btn-order")[0].style.opacity = "1";

        return true;

    } else {

        document.getElementsByClassName("err_msg")[0].style.display = "block";

        document.getElementsByClassName("btn-order")[0].style.pointerEvents = "none";

        document.getElementsByClassName("btn-order")[0].style.opacity = "0.5";

        return false;

    }



    };