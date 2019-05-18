(function () {
    var nav = document.getElementById('navigate'),
        li = nav.getElementsByTagName('li'),
        anchor = nav.getElementsByTagName('a'),
        current = window.location.href.split('.php')[0];

        
    for (var i = 0; i < anchor.length; i++) {

        if (anchor[i].href.split('.php')[0] == current) {
            li[i].className = "active";
            
        }
    }
})();