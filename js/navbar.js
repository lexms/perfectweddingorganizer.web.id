
(function find_active_link() {   
    var nav = document.getElementById('navigate'),
        li = nav.getElementsByTagName('li'),
        anchor = nav.getElementsByTagName('a'),
        current = window.location.href.split('.php')[0];

    for (var i = 0; i < anchor.length; i++) {
        if (
            anchor[i].href.split('.php')[0] == current 
            && anchor[i].href.indexOf('#') == -1 ) 
        {
            
                li[i].className = "active";
            
        }
    }
})();

//scroll 

(function (){
    var header = document.getElementById("header_nav_main");
    window.onscroll = function () {
        /* Navbar Black OnScroll */
        
        if (document.documentElement.scrollTop >= 300) {
            header.style.backgroundColor = "rgba(0, 0, 0, 0.9)";
            header.style.top = "-10px";
        } else {
            header.style.backgroundColor = "transparent";
            header.style.top = "0px";
        }
    };
})();


/* 
    var nav = document.getElementById('navigate'),
        li = nav.getElementsByTagName('li');
    for (var i = 0; i < li.length; i++) {
        li[i].addEventListener("click", function () {
            console.log(2000);
            
            var current = document.getElementsByClassName("active");
            console.log(current);
            
            current[0].className = current[0].className.replace("active", "");
            this.className += " active";
        });
    };

 */