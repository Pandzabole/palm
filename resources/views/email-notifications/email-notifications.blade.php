<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Payment instructions</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: dejavu sans, sans-serif;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            font-size: 12px;
            line-height: 18px;
            color: #555;
        }

        .invoice-box table {
            width: 710px;
            text-align: left;
            position: relative;
        }

        .invoice-box table td {
            padding: 3px;
            vertical-align: top;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 15px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 26px;
            line-height: 26px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 10px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            font-weight: bold;
        }

        .text-align-center {
            text-align: center;
        }

        .text-align-left {
            text-align: left;
            margin-top: 50px;
        }

        .image-center {
            display: flex;
            justify-content: center;
            text-align: center;
        }

        .image-left {
            display: flex;
            justify-content: left;
            text-align: left;
        }

        .image-right {
            display: flex;
            justify-content: right;
            text-align: right;
        }

        .image-center img {
            width: 180px;
            height: 76px;
        }

        .signature {
            position: absolute;
            bottom: 3%;
            right: 35px;
        }

        .font-style{
            color: black;
            font-size: 15px;
            font-weight: 400;
            padding: 0 15px;
        }

        .second-paragraph{
            color: black;
            font-size: 10px;
            padding: 0 20px;
            margin-bottom: 100px;
            font-style: italic;
        }

        .last-paragraph{
            color: black;
            font-size: 10px;
            padding: 0 35px;
        }

        .regard-paragraph{
            margin-bottom: 150px;
        }

        .logo-text{
            color: black;
            font-size: 10px;
            margin: 1px 0;
            text-decoration: none;
        }

        .table-logo{
            margin-bottom: 100px;
        }
    </style>
</head>
<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0" class="table-logo">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            <img src="{{ asset('/img/logo-small.jpg') }}" alt="triglav-logo" style="width: 60px; height: 60px">
                        </td>
                        <td style="float: right">
                            <img src="{{ asset('/img/triglav-logo-text.jpg') }}" alt="triglav-logo" style="width: 150px; height: 60px">
                        </td>
                    </tr>
                    <tr style="line-height: 13px">
                        <td>
                            <p class="logo-text">Triglav Savetovanje d.o.o.</p>
                            <p class="logo-text">Zelengorska 1g</p>
                            <p class="logo-text">11070 Beograd</p>
                        </td>
                        <td style="float: right">
                            <p class="logo-text">T: 381 11 655 8497</p>
                            <p class="logo-text" style="text-decoration: none; color: black;">E: office@triglav-savetovanje.rs</p>
                            <p class="logo-text" style="text-decoration: none; color: black;">W: www.triglav-savetovanje.rs</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <p class="font-style">Po??tovani,</p> <br>

    <p class="font-style" style="margin-bottom: 50px"> Hvala vam ??to va??u premiju za ??ivotno osiguranje izmirujete na vreme, potvrdu o uplati na va??u
        polisu mo??ete preuzeti putem linka: </p>

    <p class="font-style"> U slu??aju potrebe za dodatnim informacijama mo??ete nas kontaktirati putem telefona
        011-6558493 ili e-mail-a triglav.zivot@triglav-savetovanje.rs </p>


    <div class="text-align-left font-style regard-paragraph">
        <p>Srda??an pozdrav. {{$language}}</p>
    </div>
    <div class="text-align-left second-paragraph">
        <p>Naplata mese??ne premije ??ivotnog osiguranja vr??i se putem elektronskog sistema za naplatu E-nalog u korist Triglav Savetovanje
            zastupanje u osiguranju d.o.o. Beograd, Zelengorska 1G, MB 21159930 koji napla??uje premiju u ime i za ra??un osigurava??a
            Akcionarskog dru??tva Triglav osiguranje, Milutina Milankovi??a 7a, Beograd, MB 07082428, u skladu sa Zakonom o osiguranju (&quot;Sl.
            glasnik RS&quot;, br. 139/2014).</p>
    </div>
    <div class="text-align-center last-paragraph">
        <p>Triglav Savetovanje, dru??tvo za zastupanje u osiguranju d.o.o. Beograd, Zelengorska 1g, 11070 Novi Beograd
            mati??nI br.: 21159930, PIB: 109313176, osnovni kapital: 11.407.797,88 RSD, NLB banka a.d. Beograd 310-214580-68</p>
    </div>
</div>
</body>
</html>
