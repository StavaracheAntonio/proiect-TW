<form class="flight-bar shadow">
    <div class="flight-bar-item shadow">
        <label>From</label>
        <input type="text" name="from" id="from" placeholder="Iasi">
    </div>
    <div class="flight-bar-item shadow">
        <label>To</label>
        <input type="text" name="from" id="from" placeholder="London">
    </div>
    <div class="flight-bar-item shadow">
        <label>Depart</label>
        <input type="text" name="from" id="from" placeholder="01 Apr 2019">
    </div>
    <div class="flight-bar-item shadow">
        <label>Return</label>
        <input type="text" name="from" id="from" placeholder="01 Aug 2019">
    </div>
    <input type="submit" class="shadow" value="SHOW FLIGHTS">
</form>

<div class="flight-results">
    <div class="flight-results-panel shadow">
        <div class="route">
            <h3>Iasi</h3>
            <span class="arrow"> &gt;</span>
            <h3>London</h3>
        </div>
        <div class="date">
            <h4>01 Apr 2019</h4>
        </div>
    </div>
    <div class="flight-results-list">
        <?php include 'views/bar/FlightResultItem.php' ?>
        <?php include 'views/bar/FlightResultItem.php' ?>
    </div>
    <div class="flight-results-panel shadow">
        <div class="route">
            <h3>London</h3>
            <span class="arrow"> &gt;</span>
            <h3>Iasi</h3>
        </div>
        <div class="date">
            <h4>01 Aug 2019</h4>
        </div>
    </div>
    <div class="flight-results-list">
        <?php include 'views/bar/FlightResultItem.php' ?>
        <?php include 'views/bar/FlightResultItem.php' ?>
    </div>
</div>