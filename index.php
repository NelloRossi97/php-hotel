<?php 
    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4,
            'image' => 'https://www.belvederericcione.com/images/content/990452_55272_2_C_1800_1014_0_458814346/belvedere2-bassa.jpg'
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2,
            'image' => 'https://hotel-plaza-aversa.hotelmix.it/data/Photos/OriginalPhoto/13237/1323707/1323707431/Hotel-Plaza-Aversa-Exterior.JPEG'
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1,
            'image' => 'https://www.hotelrivamare.com/public/crop/Esterni--893A7700-1680x933.jpg?v=1'
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5,
            'image' => 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/07/a6/5e/0e/hotel-bellavista.jpg?w=700&h=-1&s=1'
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50,
            'image' => 'https://www.milansuitehotel.com/assets/components/phpthumbof/cache/Naked_Rooms_05.d6c97cda903d7c5dec8249438aec153f.jpg'
        ],

    ];

    // if ($parkValue = isset($_GET['parkFilter']) && $_GET['parkFilter'] != ''){
    //     $parkValue = $_GET['parkFilter'];
    //     $voteValue = $_GET['voteFilter'];
    //     $filteredHotels = [];
    //     foreach($hotels as $hotel){
    //         if($hotel['parking'] == $parkValue && $hotel['vote'] == $parkValue){    
    //             $filteredHotels[] = $hotel;
    //         }
    //     }
    // } else {
    //     $filteredHotels = $hotels;
    // }
    $filteredHotels = $hotels;
    $tempHotels = [];  
    if (!empty($_GET['parkFilter'])){
        $tempHotels = [];
        $parkValue = ($_GET['parkFilter'] == 'si') ? true : false;
        foreach($filteredHotels as $hotel){
            if($hotel['parking'] === $parkValue){
                $tempHotels[] = $hotel;
            }
        }
        $filteredHotels = $tempHotels;
    }

    if (!empty($_GET['voteFilter'])){
        $tempHotels = [];
        $voteValue = $_GET['voteFilter'];
        foreach($filteredHotels as $hotel){
            if($hotel['vote'] >= $voteValue){
                $tempHotels[] = $hotel;
            }
        }
        $filteredHotels = $tempHotels;
    }
/* 

Bonus:
1 - Aggiungere un form ad inizio pagina che tramite una richiesta GET permetta di filtrare gli hotel che hanno un parcheggio.
2 - Aggiungere un secondo campo al form che permetta di filtrare gli hotel per voto (es. inserisco 3 ed ottengo tutti gli hotel che hanno un voto di tre stelle o superiore)
NOTA: deve essere possibile utilizzare entrambi i filtri contemporaneamente (es. ottenere una lista con hotel che dispongono di parcheggio e che hanno un voto di tre stelle o superiore)
Se non viene specificato nessun filtro, visualizzare come in precedenza tutti gli hotel.

*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.scss">
    <title>Document</title>
</head>
<body>
    <header class="bg-primary mb-5">
        <nav class="container d-flex justify-content-between align-items-center text-white">
            <div>
                <h1>Booking.com</h1>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
                <label for="parkFilter">Filtra per parcheggio:</label>
                <select name="parkFilter" id="parkFilter" class="me-4">
                    <option value="">Tutti</option>
                    <option value="si">Parking</option>
                    <option value="no">No parking</option>
                </select>
               

                <label for="voteFilter">Filtra per voto:</label>
                <select name="voteFilter" id="voteFilter">
                    <option value="">Tutti</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <button type="submit">Invia</button>
            </form>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <?php foreach ($filteredHotels as $hotel) {?>
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="card p-3">
                            <img src="<?php echo $hotel['image'] ?>" alt="<?php echo $hotel['name'] ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $hotel['name'] ?></h5>
                                <p>Descrizione <?php echo $hotel['description'] ?></p>
                                <p class="fw-bold">Valutazione: <?php echo $hotel['vote'] ?> </p>
                                <p class="card-text">Parcheggio: 
                                    <?php if($hotel['parking'] === true){
                                        echo "Si";
                                    }else{
                                        echo "No";
                                    }
                                        ?> 
                                </p>
                                <p>Distanza dal centro: <?php echo $hotel['distance_to_center'] ?></p>
                            </div>
                            
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
    
</body>
</html>