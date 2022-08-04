let container = document.querySelector('.container-404');
window.onmousemove = function(e) {
    let x = - e.clientX/5,
        y = - e.clientY/5;
        container.style.backgroundPositionX = x +'px';
        container.style.backgroundPositionY = y +'px';
}