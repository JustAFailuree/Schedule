<!DOCTYPE html>
<?php
session_start();
?>
<html lang="pl" xmlns:th="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan Zajęć</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="css/schedule.css">
</head>
<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="index.php">Moja Strona</a>
            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarMenu">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbarMenu" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="schedule.php">Plan</a>
            </div>
            <div class="navbar-end">
                <a class="navbar-item" href="login.php">
                    <span>Wyloguj</span>
                </a>
            </div>
        </div>
    </nav>

    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered has-text-white">Plan Zajęć</h1>
            <div class="box has-text-centered">
                <button class="button is-small is-info" id="prev-week">← Poprzedni tydzień</button>
                <input type="date" id="week-picker" class="input is-small mx-2" />
                <button class="button is-small is-info" id="next-week">Następny tydzień →</button>
            </div>
            <div class="table-container">
                <table class="table is-bordered is-narrow is-fullwidth">
                    <thead>
                        <tr>
                            <th>Godzina</th>
                            <th>Poniedziałek</th>
                            <th>Wtorek</th>
                            <th>Środa</th>
                            <th>Czwartek</th>
                            <th>Piątek</th>
                            <th>Sobota</th>
                            <th>Niedziela</th>
                        </tr>
                    </thead>
                    <tbody id="schedule-body"></tbody>
                </table>
            </div>
        </div>
    </section>

    <div class="footer"> 
        <div class="columns"> 
            <div class="column has-text-centered has-text-white"> 
                <p>Copyright © CatFish</p> 
            </div>
            <div class="column"> 
                <h4 class="bd-footer-title has-text-weight-medium has-text-left has-text-white">Schedule</h4> 
                <p class="bd-footer-link has-text-left has-text-white"> 
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Nullam sed sem ac lorem tincidunt placerat vel quis diam.
                </p> 
            </div> 
            <div class="column"> 
                <h4 class="bd-footer-title has-text-weight-medium has-text-justify has-text-white">Address</h4> 
                <p class="bd-footer-link has-text-white"> 
                    MAI 33, Antananarivo 105, Madagaskar
                </p> 
            </div> 
            <div class="column"> 
                <h4 class="bd-footer-title has-text-weight-medium has-text-justify has-text-white">Contact us</h4> 
                <p class="bd-footer-link has-text-white"> 
                    <p class="has-text-white">ContactUs@example.com</p>
                    <p class="has-text-white">+261 34 05 024 91 </p>
                    <a href="https://www.sancristobal.mg/">Web Page</a>
                </p> 
            </div> 
        </div> 
    </div> 

<?php
include 'pma.php';

$sql = "SELECT 
            c.data_zajec, 
            DATE_FORMAT(c.Godzina_rozpoczecia, '%H:%i') AS Godzina_rozpoczecia, 
            DATE_FORMAT(c.godzina_zakonczenia, '%H:%i') AS godzina_zakonczenia, 
            c.class_name, 
            c.Typ_zajec,
            u.Imie,
            u.Nazwisko,
            u.tytul_naukowy,  
            c.budynek,        
            c.numer_sali      
        FROM classes c
        LEFT JOIN users u ON c.id_kierunku = u.id_kierunku AND u.Rola = 'W';";

$result = $conn->query($sql);

$scheduleData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $scheduleData[] = [
            'date' => $row['data_zajec'],
            'startTime' => $row['Godzina_rozpoczecia'],
            'endTime' => $row['godzina_zakonczenia'],
            'subject' => $row['class_name'],
            'type' => $row['Typ_zajec'],
            'teacher' => $row['tytul_naukowy'].' '.$row['Imie'] . ' ' . $row['Nazwisko'], 
            'building' => $row['budynek'],     
            'roomNumber' => $row['numer_sali'] 
        ];
    }
}
$conn->close();
?>

<div id="classModal" class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header style="background-color:black; border:none;" class="modal-card-head">
      <p style="color:white;" class="modal-card-title" id="modal-subject">Zajęcia</p>
      <button class="delete" aria-label="close" onclick="closeModal()"></button>
    </header>
    <section style="background-color:#3B1C32; color:white;" class="modal-card-body">
      <p><strong style="color:white;">Godzina:</strong> <span id="modal-time"></span></p>
      <p><strong style="color:white;">Typ zajęć:</strong> <span id="modal-type"></span></p>
      <p><strong style="color:white;">Wykładowca:</strong> <span id="modal-teacher"></span></p>
      <p><strong style="color:white;">Budynek:</strong> <span id="modal-building"></span></p> 
      <p><strong style="color:white;">Numer sali:</strong> <span id="modal-roomNumber"></span></p> 
    </section>
    <footer style="background-color:black; border:none;" class="modal-card-foot">
      <button style="background-color:#A64D79; border:none; color:black;" class="button" onclick="closeModal()">Zamknij</button>
    </footer>
  </div>
</div>

<script>
let currentWeekStart = getUrlParam("week") ? getMonday(new Date(getUrlParam("week"))) : getMonday(new Date());
function getMonday(date) {
    const d = new Date(date);
    const day = d.getDay();
    const diff = d.getDate() - day + (day === 0 ? -6 : 1);
    d.setDate(diff);
    d.setHours(0, 0, 0, 0);
    return d;
}


function formatDate(date) {
    return date.toISOString().split("T")[0];
}

function getUrlParam(param) {
    const url = new URL(window.location.href);
    return url.searchParams.get(param);
}

const scheduleData = <?php echo json_encode($scheduleData); ?>;


document.addEventListener("DOMContentLoaded", function () {
    const weekPicker = document.getElementById("week-picker");
    const prevBtn = document.getElementById("prev-week");
    const nextBtn = document.getElementById("next-week");

    weekPicker.value = formatDate(currentWeekStart);

    prevBtn.addEventListener("click", () => {
        const newDate = new Date(currentWeekStart);
        newDate.setDate(newDate.getDate());
        window.location.href = `?week=${formatDate(getMonday(newDate))}`;
    });

    nextBtn.addEventListener("click", () => {
    const newDate = new Date(currentWeekStart);
    newDate.setDate(newDate.getDate() + 14);
    window.location.href = `?week=${formatDate(getMonday(newDate))}`;
});


    weekPicker.addEventListener("change", (e) => {
        const selected = new Date(e.target.value);
        window.location.href = `?week=${formatDate(getMonday(selected))}`;
    });

    generateTable();
    fetchSchedule();
});

function generateTable() {
    const tableBody = document.getElementById("schedule-body");
    tableBody.innerHTML = "";

    for (let hour = 7; hour < 20; hour++) {
        for (let quarter = 0; quarter < 4; quarter++) {
            let row = document.createElement("tr");

            if (quarter === 0) {
                let timeCell = document.createElement("td");
                timeCell.rowSpan = 4;
                timeCell.textContent = `${hour}:00 - ${hour + 1}:00`;
                row.appendChild(timeCell);
            }

            for (let day = 1; day <= 7; day++) {
                let cell = document.createElement("td");
                let time = (hour * 4 + quarter) / 4;
                cell.classList.add("schedule-slot");
                cell.dataset.hour = time.toFixed(2);
                cell.dataset.day = day;
                row.appendChild(cell);
            }

            tableBody.appendChild(row);
        }
    }
}

function fetchSchedule() {
    let startOfWeek = new Date(currentWeekStart);
    let weekDates = [];
    for (let i = 0; i < 7; i++) {
        let d = new Date(startOfWeek);
        d.setDate(startOfWeek.getDate() + i);
        weekDates.push(formatDate(d));
    }

    document.querySelectorAll(".schedule-slot").forEach(cell => {
        cell.innerHTML = "";
        cell.classList.remove("has-background-info-light");
        cell.removeAttribute("rowspan");
    });

    scheduleData
        .filter(item => weekDates.includes(item.date))
        .forEach(item => {
            let [startH, startM] = item.startTime.split(":").map(Number);
            let [endH, endM] = item.endTime.split(":").map(Number);

            let startSlot = (startH * 4 + Math.round(startM / 15)) / 4;
            let endSlot = (endH * 4 + Math.round(endM / 15)) / 4;
            let totalRows = Math.round((endSlot - startSlot) * 4);

            let dayIndex = weekDates.indexOf(item.date) + 1;

            let startCell = document.querySelector(`.schedule-slot[data-hour="${startSlot.toFixed(2)}"][data-day="${dayIndex}"]`);
            if (startCell) {
                startCell.innerHTML = `<strong style="color:black;">${item.subject}</strong><br><small>${item.startTime} - ${item.endTime}</small><br><small>${item.building}<br>${item.roomNumber}</small>`;
                startCell.style.backgroundColor = "#A64D79";
                startCell.style.color = "black";
                startCell.setAttribute("rowspan", totalRows);

                startCell.dataset.subject = item.subject;
                startCell.dataset.startTime = item.startTime;
                startCell.dataset.endTime = item.endTime;
                startCell.dataset.type = item.type;
                startCell.dataset.teacher = item.teacher;
                startCell.dataset.building = item.building;
                startCell.dataset.roomNumber = item.roomNumber;

                for (let i = 1; i < totalRows; i++) {
                    let nextCell = document.querySelector(`.schedule-slot[data-hour="${(startSlot + (i * 0.25)).toFixed(2)}"][data-day="${dayIndex}"]`);
                    if (nextCell) {
                        nextCell.remove();
                    }
                }

                startCell.addEventListener("click", () => {
                    document.getElementById("modal-subject").textContent = startCell.dataset.subject;
                    document.getElementById("modal-time").textContent = `${startCell.dataset.startTime} - ${startCell.dataset.endTime}`;
                    document.getElementById("modal-type").textContent = startCell.dataset.type;
                    document.getElementById("modal-teacher").textContent = startCell.dataset.teacher;
                    document.getElementById("modal-building").textContent = startCell.dataset.building;
                    document.getElementById("modal-roomNumber").textContent = startCell.dataset.roomNumber;
                    openModal();
                });
            }
        });
}

function openModal() {
    document.getElementById("classModal").classList.add("is-active");
}

function closeModal() {
    document.getElementById("classModal").classList.remove("is-active");
}
</script>
</body>
</html>
