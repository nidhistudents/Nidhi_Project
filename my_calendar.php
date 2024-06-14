<?php include 'session_control.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Calendar</title>
    <style>
        /* Add your CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            grid-gap: 5px;
            text-align: center;
        }

        .day {
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #fff;
            cursor: pointer;
            position: relative;
        }

        .day:hover::before {
            content: "Add activity";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .month-year {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .day-name {
            font-weight: bold;
            text-transform: uppercase;
        }

        .navigation {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .navigation button {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .navigation button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Calendar</h1>
        <div class="navigation">
            <button id="prevMonth">&lt;</button>
            <div class="month-year" id="monthYear"></div>
            <button id="nextMonth">&gt;</button>
        </div>
        <div class="calendar" id="calendar"></div>
    </div>

    <script>
        // Get current date
        const today = new Date();
        let currentMonth = today.getMonth();
        let currentYear = today.getFullYear();

        // Display current month and year
        const monthYearElement = document.getElementById('monthYear');
        monthYearElement.textContent = `${getMonthName(currentMonth)} ${currentYear}`;

        // Days of the week
        const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        // Populate calendar
        const calendarElement = document.getElementById('calendar');
        populateCalendar(currentMonth, currentYear);

        // Add event listeners for navigation buttons
        document.getElementById('prevMonth').addEventListener('click', () => {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            updateCalendar(currentMonth, currentYear);
        });

        document.getElementById('nextMonth').addEventListener('click', () => {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            updateCalendar(currentMonth, currentYear);
        });

        // Function to update calendar
        function updateCalendar(month, year) {
            monthYearElement.textContent = `${getMonthName(month)} ${year}`;
            populateCalendar(month, year);
        }

        // Function to populate calendar
        function populateCalendar(month, year) {
            // Clear previous calendar
            calendarElement.innerHTML = '';

            // Add days of the week
            for (let i = 0; i < 7; i++) {
                const dayNameElement = document.createElement('div');
                dayNameElement.classList.add('day', 'day-name');
                dayNameElement.textContent = daysOfWeek[i].substring(0, 3);
                calendarElement.appendChild(dayNameElement);
            }

            // Get the number of days in the month
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            // Get the starting day of the month
            const firstDay = new Date(year, month, 1).getDay();

            // Create day elements for the calendar
            for (let i = 0; i < firstDay; i++) {
                const emptyDay = document.createElement('div');
                emptyDay.classList.add('day');
                calendarElement.appendChild(emptyDay);
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const dayElement = document.createElement('div');
                dayElement.classList.add('day');
                dayElement.textContent = day;
                calendarElement.appendChild(dayElement);
            }
        }

        // Function to get month name from index
        function getMonthName(monthIndex) {
            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            return monthNames[monthIndex];
        }
    </script>
</body>
</html>
