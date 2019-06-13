<script type="text/javascript">
    var cityName = <?php echo json_encode($city); ?>;
</script>

<div class="tripinfo shadow">
    <div class="tripinfo-main">
        <div class="text">
            <h1 id="tripTitle"></h1>
            <p id="tripDescription">
            </p>
        </div>
        <img id="tripImage" class="shadow" alt="London">
    </div>
    <div class="tripinfo-details">
        <h2>Essential facts</h2>
        <div class="tripinfo-details-list">
            <div class="tripinfo-details-item shadow">
                <h3>Currency</h3>
                <img src="/mvc/public/styles/img/icons/wallet.svg" alt="wallet">
                <h4 id="tripCurrency"></h4>
            </div>
            <div class="tripinfo-details-item shadow">
                <h3>Temperature</h3>
                <img id="tripTempIcon" alt="temperature">
                <h4 id="tripTempInfo"></h4>
            </div>

            <div class="tripinfo-details-item shadow">
                <h3>Language </h3>
                <img src="/mvc/public/styles/img/icons/passport.svg" alt="wallet">
                <h4 id="tripLanguage"></h4>
            </div>
        </div>
    </div>
</div>