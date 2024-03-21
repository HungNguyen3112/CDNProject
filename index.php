<!doctype html>
<html>

<head>
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>

<body>
  <button type="button" onclick="create()">Click Me</button>
  <script>
    function create() {
      $.ajax({
        url: "Controller/PostController.php", //the page containing php script
        type: "post", //request type,
        dataType: 'json',
        //**Params api get post by query**
        // data: {
        //   cats: [1, 2],
        //   currentPosts: [1],
        //   page: 1,
        //   action: 'getPostsByQuery'
        // },

        //**Params api get detail post**
        data: {
          id: 2,
          action: 'getDetailsPost',
          isCount: true
        },

        //**Params api get posts in dashboard**
        // data: {
        //   action: 'getPostsDashboard'
        // },
        success: function(result) {
          console.log(result.abc);
        }
      });
    }
  </script>
</body>

</html>