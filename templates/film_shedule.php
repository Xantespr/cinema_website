<main id="filmy">
    
    
    <!-- Dropdown to select the day -->
    <div class="dropdown">
        <h1>Movies in our cinema:</h1>
        <div id = "flexbox"> </div>
        <label for="daySelector">SELECT A DAY:</label>
        <select id="daySelector" onchange="getShows()">
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
            <option value="Sunday">Sunday</option>
        </select>
    </div>
    
    <!-- Container to display film shows -->
    <div id="filmShowsContainer"></div>

    <script>
        document.getElementById("daySelector").value = getDayName(new Date());

        function getDayName(date) {
            let days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            return days[date.getDay()];
        }

        function getFormattedDate(selectedDay) {
            // Get the current date
            let currentDate = new Date();
            let currentDayOfWeek = currentDate.getDay();
            let dayIndexMap = {
                "Sunday": 0,
                "Monday": 1,
                "Tuesday": 2,
                "Wednesday": 3,
                "Thursday": 4,
                "Friday": 5,
                "Saturday": 6
            };

            // Calculate the difference in days between the selected day and the current day
            let dayDifference = dayIndexMap[selectedDay] - currentDayOfWeek;
            // Adjust the current date by adding the day difference
            if (dayDifference < 0) {
                dayDifference += 7;
            }
            currentDate.setDate(currentDate.getDate() + dayDifference);
            // Format the date as "YYYY-MM-DD"
            let formattedDate = currentDate.toISOString().split('T')[0];

            return formattedDate;
        }        
        
        // Function to fetch film shows for the selected day
        function getShows() {
            // Get the selected day from the dropdown
            var selectedDay = document.getElementById("daySelector").value;
            let formattedDate = getFormattedDate(selectedDay);

            fetch('php_scripts/read_shows.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'day=' + encodeURIComponent(formattedDate)
            })
            .then(response => response.json())
            .then(data => {
                // Display film shows in the HTML container
                displayFilmShows(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        // Function to display film shows
        function displayFilmShows(shows) {
            // Get the container element
            let container = document.getElementById("filmShowsContainer");

            // Create HTML content for film shows
            let htmlContent = "<table>";

            shows.forEach(show => {
                htmlContent += `<tr class="seans" onclick="window.location.href='film_description.php?id=${show.id}'"><td>${show.title}</td></tr>`;
            });

            htmlContent += "</table>";

            // Set the HTML content of the container
            container.innerHTML = htmlContent;
        }

        getShows();
    </script>
</main>