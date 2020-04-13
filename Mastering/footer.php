  
    <footer class="py-5 bg-dark ">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
	<script type="text/javascript">

    function hello() {
        alert(ideaid);
        $.ajax({

            method: "POST",
            url: "viewCount.php",
            data: { ideaIdonClick:"{{Session::get('idea_id')}}",click:1, "_token":"{{csrf_token()}}" }
        }).done(function() {
            $.get("{{url('/view-count')}}",function (msg) {
                $('#clicks').html(msg);
            })

    })};
</script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>