function generate(id) {
    document.getElementById(id).style.transform = document.getElementById(id).style.webkitTransform = 'scale(2)';
    document.getElementById(id).style.transformOrigin = document.getElementById(id).style.webkitTransformOrigin = '0 0';
    html2canvas(document.getElementById(id),{
        width: (document.getElementById(id).offsetWidth * 2)+10,
        height: (document.getElementById(id).offsetHeight * 2)+10,
        background:"#fff"
    } ).then(function(canvas) {
        document.getElementById(id).style.transform = document.getElementById(id).style.webkitTransform = 'scale(1)'
        var a = document.createElement('a');
        // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
        a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
        a.download = id+'.jpg';
        a.click();
    })
}
