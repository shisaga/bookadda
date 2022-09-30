// let printButton = document.getElementById("download");
// printButton.addEventListener("click",function() {
//     setTimeout(function() {
//         printButton.style.visibility = "hidden";
//         window.print();
//     },2000);
    
// });

function printDiv() {
    document.getElementById("download").style.visibility  = "hidden"
    document.getElementById("billErase").style.visibility = "hidden"
    setTimeout(function() {
        document.getElementById("download").style.visibility = "visible"
        document.getElementById("billErase").style.visibility = "visible"
        
    },1000)
    window.print();
}