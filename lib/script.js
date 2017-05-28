function generate(id) {
    document.getElementById(id).style.transform = document.getElementById(id).style.webkitTransform = 'scale(2)';
    document.getElementById(id).style.transformOrigin = document.getElementById(id).style.webkitTransformOrigin = '0 0';
    html2canvas(document.getElementById(id),{
        width: (document.getElementById(id).offsetWidth * 2)+10,
        height: (document.getElementById(id).offsetHeight * 2)+10,
        background:"#fff"
    } ).then(function(canvas) {
        $("#imgcanvas").append(canvas);
        document.getElementById(id).style.transform = document.getElementById(id).style.webkitTransform = 'scale(1)'
    })
}
