<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.01.2017
 * Time: 14:27
 */

?>
<h3>current api profile id </h3>

<form action="" method="post" id="form">
    <input type="text" name="client_id" placeholder="client_id" id="client_id" value="999">
    <input type="text" name="api_name" placeholder="api_name" id="api_name" value="api_analitics">
    <input type="text" name="api_profile_id" placeholder="api_profile_id" id="api_profile_id">
    <input type="submit">
</form>
<hr>
<form action="" method="post" id="remove">
    <input type="submit" name="remove" value="remove">
</form>
<script>
    window.onload = function(){
        $('#form').submit(function( event ) {

            $.ajax({
                type: "POST",
                url: "/ajax/add_api_profile",
                data: { val: $(this).serialize() }
            }).done(function( msg ) {
                console.log(msg);
            });

            event.preventDefault();
        });

        $('#remove').submit(function( event ) {
            $.ajax({
                type: "POST",
                url: "/ajax/remove_api_profile",
                data: { val: $('#form').serialize() }
            }).done(function( msg ) {
                console.log(msg);
            });

            event.preventDefault();
        });


        $( document ).ready(function() {
            update_form();
        });

        function update_form() {
            $.ajax({
                type: "POST",
                url: "/ajax/get_client_api_profile",
                data: {val: $('#form').serialize() }
            }).done(function( msg ) {
                var data = $.parseJSON(msg);
                $('#api_profile_id').val(data.api_profile_id);
                $('#api_name').val(data.api_name);
                $('#client_id').val(data.client_id);
                console.log(data);
            });
        }

    }

</script>

