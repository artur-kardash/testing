<!-- page content -->
<div class="right_col" role="main">

    <h1>SERPLAB</h1>
    <hr/>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">All projects</a></li>
        <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
        <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active" style="margin-top: 20px;">
            <h2>All projects</h2>
            <table class="table">
                <thead>
                <tr>
                    <td>Project name</td>
                    <td>URL</td>
                    <td>Region</td>
                    <td>#Keywords</td>
                    <td>Frequency</td>
                    <td>Updated</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data['serplab_list_projects'] as $project):?>
                    <tr>
                        <td><a href="/serplab/project?id=<?=$project['id']?>"><?=$project['name']?></a></td>
                        <td><?=$project['url']?></td>
                        <td><?=$project['region']?></td>
                        <td><?=$project['number_of_keywords']?></td>
                        <td><?=$project['check_frequency']?></td>
                        <td><?=$project['created']?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div id="menu1" class="tab-pane fade">
            <h3>Menu 1</h3>
            <p>Some content in menu 1.</p>
        </div>
        <div id="menu2" class="tab-pane fade">
            <h3>Menu 2</h3>
            <p>Some content in menu 2.</p>
        </div>
    </div>

    <div class="clearfix"></div>
    <br />
</div>
</div>
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
</body>