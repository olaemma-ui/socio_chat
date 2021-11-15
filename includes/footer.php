</body>
  <script>
    var bool = true;
    document.querySelector("#btn").addEventListener("click", function () {
      document.querySelector("#btn").style.cssText = "border: none; background: rgba(30, 64, 175, var(--tw-bg-opacity);";
      if (bool) {
        document.querySelector(".sidebar").classList.replace("left", "right");
        document.querySelector("#ic").classList.replace("fa-bars", "fa-times");
        document.querySelector(".sidebar").classList.replace("hidden", "visible");
        bool=!bool
      }else{
        document.querySelector("#ic").classList.replace("fa-times", "fa-bars");
        document.querySelector(".sidebar").classList.replace("visible","hidden");
        bool=!bool
      }
    });

    onload = notify();
    var t = setInterval(notify, 1000);
    function notify() {
      var xml = new XMLHttpRequest();
      xml.onreadystatechange =  function () {
          if (this.readyState == 4 && this.status == 200) {
            document.querySelector("#notify").innerHTML = this.responseText;
        }
      }
      xml.open("POST", "notify.php", true);
      xml.send();
    }
    document.querySelector("#search").addEventListener("keyup", function() {
      var txt = document.querySelector("#search").value;
      if (txt != "") {
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            document.querySelector("#friends").innerHTML = this.responseText;
            clearInterval(t);
          }
        }
        xml.open("GET", "friends.php?id="+txt, true);
        xml.send();
      }else{
        document.querySelector("#friends").innerHTML = "";
      }
    })
  </script>
</html>