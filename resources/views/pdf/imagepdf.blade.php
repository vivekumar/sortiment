<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Download</title>
    <link href="https://fonts.googleapis.com/css2?family=Arvo:wght@400;700&display=swap" rel="stylesheet">

    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 13px;
            font-weight: normal;
            padding: 30px 15px 30px 15px;
        }

        /* page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        } */

        /* page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
        } */

        h3 {
            font-size: 18px;
            color: rgb(36, 36, 36);
            text-align: center;
            margin-bottom: 50px;
            font-family: 'Arvo', serif;
            display: block;
            white-space: normal;
            margin-bottom: 25px;
        }

        .img-style {
            height: 500px;
            overflow: hidden;
            text-align: center;
        }

        .img-style img {
            height: inherit;
        }
        .center{
            text-align:center;
            margin-bottom:25px;
        }
        .img-logo{}
    </style>
</head>

<body>


    <page size="A4">
        <p><strong>Kunde: </strong>Infocon</p>
        <p><strong>Produkt: </strong>T-time t-shirt</p>
        <p><strong>Efterbehandling: </strong>Tryk</p>
        <p><strong>Logo: </strong>Sønderjysk Lakrids</p>
        <p><strong>Antal farver: </strong>2</p>
        <p><strong>Farvekode: </strong>013, 012, 000</p>
        <p><strong>Varenummer: </strong>SOR1001</p>
        <p><strong>Kvalitet: </strong>100% Bomuld</p>
        <p><strong>Producent: </strong>ID</p>

        <div class="img-style">
            <img src="{{asset($product->product_thambnail)}}" class="img-full" alt="">
        </div>



        <h3>Ovenstående illustration tjener som kontrol for indhold med hensyn til logo, farver og placering. Du bedes venligst returnere en godkendelse på ovenstående korrektur indenfor 24 timer for at undgå  i produktionen. Bemærk at illustrationen er ikke målfast.</h3>
        <div class="center"><img src="{{ asset('frontend/assets/img/sortiment-logo.png')}}" alt="" class="img-logo"></div>
        <div style="clear:both"></div>
        <p style="text-align: center;">Alle rettigheder tilhører Sortiment ApS - CVR. 41249641 Hansborggade 30, 6100
            Haderslev · +45 41 88 80 80 · info@sortiment.dk</p>
    </page>

    @foreach($product->mutimage as $mulimg)
    <page size="A4">
        <p><strong>Kunde: </strong>Infocon</p>
        <p><strong>Produkt: </strong>T-time t-shirt</p>
        <p><strong>Efterbehandling: </strong>Tryk</p>
        <p><strong>Logo: </strong>Sønderjysk Lakrids</p>
        <p><strong>Antal farver: </strong>2</p>
        <p><strong>Farvekode: </strong>013, 012, 000</p>
        <p><strong>Varenummer: </strong>SOR1001</p>
        <p><strong>Kvalitet: </strong>100% Bomuld</p>
        <p><strong>Producent: </strong>ID</p>

        <div class="img-style">
            <img src="{{asset($mulimg->photo_name)}}" class="img-full">
        </div>


        <h3>Ovenstående illustration tjener som kontrol for indhold med hensyn til logo, farver og placering. Du bedes venligst returnere en godkendelse på ovenstående korrektur indenfor 24 timer for at undgå  i produktionen. Bemærk at illustrationen er ikke målfast.</h3>

        <div class="center"><img src="{{ asset('frontend/assets/img/sortiment-logo.png')}}" alt="" class="img-logo"></div>
        <div style="clear:both"></div>
        <p style="text-align: center;">Alle rettigheder tilhører Sortiment ApS - CVR. 41249641 Hansborggade 30, 6100
            Haderslev · +45 41 88 80 80 · info@sortiment.dk</p>
    </page>
    @endforeach


</body>

</html>
