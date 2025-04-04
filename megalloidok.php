<?php
session_start();

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'kkzrt';

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Kapcsolódási hiba: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KaposTransit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="betolt.js"></script>

    <style>
        :root {
            --primary-color:linear-gradient(to right, #211717,#b30000);
            --accent-color: #7A7474;
            --text-light: #fbfbfb;
            --secondary-color: #3498db;
            --hover-color: #2980b9;
            --background-light: #f8f9fa;
            --shadow: rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to left, #a6a6a6, #e8e8e8);
            color: #333;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

/*--------------------------------------------------------------------------------------------------------CSS - HEADER---------------------------------------------------------------------------------------------------*/
        .header {
            position: relative;
            background: var(--primary-color);
            color: var(--text-light);
            padding: 1rem;
            box-shadow: 0 2px 10px var(--shadow-color);
        }

        .header h1 {
            margin-left: 2%;
            text-align: center;
            font-size: 2rem;
            padding: 1rem 0;
            margin-left: 35%;
            display: inline-block;
        }

        .backBtn{
            display: inline-block;
            width: 3%;
            background: #372E2E;
            border: none;
            box-shadow: 0 2px 10px var(--shadow-color);
        }

        .backBtn:hover{
            background: #b40000;
        }

        .backBtn i{
            height: 30px;
            color: var(--text-light);
            padding-top: 20px;
        }
/*--------------------------------------------------------------------------------------------------------HEADER END-----------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------------------------------------CSS - OTHER PARTS----------------------------------------------------------------------------------------------*/
        .time-container {
            display: grid;
            padding: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .time-card {
            background: #fcfcfc;
            width: 950px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            padding: 1.5rem;
            transition: var(--transition);
            animation: fadeIn 0.5s ease-out;
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #636363;
        }

        .time-card:hover{
            color: 000;
            background: #E9E8E8;
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .timeCon{
            background: #fbfbfb;
            width: 90%;
            margin-bottom: 5px;
            padding: 20px;
            margin: 0 auto;
            border-radius: 10px;
            display: grid;
            grid-template-columns: 1fr 900px 1fr;
            grid-template-rows: 1fr 100px 1fr;
        }

        .time-number {
            background: #b30000;
            width: 3%;
            height: 60%;
            font-size: 2.5rem;
            font-weight: bold;
            border-radius: 5px;
            padding: 5px 20px;
            padding-right: 15%;
            color: var(--text-light);
            place-self: center;
            grid-column: 1;
            grid-row: 2;
        }

        .time-name{
            place-self: center;
            color: #636363;
            font-size: 1.5rem;
            font-weight: bold;
            background: #e8e8e8;
            padding: 5px 10px;
            border-radius: 5px;
            grid-column: 2;
            grid-row: 2;
        }

        .switchBtn{
            display: inline;
            float: right;
            background: #fbfbfb;
            margin-right: 16%;
        }

        .switchBtn:hover{
            background: #E9E8E8;
        }

        .time{
            font-size: 1.5rem;
            font-weight: bold;
            grid-column: 3;
            grid-row: 2;
            place-self: center;
        }

        .time-details {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }       
/*--------------------------------------------------------------------------------------------------------OTHER PARTS END------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------------------------------------CSS - FOOTER---------------------------------------------------------------------------------------------------*/
    footer {
        text-align: center;
        padding: 10px;
        background-color: var(--primary-color);
        color: var(--text-light);
        border-radius: 10px;
        margin-top: 20px;
        box-shadow: var(--shadow);
        background: var(--primary-color);
        color: var(--text-light);
        padding: 3rem 2rem;
        margin-top: 4rem;
    }

    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .footer-section h2 {
        margin-bottom: 1rem;
        color: var(--text-color);
    }

    .footer-links {
        list-style: none;
    }

    .footer-links li {
        margin-bottom: 0.5rem;
    }

    .footer-links a {
        color: var(--text-light);
        text-decoration: none;
        transition: var(--transition);
    }

    .footer-links a:hover {
        color: var(--accent-color);
    }
/*--------------------------------------------------------------------------------------------------------FOOTER END-----------------------------------------------------------------------------------------------------*/


/*--------------------------------------------------------------------------------------------------------CSS - @MEDIA---------------------------------------------------------------------------------------------------*/

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }

        @media (max-width: 1200px) {
            .header-content {
                padding: 1rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            .time-container {
                grid-template-columns: 1fr;
                padding: 1rem;
            }

            .time-card{
                width: 90%;
                margin-left: 3%;
            }

            .time-number{
                margin-right: 20px;
                padding-right: 60px;
                padding-bottom: 20px;
                place-self: center;
                font-size: 2rem;
                height: 40%;
            }

            .time{
                margin-left: 20px;
                place-self: center;
            }

            .time-name{
                font-size: 1.25rem;
                place-self: center stretch;
                text-align: center;
            }

            .timeCon{
                width: 90%;
                display: grid;
                grid-template-columns: 20% 60% 20%;
                grid-template-rows: 60px 80px 60px;
            }

            .header h1{
                margin-left: 15%;
            }

            .backBtn{
                width: 15%;
            }
        }

        @media (max-width: 480px) {
            .header-content {
                padding: 1rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            .time-container {
                grid-template-columns: 1fr;
                padding: 1rem;
            }

            .time-card{
                width: 90%;
            }

            .time-number{
                margin-right: 20px;
                padding-right: 60px;
                padding-bottom: 20px;
                place-self: center;
                font-size: 2rem;
                height: 40%;
            }

            .time{
                margin-left: 20px;
                place-self: center;
            }

            .time-name{
                font-size: 1.25rem;
                place-self: center stretch;
                text-align: center;
            }

            .timeCon{
                width: 90%;
                display: grid;
                grid-template-columns: 90px 190px 70px;
                grid-template-rows: 60px 80px 60px;
            }

            .header h1{
                margin-left: 2%;
            }

            .backBtn{
                width: 15%;
            }
        }

        @media (max-width: 380px) {
            .header-content {
                padding: 1rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            .time-container {
                grid-template-columns: 1fr;
                padding: 1rem;
            }

            .time-card{
                width: 90%;
            }

            .time-number{
                padding-right: 55px;
                padding-bottom: 20px;
                margin-right: 25px;
                place-self: center;
                font-size: 2rem;
                height: 40%;
            }

            .time{
                margin-left: 15px;
                place-self: center;
            }

            .time-name{
                font-size: 1.25rem;
                place-self: center stretch;
                text-align: center;
            }

            .timeCon{
                width: 335px;
                display: grid;
                grid-template-columns: 80px 190px 60px;
                grid-template-rows: 60px 80px 60px;
            }

            .header h1{
                margin-left: 2%;
            }

            .backBtn{
                width: 15%;
            }
        }
/*--------------------------------------------------------------------------------------------------------@MEDIA END-----------------------------------------------------------------------------------------------------*/
        
    </style>
</head>
<body>
    <div class="header">
            <button class="backBtn" id=bckBtn><i class="fa-solid fa-chevron-left"></i></button>
            <h1><i class="fas fa-bus"></i> Kaposvár Helyi Járatok</h1> 
    </div>

        <div id="timeNumCon" class="timeCon"></div>

        <div id="timeContainer" class="time-container"></div>

<!-- -----------------------------------------------------------------------------------------------------HTML - FOOTER------------------------------------------------------------------------------------------------ -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h2>Kaposvár közlekedés</h2>
                <p style="font-style: italic">Megbízható közlekedési szolgáltatások<br> az Ön kényelméért már több mint 50 éve.</p><br>
                <div class="social-links">
                    <a style="color: darkblue;" href="https://www.facebook.com/VOLANBUSZ/"><i class="fab fa-facebook"></i></a>
                    <a style="color: lightblue"href="https://x.com/volanbusz_hu?mx=2"><i class="fab fa-twitter"></i></a>
                    <a style="color: red"href="https://www.instagram.com/volanbusz/"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
           
            <div  class="footer-section">
                <h3>Elérhetőség</h3>
                <ul class="footer-links">
                    <li><i class="fas fa-phone"></i> +36-82/411-850</li>
                    <li><i class="fas fa-envelope"></i> titkarsag@kkzrt.hu</li>
                    <li><i class="fas fa-map-marker-alt"></i> 7400 Kaposvár, Cseri út 16.</li>
                    <li><i class="fas fa-map-marker-alt"></i> Áchim András utca 1.</li>
                </ul>
            </div>
        </div>
        <div style="text-align: center; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1);">
            <p>© 2024 Kaposvár közlekedési Zrt. Minden jog fenntartva.</p>
        </div>
    </footer>
<!-- -----------------------------------------------------------------------------------------------------FOOTER END--------------------------------------------------------------------------------------------------- -->

    <script>
/*---------------------------------------------------------------------------------------------------------JAVASCRIPT - BACK BUTTON--------------------------------------------------------------------------------------*/
        document.getElementById('bckBtn').addEventListener('click', function() {
            window.location.href = 'jaratok.php'; // Redirect to jaratok.php
        });
/*---------------------------------------------------------------------------------------------------------BACK BUTTON END-----------------------------------------------------------------------------------------------*/
       
        // Function to get URL parameters
        const getQueryParams = () => ({
            number: new URLSearchParams(window.location.search).get("number"),
            name: new URLSearchParams(window.location.search).get("name"),
            stop_time: new URLSearchParams(window.location.search).get("stop_time"),
            schedule_id: new URLSearchParams(window.location.search).get("schedule_id")
        });

        // Fetch bus route details from API
        async function fetchBusData() {
            const { number, name, stop_time, schedule_id } = getQueryParams();
            if (!number) {
                console.error("Number is missing");
                return;
            }

            try {
                const response = await fetch("http://localhost:3000/api/buszjaratok");
                const data = await response.json();

                // Filter data to get only stops for this route
                const filteredStops = data.filter(stop => stop.number == number && stop.schedule_id == schedule_id);
                if (filteredStops.length === 0) {
                    console.error("No stops found for this route.");
                    return;
                }

                // Extract stop names and times
                const stops = filteredStops.map(stop => stop.stop_name);
                const stopsTime = filteredStops.map(stop => stop.stop_time);

                // Structure data for display
                const busData = {
                    number: number,
                    name: name,
                    stop: stop_time,
                    schedule: schedule_id,
                    stops: stops,
                    stopsTime: stopsTime
                };

                // Display the data
                displayBusData(busData);
            } catch (error) {
                console.error("Error fetching bus data:", error);
            }
        }

        // Function to display bus data
        function displayBusData(busData) {
            const timeContainer = document.getElementById('timeContainer');

            function formatTime(time) {
                const [hour, minute] = time.split(":");
                return `${hour}:${minute}`;
            }

            document.getElementById('timeNumCon').innerHTML = `
                <div class="time-number">${busData.number}</div>
                <div class="time-name">${busData.name}</div>
                <div class="time">${formatTime(busData.stop)}</div>
            `;

            timeContainer.innerHTML = ""; // Clear previous content
            busData.stops.forEach((stop, index) => {
                const timeCard = document.createElement('div');
                timeCard.className = 'time-card';
                timeCard.innerHTML = `
                    <div class="time-stop" style="font-weight: bold;">${stop}</div>
                    <div class="time-time">${formatTime(busData.stopsTime[index])}</div>
                `;
                timeContainer.appendChild(timeCard);
            });
        }

        // Initialize data fetching
        fetchBusData();
  
</script>
</body>
</html>
