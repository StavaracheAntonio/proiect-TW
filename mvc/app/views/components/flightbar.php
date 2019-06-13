<form class="flight-bar shadow" id="flightForm">
    <div class="flight-bar-item shadow">
        <label>From</label>
        <input type="text" name="from" id="from" placeholder="Moscow">
    </div>
    <div class="flight-bar-item shadow">
        <label>To</label>
        <input type="text" name="from" id="to" placeholder="London">
    </div>
    <div class="flight-bar-item shadow">
        <label>Depart</label>
        <input type="text" name="from" id="departDate" placeholder="01.03.2019">
    </div>
    <div class="flight-bar-item shadow">
        <label>Return</label>
        <input type="text" name="from" id="returnDate" placeholder="01.05.2019">
    </div>
    <div class="flight-bar-item shadow">
        <label>Min Buget</label>
        <input type="text" name="from" id="minBuget" placeholder="500">
    </div>
    <div class="flight-bar-item shadow">
        <label>Max Buget</label>
        <input type="text" name="from" id="maxBuget" placeholder="4000">
    </div>
    <div class="flight-bar-item shadow">
        <label>Max Flight Duration</label>
        <input type="text" name="from" id="maxDuration" placeholder="50">
    </div>
    <input type="submit" class="shadow" value="SHOW FLIGHTS">
</form>

<div class="flight-results">
    <div class="flight-results-panel shadow">
        <div class="route">
            <h3 class="flightFromCity"></h3>
            <span class="arrow"> &gt;</span>
            <h3 class="flightToCity"></h3>
        </div>
        <div class="date">
            <h4 id="flightDepartDate"></h4>
        </div>
    </div>
    <div class="flight-results-list" id="flightsFromList">
    </div>
    <div class="flight-results-panel shadow">
        <div class="route">
            <h3 class="flightToCity"></h3>
            <span class="arrow"> &gt;</span>
            <h3 class="flightFromCity"></h3>
        </div>
        <div class="date">
            <h4 id="flightArriveDate"></h4>
        </div>
    </div>
    <div class="flight-results-list" id="flightsToList">
    </div>
</div>