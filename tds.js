function displayCalendar() {
    var htmlContent = "";
    var FebNumberOfDays = "";
    var counter = 1;
  
    var dateNow = new Date();
    var month = dateNow.getMonth();
  
    var nextMonth = month + 1; //+1; //Used to match up the current month with the correct start date.
    var prevMonth = month - 1;
    var day = dateNow.getDate();
    var year = dateNow.getFullYear();
  
    var changeDate;
    var tasks = {};
  
    //Determing if February (28,or 29)
    if (month == 1) {
      if ((year % 100 != 0 && year % 4 == 0) || year % 400 == 0) {
        FebNumberOfDays = 29;
      } else {
        FebNumberOfDays = 28;
      }
    }
  
    // names of months and week days.
    var monthNames = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December"
    ];
    var dayNames = [
      "Sunday",
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thrusday",
      "Friday",
      "Saturday"
    ];
    var dayPerMonth = [
      "31",
      "" + FebNumberOfDays + "",
      "31",
      "30",
      "31",
      "30",
      "31",
      "31",
      "30",
      "31",
      "30",
      "31"
    ];
  
    // days in previous month and next one , and day of week.
    var nextDate = new Date(nextMonth + " 1 ," + year);
    var weekdays = nextDate.getDay();
    var weekdays2 = weekdays;
    var numOfDays = dayPerMonth[month];
  
    // this leave a white space for days of pervious month.
    while (weekdays > 0) {
      htmlContent += "<td class='monthPre'></td>";
  
      // used in next loop.
      weekdays--;
    }
  
    // loop to build the calander body.
    while (counter <= numOfDays) {
      // When to start new line.
      if (weekdays2 > 6) {
        weekdays2 = 0;
        htmlContent += "</tr><tr>";
      }
  
      // if counter is current day.
      // highlight current day using the CSS defined in header.
      if (counter == day) {
        htmlContent += "<td class='monthNow dayNow' >" + counter + "</td>";
      } else {
        htmlContent += "<td class='monthNow'>" + counter + "</td>";
      }
  
      weekdays2++;
      counter++;
    }
  
    // building the calendar html body.
    var calendarBody =
      "<table class='calendar'> <tr class='monthNow'><th colspan='7'>" +
      monthNames[month] +
      " " +
      year +
      "</th></tr>";
    calendarBody +=
      "<tr class='dayNames'>  <td>Sun</td>  <td>Mon</td> <td>Tues</td>" +
      "<td>Wed</td> <td>Thurs</td> <td>Fri</td> <td>Sat</td> </tr>";
    calendarBody += "<tr>";
    calendarBody += htmlContent;
    calendarBody += "</tr></table>";
    // set the content of div .
    document.getElementById("calendar").innerHTML = calendarBody;
  
    var toDoListBody =
      "<h2 id='todolist'><span id='daynow'>" +
      day +
      "</span> " +
      monthNames[month] +
      "'s to do list</h2> <input type='text' name='listitem'></input><button id='button'>add</button> <dt></dt>";
    document.getElementById("todo").innerHTML = toDoListBody;
  
    $(document).ready(function() {
      $("#button").click(function() {
        changeDate = $(".dayNow").text();
        var key = changeDate + monthNames[month];
        var toAdd = $("input[name=listitem]").val();
        if (key in tasks) {
          tasks[key].push(toAdd);
        } else {
          tasks[key] = [];
          tasks[key].push(toAdd);
        }
  
        $("dt").append("<dd>" + toAdd + "</dd>");
      });
      $("td.monthNow").click(function() {
        $("dt").empty();
        // add red border to clicked day and remove red border from prev day
        $(".calendar")
          .find(".dayNow")
          .removeClass("dayNow");
        $(this).addClass("dayNow");
        // update the title of the todo list with the new day
        changeDate = $(".dayNow").text();
        $("span").html(changeDate);
  
        var key = changeDate + monthNames[month];
        if (key in tasks) {
          for (i = 0; i < tasks[key].length; i++) {
            $("dt").append("<dd>" + tasks[key][i] + "</dd>");
          }
        }
  
        // update the todolist with the todo items (if we have)
      });
  
      $(document).on("click", "dd", function() {
        $(this)
          .toggleClass("strike")
          .css("text-decoration", "line-through");
      });
  
      $("input").focus(function() {
        $(this).val("");
      });
    });
  }
  