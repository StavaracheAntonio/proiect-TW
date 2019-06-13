function onSearchCategoryClick(event) {
    let selectedCategories = document.getElementsByClassName('selected-category');

    for (let i = 0; i < selectedCategories.length; i++) {
        selectedCategories[i].classList.add('unselected-category');
        selectedCategories[i].classList.remove('selected-category');
    }

    let classList = event.target.classList;
    if (classList.contains('unselected-category')) {
        classList.add('selected-category');
        classList.remove('unselected-category');
    }

    sendData();
};

function sendData() {
    let selectedCategory = document.getElementsByClassName('selected-category')[0];
    let hashTag = selectedCategory.parentNode.getAttribute('hashtag');

    let data = {
        hashTag: hashTag
    }

    let apiHeaders = new Headers();
    apiHeaders.append('Content-Type', 'application/json');

    let request = new Request("/mvc/core/api/cities.php", {
        method: 'POST',
        headers: apiHeaders,
        body: JSON.stringify(data)
    });

    fetch(request)
        .then(response => {
            return response.json();
        })
        .then(data => {
            console.log(data);
            onCitiesReceived(data);
        })
        .catch(err => {
            console.log(err);
        });
}

function onCitiesReceived(cities) {

    let tripList = document.getElementById('triplist');

    while (tripList.firstChild) {
        tripList.removeChild(tripList.firstChild);
    }

    for (let i = 0; i < cities.length; i++) {
        tripList.appendChild(createCityListItem(cities[i]));
    }
}

function createCityListItem(city) {
    let tripListItem = document.createElement('div');
    tripListItem.classList.add('triplist-item');
    tripListItem.style.background = 'url(' + city.image + ') no-repeat center center';
    tripListItem.classList.add('shadow');

    let tripListItemContent = document.createElement('div');
    tripListItemContent.classList.add('triplist-item-content');
    tripListItemContent.classList.add('shadow');

    let cityName = document.createElement('h1');
    cityName.appendChild(document.createTextNode(city.name));

    let cityDescription = document.createElement('p');
    cityDescription.appendChild(document.createTextNode(city.description));

    let cityButton = document.createElement('a');
    cityButton.setAttribute('href', '/mvc/trip/' + city.name);
    cityButton.classList.add('shadow');
    cityButton.appendChild(document.createTextNode('Find more about ' + city.name));


    tripListItemContent.appendChild(cityName);
    tripListItemContent.insertAdjacentHTML('beforeend', city.description);
    tripListItemContent.appendChild(cityButton);

    tripListItem.appendChild(tripListItemContent);

    return tripListItem;
}

function onSubmitFlight(event) {
    event.preventDefault();

    let from = document.getElementById('from').value;
    let to = document.getElementById('to').value;
    let departDate = document.getElementById('departDate').value;
    let arriveDate = document.getElementById('returnDate').value;
    let budgetMin = document.getElementById('minBuget').value;
    let budgetMax = document.getElementById('maxBuget').value;
    let duration = document.getElementById('maxDuration').value;


    let flightFromCity = document.getElementsByClassName('flightFromCity');
    for (let i = 0; i < flightFromCity.length; i++) {
        flightFromCity[i].innerHTML = from;
    }

    let flightToCity = document.getElementsByClassName('flightToCity');

    for (let i = 0; i < flightToCity.length; i++) {
        flightToCity[i].innerHTML = to;
    }

    let flightDepartDate = document.getElementById('flightDepartDate');
    let flightArriveDate = document.getElementById('flightArriveDate');

    flightDepartDate.innerHTML = departDate;
    flightArriveDate.innerHTML = arriveDate;

    let data = {
        from: from,
        to: to,
        departDate: departDate,
        arriveDate: arriveDate,
        budgetMin: budgetMin,
        budgetMax: budgetMax,
        duration: duration
    }

    let apiHeaders = new Headers();
    apiHeaders.append('Content-Type', 'application/json');

    let request = new Request("/mvc/core/api/flights.php", {
        method: 'POST',
        headers: apiHeaders,
        body: JSON.stringify(data)
    });

    fetch(request)
        .then(response => {
            return response.json();
        })
        .then(data => {
            console.log(data);
            onFlightsReceive(data);
        })
        .catch(err => {
            console.log(err);
        });
}

var flightsFrom = [];
var flightsTo = [];

function onFlightsReceive(flights) {
    let flightsFromList = document.getElementById('flightsFromList');
    let fligtsToList = document.getElementById('flightsToList');

    while (flightsFromList.firstChild) {
        flightsFromList.removeChild(flightsFromList.firstChild);
    }

    while (fligtsToList.firstChild) {
        fligtsToList.removeChild(fligtsToList.firstChild);
    }

    flightsFrom = flights.from;
    flightsTo = flights.to;

    for (let i = 0; i < flightsFrom.length; i++) {
        flightsFromList.appendChild(createFlightListItem(flightsFrom[i]));
    }

    for (let i = 0; i < flightsTo.length; i++) {
        fligtsToList.appendChild(createFlightListItem(flightsTo[i]));
    }
}


function createFlightListItem(flight) {
    /*
    <div class="flight-results-item shadow">
    <div class="flight-results-field shadow">
        <div class="title">Iasi</div>
        <div class="date"><b>07:00</b><span>IAS</span></div>
    </div>
    <div class="flight-results-field shadow">
        <div class="title">Duration</div>
        <div class="duration">2h 30min</div>
    </div>
    <div class="flight-results-field shadow">
        <div class="title">London</div>
        <div class="date"><b>08:00</b><span>LON</span></div>
    </div>
    <div class="flight-results-field shadow">
        <div class="title">Price</div>
        <div class="price">500$</div>
    </div>
    <button class="flight-results-button shadow">SAVE FLIGHT</button>
</div>
    */

    let flightResultItem = document.createElement('div');
    flightResultItem.classList.add('flight-results-item');
    flightResultItem.classList.add('shadow');

    /* from */
    let flightFrom = document.createElement('div');
    flightFrom.classList.add('flight-results-field');
    flightFrom.classList.add('shadow');
    flightResultItem.appendChild(flightFrom);

    let fromTitle = document.createElement('div');
    fromTitle.classList.add('title');
    fromTitle.appendChild(document.createTextNode(flight.from));
    flightFrom.appendChild(fromTitle);

    let fromDate = document.createElement('div');
    fromDate.classList.add('date');
    fromDate.insertAdjacentHTML('beforeend', '<b>' + flight.departHour + '</b><span>' + flight.fromid + '</span>');
    flightFrom.appendChild(fromDate);

    /* duration */
    let flightDuration = document.createElement('div');
    flightDuration.classList.add('flight-results-field');
    flightDuration.classList.add('shadow');
    flightResultItem.appendChild(flightDuration);

    let durationTitle = document.createElement('div');
    durationTitle.classList.add('title');
    durationTitle.appendChild(document.createTextNode('Duration'));
    flightDuration.appendChild(durationTitle);

    let durationValue = document.createElement('div');
    durationValue.classList.add('price');
    durationValue.appendChild(document.createTextNode(flight.duration));
    flightDuration.appendChild(durationValue);

    /* to */
    let flightTo = document.createElement('div');
    flightTo.classList.add('flight-results-field');
    flightTo.classList.add('shadow');
    flightResultItem.appendChild(flightTo);

    let toTitle = document.createElement('div');
    toTitle.classList.add('title');
    toTitle.appendChild(document.createTextNode(flight.to));
    flightTo.appendChild(toTitle);

    let toDate = document.createElement('div');
    toDate.classList.add('date');
    toDate.insertAdjacentHTML('beforeend', '<b>' + flight.arriveHour + '</b><span>' + flight.toid + '</span>');
    flightTo.appendChild(toDate);

    /* price */
    let flightPrice = document.createElement('div');
    flightPrice.classList.add('flight-results-field');
    flightPrice.classList.add('shadow');
    flightResultItem.appendChild(flightPrice);

    let priceTitle = document.createElement('div');
    priceTitle.classList.add('title');
    priceTitle.appendChild(document.createTextNode('Price'));
    flightPrice.appendChild(priceTitle);

    let priceValue = document.createElement('div');
    priceValue.classList.add('price');
    priceValue.appendChild(document.createTextNode(flight.price + '$'));
    flightPrice.appendChild(priceValue);


    /* button */
    let flightButton = document.createElement('button');
    flightButton.classList.add('flight-results-button');
    flightButton.classList.add('shadow');
    flightButton.appendChild(document.createTextNode('SAVE FLIGHT'));
    flightButton.addEventListener('click', onSaveFlight);
    flightResultItem.appendChild(flightButton);


    return flightResultItem;
}

function onSaveFlight(event) {

    if (userName == null)
        return;

    let flightElement = event.target.parentNode;

    let flightList = flightElement.parentNode;
    let flightData;

    if (flightList.getAttribute('id') == 'flightsFromList')
        flightData = flightsFrom[getElementIndex(flightElement)];
    else
        flightData = flightsTo[getElementIndex(flightElement)];

    let data = {
        username: userName,
        from: flightData.from,
        to: flightData.to,
        departDate: flightData.departHour,
        arriveDate: flightData.arriveHour,
        price: flightData.price
    };

    let apiHeaders = new Headers();
    apiHeaders.append('Content-Type', 'application/json');

    let request = new Request("/mvc/core/api/save.php", {
        method: 'POST',
        headers: apiHeaders,
        body: JSON.stringify(data)
    });

    fetch(request)
        .then(response => {
            return response.json();
        })
        .then(data => {
            console.log(data);
        })
        .catch(err => {
            console.log(err);
        });
}

function getElementIndex(node) {
    var index = 0;
    while ((node = node.previousElementSibling)) {
        index++;
    }
    return index;
}


function onLogin(event) {
    event.preventDefault();

    let username = document.getElementById('Usr').value;
    let password = document.getElementById('Pass').value;

    let http = new XMLHttpRequest();
    let url = "/mvc/core/api/login.php";
    let parameters = "username=" + username + "&password=" + password;
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            let response = JSON.parse(http.responseText);
            onLoginResponse(response);
        }
    }
    http.send(parameters);
}

function onLoginResponse(data) {
    if (data.status == 'error') {
        let loginForm = document.getElementById('loginForm');
        loginForm.insertAdjacentHTML('beforeend', '<p class=\"error\">' + data.message + '<p>');
    }
    else
        window.location.reload();
}

function onLogout() {

    let http = new XMLHttpRequest();
    let url = "/mvc/core/api/logout.php";
    http.open('GET', url, true);

    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            window.location.href = '/mvc/welcome';
        }
    }

    http.send(null);
}

function onSignUp(event) {
    event.preventDefault();

    let username = document.getElementById('UserSignUp').value;
    let password = document.getElementById('UserPasswordSignUp').value;
    let email = document.getElementById('UserEmail').value;

    let http = new XMLHttpRequest();
    let url = "/mvc/core/api/signup.php";
    let parameters = "username=" + username + "&password=" + password + "&email=" + email;

    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            let response = JSON.parse(http.responseText);
            onSignUpResponse(response);
        }
    }
    http.send(parameters);
}

function onSignUpResponse(data) {
    if (data.status == 'error') {
        let signupForm = document.getElementById('signupForm');
        signupForm.insertAdjacentHTML('beforeend', '<p class=\"error\">' + data.message + '<p>');
    }
    else
        window.location.reload();
}

function requestTripData() {
    if (cityName == null)
        return;

    let data = {
        city: cityName
    }

    let apiHeaders = new Headers();
    apiHeaders.append('Content-Type', 'application/json');

    let request = new Request("/mvc/core/api/trip.php", {
        method: 'POST',
        headers: apiHeaders,
        body: JSON.stringify(data)
    });

    fetch(request)
        .then(response => {
            return response.json();
        })
        .then(data => {
            console.log(data);
            onTripDataReceived(data);
        })
        .catch(err => {
            console.log(err);
        });
}

function onTripDataReceived(city) {
    let tripTitle = document.getElementById('tripTitle');
    let tripDescription = document.getElementById('tripDescription');
    let tripImage = document.getElementById('tripImage');
    let tripCurrency = document.getElementById('tripCurrency');
    let tripTempIcon = document.getElementById('tripTempIcon');
    let tripTempInfo = document.getElementById('tripTempInfo');
    let tripLanguage = document.getElementById('tripLanguage');

    tripTitle.appendChild(document.createTextNode(city.location));

    tripDescription.insertAdjacentHTML('beforeend', city.description);

    tripImage.setAttribute('src', city.image);

    tripCurrency.appendChild(document.createTextNode(city.currency.symbol));
    tripCurrency.appendChild(document.createElement('br'));
    tripCurrency.appendChild(document.createTextNode(city.currency.name));

    tripTempIcon.setAttribute('src', city.temperature.icon);

    tripTempInfo.appendChild(document.createTextNode(Math.round(city.temperature.value) + '\u2103'));
    tripTempInfo.appendChild(document.createElement('br'));
    tripTempInfo.appendChild(document.createTextNode(city.temperature.description));

    tripLanguage.appendChild(document.createTextNode(city.language));
}

function requestUserFlightsData() {
    if (userName == null)
        return;

    let data = {
        username: userName
    }

    let apiHeaders = new Headers();
    apiHeaders.append('Content-Type', 'application/json');

    let request = new Request("/mvc/core/api/user.php", {
        method: 'POST',
        headers: apiHeaders,
        body: JSON.stringify(data)
    });

    fetch(request)
        .then(response => {
            return response.json();
        })
        .then(data => {
            console.log(data);
            onUserFlightsDataReceived(data);
        })
        .catch(err => {
            console.log(err);
        });
}

function onUserFlightsDataReceived(trips) {
    let userTripContainer = document.getElementById('user-trip-container');

    while (userTripContainer.firstChild) {
        userTripContainer.removeChild(userTripContainer.firstChild);
    }

    for (let i = 0; i < trips.length; i++) {
        userTripContainer.appendChild(createUserTripElement(trips[i]));
    }
}

function createUserTripElement(trip) {
    /*<div class="user-trip-item shadow">
        <h4 class="location">Iasi - London</h4>
        <h4 class="date">01 Apr 2019</h4>
        <h4 class="price">1000$</h4>
        <img class="notification" src="styles/img/icons/notification.svg" alt="notification">
        <span class="delete">&times;</span>
    </div>*/

    let userTripItem = document.createElement('div');
    userTripItem.classList.add('user-trip-item');
    userTripItem.classList.add('shadow');

    let location = document.createElement('h4');
    location.classList.add('location');
    location.appendChild(document.createTextNode(trip.departureCity + ' - ' + trip.arriveCity));
    userTripItem.appendChild(location);

    let date = document.createElement('h4');
    date.classList.add('date');
    date.appendChild(document.createTextNode(trip.departureDate));
    userTripItem.appendChild(date);

    return userTripItem;
}

function onUpdatePassword(event) {
    event.preventDefault();

    if (userName == null)
        return;

    let password = document.getElementById('update-password').value;
    let cpassword = document.getElementById('update-cpassword').value;

    let data = {
        username: userName,
        password: password,
        cpassword: cpassword
    }

    let apiHeaders = new Headers();
    apiHeaders.append('Content-Type', 'application/json');

    let request = new Request("/mvc/core/api/update.php", {
        method: 'POST',
        headers: apiHeaders,
        body: JSON.stringify(data)
    });

    fetch(request)
        .then(response => {
            return response.json();
        })
        .then(data => {
            console.log(data);
            onUpdateReceived(data);
        })
        .catch(err => {
            console.log(err);
        });
}

function onUpdateReceived(data) {
    let updateForm = document.getElementById('updateForm');

    if (data.status == 'error') {
        updateForm.insertAdjacentHTML('beforeend', '<p class=\"error\">' + data.message + '<p>');
    }
    else
        updateForm.insertAdjacentHTML('beforeend', '<p class=\"success\">' + data.message + '<p>');
}

function initForms() {
    let loginForm = document.getElementById('loginForm');
    let signupForm = document.getElementById('signupForm');
    let flightForm = document.getElementById('flightForm');
    let updateForm = document.getElementById('updateForm');


    if (loginForm != null) {
        // Adds a listener for the "submit" event.
        loginForm.addEventListener('submit', onLogin);
    }

    if (signupForm != null) {
        // Adds a listener for the "submit" event.
        signupForm.addEventListener('submit', onSignUp);
    }

    if (flightForm != null) {
        flightForm.addEventListener('submit', onSubmitFlight);
    }

    if (updateForm != null)
        updateForm.addEventListener('submit', onUpdatePassword);
}


function initSearchBar() {
    let categories = document.getElementsByClassName('search-category');
    for (let i = 0; i < categories.length; i++) {
        categories[i].childNodes[1].classList.add('unselected-category');
        categories[i].addEventListener('click', onSearchCategoryClick);
    }
}

function initTrip() {
    let trip = document.getElementById('trip');

    if (trip != null)
        requestTripData();
}

function initDashboard() {
    let dashboard = document.getElementById('dashboard');

    if (dashboard != null) {
        requestUserFlightsData();
    }
}

window.addEventListener('DOMContentLoaded', (event) => {
    initSearchBar();
    initForms();
    initTrip();
    initDashboard();
});