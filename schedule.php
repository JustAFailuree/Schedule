<!DOCTYPE html>
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
            
            <a class="navbar-item" href="index.php">
                Moja Strona
            </a>
    
           
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
                <tbody id="schedule-body">
                </tbody>
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
        <h4 class="bd-footer-title  
                   has-text-weight-medium 
                   has-text-left
                   has-text-white"> 
          Schedule 
        </h4> 
        <p class="bd-footer-link  
                  has-text-left
                  has-text-white"> 
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                  Nullam sed sem ac lorem tincidunt placerat vel quis diam.
        </p> 
      </div> 
    
      <div class="column"> 
        <h4 class="bd-footer-title  
                   has-text-weight-medium  
                   has-text-justify
                   has-text-white"> 
          Address 
        </h4> 
        <p class="bd-footer-link has-text-white"> 
          MAI 33, Antananarivo 105, Madagaskar
        </p> 
    
      </div> 
    
      <div class="column"> 
        <h4 class="bd-footer-title 
                   has-text-weight-medium 
                   has-text-justify
                   has-text-white"> 
          Contact us 
        </h4> 

        <p class="bd-footer-link has-text-white"> 
            <p class="has-text-white">ContactUs@example.com</p>
            <p class="has-text-white">+261 34 05 024 91 </p>
          <a href="https://www.sancristobal.mg/">Web Page</a>
        </p> 
    
      </div> 
    </div> 
</div> 


<script>
    document.addEventListener("DOMContentLoaded", function () {
        setupWeekNavigation();
        generateTable();
        fetchSchedule();
    });
    
    let currentWeekStart = getMonday(new Date()); 
    
    function setupWeekNavigation() {
        const weekPicker = document.getElementById("week-picker");
        const prevWeekBtn = document.getElementById("prev-week");
        const nextWeekBtn = document.getElementById("next-week");
    
        weekPicker.value = formatDate(currentWeekStart);
    
        prevWeekBtn.addEventListener("click", () => changeWeek(-7));
        nextWeekBtn.addEventListener("click", () => changeWeek(7));
        weekPicker.addEventListener("change", (e) => {
            currentWeekStart = getMonday(new Date(e.target.value));
            fetchSchedule();
        });
    }
    
    function changeWeek(days) {
        currentWeekStart.setDate(currentWeekStart.getDate() + days);
        document.getElementById("week-picker").value = formatDate(currentWeekStart);
        fetchSchedule();
    }
    
    function formatDate(date) {
        return date.toISOString().split("T")[0];
    }
    
    function getMonday(date) {
        let d = new Date(date);
        let day = d.getDay();
        let diff = d.getDate() - day + (day === 0 ? -6 : 1);
        return new Date(d.setDate(diff));
    }
    
    function generateTable() {
        const tableBody = document.getElementById("schedule-body");
        tableBody.innerHTML = "";
    
        for (let hour = 7; hour < 22; hour++) {
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
    
    async function fetchSchedule() {
    const scheduleData = [
        { date: "2024-03-18", startTime: "09:15", endTime: "11:45", subject: "Matematyka", teacher: "Dr. Kowalski" },
        { date: "2024-03-26", startTime: "12:30", endTime: "13:15", subject: "Fizyka", teacher: "Prof. Nowak" },
        { date: "2024-03-22", startTime: "15:45", endTime: "17:00", subject: "Informatyka", teacher: "Dr. Wiśniewski" },
    ];

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
                startCell.innerHTML = `<strong>${item.subject}</strong><br><small>${item.teacher}</small><br><small>${item.startTime} - ${item.endTime}</small>`;
                startCell.classList.add("has-background-info-light");
                startCell.setAttribute("rowspan", totalRows);

                for (let i = 1; i < totalRows; i++) {
                    let nextCell = document.querySelector(`.schedule-slot[data-hour="${(startSlot + (i * 0.25)).toFixed(2)}"][data-day="${dayIndex}"]`);
                    if (nextCell) {
                        nextCell.remove();
                    }
                }
            }
        });
}
    </script>
</body>
</html>
