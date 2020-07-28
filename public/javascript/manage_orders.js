function printOrderReceipt()
{
    var x = document.getElementsByClassName("order-details-popup");
    var p = window.open('','','height=500','width=500');
    p.document.write('<html>');
    p.document.write('<head>');
    p.document.write("<style>td{text-align: center; border:0.5px solid #bdc3c7;}table{margin-top:15px;}</style>");
    p.document.write('</head>');
    p.document.write('<body>');
    p.document.write('<h4>Order Details</h4>');
    var purchasedFrom = document.getElementsByClassName('left-info')[0].getElementsByTagName('label');
    var purchasedBy = document.getElementsByClassName('right-info')[0].getElementsByTagName('label');
    var i;
    p.document.write("<div style='display:flex;'><div style='display:flex;flex:1;flex-direction:column;'>");
    for(i=0;i<purchasedFrom.length;i++)
    {
        p.document.write(purchasedFrom[i].innerHTML+'<br>');
    }
    p.document.write("</div><div style='display:flex;flex:1;flex-direction:column;'>");
    for(i=0;i<purchasedBy.length;i++)
    {
        p.document.write(purchasedBy[i].innerHTML+'<br>')
    }
    p.document.write("</div></div>");
    var tr = document.getElementsByClassName('popup-table-container')[0].getElementsByTagName('table')[0].getElementsByTagName('tr');
    p.document.write("<table style='border: 1px solid #ddd;width: 97%;border-collapse: collapse;font-family: 'Roboto',sans-serif;'>");
    for(i=0;i<tr.length;i++)
    {
        p.document.write('<tr>');
        p.document.write(tr[i].innerHTML);
        p.document.write('</tr>');

    }
    p.document.write('</table>');
    p.document.write('</body>');
    p.document.write('</html>');
    p.document.close();
    p.print();
}

function hideOrderDetailsPopup(index)
{
    document.getElementsByClassName('order-details-popup')[index].style.display = "none";
    document.getElementsByClassName('close-icon')[index].style.display = "none";

}