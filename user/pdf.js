// window.onload = function () {
//     document.getElementById("download")
//         .addEventListener("click", () => {
//             const invoice = this.document.getElementById("invoice");
//             console.log(invoice);
//             console.log(window);
//             var opt = {
//                 margin: 1,
//                 filename: 'myfile.pdf',
//                 image: { type: 'jpeg', quality: 0.98 },
//                 php2canvas: { scale: 2 },
//                 jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
//             };
//             php2pdf().from(invoice).set(opt).save();
//         })
// }

let printButton = document.getElementById("download");
printButton.addEventListener("click",function() {
    setTimeout(function() {
        printButton.style.visibility = "hidden";
    },200);
    window.print();
});
