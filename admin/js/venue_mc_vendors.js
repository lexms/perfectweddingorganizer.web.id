var vHeight = window.innerHeight,
    side_menu = document.getElementsByClassName('side_menu');
    console.log(vHeight);
    
 

for (let i = 0; i < side_menu.length; i++) {
      side_menu[i].style.height = vHeight + 'px';
}

(function () {
    var nav = document.getElementById('sidemenu'),
        li = nav.getElementsByTagName('li'),
        anchor = nav.getElementsByTagName('a'),
        current = window.location.href;
        

    for (var i = 0; i < anchor.length; i++) {
        console.log(anchor[i].href.split('.php')[0]);
        if (anchor[i].href == current) {
            li[i].className = "active";

        }
    }
})();