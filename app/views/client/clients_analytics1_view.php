 <!-- page content -->
<div class="right_col" role="main">
    <div class="row main-analytics-row">
        <div class="col-md-12 analytics-all-container">
            <form action="" method="post" id="form">
                <input type="hidden" name="client_id" placeholder="client_id" id="client_id" value="<?=$_SESSION['client_id'] ?>">
                <input type="hidden" name="api_name" placeholder="api_name" id="api_name" value="api_analitics">
            </form>

            <script>
                (function(w,d,s,g,js,fs){
                    g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
                    js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
                    js.src='https://apis.google.com/js/platform.js';
                    fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
                }(window,document,'script'));
            </script>

            <h2>Client Analytics - Channels</h2>

            <input type="date" id="start-date">
            <input type="date" id="end-date">

            <header style="display:none;">
                <div id="embed-api-auth-container"></div>
                <div id="view-selector-container" style="display:none;"></div>
                <div id="view-name"></div>
                <div id="active-users-container"></div>
            </header>

            <div id="chart-container-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="Chartjs">
                            <h3>Sessions</h3>
                            <figure class="Chartjs-figure" id="chart-5-container"></figure>
                            <ol class="Chartjs-legend" id="legend-5-container"></ol>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="Chartjs">
                            <h3>Channels</h3>
                            <figure class="Chartjs-figure" id="chart-6-container"></figure>
                            <ol class="Chartjs-legend" id="legend-6-container"></ol>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="Chartjs">
                            <h3>Pages/Session</h3>
                            <figure class="Chartjs-figure" id="chart-7-container"></figure>
                            <ol class="Chartjs-legend" id="legend-7-container"></ol>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="Chartjs">
                            <h3>Pages/Session</h3>
                            <figure class="Chartjs-figure" id="chart-8-container"></figure>
                            <ol class="Chartjs-legend" id="legend-8-container"></ol>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Include the ActiveUsers component script. -->
            <script src="<?=__HOST__?>/js/embed-api/components/active-users.js"></script>
            <!-- Include the ViewSelector2 component script. -->
            <script src="<?=__HOST__?>/js/embed-api/components/view-selector2.js"></script>

            <!-- Include the CSS that styles the charts. -->
            <link rel="stylesheet" href="<?=__HOST__?>/css/google-analytics/chartjs-visualizations.css">

            <script>

                // == NOTE ==
                // This code uses ES6 promises. If you want to use this code in a browser
                // that doesn't supporting promises natively, you'll have to include a polyfill.

                gapi.analytics.ready(function() {

                    /**
                     * Authorize the user immediately if the user has already granted access.
                     * If no access has been created, render an authorize button inside the
                     * element with the ID "embed-api-auth-container".
                     */
                    gapi.analytics.auth.authorize({
                        container: 'embed-api-auth-container',
                        clientid: '201890636942-vr0pgotfrschlt1p8o5q9v3u9bqhnmdu.apps.googleusercontent.com'
                    });

                    /**
                     * Create a new ActiveUsers instance to be rendered inside of an
                     * element with the id "active-users-container" and poll for changes every
                     * five seconds.
                     */
                    var activeUsers = new gapi.analytics.ext.ActiveUsers({
                        container: 'active-users-container',
                        pollingInterval: 5
                    });


                    /**
                     * Add CSS animation to visually show the when users come and go.
                     */
                    activeUsers.once('success', function() {
                        var element = this.container.firstChild;
                        var timeout;

                        this.on('change', function(data) {
                            var element = this.container.firstChild;
                            var animationClass = data.delta > 0 ? 'is-increasing' : 'is-decreasing';
                            element.className += (' ' + animationClass);

                            clearTimeout(timeout);
                            timeout = setTimeout(function() {
                                element.className =
                                    element.className.replace(/ is-(increasing|decreasing)/g, '');
                            }, 3000);
                        });
                    });



                    $.ajax({
                        type: "POST",
                        url: "/ajax/get_client_api_profile",
                        data: {val: $('#form').serialize() }
                    }).done(function( msg ) {
                        var data = $.parseJSON(msg);
                        console.log(data);
                        if (data == null){
                            $('.analytics-all-container').hide();
                            $('.main-analytics-row').append('<h2>Integration is not set!</h2><p>Please, go to clients integration to connect Google Analytics.</p><a class="btn btn-primary" href="/client/clientinfo">Set integrations</a>')
                        }
                        $('#api_profile_id').val(data.api_profile_id);
                        $('#api_name').val(data.api_name);
                        $('#client_id').val(data.client_id);

                        function escapeHtml(text) {
                            return text
                                .replace("%3A", ":");

                        }

                        /**
                         * Create a new ViewSelector2 instance to be rendered inside of an
                         * element with the id "view-selector-container".
                         */
                        var viewSelector = new gapi.analytics.ext.ViewSelector2({
                            container: 'view-selector-container',
                            ids: escapeHtml(data.api_profile_id)
                        })
                            .execute();
                        /**
                         * Update the activeUsers component, the Chartjs charts, and the dashboard
                         * title whenever the user changes the view.
                         */
                        viewSelector.on('viewChange', function(data) {
                            console.log(data);
                            window.UserInfo = data;
                            var title = document.getElementById('view-name');
                            title.textContent = data.property.name + ' (' + data.view.name + ')';

                            // Start tracking active users for this view.
                            activeUsers.set(data).execute();


                            // Adjust `now` to experiment with different days, for testing only...
                            var now = moment(); // .subtract(3, 'day');

                            var startDate = moment(now).subtract(25, 'day').day(0).format('YYYY-MM-DD');
                            var endDate = moment(now).format('YYYY-MM-DD');

                            // Render all the of charts for this view.
                            chart5(data.ids, startDate, endDate);
                            chart6(data.ids);
                            chart7(data.ids, startDate, endDate);
                            chart8(data.ids);

                            $('#start-date, #end-date').on('change', function () {

                                var startDate = $('#start-date').val();
                                var endDate = $('#end-date').val();
                                chart5(data.ids, startDate, endDate);
                                chart7(data.ids, startDate, endDate);
                            })
                        });
                    });


                    /**
                     * Chart 5
                     */
                    function chart5(ids, startDate, endDate) {

                        // Adjust `now` to experiment with different days, for testing only...
                        var now = moment(); // .subtract(3, 'day');


                        var thisWeek = query({
                            'ids': ids,
                            'dimensions': 'ga:Date',
                            'metrics': 'ga:sessions',
                            'start-date': startDate,
                            'end-date': endDate
                        });

                        var lastMonth = query({
                            'ids': ids,
                            'dimensions': 'ga:Date,ga:Date',
                            'metrics': 'ga:sessions',
                            'start-date': startDate,
                            'end-date': endDate
                        });

                        Promise.all([thisWeek, lastMonth]).then(function(results) {

                            var data2 = results[1].rows.map(function(row) { return +row[2]; });
                            var labels = results[1].rows.map(function(row) { return +row[0]; });

                            labels = labels.map(function(label) {
                                return moment(label, 'YYYYMMDD').format('MMM DD');
                            });

                            var data = {
                                labels : labels,
                                datasets : [
                                    {
                                        label: 'Last Month',
                                        fillColor : 'rgba(220,220,220,0.5)',
                                        strokeColor : 'rgba(220,220,220,1)',
                                        pointColor : 'rgba(220,220,220,1)',
                                        pointStrokeColor : '#fff',
                                        data : data2
                                    },

                                ]
                            };

                            new Chart(makeCanvas('chart-5-container')).Bar(data);
                            generateLegend('legend-5-container', data.datasets);
                        });
                    }

                    /**
                     * Chart 6
                     */
                    function chart6(ids) {

                        query({
                            'ids': ids,
                            'dimensions': 'ga:source',
                            'metrics': 'ga:users',

                            'max-results': 11
                        })
                            .then(function(response) {

                                var data = [];
                                var colors = ['#4D5360','#949FB1','#D4CCC5','#E2EAE9','#F7464A', '#27601B', '#FBC217', '#4374E7', '#E92436', '#8A83E7', '#3BD8CD'];

                                response.rows.forEach(function(row, i) {
                                    data.push({ value: +row[1], color: colors[i], label: row[0] });
                                });

                                new Chart(makeCanvas('chart-6-container')).Doughnut(data);
                                console.log(data);
                                generateLegend('legend-6-container', data);
                            });
                    }

                    /**
                     * Chart 7
                     */
                    function chart7(ids, startDate, endDate) {

                        // Adjust `now` to experiment with different days, for testing only...
                        var now = moment(); // .subtract(3, 'day');

                        var thisWeek = query({
                            'ids': ids,
                            'dimensions': 'ga:Date',
                            'metrics': 'ga:pageviewsPerSession',
                            'start-date': moment(now).subtract(1, 'day').day(0).format('YYYY-MM-DD'),
                            'end-date': moment(now).format('YYYY-MM-DD')
                        });

                        var lastMonth = query({
                            'ids': ids,
                            'dimensions': 'ga:date,ga:nthDay',
                            'metrics': 'ga:pageviewsPerSession',
                            'start-date': startDate,
                            'end-date': endDate
                        });

                        Promise.all([thisWeek, lastMonth]).then(function(results) {

                            var data2 = results[1].rows.map(function(row) { return +row[2]; });
                            var labels = results[1].rows.map(function(row) { return +row[0]; });

                            labels = labels.map(function(label) {
                                return moment(label, 'YYYYMMDD').format('MMM DD');
                            });

                            var data = {
                                labels : labels,
                                datasets : [
                                    {
                                        label: 'Last Month',
                                        fillColor : 'rgba(220,220,220,0.5)',
                                        strokeColor : 'rgba(220,220,220,1)',
                                        pointColor : 'rgba(220,220,220,1)',
                                        pointStrokeColor : '#fff',
                                        data : data2
                                    },

                                ]
                            };

                            new Chart(makeCanvas('chart-7-container')).Bar(data);
                            generateLegend('legend-7-container', data.datasets);
                        });
                    }

                    /**
                     * Chart 8
                     */
                    function chart8(ids) {

                        query({
                            'ids': ids,
                            'dimensions': 'ga:source',
                            'metrics': 'ga:pageviewsPerSession',
                            'max-results': 5
                        })
                            .then(function(response) {

                                var data = [];
                                var colors = ['#4D5360','#949FB1','#D4CCC5','#E2EAE9','#F7464A'];

                                response.rows.forEach(function(row, i) {
                                    data.push({ value: +row[1], color: colors[i], label: row[0] });
                                });

                                new Chart(makeCanvas('chart-8-container')).Doughnut(data);
                                generateLegend('legend-8-container', data);
                            });
                    }
                    /**
                     * Extend the Embed APIs `gapi.analytics.report.Data` component to
                     * return a promise the is fulfilled with the value returned by the API.
                     * @param {Object} params The request parameters.
                     * @return {Promise} A promise.
                     */
                    function query(params) {
                        return new Promise(function(resolve, reject) {
                            var data = new gapi.analytics.report.Data({query: params});
                            data.once('success', function(response) { resolve(response); })
                                .once('error', function(response) { reject(response); })
                                .execute();
                        });
                    }


                    /**
                     * Create a new canvas inside the specified element. Set it to be the width
                     * and height of its container.
                     * @param {string} id The id attribute of the element to host the canvas.
                     * @return {RenderingContext} The 2D canvas context.
                     */
                    function makeCanvas(id) {
                        var container = document.getElementById(id);
                        var canvas = document.createElement('canvas');
                        var ctx = canvas.getContext('2d');

                        container.innerHTML = '';
                        canvas.width = container.offsetWidth;
                        canvas.height = container.offsetHeight;
                        container.appendChild(canvas);

                        return ctx;
                    }


                    /**
                     * Create a visual legend inside the specified element based off of a
                     * Chart.js dataset.
                     * @param {string} id The id attribute of the element to host the legend.
                     * @param {Array.<Object>} items A list of labels and colors for the legend.
                     */
                    function generateLegend(id, items) {
                        var legend = document.getElementById(id);
                        legend.innerHTML = items.map(function(item) {
                            var color = item.color || item.fillColor;
                            var label = item.label;
                            return '<li><i style="background:' + color + '"></i>' +
                                escapeHtml(label) + '</li>';
                        }).join('');
                    }


                    // Set some global Chart.js defaults.
                    Chart.defaults.global.animationSteps = 60;
                    Chart.defaults.global.animationEasing = 'easeInOutQuart';
                    Chart.defaults.global.responsive = true;
                    Chart.defaults.global.maintainAspectRatio = false;


                    /**
                     * Escapes a potentially unsafe HTML string.
                     * @param {string} str An string that may contain HTML entities.
                     * @return {string} The HTML-escaped string.
                     */
                    function escapeHtml(str) {
                        var div = document.createElement('div');
                        div.appendChild(document.createTextNode(str));
                        return div.innerHTML;
                    }

                });
            </script>
        </div>
    </div>
</div>


<div class="clearfix"></div>


        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Jointoit! <!-- <a href="https://colorlib.com">Colorlib</a> -->
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
